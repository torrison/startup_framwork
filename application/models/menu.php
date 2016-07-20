<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menu extends CI_Model
{
	public function get_menu_arr()
	{
			$query = $this->db->query("SELECT * 
										FROM it_menu
										WHERE menu_invisible != 1
										ORDER BY menu_pid ASC, menu_priority ASC, menu_id DESC
										");

			return $query->result_array();
		
	}


}