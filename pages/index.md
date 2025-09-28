---
title: Introduction
weight: 0
author:
    - name: Sean Morris
---

# SMGen
*Static Site Generator*

Bash-driven static-site generator. Converts Markdown files into a fully templated HTML website using PHP, yq, and Pandoc:

- **Bash** scripts to orchestrate the build process.
- **PHP** for templating and helper scripts.
- **yq** to extract YAML front-matter.
- **Pandoc** to render Markdown to HTML.

## Install

To install `smgen` (the static site generator) system-wide and set up an update path, run:

```bash
curl -fsSL https://seanmorris.github.io/smgen/install.sh | sudo bash
```

This command clones the repository into `/usr/share/smgen`, creates a `smgen` symlink in `/usr/local/bin`, and can be used to update `smgen` by re-running this script.

## Getting Started

Create a directory for your project, & run `smgen init` to set up the folder structure & standard template.

```bash
mkdir my-project/
cd my-project/
smgen init
```

Then open `.smgen-rc` and configure your details:

```bash
PRODUCT_NAME="Your Product Name"
TAGLINE="Your Product Tagline"
ORGANIZATION="Your Tagline"
```

Create a page:

```bash
cat <<-END > ./pages/index.md
    # Hello, SMGen!
END
```

Then build the project & serve it

```bash
smgen build
smgen serve
```

Open a browser and go to [http://localhost:8000/](http://localhost:8000/), you should see the project running.

The following files were created by the `init` script, and can be modified for customization. You should commit them to some version control (git) as a backup before you modify them.

* template/page.php
* template/header.php
* template/footer.php

See [Advanced Usage](http://localhost:8083/advanced-usage.html) for info on writing/customizing your own templates.

## Purpose

The goal of this generator is to provide a simple, flexible foundation for publishing documentation, blogs, and other content sites without heavy dependencies.

## Architecture

- **build.sh**: Main build script that copies static assets, renders pages, and assembles a sitemap.
- **pages/**: Markdown source files with optional YAML front-matter.
- **templates/**: PHP + Pandoc templates that wrap page content in site layout.
- **helpers/**: PHP scripts for navigation and sitemap generation.
- **static/**: Static assets (CSS, JS, images) that are copied verbatim to the output.
- **docs/**: Generated output directory ready for deployment.

Continue to **Getting Started** for steps to install and build your first site.