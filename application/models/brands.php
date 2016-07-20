<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Brands extends CI_Model
{
	public function get_brands_arr()
	{
			$query = $this->db->query("SELECT * 
										FROM it_brands
										WHERE brands_invisible != 1
										ORDER BY brands_priority ASC, brands_id DESC
										");

			return $query->result_array();
		
	}


}