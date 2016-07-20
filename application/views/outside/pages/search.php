<div class="content-wrapper wrapper">
      
    <div class="container">
		<h3>Поиск: "<?=$text?>"</h3>
		
		<form class="form-search" method="get" action="/search/">
		  <div class="input-append">
			<input type="text" name="text" class="span2 search-query" value="<?=$text?>">
			<button type="submit" class="btn"><i class="icon-search"></i> Найти </button>
		  </div>				  
		</form>

		<br />
		<h4>Статьи:</h4>
		<br />

		<?php foreach ($content_arr as $content) { $pages_no_empty = true; $content['content_name'] = str_ireplace($text, "<strong>{$text}</strong>", $content['content_name']); ?>
		- <a href="/content/al/<?=$content['content_alias']?>"><?=$content['content_name']?></a><br />
		<?php } if (!isset($pages_no_empty)) echo "Не найдено совпадений.<br />";?>

	</div>
</div>