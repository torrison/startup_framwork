<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
class Auth_api extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->library('ion_auth');

	}
	
	public function check_login() {
		
		if (( $this->input->post('email', true) == "") AND ( $this->input->post('password', true) == ""))
			echo '{"status":"err", "message": "Email, Пароль не может быть пустым!"}';
		elseif ($this->input->post('email', true) == "") {
			echo '{"status":"err", "message": "Email не может быть пустым!"}';
		}
		elseif ($this->input->post('password', true) == "") {
			echo '{"status":"err", "message": "Пароль не может быть пустым!"}';
		}
		else {
			$id = $this->ion_auth->login($this->input->post('email'), $this->input->post('password'));
			
			if ($id) {
				echo '{"status":"success", "redirect":"/auth/profile"}';
			}
			else {
				echo '{"status":"err", "message": "Неверный E-mail или Пароль!"}';
			}
		}
		
	}

	public function fb_oauth_link() {
		$this->load->library('facebook/facebook');
		echo $this->facebook->login_url();
	}
	
	public function check_social_login($social_network) {

		if ($social_network == 'facebook') {
			$this->load->library('facebook');
			$userInfo = $this->facebook->get_user();

			if (isset($userInfo['email'])) {
				if ($this->ion_auth->email_check($userInfo['email'])) {
					// echo $userInfo["email"];
					$this->ion_auth->login_no_pass($userInfo["email"]);
					redirect ('/auth/profile');
				}
				else {
					$pass = $this->inside_lib->random_password();
					$this->ion_auth->register('', $pass, $userInfo["email"], array(), array('2'));
					$this->ion_auth->login($userInfo["email"], $pass);
					redirect ('/auth/profile');
				}
			}
			else echo "FaceBook Connect Error, plz try again later.";
		}
		elseif ($social_network == 'google') {

            $params = array(
                'client_id' => 'XXXXXXXX.apps.googleusercontent.com',
                'client_secret' => 'XXXXXXXX',
                'redirect_uri' => 'http://startup.ikiev.biz/auth_api/check_social_login/google/',
                'grant_type' => 'authorization_code',
                'code' => $_GET['code']
            );

            $url = 'https://accounts.google.com/o/oauth2/token';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($curl);
            curl_close($curl);
            $tokenInfo = json_decode($result, true);
			
			if (isset($tokenInfo['access_token'])) {
                $params['access_token'] = $tokenInfo['access_token'];

                $userInfo = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo' . '?' . urldecode(http_build_query($params))), true);
                if (isset($userInfo['email'])) {
					if ($this->ion_auth->email_check($userInfo['email']))
					{
						$this->ion_auth->login_no_pass($userInfo["email"]);
						redirect ('/auth/profile');
					}
					else
					{
						$pass = $this->inside_lib->random_password();
						$this->ion_auth->register('', $pass, $userInfo["email"], array(), array('2'));
						$this->ion_auth->login($userInfo["email"], $pass);
						redirect ('/auth/profile');
					}
				}
			}
			
		}
		else { echo "Why are you Here?"; redirect ('/');}
	}

	public function check_reg() {
		
		$email = $this->input->post('r_email',true);
		$pass = $this->input->post('r_password',true);
		
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$/';
		
		if (($email  == "") AND ($pass  == "" ))
			echo '{"status":"err", "message": "Email, Пароль не может быть пустым!"}';
		elseif ( ($email == "") OR ( ! preg_match($regex, $email))) {
			echo '{"status":"err", "message": "Email неверный!"}';
		}
		elseif ( $pass == "" ) {
			echo '{"status":"err", "message": "Пароль не может быть пустым!"}';
		}
		else {
			if ($this->ion_auth->email_check($email))
				echo '{"status":"err", "message": "Этот Email уже зарегистрирован, попробуйте другой!"}';
			else {
				$this->ion_auth->register('', $pass, $email, array(), array('2'));
				$this->ion_auth->login($email, $pass);
				echo '{"status":"success", "redirect":"/auth/profile"}';
			}
		}
	}
	
	public function check_recovery() {
		
		$email = $this->input->post('recovery_email',true);
		if ($email  == "" )
			echo '{"status":"err", "message": "Email не может быть пустым!"}';
	    else {
			if ( ! $this->ion_auth->email_check($email))
				echo '{"status":"err", "message": "Данный e-mail не найден!"}';
			else {
				if ($this->ion_auth->forgotten_password($email))
					echo '{"status":"success", "message": "<span style=\"color:green;\">Информация отправлена на вашу почту.</span>"}';
				else
					echo '{"status":"err", "message": "Восстановление пароля по E-mail заблокировано."}';
			}
	    }
	}
	
	public function update_user_data() {
		$update_arr['username'] = $this->input->post('username', true);
		$update_arr['company'] = $this->input->post('company', true);
		$update_arr['phone'] = $this->input->post('phone', true);
		$update_arr['adv_info'] = $this->input->post('adv_info', true);
		
		if (isset($_FILES['image']['name']))
		{
			$update_arr['img'] = $this->inside_lib->C7_fs_file_upload ($_FILES['image']['tmp_name'], $_FILES['image']['name'], "/files/uploads/users_img/");
		}
		elseif ($this->input->post('del_image', true)) { $update_arr['img'] = ''; $this->inside_lib->c7_delete_image($this->input->post('del_image', true), "users_img/");}

		$user = $this->ion_auth->user()->row();
		$this->ion_auth->update($user->id, $update_arr);
		echo '{"status":"success", "message": "<strong>Данные сохранены!</strong>"}';
	}
	
	public function change_password() {
		
		$old_password = $this->input->post('old_password', TRUE);
		$new_password = $this->input->post('new_password', TRUE);
		$confirm_password = $this->input->post('confirm_password', TRUE);
		$email = $this->input->post('email', TRUE);

		
		if ($old_password == '')
			echo '{"status":"err", "message": "<strong>Старый пароль</strong> не может быть пустым!"}';
		elseif ( ($new_password != $confirm_password) || ($new_password == '') || (strlen($new_password) < 5))
				echo '{"status":"err", "message": "<strong>Новый пароль и подтверждение</strong> не совпадают или пустые или короткие (менее 5 символов)!"}';
		elseif ( ! preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$/', $email))
			echo '{"status":"err", "message": "<strong>Email</strong> не верный!"}';
		else {
			$user = $this->ion_auth->user()->row();
			$password = $this->ion_auth->hash_password_db($user->id, $old_password);
			if ($password != $user->password)
				echo '{"status":"err", "message": "<strong>Старый пароль</strong> не верный!"}';
			else {
				if ( ($email == $user->email) OR ( ! $this->ion_auth->email_check($email)) )
					{
						$this->ion_auth->update($user->id, array('password' => $new_password, 'email' => $email));
						echo '{"status":"success", "message": "<strong>Пароль и/или Email изменен!</strong>"}';
					}
				else echo '{"status":"err", "message": "Данный <strong>Email</strong> уже используется!"}';
			}
		}
	}



}