<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

	// Inside System Controller (Idea from Power Data Grid 2.0.)
	
class Inside_PDG_Ajax extends CI_Controller {

    // Get Power Data Grid Table
	public function index() {   

		$this->load->model('inside_model');

		$table_name = $this->input->post('pdg_table', true);
		$table_name = $this->inside_lib->defend_filter(4, $table_name);

		$this->load->library('inside_access');
		if ($this->inside_access->check_access('pdg_ajax_crud', $table_name))
		{
		// Filtering POST data		
		$input_view_data['table_name'] = $table_name;	
		$filter['order'] = $this->input->post('pdg_order', true);
		$filter['asc'] = $this->input->post('pdg_asc', true);
		$filter['limit'] = $this->input->post('pdg_limit', true);
		$filter['page'] = $this->input->post('pdg_page', true);
		$filter['fsearch'] = $this->input->post('pdg_fsearch', true);
		$filter['fsearch'] = $this->inside_lib->defend_filter(1, $filter['fsearch']);
		$filter['fkey'] = intval($this->input->post('pdg_fkey', true));
		$filter['order'] = $this->inside_lib->defend_filter(1, $filter['order']);
		$filter['asc'] = $this->inside_lib->defend_filter(1, $filter['asc']);
		$filter['limit'] = intval($filter['limit']);
		$filter['page'] = intval($filter['page']);
		
		// Get Array
		$table_arr = $this->inside_model->get_table_arr($table_name, $filter);
		$input_view_data['table_arr'] = $table_arr['res'];
		$input_view_data['sql'] = $table_arr['sql'];
		$input_view_data['debug'] = $this->input->post('pdg_fsearch', true);
		// Wear PDG_view		
		$this->load->view('inside/table/pdg_crud', $input_view_data);

		// ------------------------------------------------------------------------------------------------------
		}
		else $this->load->view('inside/access_denied');			
	}
	
	// Main Inside Page
	public function tree() {  // Must be Refactored like Type of table() 

		$this->load->model('inside_model');

		$table_name = $this->input->post('pdg_table');
		$table_name = $this->inside_lib->defend_filter(4, $table_name);
		$pid = intval($this->input->post('pdg_pid'));

		$this->load->library('inside_access');
		if ($this->inside_access->check_access('pdg_ajax_crud', $table_name))
		{

		// Filtering POST data		
		$input_view_data['table_name'] = $table_name;	
		$filter['order'] = $this->input->post('pdg_order', true);
		$filter['asc'] = $this->input->post('pdg_asc', true);
		$filter['limit'] = $this->input->post('pdg_limit', true);
		$filter['page'] = $this->input->post('pdg_page', true);
		$filter['fsearch'] = $this->input->post('pdg_fsearch', true);
		$filter['fsearch'] = $this->inside_lib->defend_filter(1, $filter['fsearch']);
		$filter['order'] = $this->inside_lib->defend_filter(1, $filter['order']);
		$filter['asc'] = $this->inside_lib->defend_filter(1, $filter['asc']);
		$filter['limit'] = intval($filter['limit']);
		$filter['page'] = intval($filter['page']);
		
		// Get Array
		$table_arr = $this->inside_model->get_tree_arr($table_name, $filter, $pid);
		$input_view_data['table_arr'] = $table_arr['res'];
		$input_view_data['sql'] = $table_arr['sql'];
		$input_view_data['debug'] = $this->input->post('pdg_fsearch', true);
		// Wear PDG_view
		$this->load->view('inside/table/pdg_crud_tree', $input_view_data);

		// ------------------------------------------------------------------------------------------------------
		}
		else $this->load->view('inside/access_denied');			
	}
	
	// -------------------------------  Add, Copy, View, Edit Forms ---------------------------------------
	
	public function add() {  
		
		$table_name = $this->input->post('pdg_table', true);
		$table_name = $this->inside_lib->defend_filter(4, $table_name);

		$this->load->library('inside_access');
		if ($this->inside_access->check_access('pdg_ajax_add', $table_name))
		{					
		// Load Table Config
		include ('application/config/pdg_tables/'.$table_name.'.php');
		
		// Wear table inputs
		foreach ($table_columns as $config_row) {
			$config_row['value'] = '';	
			
			$config_row['table'] = $table_name;
			$config_row['make_type'] = 'add';
			
			if (isset($config_row['input_type']))			
			$gen_inputs_arr[$config_row['name']] = $this->inside_lib->make_input("input_form", $config_row);
		}
		
		// Add Relationships to table
		if (isset($adv_rel_inputs))
		{
			foreach ($adv_rel_inputs as $rel_input_row) 
			{
				$rel_input_row['make_type'] = 'add';
				$gen_inputs_arr[$rel_input_row['name']] = $this->inside_lib->make_rel_input("input_form", $rel_input_row, '');		
			}
		}

		// Load View
		$input_view_data['gen_inputs_arr'] = $gen_inputs_arr;
		$input_view_data['table_name'] = $table_name;
		$input_view_data['dialog_id'] = intval($this->input->post('dialog_id'));
		$this->load->view('inside/table/pdg_dialog_add_form', $input_view_data);
		// ------------------------------------------------------------------------------------------------------
		}
		else $this->load->view('inside/access_denied');	
	}
	public function copy() {

		$this->load->library('inside_lib');
		$this->load->model('inside_model');
		$table_name = $this->input->post('pdg_table');
		$table_name = $this->inside_lib->defend_filter(4, $table_name);
		$cell_id = intval ($this->input->post('cell_id'));


		$this->load->library('inside_access');
		if ($this->inside_access->check_access('pdg_ajax_add', $table_name, $cell_id))
		{
		// ------------------------------------------------------ AJAX Edit Window ------------------------------			
		header('Content-Type: text/html; charset=utf-8');
		
		
		// Get table row
		$edit_cell_arr = $this->inside_model->get_table_cell_arr($table_name, $cell_id);
		// Load Table Config
		include ('application/config/pdg_tables/'.$table_name.'.php');
		// Wear table inputs
		foreach ($table_columns as $config_row) {
			$tmp_name = $config_row['name'];
			$config_row['value'] = $edit_cell_arr[$tmp_name];	
			
			$config_row['cell_id'] = $cell_id;
			$config_row['table'] = $table_name;
			$config_row['make_type'] = 'copy';
			
			if (isset($config_row['input_type']))
			$gen_inputs_arr[$tmp_name] = $this->inside_lib->make_input("input_form", $config_row);
		}
		// Add Relationships to table
		if (isset($adv_rel_inputs))
		{
			foreach ($adv_rel_inputs as $rel_input_row) 
			{
				$rel_input_row['make_type'] = 'copy';
				$gen_inputs_arr[$rel_input_row['name']] = $this->inside_lib->make_rel_input("input_form", $rel_input_row, $cell_id);
			}
		}


		// Load View
		$input_view_data['edit_cell_arr'] = $edit_cell_arr;
		$input_view_data['gen_inputs_arr'] = $gen_inputs_arr;
		$input_view_data['table_name'] = $table_name;
		$input_view_data['dialog_id'] = $this->input->post('dialog_id');
		$input_view_data['cell_id'] = $cell_id;	
		$this->load->view('inside/table/pdg_dialog_copy_form', $input_view_data);
		// ------------------------------------------------------------------------------------------------------
		}
		else $this->load->view('inside/access_denied');	

	}
	public function edit() { 

		$this->load->library('inside_lib');
		$this->load->model('inside_model');
		$table_name = $this->input->post('pdg_table');
		$table_name = $this->inside_lib->defend_filter(4, $table_name);
		$cell_id = intval ($this->input->post('cell_id'));


		$this->load->library('inside_access');
		if ($this->inside_access->check_access('pdg_ajax_edit', $table_name, $cell_id))
		{
		// ------------------------------------------------------ AJAX Edit Window ------------------------------			
		header('Content-Type: text/html; charset=utf-8');
		
		
		// Get table row
		$edit_cell_arr = $this->inside_model->get_table_cell_arr($table_name, $cell_id);
		// Load Table Config
		include ('application/config/pdg_tables/'.$table_name.'.php');
		// Wear table inputs
		foreach ($table_columns as $config_row) {
			$tmp_name = $config_row['name'];
			$config_row['value'] = $edit_cell_arr[$tmp_name];	
			
			$config_row['cell_id'] = $cell_id;
			$config_row['table'] = $table_name;
			$config_row['make_type'] = 'edit';
			$config_row['cell_row'] = $edit_cell_arr;
			
			if (isset($config_row['input_type']))
			$gen_inputs_arr[$tmp_name] =  $this->inside_lib->make_input("input_form", $config_row);
		}
		// Add Relationships to table
		if (isset($adv_rel_inputs))
		{
			foreach ($adv_rel_inputs as $rel_input_row) 
			{
				$rel_input_row['make_type'] = 'edit';
				$gen_inputs_arr[$rel_input_row['name']] = $this->inside_lib->make_rel_input("input_form", $rel_input_row, $cell_id);		
			}
		}
		
		// Add Chat Data
		$query = $this->db->query("SELECT * FROM inside_row_chat WHERE row_chat_invisible = 0 AND row_chat_row_id = ".$cell_id." AND row_chat_table = '".$table_name."' ORDER BY row_chat_datetime DESC");
		$input_view_data['chat_messages'] = $query->result_array();
		
		// Add All Groups Select
		$this->load->model('inside/custom_interfaces/inside_access/main_model', 'access_custom_model');
		$input_view_data['group_select'] = $this->access_custom_model->group_select_by_id_return();

		// Load View
		$input_view_data['edit_cell_arr'] = $edit_cell_arr;
		$input_view_data['gen_inputs_arr'] = $gen_inputs_arr;
		$input_view_data['table_name'] = $table_name;
		$input_view_data['dialog_id'] = $this->input->post('dialog_id');
		$input_view_data['cell_id'] = $cell_id;	
		$this->load->view('inside/table/pdg_dialog_edit_form', $input_view_data);
		// ------------------------------------------------------------------------------------------------------
		}
		else $this->load->view('inside/access_denied');				
	}
	
	// ------------------------------- INSERT, UPDATE, DELETE DB Requests ----------------------------------
	public function edit_request($table_name, $tab, $cell_id) {
		
		$this->output->enable_profiler(true);
		$this->load->library('inside_access');
		if ($this->inside_access->check_access('pdg_ajax_edit_request', $table_name, $cell_id))
		{
		// ------------------------------------------------------ AJAX Edit Window ------------------------------			
		$this->load->model('inside_model');
		$result = $this->inside_model->update_table_cell($table_name, $tab, $cell_id);
		$input_view_data['message'] = $result;
		$this->load->view('inside/lib/message', $input_view_data);	
		// ------------------------------------------------------------------------------------------------------
		}
		else $this->load->view('inside/access_denied');			
	}

	public function add_request($table_name) {
		
		$this->output->enable_profiler(true);
		$this->load->library('inside_access');
		if ($this->inside_access->check_access('pdg_ajax_add_request', $table_name))
		{
		// ------------------------------------------------------ AJAX Edit Window ------------------------------			
		$this->load->model('inside_model');
		$result = $this->inside_model->insert_table_cell($table_name);
		$input_view_data['message'] = $result;
		$this->load->view('inside/lib/message', $input_view_data);	
		// ------------------------------------------------------------------------------------------------------
		}
		else $this->load->view('inside/access_denied');			
	}

	public function del_request($table_name) {
		
		$this->output->enable_profiler(true);
		$this->load->library('inside_access');
		if ($this->inside_access->check_access('pdg_ajax_del_request', $table_name))
		{
		// ------------------------------------------------------ AJAX Edit Window ------------------------------			
		$this->load->model('inside_model');
		$result = $this->inside_model->del_table_cell($table_name);
		$input_view_data['message'] = $result;
		$this->load->view('inside/lib/message', $input_view_data);	
		// ------------------------------------------------------------------------------------------------------
		}
		else $this->load->view('inside/access_denied');			
	}
	
	// -------------------------------------------------------------------- AJAX Part of Chat System -------
	public function add_chat_comment($table, $item_id)
	{
    	$this->load->library('inside_access');
		if ($this->inside_access->check_access('pdg_ajax_edit_request'))
		{							
			// Load Libs and Models
			$this->load->library('inside_lib');
			$this->load->model('inside_model');

			// User Info Array (Empty Hash is not bad, its session style)
			$user_info_arr = $this->inside_lib->get_user_info($this->session->userdata('user_id'));
			
					
		$comment = $this->input->post('comment');
		$datetime = date("Y-m-d H:i:s");
		
		$comment = $this->inside_lib->defend_filter(1, $comment);
		
		$table = $this->inside_lib->defend_filter(4, $table);
		$item_id = intval($item_id);
		
		$what_replace   = array("\r\n", "\n", "\r");
		$replace = '<br />';
		$comment = str_replace($what_replace, $replace, $comment);
		
		$input['row_chat_table'] = $table;
		$input['row_chat_row_id'] = $item_id;
		$input['row_chat_user_name'] = $user_info_arr['users']['first_name']." ".$user_info_arr['users']['last_name'];
		$input['row_chat_user_id'] = intval ($user_info_arr['users']['id']);		
		$input['row_chat_content'] = $comment;
		$input['row_chat_datetime'] = $datetime;		
		
		$this->db->insert('inside_row_chat', $input);
		
		ob_start();
?>
<div style="padding: 10px; margin-top: 10px; border-top: 1px dotted #777;">
	<b><?php echo $user_info_arr['users']['first_name']." ".$user_info_arr['users']['last_name']; ?></b> <i class="gray">[<?php echo $datetime;?>]</i>: <?php echo $comment;?>
</div>
<?php  	
		echo ob_get_clean();
			// ------------------------------------------------------------------------------------------------------
		}
		else $this->load->view('inside/access_denied');
	}
}

?>