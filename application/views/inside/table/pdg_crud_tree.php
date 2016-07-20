<?php

// --------------------  Load Cofig Data ---------------------------------------------------

// Include table config
include ('application/config/pdg_tables/'.$table_name.'.php');


// -------------------- Prepare Config Data --------------------------------------------------
$key_column = $table_config['key'];


// Array for Ready Weared Columns
$pdg_column_html = array();

$top_headers = '<style>.pdg_column_cell{background-color: #dfdfdf}; .table_row:nth-child(even)  {background-color: #e1d1d1}</style>';
$top_headers .= '<div style="float:left; width: 14px; margin: 1px;" class="pdg_column_header"></div>';
// Empty All vars
foreach ($table_columns as $config_row) {	
	if (isset($config_row['in_crud']) && !isset($config_row['in_crud_invisible']))
	{
		// Prepare Styles
		$pdg_column_styles = '';
		// Column Width
		if (isset ($config_row['column_width'])) $pdg_column_styles .= 'width:'.$config_row['column_width'].'px';
		else $pdg_column_styles .= 'width:300px;';
		$top_headers .= '<div style="margin: 1px; float:left; '.$pdg_column_styles.'" class="pdg_column_header" column="'.$config_row['name'].'">'.$config_row['text'].'</div>';		
	}
}
$top_headers .= '<div style="float:left; width: 24px; margin: 1px;" class="pdg_column_header"></div>';	
$top_headers .= '<div style="float:left; width: 60px; margin: 1px;" class="pdg_column_header"></div><div style="clear:both;"></div>';

if ($_POST['pdg_ajax'] != '1')
	echo $top_headers;
	
	
foreach ($table_arr as $table_row)
	{
		$pdg_column_html = '';
		
		// BG Color
		$line_backcolor = "";
		
		// Add block in column
		foreach ($table_columns as $config_row) {

		if (isset($config_row['in_crud'])) {
			
			$tmp_name = $config_row['name'];
			// Prepare Styles
			$pdg_column_styles = '';
			
			
			
			// Column Width
			if (isset ($config_row['column_width'])) $pdg_column_styles .= 'width:'.$config_row['column_width'].'px';
			else $pdg_column_styles .= 'width:300px;';
		
			
			
			// Update Data Cells (If it Needs)
			if (isset($config_row['input_type']))
			{				
				if ($config_row['name'] == "pdg_color")
				{
					// Check Color
					if ($table_row['pdg_color'] == 2) $line_backcolor = ";background: #ffc7c7;";
					elseif ($table_row['pdg_color'] == 3) $line_backcolor = ";background: #cfc;";
					elseif ($table_row['pdg_color'] == 4) $line_backcolor = ";background: #ccf;";
					elseif ($table_row['pdg_color'] == 5) $line_backcolor = ";background: #fff;";
					elseif ($table_row['pdg_color'] == 6) $line_backcolor = ";background: #f5f2a4;";
					else $line_backcolor = "";
				}
				elseif ($config_row['name'] == "haschild") 
				{
					if ($table_row[$tmp_name] == 1)
						{
						$pdg_column_html = '
							<div class="table_row">
							
							<div style="float:left; width: 14px;'.$line_backcolor.'" class="pdg_column_cell" line_id="'.$table_row[$key_column].'">
								<a class="open_children" href="/inside/table_tree/'.$table_name.'/'.$table_row[$key_column].'" OnClick="return false;"><i class="icon-chevron-right"></i></a>
							</div>
							'.$pdg_column_html;
						}
					else {
						$pdg_column_html = '
						
							<div class="table_row">
						
							<div style="float:left; width: 14px;'.$line_backcolor.'" class="pdg_column_cell" line_id="'.$table_row[$key_column].'">									
							</div>
							'.$pdg_column_html;
					}
				}
				else
				{
				$config_row['value'] = $table_row[$tmp_name];
				$table_row[$tmp_name] = $this->inside_lib->make_input("crud_view", $config_row);
				}
			}
			


			// Change view for JOIN columns
			if (isset ($config_row['join']))
			{
				$table_row[$tmp_name] = $table_row[$config_row['join_as']];
			}
			
			if (!isset($config_row['in_crud_invisible'])) // Hide Invisible CRUD System Columns
			$pdg_column_html .= 
				'<div style="float:left; '.$pdg_column_styles.$line_backcolor.'" class="pdg_column_cell" line_id="'.$table_row[$key_column].'">'.$table_row[$tmp_name].'</div>';
				
				
		}
		}
	$pdg_column_html .= '
	<div class="pdg_column_cell" line_id="'.$table_row[$key_column].'" style="float:left; width: 24px;'.$line_backcolor.'">
		<input type="checkbox" name="pdg_crud_checkbox[]" class="pdg_column_checkbox" line_id="'.$table_row[$key_column].'" value="'.$table_row[$key_column].'" />
	</div>
	';
	
	$pdg_column_html .= '
	<div class="pdg_column_cell" style="float:left; width: 60px;'.$line_backcolor.'" line_id="'.$table_row[$key_column].'"><div class="btn pdg_button_edit" line_id="'.$table_row[$key_column].'"><i class="icon-list-alt"></i><i class="icon-pencil"></i></div>
		<!--<a class="pdg_button_delete" line_id="'.$table_row[$key_column].'">(delete)</a>-->
	</div>
	';
	$pdg_column_html .= '<div class="clean"></div> </div>';
	echo $pdg_column_html;
	
	}


// --------------------  SQL ---------------------------------------------------
?>

<?php if ($_POST['pdg_ajax'] != '1') { ?>

<div style="font-size:9px; margin-top:12px;" id="debug_div">
<?php echo "SQL:".$sql;?>
<br />
<?php echo $debug;?>
</div>
<?php } ?>