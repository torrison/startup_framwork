<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

	// Inside System Controller (Idea from Power Data Grid 2.0.)
	
class Inside extends CI_Controller {

	public function index() {
		redirect('/inside/custom/main_page/');
	}
	
	public function login() {
		redirect('/inside_auth/login/');
	}
	
	public function custom($interface_name) {
		if ($this->inside_access->check_access('inside_custom'))
		{				
			
			// User Info Array (Empty Hash is not bad, its session style)
			$user_info_arr = $this->inside_lib->get_user_info($this->session->userdata('user_id'));
			
			// Add Top Inside Menu			
			$this->load->model('inside/menu/inside_menu');	
			$top_menu_arr['menu_arr'] = $this->inside_menu->get_top_menu_arr();
			$input_view_data['top_menu'] = $this->load->view('inside/wear/top_menu/gray_simple', $top_menu_arr, TRUE);
			$input_view_data['head_scripts'] = $this->load->view('inside/wear/top_menu/gray_simple_head', '', TRUE);
			
			// Check and filter interface_name
			$interface_name = $this->inside_lib->defend_filter(4, $interface_name);					
			$custom_arr['interface_name'] = $interface_name;	
			
			// SEO data
			$input_view_data['inside_title'] = "Inside Page: Custom edit interface - ".$interface_name;	

			// Check if Interface View Folder Exists
			if (file_exists('application/views/inside/custom_interfaces/'.$interface_name.'/'))
			{
			// Head Scripts
			if (file_exists('application/views/inside/custom_interfaces/'.$interface_name.'/head_code.php'))
			$input_view_data['head_scripts'] .= $this->load->view('inside/custom_interfaces/'.$interface_name.'/head_code', $custom_arr, TRUE);
			
			// Control Form
			if (file_exists('application/views/inside/custom_interfaces/'.$interface_name.'/control_form.php'))
			$input_view_data['control_form'] = $this->load->view('inside/custom_interfaces/'.$interface_name.'/control_form', $custom_arr, TRUE);
			else $input_view_data['control_form'] = '';
			
			// Terminal Message
			if (file_exists('application/views/inside/custom_interfaces/'.$interface_name.'/terminal.php'))
			$input_view_data['terminal'] = $this->load->view('inside/custom_interfaces/'.$interface_name.'/terminal', $custom_arr, TRUE);
			else $input_view_data['terminal'] = '';
			}
			else
			{
				// Head Scripts
				$input_view_data['control_form'] = '';
				$input_view_data['terminal'] = 'Sorry, this interface does not exists';

			}
			// Load View
			$this->load->view('inside/main_template/simple_one', $input_view_data);

			// ------------------------------------------------------------------------------------------------------
		}
		else $this->load->view('inside/lib/message_redirect.php', Array('location' => '/inside/login/', 'message' => 'ACCESS DENIED!'));	
	}
		
	public function custom_model($interface_name, $model = 'main_model', $method = "index") {
			if ($this->inside_access->check_access('inside_load_model'))
			{
				 // Check and filter data
				 $interface_name = $this->inside_lib->defend_filter(4, $interface_name);	
				 $model = $this->inside_lib->defend_filter(4, $model);
				 $method = $this->inside_lib->defend_filter(4, $method);
				 
				 $this->load->model('inside/custom_interfaces/'.$interface_name.'/'.$model, 'load_model');
				 $output = $this->load_model->$method();
				 echo $output;
			}
			else $this->load->view('inside/lib/message_redirect.php', Array('location' => '/inside/login/', 'message' => 'ACCESS DENIED!'));	
	}

	// Table PDG CRUD
	public function table($table_name = 'inside_top_menu') {
		if ($this->inside_access->check_access('inside_table'))
		{

			if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('content')) {
				session_start();
				$_SESSION['kcf'] = 'aHfg_inside1';
			}

			// User Info Array
			$user_info_arr = $this->inside_lib->get_user_info($this->session->userdata('user_id'));
			
			// Add Top Inside Menu			
			$this->load->model('inside/menu/inside_menu');	
			$top_menu_arr['menu_arr'] = $this->inside_menu->get_top_menu_arr();
			$input_view_data['top_menu'] = $this->load->view('inside/wear/top_menu/gray_simple', $top_menu_arr, TRUE);
			$input_view_data['head_scripts'] = $this->load->view('inside/wear/top_menu/gray_simple_head', '', TRUE);
						
			// Check and filter table_name
			if ($table_name == "")$table_name = "default_form"; 
			$table_name = $this->inside_lib->defend_filter(4, $table_name);	
			$input_view_data['table_name'] = $table_name;	
			
			// SEO data
			$input_view_data['inside_title'] = "Inside Page: Edit table - ".$table_name;	
			
			$this->load->model('inside_model');
			
			// Isset Config File
			if (file_exists('application/config/pdg_tables/'.$table_name.'.php'))	
			{
				
				$filters = $this->inside_model->generate_top_filters($table_name);

				// Head Scripts
				$input_view_data['head_scripts'] .= $this->load->view('inside/table/pdg_scripts', '', TRUE);
							
				// Control Form
				$input_view_data['control_form'] = $this->load->view('inside/table/pdg_table_form', array('table_name' => $table_name, 'filters' => $filters, 'user_info_arr' => $user_info_arr), TRUE);
				
				// Terminal Message
				$input_view_data['terminal'] = 'AJAX loading...';
			}
			else
			{
				// Head Scripts
				$input_view_data['control_form'] = '';
				$input_view_data['terminal'] = 'Sorry, this table does not exists';

			}
			// Load View
			$this->load->view('inside/main_template/simple_one', $input_view_data);

			// ------------------------------------------------------------------------------------------------------
		}
		else $this->load->view('inside/lib/message_redirect.php', Array('location' => '/inside/login/', 'message' => 'ACCESS DENIED!'));	
	}
	
	
	
	// Table PDG CRUD !!! NEED REFACTORING, MB Make Left Tree Filter Column
	public function table_tree($table_name = 'inside_top_menu', $start_pid = "0") {
		if ($this->inside_access->check_access('inside_table'))
		{				
			// User Info Array
			$user_info_arr = $this->inside_lib->get_user_info($this->session->userdata('user_id'));
			
			// Add Top Inside Menu			
			$this->load->model('inside/menu/inside_menu');	
			$top_menu_arr['menu_arr'] = $this->inside_menu->get_top_menu_arr();
			$input_view_data['top_menu'] = $this->load->view('inside/wear/top_menu/gray_simple', $top_menu_arr, TRUE);
			$input_view_data['head_scripts'] = $this->load->view('inside/wear/top_menu/gray_simple_head', '', TRUE);
			
			// Check and filter table_name
			if ($table_name == "")$table_name = "default_form"; 
			$table_name = $this->inside_lib->defend_filter(4, $table_name);	
			$input_view_data['table_name'] = $table_name;
			// SEO data
			$input_view_data['inside_title'] = "Inside Page: Edit TREE table - ".$table_name;
			
			$this->load->model('inside_model');
			
			// Isset Config File
			if (file_exists('application/config/pdg_tables/'.$table_name.'.php'))	
			{
				
				$filters = $this->inside_model->generate_top_filters($table_name);

				// Head Scripts
				$input_view_data['head_scripts'] .= $this->load->view('inside/table/pdg_scripts_tree', '', TRUE);
							
				// Control Form
				$input_view_data['control_form'] = $this->load->view('inside/table/pdg_tree_form', array('pid' => $start_pid, 'table_name' => $table_name, 'filters' => $filters, 'user_info_arr' => $user_info_arr), TRUE);
				
				// Terminal Message
				$input_view_data['terminal'] = 'AJAX loading...';
			}
			else
			{
				// Head Scripts
				$input_view_data['control_form'] = '';
				$input_view_data['terminal'] = 'Sorry, this table does not exists';

			}
			// Load View
			$this->load->view('inside/main_template/simple_one', $input_view_data);

			// ------------------------------------------------------------------------------------------------------
		}
		else $this->load->view('inside/lib/message_redirect.php', Array('location' => '/inside/login/', 'message' => 'ACCESS DENIED!'));	
	}

	
	
	
	// ----------------------------------  PDG Edit, Add, Copy in new _Blank Pages ! ---------------------------
	public function pdg_edit($table_name, $id) {
		$this->load->library('inside_access');
		if ($this->inside_access->check_access('pdg_edit'))
		{
		// ------------------------------------------------------ Edit Page in New _Blank ------------------------------
		$this->load->library('inside_lib');
		$this->load->model('inside_model');
		// Head Scripts
		$input_view_data['head_scripts'] = $this->load->view('inside/head_scripts/pdg_edit_page', Array('table' => $table_name, 'id' => $id), TRUE);
		// Filter Data
		$table_name = $this->inside_lib->defend_filter(4, $table_name);	
		// Add Top Inside Menu
		$top_menu_arr['menu_arr'] = $this->inside_model->get_top_menu_arr();
		$input_view_data['top_menu'] = $this->load->view('inside/top_menu', $top_menu_arr, TRUE);
		// SEO data
		$input_view_data['inside_title'] = "Edit Cell in table: ".$table_name;
		// No Terminal
		$input_view_data['terminal'] = 'Edit cell in table: <b>'.$table_name.'</b> ID = '.$id;
		// Control Form
		$input_view_data['control_form'] = '';
		// Load View
		$this->load->view('inside/inside_main_template', $input_view_data);
		// ------------------------------------------------------------------------------------------------------
		}
		else $this->load->view('inside/access_denied');			
	}
	
	public function pdg_add($table_name) {
		$this->load->library('inside_access');
		if ($this->inside_access->check_access('pdg_add'))
		{
		// ------------------------------------------------------ Add Page in New _Blank ------------------------------	
		$this->load->library('inside_lib');
		$this->load->model('inside_model');
		// Head Scripts
		$input_view_data['head_scripts'] = '';
		// Filter Data
		$table_name = $this->inside_lib->defend_filter(4, $table_name);	
		// Add Top Inside Menu
		$top_menu_arr['menu_arr'] = $this->inside_model->get_top_menu_arr();
		$input_view_data['top_menu'] = $this->load->view('inside/top_menu', $top_menu_arr, TRUE);
		// SEO data
		$input_view_data['inside_title'] = "Add Cell in table: ".$table_name;
		// No Terminal
		$input_view_data['terminal'] = 'Add cell in table: <b>'.$table_name.'</b>';
		// Control Form
		$input_view_data['control_form'] = '';
		// Load View
		$this->load->view('inside/inside_main_template', $input_view_data);
		// ------------------------------------------------------------------------------------------------------
		}
		else $this->load->view('inside/access_denied');	
	}
	
}

?>