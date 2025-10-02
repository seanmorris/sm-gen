<footer class="footer">
	<div class = "page-rule row">
		<div class = "col">
			<span>&copy; <?=date('Y');?> <?=getEnv('ORGANIZATION') ?: 'Organization Name';?></span>
			<a href = "<?=getenv('BASE_URL');?>/sitemap.xml" target = "_blank">
				<img src = "<?=getenv('BASE_URL');?>/sitemap-badge.png" alt = "sitemap" width = "80" height = "15" alt = "xml sitemap badge">
			</a>
		</div>
	</div>
</footer>
