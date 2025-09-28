---
title: FAQ & Troubleshooting
weight: 7
---

# FAQ & Troubleshooting

### Q: I get an error “php is required.”?

Ensure PHP CLI is installed and `php` is on your PATH.

### Q: I get yq: Error running jq: ParserError: did not find expected &lt;document start&gt;

You've got `jq` installed, and its aliased to `yq`. You need the actual `yq` binary:

```bash
YQ_VERSION=v4.47.2
wget -qO /usr/local/bin/yq https://github.com/mikefarah/yq/releases/download/${YQ_VERSION}/yq_linux_amd64
chmod +x /usr/local/bin/yq
```

### Q: Front-matter isn’t being applied?

Check that your YAML block is enclosed between `---` markers at the top of the file.

### Q: Custom CSS/JS not loading?

Verify your `STYLES` or `JAVASCRIPTS` variables and correct paths in `.smgen-rc`.

### Other Tips

- Use `set -x` in `smgen.sh` to debug build steps.
- Ensure `yq` version supports `--front-matter=extract`.
