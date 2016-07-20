// JavaScript for Inside System v. 2.0.

// Swith off async AJAX
$.ajaxSetup({async:false});

var pdg_timer = new Array(); // Timers Array
var pdg_dialog_width = 100; 
var pdg_dialog_height = 100;
var dialog_id = 1;
var pdg_table = $('#pdg_table').val();

// Firls Form Load
$(document).ready( function() {

	$("body").on('click', '.form_submit' ,function() {
		// Send Form data for Update or Add
		$(this).parent().ajaxSubmit();
		inside_temporary_dialog('Data Saved!');		
		});
		

	// ------------------------------------    ADVANCED ------------------------------------------------------------

		// Temporary Dialog message
		function inside_temporary_dialog($message)
		{
			$("<div class='success_info' dialog_id="+dialog_id+"><b>"+$message+"</b></div>").dialog({
						autoOpen: true,
						title: 'Info Message',
						width: 200,
						height: 84,
						canMinimize:true,
						canMaximize:true,
						position: [400,400],
						close: function(event, ui){$(this).remove();}
						});
			if (pdg_timer['dialog_'+dialog_id] !== undefined) clearTimeout(pdg_timer['dialog_'+dialog_id]);
			pdg_timer['dialog_'+dialog_id]=setTimeout("$('.success_info[dialog_id="+dialog_id+"]').fadeIn('slow', function(){ $(this).remove();inside_send_control_form(); });",700);				
			dialog_id++;
		}
});
