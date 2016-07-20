<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Search extends Controller_Base 
	{
		
		public $__load_default = true;
	
		public function index() {
				
			$this->data['text'] = $this->input->get('text', TRUE);
			
			$this->data['content_arr'] = $this->db->query("SELECT it_content.*
																FROM it_content 
																WHERE it_content.content_name LIKE '%".mysql_real_escape_string($this->data['text'])."%'
																ORDER BY content_id DESC
																")->result_array();
			
			$this->data['page_center'] = 'search';
			$this->data['seo_title'] = 'Сайт визитка. Поиск: '.$this->data['text'];
			$this->data['seo_description'] = 'Сайт визитка. Поиск: '.$this->data['text'];
			$this->data['seo_keywords'] = 'Сайт визитка. Поиск, '.$this->data['text'];
			$this->__render();
		
		}
	}