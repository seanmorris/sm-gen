---
title: Project Structure
weight: 3
---

# Project Structure

This repository is organized as follows:

- **build.sh** — main build script orchestrating asset copy, page rendering, and sitemap generation.
- **pages/** — Markdown source files with optional YAML front-matter.
- **templates/** — PHP + Pandoc templates for page layout.
- **helpers/** — PHP helper scripts (navigation bar, sitemap).
- **static/** — static assets (CSS, JavaScript, images).
- **docs/** — generated output directory.
- **.static-gen** — optional configuration overrides.
- **DRAFT.md** — checklist for the documentation pages.
- **.editorconfig** — formatting rules.