<?php
// --------------------  Load Cofig Data ---------------------------------------------------

// Include table config
include ($config_file);


// -------------------- Prepare Config Data --------------------------------------------------
$key_column = $table_config['key'];

// Array for Ready Weared Columns
$pdg_column_html = array();

// Prepare headers of columns
foreach ($table_columns as $config_row) {	
	if (isset($config_row['in_crud']))
	{
		$tmp_name = $config_row['name'];
		$pdg_column_html[$tmp_name] = 
			'<div class="pdg_column_header" column="'.$config_row['name'].'">'.$config_row['text'].'</div>';		
	}
}

// Add 2 colums for checkboxes and edit button
$pdg_column_html['checks'] = '<div class="pdg_column_header"></div>';
$pdg_column_html['controls'] = '<div class="pdg_column_header"></div>';

// Wear Table Array
foreach ($table_arr as $table_row) {
	// Work only with "in_crud"
	foreach ($table_columns as $config_row) {
		if (isset($config_row['in_crud'])) {
		$tmp_name = $config_row['name'];
		
			// Update Data Cells (If it Needs)
			if (isset($config_row['input_type']))
			{				
				$config_row['value'] = @$table_row[$tmp_name];
				$table_row[$tmp_name] = $this->inside_lib->make_input("crud_view", $config_row);
			}
			// Change view for JOIN columns
			if (isset ($config_row['join']))
			{
				$table_row[$tmp_name] = $table_row[$config_row['join_as']];
			}
		
			$pdg_column_html[$tmp_name] .= 
				'<div class="pdg_column_cell" line_id="'.$table_row[$key_column].'">'.$table_row[$tmp_name].'</div>';
		}
	}
	// Add CheckBox
	$pdg_column_html['checks'] .= '
	<div class="pdg_column_cell" line_id="'.$table_row[$key_column].'">
		<input type="checkbox" name="pdg_crud_checkbox[]" class="pdg_column_checkbox" line_id="'.$table_row[$key_column].'" value="'.$table_row[$key_column].'" />
	</div>
	';
	// Add Edit button
	$pdg_column_html['controls'] .= '
	<div class="pdg_column_cell" line_id="'.$table_row[$key_column].'">		
		<a href="/inside/pdg_edit/'.$table_name.'/'.$table_row[$key_column].'" OnClick="return false;" class="btn pdg_button_edit" line_id="'.$table_row[$key_column].'"><i class="icon-list-alt"></i><i class="icon-pencil"></i></a>
		<!--<a class="pdg_button_delete" line_id="'.$table_row[$key_column].'">(delete)</a>-->
	</div>
	';
}


// --------------------  Wear Columns in Columns Holders ---------------------------------------------------
?>

<?php
foreach ($table_columns as $config_row) {
	if (isset($config_row['in_crud']))
	{	
		$tmp_name = $config_row['name']; 
		// Prepare Styles
		$pdg_column_styles = '';
		// Column Width
		if (isset ($config_row['column_width'])) $pdg_column_styles .= 'width:'.$config_row['column_width'].'px';

?>

<div style="<?php echo $pdg_column_styles; ?>" class="pdg_column" field="<?php echo $tmp_name; ?>">
	
	<?php echo $pdg_column_html[$tmp_name];?>

</div>

<?php

	}
}
?>

<div style="width:32px;" class="pdg_column" field="checks">
	
	<?php echo $pdg_column_html['checks'];?>

</div>

<div style="width:67px;" class="pdg_column" field="controls">
	
	<?php echo $pdg_column_html['controls'];?>

</div>

<div style="clear:both;"></div>
<div style="font-size:9px; margin-top:12px;" id="debug_div">
	<?php echo "SQL:".$sql;?>
<br />
	<?php echo $debug;?>
</div>