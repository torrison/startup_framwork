<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class select {


	public function input_form($input_array)
	{
		
		$data = "
  		<select name=\"".$input_array['name']."\" id=\"".$input_array['name']."\" class=\"input\">
  		";
  		$variants = $input_array['variants'];
		
		// $data .= print_r ($variants); // For Debug
		
  		$i=0;
  		while (isset ($variants[$i]['id']))
  		{
  		if ($input_array['value'] == $variants[$i]['id']) $selected = " SELECTED"; else $selected = "";
    	$data .= "<option value=\"".$variants[$i]['id']."\"".$selected.">".$variants[$i]['name']."</option>";
    	$i++;
  		}
  		$data .= "
  		</select>\n\n
  		";
  		return $data;
	}
	public function crud_view($input_array)
	{
		$variants_arr = $input_array['variants'];
		if (isset($new_select_name)) unset ($new_select_name);
		
		foreach ($variants_arr as $variants)
		{
		if ($variants['id'] == $input_array['value']) $new_select_name = $variants['name'];					
		}
		
		if (isset($new_select_name)) return $new_select_name;
		else
		return 'err';
	}

  
}

?>
	