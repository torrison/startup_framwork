<?php

// inside_top_menu CONFIG

$i = 0;
$table_columns[$i]['name'] = 'comments_id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'comments_invisible';
$table_columns[$i]['text'] = 'Invisible';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'select-checkbox';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'comments_fio';
$table_columns[$i]['text'] = 'Name';
$table_columns[$i]['tab'] = 'adv';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'comments_email';
$table_columns[$i]['text'] = 'Email';
$table_columns[$i]['tab'] = 'adv';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'comments_user_id';
$table_columns[$i]['text'] = 'User';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'select_from_table_chosen';

$table_columns[$i]['select_index'] = 'id';
$table_columns[$i]['select_field'] = 'email';
$table_columns[$i]['select_table'] = 'users';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'comments_text';
$table_columns[$i]['text'] = 'Comment Text';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'textarea';

$i++;
$table_columns[$i]['name'] = 'comments_datetime';
$table_columns[$i]['text'] = 'DateTime';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'unix_time';
$table_columns[$i]['in_crud'] = true;

/*
$i++;
$table_columns[$i]['name'] = 'comments_date';
$table_columns[$i]['text'] = 'Дата';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'date';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'comments_time';
$table_columns[$i]['text'] = 'Время';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'unix_time';
$table_columns[$i]['in_crud'] = true;
*/

$i++;
$table_columns[$i]['name'] = 'comments_source';
$table_columns[$i]['text'] = 'Source';
$table_columns[$i]['tab'] = 'main';
$variants = array();
  	$variants[0]['id'] = '1';$variants[0]['name']="Content";
  	$variants[1]['id'] = '2';$variants[1]['name']="Service";
	$variants[2]['id'] = '3';$variants[2]['name']="Brands";
$table_columns[$i]['variants'] = $variants;
$table_columns[$i]['input_type'] = 'select';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'comments_source_id';
$table_columns[$i]['text'] = 'Material ID';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'comments_parent_id';
$table_columns[$i]['text'] = 'Parent ID';
$table_columns[$i]['tab'] = 'adv';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'comments_link';
$table_columns[$i]['text'] = 'Link to Comment';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'link';

$table_config['key'] = 'comments_id';

// System names: access = Access System, Chat = Chat communication
$table_config['cell_tabs_arr'] = Array (
	'main' => 'Main',
	'adv' => 'Advanced',
	'chat' => 'Chat'
);

?>