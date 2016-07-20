<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Many2Many {


	public function input_form($input_array, $cell_id)
	{
		$CI =& get_instance();
		$query = $CI->db->query("SELECT * from ".$input_array['table']);
		$res = $query->result_array();
		
		$query = $CI->db->query("SELECT * from ".$input_array['rel_table']." WHERE ".$input_array['rel_key']." = ".intval($cell_id));
		$selected_arr = $query->result_array();

		// For Debug
		//print_r($selected_arr);

		$data = '<select name="'.$input_array['name'].'[]" id="'.$input_array['name'].'" multiple="multiple"  class="multiselect pdg_mselect">';
		
		foreach ($res as $join_row)
		{
		  $selected = '';
		  foreach ($selected_arr as $rel_row) {if ($rel_row[$input_array['rel_join']] == $join_row[$input_array['join_key']]) $selected = " SELECTED";}
		  
		  $data .= '<option value="'.$join_row[$input_array['join_key']].'"'.$selected.'>'.$join_row[$input_array['join_name']].' ['.$join_row[$input_array['join_key']].']</option>';
		}
		
		$data .= '</select><br /><a href="/inside/table/'.$input_array['table'].'" target="_blank">Open join table</a><br /><br />';
		
		return $data;
	}
	public function db_save($input_array, $cell_id)
	{
		$CI =& get_instance();
		$CI->db->query("DELETE FROM ".$input_array['rel_table']." WHERE ".$input_array['rel_key']." = '".$cell_id."'");			
		if ( isset($_POST[$input_array['name']]) )
		{
			foreach ($_POST[$input_array['name']] as $join_id)
			{
			$join_id = intval($join_id);
			$data = array($input_array['rel_key'] => $cell_id, $input_array['rel_join'] => $join_id);
			$CI->db->insert($input_array['rel_table'], $data); 
			}	
		}
	}
	public function db_add($input_array, $cell_id)
	{
		$CI =& get_instance();
		if ( isset($_POST[$input_array['name']]) )
			{
				foreach ($_POST[$input_array['name']] as $join_id)
				{
				$join_id = intval($join_id);
				$data = array($input_array['rel_key'] => $cell_id, $input_array['rel_join'] => $join_id);
				$CI->db->insert($input_array['rel_table'], $data); 
				}	
			}
	}

}

?>
	