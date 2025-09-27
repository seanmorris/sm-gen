---
title: Getting Started
weight: 1
---

# Getting Started

## Prerequisites

Before you begin, ensure you have the following installed:

- **Bash** (shell, version ≥ 4.0)
- **PHP** command-line
- **yq** (YAML CLI processor)
- **Pandoc** (Markdown to HTML converter)

## Installation

1. Clone this repository:

   ```bash
   git clone https://github.com/your/repo.git
   cd repo
   ```

2. Verify dependencies are available (PHP, yq, pandoc).

- Optionally, integrate this generator into your own project directory: copy or symlink `build.sh`, `templates/`, `static/`, `helpers/`, and `.static-gen` into your site root. Then invoke the build script (`./build.sh` or `/path/to/build.sh`) from that directory; it will look for `pages/`, `templates/`, `static/`, and `.static-gen` in your current working directory.

## First build

Run the build script to generate your site (from the root of your content directory):

```bash
./build.sh
```

This will produce a `docs/` directory containing the generated HTML, which you can serve locally or deploy.

## Creating your first page

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

Save it as `pages/index.md` (or any path under `pages/`) and re-run:

```bash
./build.sh
```

This regenerates `docs/index.html` with your new content.

## Previewing locally

You can serve the `docs/` directory with a simple HTTP server. For example:

```bash
cd docs
python3 -m http.server 8000
```

Then open <http://localhost:8000> in your browser.

## Next steps

- Customize site styling via `.static-gen` or by editing `static/` CSS/JS.
- Modify templates under `templates/` or override via page front-matter (`template: ...`).
- Use front-matter fields (`weight`, `leftBarShow`, `TOC`, etc.) to control navigation and layout.