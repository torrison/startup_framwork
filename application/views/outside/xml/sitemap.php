<?php
header("Content-type: text/xml");

echo '<?xml version="1.0" encoding="UTF-8" ?>';

?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

	<?php foreach ($content_arr as $blog) { ?>
	<url>

      <loc>http://startup.ikiev.biz/content/al/<?=$blog['content_alias']?></loc>

      <lastmod><?php echo date('Y-m-d');?></lastmod>

    </url>
	<?php } ?>
	
</urlset>