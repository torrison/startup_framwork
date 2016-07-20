<?php
// Include table config
include ('application/config/pdg_tables/'.$table_name.'.php');
$key_field = $table_config['key'];
?>

<div id="cell_tabs_<?php echo $dialog_id; ?>">
	<ul>
		<li><a href="#hidden">?</a></li>
		<?php
		foreach ($table_config['cell_tabs_arr'] as $key => $value) echo '<li><a href="#'.$key.'">'.$value.'</a></li>';
		echo '<li><a class="edit_dialog_update" line_id="'.$cell_id.'" dialog_id="'.$dialog_id.'">Update</a></li>';
		?>	
	</ul>
	<div id="hidden">
		<form method="post" class="edit_tab_form" tab_id="hidden">
	
		<b>Power Data Grid Table Edit Dialogs:</b><br />
		<br /><br />
		Select required tab.
		<br /><br />
		For Save information click "Save" Button.
		<br /><br />
		For Reset information click "Reset" Button.
		<br /><br />
		Access and Chat is extended tabs.
		<br /><br /><br />
		<b>Good Luck in Use!</b>
	
		</form>
	</div>
	<?php	
		foreach ($table_config['cell_tabs_arr'] as $key => $value) 
		{
			if ($key == "access") {
				// Prepare TABS Access Select
				$tabs_select = '<select id="inside_api_groups_select_by_id" name="tab_sysname[]"><option value="0">All</option>';
				foreach ($table_config['cell_tabs_arr'] as $key => $value) {
					$tabs_select .=  '<option value="'.$key.'">'.$value.'</option>';		
				}
				$tabs_select .= '</select>';
				ob_start();
	?>
		<form method="post" action="/inside_pdg_ajax/edit_access/<?php echo $table_name; ?>/<?php echo $edit_cell_arr[$key_field];?>/">
			<table class="table table-bordered">
				<tr>
					<th>Group</td>
					<th>Tabs</td>
					<th>View</td>
					<th>Edit</td>
					<th></td>
				</tr>
				<tr>
					<td><?php echo $group_select; ?></td>
					<td><?php echo $tabs_select; ?></td>
					<td><select style="width:auto;" name="view_access[]"><option value="allow" selected="">Allow</option><option value="deny">Deny</option></select></td>
					<td><select style="width:auto;" name="edit_access[]"><option value="allow" selected="">Allow</option><option value="deny">Deny</option></select></td>
					<td><a class="btn btn-danger white del_edit_rule">x</a></td>
				</tr>
			</table>
			<a class="btn btn-success white add_edit_rule">+</a> <a class="btn btn-success white edit_access">Send</a>
		</form>
	<?php				
				$form = ob_get_clean();
				echo '<div id="'.$key.'">'.$form.'</div>';
			}
			elseif ($key == "chat") {
				ob_start();
	?>
		<form method="post" action="/inside_pdg_ajax/add_chat_comment/<?php echo $table_name; ?>/<?php echo $edit_cell_arr[$key_field];?>/" class="add_chat_comment">
			<textarea style="width:610px; height: 60px; margin-right: 20px;" name="comment"></textarea>
			<a class="btn btn-success white add_comment">Send</a>
			<div class="comments_holder">
				<?php 
				foreach ($chat_messages as $row) { ?>
				<div style="padding: 10px; margin-top: 10px; border-top: 1px dotted #777;">
				<b><?php echo $row['row_chat_user_name'];?></b> <i class="gray">[<?php echo $row['row_chat_datetime'];?>]</i>: <?php echo $row['row_chat_content'];?>
				</div>
				<?php }?>
			</div>
		</form>
	<?php  	
				$form = ob_get_clean();;
				echo '<div id="'.$key.'">'.$form.'</div>';
			}
			// ---------------------------------------------------- ALL EDIT TABS ----------------------
			else {
				$inputs = '';
				// Add Inputs for table fields
				foreach ($table_columns as $config_row) {
					if ( (isset($config_row['tab'])) && ($config_row['tab'] == $key) ) {						
						if (!isset($config_row['help'])) $config_row['help'] = '';
						$inputs .= '<b title="Click to Help!" OnClick="$(this).parent().children(\'.help_block[input_name='.$config_row['name'].']\').toggle();" class="cell_tab_input_name" input_name="'.$config_row['name'].'">'.$config_row['text'].'</b><br />';				
						$inputs .= '
						<div class="help_block" input_name="'.$config_row['name'].'" style="display:none;">
							'.$config_row['help'].'<br />
						</div>';
						$inputs .= $gen_inputs_arr[$config_row['name']].'<div class="line10"></div>';										
					}
				}	

				// Add Relation Multi-Select Inputs for JOIN tables
				if (isset($adv_rel_inputs)) {
					foreach ($adv_rel_inputs as $rel_input_arr) {					
						if ($rel_input_arr['tab'] == $key) {
							$inputs .= '<b title="Click to Help!" OnClick="$(this).parent().children(\'.help_block[input_name='.$rel_input_arr['name'].']\').toggle();" class="cell_tab_input_name" input_name="'.$rel_input_arr['name'].'">'.$rel_input_arr['text'].'</b><br />';				
							$inputs .= '
							<div class="help_block" input_name="'.$rel_input_arr['name'].'" style="display:none;">
								'.$rel_input_arr['help'].'<br />
							</div>';
							$inputs .= $gen_inputs_arr[$rel_input_arr['name']].'<div class="line10"></div>';
						}
					}	
				}

				$inputs .= '<input type="button" class="btn btn-success cell_tab_submit" tab_id="'.$key.'" value="Save"/>';
				$inputs .= '<input type="reset" class="btn cell_tab_reset" tab_id="'.$key.'" value="Reset"/>';
				$inputs .= '<div class="clean"></div>';
				$form = '<form method="post" enctype="multipart/form-data" action="/inside_pdg_ajax/edit_request/'.$table_name.'/'.$key.'/'.$edit_cell_arr[$key_field].'/" class="edit_tab_form" tab_id="'.$key.'">'.$inputs.'</form>';
				echo '<div id="'.$key.'">'.$form.'</div>';
			}
		}
	?>
</div>
