<?php

// inside_top_menu CONFIG

$i = 0;
$table_columns[$i]['name'] = 'buy_block_id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'buy_block_name';
$table_columns[$i]['text'] = 'Name';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'buy_block_button_text';
$table_columns[$i]['text'] = 'Button Text';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'buy_block_html';
$table_columns[$i]['text'] = 'HTML';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'html';
$table_columns[$i]['defend_filter'] = 2;

$i++;
$table_columns[$i]['name'] = 'buy_block_video';
$table_columns[$i]['text'] = 'Video YouTube';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;


$i++;
$table_columns[$i]['name'] = 'buy_block_img';
$table_columns[$i]['text'] = 'OR Image (200 x 150)';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'image';
$table_columns[$i]['folder'] = 'adv_img';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'buy_block_priority';
$table_columns[$i]['text'] = 'Priority';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'buy_block_invisible';
$table_columns[$i]['text'] = 'Invisible';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'select-checkbox';
$table_columns[$i]['in_crud'] = true;




$table_config['key'] = 'buy_block_id';

// System names: access = Access System, Chat = Chat communication
$table_config['cell_tabs_arr'] = Array (
	'main' => 'Main',
	'rel' => 'Relations',	
	'chat' => 'Chat'
);


$i=0;
$adv_rel_inputs[$i]['name'] = 'rel_buy_block_content';
$adv_rel_inputs[$i]['input_type'] = 'many2many';
$adv_rel_inputs[$i]['text'] = 'Content';
$adv_rel_inputs[$i]['help'] = '';
$adv_rel_inputs[$i]['table'] = 'it_content';
$adv_rel_inputs[$i]['rel_table'] = 'it_rel_buy_block_content';
$adv_rel_inputs[$i]['this_key'] = 'buy_block_id';
$adv_rel_inputs[$i]['rel_key'] = 'buy_block_id';
$adv_rel_inputs[$i]['rel_join'] = 'content_id';
$adv_rel_inputs[$i]['join_key'] = 'content_id';
$adv_rel_inputs[$i]['join_name'] = 'content_name';
$adv_rel_inputs[$i]['tab'] = 'rel';

?>