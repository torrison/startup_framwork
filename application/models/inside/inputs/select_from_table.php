<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Select_from_Table {


	public function input_form($input_array)
	{
		$CI =& get_instance();
		$query = $CI->db->query("SELECT ".$input_array['select_index'].", ".$input_array['select_field']." FROM ".$input_array['select_table']." ORDER BY ".$input_array['select_field']." ASC");
  		$res = $query->result_array();
		$data = '';
		$i=0;
  		foreach ($res as $row)
  		{
  		$variants[$i]['name'] = $row [$input_array['select_field']];
  		$tmp_index = $input_array['select_index'];
		$variants[$i]['id'] = $row [$tmp_index];
  		$i++;
  		}
  		$data .= "
  		<select name=\"".$input_array['name']."\" id=\"".$input_array['name']."\">
  		<option value=\"\">Не выбрано</option>
  		";
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
  		return $data;	}


}

?>
	