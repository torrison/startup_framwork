		<link rel="stylesheet" href="/files/inside/css/jquery-ui-smoothness/jquery-ui-1.10.1.custom.css">
		<link rel="stylesheet" href="/files/inside/css/ui.multiselect.css">
		<script src="/files/inside/js/jquery-ui-1.10.1.custom.min.js"></script>
		<script src="/files/inside/js/jquery.dialog.extra.js"></script>
		<script type="text/javascript" src="/files/inside/js/pdg3_base.js"></script>		
		<script type="text/javascript" src="/files/inside/js/ui.multiselect.js"></script>
		
		<style>
		#inside_terminal {padding-left:25px;}		
		</style>


<!------------------------------------------------- Actions -------------------------->

		<script>
		$(document).ready( function() {
		
		inside_send_control_form();
		
		// Send Button Click
		$("#pdg_send").on('click', inside_send_control_form);
		
		// Tabs Rules
		$("body").on('click', '.tabs_rules', function() {
			
			var table_name = $(this).attr("table");
			var table_id = $(this).attr("table_id");
			var group_id = $(this).attr("group_id");
			
			if ($('.dialog_edit[edit_id='+table_name+']').attr('edit_id') > 0) {	
					alert ('Dialog already Opened!');
				}
				
				
				else {	
					$("<div class='dialog_edit' edit_id='"+table_name+"' dialog_id='"+dialog_id+"'></div>").dialog({
								autoOpen: true,
								title: 'Tabs Access for table: '+table_name,
								width: 500,
								height: 400,
								canMinimize:true,
								canMaximize:true,
								position: [pdg_dialog_width,pdg_dialog_height],
								close: function(event, ui){$(this).remove();}
								});	
							
					// AJAX load information
					var array = { table_name: table_name, table_id: table_id, group_id : group_id , dialog_id: dialog_id };
					$.post('/inside/custom_model/inside_access/main_model/tabs_access/', array, function(data) {
						// Add new AJAX Data
						// alert (data);
						$('.dialog_edit[dialog_id='+dialog_id+']').html(data);
					});
					// Dialog Shift
					pdg_dialog_width = pdg_dialog_width + 10; pdg_dialog_height = pdg_dialog_height + 10;dialog_id++;
				}
			
		});
		
		});
		

	
		
		// Get Data by AJAX
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
					
					// Resizable
					//$(".pdg_column").resizable({handles: 'e'});
					// Multi Select
					$('.multiselect').multiselect();
					
					}
				};
				// передаем опции в  ajaxSubmit
				$("#control_form").ajaxSubmit(options);
				
				$('#inside_terminal').animate({opacity: 1},500);
				});
		// $('.ac_select').combobox();
		};

		</script>

