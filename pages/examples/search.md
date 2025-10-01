---
title: Search Integration Example
---

# Search Integration Example

This example demonstrates how to add full-text search to your site using [smgen-search](https://www.npmjs.com/package/smgen-search).

## Prerequisites

- [Node.js](https://nodejs.org/) (v14 or later)
- [yq](https://github.com/mikefarah/yq)
- [smgen-search CLI](https://www.npmjs.com/package/smgen-search)

## 1. Install `smgen-search`

Install the search tooling globally:

```bash
npm install -g smgen-search
```

## 2. Configure the search index build

Create a `before-smgen.sh` hook in your project root to generate a binary search index before each build:

```bash
#!/usr/bin/env bash
smgen-search build-index pages static/search.bin
```

Make the hook executable:

```bash
chmod +x before-smgen.sh
```

This will populate `static/search.bin`, which is automatically copied into your output directory on `smgen build`.

## 3. Enable the search UI

The default templates include a search input in `templates/header.php` and client-side logic in `static/main.js` to load and query the index. By default, the header contains:

```php
<input id="search-query"
       placeholder="search"
       data-search-index="<?=getEnv('BASE_URL');?>/search.bin" />
<ul class="search-menu" id="search-results"></ul>
```

Below is a browser example showing how to fetch and use the binary index with `SearchReader`:

```html
<script type="module">
  import { SearchReader } from 'https://cdn.jsdelivr.net/npm/smgen-search/SearchReader.mjs';

  (async function initSearch() {
    const input = document.querySelector('#search-query');
    const resultsList = document.querySelector('#search-results');
    const baseUrl = document
      .querySelector('meta[name="smgen-base-url"]')
      .getAttribute('content');

    // Load the prebuilt index
    const resp = await fetch(input.getAttribute('data-search-index'));
    const buffer = await resp.arrayBuffer();
    const reader = new SearchReader(buffer);

    input.addEventListener('input', () => {
      const q = input.value.trim();
      resultsList.innerHTML = '';
      if (q.length < 3) return;

      // Search threshold: lower values yield more results (0.0 = all)
      const results = reader.search(q, 0.5);
      if (!results.length) {
        resultsList.innerHTML = '<li>No results.</li>';
        return;
      }

      for (const [doc, score] of results) {
        const li = document.createElement('li');
        const a = document.createElement('a');
        a.textContent = doc.title;
        a.href = `${baseUrl}/${doc.path}.html`;
        li.appendChild(a);
        resultsList.appendChild(li);
      }
    });
  })().catch(console.error);
</script>
```

## 4. Build and test

Run the standard build command:

```bash
smgen build
```

Open your site in a browser and try typing in the search box in the header. Results will appear as you type.

## Further reading

For full details on building and querying the index, see the [smgen-search README](https://cdn.jsdelivr.net/npm/smgen-search/README.md).
