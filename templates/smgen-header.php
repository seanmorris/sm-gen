<section class = "heading">
	<div class = "page-rule">
		<header>
			<div class = "row wide">
				<nav>
					<a class = "logo" href = "<?=getEnv('BASE_URL');?>">
						<?php if(file_exists('static/logo.svg')): ?>
						<img src = "<?=getEnv('BASE_URL');?>/logo.svg" class = "logo-image">
						<?php endif; ?>
						<span class = "col">
							<span class = "logo-text">
								<?=getEnv('PRODUCT_NAME') ?: 'Product Name';?>
							</span>
							<?php if(getEnv('TAGLINE')): ?>
							<span class = "tagline-text"><?=getEnv('TAGLINE') ?: 'Tagline';?></span>
							<?php endif; ?>
						</span>
					</a>
				</nav>
				<div class = "header-fill">
					<div class = "search-wrapper">
						<input id = "search-query" placeholder = "search" data-search-index = "<?=getEnv('BASE_URL');?>/search.bin" data-search-results = "#search-results" />
						<ul class="search-menu" id = "search-results"></ul>
					</div>
					<div class = "links">
						<a title = "github" href = "https://github.com/seanmorris/smgen">
							<img src = "<?=getEnv('BASE_URL');?>/github-icon.png">
						</a>
					</div>
				</div>
			</div>
		</header>
	</div>
	<?php if($heroHtml??false): ?>
	<div class = "page-rule">
		<?=$heroHtml;?>
	</div>
	<?php endif; ?>
</section>
