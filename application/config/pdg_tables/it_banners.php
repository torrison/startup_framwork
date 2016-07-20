<?php

// inside_top_menu CONFIG

$translate_columns = Array();

$i = 0;
$table_columns[$i]['name'] = 'banners_id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'banners_name';
$table_columns[$i]['text'] = 'Название баннера';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'banners_link';
$table_columns[$i]['text'] = 'Ссылка';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'banners_img';
$table_columns[$i]['text'] = 'Image';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['folder'] = 'banners_img';
$table_columns[$i]['input_type'] = 'image';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'banners_text';
$table_columns[$i]['text'] = 'Banner Text';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'html';
$table_columns[$i]['defend_filter'] = 2;
$table_columns[$i]['help'] = '';

$i++;
$table_columns[$i]['name'] = 'banners_invisible';
$table_columns[$i]['text'] = 'Invisible';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'select-checkbox';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'banners_type';
$table_columns[$i]['text'] = 'Type';
$table_columns[$i]['tab'] = 'main';
$variants = array();
  	$variants[0]['id'] = '1';$variants[0]['name']="Top-Main-Page (620x305)";
  	$variants[1]['id'] = '2';$variants[1]['name']="Adv-Banner ()";
$table_columns[$i]['variants'] = $variants;
$table_columns[$i]['input_type'] = 'select';

$i++;
$table_columns[$i]['name'] = 'banners_priority';
$table_columns[$i]['text'] = 'Приоритет';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
$i++;

$table_config['key'] = 'banners_id';

// System names: access = Access System, Chat = Chat communication
$table_config['cell_tabs_arr'] = Array (
	'main' => 'Main',
	'chat' => 'Chat'
);


?>