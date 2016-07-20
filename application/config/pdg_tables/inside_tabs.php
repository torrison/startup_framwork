<?php

// inside_access_top_menu CONFIG

$i = 0;
$table_columns[$i]['name'] = 'tabs_id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'tabs_table';
$table_columns[$i]['text'] = 'Table';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['help'] = 'Table System Name';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'tabs_sysname';
$table_columns[$i]['text'] = 'System Name';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'tabs_name';
$table_columns[$i]['text'] = 'Name';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;


$i++;
$table_columns[$i]['name'] = 'tabs_description';
$table_columns[$i]['text'] = 'Description';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'tabs_priority';
$table_columns[$i]['text'] = 'Priority';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['help'] = 'For Sorting';
$table_columns[$i]['in_crud'] = true;


$table_config['key'] = 'tabs_id';


$table_config['cell_tabs_arr'] = Array (
	'main' => 'Main', 
);

?>