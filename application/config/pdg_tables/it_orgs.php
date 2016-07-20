<?php

// inside_top_menu CONFIG

$i = 0;
$table_columns[$i]['name'] = 'orgs_id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'orgs_type';
$table_columns[$i]['text'] = 'Type';
$table_columns[$i]['tab'] = 'personal';
$variants = array();
$variants[0]['id'] = '';$variants[0]['name']="Не выбрано";
$variants[1]['id'] = '1';$variants[1]['name']="Client";
$variants[2]['id'] = '2';$variants[2]['name']="Partner";
$table_columns[$i]['variants'] = $variants;
$table_columns[$i]['input_type'] = 'select';
$table_columns[$i]['filter'] = true;
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'orgs_name';
$table_columns[$i]['text'] = 'Name';
$table_columns[$i]['column_width'] = '120';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'orgs_site';
$table_columns[$i]['text'] = 'Web-site';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'link';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'orgs_address';
$table_columns[$i]['text'] = 'Address';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'orgs_city';
$table_columns[$i]['text'] = 'City';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'orgs_country';
$table_columns[$i]['text'] = 'Country';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'orgs_info';
$table_columns[$i]['text'] = 'All Info';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'textarea';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'orgs_img';
$table_columns[$i]['text'] = 'Image';
$table_columns[$i]['tab'] = 'adv';
$table_columns[$i]['folder'] = 'users_img';
$table_columns[$i]['input_type'] = 'image';
$table_columns[$i]['in_crud'] = true;


$table_config['key'] = 'orgs_id';

// System names: access = Access System, Chat = Chat communication
$table_config['cell_tabs_arr'] = Array (
    'personal' => 'Main',
    'chat' => 'Chat'
);


?>