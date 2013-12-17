<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require("/assets/recaptchalib.php");
class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('account_model','account');
	}

	public function index()
	{

		$data['main_pg'] = "home";
		if($this->session->userdata('isLogged') == 1){
			$data['users'] = json_encode($this->account->get_users());
			$this->load->view('header',$data);
			$this->load->view('home');
			$this->load->view('footer');
		}
		else{
			$this->load->model('core_model','core');
			$data['categories'] = $this->core->get_categories();
			$this->load->view('login',$data);	
		}
	}

	public function login(){

		$this->load->model('core_model','core');
		
		$config = array(
               array(
                     'field'   => 'usernameEmail', 
                     'label'   => 'UsernameEmail', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'password', 
                     'label'   => 'Password', 
                     'rules'   => 'required'
                  ),  
            );

		$this->form_validation->set_rules($config);


		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('login');
		}
		else
		{
			$data = $this->core->login($_POST);
			if($data){
				$this->session->set_userdata('isLogged',1);
				$this->session->set_userdata('userId',$data['id']);	
			}
			else{
				$this->session->set_flashdata('error','Invalid Credentials');	
			}
			redirect('home');
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('home');
	}

	public function signup(){

		$this->load->model('core_model','core');

		$config = array(
               array(
                     'field'   => 'username', 
                     'label'   => 'Username', 
                     'rules'   => 'required|min_length[5]|max_length[12]|is_unique[user.username]'
                  ),
               array(
                     'field'   => 'password', 
                     'label'   => 'Password', 
                     'rules'   => 'required'
                  ),  
               array(
                     'field'   => 'email', 
                     'label'   => 'Email', 
                     'rules'   => 'trim|required|valid_email|is_unique[user.email]'
                  ),
               array(
                     'field'   => 'firstname', 
                     'label'   => 'First name', 
                     'rules'   => 'trim|required'
                  ),
               array(
                     'field'   => 'lastname', 
                     'label'   => 'Last name', 
                     'rules'   => 'trim|required'
                  )
            );

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('login');
		}
		else
		{
			$userid = $data = $this->core->registerUser($_POST);
			$this->session->set_userdata('isLogged',1);
			$this->session->set_userdata('userId',$userid);	
			redirect('home');
			//$this->load->view('home',$data);	
		}
	}

	

}