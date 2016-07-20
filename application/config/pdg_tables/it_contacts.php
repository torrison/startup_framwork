<?php

// inside_top_menu CONFIG

$i = 0;
$table_columns[$i]['name'] = 'contacts_id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'contacts_type';
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
$table_columns[$i]['name'] = 'contacts_name';
$table_columns[$i]['text'] = 'Name';
$table_columns[$i]['column_width'] = '120';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'contacts_last_name';
$table_columns[$i]['text'] = 'Last Name';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'contacts_email';
$table_columns[$i]['text'] = 'E-mail';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'contacts_company';
$table_columns[$i]['text'] = 'Company Name';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'contacts_phone';
$table_columns[$i]['text'] = 'Phone Number';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'contacts_adv_info';
$table_columns[$i]['text'] = 'Advanced Info';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'textarea';
$table_columns[$i]['in_crud'] = true;
$i++;
$table_columns[$i]['name'] = 'contacts_img';
$table_columns[$i]['text'] = 'Image';
$table_columns[$i]['tab'] = 'adv';
$table_columns[$i]['folder'] = 'users_img';
$table_columns[$i]['input_type'] = 'image';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'contacts_address';
$table_columns[$i]['text'] = 'Full Address';
$table_columns[$i]['tab'] = 'adv';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'contacts_city';
$table_columns[$i]['text'] = 'City';
$table_columns[$i]['tab'] = 'adv';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'contacts_country';
$table_columns[$i]['text'] = 'Country';
$table_columns[$i]['tab'] = 'adv';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'contacts_vk';
$table_columns[$i]['text'] = 'Vk.com';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'contacts_fb';
$table_columns[$i]['text'] = 'FaceBook.com';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'contacts_li';
$table_columns[$i]['text'] = 'LinkedIn';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'contacts_skype';
$table_columns[$i]['text'] = 'Skype';
$table_columns[$i]['tab'] = 'personal';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['in_crud'] = true;




$table_config['key'] = 'contacts_id';

// System names: access = Access System, Chat = Chat communication
$table_config['cell_tabs_arr'] = Array (
	'personal' => 'Personal',
    'rel' => 'Org',
	'adv' => 'Advanced',
	'chat' => 'Chat'
);

$i=0;
$adv_rel_inputs[$i]['name'] = 'rel_contacts_orgs';
$adv_rel_inputs[$i]['input_type'] = 'many2many';
$adv_rel_inputs[$i]['text'] = 'Organisation';
$adv_rel_inputs[$i]['help'] = '';
$adv_rel_inputs[$i]['table'] = 'it_orgs';
$adv_rel_inputs[$i]['rel_table'] = 'it_rel_contacts_orgs';
$adv_rel_inputs[$i]['this_key'] = 'contacts_id';
$adv_rel_inputs[$i]['rel_key'] = 'contacts_id';
$adv_rel_inputs[$i]['rel_join'] = 'orgs_id';
$adv_rel_inputs[$i]['join_key'] = 'orgs_id';
$adv_rel_inputs[$i]['join_name'] = 'orgs_name';
$adv_rel_inputs[$i]['tab'] = 'rel';

?>