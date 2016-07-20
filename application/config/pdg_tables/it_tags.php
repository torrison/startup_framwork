<?php

// inside_top_menu CONFIG

$i = 0;
$table_columns[$i]['name'] = 'tags_id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'tags_pid';
$table_columns[$i]['text'] = 'Parent';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'parent_select_custom';

$table_columns[$i]['select_index'] = 'tags_id';
$table_columns[$i]['select_pid_index'] = 'tags_pid';
$table_columns[$i]['select_field'] = 'tags_name';
$table_columns[$i]['select_table'] = 'it_tags';
$table_columns[$i]['rules'] = 'WHERE tags_haschild = 1 ORDER BY tags_pid, tags_id ASC';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'tags_haschild';
$table_columns[$i]['text'] = 'HasChild?';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'select-checkbox';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'tags_invisible';
$table_columns[$i]['text'] = 'Invisible?';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'select-checkbox';
$table_columns[$i]['in_crud'] = true;


$i++;
$table_columns[$i]['name'] = 'tags_name';
$table_columns[$i]['text'] = 'Tag';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'tags_desc';
$table_columns[$i]['text'] = 'Description';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'textarea';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'tags_html';
$table_columns[$i]['text'] = 'HTML';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'html';
$table_columns[$i]['defend_filter'] = 2;

$i++;
$table_columns[$i]['name'] = 'tags_landing';
$table_columns[$i]['text'] = 'Landing Page';
$table_columns[$i]['tab'] = 'main';
$variants = array();
	$variants[0]['id'] = '0';$variants[0]['name']="OFF";
  	$variants[1]['id'] = '1';$variants[1]['name']="Show HTML Landing";
	$variants[2]['id'] = '2';$variants[2]['name']="Load from View (off)";
$table_columns[$i]['variants'] = $variants;
$table_columns[$i]['input_type'] = 'select';



$table_config['key'] = 'tags_id';

// System names: access = Access System, Chat = Chat communication
$table_config['cell_tabs_arr'] = Array (
	'main' => 'Main'
);




?>