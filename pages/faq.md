---
title: FAQ & Troubleshooting
weight: 5
---

# FAQ & Troubleshooting

### Q: I get an error “php is required.”?

Ensure PHP CLI is installed and `php` is on your PATH.

### Q: I get an error “pandoc is required.”?

Ensure Pandoc is installed and `pandoc` is on your PATH.

### Q: I get yq: Error running jq: ParserError: did not find expected &lt;document start&gt;

You've got `jq` installed, and it's aliased to `yq`. You need the actual `yq` binary:

```bash
YQ_VERSION=v4.47.2
wget -qO /usr/local/bin/yq https://github.com/mikefarah/yq/releases/download/${YQ_VERSION}/yq_linux_amd64
chmod +x /usr/local/bin/yq
```

### Q: I get an error “uuid is required.”?

Ensure `uuid` is installed and on your PATH.

### Q: I get strange YAML errors on pages with no frontmatter?

There seems to be a bug somewhere in the stack when the Markdown file uses `---` for horizontal rules (`<hr />` tags). You can work around this issue by using the equivalent `***` notation to achieve the same end result.

### Q: Front-matter isn’t being applied?

Check that your YAML block is enclosed between `---` markers at the top of the file.

### Q: Custom CSS/JS not loading?

Verify your `STYLES` or `JAVASCRIPTS` variables and correct paths in `.smgen-rc`.

### Q: smgen watch fails or is unavailable?

The `smgen watch` command relies on the Linux `inotify-tools` package for filesystem events. On systems without `inotify-tools` support (e.g., macOS), the watcher is not available. You can still use `smgen serve` and manually rebuild with `smgen build`, or install `inotify-tools` on Linux (`apt install inotify-tools`, `dnf install inotify-tools`, `pacman -S inotify-tools`).

### Q: How do I install the PHP YAML extension?

Make sure the PHP YAML extension is installed so that SMGen can parse YAML front-matter. On most Linux distros install the `php-yaml` package (e.g., `apt install php-yaml`, `dnf install php-yaml`, `pacman -S php-yaml`). On macOS, use shivammathur’s taps:

```bash
brew tap shivammathur/php
brew tap shivammathur/extensions
brew install shivammathur/extensions/yaml@<php-version>
```

### Other Tips

- Use `set -x` in `smgen` to debug build steps.
- Ensure `yq` version supports `--front-matter=extract`.
