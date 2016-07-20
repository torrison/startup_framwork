<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main_Page extends Controller_Base {
	
	public $__load_default = true;
	
	public function index() {
		
		$this->data['seo_title'] = 'Создание сайта для стартапа и интернет-маркетинг для бизнеса';
		$this->data['seo_description'] = '';
		$this->data['seo_keywords'] = '';

		$this->__render();
	}

}