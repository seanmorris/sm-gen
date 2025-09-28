---
title: Deployment
weight: 6
---

# Deployment

## GitHub Pages

1. Commit your `docs/` directory to the `gh-pages` branch.
2. Enable GitHub Pages in repository settings.

## Custom Hosting

Upload the contents of `docs/` to any static-hosting provider (Netlify, S3, etc.).

## CI Integration

Automate builds and deployments:
```yaml
# Example GitHub Actions workflow
name: Build and Deploy

on: push

jobs:
  build:
    runs-on: ubuntu-latest
    steps:
      - name: Get GitHub Pages URL
        id: get_pages_url
        run: echo "BASE_URL=$(gh api \"repos/$GITHUB_REPOSITORY/pages\" --jq '.html_url')" >> $GITHUB_ENV
        env:
          GITHUB_TOKEN: ${{ secrets.GITHUB_TOKEN }}

      - name: Use the pages domain in a step
        run: |
          echo "The deployed URL is: ${{ env.BASE_URL }}"

      - name: Checkout repository
        uses: actions/checkout@v2

      - name: Install dependencies
        run: sudo apt-get update && sudo apt-get install -y pandoc php-cli

      - name: Install yq (Go binary)
        run: |
          YQ_VERSION=v4.39.4
          wget -qO /usr/local/bin/yq https://github.com/mikefarah/yq/releases/download/${YQ_VERSION}/yq_linux_amd64
          chmod +x /usr/local/bin/yq

      - name: Build site
        run: ./build.sh

      - name: Deploy to GitHub Pages
        uses: peaceiris/actions-gh-pages@v3
        id: deploy
        with:
          publish_dir: ./docs

      - name: Show GitHub Pages URL
        run: echo "GitHub Pages URL: ${{ steps.deploy.outputs.page_url }}"
```

