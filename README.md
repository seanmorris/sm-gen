# Static Site Generator

This repository contains a minimal, Bash-driven static-site generator. It converts Markdown files into a fully templated HTML website using PHP, yq, and Pandoc.

## Prerequisites

- **Bash** (shell, version ≥ 4.0)
- **PHP** command-line
- **yq** (YAML processor)
- **Pandoc** (Markdown to HTML converter)

## Quick Start

Clone the repository and build your site:

```bash
git clone https://github.com/your/repo.git
cd repo
./build.sh
```

The `build.sh` script will source `.static-gen` (if present), copy static assets, render pages from `pages/`, and assemble a sitemap in the default `docs/` output directory.

You can also integrate this generator into any project directory: copy or symlink `build.sh`, `templates/`, `static/`, `helpers/`, and optionally a `.static-gen` file into your content root, then invoke `./build.sh`. It will look for `pages/`, `templates/`, `static/`, and `.static-gen` in the current working directory.

See it in action on the live demo: https://seanmorris.github.io/static-gen/

## Install

To install `smgen` (the static site generator) system-wide and set up an update path, run:

```bash
curl -fsSL https://raw.githubusercontent.com/seanmorris/smgen/main/docs/install.sh | sudo bash
```

This command clones the repository into `/usr/share/smgen`, creates a `smgen` symlink in `/usr/local/bin`, and can be used to update `smgen` by re-running this script.

## Preview Locally

Serve the generated site for preview:

```bash
cd docs
python3 -m http.server 8000
```

Open <http://localhost:8000> in your browser to view the site.

## Documentation Source

Full documentation is authored in Markdown under `pages/`:

- `pages/index.md` — Introduction
- `pages/getting-started.md` — Getting Started
- `pages/configuration.md` — Configuration
- `pages/project-structure.md` — Project Structure
- `pages/customization.md` — Customization (CSS, JS, templates)
- `pages/advanced-usage.md` — Advanced Usage (templates, partials, i18n)
- `pages/deployment.md` — Deployment (GitHub Pages, CI)
- `pages/faq.md` — FAQ & Troubleshooting
- `pages/examples/index.md` — Examples (sample CSS & JavaScript)

Run `./build.sh` to regenerate the HTML in `docs/`. You can customize behavior via `.static-gen`, environment variables, and pre/post hooks.