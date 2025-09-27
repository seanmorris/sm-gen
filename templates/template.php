<?php
$frontmatter = yaml_parse(`yq --front-matter=extract $argv[1] 2>/dev/null || echo ""`) ?? [];
$leftBarLink = $frontmatter['leftBarLink'] ?? TRUE;
$leftBarShow = $frontmatter['leftBarShow'] ?? TRUE;
?><!DOCTYPE HTML>
<html lang = "en">
<head>
	$if(noprefix)$
	<title>$if(pagetitle)$${pagetitle}$else$${title}$endif$</title>
	$else$
	$if(title-prefix)$
	<title>$if(title-prefix)$${title-prefix} | $endif$$if(pagetitle)$${pagetitle}$else$${title}$endif$</title>
	$else$
	<title>$if(pagetitle)$${pagetitle}$else$${title}$endif$</title>
	$endif$
	$endif$
	<meta charset="utf-8" />
	<meta name="viewport" content="width=800, user-scalable=yes" />
$for(author)$
	<meta name="author" content="$author.name$" />
$endfor$
$if(date-meta)$
	<meta name="dcterms.date" content="$date-meta$" />
$endif$
$if(keywords)$
	<meta name="keywords" content="$for(keywords)$$keywords$$sep$, $endfor$" />
$endif$
$if(description-meta)$
	<meta name="description" content="$description-meta$" />
$endif$
	<?php if(getEnv('BASE_URL')): ?>
	<base href="<?=getEnv('BASE_URL');?>">
	<?php endif; ?>
$if(canonical)$
	<link rel="canonical" href="$canonical$" />
$endif$
	<meta name="title" content="$if(pagetitle)$${pagetitle}$else$${title}$endif$">
	<link rel="sitemap" href="/sitemap.xml" />
	<style>
		$styles.html()$
	</style>
$for(css)$
	<link rel="stylesheet" href="${css}" />
$endfor$
	<style>
$for(header-includes)$
	$header-includes$
$endfor$
	</style>
$if(math)$
	$math$
$endif$
</head>
<body>
	<section class = "heading">
		<div class = "page-rule">
			<nav>
				<a href = "/">
					Home
				</a>
			</nav>
			<?=$heroHtml??'';?>
		</div>
	</section>
	<hr />
	<section class = "below-fold">
		<div class = "page-rule">
			<?php if($leftBarShow ?? true): ?>
				<nav class = "main"><?php include 'navbar.php'; ?></nav>
			<?php endif; ?>
			<div class = "page-content">
				<article $if(itemtype)$ itemscope itemtype = "https://${itemtype}" $endif$>
				$for(microdata/pairs)$
				<meta itemprop = "${microdata.key}" content = "${microdata.value}" />
				$endfor$
				$body$
				</article>
				$if(toc)$
				<nav class = "table-of-contents">
					<span class = "wide-only">on this page:</span>
					${toc}
					<span class = "wide-only"><a href = "#">top</a></span>
				</nav>
				$endif$
			</div>
		</div>
	</section>

	<footer class="footer">
		$if(author/last)$
		<p>&copy; 2024 - <?=date('Y');?> $for(author)$ <span class = "author">$author.name$</span> $endfor$</p>
		$endif$
	</footer>
</body>
</html>
