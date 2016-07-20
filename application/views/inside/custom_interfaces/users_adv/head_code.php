<!------------------------------------------------- Actions -------------------------->

		<script>
		$(document).ready( function() {
			

				
		$("body").on('click', '#reg-ok' ,function() {
			var options = {
				target: "#reg-mess",
				url: "/inside/custom_model/users_adv/main_model/add_user/",
				success: function() {
					alert ("Data Sended!");
				}
			};
			$(this).parent().ajaxSubmit(options);
		});

		$("body").on('click', '#pass-ok' ,function() {
			var options = {
				target: "#pass-mess",
				url: "/inside/custom_model/users_adv/main_model/change_pass/",
				success: function() {
					alert ("Data Sended!");
				}
			};
			$(this).parent().ajaxSubmit(options);
		});



		// --------------------------------------------------------- CONTROL FORM Auto Load --------------------		

		// OnLoad Add Ajax Data
		inside_send_control_form();
		});

		function inside_send_control_form()
		{
	  
		$('#inside_terminal').animate(
			{
			opacity: 0.1,
			},200, function() {


				var options = {
				target: "#inside_terminal",
				url: "/inside/custom_model/<?php echo $interface_name;?>/",
				success: function() {
				}
			};
			// передаем опции в  ajaxSubmit
			$("#control_form").ajaxSubmit(options);
			
			$('#inside_terminal').animate({opacity: 1},500);
			});

		};

		</script>

