---
title: Advanced Usage
weight: 5
---

# Advanced Usage

## Writing Your Own Templates

This project uses PHP+Pandoc templates to wrap your Markdown content in HTML. Templates are a blend of Pandoc template variables (e.g. `$body$`, `$title$`, `$pagetitle$`, `$styles.html()$`, `$for(css)$…`) and PHP code. To create a custom template:

1. Copy the default `templates/template.php` to a new file (e.g. `templates/my-template.php`).
2. Modify the HTML and Pandoc placeholders as needed.
3. In your page’s YAML front-matter, set the `template` field. For example:

   ```markdown
   ---
   title: Custom Template Example
   template: templates/my-template.php
   ---

   # My Page Heading
   This page uses the custom template specified above.
   ```

Pandoc will use your custom template when rendering that page. You can also create extension-specific templates named `<ext>-template.php` (or `.html`) in the `templates/` directory and the build script will pick them up automatically.

Below is a minimal example:

```php
<?php
// templates/my-template.php
?>
<!DOCTYPE html>
<html>
<head>
  <title>$if(pagetitle)$${pagetitle}$else$${title}$endif$</title>
  $for(css)$<link rel="stylesheet" href="$css$" />$endfor$
  $styles.html()$
</head>
<body>
  <?php include 'navbar.php'; ?>
  $body$
</body>
</html>
```

## Front-matter Fields

Leverage custom fields in YAML front-matter to pass variables into templates.

## Custom Templates per Extension

Place extension-specific templates:

- `templates/md-template.php`
- `templates/html-template.html`

## HTML Partial Includes

Use PHP includes inside templates for reusable markup snippets.

## Internationalization

Consider generating per-language subdirectories and leveraging front-matter to set `lang` attributes.