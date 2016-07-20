		<link rel="stylesheet" href="/files/inside/css/jquery-ui-smoothness/jquery-ui-1.10.1.custom.css">
		<script src="/files/inside/js/jquery-ui-1.10.1.custom.min.js"></script>
		<script src="/files/inside/js/jquery.dialog.extra.js"></script>	

<!------------------------------------------------- Actions -------------------------->

		<script>
		$(document).ready( function() {
			
			// Action
			var win1 = $("<div class='success_info' dialog_id=1><div style='padding:20px;'>Load with code from <br />/views/inside/custom_interfaces/$interface_name/head_code.php</div></div>").dialog({
			autoOpen: true,
			title: 'Info Message',
			width: 500,
			height: 284,
			canMinimize:true,
			canMaximize:true,
			position: [300,200],
			close: function(event, ui){$(this).remove();},
								modal: true,
			buttons: {
			"Create": function() {
			alert ('Create Something');
			$(this).dialog("close");
			},
			Cancel: function() {
			$(this).dialog("close");
			}
			}
			});
			
			// OnLoad Add Ajax Data
			inside_send_control_form();

			// --------------------------------------------------------- CONTROL FORM actions --------------------
			// Send Button Click
	
			$("#pdg_send").on('click', inside_send_control_form);
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