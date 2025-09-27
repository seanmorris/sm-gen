---
title: FAQ & Troubleshooting
weight: 7
---

# FAQ & Troubleshooting

### Q: I get an error “php is required.”?

Ensure PHP CLI is installed and `php` is on your PATH.

### Q: Front-matter isn’t being applied?

Check that your YAML block is enclosed between `---` markers at the top of the file.

### Q: Custom CSS/JS not loading?

Verify your `STYLES` or `JAVASCRIPTS` variables and correct paths in `.static-gen`.

### Other Tips

- Use `set -x` in `build.sh` to debug build steps.
- Ensure `yq` version supports `--front-matter=extract`.