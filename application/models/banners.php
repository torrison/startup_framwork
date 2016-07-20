<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Banners extends CI_Model
{
	public function get_top_banners_arr()
	{
			$query = $this->db->query("SELECT * 
										FROM it_banners
										WHERE banners_invisible != 1 AND banners_type = 1
										ORDER BY banners_priority ASC, banners_id DESC
										");

			return $query->result_array();
		
	}


}