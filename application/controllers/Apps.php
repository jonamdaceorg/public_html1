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

	public function confirmUserAndSendOtpFromApps()
	{
		$mobileNumber = $this->input->get_post('mobileNumber');
		$userId = $this->users_model->getUsersLoginCredential($mobileNumber);
		if ($userId > 0) {
			$fromIp = $_SERVER['REMOTE_ADDR'];
			$baseUrl = base_url();
			$otpText = $this->users_model->getOTPForUserForgotPassword($userId, $mobileNumber, $fromIp, $baseUrl);
			$output = array('status' => "1", 'message' => $mobileNumber, 'otp'=> $otpText);
		} else {
			$output = array('status' => "2", 'message' => "Your Mobile Number was not Registered!", 'otp'=>"");
		}

		print_r(json_encode($output));
	}
}
