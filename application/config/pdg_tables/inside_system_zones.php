<?php

// inside_access_top_menu CONFIG

$i = 0;
$table_columns[$i]['name'] = 'system_zones_id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'system_zones_name';
$table_columns[$i]['text'] = 'Name';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['help'] = 'System Name';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'system_zones_description';
$table_columns[$i]['text'] = 'Description';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['help'] = 'Description';
$table_columns[$i]['in_crud'] = true;


$table_config['key'] = 'system_zones_id';


$table_config['cell_tabs_arr'] = Array (
	'main' => 'Main', 
);

?>