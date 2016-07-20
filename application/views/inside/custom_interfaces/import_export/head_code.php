		<link rel="stylesheet" href="/files/inside/css/jquery-ui-smoothness/jquery-ui-1.10.1.custom.css">
		<script src="/files/inside/js/jquery-ui-1.10.1.custom.min.js"></script>
		<script src="/files/inside/js/jquery.dialog.extra.js"></script>	

<!------------------------------------------------- Actions -------------------------->

		<script>
		$(document).ready( function() {
			
			
		});

		function inside_send_control_form()
		{
			$('#debug_div').append('AJAX Sended!<br />');
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