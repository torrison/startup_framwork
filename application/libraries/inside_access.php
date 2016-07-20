<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Inside library
 *  
 * @author Alex Torrison
 */
class Inside_Access {

    /**
     * Constructor
     */
    public function __construct($config = array()) {
        log_message('debug', "Inside_Access Class Initialized");
    }

	// ------------------------------------------------------------------------------ Check Access in Points -------------	
	public function check_access ($point_name, $table = '', $cell_id = 0)
	{
		$CI =& get_instance();
		$CI->load->library('ion_auth');

		$CI->load->library('session');
		$user_id = intval($CI->session->userdata('user_id'));
		
		$query = $CI->db->query("SELECT * FROM inside_system_zones 
		LEFT JOIN inside_access_system_zones ON system_zones_id=access_system_zones_zone_id
		LEFT JOIN users_groups ON group_id = access_system_zones_group_id
		WHERE system_zones_name = '".$point_name."' AND user_id = ".$user_id."");
		
		$access_result_arr = $query->result_array();
		
		if (isset($access_result_arr[0]))
		{
			$access_result = $access_result_arr[0];
			return true;
		}
		else return false;

	}

}
