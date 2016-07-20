<?php 


// demo_parfums CONFIG

$i = 0;
$table_columns[$i]['name'] = 'id';
$table_columns[$i]['text'] = 'ID';
$table_columns[$i]['column_width'] = '100';
$table_columns[$i]['in_crud'] = true;

$i++;
$table_columns[$i]['name'] = 'select_input';
$table_columns[$i]['text'] = 'SELECT';
$table_columns[$i]['tab'] = 'main';
	$variants = array();
	$variants[0]['id'] = '1';$variants[0]['name']='Value 1';
	$variants[1]['id'] = '2';$variants[1]['name']='Second Value';
	$variants[2]['id'] = '3';$variants[2]['name']='3th Value';
$table_columns[$i]['variants'] = $variants;	
$table_columns[$i]['input_type'] = 'select';
$table_columns[$i]['in_crud'] = true;
$table_columns[$i]['help'] = 
"
\$i++;<br />
\$table_columns[\$i]['name'] = 'select_input';<br />
\$table_columns[\$i]['text'] = 'SELECT';<br />
\$table_columns[\$i]['tab'] = 'main';<br />
&nbsp;&nbsp;&nbsp;&nbsp;\$variants = array();<br />
&nbsp;&nbsp;&nbsp;&nbsp;\$variants[0]['id'] = '1';\$variants[0]['name']='Value 1';<br />
&nbsp;&nbsp;&nbsp;&nbsp;\$variants[1]['id'] = '2';\$variants[1]['name']='Second Value';<br />
&nbsp;&nbsp;&nbsp;&nbsp;\$variants[2]['id'] = '3';\$variants[2]['name']='3th Value';<br />
\$table_columns[\$i]['variants'] = \$variants;	<br />
\$table_columns[\$i]['input_type'] = 'select';<br />
\$table_columns[\$i]['in_crud'] = true;<br />
\$table_columns[\$i]['help'] = 'Help Info...';
";



$i++;
$table_columns[$i]['name'] = 'text';
$table_columns[$i]['text'] = 'Text Field';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text';
$table_columns[$i]['column_width'] = '300';
$table_columns[$i]['in_crud'] = true;
$table_columns[$i]['help'] = 
"
\$i++;<br />
\$table_columns[\$i]['name'] = 'text';<br />
\$table_columns[\$i]['text'] = 'Text Field';<br />
\$table_columns[\$i]['tab'] = 'main';<br />
\$table_columns[\$i]['input_type'] = 'text';<br />
\$table_columns[\$i]['column_width'] = '300';<br />
\$table_columns[\$i]['in_crud'] = true;<br />
\$table_columns[\$i]['help'] = 'Help Info...';<br />
";

$i++;
$table_columns[$i]['name'] = 'text_ext';
$table_columns[$i]['text'] = 'Text Field (Extended)';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'text_ext';
$table_columns[$i]['help'] = 
"
// Extended input, from: /models/inside/inputs_ext/text_ext.php<br />
\$i++;<br />
\$table_columns[\$i]['name'] = 'text_ext';<br />
\$table_columns[\$i]['text'] = 'Text Field (Extended)';<br />
\$table_columns[\$i]['tab'] = 'main';<br />
\$table_columns[\$i]['input_type'] = 'text_ext';<br />
\$table_columns[\$i]['help'] = 'Help Info...';<br />
";

$i++;
$table_columns[$i]['name'] = 'select_checkbox';
$table_columns[$i]['text'] = 'SELECT-CHECKBOX';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'select-checkbox';
$table_columns[$i]['in_crud'] = true;
$table_columns[$i]['filter'] = true;
$table_columns[$i]['help'] = 
"
\$i++;<br />
\$table_columns[\$i]['name'] = 'select_checkbox';<br />
\$table_columns[\$i]['text'] = 'SELECT-CHECKBOX';<br />
\$table_columns[\$i]['tab'] = 'main';<br />
\$table_columns[\$i]['input_type'] = 'select-checkbox';<br />
\$table_columns[\$i]['in_crud'] = true;<br />
\$table_columns[\$i]['filter'] = true;<br />
\$table_columns[\$i]['help'] = 'Help Info...';<br />
";

$i++;
$table_columns[$i]['name'] = 'checkbox';
$table_columns[$i]['text'] = 'CHECKBOX';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'checkbox';
$table_columns[$i]['in_crud'] = true;
$table_columns[$i]['help'] = 
"
\$i++;<br />
\$table_columns[\$i]['name'] = 'checkbox';<br />
\$table_columns[\$i]['text'] = 'CHECKBOX';<br />
\$table_columns[\$i]['tab'] = 'main';<br />
\$table_columns[\$i]['input_type'] = 'checkbox';<br />
\$table_columns[\$i]['in_crud'] = true;<br />
\$table_columns[\$i]['help'] = 'Help Info...';<br />
";

$i++;
$table_columns[$i]['name'] = 'user_select';
$table_columns[$i]['text'] = 'USER SELECT';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'user_select';
$table_columns[$i]['table'] = 'users';
$table_columns[$i]['field'] = 'email';
$table_columns[$i]['column_width'] = '200';
$table_columns[$i]['in_crud'] = true;
$table_columns[$i]['help'] = 
"
// Easy User AutoComplite Select (in development)<br />
\$i++;<br />
\$table_columns[\$i]['name'] = 'user_select';<br />
\$table_columns[\$i]['text'] = 'USER SELECT';<br />
\$table_columns[\$i]['tab'] = 'main';<br />
\$table_columns[\$i]['input_type'] = 'user_select';<br />
\$table_columns[\$i]['table'] = 'users';<br />
\$table_columns[\$i]['field'] = 'email';<br />
\$table_columns[\$i]['column_width'] = '200';<br />
\$table_columns[\$i]['in_crud'] = true;<br />
";

$i++;
$table_columns[$i]['name'] = 'date';
$table_columns[$i]['text'] = 'DATE';
$table_columns[$i]['tab'] = 'adv';
$table_columns[$i]['input_type'] = 'date';
$table_columns[$i]['help'] = 
"
\$i++;<br />
\$table_columns[\$i]['name'] = 'date';<br />
\$table_columns[\$i]['text'] = 'DATE';<br />
\$table_columns[\$i]['tab'] = 'adv';<br />
\$table_columns[\$i]['input_type'] = 'date';<br />
\$table_columns[\$i]['help'] = 'Help Info...';<br />
";


$i++;
$table_columns[$i]['name'] = 'html';
$table_columns[$i]['text'] = 'HTML Editor';
$table_columns[$i]['tab'] = 'adv';
$table_columns[$i]['input_type'] = 'html';
$table_columns[$i]['help'] = 
"
\$i++;<br />
\$table_columns[\$i]['name'] = 'html';<br />
\$table_columns[\$i]['text'] = 'HTML Editor';<br />
\$table_columns[\$i]['tab'] = 'adv';<br />
\$table_columns[\$i]['input_type'] = 'html';<br />
\$table_columns[\$i]['help'] = 'Help Info...';<br />
";

$i++;
$table_columns[$i]['name'] = 'ip';
$table_columns[$i]['text'] = 'IP Address';
$table_columns[$i]['tab'] = 'adv';
$table_columns[$i]['input_type'] = 'ip';
$table_columns[$i]['help'] = 
"
// IP in integer<br />
\$i++;<br />
\$table_columns[\$i]['name'] = 'ip';<br />
\$table_columns[\$i]['text'] = 'IP Address';<br />
\$table_columns[\$i]['tab'] = 'adv';<br />
\$table_columns[\$i]['input_type'] = 'ip';<br />
\$table_columns[\$i]['help'] = 'Help Info...';<br />
";

$i++;
$table_columns[$i]['name'] = 'link';
$table_columns[$i]['text'] = 'Link';
$table_columns[$i]['tab'] = 'adv';
$table_columns[$i]['input_type'] = 'link';
$table_columns[$i]['help'] = 
"
// Input = text with link<br />
\$i++;<br />
\$table_columns[\$i]['name'] = 'link';<br />
\$table_columns[\$i]['text'] = 'Link';<br />
\$table_columns[\$i]['tab'] = 'adv';<br />
\$table_columns[\$i]['input_type'] = 'link';<br />
\$table_columns[\$i]['help'] = 'Help Info...';<br />
";

$i++;
$table_columns[$i]['name'] = 'password';
$table_columns[$i]['text'] = 'Password';
$table_columns[$i]['tab'] = 'adv';
$table_columns[$i]['input_type'] = 'password';
$table_columns[$i]['help'] = 
"
\$i++;<br />
\$table_columns[\$i]['name'] = 'password';<br />
\$table_columns[\$i]['text'] = 'Password';<br />
\$table_columns[\$i]['tab'] = 'adv';<br />
\$table_columns[\$i]['input_type'] = 'password';<br />
\$table_columns[\$i]['help'] = 'Help Info...';<br />
";

$i++;
$table_columns[$i]['name'] = 'text_noedit';
$table_columns[$i]['text'] = 'Noedit text';
$table_columns[$i]['tab'] = 'adv';
$table_columns[$i]['input_type'] = 'text_noedit';
$table_columns[$i]['help'] = 
"
\$i++;<br />
\$table_columns[\$i]['name'] = 'text_noedit';<br />
\$table_columns[\$i]['text'] = 'Noedit text';<br />
\$table_columns[\$i]['tab'] = 'adv';<br />
\$table_columns[\$i]['input_type'] = 'text_noedit';<br />
\$table_columns[\$i]['help'] = 'Help Info...';<br />
";

$i++;
$table_columns[$i]['name'] = 'unix_time';
$table_columns[$i]['text'] = 'UnixTime';
$table_columns[$i]['tab'] = 'adv';
$table_columns[$i]['input_type'] = 'unix_time';
$table_columns[$i]['in_crud'] = true;
$table_columns[$i]['help'] = 
"
\$i++;<br />
\$table_columns[\$i]['name'] = 'unix_time';<br />
\$table_columns[\$i]['text'] = 'UnixTime';<br />
\$table_columns[\$i]['tab'] = 'adv';<br />
\$table_columns[\$i]['input_type'] = 'unix_time';<br />
\$table_columns[\$i]['in_crud'] = true;<br />
\$table_columns[\$i]['help'] = 'Help Info...';<br />
";

$i++;
$table_columns[$i]['name'] = 'textarea';
$table_columns[$i]['text'] = 'TEXTAREA';
$table_columns[$i]['tab'] = 'adv';
$table_columns[$i]['input_type'] = 'textarea';
$table_columns[$i]['help'] = 
"
\$i++;<br />
\$table_columns[\$i]['name'] = 'textarea';<br />
\$table_columns[\$i]['text'] = 'TEXTAREA';<br />
\$table_columns[\$i]['tab'] = 'adv';<br />
\$table_columns[\$i]['input_type'] = 'textarea';<br />
\$table_columns[\$i]['help'] = 'Help Info...';<br />
";

$i++;
$table_columns[$i]['name'] = 'image';
$table_columns[$i]['text'] = 'Image Upload';
$table_columns[$i]['folder'] = 'images';
$table_columns[$i]['tab'] = 'main';
$table_columns[$i]['input_type'] = 'image';
$table_columns[$i]['help'] = 
"
\$i++;<br />
\$table_columns[\$i]['name'] = 'image';<br />
\$table_columns[\$i]['text'] = 'Image Upload';<br />
\$table_columns[\$i]['folder'] = 'images'; // Folder in /files/uploads/<br />
\$table_columns[\$i]['tab'] = 'main';<br />
\$table_columns[\$i]['input_type'] = 'image';<br />
\$table_columns[\$i]['help'] = 'Help Info...';<br />
";

$i++;
$table_columns[$i]['name'] = 'ac_select_from_table';
$table_columns[$i]['text'] = 'Autocomplite Select From Table';
$table_columns[$i]['tab'] = 'rel';
$table_columns[$i]['input_type'] = 'ac_select_from_table';

$table_columns[$i]['select_index'] = 'id';
$table_columns[$i]['select_field'] = 'email';
$table_columns[$i]['select_table'] = 'users';

$table_columns[$i]['column_width'] = '300';
$table_columns[$i]['in_crud'] = true;
$table_columns[$i]['help'] = 
"
// Easy User AutoComplite Select<br />
\$i++;<br />
\$table_columns[\$i]['name'] = 'ac_select_from_table';<br />
\$table_columns[\$i]['text'] = 'Autocomplite Select From Table';<br />
\$table_columns[\$i]['tab'] = 'rel';<br />
\$table_columns[\$i]['input_type'] = 'ac_select_from_table';<br />
<br />
\$table_columns[\$i]['select_index'] = 'id';<br />
\$table_columns[\$i]['select_field'] = 'email';<br />
\$table_columns[\$i]['select_table'] = 'users';<br />
<br />
\$table_columns[\$i]['column_width'] = '300';<br />
\$table_columns[\$i]['in_crud'] = true;<br />
\$table_columns[\$i]['help'] = 'Help Info...';<br />
";


$i++;
$table_columns[$i]['name'] = 'select_from_table';
$table_columns[$i]['text'] = 'Select From Table';
$table_columns[$i]['tab'] = 'rel';
$table_columns[$i]['input_type'] = 'select_from_table_chosen';

$table_columns[$i]['select_index'] = 'id';
$table_columns[$i]['select_field'] = 'email';
$table_columns[$i]['select_table'] = 'users';
$table_columns[$i]['filter'] = true;

$table_columns[$i]['help'] = 
"
\$i++;<br />
\$table_columns[\$i]['name'] = 'select_from_table';<br />
\$table_columns[\$i]['text'] = 'Select From Table';<br />
\$table_columns[\$i]['tab'] = 'rel';<br />
\$table_columns[\$i]['input_type'] = 'select_from_table_chosen';<br />
<br />
\$table_columns[\$i]['select_index'] = 'id';<br />
\$table_columns[\$i]['select_field'] = 'email';<br />
\$table_columns[\$i]['select_table'] = 'users';<br />
\$table_columns[\$i]['filter'] = true;<br />
<br />
\$table_columns[\$i]['help'] = 'Help Info...';<br />
";

$i++;
$table_columns[$i]['name'] = 'parent_select_custom';
$table_columns[$i]['text'] = 'TREE Select From Table';
$table_columns[$i]['tab'] = 'rel';
$table_columns[$i]['input_type'] = 'parent_select_custom';

$table_columns[$i]['select_index'] = 'top_menu_id';
$table_columns[$i]['select_pid_index'] = 'top_menu_parent_id';
$table_columns[$i]['select_field'] = 'top_menu_name';
$table_columns[$i]['select_table'] = 'inside_top_menu';
$table_columns[$i]['rules'] = ' ORDER BY top_menu_parent_id, top_menu_id ASC';

$table_columns[$i]['help'] = 
"
\$i++;<br />
\$table_columns[\$i]['name'] = 'parent_select_custom';<br />
\$table_columns[\$i]['text'] = 'TREE Select From Table';<br />
\$table_columns[\$i]['tab'] = 'rel';<br />
\$table_columns[\$i]['input_type'] = 'parent_select_custom';<br />
<br />
\$table_columns[\$i]['select_index'] = 'top_menu_id';<br />
\$table_columns[\$i]['select_pid_index'] = 'top_menu_parent_id';<br />
\$table_columns[\$i]['select_field'] = 'top_menu_name';<br />
\$table_columns[\$i]['select_table'] = 'inside_top_menu';<br />
\$table_columns[\$i]['rules'] = ' ORDER BY top_menu_parent_id, top_menu_id ASC';<br />
<br />
\$table_columns[\$i]['help'] = 'Help Info...';<br />
";

$i++;
$table_columns[$i]['name'] = 'serialize_arr';
$table_columns[$i]['text'] = 'Serialize indexes in array';
$table_columns[$i]['tab'] = 'rel';
$table_columns[$i]['input_type'] = 'serialize_arr';

$table_columns[$i]['rel_key'] = 'id';
$table_columns[$i]['rel_name'] = 'email';
$table_columns[$i]['rel_name2'] = 'username';
$table_columns[$i]['rel_table'] = 'users';
$table_columns[$i]['help'] = 
"
\$i++;<br />
\$table_columns[\$i]['name'] = 'serialize_arr';<br />
\$table_columns[\$i]['text'] = 'Serialize indexes in array';<br />
\$table_columns[\$i]['tab'] = 'rel';<br />
\$table_columns[\$i]['input_type'] = 'serialize_arr';<br />
<br />
\$table_columns[\$i]['rel_key'] = 'id';<br />
\$table_columns[\$i]['rel_name'] = 'email';<br />
\$table_columns[\$i]['rel_name2'] = 'username';<br />
\$table_columns[\$i]['rel_table'] = 'users';<br />
<br />
\$table_columns[\$i]['help'] = 'Help Info...';<br />
";

$table_config['key'] = 'id';

// System names: access = Access System, Chat = Chat communication
$table_config['cell_tabs_arr'] = Array ('main' => 'Main', 'adv' => 'Advanced', 'rel' => 'Relations');


?>