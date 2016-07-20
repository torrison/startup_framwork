<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Link {


	public function input_form($input_array)
	{
    	return "<input type=\"text\" name=\"".$input_array['name']."\" id=\"".$input_array['name']."\" class=\"input\" style=\"width:".$input_array['width']."px\" value=\"".$input_array['value']."\" >
		          <a style='line-height: 27px;' href='".$input_array['value']."' target='_blank'>&gt;&gt;</a>";
	}


}

?>
	