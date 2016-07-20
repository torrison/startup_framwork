<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

}

class Controller_Base extends CI_Controller {

	public $__load_default = false;

	public $data = array();
	public $options = array();
	
	public function __construct() {
		
		parent::__construct();
		
		if($this->__load_default){
			$this->__load_default();

		}

	}
	
	public function __load_default() {
		
		/*
		// ---------------   Languages   ------------------------
		$this->load->model('lang_model');
		
		// Get Lang from URL
		$this->data['all_lang_arr'] = $this->lang_model->get_all_lang_arr();
		foreach ($this->data['all_lang_arr'] as $lang_row) 
		{
			if ($lang_row['lang_alias'] == $this->uri->segment(1)) $this->options['lang'] = $lang_row['lang_alias'];
		}
		
		if (!isset($this->options['lang'])) $this->options['lang'] = "en";				
		
		$this->data['global_lang_alias'] = $this->options['lang'];
		
		//Save Language in Session	
		$this->session->set_userdata(Array('lang' => $this->options['lang']));

		
		if ($this->options['lang'] == "en") $this->data['lang_link_prefix'] = "";
		else $this->data['lang_link_prefix'] = "/".$this->options['lang'];	
		
		// Vocabulary
		$this->load->model('text');
		$this->text->init($this->options['lang']);		
		*/
		
		// --------------------- Catalog ------------------
		
		/*
		// Default Data for every __load_default = true Controlle
		$this->load->model('categories');		
		
		$this->data['categories_arr'] = $this->categories->get_all_categories_arr();
		

		
		// --------------------- Web-Site Auth ------------------
		
		$this->load->model('menu');
		$menu_arr = $this->menu->get_menu_arr();
		$columns['id_column'] = 'menu_id';
		$columns['pid_column'] = 'menu_pid';
		$columns['name_column'] = 'menu_name';
		$columns['haschild_column'] = 'menu_haschild';
		$columns['invisible_column'] = 'menu_invisible';
		$columns['url_column'] = 'menu_url';
		$columns['url_prefix'] = '';
		$columns['data_prefix'] = '';
		
		$this->data['menu_tree'] = $this->inside_lib->make_tree_view($menu_arr, $columns, '', ' id="nav" class="dropdown dropdown-horizontal img_shadow"');		
	*/
		$this->load->library('ion_auth');
		
		if ($this->ion_auth->logged_in())
		{
			$this->data['user'] = $this->ion_auth->user()->row();
		}
		else $this->data['user'] = false;
	
		
		// ------------------- Cart -----------------------------
		
		
		/*
		$this->load->library('cart');
		$this->data['cart_arr'] = $this->cart->contents();
		
		if ($this->data['cart_arr'])
		{
			$this->data['cart_total'] = $this->cart->total();
			$this->data['cart_total_items'] = $this->cart->total_items();
		}
		else
		{
			$this->data['cart_total'] = 0;
			$this->data['cart_total_items'] = 0;
		}
		
		*/

		// PROFILER
		if ($this->ion_auth->is_admin() && isset($_GET['ci_profiler'])) {
			$this->output->enable_profiler(TRUE);
		}

		$this->data['page_center'] = 'index';
		
		
		
	}


	public function __render($layout = 'outside/main_template') {

		// Default in every Page, where use RENDER not AJAX	
		
		$this->load->view($layout, $this->data);
		
	}
	

}
