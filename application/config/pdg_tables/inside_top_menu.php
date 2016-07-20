<?php

// inside_top_menu CONFIG

$i = 0;
$table_columns[$i]['name'] = 'top_menu_id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'top_menu_parent_id';
$table_columns[$i]['text'] = 'pID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'select_from_table';
$table_columns[$i]['select_table'] = 'inside_top_menu';
$table_columns[$i]['select_field'] = 'top_menu_name';
$table_columns[$i]['select_index'] = 'top_menu_id';
$table_columns[$i]['help'] = 'Родитель для данной записи. Тоесть пункт меню в котом будет находится данный блок.';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'top_menu_haschild';
$table_columns[$i]['text'] = 'Есть подменю';
$table_columns[$i]['column_width'] = '150';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'checkbox';
$table_columns[$i]['help'] = 'Если у данного блога есть выпадающие подблоки, необходимо поставить галочку тут.';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'top_menu_name';
$table_columns[$i]['text'] = 'Menu name';
$table_columns[$i]['column_width'] = '300';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['help'] = 'Текст блока меню.';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'top_menu_url';
$table_columns[$i]['text'] = 'OnClick link';
$table_columns[$i]['column_width'] = '300';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'link';
$table_columns[$i]['help'] = 'URL блока меню. Начинается с "/", если ссылка внутри сайта.';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'top_menu_invisible';
$table_columns[$i]['text'] = 'Не показывать';
$table_columns[$i]['column_width'] = '150';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'checkbox';
$table_columns[$i]['help'] = 'Если данный блок необходимо скрыть, необходимо поставить галочку тут.';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'top_menu_priority';
$table_columns[$i]['text'] = 'Приоритет';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['help'] = 'Данное поле необходимо для сортировки и выставления приоритетов, чем меньше это значение тем левее и выше будет блок. Можно использовать отрицательные значения.';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'top_menu_width';
$table_columns[$i]['text'] = 'Ширина блока';
$table_columns[$i]['column_width'] = '150';
$table_columns[$i]['tab'] = 'style';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['help'] = 'Ручная установка ширины блока в пикселях.';
$table_columns[$i]['in_crud'] = true;
$table_columns[$i]['defend_filter'] = 9;

$i++;
$table_columns[$i]['name'] = 'top_menu_widthchild';
$table_columns[$i]['text'] = 'Ширина потомков';
$table_columns[$i]['column_width'] = '150';
$table_columns[$i]['tab'] = 'style';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['help'] = 'Ручная установка ширины блока выпадающих потомков в пикселях.';


$table_config['key'] = 'top_menu_id';

// System names: access = Access System, Chat = Chat communication
$table_config['cell_tabs_arr'] = Array (
	'main' => 'Main',
	'style' => 'Style',
	'chat' => 'Chat',
	'access' => 'Access'
);

?>