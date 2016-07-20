<?php

// inside_top_menu CONFIG

$i = 0;
$table_columns[$i]['name'] = 'id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'name';
$table_columns[$i]['text'] = 'Group Name';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['help'] = 'System group name';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'description';
$table_columns[$i]['text'] = 'Description';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$table_config['key'] = 'id';

// System names: access = Access System, Chat = Chat communication
$table_config['cell_tabs_arr'] = Array ('main' => 'Main');

?>