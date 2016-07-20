<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Text_NoEdit {


	public function input_form($input_array)
	{
    	return "
		<span id=\"".$input_array['name']."\" class=\"input\" style=\"width:".$input_array['width']."px\">".$input_array['value']."</span>
		<input type=\"hidden\" name=\"".$input_array['name']."\" id=\"".$input_array['name']."\" value=\"".$input_array['value']."\" >
		";
	}


}

?>
	