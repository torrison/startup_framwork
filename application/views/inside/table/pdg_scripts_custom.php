		<link rel="stylesheet" href="/files/inside/css/jquery-ui-smoothness/jquery-ui-1.10.1.custom.css">
		<link rel="stylesheet" href="/files/inside/css/ui.multiselect.css">
		<link rel="stylesheet" href="/files/inside/css/pdg_styles.css">
		<script src="/files/inside/js/jquery.dialog.extra.js"></script>
		<script src="/files/inside/js/ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="/files/inside/js/scrollTo/jquery.scrollTo-min.js"></script>
		<script type="text/javascript" src="/files/inside/js/ui.multiselect.js"></script>

		<!------------------------------------------------- PDG for costomisation -------------------------->

		<script>

		// JavaScript for Inside System v. 2.0.

		// Swith off async AJAX
		$.ajaxSetup({async:false});

		// Firls Form Load
		$(document).ready( function() {

		var pdg_timer = new Array(); // Timers Array
		var pdg_dialog_width = 100; 
		var pdg_dialog_height = 100;
		var dialog_id = 1;
		var pdg_table = $('#pdg_table').val();

		inside_send_control_form();

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
			$(".pdg_column_cell[line_id='"+tmp_line_id+"']").css({'background' : '#faa'});

			});
			
		// Hover Line
		$("#inside_terminal").on('mouseout', '.pdg_column_cell' ,function() {
			tmp_line_id = $(this).attr('line_id');
			if (!$(".pdg_column_checkbox[line_id='"+tmp_line_id+"']").prop('checked')) 
			$(".pdg_column_cell[line_id='"+tmp_line_id+"']").css({'background': ''});
			});	
			
		// Clink on Line
		$("#inside_terminal").on('click', '.pdg_column_cell' ,function() {
			tmp_line_id = $(this).attr('line_id');	
			if (!$(".pdg_column_checkbox[line_id='"+tmp_line_id+"']").prop('checked')) 
			{
			//$(".pdg_column_cell[line_id='"+tmp_line_id+"']").css({'font-weight' : 'bold'});
			$(".pdg_column_cell[line_id='"+tmp_line_id+"']").css({'background' : '#faa'});
			$(".pdg_column_checkbox[line_id='"+tmp_line_id+"']").prop('checked', true) ;
			}
			else 
			{
			//$(".pdg_column_cell[line_id='"+tmp_line_id+"']").css({'font-weight' : 'normal'});
			$(".pdg_column_cell[line_id='"+tmp_line_id+"']").css({'background': ''});
			$(".pdg_column_checkbox[line_id='"+tmp_line_id+"']").prop('checked', false);
			}
			});

		// Click on CheckBox (Patch for stop 2 events onc checkbox click)
		$("#inside_terminal").on('click', '.pdg_column_checkbox' ,function (e) {
			// Stop Event
			e.stopPropagation();
			});
			
		// ------------------------------------  CRUD Edit, View, Delete Dialogs Load ---------------------------------	

		// Dbl Clink on Line
		$("#inside_terminal").on('dblclick', '.pdg_column_cell' ,function() {open_edit_dialog($(this).attr('line_id'));});

		// Update Edit Dialog
		$("body").on('click', '.edit_dialog_update' ,function() {update_edit_dialog($(this).attr('line_id'),$(this).attr('dialog_id'))});

		// Update View Dialog
		$("body").on('click', '.view_dialog_update' ,function() {update_view_dialog($(this).attr('line_id'),$(this).attr('dialog_id'))});

		// Edit Button	
		$("#inside_terminal").on('click', '.pdg_button_edit' ,function() {open_edit_dialog($(this).attr('line_id'));});	
			
		// View Button	
		$("#inside_terminal").on('click', '.pdg_button_view' ,function() {open_view_dialog($(this).attr('line_id'));});

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
			var button = '<br /><br /><input type="button" class="cell_tab_submit" dialog_id="'+dialog_id+'" value="Delete" />';
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
			
		// -------------------------------------------------------------------------------------------------------------
		// ------------------------------------  Edit, View, Delete Dialogs Requsts Answers ----------------------------

		$("body").on('click', '.cell_tab_submit' ,function() {
			
			// Update HTML Editor if it created
			for(var instanceName in CKEDITOR.instances)
			CKEDITOR.instances[instanceName].updateElement();
			// Send Form data for Update or Add
			$(this).parent().ajaxSubmit();
			inside_temporary_dialog('Data Saved!');		
			});
			

		// ------------------------------------    ADVANCED ------------------------------------------------------------







		// -------------------------------------     ACTIONS      -------------------------------------------------------------

		// -------------------------------------     FUNCTIONS    -------------------------------------------------------------



		// Open ADD tabs Forms in Dialog ---------------------------------------------------------------------------------
			function open_add_dialog()
			{
			$("<div class='dialog_edit' edit_id='"+tmp_line_id+"' dialog_id='"+dialog_id+"'></div>").dialog({
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
			var array = { cell_id: tmp_line_id, pdg_table: pdg_table, dialog_id: dialog_id };
			$.post('/inside_pdg_ajax/add/', array, function(data) {
				// Add new AJAX Data
				$('div[dialog_id='+dialog_id+']').html(data);
				// Activate Tabs
				$( "#cell_tabs_"+dialog_id ).tabs({active: 1});	
				//alert (data);
				//alert ($('div[dialog_id='+dialog_id+']').find('.html_editor').attr('id'));
				// Load HTML Editor if it created			
				var cke_elements = $('div[dialog_id='+dialog_id+']').find('.html_editor');			
				$.each(cke_elements, function (i, val)
					{
					var editor = CKEDITOR.replace(val)
					});
				$('div[dialog_id='+dialog_id+'] .ac_select').combobox();
				$('div[dialog_id='+dialog_id+'] .pdg_mselect').multiselect();
			});
			// Dialog Shift
			pdg_dialog_width = pdg_dialog_width + 10; pdg_dialog_height = pdg_dialog_height + 10;dialog_id++;
			}

			// Open COPY tabs Forms in Dialog ---------------------------------------------------------------------------------
			function open_copy_dialog(tmp_line_id)
			{
			
			if ($('.dialog_edit[edit_id='+tmp_line_id+']').attr('edit_id') > 0)
			{	
				alert ('Dialog already Opened!');
			}
			else
			{	
			$("<div class='dialog_edit' edit_id='"+tmp_line_id+"' dialog_id='"+dialog_id+"'></div>").dialog({
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
			var array = { cell_id: tmp_line_id, pdg_table: pdg_table, dialog_id: dialog_id };
			$.post('/inside_pdg_ajax/copy/', array, function(data) {
				// Add new AJAX Data
				$('div[dialog_id='+dialog_id+']').html(data);
				// Activate Tabs
				$( "#cell_tabs_"+dialog_id ).tabs({active: 1});	
				//alert (data);
				//alert ($('div[dialog_id='+dialog_id+']').find('.html_editor').attr('id'));
				// Load HTML Editor if it created			
				var cke_elements = $('div[dialog_id='+dialog_id+']').find('.html_editor');			
				$.each(cke_elements, function (i, val)
					{
					var editor = CKEDITOR.replace(val)
					});
				$('div[dialog_id='+dialog_id+'] .ac_select').combobox();
				$('div[dialog_id='+dialog_id+'] .pdg_mselect').multiselect();
			});
			// Dialog Shift
			pdg_dialog_width = pdg_dialog_width + 10; pdg_dialog_height = pdg_dialog_height + 10;dialog_id++;
			}
			}
		// Open View tabs Forms in Dialog ---------------------------------------------------------------------------------
			function open_view_dialog(tmp_line_id)
			{
			if ($('.dialog_edit[edit_id='+tmp_line_id+']').attr('edit_id') > 0)
			{	
				alert ('Dialog already Opened!');
			}
			else
			{	
			$("<div class='dialog_edit' edit_id='"+tmp_line_id+"' dialog_id='"+dialog_id+"'></div>").dialog({
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
			var array = { cell_id: tmp_line_id, pdg_table: pdg_table, dialog_id: dialog_id };
			$.post('/inside_pdg_ajax/view/', array, function(data) {
				// Add new AJAX Data
				$('div[dialog_id='+dialog_id+']').html(data);
				// Activate Tabs
				$( "#cell_tabs_"+dialog_id ).tabs({active: 1});	
				//alert (data);
				//alert ($('div[dialog_id='+dialog_id+']').find('.html_editor').attr('id'));
				// Load HTML Editor if it created			
				var cke_elements = $('div[dialog_id='+dialog_id+']').find('.html_editor');			
				$.each(cke_elements, function (i, val)
					{
					var editor = CKEDITOR.replace(val)
					});
				$('div[dialog_id='+dialog_id+'] .ac_select').combobox();
				$('div[dialog_id='+dialog_id+'] .pdg_mselect').multiselect();
			});
			// Dialog Shift
			pdg_dialog_width = pdg_dialog_width + 10; pdg_dialog_height = pdg_dialog_height + 10;dialog_id++;
			}
			}

			// Open Edit tabs Forms in Dialog ---------------------------------------------------------------------------------
			function open_edit_dialog(tmp_line_id)
			{
			if ($('.dialog_edit[edit_id='+tmp_line_id+']').attr('edit_id') > 0)
			{	
				alert ('Dialog already Opened!');
			}
			else
			{	
			$("<div class='dialog_edit' edit_id='"+tmp_line_id+"' dialog_id='"+dialog_id+"'></div>").dialog({
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
			var array = { cell_id: tmp_line_id, pdg_table: pdg_table, dialog_id: dialog_id };
			$.post('/inside_pdg_ajax/edit/', array, function(data) {
				// Add new AJAX Data
				$('div[dialog_id='+dialog_id+']').html(data);
				// Activate Tabs
				$( "#cell_tabs_"+dialog_id ).tabs({active: 1});	
				//alert (data);
				//alert ($('div[dialog_id='+dialog_id+']').find('.html_editor').attr('id'));
				// Load HTML Editor if it created			
				var cke_elements = $('div[dialog_id='+dialog_id+']').find('.html_editor');			
				$.each(cke_elements, function (i, val)
					{
					var editor = CKEDITOR.replace(val)
					});
				$('div[dialog_id='+dialog_id+'] .ac_select').combobox();
				$('div[dialog_id='+dialog_id+'] .pdg_mselect').multiselect();
			});
			// Dialog Shift
			pdg_dialog_width = pdg_dialog_width + 10; pdg_dialog_height = pdg_dialog_height + 10;dialog_id++;
			}
			}
			
			// Update Edit tabs Forms in Dialog ---------------------------------------------------------------------------------
			function update_edit_dialog(line_id, dialog_id)
			{
			
			tmp_line_id = line_id;	
			// AJAX load information
			var array = { cell_id: tmp_line_id, pdg_table: pdg_table, dialog_id: dialog_id };
			$.post('/inside_pdg_ajax/edit/', array, function(data) {
				$('div[dialog_id='+dialog_id+']').fadeOut('fast');
				// Add new AJAX Data
				$('div[dialog_id='+dialog_id+']').html(data);
				$('div[dialog_id='+dialog_id+']').fadeIn('fast');
				// Activate Tabs
				$( "#cell_tabs_"+dialog_id ).tabs({active: 1});	
				//alert (data);
				// Load HTML Editor if it created
				var cke_elements = $('div[dialog_id='+dialog_id+']').find('.html_editor');			
				$.each(cke_elements, function (i, val)
					{
					var editor = CKEDITOR.replace(val)
					});
				$('div[dialog_id='+dialog_id+'] .ac_select').combobox();
				$('div[dialog_id='+dialog_id+'] .pdg_mselect').multiselect();
			});
			}

			function update_view_dialog(line_id, dialog_id)
			{
			
			tmp_line_id = line_id;	
			// AJAX load information
			var array = { cell_id: tmp_line_id, pdg_table: pdg_table, dialog_id: dialog_id };
			$.post('/inside_pdg_ajax/view/', array, function(data) {
				$('div[dialog_id='+dialog_id+']').fadeOut('fast');
				// Add new AJAX Data
				$('div[dialog_id='+dialog_id+']').html(data);
				$('div[dialog_id='+dialog_id+']').fadeIn('fast');
				// Activate Tabs
				$( "#cell_tabs_"+dialog_id ).tabs({active: 1});	
				//alert (data);
				// Load HTML Editor if it created
				var cke_elements = $('div[dialog_id='+dialog_id+']').find('.html_editor');			
				$.each(cke_elements, function (i, val)
					{
					var editor = CKEDITOR.replace(val)
					});
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
						url: "/inside_pdg_ajax/",
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





		// -------------------------------------  Include Elements ------------------------------------------------------------



		// -------------------------------------  END of Include Elements ------------------------------------------------------------

		</script>


		<!-------------------------------------------------  COMBOBOX -------------------------------------->
		<style>
		  .ui-combobox {
			position: relative;
			display: inline-block;
		  }
		  .ui-combobox-toggle {
			position: absolute;
			top: 0;
			bottom: 0;
			margin-left: -1px;
			padding: 0;
			/* support: IE7 */
			*height: 1.7em;
			*top: 0.1em;
		  }
		  .ui-combobox-input {
			margin: 0;
			padding: 0.3em;
		  }
		  </style>
		  
		  <script>
		  (function( $ ) {
			$.widget( "ui.combobox", {
			  _create: function() {
				var input,
				  that = this,
				  wasOpen = false,
				  select = this.element.hide(),
				  selected = select.children( ":selected" ),
				  value = selected.val() ? selected.text() : "",
				  wrapper = this.wrapper = $( "<span>" )
					.addClass( "ui-combobox" )
					.insertAfter( select );
		 
				function removeIfInvalid( element ) {
				  var value = $( element ).val(),
					matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( value ) + "$", "i" ),
					valid = false;
				  select.children( "option" ).each(function() {
					if ( $( this ).text().match( matcher ) ) {
					  this.selected = valid = true;
					  return false;
					}
				  });
		 
				  if ( !valid ) {
					// remove invalid value, as it didn't match anything
					$( element )
					  .val( "" )
					  .attr( "title", value + " didn't match any item" )
					  .tooltip( "open" );
					select.val( "" );
					setTimeout(function() {
					  input.tooltip( "close" ).attr( "title", "" );
					}, 2500 );
					input.data( "ui-autocomplete" ).term = "";
				  }
				}
		 
				input = $( "<input>" )
				  .appendTo( wrapper )
				  .val( value )
				  .attr( "title", "" )
				  .addClass( "ui-state-default ui-combobox-input" )
				  .autocomplete({
					delay: 0,
					minLength: 3,
					source: function( request, response ) {
					  var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
					  response( select.children( "option" ).map(function() {
						var text = $( this ).text();
						if ( this.value && ( !request.term || matcher.test(text) ) )
						  return {
							label: text.replace(
							  new RegExp(
								"(?![^&;]+;)(?!<[^<>]*)(" +
								$.ui.autocomplete.escapeRegex(request.term) +
								")(?![^<>]*>)(?![^&;]+;)", "gi"
							  ), "<strong>$1</strong>" ),
							value: text,
							option: this
						  };
					  }) );
					},
					select: function( event, ui ) {
					  ui.item.option.selected = true;
					  that._trigger( "selected", event, {
						item: ui.item.option
					  });
					},
					change: function( event, ui ) {
					  if ( !ui.item ) {
						removeIfInvalid( this );
					  }
					}
				  })
				  .addClass( "ui-widget ui-widget-content ui-corner-left" );
		 
				input.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
				  return $( "<li>" )
					.append( "<a>" + item.label + "</a>" )
					.appendTo( ul );
				};
		 
				$( "<a>" )
				  .attr( "tabIndex", -1 )
				  .attr( "title", "Show All Items" )
				  .tooltip()
				  .appendTo( wrapper )
				  .button({
					icons: {
					  primary: "ui-icon-triangle-1-s"
					},
					text: false
				  })
				  .removeClass( "ui-corner-all" )
				  .addClass( "ui-corner-right ui-combobox-toggle" )
				  .mousedown(function() {
					wasOpen = input.autocomplete( "widget" ).is( ":visible" );
				  })
				  .click(function() {
					input.focus();
		 
					// close if already visible
					if ( wasOpen ) {
					  return;
					}
		 
					// pass empty string as value to search for, displaying all results
					input.autocomplete( "search", "" );
				  });
		 
				input.tooltip({
				  tooltipClass: "ui-state-highlight"
				});
			  },
		 
			  _destroy: function() {
				this.wrapper.remove();
				this.element.show();
			  }
			});
		  })( jQuery );
		  </script>
		  
		  <!------------------------------------------------------------------------------------------------------->