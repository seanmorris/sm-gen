---
title: Configuration
weight: 2
---

# Configuration

You can configure the generator via environment variables, `.smgen-rc`, and pre/post hooks.

> **Note:** `build.sh` looks for `pages/`, `templates/`, `static/`, and `.smgen-rc` in your current working directory (where you invoke the script). All paths and hooks can be customized via environment variables or a `.smgen-rc` file placed alongside the script.

## Environment Variables

- `OUTPUT_DIR` — output directory (default `./docs`)
- `TEMPLATE_DIR` — template files directory (default `./templates`)
- `STATIC_DIR` — static assets directory (default `./static`)
- `PAGES_DIR` — source pages directory (default `./pages`)
- `PHP` — PHP executable (default `php`)
- `PANDOC` — Pandoc executable (default `pandoc`)
- `YQ` — `yq` executable (default `yq`)
- `BASE_URL` — base URL for generated site (default empty)
- `PRODUCT_NAME` — product/site name (default empty)
- `ORGANIZATION` — organization name (default empty)
- `TAGLINE` — product tagline (default empty)
- `STYLES` — newline-separated list of CSS files to include (via `<link>`)
- `INLINE_STYLES` — newline-separated list of CSS files to inline in `<style>` tags
- `JAVASCRIPTS` — newline-separated list of JS files to include (via `<script src>`)
- `INLINE_JAVASCRIPTS` — newline-separated list of JS files to inline in `<script>` tags in `<head>`
- `BODY_JAVASCRIPTS` — newline-separated list of JS files to include before `</body>`
- `INLINE_BODY_JAVASCRIPTS` — newline-separated list of JS files to inline before `</body>`
- `TITLE_PREFIX` — prefix for page titles
- `HIGHLIGHT_STYLE` — Pandoc syntax highlighting theme (default `zenburn`)

## .smgen-rc Overrides

Create a `.smgen-rc` file at the root to override default variables (e.g., custom CSS or asset directory).

Example:

```bash
STYLES=$(cat <<-END
    /my-theme.css
END
)
```

## Hooks

- `before-build.sh` — script to run before the main build.
- `after-build.sh` — script to run after the build completes.
