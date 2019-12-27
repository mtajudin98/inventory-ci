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

}
