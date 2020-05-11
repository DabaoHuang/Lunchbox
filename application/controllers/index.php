<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	var $LAYOUT;

	public function __construct()
	{
		parent::__construct();
		if(	is_null(get_cookie('Login')) && preg_match('/(login|register)/isU',$_SERVER['REQUEST_URI']) === 0 ) {
			delete_cookie('Login');
			header('Location: ' . base_url() . 'login');
			exit();
		} else {
			$this->LAYOUT = Array(
				'MEMBER'     => json_decode(base64_decode(get_cookie('Login')),TRUE),
				'COPYRIGHTS' => $this->load->view('copyrights','' , TRUE),
				'WRONG'      => (get_cookie('Wrong') !== NULL) ? TRUE : FALSE 
			);
			$this->load->model('Member_model');
			$this->load->model('Restaurant_model');
			$this->load->model('Order_model');
		}
	}

	public function index()
	{
		$this->LAYOUT['events']	= $this->Restaurant_model->GetEvent();
		if( $this->LAYOUT['events'] ) {
			foreach($this->LAYOUT['events'] as $row)
			$EventId[] = $row['id'];
			$this->LAYOUT['GetOrderCount'] = $this->Order_model->GetOrderCount($EventId);
		}
		$vars = array(
			'HEADER' => $this->load->view('header' ,$this->LAYOUT, TRUE),
			'BODY'   => $this->load->view('index',$this->LAYOUT , TRUE),
			'FOOTER' => $this->load->view('footer',$this->LAYOUT , TRUE)
		);
		$this->load->view('template',$vars);
	}

	public function Login()
    {
		if( get_cookie('Login') )
			delete_cookie('Login');

		$ACCOUNT = get_cookie('ACCOUNT');

		$vars = array(
			'ACCOUNT'    => ( $ACCOUNT ) ? $ACCOUNT : '' ,
			'HEADER'     => '',
			'BODY'       => $this->load->view('login',$this->LAYOUT , TRUE),
			'FOOTER'     => $this->load->view('footer',$this->LAYOUT , TRUE)
		);
		$this->load->view('template',$vars);
	}
	
	public function Logout()
	{
		delete_cookie('Login');
		header('Location: ' . base_url() . 'login');
		exit();
	}

	public function Register()
	{
		$vars = array(
			'HEADER'     => '',
			'BODY'       => $this->load->view('register',$this->LAYOUT , TRUE),
			'FOOTER'     => $this->load->view('footer', $this->LAYOUT , TRUE)
		);

		$this->load->view('template',$vars);
	}

	public function List()
	{
		$this->LAYOUT['EventItem'] = $this->Order_model->GetEventOrder($this->LAYOUT['MEMBER']['id']);
		$this->LAYOUT['OrderCount'] = $this->Order_model->GetOrderCount($this->LAYOUT['EventItem']['event']);
		$this->LAYOUT['UserInfo'] = json_decode($this->Member_model->GetAccountData($this->LAYOUT['EventItem']['account'],'id'), TRUE);
		$this->LAYOUT['RestInfo'] = $this->Restaurant_model->GetRestaurant($this->LAYOUT['EventItem']['restaurant']);
		$vars = array(
			'HEADER'     => $this->load->view('header' , $this->LAYOUT , TRUE),
			'BODY'       => $this->load->view('list',$this->LAYOUT , TRUE),
			'FOOTER'     => $this->load->view('footer', $this->LAYOUT , TRUE)
		);
		$this->load->view('template',$vars);
	}

	public function Order($EventId)
	{
		// 若超過時間，立即退出
		$EventInfo = $this->Restaurant_model->GetEvent($EventId);
		if($EventInfo === FALSE) {
			header('Location: ' . base_url());
			exit();
		}

		/* 送出訂單 */
		if($this->input->post()) {
			$this->load->model('Order_model');

			// 訂單資料
			$data = Array(
				'event_id'    => $EventId,
				'timestamp'   => time(),
				'account_id'  => $this->LAYOUT['MEMBER']['id'],
				'avali'       => 1,
				'description' => $this->input->post('description')
			);
			$OrderId = $this->Order_model->InsertOrder($data);

			// 訂單商品資料
			foreach($this->input->post('number') as $InputId => $number) {
				if($number > 0 ) {
					$item_id = $this->input->post('item_id');
					$data2[] = Array(
						'order_id' => $OrderId,
						'item_id'  => $item_id[$InputId],
						'number'   => $number
					);
				} // end if
			} // end foreach

			$res = $this->Order_model->InsertOrderItem($data2);
			header('Location: ' . base_url() . 'list');
			exit();
		}

		/* 訂單頁面 */
		$RestInfo = $this->Restaurant_model->GetRestaurant($EventInfo[0]['restaurant_id']);
		$this->LAYOUT['EventInfo'] = $EventInfo[0];
		$this->LAYOUT['RestInfo'] = $RestInfo[$EventInfo[0]['restaurant_id']];
		$this->LAYOUT['RestMenu'] = $this->Restaurant_model->GetRestaurantMenuList($EventInfo[0]['restaurant_id']);
		$vars = array(
			'HEADER'     => $this->load->view('header' , $this->LAYOUT , TRUE),
			'BODY'       => $this->load->view('order',$this->LAYOUT , TRUE),
			'FOOTER'     => $this->load->view('footer', $this->LAYOUT , TRUE)
		);
		$this->load->view('template',$vars);
	}

	public function Restaraunt()
	{
		$vars = array(
			'HEADER'     => $this->load->view('header' , $this->LAYOUT , TRUE),
			'BODY'       => $this->load->view('restaraunt',$this->LAYOUT , TRUE),
			'FOOTER'     => $this->load->view('footer', $this->LAYOUT , TRUE)
		);

		$this->load->view('template',$vars);
	}

	public function Release()
	{
		if( $this->input->post('id') && $this->input->post('time') ) {
			$result = $this->Restaurant_model->ReleaseRestaurant(
				$this->input->post('id') ,
				( $this->input->post('time') ) ? strtotime( $this->input->post('time') ) : strtotime( date('Y-m-d H:i:s') )
			);
			echo $result;
			return;
		}
		$this->LAYOUT['RestList'] = $this->Restaurant_model->GetRestaurant();
		$this->LAYOUT['RestMenuList'] = $this->Restaurant_model->GetRestaurantMenuList();
		$vars = array(
			'HEADER'     => $this->load->view('header' , $this->LAYOUT , TRUE),
			'BODY'       => $this->load->view('release',$this->LAYOUT , TRUE),
			'FOOTER'     => $this->load->view('footer', $this->LAYOUT , TRUE)
		);
		$this->load->view('template',$vars);
	}

	public function error404()
	{
		echo "ERRO!@#$!%@$1%$*&4%#E$#8888!@7R";
	}

}
