// JavaScript for Inside System v. 2.0.

// Swith off async AJAX
$.ajaxSetup({async:false});

// Firls Form Load
$(document).ready( function() {

var pdg_timer = new Array(); // Timers Array
var dialog_id = 1;

// --------------------------------------------------------- CONTROL FORM actions --------------------
// Update Edit Dialog
$("body").on('click', '.edit_dialog_update' ,function() {update_edit_dialog($(this).attr('line_id'),$(this).attr('dialog_id'))});

// ------------------------------------  Edit, View, Delete Dialogs Requsts Answers ----------------------------

$("body").on('click', '.cell_tab_submit' ,function() {
	
	// Update HTML Editor if it created
	for(var instanceName in CKEDITOR.instances)
    CKEDITOR.instances[instanceName].updateElement();
	
	$(this).parent().ajaxSubmit();
	inside_temporary_dialog('Data Saved!');		
	});

// -------------------------------------     FUNCTIONS    -------------------------------------------------------------
	load_edit_tabs();
	function load_edit_tabs()
	{	
	// AJAX load information
	var array = { cell_id: tmp_line_id, pdg_table: pdg_table};
	$.post('/inside_pdg_ajax/edit/', array, function(data) {
		// Add new AJAX Data
        $('#inside_terminal').html(data);
		// Activate Tabs
		$( "#cell_tabs_" ).tabs({active: 1});	
		//alert (data);
		//alert ($('div[dialog_id='+dialog_id+']').find('.html_editor').attr('id'));
		// Load HTML Editor if it created			
		var cke_elements = $('#inside_terminal').find('.html_editor');			
		$.each(cke_elements, function (i, val)
			{
			var editor = CKEDITOR.replace(val)
			});
		$('#inside_terminal .ac_select').combobox();
		$('#inside_terminal .pdg_mselect').multiselect();
	});
	}
	
	// Update Edit Dialog
	$("#inside_terminal").on('click', '.edit_dialog_update' ,load_edit_tabs);


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
  		pdg_timer['dialog_'+dialog_id]=setTimeout("$('.success_info[dialog_id="+dialog_id+"]').fadeIn('slow', function(){ $(this).remove();});",700);				
		dialog_id++;
	}


	$("#inside_terminal").on('click', '.cell_tab_submit' ,function() {
	
	// Update HTML Editor if it created
	for(var instanceName in CKEDITOR.instances)
    CKEDITOR.instances[instanceName].updateElement();
	
	$(this).parent().ajaxSubmit();
	inside_temporary_dialog('Data Saved!');	
	load_edit_tabs();	
	});


});



// -------------------------------------  END of Include Elements ------------------------------------------------------------