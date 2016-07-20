<?php

// inside_left_menu CONFIG

$i = 0;
$table_columns[$i]['name'] = 'menu_id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'menu_pid';
$table_columns[$i]['text'] = 'Родитель';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'parent_select_custom';

$table_columns[$i]['select_index'] = 'menu_id';
$table_columns[$i]['select_pid_index'] = 'menu_pid';
$table_columns[$i]['select_field'] = 'menu_name';
$table_columns[$i]['select_table'] = 'it_menu';
$table_columns[$i]['rules'] = ' ORDER BY menu_pid, menu_id ASC';
$table_columns[$i]['in_crud'] = true;


$i++;
$table_columns[$i]['name'] = 'menu_haschild';
$table_columns[$i]['text'] = 'HasChild?';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'select-checkbox';
$table_columns[$i]['in_crud'] = true;


$i++;
$table_columns[$i]['name'] = 'menu_name';
$table_columns[$i]['text'] = 'Название вкладки';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'menu_url';
$table_columns[$i]['text'] = 'URL';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'menu_invisible';
$table_columns[$i]['text'] = 'Невидимость';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'select-checkbox';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'menu_priority';
$table_columns[$i]['text'] = 'Приоритет';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;


$table_config['key'] = 'menu_id';

// System names: access = Access System, Chat = Chat communication
$table_config['cell_tabs_arr'] = Array (
	'main' => 'Main',
	'seo' => 'SEO',
	'chat' => 'Chat'
);

?>