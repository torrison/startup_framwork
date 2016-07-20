	
	<script type="text/javascript" src="/files/highslide/highslide-with-gallery.js"></script>
	
	<?php if ($page_row['content_order'] == '1') $this->load->view('outside/parts/content_order_footer'); ?>
	
	<script type="text/javascript">
	hs.graphicsDir = '/files/highslide/graphics/';
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.outlineType = 'rounded-white';
	hs.fadeInOut = true;
	//hs.dimmingOpacity = 0.75;

	// Add the controlbar
	hs.addSlideshow({
		//slideshowGroup: 'group1',
		interval: 5000,
		repeat: false,
		useControls: true,
		fixedControls: 'fit',
		overlayOptions: {
			opacity: 0.75,
			position: 'bottom center',
			hideOnMouseOut: true
		}
	});
	</script>
	<script>
	
		$(function(){
			<?php if (isset($buy_block_arr[0])) { ?>
			$('#modal1 .btn-primary').on('click', function(){
			  

				if ($('.modal1_name').val() == '') $('.modal1_form_info_div').html('<span class="red">Имя не может быть пустым!</span>');
				else if ($('.modal1_phone').val() == '') $('.modal1_form_info_div').html('<span class="red">Телефон не может быть пустым!</span>');
				else if ($('.modal1_email').val() == '') $('.modal1_form_info_div').html('<span class="red">E-mail не может быть пустым!</span>');
				else {
					var button = $(this);
					var options = { 				
						url: "/ajax_api/add_request",
						success: function(data) {
							
							var obj = jQuery.parseJSON(data);
							if (obj.status == "success") {
								button.hide();
								$('.modal1_form_info_div').html('<span class="green">Ваша заявка отправлена наш менеджер свяжется с вами в ближайшее время!</span>');
							} else {
								$('.modal1_form_info_div').html('<span class="red">Данные не сохранены, попробуйте еще раз!</span>');
							}
						}
					}
					$(".request_index").ajaxSubmit(options);
								}
			  });
			<?php } ?>
			
			$('#comment_post').on('click', function(){

				
				if ($('#comment').val() == '') {
					$('#comment').addClass('red_border'); 
					$('.comment_msg').removeClass('green');
					$('.comment_msg').addClass('red');
					$('.comment_msg').html('Комментарий не может быть пустым!');
				}
				else {
					var options = { 				
						url: "/content/ajax_add_comment/",
						success: function(data) {
							var obj = jQuery.parseJSON(data);
							if (obj.status == "success") {
														
								$('.comment_msg').removeClass('red');
								$('.comment_msg').addClass('green');
								$('.comment_msg').html(obj.message);
								$('#comment_post').hide();
							} else {
								$('.comment_msg').removeClass('green');
								$('.comment_msg').addClass('red');
								$('.comment_msg').html(obj.message);

							}
						}
					};
					$("#comment_form").ajaxSubmit(options);
				}
			});
		
			$("#comment_reg_btn").on('click', function() {
	
				$("body").animate({"scrollTop":0},500);
				if (!$("#auth_modal").is(':visible')) $('.login_btn').click();
		
			});
		
		});
	
	</script>