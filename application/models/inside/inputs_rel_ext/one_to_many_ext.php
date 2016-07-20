<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class One_To_Many_Ext {


	public function input_form($input_array, $cell_id)
	{
		$CI =& get_instance();
		$query = $CI->db->query("SELECT * from ".$input_array['table']);
		$res = $query->result_array();
		
		$query = $CI->db->query("SELECT * from ".$input_array['rel_table']." WHERE ".$input_array['rel_key']." = ".intval($cell_id));
		$selected_arr = $query->result_array();

		// For Debug
		//print_r($selected_arr);

		$data = 'Extended DEMO <br /><select name="'.$input_array['name'].'[]" id="'.$input_array['name'].'" multiple="multiple"  class="multiselect pdg_mselect">';
		
		foreach ($res as $join_row)
		{
		  $selected = '';
		  foreach ($selected_arr as $rel_row) {if ($rel_row[$input_array['rel_join']] == $join_row[$input_array['join_key']]) $selected = " SELECTED";}
		  
		  $data .= '<option value="'.$join_row[$input_array['join_key']].'"'.$selected.'>'.$join_row[$input_array['join_name']].' ['.$join_row[$input_array['join_key']].']</option>';
		}
		
		$data .= '</select>';
		return $data;
	}


}

?>
	