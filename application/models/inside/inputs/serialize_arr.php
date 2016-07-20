<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Serialize_arr {


	public function input_form($input_array)
	{
      $CI =& get_instance();
	  $columns = $input_array['rel_name'];
	  if (isset($input_array['rel_name2'])) $columns .= ', '.$input_array['rel_name2'];
	  if (isset($input_array['rel_name3'])) $columns .= ', '.$input_array['rel_name3'];
      $columns = $input_array['rel_key'].", ".$columns;
	  
	  $join = '';
	  if (isset($input_array['rel_table_join'])) {	  
		  $join = ' LEFT JOIN '.$input_array['rel_table_join']." ON ".$input_array['rel_name_join']." = ".$input_array['rel_third_table_key'];
		  $columns = $input_array['rel_third_table_name'].", ".$columns;
	  }
      $query = $CI->db->query("SELECT $columns FROM ".$input_array['rel_table'].$join." ORDER BY ".$input_array['rel_name']." ASC");
      $res = $query->result_array();      
      $selected_arr = unserialize($input_array['value']);
      
      $data = '<select name="'.$input_array['name'].'[]" id="'.$input_array['name'].'" multiple="multiple"  class="multiselect pdg_mselect">';      
      foreach ($res as $row)
      {
        $selected = '';
        
		if (is_array($selected_arr))
		foreach ($selected_arr as $value) {if ($value == $row[$input_array['rel_key']]) $selected = " SELECTED";}
        
		$name2 = "";
		
		if (isset($input_array['rel_name2'])) $name2 .= " [".$row[$input_array['rel_name2']]."]";
		if (isset($input_array['rel_name3'])) $name2 .= " [".$row[$input_array['rel_name3']]."]";
		if (isset($input_array['rel_third_table_name'])) $name2 .= " [".$row[$input_array['rel_third_table_name']]."]";


        $data .= '<option value="'.$row[$input_array['rel_key']].'"'.$selected.'>'.$row[$input_array['rel_name']].$name2.'</option>';
      }
    
	  $data .= '</select>';
      return $data;	
	}
	public function db_save($input_array)
	{
		print_r ($input_array['value']);
		return serialize($input_array['value']);
	}


}

?>
	