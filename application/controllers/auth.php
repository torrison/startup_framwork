<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

	// Inside System Controller (Idea from Power Data Grid 2.0.)
	
class Auth extends Controller_Base {
	
	public $__load_default = true;

	public function login() {

		$this->data['page_center'] = 'login';

		$this->data['seo_title'] = 'Вход/Регистрация на сайте';
		$this->data['seo_description'] = 'Регистрируйтесь на сайте!';
		$this->data['seo_keywords'] = 'Вход, Регистрация, сайт';

		$this->__render();
	}

	public function logout() {
		if (!$this->data['user']) redirect($this->data['lang_link_prefix'].'');
		$this->ion_auth->logout();
		redirect('/');
	}
	
	public function profile() {
		if ( ! $this->data['user']) redirect('/');
		$this->data['page_center'] = 'auth_profile';
		
		$this->data['seo_title'] = 'Profile Page';
		$this->data['seo_description'] = 'Profile Page';
		$this->data['seo_keywords'] = 'Profile Page';
		
		$this->__render();
	}

	public function reset_password($code) {
		
		$this->load->helper('language');
		$reset = $this->ion_auth->forgotten_password_complete($code);

			if ($reset) {  //if the reset worked then send them to the login page
				$this->data['message'] = "New password has sent on your Email!";
			}
			else { //if the reset didnt work then send them back to the forgot password page
				$this->data['message'] = "Error Code for Password Recovery! Plz, try again.";
			}
		
		$this->data['page_center'] = 'auth_pass_reset';		
		$this->data['seo_title'] = 'Reset password!';
		$this->data['seo_description'] = 'Reset password!';
		$this->data['seo_keywords'] = 'Reset password!';	
		
		$this->data['page_center'] = "auth_pass_reset";
		
		$this->__render();
	}
	

}
