---
---
# Writing Pages

Simply create a new `.md` file in your `pages/` directory to create a page.

Once that's done you can run `smgen build` to rebuild your site, and `smgen serve` to serve it. You can also use `smgen watch` to keep a live preview in sync.

## Frontmatter

```yaml
title: <string> # Change the title of the page in the navbar, defaults to the filename
weight: <string> # The "weight" of the link in the navbar, defaults to 0
header: <filepath> # The header template to use, defaults to "templates/header.php"
footer: <filepath> # The footer template to use, defaults to "templates/footer.php"
leftBarLink: <boolean> # Whether to add this page to the left navbar. Defaults to true
leftBarShow: <boolean> # Whether to show the left navbar on this page. Defaults to true
```

## Markdown

## The Navbar

## Using Folders

```yaml
title: <string> # Change the title of the folder in the navbar, defaults to the filename
weight: <string> # The "weight" of the link in the navbar, defaults to 0
leftBarLink: <boolean> # Whether to add this directory to the left navbar. Defaults to true
```
