<?php

// brands CONFIG
$translate_columns = Array();

$i = 0;
$table_columns[$i]['name'] = 'brands_id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'brands_name';
$table_columns[$i]['text'] = 'Content Title';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'brands_img';
$table_columns[$i]['text'] = 'Image (150 x 120)';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'image';
$table_columns[$i]['folder'] = 'brands_img';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'brands_priority';
$table_columns[$i]['text'] = 'Priority';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'brands_invisible';
$table_columns[$i]['text'] = 'Invisible';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'select-checkbox';
$table_columns[$i]['in_crud'] = true;



$table_config['key'] = 'brands_id';

// System names: access = Access System, Chat = Chat communication
$table_config['cell_tabs_arr'] = Array (
	'main' => 'Main',
	'chat' => 'Chat'
);

?>