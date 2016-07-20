<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of inside_model
 *
 * @author Alex Torrison
 */
class Main_Model extends CI_Model
{

	public function index()
	{
		
		
		ob_start();
?>

				<form method="post" id="reg-form" action="/inside/custom_model/users_adv/main_model/add_user">
				<div id="register-h1">Register</div>
				<input type="text" id="reg-email" name="reg-email" placeholder="E-mail" style="border: 1px solid #777; padding:3px;">
				<input type="text" id="reg-pass" name="reg-pass" placeholder="Password" style="border: 1px solid #777; padding:3px;">				
				<a id="reg-ok" class="btn" style="margin-bottom: 10px;">Add</a>
				<span id="reg-mess" style="display: inline-block;"></span>
				</form>
				
				<form method="post" id="pass-form" action="/inside/custom_model/users_adv/main_model/change_pass">
				<div id="register-h1">Password change</div>
				<input type="text" id="reg-id" name="ch-id" placeholder="ID" style="border: 1px solid #777; padding:3px;">
				<input type="text" id="reg-pass" name="ch-pass" placeholder="Password" style="border: 1px solid #777; padding:3px;">								
				<a id="pass-ok" class="btn" style="margin-bottom: 10px;">Change</a>				
				<span id="pass-mess" style="display: inline-block;"></span>
				</form>

<?php
		$date = ob_get_clean();

		return $date;
		
	}
	
	
	public function add_user()
	{	
		$this->load->library('inside_access');		
		if ($this->inside_access->check_access('root_system_zone'))
		{		
			$this->load->library('inside_lib');
			$username = '';
			$email = $this->inside_lib->defend_filter(1, $_POST['reg-email']);
			$password = $this->inside_lib->defend_filter(1, $_POST['reg-pass']);
			$additional_data = array(
									'first_name' => '',
									'last_name' => '',
									);								
			$group = array('2'); // Sets user to admin. No need for array('1', '2') as user is always set to member by default
			
			if ( (strlen($email) > 2) && (strlen($password) > 2) )
			{
				// $id = $this->ion_auth->register($username, $password, $email, $additional_data, $group);
				// Old Version of Ion Auth
				$this->ion_auth->register($username, $password, $email, $additional_data, false, 'kiev', false);
				$id = true;
			}
			else $id = false;			
			
			if (@$id)
			{
				$date = '<div style="padding: 4px; color: darkgreen; display: inline-block;">Data Saved!</div>';
			}
			else $date = '<div style="padding: 4px; color: darkred; display: inline-block;">Not Saved, Data is wrong!</div>';
			return $date;
		}
		else $this->load->view('inside/access_denied');
	}
	
	
	
	public function change_pass()
	{
		$this->load->library('inside_access');
		if ($this->inside_access->check_access('root_system_zone'))
		{	
		$this->load->library('inside_lib');
			
			$id = intval($_POST['ch-id']);
			$password = $this->inside_lib->defend_filter(1, $_POST['ch-pass']);
			$data = array(
									'password' => $password
									);											
			if ( ($id > 0) && (strlen($password) > 2) )
			{
				$res = $this->ion_auth->update($id, $data);
			}
			else $res = false;
			
			if (@$res)
			{
				$date = '<div style="padding: 4px; color: darkgreen; display: inline-block;">Data Saved! (for '.$id.')</div>';
			}
			else $date = '<div style="padding: 4px; color: darkred; display: inline-block;">Not Saved, Data is wrong!</div>';
			return $date;		
		}
		else $this->load->view('inside/access_denied');
	}

	
// End Class
}
