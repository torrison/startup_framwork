<?php

// inside_top_menu CONFIG

$i = 0;
$table_columns[$i]['name'] = 'orders_id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'orders_name';
$table_columns[$i]['text'] = 'User Name';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'orders_email';
$table_columns[$i]['text'] = 'User Email';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;


$i++;
$table_columns[$i]['name'] = 'orders_user_id';
$table_columns[$i]['text'] = 'User in DB';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'select_from_table_chosen';

$table_columns[$i]['select_index'] = 'id';
$table_columns[$i]['select_field'] = 'email';
$table_columns[$i]['select_table'] = 'users';
$table_columns[$i]['filter'] = true;

$i++;
$table_columns[$i]['name'] = 'orders_cname';
$table_columns[$i]['text'] = 'User Company';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'orders_phone';
$table_columns[$i]['text'] = 'User Phone';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'orders_info';
$table_columns[$i]['text'] = 'Order Info';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'textarea';
$table_columns[$i]['help'] = '';

$i++;
$table_columns[$i]['name'] = 'orders_advanced_info';
$table_columns[$i]['text'] = 'Advanced Info';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['help'] = '';

$i++;
$table_columns[$i]['name'] = 'orders_full_address';
$table_columns[$i]['text'] = 'Full address';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';

$i++;
$table_columns[$i]['name'] = 'orders_lat';
$table_columns[$i]['text'] = 'Lat';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';

$i++;
$table_columns[$i]['name'] = 'orders_lng';
$table_columns[$i]['text'] = 'Lng';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';

$i++;
$table_columns[$i]['name'] = 'orders_street';
$table_columns[$i]['text'] = 'Street';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';

$i++;
$table_columns[$i]['name'] = 'orders_number';
$table_columns[$i]['text'] = 'Building Number';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';

$i++;
$table_columns[$i]['name'] = 'orders_city';
$table_columns[$i]['text'] = 'User City';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'orders_district';
$table_columns[$i]['text'] = 'User District';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';

$i++;
$table_columns[$i]['name'] = 'orders_country';
$table_columns[$i]['text'] = 'User Country';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';


$i++;
$table_columns[$i]['name'] = 'orders_datetime';
$table_columns[$i]['text'] = 'Time';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'unix_time';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'orders_status';
$table_columns[$i]['text'] = 'Status';
$table_columns[$i]['tab'] = 'main';
$variants = array();
  	$variants[0]['id'] = '1';$variants[0]['name']="New Order!";
	$variants[1]['id'] = '2';$variants[1]['name']="In Communication";
	$variants[2]['id'] = '3';$variants[2]['name']="In Progress";
	$variants[3]['id'] = '4';$variants[3]['name']="In Delivery";
	$variants[4]['id'] = '5';$variants[4]['name']="Delivered";
	$variants[5]['id'] = '6';$variants[5]['name']="Paided";
	$variants[6]['id'] = '7';$variants[6]['name']="Finished!";
$table_columns[$i]['variants'] = $variants;
$table_columns[$i]['input_type'] = 'select';
$table_columns[$i]['in_crud'] = true;





$table_config['key'] = 'orders_id';

// System names: access = Access System, Chat = Chat communication
$table_config['cell_tabs_arr'] = Array (
	'main' => 'Main',
	'chat' => 'Chat'
);


?>