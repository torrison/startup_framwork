<?php

// inside_top_menu CONFIG

$i = 0;
$table_columns[$i]['name'] = 'categories_id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'categories_pid';
$table_columns[$i]['text'] = 'Parent';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'parent_select_custom';

$table_columns[$i]['select_index'] = 'categories_id';
$table_columns[$i]['select_pid_index'] = 'categories_pid';
$table_columns[$i]['select_field'] = 'categories_name';
$table_columns[$i]['select_table'] = 'it_categories';
$table_columns[$i]['rules'] = ' ORDER BY categories_pid, categories_id ASC';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'categories_haschild';
$table_columns[$i]['text'] = 'HasChild?';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'select-checkbox';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'categories_name';
$table_columns[$i]['text'] = 'Category Name';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
$translate_columns[] = $table_columns[$i];
$i++;
$table_columns[$i]['name'] = 'categories_alias';
$table_columns[$i]['text'] = 'Alias';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
/*
$i++;
$table_columns[$i]['name'] = 'categories_img';
$table_columns[$i]['text'] = 'Image MAIN (300 x 188)';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['folder'] = 'categories_img';
$table_columns[$i]['input_type'] = 'image';
$table_columns[$i]['in_crud'] = true;
$translate_columns[] = $table_columns[$i];
$i++;
$table_columns[$i]['name'] = 'categories_small_img';
$table_columns[$i]['text'] = 'Image (250 x 50)';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['folder'] = 'categories_img';
$table_columns[$i]['input_type'] = 'image';
$table_columns[$i]['in_crud'] = true;
*/
$i++;
$table_columns[$i]['name'] = 'categories_desc';
$table_columns[$i]['text'] = 'Description';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'html';
$table_columns[$i]['defend_filter'] = 2;
$table_columns[$i]['help'] = '';
$translate_columns[] = $table_columns[$i];
$i++;
$table_columns[$i]['name'] = 'categories_html';
$table_columns[$i]['text'] = 'Full HTML';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'html';
$table_columns[$i]['defend_filter'] = 2;
$table_columns[$i]['help'] = '';
$translate_columns[] = $table_columns[$i];
/*
$i++;
$table_columns[$i]['name'] = 'categories_landing';
$table_columns[$i]['text'] = 'Landing Page';
$table_columns[$i]['tab'] = 'main';
$variants = array();
	$variants[0]['id'] = '0';$variants[0]['name']="OFF";
  	$variants[1]['id'] = '1';$variants[1]['name']="Show HTML Landing";
	$variants[2]['id'] = '2';$variants[2]['name']="Load from View (off)";
$table_columns[$i]['variants'] = $variants;
$table_columns[$i]['input_type'] = 'select';
*/
$i++;
$table_columns[$i]['name'] = 'categories_invisible';
$table_columns[$i]['text'] = 'Invisible';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'select-checkbox';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'categories_priority';
$table_columns[$i]['text'] = 'Приоритет';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;


$i++;
$table_columns[$i]['name'] = 'categories_seo_title';
$table_columns[$i]['text'] = 'SEO Title';
$table_columns[$i]['tab'] = 'seo';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'categories_seo_description';
$table_columns[$i]['text'] = 'SEO Description';
$table_columns[$i]['tab'] = 'seo';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'categories_seo_keywords';
$table_columns[$i]['text'] = 'SEO KeyWords';
$table_columns[$i]['tab'] = 'seo';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;


$table_config['key'] = 'categories_id';

// System names: access = Access System, Chat = Chat communication
$table_config['cell_tabs_arr'] = Array (
	'main' => 'Main',
	'seo' => 'SEO',
	'chat' => 'Chat'
);


?>