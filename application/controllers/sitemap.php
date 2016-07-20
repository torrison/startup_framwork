<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SiteMap extends Controller_Base {

	public $__load_default = true;
	
	public function index() {
		
		$this->data['content_arr'] = $this->db->query("SELECT it_content.*
															FROM it_content 
															ORDER BY content_id DESC
															")->result_array();
		
		$this->data['page_center'] = 'sitemap';
		
		$this->data['seo_title'] = 'Сайт визитка. Карта сайта';
		$this->data['seo_description'] = 'Сайт визитка. Карта сайта';
		$this->data['seo_keywords'] = 'Сайт визитка. Карта сайта';
		
		$this->__render();	
	}
	
	public function xml() {
		
		$this->data['content_arr'] = $this->db->query("SELECT it_content.*
															FROM it_content 
															ORDER BY content_id DESC
															")->result_array();
		$this->load->view('/outside/xml/sitemap.php', $this->data);	
	}


}
	