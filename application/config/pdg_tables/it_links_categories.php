<?php

// inside_top_menu CONFIG

$i = 0;
$table_columns[$i]['name'] = 'links_categories_id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'links_categories_pid';
$table_columns[$i]['text'] = 'Parent';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'parent_select_custom';

$table_columns[$i]['select_index'] = 'links_categories_id';
$table_columns[$i]['select_pid_index'] = 'links_categories_pid';
$table_columns[$i]['select_field'] = 'links_categories_name';
$table_columns[$i]['select_table'] = 'it_links_categories';
$table_columns[$i]['rules'] = ' ORDER BY links_categories_pid, links_categories_id ASC';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'links_categories_haschild';
$table_columns[$i]['text'] = 'HasChild?';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'select-checkbox';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'links_categories_name';
$table_columns[$i]['text'] = 'Category Name';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'links_categories_alias';
$table_columns[$i]['text'] = 'Alias';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'links_categories_desc';
$table_columns[$i]['text'] = 'Description';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'html';
$table_columns[$i]['defend_filter'] = 2;
$table_columns[$i]['help'] = '';
$i++;
$table_columns[$i]['name'] = 'links_categories_invisible';
$table_columns[$i]['text'] = 'Invisible';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'select-checkbox';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'links_categories_priority';
$table_columns[$i]['text'] = 'Priority';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;


$table_config['key'] = 'links_categories_id';

// System names: access = Access System, Chat = Chat communication
$table_config['cell_tabs_arr'] = Array (
	'main' => 'Main',
	'chat' => 'Chat'
);


?>