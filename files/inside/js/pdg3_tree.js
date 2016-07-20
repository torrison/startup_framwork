// JavaScript for Inside System v. 2.0.

// Swith off async AJAX
$.ajaxSetup({async:false});

// First Form Load
$(document).ready( function() {

	var pdg_table = $('#pdg_table').val();

	inside_send_control_form();

	// TREE FUNCTIONS -----------------------------------------------------------------------------------
	
	$("#inside_terminal").on('click', '.open_children', function(e){
		if ( $(this).children("i").hasClass('icon-chevron-right') ) 
		{
			$(this).children("i").removeClass('icon-chevron-right');
			$(this).children("i").addClass('icon-chevron-down');
			
			var ajax_load = '';
			
			var parent_id = $(this).parent().attr("line_id");
			
			var tmp_pid = $("#pdg_pid").val();
			
			// For AJAX parametrs
			$("#pdg_pid").val(parent_id);
			$("#pdg_ajax").val('1');
			
			var options = {
 				url: "/inside_pdg_ajax/tree/",
 				success: function(msg) {
					ajax_load = msg;
					// Resizable
					$(".pdg_column").resizable({handles: 'e'});				
				}
			}
			// передаем опции в  ajaxSubmit
 			$("#control_form").ajaxSubmit(options);
			
			$("#pdg_pid").val(tmp_pid);
			$("#pdg_ajax").val('0');
			
			$(this).parent().parent().after('<div class="ajax_child" style="margin:5px; border-left: 1px dashed #999;">'+ajax_load+'</div>');			
			
		}
		else if ( $(this).children("i").hasClass('icon-chevron-down') )
		{
			$(this).children("i").removeClass('icon-chevron-down');
			$(this).children("i").addClass('icon-chevron-right');
			$(this).parent().parent().next().slideUp('fast');
		}
		$(".pdg_column_cell[line_id='"+parent_id+"']").removeClass('pdg_column_cell_active');
		e.stopPropagation();
	});
	
	
	
	// -------------------------------------------------------------------------------------------------
	
	// --------------------------------------------------------- CONTROL FORM actions --------------------
	// Send Button Click
	$("#pdg_send").on('click', inside_send_control_form);
	// Order Column Click
	$("#inside_terminal").on('click', '.pdg_column_header' ,function() {
		//alert ($("#pdg_asc").val());
		$("#pdg_order").val($(this).attr('column'));
		if ($("#pdg_asc").val() == 'asc') $("#pdg_asc").val('desc');
		else {if ($("#pdg_asc").val() == 'desc') $("#pdg_asc").val('asc');}
		inside_send_control_form();
		});
	// Fast Search
	$("#pdg_fsearch").on("keydown", function(){				
			if (pdg_timer[this.id] !== undefined) clearTimeout(pdg_timer[this.id]);
			pdg_timer[this.id]=setTimeout("inside_send_control_form()",700);
			});		
	// Select Limit
	$("#pdg_limit").on("keydown", function(){				
			if (pdg_timer[this.id] !== undefined) clearTimeout(pdg_timer[this.id]);
			pdg_timer[this.id]=setTimeout("inside_send_control_form()",700);
			});	

	// Page Prev
	$("#pdg_page_prev").on("click", function(){				
			if ($('#pdg_page').val() > 1)
				{
				var tmp_page = parseInt ($('#pdg_page').val()) - 1;
				$('#pdg_page').val(tmp_page); 
				$('#pdg_page_text').html(tmp_page); 
				inside_send_control_form();
				}
			});	
			
	// Page Next
	$("#pdg_page_next").on("click", function(){				
			if (1)
				{
				var tmp_page = parseInt ($('#pdg_page').val()) + 1;
				$('#pdg_page').val(tmp_page); 
				$('#pdg_page_text').html(tmp_page);
				inside_send_control_form();
				}
			});			

// --------------------------------------------------------- TERMINAL actions --------------------
		
// Hover Line
$("#inside_terminal").on('mouseover', '.pdg_column_cell' ,function() {
	tmp_line_id = $(this).attr('line_id');
	if (!$(".pdg_column_checkbox[line_id='"+tmp_line_id+"']").prop('checked')) 
	$(".pdg_column_cell[line_id='"+tmp_line_id+"']").addClass('pdg_column_cell_active');

	});
	
// Hover Line
$("#inside_terminal").on('mouseout', '.pdg_column_cell' ,function() {
	tmp_line_id = $(this).attr('line_id');
	if (!$(".pdg_column_checkbox[line_id='"+tmp_line_id+"']").prop('checked')) 
	$(".pdg_column_cell[line_id='"+tmp_line_id+"']").removeClass('pdg_column_cell_active');
	});	
	
// Clink on Line
$("#inside_terminal").on('click', '.pdg_column_cell' ,function() {
	tmp_line_id = $(this).attr('line_id');	
	if (!$(".pdg_column_checkbox[line_id='"+tmp_line_id+"']").prop('checked')) 
	{
	//$(".pdg_column_cell[line_id='"+tmp_line_id+"']").css({'font-weight' : 'bold'});
	$(".pdg_column_cell[line_id='"+tmp_line_id+"']").addClass('pdg_column_cell_active');
	$(".pdg_column_checkbox[line_id='"+tmp_line_id+"']").prop('checked', true) ;
	}
	else 
	{
	//$(".pdg_column_cell[line_id='"+tmp_line_id+"']").css({'font-weight' : 'normal'});
	$(".pdg_column_cell[line_id='"+tmp_line_id+"']").removeClass('pdg_column_cell_active');
	$(".pdg_column_checkbox[line_id='"+tmp_line_id+"']").prop('checked', false);
	}
	});

// Click on CheckBox (Patch for stop 2 events onc checkbox click)
$("#inside_terminal").on('click', '.pdg_column_checkbox' ,function (e) {
    // Stop Event
    e.stopPropagation();
	});
	

// Add Button	
$(".pdg_badd").on('click', function() {open_add_dialog()});	
	
// Copy Button	
$(".pdg_bcopy").on('click' ,function() {
	
	var copy_arr = $('input:checkbox:checked.pdg_column_checkbox').map(function () {
		return this.value;
	}).get();
	// Open All Selected Copy Fields Dialogs
	for (var i in copy_arr) { open_copy_dialog(copy_arr[i]);}
	
	});	

// Delete Elements	
$(".pdg_bdel").on('click' ,function() {
	
	var copy_arr = $('input:checkbox:checked.pdg_column_checkbox').map(function () {
		return this.value;
	}).get();
	
	var del_ids = "";
	var input = "";
	for (var i in copy_arr) {
	del_ids = del_ids+copy_arr[i]+', ';
	input += '<input type="hidden" name="del_ids[]" value="'+copy_arr[i]+'" />';
	}
	var text ="Selected cells IDs: <br />"+del_ids.slice(0, -2);;
	var button = '<br /><br /><input type="button" class="btn btn-danger cell_tab_submit" tabindex="-1" dialog_id="'+dialog_id+'" value="Delete" />';
	$("<div class='dialog_del' edit_id='"+copy_arr[i]+"'><form method='post' action='/inside_pdg_ajax/del_request/"+pdg_table+"/' dialog_id="+dialog_id+">"+text+input+button+"</form></div>").dialog({
					autoOpen: true,
					title: 'Delete fields',
					width: 300,
					height: 200,
					canMinimize:true,
					canMaximize:true,
					position: [pdg_dialog_width,pdg_dialog_height],
					close: function(event, ui){$(this).remove();}
					});	
		// Dialog Shift
		pdg_dialog_width = pdg_dialog_width + 10; pdg_dialog_height = pdg_dialog_height + 10;dialog_id++;
	
	});	
	
// ------------------------------------  CRUD Edit, Delete Dialogs Load ---------------------------------	

// Dbl Clink on Line
$("#inside_terminal").on('dblclick', '.pdg_column_cell' ,function() {open_edit_dialog($(this).attr('line_id'));});

// Update Edit Dialog
$("body").on('click', '.edit_dialog_update' ,function() {update_edit_dialog($(this).attr('line_id'),$(this).attr('dialog_id'))});

// Edit Button	
$("#inside_terminal").on('click', '.pdg_button_edit' ,function() {open_edit_dialog($(this).attr('line_id'));});	
	
// ------------------------------------  Edit, Delete Dialogs Requsts Answers ----------------------------

$("body").on('click', '.cell_tab_submit' ,function() {
	
	// Update HTML Editor if it created
	for(var instanceName in CKEDITOR.instances)
    CKEDITOR.instances[instanceName].updateElement();
	// Send Form data for Update or Add
	$(this).parent().ajaxSubmit();
	inside_temporary_dialog('Data Saved!');		
	});
	

// -------------------------------------     ACTIONS      -------------------------------------------------------------


// Open ADD tabs Forms in Dialog ---------------------------------------------------------------------------------
		function open_add_dialog()
		{
			$("<div dialog_id='"+dialog_id+"'></div>").dialog({
				autoOpen: true,
				title: 'Add field',
				width: 800,
				height: 600,
				canMinimize:true,
				canMaximize:true,
				position: [pdg_dialog_width,pdg_dialog_height],
				close: function(event, ui){$(this).remove();}
				});
			// AJAX load information
			var array = { pdg_table: pdg_table, dialog_id: dialog_id };
			$.post('/inside_pdg_ajax/add/', array, function(data) {
				// Add new AJAX Data
				$('div[dialog_id='+dialog_id+']').html(data);
				// Activate Tabs
				$( "#cell_tabs_"+dialog_id ).tabs({active: 1});	
				// Load HTML Editor if it created					
				$('div[dialog_id='+dialog_id+'] .html_editor').each(function (i, val){CKEDITOR.replace(val);});
				$('div[dialog_id='+dialog_id+'] .ac_select').combobox();
				$('div[dialog_id='+dialog_id+'] .pdg_mselect').multiselect();
			});
			// Dialog Shift
			dialog_shift();
		}

		// Open COPY tabs Forms in Dialog ---------------------------------------------------------------------------------
		function open_copy_dialog(tmp_line_id)
		{	
			$("<div dialog_id='"+dialog_id+"'></div>").dialog({
				autoOpen: true,
				title: 'Copy field id = '+tmp_line_id,
				width: 800,
				height: 600,
				canMinimize:true,
				canMaximize:true,
				position: [pdg_dialog_width,pdg_dialog_height],
				close: function(event, ui){$(this).remove();}
				});
			// AJAX load information
			var array = {cell_id: tmp_line_id, pdg_table: pdg_table, dialog_id: dialog_id};
			$.post('/inside_pdg_ajax/copy/', array, function(data) {
				// Add new AJAX Data
				$('div[dialog_id='+dialog_id+']').html(data);
				// Activate Tabs
				$( "#cell_tabs_"+dialog_id ).tabs({active: 1});	
				// Load HTML Editor if it created			
				$('div[dialog_id='+dialog_id+'] .html_editor').each(function (i, val){CKEDITOR.replace(val);});
				$('div[dialog_id='+dialog_id+'] .ac_select').combobox();
				$('div[dialog_id='+dialog_id+'] .pdg_mselect').multiselect();
			});
			// Dialog Shift
			dialog_shift();
		}

		// Open Edit tabs Forms in Dialog ---------------------------------------------------------------------------------
		function open_edit_dialog(tmp_line_id)
		{
			if ($('.dialog_edit[edit_id='+tmp_line_id+']').length > 0)
			{	
				alert ('Dialog already Opened!');
			}
			else
			{	
				$("<div dialog_id='"+dialog_id+"'></div>").dialog({
					autoOpen: true,
					title: 'Edit field id = '+tmp_line_id,
					width: 800,
					height: 600,
					canMinimize:true,
					canMaximize:true,
					position: [pdg_dialog_width,pdg_dialog_height],
					close: function(event, ui){$(this).remove();}
				});
				// AJAX load information
				var array = {cell_id: tmp_line_id, pdg_table: pdg_table, dialog_id: dialog_id};
				$.post('/inside_pdg_ajax/edit/', array, function(data) {
					// Add new AJAX Data
					$('div[dialog_id='+dialog_id+']').html(data);
					// Activate Tabs
					$( "#cell_tabs_"+dialog_id).tabs({active: 1});	
					// Load HTML Editor if it created			
					$('div[dialog_id='+dialog_id+'] .html_editor').each(function (i, val){CKEDITOR.replace(val);});
					$('div[dialog_id='+dialog_id+'] .ac_select').combobox();
					$('div[dialog_id='+dialog_id+'] .pdg_mselect').multiselect();
				});
				// Dialog Shift
				dialog_shift();
			}
		}
		
		// Update Edit tabs Forms in Dialog ---------------------------------------------------------------------------------
		function update_edit_dialog(tmp_line_id, dialog_id)
		{			
			// AJAX load information
			var array = {cell_id: tmp_line_id, pdg_table: pdg_table, dialog_id: dialog_id};
			$.post('/inside_pdg_ajax/edit/', array, function(data) {

				$('div[dialog_id='+dialog_id+']').fadeOut('fast');
				$('div[dialog_id='+dialog_id+']').html(data);
				$('div[dialog_id='+dialog_id+']').fadeIn('fast');
				// Activate Tabs
				$( "#cell_tabs_"+dialog_id ).tabs({active: 1});	
				// Load HTML Editor if it created
				$('div[dialog_id='+dialog_id+'] .html_editor').each(function (i, val){CKEDITOR.replace(val);});
				$('div[dialog_id='+dialog_id+'] .ac_select').combobox();
				$('div[dialog_id='+dialog_id+'] .pdg_mselect').multiselect();
			});
		}	
		
		// Temporary Dialog message
		function inside_temporary_dialog($message)
		{
			$("<div class='success_info' dialog_id="+dialog_id+"><b>"+$message+"</b></div>").dialog({
				autoOpen: true,
				title: 'Info Message',
				width: 200,
				height: 90,
				canMinimize:true,
				canMaximize:true,
				position: [400,400],
				close: function(event, ui){$(this).remove();}
				});
			setTimeout("$('.success_info[dialog_id="+dialog_id+"]').fadeIn('slow', function(){$(this).remove()})",700);				
			dialog_id++;
		}
		
		// Chat Add Comment
		$("body").on('click', ".add_chat_comment .add_comment", function() {
			
			var mess_holder = $(this).parent().children(".comments_holder");
			
			$(this).parent().ajaxSubmit({
				success: function(data) { mess_holder.prepend(data);}
			});
			inside_temporary_dialog('Data Saved!');
		});
		
		// Access Edit Data
		$("body").on('click', ".edit_access", function() {
			
			var table = $(this).parent().children("table");
			
			$(this).parent().ajaxSubmit({
				success: function(data) { table.prepend(data);}
			});
			inside_temporary_dialog('Data Saved!');
		});
		
		// Access Add Rule
		$("body").on('click', ".add_edit_rule", function() {
			
			var tr_copy = $(this).parent().children("table").children("tbody").children("tr").eq(1).clone();
			$(this).parent().children("table").children("tbody").append(tr_copy);
			// alert (tr_copy.html());
			
		});
		
		// Access Del Rule
		$("body").on('click', ".del_edit_rule", function() {				
			if (typeof ($(this).parent().parent().parent().children("tr").eq(2).html())  !== 'undefined')
			{
				$(this).parent().parent().remove();		
			}
		});
		
		
// End of Ready.Document Functions		
});

	
	// Get CRUD by AJAX
	function inside_send_control_form()
	{
  
	$('#debug_div').append('AJAX Sended!<br />');
		$('#inside_terminal').animate(
			{
            opacity: 0.1,
			},200, function() {


				var options = {
 				target: "#inside_terminal",
 				url: "/inside_pdg_ajax/tree/",
 				success: function() {
				
				// Resizable
				$(".pdg_column").resizable({handles: 'e'});
				
				}
 			};
 			// передаем опции в  ajaxSubmit
 			$("#control_form").ajaxSubmit(options);
			
 			$('#inside_terminal').animate({opacity: 1},500);
		    });
	// $('.ac_select').combobox();
	};



