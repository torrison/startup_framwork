<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pages extends CI_Model
{


    public function similar_pages_list($page_id)
    {


        if (!$this->session->userdata('lang') || ($this->session->userdata('lang') == 'en'))
        {
            $query = $this->db->query("SELECT *
										FROM it_content
										LEFT JOIN it_rel_content_similar ON it_rel_content_similar.content_similar_id = it_content.content_id
										WHERE content_invisible != 1 AND it_rel_content_similar.content_id = ".intval($page_id)."
										ORDER BY it_content.content_priority ASC, it_content.content_id DESC
										");

            return $query->result_array();
        }
        else
        {
            $query = $this->db->query("SELECT

										it_content_translate.content_name as content_name_translate,
										it_content_translate.content_desc as content_desc_translate,

										it_content.*

										FROM it_content

										LEFT JOIN it_content_translate ON it_content.content_id = it_content_translate.content_id

										AND it_content_translate.content_lang_alias = '".mysql_real_escape_string($this->session->userdata('lang'))."'

										LEFT JOIN it_rel_content_similar ON it_rel_content_similar.content_similar_id = it_content.content_id
										WHERE content_invisible != 1 AND it_rel_content_similar.content_id = ".intval($page_id)."

										ORDER BY it_content.content_priority ASC, it_content.content_id DESC

										");
            // $this->output->enable_profiler(TRUE);
            $res = $query->result_array();
            $res_new = Array();



            foreach ($res as $row)
            {
                if ($row['content_name_translate'] != '') $row['content_name'] = $row['content_name_translate'];
                if ($row['content_desc_translate'] != '') $row['content_desc'] = $row['content_desc_translate'];

                // if ($row['categories_invisible_translate'] != '1')
                $res_new[] = $row;
            }
            return $res_new;
        }
    }

    public function pages_list($page = '1', $user_owner_id = false)
	{
		
		if ($page == 'all') $limit = "LIMIT 999";
		else $limit = "LIMIT ".( (intval($page) - 1)*3).",3";
		
		if ($user_owner_id)
			$user_owner_filter_where = "AND content_user_id = ".intval($user_owner_id);
		else $user_owner_filter_where = "";
		
		if (!$this->session->userdata('lang') || ($this->session->userdata('lang') == 'en'))
		{
			$query = $this->db->query("SELECT * 
										FROM it_content 
										WHERE content_invisible != 1 AND content_type = 1 {$user_owner_filter_where}
										ORDER BY content_priority ASC, content_id DESC
										{$limit}
										");

			return $query->result_array();
		}
		else
		{
			$query = $this->db->query("SELECT 
										
										it_content_translate.content_name as content_name_translate,
										it_content_translate.content_desc as content_desc_translate,
										
										it_content.* 
										
										FROM it_content
										
										LEFT JOIN it_content_translate ON it_content.content_id = it_content_translate.content_id 
										
										AND it_content_translate.content_lang_alias = '".mysql_real_escape_string($this->session->userdata('lang'))."'
										
										WHERE
										it_content.content_invisible != 1 AND content_type = 1 {$user_owner_filter_where}

										ORDER BY it_content.content_priority ASC, it_content.content_id DESC
										{$limit}
										");
			// $this->output->enable_profiler(TRUE);
			$res = $query->result_array();
			$res_new = Array();
			
			
			
			foreach ($res as $row)
			{			
				if ($row['content_name_translate'] != '') $row['content_name'] = $row['content_name_translate'];
				if ($row['content_desc_translate'] != '') $row['content_desc'] = $row['content_desc_translate'];
				
				// if ($row['categories_invisible_translate'] != '1') 
				$res_new[] = $row;
			}
			return $res_new;		
		}
	}
	
	public function pages_count()
	{
		$query = $this->db->query("SELECT count(*) as pages_count
									FROM it_content 
									WHERE content_invisible != 1  AND content_type = 1
									");

		$res = $query->result_array();
		return $res[0]['pages_count'];
	}	
	
	public function get_page_row($id)
	{
		if (!$this->session->userdata('lang') || ($this->session->userdata('lang') == 'en'))
		{
		$query = $this->db->query("SELECT * 
							FROM it_content 
							WHERE content_id = ".intval($id)." 
							LIMIT 1");

		$res = $query->result_array();
		if (isset($res[0])) return $res[0];
		else return false;
		}
		else
		{	
			$query = $this->db->query("SELECT 
										
										it_content_translate.content_name as content_name_translate,
										it_content_translate.content_desc as content_desc_translate,
										
										it_content.* 
										
										FROM it_content
										
										LEFT JOIN it_content_translate ON it_content.content_id = it_content_translate.content_id 
										
										AND it_content_translate.content_lang_alias = '".mysql_real_escape_string($this->session->userdata('lang'))."'
										
										WHERE
										it_content.content_id = ".intval($id)." 

										LIMIT 1
										");
			// $this->output->enable_profiler(TRUE);
			$res = $query->result_array();
			if (isset($res[0]))
			{
			$row = $res[0];		
				if ($row['content_name_translate'] != '') $row['content_name'] = $row['content_name_translate'];
				if ($row['content_desc_translate'] != '') $row['content_desc'] = $row['content_desc_translate'];

			return $row;
			}			
			else return false;
			
					
		}		
	}

	public function get_page_row_by_alias($alias)
	{		
		
		if (!$this->session->userdata('lang') || ($this->session->userdata('lang') == 'en'))
		{
		$query = $this->db->query("SELECT * 
							FROM it_content 
							LEFT JOIN users ON it_content.content_user_id = users.id
							WHERE it_content.content_alias = '".mysql_real_escape_string($alias)."' 
							LIMIT 1");

		$res = $query->result_array();
		if (isset($res[0])) return $res[0];
		else return false;
		}
		else
		{	
			$query = $this->db->query("SELECT 
										
										it_content_translate.content_name as content_name_translate,
										it_content_translate.content_html as content_html_translate,
										
										it_content.*, users.*
										
										FROM it_content
										LEFT JOIN users ON it_content.content_user_id = users.id
										LEFT JOIN it_content_translate ON it_content.content_id = it_content_translate.content_id 
										
										AND it_content_translate.content_lang_alias = '".mysql_real_escape_string($this->session->userdata('lang'))."'
										
										
										WHERE it_content.content_alias = '".mysql_real_escape_string($alias)."' 

										LIMIT 1
										");
			// $this->output->enable_profiler(TRUE);
			$res = $query->result_array();
			if (isset($res[0]))
			{
			$row = $res[0];		
				if ($row['content_name_translate'] != '') $row['content_name'] = $row['content_name_translate'];
				if ($row['content_html_translate'] != '') $row['content_html'] = $row['content_html_translate'];

			return $row;
			}			
			else return false;
			
					
		}	
		
	}
	
	public function get_tags_list()
	{
		$query = $this->db->query("SELECT * 
									FROM it_tags 									
									ORDER BY tags_name ASC
									LIMIT 100
									");

		return $query->result_array();
	}
	
	public function get_content_tags_arr()
	{
		$query = $this->db->query("SELECT  it_rel_content_tags.*, it_tags.tags_name as name
									FROM it_rel_content_tags 	
									LEFT JOIN it_tags ON it_tags.tags_id = it_rel_content_tags.tags_id									
									");

		return $query->result_array();
	}
	
	// -------------------------- Filters
	
	public function pages_list_category_filter($alias, $page = '1')
	{
		$query = $this->db->query("SELECT it_content.*, it_rel_content_categories.category_id as category_id, it_categories.categories_alias as alias
									FROM it_content 
									LEFT JOIN it_rel_content_categories ON it_rel_content_categories.content_id = it_content.content_id
									LEFT JOIN it_categories ON it_categories.categories_id = it_rel_content_categories.category_id
									WHERE content_invisible != 1 AND content_type = 1 AND it_categories.categories_alias = '".mysql_real_escape_string($alias)."'
									ORDER BY content_priority ASC, content_id DESC
									LIMIT ".( (intval($page) - 1)*3).",3
									");

		return $query->result_array();
	}
	
	public function pages_count_category_filter($alias)
	{
		$query = $this->db->query("SELECT count(*) as pages_count
									FROM it_content 
									LEFT JOIN it_rel_content_categories ON it_rel_content_categories.content_id = it_content.content_id
									LEFT JOIN it_categories ON it_categories.categories_id = it_rel_content_categories.category_id
									WHERE content_invisible != 1 AND content_type = 1 AND it_categories.categories_alias = '".mysql_real_escape_string($alias)."'
									");

		$res = $query->result_array();
		return $res[0]['pages_count'];
	}
	
	public function pages_list_tags_filter($tag, $page = '1')
	{
		$query = $this->db->query("SELECT it_content.*, it_rel_content_tags.tags_id as tags_id, it_tags.tags_name as tag
									FROM it_content 
									LEFT JOIN it_rel_content_tags ON it_rel_content_tags.content_id = it_content.content_id
									LEFT JOIN it_tags ON it_tags.tags_id = it_rel_content_tags.tags_id
									WHERE content_invisible != 1 AND content_type = 1 AND it_tags.tags_name = '".mysql_real_escape_string($tag)."'
									ORDER BY content_priority ASC, content_id DESC
									LIMIT ".( (intval($page) - 1)*3).",3
									");

		return $query->result_array();
	}
	
	public function pages_count_tags_filter($tag)
	{
		$query = $this->db->query("SELECT count(*) as pages_count
									FROM it_content 
									LEFT JOIN it_rel_content_tags ON it_rel_content_tags.content_id = it_content.content_id
									LEFT JOIN it_tags ON it_tags.tags_id = it_rel_content_tags.tags_id
									WHERE content_invisible != 1 AND content_type = 1 AND it_tags.tags_name = '".mysql_real_escape_string($tag)."'
									");

		$res = $query->result_array();
		return $res[0]['pages_count'];
	}	
	
	public function get_tree_tags_arr()
	{
		$query = $this->db->query("SELECT * 
									FROM it_tags
									ORDER BY tags_name ASC
									");

		return $query->result_array();
	}
	
	public function get_content_info_blocks($content_id) {
	
		$res = $this->db->query("SELECT it_info_block.* FROM 
							it_info_block
							LEFT JOIN it_rel_info_block_content ON it_rel_info_block_content.info_block_id = it_info_block.info_block_id															
							WHERE it_rel_info_block_content.content_id = ".intval($content_id)."
							ORDER BY it_info_block.info_block_priority ASC
							")->result_array();
		return $res;
					
	}
	
	public function get_content_buy_blocks($content_id) {
	
		$res = $this->db->query("SELECT it_buy_block.* FROM 
							it_buy_block
							LEFT JOIN it_rel_buy_block_content ON it_rel_buy_block_content.buy_block_id = it_buy_block.buy_block_id															
							WHERE it_rel_buy_block_content.content_id = ".intval($content_id)."
							ORDER BY it_buy_block.buy_block_priority ASC
							")->result_array();
		return $res;
					
	}
	
	public function get_content_options($content_id) {
	
		$res = $this->db->query("SELECT it_content_options.*, it_rel_content_options_ext.*
							FROM it_content_options
							LEFT JOIN it_rel_content_options_ext ON it_rel_content_options_ext.options_id = it_content_options.options_id															
							WHERE it_rel_content_options_ext.content_id = ".intval($content_id)."
							ORDER BY it_rel_content_options_ext.content_options_priority ASC
							")->result_array();
		return $res;
	}
	
	public function get_content_seo_block() {
	
		$res = $this->db->query("SELECT *
							FROM it_seo_blocks								
							WHERE it_seo_blocks.seo_blocks_url = '".$_SERVER['REQUEST_URI']."'
							")->result_array();
		
		if (isset($res[0])) return $res[0];
		else return false;
		
	}
	
	public function get_content_images($content_id) {
	
		$res = $this->db->query("SELECT it_images.*
							FROM it_images		
							LEFT JOIN it_rel_images_content ON it_rel_images_content.images_id = it_images.images_id															
							WHERE it_rel_images_content.content_id = ".intval($content_id)."
							ORDER BY it_images.images_priority ASC
							")->result_array();
		
		return $res;
		
	}
	
	public function get_content_links($content_id) {
	
		$res = $this->db->query("SELECT it_links.*
							FROM it_links		
							LEFT JOIN it_rel_links_content ON it_rel_links_content.links_id = it_links.links_id															
							WHERE it_rel_links_content.content_id = ".intval($content_id)."
							ORDER BY it_links.links_priority ASC
							")->result_array();
		return $res;

	}


}