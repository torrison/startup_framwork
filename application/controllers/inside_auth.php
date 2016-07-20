<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

	// Authentification
	
class Inside_Auth extends CI_Controller {

	// AJAX Login Check Page
	public function ajax_login_check() {
		
		$this->load->library('ion_auth');

		$identity = $this->input->post('login');
		$password = $this->input->post('password');

		if ($this->ion_auth->login($identity, $password, true)) {
			$message = 'Ok!';
			$this->load->view('inside/lib/message_redirect.php', Array('color' => '#555', 'message' => $message, 'location' => '/inside/'));
		}
		else {
			$message = "Wrond Login or Password!";
			$this->load->view('inside/lib/message.php', Array('color' => '#555', 'message' => $message));
		}
	}

	public function logout() {
		
		$this->load->library('ion_auth');
		$this->ion_auth->logout();
		// Load View
		$this->load->view('inside/lib/message_redirect.php', Array('color' => 'darkgreen', 'location' => '/', 'message' => 'You have logout! Waiting for redirect...'));	
	}
	
	// Login Page ----------------------------------------------------  LOGIN ----------------------------
	public function login() {
		// Head Scripts
		$input_view_data['head_scripts'] = $this->load->view('inside/login/head_code', '', true);
		// No Top-Menu
		$input_view_data['top_menu'] = '';
		// SEO data
		$input_view_data['inside_title'] = "Inside Login Page";
		// No Terminal
		$input_view_data['terminal'] = '';
		// Control Form
		$input_view_data['control_form'] = $this->load->view('inside/login/login_form', '', true);
		// Load View
		$this->load->view('inside/main_template/simple_one', $input_view_data);
	}
	
	// AJAX message
	public function ajax_message($target, $message='') {
	
		if ($target == "login_info") $message = "Please input your login and password!";
		else $message = '';
		$this->load->view('inside/lib/message.php', Array('color' => '#555', 'message' => $message));	
	}
	
}