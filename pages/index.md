---
title: Getting Started
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

Add Markdown files under the `pages/` directory. Each file may start with YAML front-matter:

```markdown
---
title: Home
author:
  - name: Your Name
---

# Welcome to My Site

This is my first page content.
```

Save it as `pages/index.md` (or any path under `pages/`)

Build the project and serve it:

```bash
smgen build
smgen serve
```

Open a browser and go to [http://localhost:8000/](http://localhost:8000/), you should see the project running.

## Templates

The following files were created by the `init` script, and can be modified for customization. You should commit them to some version control (git) as a backup before you modify them.

* template/page.php
* template/header.php
* template/footer.php

See [Customization#Themes, CSS, and JS Injection](customization.html#themes-css-and-js-injection) for info on writing/customizing your own styles and javascript.

See [Customization#Writing Your Own Templates](/customization.html#writing-your-own-templates) for info on creating/editing your own templates.

