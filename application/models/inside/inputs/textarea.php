<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class TextArea {


	public function input_form($input_array)
	{
    	if (!isset ($input_array['height'])) {$input_array['width'] = 500; $input_array['height'] = 200;}
    	return "<br /><textarea name=\"".$input_array['name']."\" id=\"".$input_array['name']."\" class=\"input\" style=\"width:".$input_array['width']."px;height:".$input_array['height']."px;\">".$input_array['value']."</textarea>";
	}


}

?>
	