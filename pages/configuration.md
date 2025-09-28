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
- Other variables: `PHP`, `PANDOC`, `YQ`, `BASE_URL`, `TITLE_PREFIX`, `HIGHLIGHT_STYLE`, etc.

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
