<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('account_model','account');
	}

	public function index()
	{
		$data['main_pg'] = "account";
		$current_user = $this->session->userdata('userId');

		if(isset($_GET['id'])){
			$user_id = $_GET['id'];
			$data['isFollowing'] = $this->account->is_following($current_user,$_GET['id']);
		}
		else{
			$user_id = $this->session->userdata('userId');
		}

		$data["user"] = $this->account->get_user($user_id);
		$data["user_follower"] = $this->account->user_follower($user_id);
		$data["user_following"] = $this->account->user_following($user_id);
		$data["follower_ids"] = $this->account->follower_ids($user_id);
		$data["following_ids"] = $this->account->following_ids($user_id);
		$data["user_cats"] = $this->account->user_categories($user_id);
		$data["cats"] = $this->account->categories($user_id);

		if($this->session->userdata('isLogged') == 1){
			$this->load->view('header',$data);
			$this->load->view('account/home');
			//$this->load->view('footer');
		}
		else{
			redirect('home');	
		}
	}




}