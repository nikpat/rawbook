<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require("/assets/recaptchalib.php");
class Entry extends CI_Controller {


	public function index()
	{
		$this->load->view('entry');
	}

	public function login(){

	}

	public function signup(){

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */