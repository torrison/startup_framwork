<?php

// inside_top_menu CONFIG

$i = 0;
$table_columns[$i]['name'] = 'images_id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'images_name';
$table_columns[$i]['text'] = 'Image Name';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'images_desc';
$table_columns[$i]['text'] = 'Image Description';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'html';
$table_columns[$i]['help'] = 'Short text, for preview.';
$table_columns[$i]['defend_filter'] = 2;

$i++;
$table_columns[$i]['name'] = 'images_img';
$table_columns[$i]['text'] = 'Image File';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'image';
$table_columns[$i]['folder'] = 'adv_img';
$table_columns[$i]['in_crud'] = true;
$table_columns[$i]['resize'] = true;
$table_columns[$i]['resize_by_width'] = true;
$table_columns[$i]['new_width'] = 800;

$i++;
$table_columns[$i]['name'] = 'images_mini_img';
$table_columns[$i]['text'] = 'Image Mini (200 x 150)';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'image';
$table_columns[$i]['folder'] = 'adv_img';
$table_columns[$i]['in_crud'] = true;

$table_columns[$i]['resize'] = true;
$table_columns[$i]['crop_center'] = true;
// $table_columns[$i]['resize_by_width'] = true;
// $table_columns[$i]['resize_by_height'] = true;
$table_columns[$i]['new_width'] = 200;
$table_columns[$i]['new_height'] = 150;

$i++;
$table_columns[$i]['name'] = 'images_priority';
$table_columns[$i]['text'] = 'Priority';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'images_invisible';
$table_columns[$i]['text'] = 'Invisible';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'select-checkbox';
$table_columns[$i]['in_crud'] = true;



$table_config['key'] = 'images_id';

// System names: access = Access System, Chat = Chat communication
$table_config['cell_tabs_arr'] = Array (
	'main' => 'Main',
	'rel' => 'Relations',
	'chat' => 'Chat'
);

$i=0;
$adv_rel_inputs[$i]['name'] = 'rel_images_content';
$adv_rel_inputs[$i]['input_type'] = 'many2many';
$adv_rel_inputs[$i]['text'] = 'Content';
$adv_rel_inputs[$i]['help'] = '';
$adv_rel_inputs[$i]['table'] = 'it_content';
$adv_rel_inputs[$i]['rel_table'] = 'it_rel_images_content';
$adv_rel_inputs[$i]['this_key'] = 'images_id';
$adv_rel_inputs[$i]['rel_key'] = 'images_id';
$adv_rel_inputs[$i]['rel_join'] = 'content_id';
$adv_rel_inputs[$i]['join_key'] = 'content_id';
$adv_rel_inputs[$i]['join_name'] = 'content_name';
$adv_rel_inputs[$i]['tab'] = 'rel';





?>