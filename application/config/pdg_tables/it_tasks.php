<?php

// inside_top_menu CONFIG

$i = 0;
$table_columns[$i]['name'] = 'tasks_id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'tasks_status';
$table_columns[$i]['text'] = 'Status';
$table_columns[$i]['tab'] = 'personal';
$variants = array();
$variants[0]['id'] = '';$variants[0]['name']="Не выбрано";
$variants[1]['id'] = '1';$variants[1]['name']="NEW";
$variants[2]['id'] = '2';$variants[2]['name']="IN PROGRESS";
$variants[3]['id'] = '3';$variants[3]['name']="FINISHED";
$table_columns[$i]['variants'] = $variants;
$table_columns[$i]['input_type'] = 'select';
$table_columns[$i]['filter'] = true;
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'tasks_user_id';
$table_columns[$i]['text'] = 'User';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'select_from_table_chosen';

$table_columns[$i]['select_index'] = 'id';
$table_columns[$i]['select_field'] = 'email';
$table_columns[$i]['select_table'] = 'users';
$table_columns[$i]['filter'] = true;
$table_columns[$i]['in_crud'] = true;
$table_columns[$i]['help'] = 'Help Info...';

$i++;
$table_columns[$i]['name'] = 'tasks_name';
$table_columns[$i]['text'] = 'Name';
$table_columns[$i]['column_width'] = '120';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'tasks_costs';
$table_columns[$i]['text'] = 'Price';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'link';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'tasks_startime';
$table_columns[$i]['text'] = 'Start';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'date';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'tasks_finishtime';
$table_columns[$i]['text'] = 'Finish';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'date';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'tasks_time';
$table_columns[$i]['text'] = 'Time';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'tasks_info';
$table_columns[$i]['text'] = 'All Info';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'html';;
$table_columns[$i]['defend_filter'] = "A";


$table_config['key'] = 'tasks_id';

// System names: access = Access System, Chat = Chat communication
$table_config['cell_tabs_arr'] = Array (
    'personal' => 'Main',
    'chat' => 'Chat'
);
