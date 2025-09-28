<section class = "heading">
	<div class = "page-rule">
		<nav>
			<a class = "logo" href = "<?=getEnv('BASE_URL');?>">
				<?php if(file_exists('static/logo.svg')): ?>
				<img src = "<?=getEnv('BASE_URL');?>/logo.svg" class = "logo-image">
				<?php endif; ?>
				<span class = "col">
					<span class = "logo-text">
						<?=getEnv('PRODUCT_NAME') ?: 'Product Name';?>
					</span>
					<span class = "tagline-text"><?=getEnv('TAGLINE') ?: 'Tagline';?></span>
				</span>
			</a>
		</nav>
		<?=$heroHtml??'';?>
	</div>
</section>
<hr />
