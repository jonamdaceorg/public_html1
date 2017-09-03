<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apps extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('users_model');
		$this->load->model('Backend_model');
	}

	public function getLoginFromApps()
	{
		$username = $this->input->get_post('username');
		$userpassword = $this->input->get_post('password');

		$userCredentialArray = array('username' => $username, 'userpassword' => $userpassword);
		$userCredential = $this->users_model->checkUsersLoginCredential($userCredentialArray);

		print_r(json_encode($userCredential));
	}
}
