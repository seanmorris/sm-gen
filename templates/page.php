<?php
$frontmatter = yaml_parse(`yq --front-matter=extract $argv[1] 2>/dev/null || echo ""`) ?? [];

$headerTemplate = $frontmatter['header'] ?? 'templates/header.php';
$footerTemplate = $frontmatter['footer'] ?? 'templates/footer.php';

$leftBarLink = $frontmatter['leftBarLink'] ?? TRUE;
$leftBarShow = $frontmatter['leftBarShow'] ?? TRUE;

?><!DOCTYPE HTML>
<html lang = "en" class = "theme-cosmic dark">
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
$if(canonical)$
	<link rel="canonical" href="$canonical$" />
$endif$
	<meta name="title" content="$if(pagetitle)$${pagetitle}$else$${title}$endif$">
	<link rel="icon" type="image/x-icon" href="<?=getenv('BASE_URL');?>/favicon.ico">
	<link rel="sitemap" href="/sitemap.xml" />
<?php if(file_exists('static/logo.svg')): ?>
	<link rel="preload" href="/logo.svg" as="image" type="image/svg">
<?php endif; ?>
<?php if(file_exists('static/bg.svg')): ?>
	<link rel="preload" href="/bg.svg" as="image" type="image/svg">
<?php endif; ?>
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
<?php if(getEnv('JAVASCRIPTS')) foreach(explode(PHP_EOL, getEnv('JAVASCRIPTS')) as $javascript):?>
	<script src = "<?=$javascript;?>"></script>
<?php endforeach; ?>
<?php if(getEnv('INLINE_JAVASCRIPTS')) foreach(explode(PHP_EOL, getEnv('INLINE_JAVASCRIPTS')) as $javascriptFile):?>
	<script><?=file_get_contents($javascriptFile);?></script>
<?php endforeach; ?>
</head>
<body>
	<?php include $headerTemplate; ?>
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
	<?php include $footerTemplate; ?>
<?php if(getEnv('BODY_JAVASCRIPTS')) foreach(explode(PHP_EOL, getEnv('BODY_JAVASCRIPTS')) as $javascript):?>
	<script src = "<?=$javascript;?>"></script>
<?php endforeach; ?>
<?php if(getEnv('INLINE_BODY_JAVASCRIPTS')) foreach(explode(PHP_EOL, getEnv('INLINE_BODY_JAVASCRIPTS')) as $javascriptFile):?>
	<script><?=file_get_contents($javascriptFile);?></script>
<?php endforeach; ?>
	</body>
</html>
