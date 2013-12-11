<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends CI_Controller {

	function __construct()
	{

		parent::__construct();
		$this->load->model('message_model','message');
	}

	public function index()
	{
		//echo "hereeeeeeeeeeer";exit;
		if($this->session->userdata('isLogged') == 1){
			$data['main_pg'] = "message";
			$data['selected'] = "inbox";
			$data['messages'] = $this->message->getInbox();

			$this->load->view('header',$data);
			$this->load->view('message/sidebar');
			$this->load->view('message/inbox');
			$this->load->view('footer');
		}
		else{
			$this->load->view('login');	
		}
	}

	public function inbox(){
		$data['main_pg'] = "message";
		$data['selected'] = "inbox";		

		if($this->session->userdata('isLogged') == 1){
			
			$data['messages'] = $this->message->getInbox();
			$this->load->view('header',$data);
			$this->load->view('message/sidebar');
			$this->load->view('message/inbox');
			$this->load->view('footer');
		}
		else{
			$this->load->view('login');	
		}
	
	}

	public function message(){
		
		$mid = $_GET['id'];
		echo json_encode($this->message->getMsg($mid));
	}

	public function compose(){
		$data['main_pg'] = "message";
		$data['selected'] = "compose";

		if($this->session->userdata('isLogged') == 1){

			$config = array(
	               array(
	                     'field'   => 'username', 
	                     'label'   => 'Username', 
	                     'rules'   => 'required|min_length[5]|max_length[12]'
	                  ),
	               array(
	                     'field'   => 'article', 
	                     'label'   => 'article', 
	                     'rules'   => 'required'
	                  ),  
	               array(
	                     'field'   => 'subject', 
	                     'label'   => 'Subject', 
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'message', 
	                     'label'   => 'Message', 
	                     'rules'   => 'trim|required'
	                  )
	            );

			$this->form_validation->set_rules($config);

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('header',$data);
				$this->load->view('message/sidebar');
				$this->load->view('message/compose');
				$this->load->view('footer');
			}
			else
			{
				$data = $this->message->sendMessage($_POST);
				$this->session->set_flashdata('msg_sent','Message sent');
				redirect('messages');
			}

		}
		else{
			$this->load->view('login');	
		}
	}


	public function ajax_compose(){
		$data['main_pg'] = "message";
		$data['selected'] = "compose";

		if($this->session->userdata('isLogged') == 1){

			$config = array(
	               array(
	                     'field'   => 'username', 
	                     'label'   => 'Username', 
	                     'rules'   => 'required|min_length[5]|max_length[12]'
	                  ),
	               array(
	                     'field'   => 'article', 
	                     'label'   => 'article', 
	                     'rules'   => 'required'
	                  ),  
	               array(
	                     'field'   => 'subject', 
	                     'label'   => 'Subject', 
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'message', 
	                     'label'   => 'Message', 
	                     'rules'   => 'trim|required'
	                  )
	            );

			$this->form_validation->set_rules($config);

			if ($this->form_validation->run() == FALSE)
			{
				echo validation_errors();;
			}
			else
			{
				$data = $this->message->sendMessage($_POST);
				echo $data;
			}

		}
		else{
			echo "error";	
		}
	}

	public function reply(){
		if($this->session->userdata('isLogged') == 1){	
				if($_POST){
					echo $this->message->sendMessage($_POST);
				}
				else{
					echo "require post";
				}
		}
		else{
			echo "error";
		}
	}

	// mid can be a single id or many ids seperated by commas 
	public function delete(){
		if(isset($_GET['mid'])){
			echo $this->message->deleteMessage($_GET['mid']);
			$this->session->set_flashdata("msg_log","Message Deleted");
		}
		else{
			echo "error";	
		}
	}

	public function sent(){
		$data['main_pg'] = "message";
		$data['selected'] = "sent";

		if($this->session->userdata('isLogged') == 1){
			$data['messages'] = $this->message->getSent();
			$this->load->view('header',$data);
			$this->load->view('message/sidebar');
			$this->load->view('message/sent');
			$this->load->view('footer');
		}
		else{
			$this->load->view('login');	
		}
	}

	public function thrash(){
		$data['main_pg'] = "message";
		$data['selected'] = "thrash";

		if($this->session->userdata('isLogged') == 1){
			$data['messages'] = $this->message->getThrash();
			$this->load->view('header',$data);
			$this->load->view('message/sidebar');
			$this->load->view('message/thrash');
			$this->load->view('footer');
		}
		else{
			$this->load->view('login');	
		}
	}

	public function spam(){
		$data['main_pg'] = "message";
		$data['selected'] = "spam";

		if($this->session->userdata('isLogged') == 1){
			$data['messages'] = $this->message->getSpam();
			$this->load->view('header',$data);
			$this->load->view('message/sidebar');
			$this->load->view('message/spam');
			$this->load->view('footer');
		}
		else{
			$this->load->view('login');	
		}
	}

	public function mark_spam(){
		if(isset($_GET['mid'])){
			echo $this->message->spamMessage($_GET['mid']);
			//$this->session->set_flashdata("msg_log","Message Deleted");
		}
		else{
			echo "error";	
		}
	}

	public function delete_forever(){
		if(isset($_GET['mid'])){
			echo $this->message->deleteMsgsForever($_GET['mid']);
			$this->session->set_flashdata("msg_log","Message restored");
		}
		else{
			echo "error";	
		}
	}

}