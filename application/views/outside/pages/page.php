<div class="content-wrapper wrapper">
      
      <div class="container">

		<div class="content img_shadow top20 p10_20">	
			<?php if ($page_row['content_type'] != '2') { ?>
			<p class="bread_crumbs"><a href="/">Главная</a> &gt; <a href="/content/plist/">Статьи</a> &gt; <?=$page_row['content_name']?></p>
			<?php } ?>
			<h3><?=$page_row['content_name']?></h3>
			
			<?php if ($page_row['content_type'] != '2') { ?>
			<div class="page-info">Дата: <i><?=$page_row['content_create_date']?></i> от <a><?=$page_row['email']?></a>
			в		
				<?php foreach ($content_categories_arr as $content_tags) { if ($content_tags['content_id'] == $page_row['content_id']) { ?>
					<a href="/content/category_list/<?=$content_tags['alias']?>"><?=$content_tags['name']?></a>
				<?php } } ?>
										
			</div>	
			<?php } ?>
			<br/>
			<?=$page_row['content_html']?>
			
			<?php if (isset($buy_block_arr[0])) { ?>
			
			<div class="to_do_info img_shadow p20 top20">
				<iframe class="img_shadow left10" align="right" width="325" height="190" src="//www.youtube.com/embed/ZBHWAY7-cwg?list=PLF7B92F492FDAE703" frameborder="0" allowfullscreen></iframe>
				<h2><?=$buy_block_arr[0]['buy_block_name']?></h2>
				<?=$buy_block_arr[0]['buy_block_html']?>
				<br/><br/>
				<a class="btn btn-success btn-large" href="#modal1" role="button" data-toggle="modal"><?=$buy_block_arr[0]['buy_block_button_text']?></a>

				<!-- Modal -->
				<div id="modal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">Форма заказа услуги "Сайт визитка"</h3>
				  </div>
				  <div class="modal-body">
					
					<div class="modal1_form_info_div fright w180 img_shadow p10">
					
						Заполните форму и отправте заявку, нажав синюю кнопку "Отправить заявку".
					
					</div>
					<form class="request_index" name="request_index" method="post">

						<span class="input_text w80">Имя:</span><input type="text" value="" name="name" class="modal1_name" placeholder="Введите ваше имя" /><br />
						<span class="input_text w80">Телефон:</span><input type="text" value="" name="phone" class="modal1_phone" placeholder="Введите номер телефона" /><br />
						<span class="input_text w80">E-mail:</span><input type="text" value="" name="email" class="modal1_email" placeholder="Введите email" /><br />
						<span class="bold">Доп. информация:</span><br/>
						<textarea class="modal_textarea" name="info"></textarea>
						<?php if ($user) { ?>
						<input type="hidden" value="<?=$user->id?>" name="user_id" />
						<?php } ?>
						<input type="hidden" value="<?=$_SERVER["REQUEST_URI"]?>" name="url" />
					</form>
				  </div>
				  <div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button>
					<button class="btn btn-primary">Отправить заявку</button>
				  </div>
				</div>
				
				<div class="clearfix"></div>
			</div>
			<?php } ?>
			
			
			<?php if (isset($info_block_arr[0])) { ?>
			<div class="info_blocks_holder">
			
				<?php foreach ($info_block_arr as $info_block) { ?>
				<a class="info_block box_shadow2" <?php if ($info_block['info_block_link'] != '') echo ' href="'.$info_block['info_block_link'].'"' ?> target="_blank">
					<h4><?=$info_block['info_block_name']?></h4>
					<img class="img_shadow" src="/files/uploads/adv_img/<?=$info_block['info_block_img']?>" class="" />
					<div class="info_block_desc">
						<?=$info_block['info_block_html']?>
					</div>
				</a>		
				<?php } ?>			
							
			</div>
			<?php } ?>
			
			
			<?php if (isset($images_arr[0])) { ?>
			<br/>
			<h4 class="page-heading center"><span>Фото/Изображения по данному материалу</span></h4>
			
			<div class="highslide-gallery img_shadow p10">
			
				<?php foreach ($images_arr as $image) { ?>
				<a href="/files/uploads/adv_img/<?=$image['images_img']?>" class="highslide" onclick="return hs.expand(this)">
					<img src="/files/uploads/adv_img/<?=$image['images_mini_img']?>" alt="<?=$image['images_mini_img']?>"
						title="Click to enlarge" />
				</a>

				<div class="highslide-caption">
					<?=$image['images_desc']?>
				</div>

				<?php } ?>
				
			</div>

			<?php } ?>

            <?php if (isset($similar_pages_arr[0])) { ?>
                <br/>
                <h4 class="page-heading center"><span>Другие похожие страницы</span></h4>
                <div class="links_holder img_shadow p10">
                    <?php foreach ($similar_pages_arr as $link) { ?>
                        <a href="/content/al/<?=$link['content_alias']?>"><?=$link['content_name']?></a><br/>
                    <?php } ?>
                </div>
            <?php } ?>


			<?php if (isset($links_arr[0])) { ?>
			<br/>
			<h4 class="page-heading center"><span>Полезные ссылки</span></h4>
			<div class="links_holder img_shadow p10">
				<?php foreach ($links_arr as $link) { ?>
				<a target="_blank" href="<?=$link['links_url']?>"><?=$link['links_name']?></a> - <?=$link['links_desc']?>
				<?php } ?>
			</div>
			<?php } ?>
			
			<?php if ($page_row['content_order'] == '1') $this->load->view('outside/parts/content_order'); ?>
			
			<br/>
			<?php if ($page_row['content_type'] != '2') { ?>	
				<div class="categories_holder" style="float: left;">
					<i class="icon-tags"></i>
				<?php foreach ($content_tags_arr as $content_tags) { if ($content_tags['content_id'] == $page_row['content_id']) { ?>
					<a href="/content/tag_list/<?=$content_tags['name']?>"><?=$content_tags['name']?></a>
				<?php } } ?>
				</div>
			<?php } ?>											
			<div class="share42init" style="float: right;"></div>
			
			
			<div class="clearfix"></div>
			
			

			<?php if ($page_row['content_type'] != '2') { ?>
			<h4>Комментарии</h4>
								   
				<?php foreach ($comments_arr as $comment) { ?>
				<div class="comment img_shadow p10 mb10">
					<div class="fleft ava_comm_holder">
						<?php if ($comment['avatar'] == '') $comment['avatar'] = 'no_ava.png'?>
						<img class="img_shadow mr10 avatar avatar-35 photo" alt='' src='/files/uploads/users_img/<?=$comment['avatar']?>' style='height:50px;' />      
					</div>
					<?php 
						if ($comment['username'] != '') { 
							$name = $comment['username'];
							
						} elseif ($comment['first_name'] != '') {
							$name = $comment['first_name'];
						}
						else {
							$name = explode("@", $comment['email']);
							$name = $name[0];
						}
					?>
					<b><?=$name?></b>, <span class="comment-date"><?=date('d.m.Y', $comment['comments_datetime'])?></span>
					
					<p><?=$comment['comments_text']?></p>

					<div class="clearfix"></div>
				</div>
				<?php } ?>

				
			<form method="post" id="comment_form" class="style_form">
							
			<?php if (!$user) { ?><textarea name="comment" id="reg_text_area" class="textarea_base comments_textarea" placeholder="Сюда пишите свой коммент..."  tabindex="4" disabled="disabled"></textarea>
			<div class="reg_user_slogan">
				<p>Комментировать могут только зарегистрированные пользователи 
					<br /><br />
					<a id="comment_reg_btn" class="btn btn-primary">Вход / Регистрация</a>
				</p>
			</div><?php } else { ?>
			
			<textarea name="comment" id="comment" class="textarea_base comments_textarea" placeholder="Сюда пишите свой коммент..."  tabindex="4" ></textarea>
				<div class="comment_msg"></div>
				<a id="comment_post" class="btn btn-primary"><span>Отправить</span></a>
			
			<?php } ?>
			<div class="clearfix"></div>
					
			<input type="hidden" name="page_url" value='http://vizitka.ikiev.biz/content/al/<?=$page_row['content_alias']?>' />
			<input type="hidden" name="page_id" value='<?=$page_row['content_id']?>' />
	
			</form>
				
			<?php } ?>										
		</div>
			
      </div>
    </div>
	
<div class="text-wrapper wrapper">
      
    <div class="container">
	<?php if ($seo_block_html) { ?>
		<br/><br/>
		<?php echo $seo_block_html['seo_blocks_html'];?>
	<?php } ?>
	</div>
</div>