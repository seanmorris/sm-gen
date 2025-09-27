---
title: Introduction
weight: 0
author:
    - name: Sean Morris
---

# Introduction

This project is a minimal, Bash-driven static-site generator that converts Markdown files into a fully templated HTML site. It uses:

- **Bash** scripts to orchestrate the build process.
- **PHP** for templating and helper scripts.
- **yq** to extract YAML front-matter.
- **Pandoc** to render Markdown to HTML.

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