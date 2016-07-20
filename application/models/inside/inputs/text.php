<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class text {


	public function input_form ($input_array)
	{
		return '<input style="width:'.$input_array['width'].'px" type="text" id="'.$input_array['name'].'" name="'.$input_array['name'].'" value="'.$input_array['value'].'" />';
	}

	public function input_filter ($input_array)
	{
		return '<input style="width:100px; height: 10px; border-color:green;" type="text" id="'.$input_array['name'].'" name="'.$input_array['name'].'" value="'.$input_array['value'].'" /><br />';
	}

}

?>
	