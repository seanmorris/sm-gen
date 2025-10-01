<?php

function makeNavBar($path, $rootPath = NULL, $idPath = '')
{
	$rootPath = $rootPath ?? $path;
	$directories = [];
	$files = [];

	?><ul><?php

	$dir = new \DirectoryIterator($path);

	foreach($dir as $entry)
	{
		$filename = $entry->getFilename();
		$pathname = $entry->getPathname();

		if($filename[0] === '.')
		{
			continue;
		}

		if(is_dir($pathname))
		{
			$frontmatter = [];

			if(file_exists($pathname . '/.fm.yaml'))
			{
				$frontmatter = yaml_parse(`yq --front-matter=extract $pathname/.fm.yaml 2>/dev/null|| echo ""`) ?? [];
			}

			if(!($frontmatter['leftBarLink'] ?? true))
			{
				continue;
			}

			$directories[] = (object)[
				'type' => 'DIR',
				'filename' => $filename,
				'pathname' => $pathname,
				'frontmatter' => $frontmatter
			];

			continue;
		}

		$file = fopen($pathname, 'r');
		$first = fgets($file);

		$frontmatter = [];

		if($first === "---\n")
		{
			$frontmatter = yaml_parse(`yq --front-matter=extract $pathname 2>/dev/null || echo ""`) ?? [];

			if(!($frontmatter['leftBarLink'] ?? true))
			{
				continue;
			}

			$frontmatter['weight'] = ($frontmatter['weight'] ?? 0) + 1000;
		}

		$files[] = (object)[
			'type' => 'FILE',
			'filename' => $filename,
			'pathname' => $pathname,
			'frontmatter' => $frontmatter
		];
	}

	$entries = [...$directories, ...$files];

	usort($entries, function($a, $b){
		$wa = (float) ($a->frontmatter['weight'] ?? 0);
		$wb = (float) ($b->frontmatter['weight'] ?? 0);

		if($wa === $wb)
		{
			return strcmp($a->filename, $b->filename);
		}

		return $wa - $wb;
	});

	foreach($entries as $index => $entry)
	{
		$type = $entry->type;
		$filename = $entry->filename;
		$pathname = $entry->pathname;
		$frontmatter = $entry->frontmatter;

		if($type === 'DIR')
		{
			$title = $frontmatter['title'] ?? ucwords(trim(str_replace('-', ' ', basename($filename))));
			$open = ($frontmatter['open'] ?? true) ? 'open' : '';
			$idSubPath = $idPath . ($idPath ? '-' . $index : $index);

			?><details <?=$open;?> data-id-path = "<?=$idSubPath;?>">
				<summary><?=$title;?></summary>
				<?=makeNavBar($pathname, $rootPath, $idSubPath);?>
			</details><?php
		}
		else if($type === 'FILE')
		{
			$filename = $entry->filename;
			$pathname = $entry->pathname;
			$frontmatter = $entry->frontmatter;

			$title = $frontmatter['title'] ?? ucwords(preg_replace(['/\.md$/', '/-/'], ['',  ' '], $filename));
			$linkPath = preg_replace('/\.\w+$/', '.html', substr($pathname, strlen($rootPath)));

			?><li>
				<a href = "<?=getenv('BASE_URL') . $linkPath;?>" <?= getenv('CURRENT_PAGE') === $linkPath ? 'class="active-link"' : ''; ?>>
					<?=$title?>
				</a>
			</li><?php
		}
	}

	?></ul><?php
}

makeNavBar(getenv('PAGES_DIR'));
