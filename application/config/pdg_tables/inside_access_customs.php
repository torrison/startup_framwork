<?php

// inside_access_top_menu CONFIG

$i = 0;
$table_columns[$i]['name'] = 'access_customs_id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'access_customs_custom_id';
$table_columns[$i]['text'] = 'Custom Zone ID';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'access_customs_group_id';
$table_columns[$i]['text'] = 'Group ID';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'access_customs_view';
$table_columns[$i]['text'] = 'View Access';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'access_customs_edit';
$table_columns[$i]['text'] = 'Edit Access';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;




$table_config['key'] = 'access_customs_id';


$table_config['cell_tabs_arr'] = Array (
	'main' => 'Main', 
);

?>