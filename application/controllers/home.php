<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require("/assets/recaptchalib.php");
class Home extends CI_Controller {


	public function index()
	{
		$this->load->view('entry');
	}

	public function login(){

	}

	public function signup(){
		
	}
}