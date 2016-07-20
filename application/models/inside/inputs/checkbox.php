<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class CheckBox {


	public function input_form($input_array)
	{
		if ($input_array['value'] == 1) $selection = " CHECKED";
		  else $selection = "";
  		return "<input type=\"checkbox\" name=\"".$input_array['name']."\" id=\"".$input_array['name']."\" class=\"input\" value=\"1\"".$selection.">";
	}
	public function crud_view($input_array)
	{
		if ($input_array['value'] == 1) return "<font color='darkgreen'>On</font>";
		else return "<font color='darkred'>Off</font>";
	}


}

?>
	