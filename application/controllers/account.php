<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

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

	public function settings($id)
	{
		$this->load->model('core_model','core');
		$data['main_pg'] = "account";
		$user_id =  $this->session->userdata('userId');

		if($this->session->userdata('isLogged') == 1){
			if($_POST){
				$config = array(
				               array(
				                     'field'   => 'firstname', 
				                     'label'   => 'First name', 
				                     'rules'   => 'required'
				                  ),
				               array(
				                     'field'   => 'lastname', 
				                     'label'   => 'Last name', 
				                     'rules'   => 'required'
				                  ),
				                array(
				                     'field'   => 'email', 
				                     'label'   => 'Email', 
				                     'rules'   => 'required'
				                  ),
				                array(
				                     'field'   => 'country', 
				                     'label'   => 'Country', 
				                     'rules'   => 'required'
				                  ),
				               	array(
				                     'field'   => 'city', 
				                     'label'   => 'City', 
				                     'rules'   => 'required'
				                  ),

				            );

				$this->form_validation->set_rules($config);


				if ($this->form_validation->run() != FALSE)
				{
					$this->account->edit_profile($user_id,$_POST,$_FILES);
				}
				
			}

			
			$data['countries'] = $this->core->get_countries();
			$data['user_info'] = $this->account->get_user($id); 
			$this->load->view('header',$data);
			$this->load->view('account/settings');
			$this->load->view('footer');
		}
		else{
			redirect('home');	
		}
	}

	public function password_change($id){
		$data['main_pg'] = "account";
		$this->load->model('core_model','core');
		$user_id =  $this->session->userdata('userId');
		
		$config = array(
		               array(
		                     'field'   => 'old_pass', 
		                     'label'   => 'Old Password', 
		                     'rules'   => 'required'
		                  ),
		               array(
		                     'field'   => 'new_pass', 
		                     'label'   => 'New Password', 
		                     'rules'   => 'required'
		                  ),
		                array(
		                     'field'   => 'confirm_pass', 
		                     'label'   => 'Confirm Password', 
		                     'rules'   => 'required|matches[new_pass]'
		                  ),
		            );

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() != FALSE)
		{
			if($this->account->change_password($user_id,$_POST)){
				$this->session->set_flashdata('success','Password Changed');
				redirect('/account/settings/'.$user_id);
			}
			else{
				$this->session->set_flashdata('error','Password is not changed please try again');
				redirect('/account/settings/'.$user_id);
			};
		}
		else{
			$data['countries'] = $this->core->get_countries();
			$data['user_info'] = $this->account->get_user($id); 
			$this->load->view('header',$data);
			$this->load->view('account/settings');
			$this->load->view('footer');
		}
		
	}


	public function follow($id)
	{
		$current_user = $this->session->userdata('userId');
		echo $this->account->follow($current_user,$id);
	}

	public function unfollow($id)
	{
		$current_user = $this->session->userdata('userId');
		echo $this->account->unfollow($current_user,$id);
	}

	public function follow_category($cat_id)
	{
		$current_user = $this->session->userdata('userId');
		echo $this->account->follow_category($current_user,$cat_id);
	}

	public function unfollow_category($cat_id)
	{
		$current_user = $this->session->userdata('userId');
		echo $this->account->unfollow_category($current_user,$cat_id);
	}

	public function get_cities($country_code){
		$this->load->model('core_model','core');
		echo  json_encode( $this->core->get_cities($country_code) );
	}

}