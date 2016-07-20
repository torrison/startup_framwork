<div class="content-wrapper wrapper">
      
    <div class="container">

	  <div class="sitemap_holder p20">
	    <h3>Карта сайта</h3>

		<br />
		<h4>Контент:</h4>
		<br />

		<?php foreach ($content_arr as $content) { ?>
		- <a href="/content/al/<?=$content['content_alias']?>"><?=$content['content_name']?></a><br />
		<?php } ?>
	  </div>
	</div>
</div>