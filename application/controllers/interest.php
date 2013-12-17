<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require("/assets/recaptchalib.php");
class interest extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('account_model','account');
	}

	public function index()
	{
		$data['main_pg'] = "home";
		if($this->session->userdata('isLogged') == 1){
			$data['users'] = json_encode($this->account->get_interest_users());
			$this->load->view('header',$data);
			$this->load->view('interest');
			$this->load->view('footer');
		}
		else{
			$this->load->view('login');	
		}
	}
}