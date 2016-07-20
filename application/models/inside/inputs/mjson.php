<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MJSON {


	public function input_form($input_array)
	{
		return '<input type="text" id="'.$input_array['name'].'" name="'.$input_array['name'].'" value="'.$input_array['value'].'" />';
	}


}

?>
	