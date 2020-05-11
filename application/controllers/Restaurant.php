<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurant extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(	is_null(get_cookie('Login')) && preg_match('/(login|register)/isU',$_SERVER['REQUEST_URI']) === 0 ) {
			delete_cookie('Login');
			header('Location: ' . base_url() . 'login');
			exit();
		}else{
			$this->LAYOUT = Array(
				'MEMBER'     => json_decode(base64_decode(get_cookie('Login')),TRUE)
			);
			$this->load->model('Restaurant_model');
		}
	}

	public function event()
	{
		$data = $this->input->post();
		$data['start_time'] = time();
		$data['end_time'] = strtotime($data['end_time']);
		$data['account_id'] = $this->LAYOUT['MEMBER']['id'];
		if( $this->Restaurant_model->RestaurantEventCheck($data) ){
			$this->Restaurant_model->RestaurantEvent($data);
			echo 'ok';
		} else echo '已經有個相同的非常召集還尚未結束喔！';
	}

	public function GetEventRestaurantId($EventId)
	{
		
	}
}