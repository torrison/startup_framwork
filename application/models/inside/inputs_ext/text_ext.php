<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class text_ext {


	public function input_form ($input_array)
	{
		return '<input style="color: red; border-color: green;" type="text" id="'.$input_array['name'].'" name="'.$input_array['name'].'" value="'.$input_array['value'].'" />';
	}


}

?>
	