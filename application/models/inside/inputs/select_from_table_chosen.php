<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Select_from_Table_Chosen {


	public function input_form($input_array)
	{
		$CI =& get_instance();
		
		$join_column = '';
		$join = '';
		$where = '';
		
		if (isset($input_array['sql_where'])) $where = $input_array['sql_where'];
		
		if (isset($input_array['join_table'])) 
			$join = 'LEFT JOIN '.$input_array['join_table'].'
			ON '.$input_array['select_table'].'.'.$input_array['join_key'].' = '.$input_array['join_table'].'.'.$input_array['join_id'].'';
		
		if (isset($input_array['join_column'])) $join_column = ", ".$input_array['join_column'];
		
		$sql = "SELECT ".$input_array['select_index'].", ".$input_array['select_field'].$join_column." 
				FROM ".$input_array['select_table']." 
				".$join."
				".$where."				
				ORDER BY ".$input_array['select_field']." ASC";
		// echo $sql;
		$query = $CI->db->query($sql);
  		$res = $query->result_array();
		$data = '';
		$i=0;
  		foreach ($res as $row)
  		{
  		$variants[$i]['name'] = $row [$input_array['select_field']];
		
		if (isset($input_array['join_column'])) $variants[$i]['name2'] =  $row [$input_array['join_column']];
		
  		$tmp_index = $input_array['select_index'];
		$variants[$i]['id'] = $row [$tmp_index];
  		$i++;
  		}
		if (!isset($input_array['select_width'])) $input_array['select_width'] = "300";
  		$data .= "
		<select name=\"".$input_array['name']."\" class=\"chosen-select\" style=\"width:".$input_array['select_width']."px;\">
  		<option value=\"\">Не выбрано</option>
  		";
  		$i=0;
  		while (isset ($variants[$i]['id']))
  		{	
		if (isset ($variants[$i]['name2'])) $variants[$i]['name'] .= " [".$variants[$i]['name2']."]";
  		if ($input_array['value'] == $variants[$i]['id']) $selected = " SELECTED"; else $selected = "";
    	$data .= "<option value=\"".$variants[$i]['id']."\"".$selected.">".$variants[$i]['name']."</option>";
    	$i++;
  		}
  		$data .= '
  		</select>
		<script>
		$(function(){
			$(".chosen-select").chosen();
		});
		</script>
  		';
  		return $data;	}


}

?>
	