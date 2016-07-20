<?php

// inside_access_top_menu CONFIG

$i = 0;
$table_columns[$i]['name'] = 'access_rows_id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'access_rows_table';
$table_columns[$i]['text'] = 'Row Table';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'access_rows_row_id';
$table_columns[$i]['text'] = 'Row ID';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'access_rows_group_id';
$table_columns[$i]['text'] = 'Group ID';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;


$table_config['key'] = 'access_rows_id';


$table_config['cell_tabs_arr'] = Array (
	'main' => 'Main', 
);

?>