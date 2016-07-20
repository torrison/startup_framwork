<script>
	
	 $(function(){

		$('.change_pass').on('click', function(){
			var options = {
 				url: "/auth_api/change_password/",
 				success: function(data) {
					var obj = jQuery.parseJSON(data);

					if (obj.status == "success") {

						$('.ch_pass_msg').removeClass('red');
						$('.ch_pass_msg').addClass('green');
						$('.ch_pass_msg').html(obj.message);
						$('#old_password').removeClass('red_border');
						$('#new_password').removeClass('red_border');
						$('#confirm_password').removeClass('red_border');
						$('#email').removeClass('red_border');

					} else {

						$('#old_password').addClass('red_border');
						$('#new_password').addClass('red_border');
						$('#confirm_password').addClass('red_border');
						$('#email').addClass('red_border');
						$('.ch_pass_msg').removeClass('green');
						$('.ch_pass_msg').addClass('red');
						$('.ch_pass_msg').html(obj.message);

					}
				}
 			};
 			$("#update_info_form").ajaxSubmit(options);
		});
		
		$('.update_info').on('click', function(){

            $('.uinfo_msg').html('loading...');

			var options = { 				
 				url: "/auth_api/update_user_data/",
 				success: function(data) {
					var obj = jQuery.parseJSON(data);
					if (obj.status == "success") {
												
						$('.uinfo_msg').removeClass('red');
						$('.uinfo_msg').addClass('green');
						$('.uinfo_msg').html(obj.message);
						document.location.href='/auth/profile/';
						
					} else {
						$('.uinfo_msg').removeClass('green');
						$('.uinfo_msg').addClass('red');
						$('.uinfo_msg').html(obj.message);

					}
				}
			};
			$("#update_info_form").ajaxSubmit(options);
		});
 
      });
	
</script>