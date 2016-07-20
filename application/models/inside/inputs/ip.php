<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ip {


	public function input_form($input_array)
	{
    	return "<input type=\"text\" name=\"".$input_array['name']."\" id=\"".$input_array['name']."\" class=\"input\" style=\"width:".$input_array['width']."px\" value=\"".long2ip ($input_array['value'])."\" >";
	}
	public function db_save($input_array)
	{
		return ip2long($input_array['value']);
	}
	public function crud_view($input_array)
	{
		return long2ip($input_array['value']);
	}

}

?>
	