<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Links_Categories_Model extends CI_Model
{
	public function get_all_categories_arr($only_top = true, $pid = false)
	{
		if ($only_top) $only_top_filter = ' AND links_categories_pid = 0';
		else {
			if ($pid) $only_top_filter = ' AND links_categories_pid = '.intval($pid);
			else $only_top_filter = '';
		}
		

		$query = $this->db->query("SELECT * 
									FROM it_links_categories 
									WHERE links_categories_invisible != 1 {$only_top_filter}
									ORDER BY links_categories_priority ASC, links_categories_id DESC
									");

		return $query->result_array();
		
	}
	
	public function get_tree_categories_arr()
	{
		return $this->get_all_categories_arr(false);
	}
	

	public function get_categories_row($alias)
	{

		$query = $this->db->query("SELECT * 
									FROM it_links_categories 
									WHERE links_categories_alias = '".mysql_real_escape_string($alias)."'
									LIMIT 1
									");

		$res = $query->result_array();
		if (isset($res[0]))
		return $res[0];
		else 
		return false;
			
	}
	
}