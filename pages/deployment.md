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
    - uses: actions/checkout@v2
    - run: sudo apt-get update && sudo apt-get install -y pandoc yq php-cli
    - run: ./build.sh
    - uses: peaceiris/actions-gh-pages@v3
      with:
        publish_dir: ./docs
```