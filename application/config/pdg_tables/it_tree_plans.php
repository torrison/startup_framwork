<?php 


// demo_parfums CONFIG


$i = 0;

// Must Be First!

$table_columns[$i]['name'] = 'pdg_color';
$table_columns[$i]['text'] = 'Color';
$table_columns[$i]['tab'] = 'main';
	$variants = array();
	$variants[0]['id'] = '1';$variants[0]['name']="Стандартный";
	$variants[1]['id'] = '2';$variants[1]['name']="Красный";
	$variants[2]['id'] = '3';$variants[2]['name']="Зеленый";
	$variants[3]['id'] = '4';$variants[3]['name']="Синий";
	$variants[4]['id'] = '5';$variants[4]['name']="Белый";
	$variants[5]['id'] = '6';$variants[5]['name']="Оранжевый";
$table_columns[$i]['variants'] = $variants;	
$table_columns[$i]['input_type'] = 'select';
$table_columns[$i]['in_crud'] = true;
$table_columns[$i]['in_crud_invisible'] = true;

$i++;
$table_columns[$i]['name'] = 'id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;



$i++;
$table_columns[$i]['name'] = 'name';
$table_columns[$i]['text'] = 'Task Name';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['column_width'] = '400';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'content';
$table_columns[$i]['text'] = 'Info';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'html';
$table_columns[$i]['defend_filter'] = 2;

$i++;
$table_columns[$i]['name'] = 'parent_id';
$table_columns[$i]['text'] = 'Parent';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text'; // parent_select_custom - slow speed
$table_columns[$i]['select_table'] = 'demo_orders';
$table_columns[$i]['select_field'] = 'name';
$table_columns[$i]['select_pid_index'] = 'parent_id';
$table_columns[$i]['select_index'] = 'id';
$table_columns[$i]['rules'] = 'ORDER BY parent_id, name ASC';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'haschild';
$table_columns[$i]['text'] = 'Has child';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'select-checkbox';
$table_columns[$i]['in_crud'] = true;
$table_columns[$i]['in_crud_invisible'] = true;

$i++;
$table_columns[$i]['name'] = 'user_id';
$table_columns[$i]['text'] = 'Manager';
$table_columns[$i]['tab'] = 'adv';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['table'] = 'users';
$table_columns[$i]['field'] = 'email';
$table_columns[$i]['column_width'] = '100';

$i++;
$table_columns[$i]['name'] = 'worktime';
$table_columns[$i]['text'] = 'Worktime';
$table_columns[$i]['tab'] = 'adv';
$table_columns[$i]['input_type'] = 'text';

$i++;
$table_columns[$i]['name'] = 'price';
$table_columns[$i]['text'] = 'Price';
$table_columns[$i]['tab'] = 'adv';
$table_columns[$i]['input_type'] = 'text';

$i++;
$table_columns[$i]['name'] = 'profit';
$table_columns[$i]['text'] = 'Profit';
$table_columns[$i]['tab'] = 'adv';
$table_columns[$i]['input_type'] = 'text';

$i++;
$table_columns[$i]['name'] = 'priority';
$table_columns[$i]['text'] = 'Priority';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';


$table_config['key'] = 'id';

// System names: access = Access System, Chat = Chat communication
$table_config['cell_tabs_arr'] = Array ('main' => 'Main', 'adv' => 'Advanced', 'chat' => 'Chat');

?>