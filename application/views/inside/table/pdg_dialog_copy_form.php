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
		?>
	</ul>
	<div id="hidden">
		<form method="post" class="edit_tab_form" tab_id="hidden">
	
			<b>Power Data Grid Table Copy Dialogs:</b><br />
			<br /><br />
			Add info in all tabs and click "Save" Button.
			<br /><br />
			Access is extended tab for defend data.
			<br /><br /><br />
			<b>Good Luck in Use!</b>
	
		</form>
	</div>
	<form method="post" enctype="multipart/form-data" action="/inside_pdg_ajax/add_request/<?php echo $table_name;?>/" class="edit_tab_form">
	<?php
		foreach ($table_config['cell_tabs_arr'] as $key => $value) {
			if ($key == "access") {
				$form = 'Access Here!';
				echo '<div id="'.$key.'">'.$form.'</div>';
			}
			elseif ($key == "chat") {
				$form = "In Copy it doesn't work";
				echo '<div id="'.$key.'">'.$form.'</div>';
			}
			else {
				$inputs = '';
				// Add Inputs for table fields
				foreach ($table_columns as $config_row) {
					if ( (isset($config_row['tab'])) && ($config_row['tab'] == $key) )
					{					
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
				if (isset($adv_rel_inputs))
				{
					foreach ($adv_rel_inputs as $rel_input_arr)
					{					
						if ($rel_input_arr['tab'] == $key)
						{
							$inputs .= '<b title="Click to Help!" OnClick="$(this).parent().children(\'.help_block[input_name='.$rel_input_arr['name'].']\').toggle();" class="cell_tab_input_name" input_name="'.$rel_input_arr['name'].'">'.$rel_input_arr['text'].'</b><br />';				
							$inputs .= '
							<div class="help_block" input_name="'.$rel_input_arr['name'].'" style="display:none;">
								'.$rel_input_arr['help'].'<br />
							</div>';
							$inputs .= $gen_inputs_arr[$rel_input_arr['name']].'<div class="line10"></div>';
						}
					}	
				}
				echo '<div id="'.$key.'">'.$inputs.'</div>';						
			}
		
		}
		
	?>
		<button class="btn btn-success cell_tab_submit" type="button">Copy</button></div>
	</form>
</div>
