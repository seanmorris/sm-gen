---
title: Customization
weight: 4
---

# Customization

Customize your site appearance and behavior:

## Themes, CSS, and JS Injection

Use front-matter or `.smgen-rc` to add custom styles and scripts. For example, if you have files under `static/`:

```css
/* static/example.css */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f9f9f9;
    max-width: 60rem;
    margin: auto;
}

.active-link {
    color: #d33;
    text-decoration: underline;
}
```

```js
// static/example.js
document.addEventListener('DOMContentLoaded', function() {
    console.log('Example.js loaded');
    document.querySelectorAll('a').forEach(function(el) {
        el.addEventListener('click', function() {
            console.log('Link clicked:', el.href);
        });
    });
});
```

Then inject them into your build via `.smgen-rc`:

```bash
STYLES=$(cat <<-END
    /example.css
END
)

JAVASCRIPTS=$(cat <<-END
    /example.js
END
)
```

These will insert `<link rel="stylesheet" href="/example.css">` in the header and `<script src="/example.js"></script>` before `</body>`.

To inline files directly in the HTML (rather than referencing them), use the `INLINE_STYLES` and `INLINE_JAVASCRIPTS` variables:

```bash
INLINE_STYLES=$(cat <<-END
    /inline.css
END
)

INLINE_JAVASCRIPTS=$(cat <<-END
    /inline.js
END
)
```

With these set, the contents of `/inline.css` will be embedded inside a `<style>` tag in the `<head>`, and `/inline.js` contents will be embedded inside a `<script>` tag before `</body>`.

## Template Fallback Logic

The build script selects templates based on front-matter or file extension:

1. Front-matter field `template`.
2. Default `templates/page.php`.
3. Extension-specific `templates/<ext>-page.php` or `.html`.

## Navigation Customization

Use YAML front-matter fields in pages or directory-level `.fm.yaml` files to control the left sidebar navigation. The helper script reads these fields when building the nav bar:

- `weight` — numeric weight for ordering pages and sections (lower values appear first).
- `title` — override the link text for a page or section heading.
- `leftBarLink` — set to `false` to omit a specific page or directory from the nav.
- `leftBarShow` — set to `false` in a page’s front-matter to hide the entire sidebar on that page.

### Examples

Front-matter in an individual page (`foo.md`):
```yaml
---
title: "My FAQ"
weight: 100
leftBarLink: false
leftBarShow: false
---
```

Directory-level settings (`pages/guides/.fm.yaml`):
```yaml
title: "Guides & Tutorials"
weight: 50
leftBarLink: true
```

## Table of Contents Settings

Control the TOC with front-matter `TOC` (true/false) or omit to let default TOC injection.
