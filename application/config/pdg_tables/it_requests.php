<?php

// inside_top_menu CONFIG

$i = 0;
$table_columns[$i]['name'] = 'requests_id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'requests_user_name';
$table_columns[$i]['text'] = 'User Name';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'requests_user_email';
$table_columns[$i]['text'] = 'User Email';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'requests_user_id';
$table_columns[$i]['text'] = 'User';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'select_from_table_chosen';

$table_columns[$i]['select_index'] = 'id';
$table_columns[$i]['select_field'] = 'email';
$table_columns[$i]['select_table'] = 'users';
$table_columns[$i]['filter'] = true;

$i++;
$table_columns[$i]['name'] = 'requests_user_city';
$table_columns[$i]['text'] = 'User City';
$table_columns[$i]['tab'] = 'adv';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'requests_user_phone';
$table_columns[$i]['text'] = 'User Phone';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'requests_user_site';
$table_columns[$i]['text'] = 'User WebSite';
$table_columns[$i]['tab'] = 'adv';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'requests_datetime';
$table_columns[$i]['text'] = 'Time';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'unix_time';
$table_columns[$i]['in_crud'] = true;


$i++;
$table_columns[$i]['name'] = 'requests_message';
$table_columns[$i]['text'] = 'Message';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'textarea';
$table_columns[$i]['help'] = '';

$i++;
$table_columns[$i]['name'] = 'requests_invisible';
$table_columns[$i]['text'] = 'Invisible';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'select-checkbox';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'requests_priority';
$table_columns[$i]['text'] = 'Priority';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;


$i++;
$table_columns[$i]['name'] = 'requests_type';
$table_columns[$i]['text'] = 'Type';
$table_columns[$i]['tab'] = 'main';
$variants = array();
  	$variants[0]['id'] = '1';$variants[0]['name']="Index Demo 1";
$table_columns[$i]['variants'] = $variants;
$table_columns[$i]['input_type'] = 'select';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'requests_result';
$table_columns[$i]['text'] = 'Result';
$table_columns[$i]['tab'] = 'main';
$variants = array();
  	$variants[0]['id'] = '1';$variants[0]['name']="New";
	$variants[1]['id'] = '2';$variants[1]['name']="In Communication";
  	$variants[2]['id'] = '3';$variants[2]['name']="Answered";
$table_columns[$i]['variants'] = $variants;
$table_columns[$i]['input_type'] = 'select';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'requests_url';
$table_columns[$i]['text'] = 'URL';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'link';
$table_columns[$i]['in_crud'] = true;

$table_config['key'] = 'requests_id';

// System names: access = Access System, Chat = Chat communication
$table_config['cell_tabs_arr'] = Array (
	'main' => 'Main',
	'adv' => 'Advanced',
	'chat' => 'Chat'
);

?>