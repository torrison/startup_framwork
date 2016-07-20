<div class="content-wrapper wrapper">
      
      <div class="container">
		<div class="float-holder">
			<div class="content_list fleft" style="">
				<h3 class="page-heading">
					<span>
					<a href="/content/plist/">Статьи</a>
					<?php if (isset($category_row)) {?>
					 : <?=$category_row['categories_name']?>
					<?php } ?>
					
					<?php if (isset($filter_tag)) {?>
					 : <?=urldecode($filter_tag)?>
					<?php } ?>
					</span>

				</h3>
				
				
				<?php if (isset($filter_tag) && ($tag_row['tags_desc'] != '')) { ?>
				<div class="plist_tag_desc">
					<?=$tag_row['tags_desc']?>
				</div>
				<?php } ?>
				<?php if (isset($category_row) && ($category_row['categories_desc'] != '')) { ?>
				<div class="plist_tag_desc">
					<?=$category_row['categories_desc']?>
				</div>
				<?php } ?>
				
		<?php foreach ($pages_list_arr as $page) { $not_empty = true;?>

							<article class="img_shadow p10 mb10">
								
								<a href="/content/al/<?=$page['content_alias']?>">
									<img class="fleft w200 img_shadow p10 m15" src="/files/uploads/content_img/<?=$page['content_img']?>" alt="<?=$page['content_name']?>" />
								</a>
								
								<h4><a href="/content/al/<?=$page['content_alias']?>"><?=$page['content_name']?></a> (<?=date("d", strtotime($page['content_create_date']));?><?=date("M", strtotime($page['content_create_date']));?>, <?=date("Y", strtotime($page['content_create_date']));?>)</h4>
								<?=$page['content_desc']?>
								
								<a href="/content/al/<?=$page['content_alias']?>" class="read-more">Подробнее... &#8594;</a>
								
								<div class="page_list_categories">
									<i class="icon-briefcase"></i>
									<?php foreach ($content_categories_arr as $content_tags) { if ($content_tags['content_id'] == $page['content_id']) { ?>
										<a href="/content/category_list/<?=$content_tags['alias']?>"><?=$content_tags['name']?></a>
									<?php } } ?>
								</div>

								<div class="tags">
									<?php foreach ($content_tags_arr as $content_tags) { if ($content_tags['content_id'] == $page['content_id']) { ?>
										<a href="/content/tag_list/<?=$content_tags['name']?>"><?=$content_tags['name']?></a>
									<?php } } ?>
								</div>
								
								<div class="clearfix"></div>
								
							</article>				
							
	<?php } ?>
			

			
						<div class="pagination">
	<?=$pagination?>
						</div>
			
			
			</div>
			
			<aside id="sidebar" class="img_shadow fleft"  style="width: 200px; background #eee;">
						
				<ul>
					<li class="block">
						<h4>Категории</h4>
						<?php echo $catalog_tree; ?>							
					</li>
					
					
				<div class="tagcloud" style="margin: auto; width: 80%;">

					<?php foreach ($tags_arr as $tag) { ?>
					<a href="/content/tag_list/<?=$tag['tags_name']?>" style="font-size: <?=rand(13, 29)?>px;"><?=$tag['tags_name']?></a>
					<?php } ?>


				</div>
				
				</ul>
				
				<em id="corner"></em>
			</aside>
			
		</div>
<?php if (!isset($not_empty)) {?>
<h3 style="margin-left:50px; margin-top: 190px;">Нет страниц в данном разделе</h3>
<?php } ?>			
		
      </div>
    </div>	  
	  
			