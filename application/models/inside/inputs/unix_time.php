<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Unix_Time {


	public function input_form($input_array)
	{
    	return "<input type=\"text\" name=\"".$input_array['name']."\" id=\"".$input_array['name']."\" class=\"input\" style=\"width:".$input_array['width']."px\" value=\"".@gmdate("Y-m-d H:i:s", $input_array['value'])."\" >";
	}
	public function db_save($input_array)
	{
		return strtotime($input_array['value']);
	}
	public function crud_view($input_array)
	{
		return gmdate("Y-m-d H:i:s", $input_array['value']);
	}

}

?>
	