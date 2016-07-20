<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Parent_Select_Custom {


	public function input_form($input_array)
	{
        $CI =& get_instance();
		$query = $CI->db->query("SELECT ".$input_array['select_index']." AS id, ".$input_array['select_field'].", ".$input_array['select_pid_index']." AS parent_id FROM ".$input_array['select_table']." ".$input_array['select_field']." ".$input_array['rules'] );
  		$menu_res = $query->result_array();
        return "
		<script>
  		$(function() {
		$( '.".$input_array['name']."' ).combobox();
		});
		</script>".$this->c7_input_get_tree_from_res_select ($menu_res, $input_array['name'], $input_array['value'], $input_array['select_field']);	}

	// Parent Select Generator
	function c7_input_get_tree_from_res_select ($res, $select_name, $select_id, $field)
	{
		$data = '';
		$data .= '<select id="'.$select_name.'" class="'.$select_name.'" name="'.$select_name.'" style="width: 350px;">';
		$data .= "<option value=\"0\">Главная</option>";
		$tree_i=0;    #MySQL array counter
		foreach ($res as $row)
		{
			$catalog_tree[$tree_i]['id'] = $row['id'];
			$catalog_tree[$tree_i]['parent_id'] = $row['parent_id'];
			$catalog_tree[$tree_i][$field] = $row[$field];
			$catalog_tree[$tree_i]['url'] = @$row['url'];
			$tree_i++;
			#Add All MySQL Data to Array
		}

		$i=0;                      // Reset $i
		#$limit = 0;			   // Defend counter for Debuging
		$parent_step = 0;          // Start in parent_id = 0
		$parent[$parent_step] = 0; // Parent to Child Step Array
		$now_output = array();     // Array for ouput printing data
		$data_prefix = '';
		while ($i <= $tree_i)
		{
		   #$data .= "{".$catalog_tree[$i]['parent_id']."<< = >>".$parent[$parent_step]."}"; #Debuging echo
		   $now_output_signal = false; #reset now output signal       	  
		   
		   if (@$catalog_tree[$i]['parent_id'] == @$parent[$parent_step]) #if id has parent_id in current parent level (start in 0)
		   {
			 for ($j=0;$j<count($now_output);$j++)
			 {
			   if (@$catalog_tree[$i]['id'] == @$now_output[$j]) {$now_output_signal = true; break;} #Check for ouput printing data
			 }
			 if ((@$now_output_signal == false)&&(@$catalog_tree[$i]['id'] > 0)) #if id has not printed
				{
				$parent_step++;
				$parent[$parent_step] = $catalog_tree[$i]['id'];
				//$parent_name = $catalog_tree[$i][$field];
				if ($catalog_tree[$i]['id'] != "")
				if ($catalog_tree[$i]['id'] == $select_id) $select=" SELECTED";
				else $select="";				
				$data .= "<option value=\"".$catalog_tree[$i]['id']."\"".$select.">".$data_prefix.$catalog_tree[$i][$field]."</option>";
				$select="";
				$data_prefix .= "->";
				array_push($now_output, $catalog_tree[$i]['id']);
				$i=0; #parent step+1, new parent has added, if not empty, data printed, prefix+1 "->" , array push printed id!. Start again.
				}
		   }
		   if ($i == $tree_i) { #step left in prefix way in the end of data
		   $i=0;
		   $parent_step--; 
		   //$data_prefix = str_replace($parent_name, "", $data_prefix);
		   $data_prefix = substr($data_prefix, 0,strlen($data_prefix)-2);
		   } 
		   $i++;
		   #$limit++; if ($limit == 260) $i = $tree_i+5; # Defend system for ulimited while
		   if (!isset($parent[$parent_step])) $i = $tree_i+5; #The End Of While, Bacause Step = -1
		}
		$data .= "</select>";
		return $data;
  }  
}

?>
	