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

	public function getUserDetailsFromApps()
	{
		$userid = $this->input->get_post('userid');
		$userArray = array();
		if($userid != "" && $userid!=null){
			$detailsArray = $this->users_model->getFrontendUsers($userid, "");
			if(count($detailsArray)>0){
				$userArray = $detailsArray[0];
				$stateName = "";
				$cityName = "";
				$orderBy = " order by s.state ASC";
				$stateArray = $this->Backend_model->getStateList($userArray['stateId'], "1", $orderBy);
				if(count($stateArray)>0){
					$stateName = $stateArray[0]['state'];
				}

				$orderBy = " order by s.district ASC";
				$districtArray = $this->Backend_model->getDistrictList($userArray['districtId'], "", "", $orderBy);
				if(count($districtArray)>0){
					$cityName = $districtArray[0]['district'];
				}

				$userArray['stateName'] = $stateName;
				$userArray['cityName'] = $cityName;
			}
		}
		print_r(json_encode($userArray));

	}

	public function confirmUserAndSendOtpFromApps()
	{
		$mobileNumber = $this->input->get_post('mobileNumber');
		$userId = $this->users_model->getUsersLoginCredential($mobileNumber);
		if ($userId > 0) {
			$fromIp = $_SERVER['REMOTE_ADDR'];
			$baseUrl = base_url();
			$otpText = $this->users_model->getOTPForUserForgotPassword($userId, $mobileNumber, $fromIp, $baseUrl);
			$output = array('status' => "1", 'message' => $mobileNumber, 'otp'=> $otpText, 'otpUserId'=> $userId);
		} else {
			$output = array('status' => "2", 'message' => "Your Mobile Number was not Registered!", 'otp'=>"", 'otpUserId'=> '0');
		}

		print_r(json_encode($output));
	}

	public function updateMyPasswordFromApps(){

		$mobileNumber = $this->input->get_post('mobileNumber');
		$otptext = $this->input->get_post('otpText');
		$password = $this->input->get_post('password');
		$confirmPassword = $this->input->get_post('confirmPassword');
		$output = array();
		if ($mobileNumber != "") {
			$alreadyExist = $this->users_model->isUserAlreadyExist($mobileNumber);
			if ($alreadyExist == 1) {
				if ($otptext != "") {
					if ($password == $confirmPassword) {
						$resultArray = $this->users_model->getSuccessMsgOTPUpdated($mobileNumber, $otptext, "forgotpasswordrequest");
						$successOTPUpdated = $resultArray['successMsg'];
						$userid = $resultArray['userid'];
						if ($otptext != "" && $mobileNumber != "" && $successOTPUpdated == "1") {
							$this->users_model->updateMyPassword($userid, $password);
							$output = array('status' => "4", 'message' => "Your password has been successfully updated !.");
						} else {
							$output = array('status' => "2", 'message' => "Incorrect OTP Details");
						}
					} else {
						$output = array('status' => "2", 'message' => "Mismatch Password Details");
					}
				}
			} else {
				$output = array('status' => "2", 'message' => "Invalid user Mobile");
			}
		} else {
			$output = array('status' => "2", 'message' => "Please resubmit your forgot Password request!");
		}

		print_r(json_encode($output));

	}

	public function getCategoryListFromApps(){

		$orderBy = " order by orders Asc";
		$categoryArray = $this->Backend_model->getCategoryList("0", $orderBy);

		print_r(json_encode($categoryArray));

	}
}