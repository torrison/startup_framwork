		<script>

		$(document).ready( function() {

			// Swith off async AJAX
			$.ajaxSetup({async:false});

			$('#inside_terminal').animate(
				{
				opacity: 0.1,
				},200, function() {
					var options = {
					target: "#inside_terminal",
					url: "/inside_auth/ajax_message/login_info",
					success: function() {}
				};
				$("#control_form").ajaxSubmit(options);
				$('#inside_terminal').animate({opacity: 1},500);		
			});
			
			$('#inside_form_send').on('click', send_auth_fort);
			
			$("#control_form input").keypress(function(event) {
			if (event.which == 13) send_auth_fort();
			});

			function send_auth_fort()
			{
				var options = {
				target: "#inside_terminal",
				url: "/inside_auth/ajax_login_check/",
				success: function() {}
				};
				$("#control_form").ajaxSubmit(options);
				if ($("#inside_terminal").html() == "Ok!") setTimeout('location="/inside/";', 1000 ); ;
			}

		});
		</script>