<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('user_model');
		
	}

	public function index(){
		//load session library
		
		//restrict users to go back to login if session has been set
		if($this->session->userdata('user')){
			redirect('user/home');
		}
		else{
			$this->load->view('welcome_page');
		}
	}

	public function act_login(){
		//load session library
		
		$output = array('error' => false);

		$username = $_POST['username'];
		$password = $_POST['password'];

		$data = $this->user_model->cek_user($username, $password);

		if($data){
			$this->session->set_userdata('user', $data);
			$output['message'] = 'Logging in. Please wait...';
		}
		else{
			$output['error'] = true;
			$output['message'] = 'Login Invalid. User not found';
		}

		echo json_encode($output); 
	}

	public function home(){
		//load session library
		
		//restrict users to go to home if not logged in
		if($this->session->userdata('user')){
			$this->load->view('admin/home');
		}
		else{
			redirect('/');
		}
		
	}

	public function logout(){
		//load session library
	
		$this->session->unset_userdata('user');
		redirect('/');
	}

	public function change()
	{
		
        if(!$this->session->userdata('user')){
            redirect('/');
        }

		$this->form_validation->set_rules('new_password','New Password','required|min_length[6]');
		$this->form_validation->set_rules('confirm_password','Confirm Password','required|matches[new_password]');
		
		if($this->form_validation->run()==FALSE)
		{
			$this->load->view('admin/change');
		}
		else{
			$current = $this->input->post('current_password');
			
			$query = $this->user_model->getuser(array('password'=>md5($current)));
			if($query == false)
			{
				$this->session->set_flashdata('error','Current Password not Match');
				$this->load->view('admin/change');
			}
			else{

				$new = $this->input->post('new_password');
				$cpass = $this->input->post('confirm_password');
				$id = $this->session->userdata('id');
				$this->user_model->edit($new);
				$this->session->set_flashdata('error','Password Success to change, Please Relogin');
				$this->session->unset_userdata('user');
				redirect('/');
			}
		}
	}

}
