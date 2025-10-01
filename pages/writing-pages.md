
# Writing Pages

Simply create a new `.md` file in your `pages/` directory to create a page.

Once that's done you can run `smgen build` to rebuild your site, and `smgen serve` to serve it. You can also use `smgen watch` to keep a live preview in sync.

## Frontmatter

Markdown pages can have YAML frontmatter. Frontmatter **MUST** be the first characters that appear in the file and **MUST** begin and end with `---` on it own line, with no characters before or after. After the closing `---` line, markdown can proceed as normal.

Markdown pages

```yaml
---
title: <string> # Change the title of the page in the navbar, defaults to the filename
weight: <string> # The "weight" of the link in the navbar, defaults to 0

leftBarLink: <boolean> # Whether to add this page to the left navbar. Defaults to true
leftBarShow: <boolean> # Whether to show the left navbar on this page. Defaults to true

header: <filepath> # The header template to use, defaults to "templates/header.php"
footer: <filepath> # The footer template to use, defaults to "templates/footer.php"

noSearch: <boolean> # Suppress this page from search defaults to FALSE
---
```

## Markdown

Markdown is a simple language to write. There is a good guide on [markdownguide.org](https://www.markdownguide.org/basic-syntax/) if you'd like to brush up.

For reference, here is a small snippet from the beginning of the [FAQ page](faq.html):

```markdown
---
title: FAQ & Troubleshooting
weight: 5
---

# FAQ & Troubleshooting

### Q: I get an error “php is required.”?

Ensure PHP CLI is installed and `php` is on your PATH.

### Q: I get an error “pandoc is required.”?

Ensure Pandoc is installed and `pandoc` is on your PATH.
```

## Adding Frontmatter to Folders

You can creat `.fm.yaml` files along side your markdown files to add metadata to your nested directories. Subfolders can make use of the following frontmatter vars to influence the rendering of the navbar:

```yaml
---
title: <string> # Change the title of the folder in the navbar, defaults to the filename
weight: <string> # The "weight" of the link in the navbar, defaults to 0

open: <boolean> # Whether the folder should be open by default upon page load. Defaults to true.
leftBarLink: <boolean> # Whether to add this directory to the left navbar. Defaults to true
---
```
