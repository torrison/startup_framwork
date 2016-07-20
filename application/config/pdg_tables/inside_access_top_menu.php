<?php

// inside_access_top_menu CONFIG

$i = 0;
$table_columns[$i]['name'] = 'access_top_menu_id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'access_top_menu_block_id';
$table_columns[$i]['text'] = 'Inside Menu Block ID';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'access_top_menu_group_id';
$table_columns[$i]['text'] = 'Rel Group ID';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;


$table_config['key'] = 'access_top_menu_id';

// System names: access = Access System, Chat = Chat communication
$table_config['cell_tabs_arr'] = Array (
	'main' => 'Main', 
);

?>