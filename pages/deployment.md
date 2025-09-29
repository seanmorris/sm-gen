---
title: Deployment
weight: 6
---

# Deployment

## Custom Hosting

You can host the generated site by uploading the contents of `docs/` to any static-hosting provider (Netlify, S3, etc.).

Make sure to set the BASE_URL correctly before building if the site exists in a subdirectory on your domain. You can either set it in `.smgen-rc` or use an ENV var on the cli:

```bash
BASE_URL=example.com smgen build
```

## GitHub Pages

Github pages can be handled in two ways: you can simply build to the docs/ directory and commit that, or you can use a CI workflow that builds with the correct BASE_URL automatically.

### serving from docs/

Enable GitHub Pages deployment from your branch in repository settings

![Select "Deploy from Branch" in the dropdown](/github-pages-branch.png)

Select your branch, and the `/docs` folder. Make sure to use the `/docs` directory or the entire repository will be served.

![Make sure to pay attention to the folder selector](/github-pages-select-branch.png)

### CI Integration

You can also build the site completely within a workflow and publish the resulting artifact. This has the advantage of keeping the repository cleaner, and you can also autodetect your github pages BASE_URL, so there's no need to manage it manually.

Although it's slightly more complicated, this is the recomended way to publish to github pages.

You'll need to configure github pages to accept deployments from actions.

**This is not needed if you intend to commit your `/docs` directory and serve that via github pages.**

![Select "Github Actions" in the dropdown"](/github-pages-actions.png)

Once that's configured, you'll need a workflow that can deploy your site to pages. The example below uses `actions/deploy-pages@v4`. You can store it in `.github/workflows/build-and-deploy.yml` and  use it in your own project.

```yaml
# Example GitHub Actions workflow
name: Build and Deploy

on: push

permissions:
  contents: read
  pages: write
  id-token: write

jobs:
  build:

    runs-on: ubuntu-latest

    steps:
      - name: Get GitHub Pages URL
        id: get_pages_url
        run: echo "BASE_URL=$(gh api "repos/$GITHUB_REPOSITORY/pages" --jq '.html_url | rtrimstr("/")')" >> $GITHUB_ENV
        env:
          GITHUB_TOKEN: ${{ secrets.GITHUB_TOKEN }}

      - name: Checkout
        uses: actions/checkout@v4

      - name: Install SMGen
        run: curl -fsSL https://seanmorris.github.io/smgen/install.sh | sudo bash

      - name: Install dependencies
        run: sudo apt-get update && sudo apt-get install -y pandoc php-cli uuid

      - name: Install yq (Go binary)
        run: |
          wget -qO /usr/local/bin/yq https://github.com/mikefarah/yq/releases/download/${{ env.YQ_VERSION }}/yq_linux_amd64
          chmod +x /usr/local/bin/yq
        env:
          YQ_VERSION: v4.47.2

      - name: Clear files
        run: rm -rf ./docs/*

      - name: Build site
        run: smgen build

      - name: Setup Pages
        uses: actions/configure-pages@v5

      - name: Upload artifact
        uses: actions/upload-pages-artifact@v3
        with:
          path: './docs'

      - name: Deploy to GitHub Pages
        id: deployment
        uses: actions/deploy-pages@v4

      - name: Show GitHub Pages URL
        run: |
          echo "GitHub Pages URL: ${{ env.BASE_URL }}"

```

