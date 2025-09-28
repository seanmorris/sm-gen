# SMGen
*Static Site Generator*

Bash-driven static-site generator. Converts Markdown files into a fully templated HTML website using PHP, yq, and Pandoc.

<a target = "_blank" href = "https://seanmorris.github.io/smgen/">
<img width = "100%" src = "https://seanmorris.github.io/smgen/banner-cropped.jpg" />
</a>

## Prerequisites

- **Bash** (shell, version ≥ 4.0)
- **PHP** command-line
- **yq** (YAML processor)
- **Pandoc** (Markdown to HTML converter)
- **uuid** (UUID generator)

```bash
apt install php php-yaml bash pandoc uuid

YQ_VERSION=v4.47.2
wget -qO /usr/local/bin/yq https://github.com/mikefarah/yq/releases/download/${YQ_VERSION}/yq_linux_amd64
chmod +x /usr/local/bin/yq
```

## Install

To install `smgen` (the static site generator) system-wide and set up an update path, run:

```bash
curl -fsSL https://seanmorris.github.io/smgen/install.sh | sudo bash
```

This command clones the repository into `/usr/share/smgen`, creates a `smgen` symlink in `/usr/local/bin`, and can be used to update `smgen` by re-running this script.

## Syntax Highlighting

You can set the syntax highlighting theme using the `HIGHLIGHT_STYLE` variable in .smgen-rc:

```bash
HIGHLIGHT_STYLE=zenburn
```

The following options are available:

* pygments
* tango
* espresso
* kate
* monochrome
* breezedark
* haddock
* zenburn

## Preview Locally

Serve the generated site for preview:

```bash
php -S localhost:8000 -t docs/
```

Open <http://localhost:8000> in your browser to view the site.

## Documentation Source

Full documentation is authored in Markdown under `pages/`:

- `pages/index.md` — Introduction & Getting Started
- `pages/configuration.md` — Configuration
- `pages/customization.md` — Customization (CSS, JS, templates)
- `pages/examples/basic-usage.md` — Basic Usage Example
- `pages/deployment.md` — Deployment (GitHub Pages, CI)
- `pages/faq.md` — FAQ & Troubleshooting
- `pages/LICENSE.md` — License

Run `./smgen.sh` to regenerate the HTML in `docs/`. You can customize behavior via `.smgen-rc`, environment variables, and pre/post hooks.
