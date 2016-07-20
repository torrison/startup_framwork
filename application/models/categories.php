<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Categories extends CI_Model
{
	public function get_all_categories_arr($only_top = true, $pid = false)
	{
		if ($only_top) $only_top_filter = ' AND categories_pid = 0';
		else {
			if ($pid) $only_top_filter = ' AND categories_pid = '.intval($pid);
			else $only_top_filter = '';
		}
		
		if (!$this->session->userdata('lang') || ($this->session->userdata('lang') == 'en'))
		{
		$query = $this->db->query("SELECT * 
									FROM it_categories 
									WHERE categories_invisible != 1 {$only_top_filter}
									ORDER BY categories_priority ASC, categories_id DESC
									");

		return $query->result_array();
		}
		else
		{
			$query = $this->db->query("SELECT 
										
										it_categories_translate.categories_name as categories_name_translate,
										it_categories_translate.categories_img as categories_img_translate,
										it_categories_translate.categories_desc as categories_desc_translate,
										
										it_categories.* 
										
										FROM it_categories
										
										LEFT JOIN it_categories_translate ON it_categories.categories_id = it_categories_translate.categories_id 
										
										AND it_categories_translate.categories_lang_alias = '".mysql_real_escape_string($this->session->userdata('lang'))."'
										
										WHERE
										it_categories.categories_invisible != 1 {$only_top_filter}

										ORDER BY it_categories.categories_priority ASC, it_categories.categories_id DESC
										");
			// $this->output->enable_profiler(TRUE);
			$res = $query->result_array();
			$res_new = Array();
			
			
			
			foreach ($res as $row)
			{			
				if ($row['categories_name_translate'] != '') $row['categories_name'] = $row['categories_name_translate'];
				if ($row['categories_img_translate'] != '') $row['categories_img'] = $row['categories_img_translate'];
				if ($row['categories_desc_translate'] != '') $row['categories_desc'] = $row['categories_desc_translate'];
				
				// if ($row['categories_invisible_translate'] != '1') 
				$res_new[] = $row;
			}
			return $res_new;	
		}
	}
	
	public function get_tree_categories_arr()
	{
		return $this->get_all_categories_arr(false);
	}
	
	public function get_content_categories_arr()
	{
		$query = $this->db->query("SELECT  it_rel_content_categories.*, it_categories.categories_name as name, it_categories.categories_alias as alias
									FROM it_rel_content_categories 	
									LEFT JOIN it_categories ON it_categories.categories_id = it_rel_content_categories.category_id									
									");

		return $query->result_array();
	}

	
	public function get_categories_row($alias)
	{
		if (!$this->session->userdata('lang') || ($this->session->userdata('lang') == 'en'))
		{
		$query = $this->db->query("SELECT * 
									FROM it_categories 
									WHERE categories_alias = '".mysql_real_escape_string($alias)."'
									LIMIT 1
									");

		$res = $query->result_array();
		if (isset($res[0]))
		return $res[0];
		else 
		return false;
		}
		else
		{
			$query = $this->db->query("SELECT 
										
										it_categories_translate.categories_name as categories_name_translate,
										it_categories_translate.categories_img as categories_img_translate,
										it_categories_translate.categories_desc as categories_desc_translate,
										
										it_categories.* 
										
										FROM it_categories
										
										LEFT JOIN it_categories_translate ON it_categories.categories_id = it_categories_translate.categories_id 
										
										AND it_categories_translate.categories_lang_alias = '".mysql_real_escape_string($this->session->userdata('lang'))."'
										
										WHERE
										it_categories.categories_alias = '".mysql_real_escape_string($alias)."'

										LIMIT 1
										");
			// $this->output->enable_profiler(TRUE);
			$res = $query->result_array();
			
			
			if (isset($res[0]))
			{
				$row = $res[0];	
					if ($row['categories_name_translate'] != '') $row['categories_name'] = $row['categories_name_translate'];
					if ($row['categories_img_translate'] != '') $row['categories_img'] = $row['categories_img_translate'];
					if ($row['categories_desc_translate'] != '') $row['categories_desc'] = $row['categories_desc_translate'];

				return $row;
			}
			else return false;
		}		
	}

}