<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
		$this->load->model('Member_model');
		delete_cookie('Wrong');
		if( 
			// 沒有資料
			count($this->input->post()) === 0 
		// || get_cookie('Login') 
		// || ( $data = json_decode(get_cookie('Login'),TRUE) )
		// 	|| $this->Member_model->AccountCheck($data) === FALSE
		){
			delete_cookie('Login');
			header('Location: ' . base_url() . 'login');
		}
	}

	public function index()
	{
		header('Location: ' . base_url());
		exit;
	}

	public function Login()
	{
		if( get_cookie('Login') )
			delete_cookie('Login');
		
		if( $this->Member_model->AccountCheck($this->input->post()) === TRUE ) {
			set_cookie('Login',
				base64_encode(
					$this->Member_model->GetAccountData( $this->input->post('email'),'email' )
				), 86400
			);
			if ( $this->input->post('rememberme') === NULL )
				delete_cookie('rememberme');
			else
				set_cookie('rememberme',$this->input->post('email'),(86400*7));
		}
		else set_cookie('Wrong','wrong',86400);
		header('Location: ' . base_url());
		exit;
	}

	public function Register()
	{
		if( $_SERVER['HTTP_REFERER'] != base_url().'register' || $this->RegisterCheck() === FALSE )
			die('Not allow.');

		$MemberId = $this->Member_model->Register($this->input->post());
		set_cookie('Login',base64_encode( $this->Member_model->GetAccountData($MemberId,'id') ), 86400);
		set_cookie('rememberme',$this->input->post('email'),(86400*7));

		header("Location: " . base_url());
	}

	// 表單驗證
	public function RegisterCheck()
	{
		if( $this->Member_model->MailExists($this->input->post('email')) )
			$msg = 'Email already exists.';
		else if( $this->input->post('password') !== $this->input->post('PasswordConfirm') )
			$msg = 'Password NOT SAME!';
		else $msg = 'ok';

		echo $msg;

		return ($msg == 'ok') ? TRUE : FALSE ;
	}
}
