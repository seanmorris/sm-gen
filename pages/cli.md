---
title: CLI Reference
weight: 1
---

# CLI Reference

Use the `smgen` command to manage your static site. The basic usage is:

```bash
smgen <command>
```

You can also get help via:

```bash
smgen help
```
## smgen init

Initialize a new site in current directory. **This command will fail if run in a non-empty directory.**

```bash
smgen init
```

This command will create the following folders in the current directory:

```bash
docs/
pages/
static/
templates/
```

It will also create the following files:

```bash
.smgen-rc
static/main.js
static/default.css
templates/page.php
templates/header.php
templates/footer.php
pages/index.md
```

The `pages/index.md` file will contain random lipsum markdown.

## smgen build

Build the site from Markdown to HTML.

```bash
smgen build
smgen build <file>
```

## smgen watch

Start a dev server & build pages & copy assets on filesystem changes.

**Requires inotifytools.**

```bash
smgen watch
```

You can configure the port used using DEV_PORT in .smgen-rc:

```bash
DEV_PORT=8080 # Default 8000
```

## smgen serve

Serve the site locally without running the file watcher.

```bash
smgen watch
```

`DEV_PORT` also applies here.


## smgen create-random-page

Create a random lorem ipsum markdown page.

```bash
smgen create-random-page
```

## smgen help

Show the help message.

```bash
smgen help
```
