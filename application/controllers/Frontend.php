<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('users_model');
        $this->load->model('Backend_model');
        $this->load->library('session');
//        $this->load->library('encrypt');
    }

    public function index()
    {
        $output = $this->session->flashdata('output');
        $succesMsg = $this->users_model->getSuccessMsg($output);
        $orderBy = "Asc";
        $orderBy = " order by orders Asc";
        $categoryArray = $this->Backend_model->getCategoryList("0", $orderBy);

        $dataheader['succesMsg'] = $succesMsg;
        $dataheader['title'] = "1StepShop";
        $dataheader['categoryArray'] = $categoryArray;

        $this->load->view('layout/Frontend_header', $dataheader);
        $this->load->view('Frontend/Frontend_index');
        $this->load->view('layout/Frontend_footer');
//		$this->users_model->migrationCountryStateCity();

    }

    public function contactUs()
    {
        $dataheader['title'] = "Contact Us";

        $output = $this->session->flashdata('output');
        $succesMsg = $this->Backend_model->getSuccessMsg($output);
        $dataheader['succesMsg'] = $succesMsg;
        $dataheader['getCommonSelectBoxUrl'] = base_url() . "Backend/getCommonSelectBox";
        $dataheader['sendContactUsDetailsUrl'] = base_url() . "sendContactUsDetails";

        $actionId = "";
        $orderBy = " order by orders Asc";
        $categoryArray = $this->Backend_model->getCategoryList($actionId, $orderBy);
        $dataheader['categoryArray'] = $categoryArray;

        $this->load->view('layout/Frontend_header', $dataheader);
        $this->load->view('Frontend/contactUs');
        $this->load->view('layout/Frontend_footer');
    }

    public function sendContactUsDetails()
    {
        $mobileNumber = $this->input->get_post('mobileNumber');
        $email = $this->input->get_post('email');
        $name = $this->input->get_post('name');
        $categoryId = $this->input->get_post('categoryId');
        $description = $this->input->get_post('description');

        $active = "active";
        $createdAt = date("Y-m-d H:i:s");
        $fromIp = $this->Backend_model->getIpAddress();

        $contactUsArray = array('mobileNumber' => $mobileNumber, 'email' => $email, 'name' => $name, 'categoryId' => $categoryId, 'description' => $description, 'active' => $active, 'fromIp' => $fromIp, 'createdAt' => $createdAt);
        $response = $this->users_model->insertContactUS($contactUsArray);

        if ($response == "1") {
            $output = array('status' => "1", 'message' => "Thank you for contacting us. We will get in touch with you within 24hrs...");
        } else {
            $output = array('status' => "2", 'message' => "Please try again later!");
        }
        $this->session->set_flashdata('output', $output);

        redirect(base_url() . "contactUs");
    }

    public function aboutUs()
    {
        $output = $this->session->flashdata('output');
        $succesMsg = $this->users_model->getSuccessMsg($output);

        $dataheader['succesMsg'] = $succesMsg;
        $dataheader['title'] = "About Us";

        $this->load->view('layout/Frontend_header', $dataheader);
        $this->load->view('layout/Frontend_menu');
        $this->load->view('Frontend/aboutUs');
        $this->load->view('layout/Frontend_footer');
    }

    public function login()
    {
        $output = $this->session->flashdata('output');
        $succesMsg = $this->users_model->getSuccessMsg($output);

        $dataheader['succesMsg'] = $succesMsg;
        $dataheader['title'] = "Login";
        $dataheader['loginPostUrl'] = base_url() . "usersCheckLogin";

        //Remember me block of code functionality By Mathan at 29 Oct 2016
        $cookiePassword = "";
        $cookieusername = "";
        $cookieRememberMe = "";
        if (isset($_COOKIE['cookiePassword']) && isset($_COOKIE['cookieUserName']) && isset($_COOKIE['cookieRememberMe'])) {
            $cookiePassword = $_COOKIE['cookiePassword'];
            $cookieusername = $_COOKIE['cookieUserName'];
            $cookieRememberMe = $_COOKIE['cookieRememberMe'];
        }
        $dataheader['cookiePassword'] = $cookiePassword;
        $dataheader['cookieUserName'] = $cookieusername;
        $dataheader['cookieRememberMe'] = $cookieRememberMe;
        //End of Remember me block of code functionality

        $this->load->view('layout/Frontend_header', $dataheader);
        $this->load->view('Frontend/Frontend_login');
//        $this->load->view('layout/Frontend_login_footer');
        $this->load->view('layout/Frontend_footer');

    }

    public function register()
    {
        $dataheader['title'] = "Register";
        $dataheader['registerPostUrl'] = base_url() . "usersRegister";
        $actionId = "";
        $countryId = "";
        $orderBy = " order by s.state ASC";
        $stateArray = $this->Backend_model->getStateList($actionId, $countryId, $orderBy);
        $dataheader['stateArray'] = $stateArray;
        $dataheader['getCommonSelectBoxUrl'] = base_url() . "Backend/getCommonSelectBox";

        $output = $this->session->flashdata('output');
        $succesMsg = $this->users_model->getSuccessMsg($output);
        $dataheader['succesMsg'] = $succesMsg;

        $this->load->view('layout/Frontend_header', $dataheader);
        $this->load->view('Frontend/Frontend_register');
//        $this->load->view('layout/Frontend_login_footer');
        $this->load->view('layout/Frontend_footer');
    }

    public function usersRegister()
    {

        $mobileNumber = $this->input->get_post('mobileNumber');
        $password = $this->input->get_post('password');
        $name = $this->input->get_post('name');
        $email = $this->input->get_post('email');
        $stateId = $this->input->get_post('stateId');
        $districtId = $this->input->get_post('districtId');
        $address = $this->input->get_post('address');


        $countryId = "1";
        $fromIp = $_SERVER['SERVER_ADDR'];
        $newdate = new DateTime("now");
        $createdAt = date_format($newdate, "Y-m-d H:i:s");
        $usersProfileArray = array('mobile' => $mobileNumber, 'password' => $password, 'name' => $name, 'email' => $email, 'countryId' => $countryId, 'stateId' => $stateId, 'districtId' => $districtId, 'address' => $address, 'active' => 'InActive', 'fromIp' => $fromIp, 'createdAt' => $createdAt);
        $updateSuccess = $this->users_model->createFrontendUsersProfile($usersProfileArray); //For Update Brand
        if (!$updateSuccess) {
            $activateUser = array('userMobileNumber' => $mobileNumber);
            $this->session->set_flashdata('activateUser', $activateUser);

            $output = array('status' => "1", 'message' => "Please enter the OTP to Activate your profile");
            $this->session->set_flashdata('output', $output);
            redirect(base_url() . "activateProfile");
        } else {
            $output = array('status' => "2", 'message' => "Your Mobile Number is already registered!!");
            $this->session->set_flashdata('output', $output);
            redirect(base_url() . "register");
        }
    }

    public function activateProfile()
    {
        $output = $this->session->flashdata('output');
        $succesMsg = $this->users_model->getSuccessMsg($output);
        $dataheader['succesMsg'] = $succesMsg;
        $mobileNumber = $this->input->get_post('mobileNumber');
        $otptext = $this->input->get_post('otpText');

        $activateMobileNumber = "";
        $activateUser = $this->session->flashdata('activateUser');
        if (count($activateUser) > 0) {
            $activateMobileNumber = $activateUser['userMobileNumber'];
        }

        if ($activateMobileNumber == "" && $mobileNumber != "") {
            $activateMobileNumber = $mobileNumber;
        }
        $dataheader['activateMobileNumber'] = $activateMobileNumber;

        $output = $this->session->flashdata('output');
        $dataheader['title'] = "Register";
        $dataheader['confirmOtpUrl'] = base_url() . "activateProfile";

        if ($activateMobileNumber != "") {
            $alreadyExist = $this->users_model->isUserAlreadyExist($activateMobileNumber);
            if ($alreadyExist == 1) {
                if ($otptext != "") {
                    $resultArray = $this->users_model->getSuccessMsgOTPUpdated($activateMobileNumber, $otptext, "profileactivationrequest");
                    $successOTPUpdated = $resultArray['successMsg'];
                    $userid = $resultArray['userid'];
                    if ($otptext != "" && $activateMobileNumber != "" && $successOTPUpdated == "1") {
                        $this->users_model->activateMyProfile($userid);
                        $output = array('status' => "1", 'message' => "Your account Successfully activated! <br/>Please login.");
                        $this->session->set_flashdata('output', $output);
                        $redirectUrl = "login";
                        redirect(base_url() . $redirectUrl);
                    } else {
                        $output = array('status' => "2", 'message' => "Incorrect OTP Details");
                    }
                }
            } else {
                $output = array('status' => "2", 'message' => "Invalid user Mobile");
                $this->session->set_flashdata('output', $output);
                $redirectUrl = "login";
                redirect(base_url() . $redirectUrl);
            }
        } else {
            $output = array('status' => "2", 'message' => "Please try again later");
            $this->session->set_flashdata('output', $output);
            $redirectUrl = "login";
            redirect(base_url() . $redirectUrl);
        }

        $succesMsg = $this->users_model->getSuccessMsg($output);
        $dataheader['succesMsg'] = $succesMsg;

        $this->load->view('layout/Frontend_header', $dataheader);
        $this->load->view('Frontend/activateProfile');
        $this->load->view('layout/Frontend_login_footer');
    }

    public function confirmUserAndSendOtp()
    {
        $mobileNumber = $this->input->get_post('mobileNumber');
        $userId = $this->users_model->getUsersLoginCredential($mobileNumber);
        if ($userId > 0) {
            $fromIp = $_SERVER['REMOTE_ADDR'];
            $baseUrl = base_url();
            $otpText = $this->users_model->getOTPForUserForgotPassword($userId, $mobileNumber, $fromIp, $baseUrl);
            $redirectUrl = "forgotPassword?mobileNumber=" . $mobileNumber;
            //Send OTP to mobile
        } else {
            $output = array('status' => "2", 'message' => "Your Mobile Number was not Registered!");
            $this->session->set_flashdata('output', $output);
            $redirectUrl = "login";
        }
        redirect(base_url() . $redirectUrl);
    }

    public function forgotPassword()
    {
        $output = $this->session->flashdata('output');

        $mobileNumber = $this->input->get_post('mobileNumber');
        $otptext = $this->input->get_post('otpText');
        $password = $this->input->get_post('password');
        $confirmPassword = $this->input->get_post('confirmPassword');
        $dataheader['mobileNumber'] = $mobileNumber;

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
                            $output = array('status' => "1", 'message' => "Your account Successfully activated! <br/>Please login.");
                            $this->session->set_flashdata('output', $output);
                            $redirectUrl = "login";
                            redirect(base_url() . $redirectUrl);
                        } else {
                            $output = array('status' => "2", 'message' => "Incorrect OTP Details");
                        }
                    } else {
                        $output = array('status' => "2", 'message' => "Mismatch Password Details");
                    }
                }
            } else {
                $output = array('status' => "2", 'message' => "Invalid user Mobile");
                $this->session->set_flashdata('output', $output);
                $redirectUrl = "login";
                redirect(base_url() . $redirectUrl);
            }
        } else {
            $output = array('status' => "2", 'message' => "Please resubmit your forgot Password request!");
            $this->session->set_flashdata('output', $output);
            $redirectUrl = "login";
            redirect(base_url() . $redirectUrl);
        }

        $succesMsg = $this->users_model->getSuccessMsg($output);
        $dataheader['succesMsg'] = $succesMsg;

        $dataheader['title'] = "OTP Confirmation";
        $dataheader['confirmOtpUrl'] = base_url() . "forgotPassword";

        $this->load->view('layout/Frontend_header', $dataheader);
        $this->load->view('Frontend/forgotPassword');
        $this->load->view('layout/Frontend_login_footer');
    }

    public function confirmOtp()
    {

        $otptext = $this->input->get_post('otpText');
        $mobileNumber = $this->input->get_post('mobileNumber');
        echo "Processing...";

        //redirect(base_url() . $redirectUrl);
    }

    public function usersCheckLogin()
    {
        $username = $this->input->post('username');
        $userpassword = $this->input->post('password');
        $checkboxLogin = $this->input->post('checkbox-login');

        $userCredentialArray = array('username' => $username, 'userpassword' => $userpassword);
        $userCredential = $this->users_model->checkUsersLoginCredential($userCredentialArray);
        if (count($userCredential) > 0) {

            $this->session->set_userdata($userCredential);
            $this->users_model->updateUsersLastlogin($userCredential['userid']);

            //Remember me block of code functionality By Mathan at 29 Oct 2016
            if ($checkboxLogin != "on") {
                if (isset($_COOKIE['cookiePassword']) && isset($_COOKIE['cookieUserName']) && $_COOKIE['cookieRememberMe'] == "on") {
                    unset($_COOKIE['cookieRememberMe']);
                    unset($_COOKIE['cookieUserName']);
                    unset($_COOKIE['cookiePassword']);
                }
                $username = "";
                $userpassword = "";
                $checkboxLoginValue = "";
            } else {
                $checkboxLoginValue = "on";
            }

            $year = time() + 31536000;
            setcookie('cookieRememberMe', $checkboxLoginValue, $year);
            setcookie('cookieUserName', $username, $year);
            setcookie('cookiePassword', $userpassword, $year);
            $_COOKIE['cookiePassword'] = $userpassword;
            $_COOKIE['cookieUserName'] = $username;
            $_COOKIE['cookieRememberMe'] = $checkboxLoginValue;
            //End of Remember me block of code functionality

            //History Update Start
            $createdAt = date("Y-m-d H:i:s");
            $fromIp = $this->Backend_model->getIpAddress();
            $action = 'Login';
            $description = "Response : successfully signin...";
            $pageName = "User Login";
            $pageUrl = 'usersCheckLogin';
            $historyArray = array('actionId' => '0', 'description' => $description, 'action' => $action, 'userid' => $userCredential['userid'], 'active' => 'active', 'fromIp' => $fromIp, 'createdAt' => $createdAt, 'pageName' => $pageName, 'pageUrl' => $pageUrl);
            $this->users_model->insertHistory($historyArray);
            //History Update End


            redirect(base_url() . "myAccount");
        } else {
            $output = array('status' => "2", 'message' => "Username/Password is incorrect.");
            $this->session->set_flashdata('output', $output);
            redirect(base_url() . "login");
        }
    }

    public function logout()
    {
        $successMsg = "Successfully logout !!!";
        $output = array('status' => "1", 'message' => $successMsg);
        $this->session->set_flashdata('output', $output);

        $sessionUserIdIsset = $this->session->has_userdata('userid');

        if ($sessionUserIdIsset == 1) {
            $userid = $this->session->userdata('userid');
            $userListArray = array('userid');
            $this->session->unset_userdata($userListArray);

            //History Update Start
            $createdAt = date("Y-m-d H:i:s");
            $fromIp = $this->Backend_model->getIpAddress();
            $action = 'Logout';
            $description = "Response : ".$successMsg;
            $pageName = "User Logout";
            $pageUrl = 'logout';
            $historyArray = array('actionId' => '0', 'description' => $description, 'action' => $action, 'userid' => $userid, 'active' => 'active', 'fromIp' => $fromIp, 'createdAt' => $createdAt, 'pageName' => $pageName, 'pageUrl' => $pageUrl);
            $this->users_model->insertHistory($historyArray);
            //History Update End
        }

        redirect(base_url() . "login");
    }

    public function signup()
    {
        $output = $this->session->flashdata('output');
        $succesMsg = $this->users_model->getSuccessMsg($output);

        $dataheader['succesMsg'] = $succesMsg;
        $dataheader['title'] = "Register";
        $dataheader['loginPostUrl'] = "index.php/checkLogin";

        $this->load->view('layout/Frontend_login_header', $dataheader);
        $this->load->view('Frontend/Frontend_signup');
        $this->load->view('layout/Frontend_footer');
    }

    public function myAccount()
    {
        $sessionUserIdIsset = $this->session->has_userdata('userid');
        $userid = 0;
        if ($sessionUserIdIsset == 1) {
            $userid = $this->session->userdata('userid');
        } else {
            redirect(base_url() . "login");
        }
        $detailsArray = $this->users_model->getFrontendUsers($userid, "");
        $userArray = array();
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

        $dataheader['title'] = "My Account";
        $dataheader['userArray'] = $userArray;
        $dataheader['userid'] = $userid;
        $this->load->view('layout/Frontend_header', $dataheader);
//		$this->load->view('layout/Frontend_menu');
        $this->load->view('Frontend/myAccount');
        $this->load->view('layout/Frontend_footer');
    }

    public function posting()
    {
        $sessionUserIdIsset = $this->session->has_userdata('userid');
        $userid = 0;
        if ($sessionUserIdIsset == 1) {
            $userid = $this->session->userdata('userid');
        } else {
            redirect(base_url() . "login");
        }

        $output = $this->session->flashdata('output');
        $succesMsg = $this->users_model->getSuccessMsg($output);
        $dataheader['userid'] = $userid;
        $dataheader['succesMsg'] = $succesMsg;
        $dataheader['title'] = "Post an Ad";

        $orderBy = " order by s.state ASC";
        $stateArray = $this->Backend_model->getStateList("0", "1", $orderBy);

        $actionId = "";
        $orderBy = " order by orders Asc";
        $categoryArray = $this->Backend_model->getCategoryList($actionId, $orderBy);
        $dataheader['categoryArray'] = $categoryArray;
        $dataheader['stateArray'] = $stateArray;
        $dataheader['getCommonJsonDataUrl'] = base_url() . "Frontend/getCommonJsonData";

        $this->load->view('layout/Frontend_header', $dataheader);
        $this->load->view('Frontend/Frontend_posting');
        $this->load->view('layout/Frontend_footer');
    }

    public function getDynamicFieldsforAdPost()
    {
        $categoryId = $this->input->get_post('categoryId');
        $subCategoryId = $this->input->get_post('subCategoryId');

        $action = $this->input->get_post('action');
        $adsId = $this->input->get_post('adsId');
        $actualPrice = "";
        $offerPrice = "";
        $myDynamicDetails = array();
        if($action == "Edit"){
            $adsId = $this->users_model->encryptor('decrypt',$adsId);//s2
            $paginationArray = $this->users_model->getadsList($adsId, "", "", "", "", "", "", "", "", "", "", "", "","","","","","","", "","", 1);
            $editAdsArray = $paginationArray['resultArrayData'];
            if(count($editAdsArray)>0){
                $adsArray = $editAdsArray[0];
                $actualPrice = $adsArray['actualPrice'];
                $offerPrice = $adsArray['offerPrice'];

                $dynamicAdsDetails = $this->users_model->getSingleAdsDynamicDetails($adsId);

                foreach($dynamicAdsDetails as $dynamicAdsDetailsSingle){
                    $myDynamicDetails[$dynamicAdsDetailsSingle['capturedvariablename']][] = $dynamicAdsDetailsSingle['capturedVariableValue'];
                }


            }
         //  print_r($myDynamicDetails);
        }
        $actionId = "0";
        $dynamicFieldsforAdPostArray = $this->Backend_model->getDynamicFieldsforAdPost($actionId, $categoryId, $subCategoryId);

        $isAmountRequired="";
        $isOfferAmountRequired="";
        $categoryArray = $this->Backend_model->getCategoryList($categoryId, "");
        if (count($categoryArray) > 0) {
            $isAmountRequired = $categoryArray[0]['isAmountRequired'];
            $isOfferAmountRequired = $categoryArray[0]['isOfferAmountRequired'];
        }

        $contentString = "";
        //pricing start
        if ($isAmountRequired == "Required" || $isOfferAmountRequired == "Required" ) {

            $contentString .= '<div class="form-group">
                    <div class="row">';
            if ($isAmountRequired == "Required") {
                $contentString .= '  <div class="col-sm-6" >
                        <div class="row" >
                            <div class="col-sm-6 textlabel" > Price </div >
                            <div class="col-sm-6" >
                                <input type = "text" class="selectboxWidth" name = "actualPrice" id = "actualPrice" placeholder = "Price" value = "'.$actualPrice.'" >
                            </div >
                            </div >
                        </div >';
                }
            if ($isOfferAmountRequired == "Required") {
                $contentString .= '     <div class="col-sm-6" >
                        <div class="row" >
                            <div class="col-sm-6 textlabel" > Offer Price </div >
                            <div class="col-sm-6" >
                                <input type = "text" class="selectboxWidth" name = "offerPrice" id = "offerPrice" placeholder = "Offer Price" value = "'.$offerPrice.'" >
                            </div >
                            </div >
                        </div >';
                }
            $contentString .='</div>
    </div>';
        }
        //pricing end
        $contentString .= '<div class="form-group">
                                <div class="row">';
//        echo "<pre>";
//        print_r($dynamicFieldsforAdPostArray);
//        echo "</pre>";

        $lengthOfDynamicFields = count($dynamicFieldsforAdPostArray);
        for ($n = 0; $n < count($dynamicFieldsforAdPostArray); $n++) {
            $capturedVariableId = $dynamicFieldsforAdPostArray[$n]['capturedVariableId'];
            $capturedvariabletype = $dynamicFieldsforAdPostArray[$n]['dynamicInputType'];
            $capturedvariablename = $dynamicFieldsforAdPostArray[$n]['capturedvariablename'];
            $dynamicInputId = $dynamicFieldsforAdPostArray[$n]['dynamicInputId'];
            $inputData = "";

            $existingSelectedValue = "";
            $existingSelectedValuearray = array();

            if(array_key_exists($capturedvariablename, $myDynamicDetails)){
                if(count($myDynamicDetails[$capturedvariablename])==1) {
                    $existingSelectedValue = $myDynamicDetails[$capturedvariablename][0];
                }
                else if(count($myDynamicDetails[$capturedvariablename])>1) {
                    $existingSelectedValue = $myDynamicDetails[$capturedvariablename];
                    $existingSelectedValuearray = $myDynamicDetails[$capturedvariablename];
                }
            }

            if ($capturedvariabletype != "Input Box" && $capturedvariabletype != "Textarea") {
                $getDynamicInputValuesMaster = $this->Backend_model->getDynamicInputValueList("", $dynamicInputId);
                if ($capturedvariabletype == "Select Box") {
                    if (count($getDynamicInputValuesMaster) > 0) {
                        $selectBoxString = '<select name="capturedvariablename_' . $capturedVariableId . '" id="capturedvariablename_' . $dynamicInputId . '" class="form-control selectboxWidth select2 select2new" onchange="getCommonSelectBox(this.value, \'districtDiv\')"  ><option value="">Select ' . $capturedvariablename . '</option>';
                        for ($c = 0; $c < count($getDynamicInputValuesMaster); $c++) {
                            $dynamicInputValue = $getDynamicInputValuesMaster[$c]['dynamicInputValue'];
                            if($existingSelectedValue!="" && $existingSelectedValue!=null && $existingSelectedValue==$dynamicInputValue){
                                $selectBoxString = $selectBoxString . '<option value="' . $dynamicInputValue . '" selected>' . $dynamicInputValue . '</option>';
                            } else {
                                $selectBoxString = $selectBoxString . '<option value="' . $dynamicInputValue . '">' . $dynamicInputValue . '</option>';
                            }
                        }
                        $selectBoxString = $selectBoxString . '</select>';
                        $inputData = $selectBoxString;
                    }
                } else if ($capturedvariabletype == "Check Box") {
                    $inputData .= "<div class='wrap'>
                                        <main>
                                            <aside> ";
                    for ($s = 0; $s < count($getDynamicInputValuesMaster); $s++) {
                        $dynamicInputValue = $getDynamicInputValuesMaster[$s]['dynamicInputValue'];
                        if($existingSelectedValue!="" && $existingSelectedValue!=null && ($existingSelectedValue==$dynamicInputValue || in_array($dynamicInputValue, $existingSelectedValuearray) )){
//                            $inputData .= "<input type='checkbox' name='capturedvariablename_" . $capturedVariableId . "[]' value='" . $dynamicInputValue . "' checked >&nbsp;" . $dynamicInputValue . "&nbsp;<br/>";
                            $inputData .= "<div class='container-fluid'><div class='checkbox'>
                        <input type='checkbox' name='capturedvariablename_" . $capturedVariableId . "[]' value='" . $dynamicInputValue . "' id='checkbox".$capturedVariableId."_".$s."' checked >
                        <label for='checkbox".$capturedVariableId."_".$s."' class='labelWidth'>
                            ".$dynamicInputValue."
                        </label>
                    </div></div>";
                        } else {
//                            $inputData .= "<input type='checkbox' name='capturedvariablename_" . $capturedVariableId . "[]' value='" . $dynamicInputValue . "' >&nbsp;" . $dynamicInputValue . "&nbsp;<br/>";
                            $inputData .= "<div class='container-fluid'><div class='checkbox'>
                        <input type='checkbox' name='capturedvariablename_" . $capturedVariableId . "[]' value='" . $dynamicInputValue . "' id='checkbox".$capturedVariableId."_".$s."'>
                        <label for='checkbox".$capturedVariableId."_".$s."' class='labelWidth'>
                            ".$dynamicInputValue."
                        </label>
                    </div></div>";
                        }
                    }
                    $inputData .= "         </aside>
                                        </main>
                                    </div>";
                } else if ($capturedvariabletype == "Radio Button") {
                    $inputData .= "<div class='wrap'>
                                        <main>
                                            <aside> ";
                    for ($s = 0; $s < count($getDynamicInputValuesMaster); $s++) {
                        $dynamicInputValue = $getDynamicInputValuesMaster[$s]['dynamicInputValue'];
                        if($existingSelectedValue!="" && $existingSelectedValue!=null && $existingSelectedValue==$dynamicInputValue){
//                            $inputData .= "<input type='radio' name='capturedvariablename_" . $capturedVariableId . "' value='" . $dynamicInputValue . "' checked>&nbsp;" . $dynamicInputValue . "&nbsp;<br/>";
                            $inputData .= "<div class='myradio checkbox-circle'>
                        <input type='radio' name='capturedvariablename_" . $capturedVariableId . "' value='" . $dynamicInputValue . "' id='radio".$capturedVariableId."_".$s."' checked>
                        <label for='radio".$capturedVariableId."_".$s."' class='labelWidth'>
                            ".$dynamicInputValue."
                        </label>
                    </div>";
                        } else {
//                            $inputData .= "<input type='radio' name='capturedvariablename_" . $capturedVariableId . "' value='" . $dynamicInputValue . "'>&nbsp;" . $dynamicInputValue . "&nbsp;<br/>";
                            $inputData .= "<div class='myradio checkbox-circle'>
                        <input type='radio' name='capturedvariablename_" . $capturedVariableId . "' value='" . $dynamicInputValue . "' id='radio".$capturedVariableId."_".$s."'>
                        <label for='radio".$capturedVariableId."_".$s."' class='labelWidth'>
                            ".$dynamicInputValue."
                        </label>
                    </div>";
                        }
                    }
                    $inputData .= "         </aside>
                                        </main>
                                    </div>";
                }
            } else if ($capturedvariabletype == "Input Box") {
                $inputData = "<input type='text' name='capturedvariablename_" . $capturedVariableId . "' placeholder='" . $capturedvariablename . "' class='selectboxWidth' value='".$existingSelectedValue."'> ";
            } else if ($capturedvariabletype == "Textarea") {
                $inputData = "<textarea name='capturedvariablename_" . $capturedVariableId . "' placeholder='" . $capturedvariablename . "' class='selectboxWidth'>".$existingSelectedValue."</textarea>";
            }
            if($n%2==0){
                $contentString .= '</div>  <div class="row"> ';
            }
            $contentString .= '<div class="col-sm-6 col-md-6">
<div class="form-group">
                                    <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-6 textlabel" >' . $capturedvariablename . '</div>
                                        <div class="col-sm-6">' . $inputData . '</div>
                                        </div>
                                    </div>
                                    </div>
                               </div>';
        }
        /*if($lengthOfDynamicFields % 2 != 0){
            $contentString .= '<div class="col-sm-6">
<div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 textlabel" >test&nbsp;</div>
                                        <div class="col-sm-6">welcom&nbsp;</div>
                                    </div>
                                    </div>
                               </div>';
        }*/
        $contentString .= '</div>
                        </div>';

        echo $contentString;
    }

    public function getDynamicFieldsforSearchAds()
    {
        $categoryId = $this->input->get_post('categoryId');
        $subCategoryId = $this->input->get_post('subCategoryId');
        $actionId = "0";
        $dynamicFieldsforAdPostArray = $this->Backend_model->getDynamicFieldsforAdPost($actionId, $categoryId, $subCategoryId);

        $contentString = "";
        // $contentString .= '<div class="form-group">
        //                         <div class="row">';
//        echo "<pre>";
//        print_r($dynamicFieldsforAdPostArray);
//        echo "</pre>";
        $isAmountRequired="";

        $categoryArray = $this->Backend_model->getCategoryList($categoryId, "");
        if (count($categoryArray) > 0) {
            $isAmountRequired = $categoryArray[0]['isAmountRequired'];
        }

        for ($n = 0; $n < count($dynamicFieldsforAdPostArray); $n++) {
        $isSearchable=$dynamicFieldsforAdPostArray[$n]['isSearchable'];
            if($isSearchable=="yes" || $isSearchable=="Yes") {
                $searchType=$dynamicFieldsforAdPostArray[$n]['searchType'];
                $capturedVariableId = $dynamicFieldsforAdPostArray[$n]['capturedVariableId'];
                $capturedvariabletype = $dynamicFieldsforAdPostArray[$n]['dynamicInputType'];
                $capturedvariablename = $dynamicFieldsforAdPostArray[$n]['capturedvariablename'];
                $dynamicInputId = $dynamicFieldsforAdPostArray[$n]['dynamicInputId'];
                $inputData = "";
                if($searchType=="yearRange"){
                    $selectBoxStringFrom = '<select name="capturedvariablenameFrom_' . $capturedVariableId . '" id="capturedvariablenameFrom_' . $dynamicInputId . '" class="selectboxWidth form-control" parsley-trigger="change"  required ><option value="">Select  From ' . $capturedvariablename . '</option>';
                    $currentYear=  date("Y");
                    for ($c = $currentYear; $c >($currentYear-50) ; $c--) {

                        $selectBoxStringFrom = $selectBoxStringFrom . '<option value="' . $c . '">' . $c . '</option>';
                    }
                    $selectBoxStringFrom = $selectBoxStringFrom . '</select>';

                    $selectBoxStringTo = '<select name="capturedvariablenameTo_' . $capturedVariableId . '" id="capturedvariablenameTo_' . $dynamicInputId . '" class="selectboxWidth form-control" parsley-trigger="change"  required ><option value="">Select  to ' . $capturedvariablename . '</option>';
                    for ($c = $currentYear; $c >($currentYear-50) ; $c--) {

                        $selectBoxStringTo = $selectBoxStringTo . '<option value="' . $c . '">' .$c . '</option>';
                    }
                    $selectBoxStringTo = $selectBoxStringTo . '</select>';
                    $inputData = $selectBoxStringFrom."-".$selectBoxStringTo;

                }
                else if($searchType=="NumberRange" || $searchType=="DateRange" || $searchType=="TimeRange"){
                    $rangeStringFrom = '<input name="capturedvariablenameFrom_' . $capturedVariableId . '" id="capturedvariablenameFrom_' . $dynamicInputId . '" class="selectboxWidth form-control"  placeholder="' . $capturedvariablename . ' From"  />';
                    $rangeBoxStringTo = '<input name="capturedvariablenameTo_' . $capturedVariableId . '" id="capturedvariablenameTo_' . $dynamicInputId . '" class="selectboxWidth form-control"  placeholder="' . $capturedvariablename . ' To"   />';
                    $inputData = $rangeStringFrom."-".$rangeBoxStringTo;

                }
                else if($searchType=="TextSearch"){
                    $SearchString = '<input name="capturedvariablenameTextSearch_' . $capturedVariableId . '" id="capturedvariablenameTextSearch_' . $dynamicInputId . '" class="selectboxWidth form-control"  placeholder="' . $capturedvariablename . ' contains"  />';
                    $inputData =$SearchString;

                }
                else if ($capturedvariabletype != "Input Box" && $capturedvariabletype != "Textarea") {
                    $getDynamicInputValuesMaster = $this->Backend_model->getDynamicInputValueList("", $dynamicInputId);
                    /*if ($capturedvariabletype == "Select Box") {
                        if (count($getDynamicInputValuesMaster) > 0) {
                            $selectBoxString = '<select name="capturedvariablename_' . $capturedVariableId . '" id="capturedvariablename_' . $dynamicInputId . '" class="selectboxWidth form-control select2" multiple  parsley-trigger="change" onchange="getCommonSelectBox(this.value, \'districtDiv\')" required ><option value="">Select ' . $capturedvariablename . '</option>';
                            for ($c = 0; $c < count($getDynamicInputValuesMaster); $c++) {
                                $dynamicInputValue = $getDynamicInputValuesMaster[$c]['dynamicInputValue'];
                                $selectBoxString = $selectBoxString . '<option value="' . $dynamicInputValue . '">' . $dynamicInputValue . '</option>';
                            }
                            $selectBoxString = $selectBoxString . '</select>';
                            $inputData = $selectBoxString;
                        }
                    } else */
                    if ($capturedvariabletype == "Check Box" || $capturedvariabletype == "Radio Button" || $capturedvariabletype == "Select Box") {
                        $inputData .= "<div class='wrap'>
                                        <main>
                                            <aside> ";
                        for ($s = 0; $s < count($getDynamicInputValuesMaster); $s++) {
                            $dynamicInputValue = $getDynamicInputValuesMaster[$s]['dynamicInputValue'];
//                            $inputData .= "<input type='checkbox' name='capturedvariablename_" . $capturedVariableId . "[]' value='" . $dynamicInputValue . "' >&nbsp;" . $dynamicInputValue . "&nbsp;";
                            $inputData .= "<div class='container-fluid'><div class='checkbox'>
                        <input type='checkbox' name='capturedvariablename_" . $capturedVariableId . "[]' value='" . $dynamicInputValue . "' id='checkbox".$capturedVariableId."_".$s."' >
                        <label for='checkbox".$capturedVariableId."_".$s."' class='labelWidth'>
                            ".$dynamicInputValue."
                        </label>
                    </div></div>";

                        }
                        $inputData .= "         </aside>
                                        </main>
                                    </div>";
                    } /*else if ($capturedvariabletype == "Radio Button") {
                        $inputData .= "<div class='wrap'>
                                        <main>
                                            <aside> ";
                        for ($s = 0; $s < count($getDynamicInputValuesMaster); $s++) {
                            $dynamicInputValue = $getDynamicInputValuesMaster[$s]['dynamicInputValue'];
//                            $inputData .= "<input type='radio' name='capturedvariablename_" . $capturedVariableId . "' value='" . $dynamicInputValue . "'>&nbsp;" . $dynamicInputValue . "&nbsp;";
                            $inputData .= "<div class='container-fluid'><div class='checkbox'>
                        <input type='checkbox' name='capturedvariablename_" . $capturedVariableId . "[]' value='" . $dynamicInputValue . "' id='radio".$capturedVariableId."_".$s."' >
                        <label for='radio".$capturedVariableId."_".$s."' class='labelWidth'>
                            ".$dynamicInputValue."
                        </label>
                    </div></div>";

                        }
                        $inputData .= "         </aside>
                                        </main>
                                    </div>";
                    }*/
                } else if ($capturedvariabletype == "Input Box") {
                    $inputData = "<input type='text' name='capturedvariablename_" . $capturedVariableId . "' placeholder='" . $capturedvariablename . "' class='selectboxWidth form-control'> ";
                } else if ($capturedvariabletype == "Textarea") {
                    $inputData = "<textarea name='capturedvariablename_" . $capturedVariableId . "' placeholder='" . $capturedvariablename . "' class='selectboxWidth form-control'></textarea>";
                }
                $contentString .= '<div class="brand-select">
                                 <h3 class="sear-head">' . $capturedvariablename . '</h3>' . $inputData . '</div>';
            }
        }
        //$contentString .= '</div>
        //              </div>';
        if ($isAmountRequired== "Required") {
    $contentString .= '<div class="range">
                    <h3 class="sear-head">Price range</h3>
                            <ul class="dropdown-menu6">
                                <li>

                                    <div id="slider-range"></div>
                                        <input type="text" id="amount" name="amount" style="border: 0; color: #ffffff; font-weight: normal;" />
                                   <input type="hidden" id="amountRange"  name="amountRange" >
                                    </li>
                            </ul>

                            <script type="text/javascript">

                             $( "#slider-range" ).slider({
                                        range: true,
                                        min: 0,
                                        max: 100000,
                                        values: [ 0, 100000],
                                        slide: function( event, ui ) {
                                            $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                                            $( "#amountRange" ).val( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                                            loadsearchData();
                                        }
                             });
                            $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
                                $( "#amountRange" ).val(  $( "#slider-range" ).slider( "values", 0 ) + " - " + $( "#slider-range" ).slider( "values", 1 ) );



                            </script>';

}


        echo $contentString;
    }

    public function getCommonJsonData()
    {

        $categoryId = $this->input->get_post('categoryId');
        $subCategoryId = $this->input->get_post('subCategoryId');
        $upperDataValue = "";
        $divId = $this->input->get_post('divId');
        $actionId = $this->input->get_post('actionId');
        $jsonArrayData = array();
        if ($divId == "subCategoryIdDiv") {

            $orderBy = " order by orders ASC";
            $categoryArray = $this->Backend_model->getCategoryList($categoryId, $orderBy);
            if (count($categoryArray) > 0) {
                $upperDataValue = $categoryArray[0]['category'];
            }
            $orderBy = " order by s.subCategory ASC";

            $jsonArrayData = $this->Backend_model->getSubCategoryList("0", $categoryId, $orderBy);
        }


        if ($divId == "itemIdDiv") {
            $actionId = $subCategoryId;
            $orderBy = " order by s.subCategory Asc";
            $subCategoryArray = $this->Backend_model->getSubCategoryList($actionId, $categoryId, $orderBy);
            if (count($subCategoryArray) > 0) {
                $upperDataValue = $subCategoryArray[0]['subCategory'];
            }
            $itemArray = $this->Backend_model->getItemList("0", $categoryId, $subCategoryId);
            $jsonArrayData = $itemArray;
        }


        if ($divId == "DynamicFieldsDiv") {
            $dynamicInputType = $this->input->get_post('dynamicInputType');
            $jsonArrayData = $this->Backend_model->getDynamicInputMasterList("0", $dynamicInputType);
        }
        $returnDataArray['categoryId'] = $categoryId;
        $returnDataArray['subCategoryId'] = $subCategoryId;
        $returnDataArray['upperDataValue'] = $upperDataValue;
        $returnDataArray['jsonArrayData'] = $jsonArrayData;
        $returnDataArray['divId'] = $divId;
        echo json_encode($returnDataArray);
    }

    public function getStateAndCityId()
    {

        $state = $this->input->get_post('state');
        $city = $this->input->get_post('city');
        $returnArray = array();

        $returnArray = $this->users_model->getStateAndCityId($state, $city);;
        echo json_encode($returnArray);
    }

    public function createAdPost()
    {

        $sessionUserIdIsset = $this->session->has_userdata('userid');
        $userid = 0;
        if ($sessionUserIdIsset == 1) {
            $userid = $this->session->userdata('userid');
            $userCode = $this->session->userdata('userCode');
        } else {
            redirect(base_url() . "login");
        }

        $adsTitle = $this->input->get_post('adsTitle');
        $description = $this->input->get_post('description');
        $noOfDaysToActive = $this->input->get_post('noOfDaysToActive');
        $startDate = $this->input->get_post('startDate');
        $categoryId = $this->input->get_post('categoryId');
        $subCategoryId = $this->input->get_post('subCategoryId');
        $subCategoryId = $this->input->get_post('subCategoryId');
        $itemId = $this->input->get_post('itemId');
        $stateId = $this->input->get_post('stateId');
        $cityId = $this->input->get_post('cityId');

        $latitude = $this->input->get_post('latitude');
        $longitude = $this->input->get_post('longitude');

        $address = $this->input->get_post('address');
        $actualPrice = $this->input->get_post('actualPrice');
        $offerPrice = $this->input->get_post('offerPrice');

        if($offerPrice <= 0 || $offerPrice=="")
        {
            $offerPrice= $actualPrice;
        }



        $historyMsg = "";
        if ($adsTitle != "" && $userid > 0 && $categoryId > 0) {
            $active = "Waiting";
            $fromIp = $_SERVER['SERVER_ADDR'];
            $newdate = new DateTime("now");
            $createdAt = date_format($newdate, "Y-m-d H:i:s");

            if ($startDate == "" || $startDate == null || $startDate == "0000-00-00") {
                $startDate = $createdAt;
            }

            if ($noOfDaysToActive == "" || $noOfDaysToActive == null || $noOfDaysToActive == "0") {
                $noOfDaysToActive = 30;
            }

            $endDate = date("Y-m-d H:i:s", strtotime("+" . $noOfDaysToActive . "days", strtotime($startDate)));

            $countryId = 1;
//                $stateId=31;
//                $cityId = 516;
            $returnAdsCreatedArray = $this->users_model->createFreeAdPost($adsTitle, $description, $noOfDaysToActive, $startDate, $endDate, $categoryId, $subCategoryId, $itemId, $countryId, $stateId, $cityId, $address, $userid, $active, $fromIp, $createdAt,$actualPrice,$offerPrice, $latitude, $longitude);
            $adsId = 0;
            $adsCode =0;
            if($returnAdsCreatedArray!=null){
                $adsId = $returnAdsCreatedArray['adsId'];
                $adsCode = $returnAdsCreatedArray['adsCode'];
            }
            $historyMsg .= "Ads Title : ".$adsTitle." was created At ".$createdAt;
            $tblAdsExtrasArray = array();
            $dynamicFieldsforAdPostArray = $this->Backend_model->getDynamicFieldsforAdPost("0", $categoryId, $subCategoryId);

//            echo "<pre>";
//            print_r($_REQUEST);
//            echo "</pre>";

//            echo "<pre>";
//            print_r($dynamicFieldsforAdPostArray);
//            echo "</pre>";
            for ($i = 0; $i < count($dynamicFieldsforAdPostArray); $i++) {

                $capturedVariableId = $dynamicFieldsforAdPostArray[$i]['capturedVariableId'];
                $dynamicInputType = $dynamicFieldsforAdPostArray[$i]['dynamicInputType'];
                $postKey = 'capturedvariablename_' . $capturedVariableId;
                $requestArray = $_REQUEST;
                if (array_key_exists($postKey, $requestArray)) {
                    $capturedVariableValue = $requestArray[$postKey];
                    if ($dynamicInputType != "Check Box") {
                        $tblAdsExtrasArray['adsId'] = $adsId;
                        $tblAdsExtrasArray['capturedVariableId'] = $capturedVariableId;
                        $tblAdsExtrasArray['capturedVariableValue'] = $capturedVariableValue;
                        $this->users_model->insertIntoTblAdsExtras($tblAdsExtrasArray);

                    } else {
                        $tblAdsExtrasArray['adsId'] = $adsId;
                        $tblAdsExtrasArray['capturedVariableId'] = $capturedVariableId;
                        for ($n = 0; $n < count($capturedVariableValue); $n++) {
                            $capturedVariableValueStr = $capturedVariableValue[$n];
                            $tblAdsExtrasArray['capturedVariableValue'] = $capturedVariableValueStr;
                            $this->users_model->insertIntoTblAdsExtras($tblAdsExtrasArray);
                        }
                    }
                }
            }
            $postGalleryArray = $_FILES;
//            echo "<pre>";
//            print_r($postGalleryArray);
//            echo "</pre>";
            //It uplad gallery files
            $historyMsg .= $this->users_model->uploadMyGalleryFiles($adsId, $userCode, $adsCode, $active, $userid, $historyMsg, "Add");

            $successMsg = "Thank you for posting ad it will be activated within an hour";
            $output = array('status' => "1", 'message' => $successMsg);
            $this->session->set_flashdata('output', $output);
        } else {
            $successMsg =  "Invalid Data";
            $output = array('status' => "2", 'message' => $successMsg );
            $this->session->set_flashdata('output', $output);
        }

        //History Update Start
        $createdAt = date("Y-m-d H:i:s");
        $fromIp = $this->Backend_model->getIpAddress();
        $action = 'Add';
        $description = "Response : ".$successMsg.", Description : ".$historyMsg ;
        $pageName = "Ad Post";
        $pageUrl = 'posting';
        $historyArray = array('actionId' => '0', 'description' => $description, 'action' => $action, 'userid' => $userid, 'active' => 'active', 'fromIp' => $fromIp, 'createdAt' => $createdAt, 'pageName' => $pageName, 'pageUrl' => $pageUrl);
        $this->users_model->insertHistory($historyArray);
        //History Update End
//        redirect(base_url() . "posting");
    }

    public function categories()
    {


        $categoryArray = array();
        $subCategoryArray = array();
        $subCategorylist = array();
        $orderBy = " order by orders Asc";
        $categoryArray = $this->Backend_model->getCategoryList("0", $orderBy);

        $categoryId = "0";
        $actionId = "0";
        $orderBy = " order by s.subCategory Asc";
        $subCategoryArray = $this->Backend_model->getSubCategoryList($actionId, $categoryId, $orderBy);
        $categoryCountArray = $this->users_model->getCategoryAdsCount("", "");;
        $categoryAdsCount = array();
        $dataheader['categoryArray'] = $categoryArray;
        for ($i = 0; $i < count($categoryCountArray); $i++) {
            $categoryAdsCount[$categoryCountArray[$i]["categoryId"]] = $categoryCountArray[$i]["count(categoryId)"];
        }
        $dataheader['categoryAdsCount'] = $categoryAdsCount;
        $dataheader['users_model'] = $this->users_model;
        //new
        $k = 0;
        for ($i = 0; $i < count($subCategoryArray); $i++) {
            $subCategorylist[$subCategoryArray[$i]["categoryId"]]["subCategory"][] = $subCategoryArray[$i]["subCategory"];
            $subCategorylist[$subCategoryArray[$i]["categoryId"]]["subCategoryId"][] = $subCategoryArray[$i]["subCategoryId"];


        }


        /*********8 city list ********/
        $stateArray = array();
        $districtArray = array();
        $citylist = array();

        $countryId = "1";
        $orderBy = " order by s.state ASC";
        $stateArray = $this->Backend_model->getStateList($actionId, $countryId, $orderBy);
        $stateId = "0";
        $orderBy = " order by s.district ASC";
        $districtArray = $this->Backend_model->getDistrictList($actionId, $countryId, $stateId, $orderBy);

        for ($i = 0; $i < count($districtArray); $i++) {
            $citylist[$districtArray[$i]["stateId"]]["cityName"][] = $districtArray[$i]["district"];
            $citylist[$districtArray[$i]["stateId"]]["cityId"][] = $districtArray[$i]["districtId"];


        }

        $dataheader['citylist'] = $citylist;
        $dataheader['stateArray'] = $stateArray;

        /*********city list end ******/
        //new
        $dataheader['subCategorylist'] = $subCategorylist;

//        $dataheader['title'] = "categories";
        $categoryId = $this->input->get_post("categoryId");
        $categoriesTitle = "Categories";

        for($i=0; $i<count($categoryArray); $i++){
            if($categoryArray[$i]['categoryId'] == $categoryId){
                $categoriesTitle = $categoryArray[$i]['category'];
                break;
            }
        }
	$categoriesTitle=str_replace("&","and",$categoriesTitle);
        $dataheader['title'] = $categoriesTitle;
        $this->load->view('layout/Frontend_header', $dataheader);
        //$this->load->view('layout/Frontend_menu');

        $this->load->view('Frontend/categories');

        $this->load->view('layout/Frontend_footer');
    }

    //02feb
    public function categoryAjax()
    {
        $categoryArray = array();
        $subCategoryArray = array();
        $subCategorylist = array();
        $categoryAdsCount = array();
        $selectedcity = $this->input->get_post('selectedcity');

        $orderBy = " order by orders Asc";
        $categoryArray = $this->Backend_model->getCategoryList("0", $orderBy);

        $categoryId = "0";
        $actionId = "0";
        $orderBy = " order by s.subCategory Asc";
        $subCategoryArray = $this->Backend_model->getSubCategoryList($actionId, $categoryId, $orderBy);
        $categoryCountArray = $this->users_model->getCategoryAdsCount("", $selectedcity);

        $dataheader['categoryArray'] = $categoryArray;
        for ($i = 0; $i < count($categoryCountArray); $i++) {
            $categoryAdsCount[$categoryCountArray[$i]["categoryId"]] = $categoryCountArray[$i]["count(categoryId)"];
        }
        // print_r($categoryAdsCount);
        $dataheader['categoryAdsCount'] = $categoryAdsCount;
        //new
        $k = 0;
        for ($i = 0; $i < count($subCategoryArray); $i++) {
            $subCategorylist[$subCategoryArray[$i]["categoryId"]]["subCategory"][] = $subCategoryArray[$i]["subCategory"];
            $subCategorylist[$subCategoryArray[$i]["categoryId"]]["subCategoryId"][] = $subCategoryArray[$i]["subCategoryId"];


        }


        //new
        $dataheader['subCategorylist'] = $subCategorylist;

        $dataheader['title'] = "categories";
        $dataheader['users_model'] = $this->users_model;

        //$this->load->view('layout/Frontend_menu');

        $this->load->view('Frontend/categoryAjax', $dataheader);


    }


    public function adsList()
    {

//        $dataheader['title'] = "adsList";

        //$this->load->view('layout/Frontend_menu');
        $encryptparam= $this->input->get_post('param');
        $param=$this->users_model->encryptor('decrypt',$encryptparam);

      $paramsplit=  explode(":::",$param);
        $selectedCategoryId="";
        $selectedSubcategoryId="";
        $selectedcity="";
        if(count($paramsplit)>0){
            $selectedCategoryId= $paramsplit[0];
            if(count($paramsplit)>1){
                $selectedSubcategoryId= $paramsplit[1];
            }
            if(count($paramsplit)>2){
                $selectedcity= $paramsplit[2];
            }
        }

      //  $selectedCategoryId = $this->input->get_post('category');
      //  $selectedSubcategoryId = $this->input->get_post('subCategory');
        //new
        $categoryArray = array();

        $orderBy = " order by orders Asc";
        $categoryArray = $this->Backend_model->getCategoryList("0", $orderBy);
        $dataheader['categoryArray'] = $categoryArray;

        $encryptuserparam= $this->input->get_post('userparam');
        $userparam=$this->users_model->encryptor('decrypt',$encryptuserparam);
        $dataheader['userparam'] = $userparam;

        $userArray = array();
        if($userparam!=""){
            $userArray = $this->users_model->getFrontendUsers($userparam, "");

        }
        $dataheader['userArray'] = $userArray;



        //sub category start
        $categoryId = "0";
        $actionId = "0";
        $orderBy = " order by s.subCategory Asc";
        $subCategoryArray = $this->Backend_model->getSubCategoryList($actionId, $categoryId, $orderBy);


        $categoriesTitle = "Ads List";
        if($selectedCategoryId!=""){
            for($i=0; $i<count($categoryArray); $i++){
                if($categoryArray[$i]['categoryId'] == $selectedCategoryId){
                    $categoriesTitle .= " - ". $categoryArray[$i]['category'];
                    break;
                }
            }
        }

        if($selectedSubcategoryId!=""){
            for($i=0; $i<count($subCategoryArray); $i++){
                if($subCategoryArray[$i]['subCategoryId'] == $selectedSubcategoryId){
                    $categoriesTitle .= " - ". $subCategoryArray[$i]['subCategory'];
                    break;
                }
            }
        }
	$categoriesTitle=str_replace("&","and",$categoriesTitle);
        $dataheader['title'] = $categoriesTitle;


        $subCategorylist = array();
        for ($i = 0; $i < count($subCategoryArray); $i++) {
            $subCategorylist[$subCategoryArray[$i]["categoryId"]]["subCategory"][] = $subCategoryArray[$i]["subCategory"];
            $subCategorylist[$subCategoryArray[$i]["categoryId"]]["subCategoryId"][] = $subCategoryArray[$i]["subCategoryId"];


        }

        $dataheader['subCategorylist'] = $subCategorylist;
        //sub category end

        //new/*********8 city list ********/

        $categoryId = "0";
        $actionId = "0";

        $stateArray = array();
        $districtArray = array();
        $citylist = array();

        $countryId = "1";
        $orderBy = " order by s.state ASC";
        $stateArray = $this->Backend_model->getStateList($actionId, $countryId, $orderBy);
        $stateId = "0";
        $orderBy = " order by s.district ASC";
        $districtArray = $this->Backend_model->getDistrictList($actionId, $countryId, $stateId, $orderBy);

        for ($i = 0; $i < count($districtArray); $i++) {
            $citylist[$districtArray[$i]["stateId"]]["cityName"][] = $districtArray[$i]["district"];
            $citylist[$districtArray[$i]["stateId"]]["cityId"][] = $districtArray[$i]["districtId"];


        }

        $dataheader['citylist'] = $citylist;
        $dataheader['stateArray'] = $stateArray;

        /*********city list end ******/

        /*********8 city list ********/
        $stateArray = array();
        $districtArray = array();
        $citylist = array();

        $countryId = "1";
        $orderBy = " order by s.state ASC";
        $stateArray = $this->Backend_model->getStateList($actionId, $countryId, $orderBy);
        $stateId = "0";
        $orderBy = " order by s.district ASC";
        $districtArray = $this->Backend_model->getDistrictList($actionId, $countryId, $stateId, $orderBy);

        for ($i = 0; $i < count($districtArray); $i++) {
            $citylist[$districtArray[$i]["stateId"]]["cityName"][] = $districtArray[$i]["district"];
            $citylist[$districtArray[$i]["stateId"]]["cityId"][] = $districtArray[$i]["districtId"];


        }

        $dataheader['citylist'] = $citylist;
        $dataheader['stateArray'] = $stateArray;
        $categoryParam=str_replace(":::","-",$param);
        $dataheader['categoryParam'] = $categoryParam;


        /*********city list end ******/
//echo $selectedCategoryId;
        $dataheader['selectedCategoryId'] = $selectedCategoryId;
        $dataheader['selectedSubcategoryId'] = $selectedSubcategoryId;
        $dataheader['$selectedcity'] = $selectedcity;

        $this->load->view('layout/Frontend_header', $dataheader);
        $this->load->view('Frontend/adsList', $dataheader);
        $this->load->view('layout/Frontend_footer');


    }

    public function singleItem($adsId)
    {
        // $selectedAdsId = $this->input->get_post('adsId');
        $selectedAdsId = $adsId;
        $adsDetails = array();
        $dynamicAdsDetails = array();
        $adsgalleryDetails = array();
        $adsDetails = $this->users_model->getSingleAdsDetails($selectedAdsId);
        //view count update
      $adsViewcount = $this->users_model->getAdsViewedCount($selectedAdsId); //view count
        $dataheader['adsViewcount'] = $adsViewcount;
        $dataheader['adsId'] = $adsId;
        $dataheader['adsDetails'] = $adsDetails;
        $fromIp = $this->Backend_model->getIpAddress();
        $sessionUserIdIsset = $this->session->has_userdata('userid');

        $userid = "";
        if ($sessionUserIdIsset == 1) {
            $userid = $this->session->userdata('userid');
        }
        $this->users_model->updateAdsViewed($selectedAdsId,$fromIp,$userid);

        $encryptuserId=$this->users_model->encryptor('encrypt',$userid);
        $dataheader['encryptuserId'] = $encryptuserId;

        $encryptsearchuserId = "";
        if(count($adsDetails)>0) {
            if ($adsDetails[0]['userid'] != "") {
                $encryptsearchuserId = $this->users_model->encryptor('encrypt', $adsDetails[0]['userid']);

            }
        }
        $dataheader['encryptsearchuserId'] = $encryptsearchuserId;
        //view count updated end
        $dynamicAdsDetails = $this->users_model->getSingleAdsDynamicDetails($selectedAdsId);
        $dataheader['dynamicAdsDetails'] = $dynamicAdsDetails;

        $adsgalleryDetails = $this->users_model->getAdsGallery($selectedAdsId, "active");
        $dataheader['adsgalleryDetails'] = $adsgalleryDetails;




        //similar ads detaisl


        $amountRange = "";
        $searchText = "";
        $orderBy = "";
        $withphoto = "Yes";
        $categoryId= $adsDetails[0]['categoryId'];
        $subCategoryId=$adsDetails[0]['subCategoryId'];
        $itemId="";
        $countryId="";
        $stateId=""; $cityId="";
        $status="";
        $dynamicVariableIdList="";
        $dynamicSearchData="";
        $searchUserId="";
        $getListFromPage="";
        $rangeArray="";

        $page ="";
        $rec_limit = 12;
        $galleryStatus = "";
        $myLatitude = "0";
        $myLongitude = "0";
        $withOutadsId = $selectedAdsId;
        $paginationArray = $this->users_model->getadsList("", $categoryId, $subCategoryId, $itemId, $countryId, $stateId, $cityId, $status, $galleryStatus, $dynamicSearchData, $searchUserId, $getListFromPage,$rangeArray,$amountRange,$searchText,$withphoto,$myLatitude,$myLongitude,$orderBy,$withOutadsId, $page, $rec_limit);

        $similaradsArray = $paginationArray['resultArrayData'];
        $dataheader['similaradsArray'] = $similaradsArray;

        $isAmountRequired="";

        $categoryArray = $this->Backend_model->getCategoryList($categoryId, "");
        if (count($categoryArray) > 0) {
            $isAmountRequired = $categoryArray[0]['isAmountRequired'];
        }
        $dataheader['isAmountRequired'] = $isAmountRequired;

        //similar ads details end



        $dataheader['title'] = "singleItem";
        $this->load->view('layout/Frontend_header', $dataheader);
        //$this->load->view('layout/Frontend_menu');
        $this->load->view('Frontend/singleItem');
        $this->load->view('layout/Frontend_footer');
    }

    public function searchAdsAjax()
    {
        $getListFromPage = $this->input->get_post('getListFromPage');
        $selectedCategoryId = $this->input->get_post('categoryId');
        $selectedSubcategoryId = $this->input->get_post('SubcategoryId');
        $categoryId = $selectedCategoryId;
        $subCategoryId = $selectedSubcategoryId;
        $itemId = "";
        $countryId = "";
        $stateId = "";
        $cityId = $this->input->get_post('city');
        $searchData = array();
        $dynamicSearchData = array();
        $dynamicValueList = "";
        $dynamicVariableIdList = "";
        //$this->load->library('encrypt');
        //print_r($_REQUEST);
        $rangeArray =array();
        foreach ($_GET as $key => $value) {
//             echo "$key=$value";
            $pos = strpos($key, "capturedvariablename_");


            if ($pos !== false && !is_array($value)) {
                if ($value != "" && $value != null) {
//                    $dynamicValueList .= "'" . $value . "',";
//                    $dynamicVariableIdList .= "'" . trim($key, "capturedvariablename_") . "',";
                    $dynamicVariableId =  trim($key, "capturedvariablename_");
                    $dynamicSearchData[$dynamicVariableId]=$value;
                }
            } else if($pos !== false && is_array($value)){
                // To do multiple array value condition in search by mathan 13 june 2017
//                echo $key;
                //print_r($value);
                if(count($value)>0) {
                    $dynamicVariableId =  trim($key, "capturedvariablename_");
                    $dynamicValues="";
                    for ($c = 0; $c < count($value); $c++) {
                        $dynamicValues.= "'" . $value[$c] . "',";
                    }
                     $dynamicValues = trim($dynamicValues, ",");
                    $dynamicSearchData[$dynamicVariableId]=$dynamicValues;
                }
               //echo $dynamicValueList;
            }
           // echo $dynamicValueList;

            //new
            $posfrom = strpos($key, "capturedvariablenameFrom_");
            if ($posfrom !== false) {
                if ($value != "" && $value != null) {
                    $dynamicfromVariableId =  trim($key, "capturedvariablenameFrom_");

                    $rangeArray[$dynamicfromVariableId]["from"]=$value;                }
                }
            $posTo = strpos($key, "capturedvariablenameTo_");
            if ($posTo !== false) {
                if ($value != "" && $value != null) {
                    $dynamicToVariableId = trim($key, "capturedvariablenameTo_");

                    $rangeArray[$dynamicToVariableId]["to"]=$value;

                }
            }

            $posTextSearch = strpos($key, "capturedvariablenameTextSearch_");
            if ($posTextSearch !== false) {
                if ($value != "" && $value != null) {
                    $dynamicTextSearchVariableId = trim($key, "capturedvariablenameTextSearch_");

                    $rangeArray[$dynamicTextSearchVariableId]["textSearch"]=$value;

                }
            }



            //new
        }
       // print_r($dynamicSearchData);

       // print_r($rangeArray);
        $dynamicValueList = trim($dynamicValueList, ",");
        $dynamicVariableIdList = trim($dynamicVariableIdList, ",");
        $status = "";

        $searchUserId = "";
        $searchUserId = $this->input->get_post('searchUserId');
        if($getListFromPage == "View All My Ads"){
            $searchUserId = $this->session->userdata('userid');
        }
        $bookmarkArray = array();
        if($getListFromPage == "View My Bookmarked List"){
            $searchUserId = $this->session->userdata('userid');
        }
        $loggedUserId = $this->session->userdata('userid');
        $bookmarkArrayList = $this->users_model->getMyBookMarkList($loggedUserId);
        for ($n = 0; $n < count($bookmarkArrayList); $n++) {
            $bookmarkArray[$n] = $bookmarkArrayList[$n]['adsId'];
        }
        $dataheader['bookmarkArray'] = $bookmarkArray;

        $amountRange = $this->input->get_post('amountRange');
        $searchText = $this->input->get_post('searchText');
        $orderBy = $this->input->get_post('orderBy');
        $withphoto = $this->input->get_post('withphoto');

        $page = $this->input->get_post('page');
        $rec_limit = 5;
        $galleryStatus = "";
        $myLatitude = $this->input->get_post('myLatitude');
        $myLongitude = $this->input->get_post('myLongitude');
        $withOutadsId = "0";
        $paginationArray = $this->users_model->getadsList("", $categoryId, $subCategoryId, $itemId, $countryId, $stateId, $cityId, $status, $galleryStatus, $dynamicSearchData, $searchUserId, $getListFromPage,$rangeArray,$amountRange,$searchText,$withphoto,$myLatitude,$myLongitude, $orderBy,$withOutadsId, $page, $rec_limit);


        $isAmountRequired="";

        $categoryArray = $this->Backend_model->getCategoryList($categoryId, "");
        if (count($categoryArray) > 0) {
            $isAmountRequired = $categoryArray[0]['isAmountRequired'];
        }
        $dataheader['isAmountRequired'] = $isAmountRequired;

//        echo "<pre>";
//            print_r($paginationArray);
//        echo "</pre>";

        $left_rec = $paginationArray['left_rec'];
        $adsArray = $paginationArray['resultArrayData'];



        $dataheader['left_rec'] = $left_rec;
        $dataheader['page'] = $page;
        $dataheader['rec_limit'] = $rec_limit;

        $dataheader['getListFromPage'] = $getListFromPage;
        $dataheader['searchData'] = $adsArray;
        $dataheader['orderBy'] = $orderBy;
        $dataheader['withphoto'] = $withphoto;

        //$dataheader['encrypt'] = $this->encrypt;

        // print_r($searchData);
        // echo"ssss";
        $this->load->view('Frontend/searchAdsAjax', $dataheader);
//            echo "<pre>";
//            print_r($_REQUEST);
//            echo "</pre>";


        $msg = 'My secret message';
        //$key = 'aa';

        // echo $encrypted_string = $this->encrypt->encode($msg);
        //echo  $plaintext_string = $this->encrypt->decode($encrypted_string);
    }

    public function getStates()
    {
        $strArray = array("IN", "CH");
        $actionId = $this->input->get_post('actionId');
        $countryId = $this->input->get_post('countryId');
        $divId = $this->input->get_post('divId');
//		echo "getStates";
        $returnArray = array();
        if ($divId == "cityIdDiv") {
            $orderBy = " order by s.district ASC";
            $returnArray = $this->Backend_model->getDistrictList("", $countryId, $actionId, $orderBy);
        }

        if ($divId == "stateIdDiv") {
            $orderBy = " order by s.state ASC";
            $returnArray = $this->Backend_model->getStateList($actionId, $countryId, $orderBy);
        }

        echo json_encode($returnArray);
    }

    public function sendSMS()
    {
        $this->load->view('Frontend/sendSMS');
        echo "sendSMS";
    }

    function galleryUpload()
    {
        $data = array();
        if ($this->input->post('fileSubmit') && !empty($_FILES['userFiles']['name'])) {
            $filesCount = count($_FILES['userFiles']['name']);
            for ($i = 0; $i < $filesCount; $i++) {
                $_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];

                $uploadPath = 'uploads/files/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpeg|jpg|png';
                //$config['max_size']	= '100';
                //$config['max_width'] = '1024';
                //$config['max_height'] = '768';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('userFile')) {
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $uploadData[$i]['created'] = date("Y-m-d H:i:s");
                    $uploadData[$i]['modified'] = date("Y-m-d H:i:s");
                }
                echo $this->upload->display_errors();
            }
            if (!empty($uploadData)) {
                //Insert files data into the database
                $insert = $this->users_model->insert($uploadData);
                $statusMsg = $insert ? 'Files uploaded successfully.' : 'Some problem occurred, please try again.';
                $this->session->set_flashdata('statusMsg', $statusMsg);
            }
        }
        //get files data from database
        $data['files'] = $this->users_model->getRows();
        //pass the files data to view
        $this->load->view('Frontend/galleryUpload', $data);
    }

    public function  changePassword()
    {
        $sessionUserIdIsset = $this->session->has_userdata('userid');
        if ($sessionUserIdIsset != 1) {
            redirect(base_url() . "logout");
        }

        $dataheader['title'] = "Change Password";
        $output = $this->session->flashdata('output');
        $succesMsg = $this->Backend_model->getSuccessMsg($output);
        $dataheader['succesMsg'] = $succesMsg;
        $dataheader['updatePasswordUrl'] = base_url() . "updatePassword";

        $this->load->view('layout/Frontend_header', $dataheader);
        $this->load->view('Frontend/changePassword');
        $this->load->view('layout/Frontend_footer');
    }

    public function  updatePassword()
    {
        $sessionUserIdIsset = $this->session->has_userdata('userid');
        if ($sessionUserIdIsset != 1) {
            redirect(base_url() . "logout");
        }
        $successMsg = "Please try again later!";
        $output = array('status' => "2", 'message' => $successMsg);
        $userid = $this->session->userdata('userid');
        $userDataArray = $this->Backend_model->getUsersList($userid, "active", "", "", "", "", "");
        if (count($userDataArray) > 0) {
            $mobileNumber = $userDataArray[0]['mobile'];
            $fromIp = $userDataArray[0]['fromIp'];
            $createdAt = $userDataArray[0]['createdat'];
            $active = $userDataArray[0]['active'];
            $name = $userDataArray[0]['name'];
            $email = $userDataArray[0]['email'];
            $countryId = $userDataArray[0]['countryId'];
            $stateId = $userDataArray[0]['stateId'];
            $address = $userDataArray[0]['address'];
            $districtId = $userDataArray[0]['districtId'];

            $password = $this->input->get_post('newPassword');
            $rePassword = $this->input->get_post('rePassword');

            if ($password == $rePassword) {
                $profilePhotoName = "";
                $usersProfileArray = array('userid' => $userid, 'mobile' => $mobileNumber, 'password' => $password, 'name' => $name, 'email' => $email, 'countryId' => $countryId, 'stateId' => $stateId, 'districtId' => $districtId, 'address' => $address, 'active' => $active, 'fromIp' => $fromIp, 'createdAt' => $createdAt, 'profilePhotoName'=>$profilePhotoName);
                $this->users_model->updateFrontendUsers($usersProfileArray);
                $successMsg = "Your password was successfully updated!";
                $output = array('status' => "1", 'message' => $successMsg);
            } else {
                $successMsg = "You Entered Mis-matched Password!";
                $output = array('status' => "2", 'message' => $successMsg);
            }
        } else {
            $successMsg = "Invalid user account!";
            $output = array('status' => "2", 'message' => $successMsg);
        }

        //Password Update Start
        $createdAt = date("Y-m-d H:i:s");
        $fromIp = $this->Backend_model->getIpAddress();
        $action = 'Update';
        $description = "Response : ".$successMsg;
        $pageName = "Change Password";
        $pageUrl = 'updatePassword';
        $userid = $this->session->userdata('userid');
        $historyArray = array('actionId' => '0', 'description' => $description, 'action' => $action, 'userid' => $userid, 'active' => 'active', 'fromIp' => $fromIp, 'createdAt' => $createdAt, 'pageName' => $pageName, 'pageUrl' => $pageUrl);
        $this->users_model->insertHistory($historyArray);
        //Password Update End

        $this->session->set_flashdata('output', $output);
        redirect(base_url() . "changePassword");
    }

    public function  editMyProfile()
    {

        $sessionUserIdIsset = $this->session->has_userdata('userid');
        if ($sessionUserIdIsset != 1) {
            redirect(base_url() . "logout");
        }
        $dataheader['title'] = "Edit My Profile";
        $output = $this->session->flashdata('output');
        $succesMsg = $this->Backend_model->getSuccessMsg($output);
        $dataheader['succesMsg'] = $succesMsg;


        $userid = $this->session->userdata('userid');
        $orderBy = $start = $end = $stateId = $districtId = "";
        $activeStatus = "active";
        $userDataArray = $this->Backend_model->getUsersList($userid, $activeStatus, $orderBy, $start, $end, $stateId, $districtId);
        $dataheader['userDataArray'] = $userDataArray;
        $dataheader['updateMyProfileUrl'] = base_url() . "updateMyProfile";

        $actionId = "";
        $countryId = "";
        $orderBy = " order by s.state ASC";
        $stateArray = $this->Backend_model->getStateList($actionId, $countryId, $orderBy);
        $dataheader['stateArray'] = $stateArray;
        $dataheader['getCommonSelectBoxUrl'] = base_url() . "Backend/getCommonSelectBox";

        $this->load->view('layout/Frontend_header', $dataheader);
        $this->load->view('Frontend/editMyProfile');
        $this->load->view('layout/Frontend_footer');
    }

    public function  updateMyProfile()
    {
        $sessionUserIdIsset = $this->session->has_userdata('userid');
        if ($sessionUserIdIsset != 1) {
            redirect(base_url() . "logout");
        }
        $successMsg = "Please try again later!";
        $historyMsg = "";
        $output = array('status' => "2", 'message' => $successMsg);
        $userid = $this->session->userdata('userid');
        $userDataArray = $this->Backend_model->getUsersList($userid, "active", "", "", "", "", "");
        if (count($userDataArray) > 0) {
            $historyMsg = " Changes : ";
            $mobileNumber = $userDataArray[0]['mobile'];
            $password = $userDataArray[0]['password'];
            $fromIp = $userDataArray[0]['fromIp'];
            $createdAt = $userDataArray[0]['createdat'];
            $active = $userDataArray[0]['active'];

            $name = $this->input->get_post('name');
            $email = $this->input->get_post('email');
            $countryId = $this->input->get_post('countryId');
            $stateId = $this->input->get_post('stateId');
            $address = $this->input->get_post('address');
            $districtId = $this->input->get_post('districtId');

            // Upload Profile photo
            $selectedFileName = $_FILES['userFile']['name'];
            $selectedFileTempName = $_FILES['userFile']['tmp_name'];
            $userCode = $userDataArray[0]['userCode'];

            $profilePhotoName = "";
            if ($selectedFileName != "" && $selectedFileTempName != "") {

                $uploadPath = 'uploads/files/userprofiles/';
                $uploadPath = $uploadPath . $userCode;
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, TRUE);
                }
                $config['upload_path'] = $uploadPath;
                //$config['allowed_types'] = 'gif|jpg|png';
                $config['allowed_types'] = 'gif|jpeg|jpg|png';
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('userFile')) {
                    $fileData = $this->upload->data();
                    $profilePhotoName = $uploadData['file_name'] = $fileData['file_name'];
                    $historyMsg .= " Profile photo uploaded <a href='".base_url().$uploadPath."/".$profilePhotoName."'>".$profilePhotoName."</a>, ";
                    $uploadData['createdAt'] = date("Y-m-d H:i:s");
                    $uploadData['active'] = $active;
                    $uploadData['fromIp'] = $_SERVER['REMOTE_ADDR'];

                    $image_data = $fileData;
                    $config["manipulation"]['source_image'] = $image_data['full_path'];
                    $this->load->library('image_lib', $config["manipulation"]);
                    $config["manipulation"]['wm_text'] = '1stepshop.in';
                    $config["manipulation"]['wm_type'] = 'text';
                    $this->image_lib->initialize($config["manipulation"]);
                    $this->image_lib->watermark();

                } else {
                    $message = $this->upload->display_errors();
                    $status = "2";
                    $output = array('status' => $status, 'message' => $message);
                    $this->session->set_flashdata('output', $output);

                }
            }

            $usersProfileArray = array('userid' => $userid, 'mobile' => $mobileNumber, 'password' => $password, 'name' => $name, 'email' => $email, 'countryId' => $countryId, 'stateId' => $stateId, 'districtId' => $districtId, 'address' => $address, 'active' => $active, 'fromIp' => $fromIp, 'createdAt' => $createdAt, 'profilePhotoName'=>$profilePhotoName);
            $this->users_model->updateFrontendUsers($usersProfileArray);
            $successMsg = "Your Profile Successfully updated!";
            $output = array('status' => "1", 'message' => $successMsg);

            //Get history for user data changes
            if($name!=$userDataArray[0]['name']){
                $historyMsg .= " Name changed from ".$userDataArray[0]['name']. " to ".$name.", ";
            }
            if($email!=$userDataArray[0]['email']){
                $historyMsg .= " Email changed from ".$userDataArray[0]['email']. " to ".$email.", ";
            }
            if($address!=$userDataArray[0]['address']){
                $historyMsg .= " Address changed from ".$userDataArray[0]['address']. " to ".$address.", ";
            }
            if($stateId!=$userDataArray[0]['stateId']){

                $stateArray = $this->Backend_model->getStateList($stateId, '', '');
                $state = "";
                if(count($stateArray)){
                    $state = $stateArray[0]['state'];
                }
                $stateExistArray = $this->Backend_model->getStateList($userDataArray[0]['stateId'], '', '');
                $existstate = "";
                if(count($stateExistArray)){
                    $existstate = $stateExistArray[0]['state'];
                }
                $historyMsg .= " State changed from ".$existstate. " to ".$state.", ";
            }
            if($districtId!=$userDataArray[0]['districtId']){

                $cityArray = $this->Backend_model->getDistrictList($districtId, '', '');
                $city = "";
                if(count($cityArray)){
                    $city = $cityArray[0]['district'];
                }

                $cityExistArray = $this->Backend_model->getDistrictList($userDataArray[0]['districtId'], '', '');
                $existCity = "";
                if(count($cityExistArray)){
                    $existCity = $cityExistArray[0]['district'];
                }
                $historyMsg .= " City changed from ".$existCity. " to ".$city.", ";
            }
        }

        //History Management Start
        $createdAt = date("Y-m-d H:i:s");
        $fromIp = $this->Backend_model->getIpAddress();
        $action = 'Update';
        $description = "Response : ".$successMsg.", ". $historyMsg;
        $pageName = "Edit My Profile";
        $pageUrl = 'updateMyProfile';
        $userid = $this->session->userdata('userid');
        $historyArray = array('actionId' => '0', 'description' => $description, 'action' => $action, 'userid' => $userid, 'active' => 'active', 'fromIp' => $fromIp, 'createdAt' => $createdAt, 'pageName' => $pageName, 'pageUrl' => $pageUrl);
        $this->users_model->insertHistory($historyArray);
        //History Management End


        $this->session->set_flashdata('output', $output);
        redirect(base_url() . "editMyProfile");
    }

    public function viewAllMyAds()
    {
        $sessionUserIdIsset = $this->session->has_userdata('userid');
        if ($sessionUserIdIsset != 1) {
            redirect(base_url() . "logout");
        }

        $selectedAdsId = "1";
        $adsDetails = $this->users_model->getSingleAdsDetails($selectedAdsId);
        $dataheader['adsDetails'] = $adsDetails;
        $dataheader['title'] = "View All My Ads";
        $dtnamicAdsDetails = $this->users_model->getSingleAdsDynamicDetails($selectedAdsId);
        $dataheader['dynamicAdsDetails'] = $dtnamicAdsDetails;

        //History Management Start
        $createdAt = date("Y-m-d H:i:s");
        $fromIp = $this->Backend_model->getIpAddress();
        $action = 'View';
        $description = 'Screen View';
        $pageName = $dataheader['title'];
        $pageUrl = 'viewAllMyAds';
        $userid = $this->session->userdata('userid');
        $historyArray = array('actionId' => '0', 'description' => $description, 'action' => $action, 'userid' => $userid, 'active' => 'active', 'fromIp' => $fromIp, 'createdAt' => $createdAt, 'pageName' => $pageName, 'pageUrl' => $pageUrl);
        $this->users_model->insertHistory($historyArray);
        //History Management End


        $this->load->view('layout/Frontend_header', $dataheader);
        $this->load->view('Frontend/viewAllMyAds');
        $this->load->view('layout/Frontend_footer');


    }

    public function nearByYouAds()
    {

        $dataheader['title'] = "Near By You Ads";

        //History Management Start
        $createdAt = date("Y-m-d H:i:s");
        $fromIp = $this->Backend_model->getIpAddress();
        $action = 'View';
        $description = 'Near By you ads list Screen View';
        $pageName = $dataheader['title'];
        $pageUrl = 'nearByYouAds';
        $userid = $this->session->userdata('userid');
        $historyArray = array('actionId' => '0', 'description' => $description, 'action' => $action, 'userid' => $userid, 'active' => 'active', 'fromIp' => $fromIp, 'createdAt' => $createdAt, 'pageName' => $pageName, 'pageUrl' => $pageUrl);
        $this->users_model->insertHistory($historyArray);
        //History Management End


        $this->load->view('layout/Frontend_header', $dataheader);
        $this->load->view('Frontend/nearByYouAds');
        $this->load->view('layout/Frontend_footer');


    }

    public function viewHistory()
    {

        $dataheader['title'] = "View My History";

        //History Management Start
        /*$createdAt = date("Y-m-d H:i:s");
        $fromIp = $this->Backend_model->getIpAddress();
        $action = 'View';
        $description = 'History View';
        $pageName = $dataheader['title'];
        $pageUrl = 'viewHistory';
        $userid = $this->session->userdata('userid');
        $historyArray = array('actionId' => '0', 'description' => $description, 'action' => $action, 'userid' => $userid, 'active' => 'active', 'fromIp' => $fromIp, 'createdAt' => $createdAt, 'pageName' => $pageName, 'pageUrl' => $pageUrl);
        $this->users_model->insertHistory($historyArray);*/
        //History Management End

        $this->load->view('layout/Frontend_header', $dataheader);
        $this->load->view('layout/frontEndDataTable');
        $this->load->view('Frontend/viewHistory');
        $this->load->view('layout/Frontend_footer');
    }

    public function viewBookmarked()
    {

        $dataheader['title'] = "View My Bookmarked List";

        //History Management Start
        $createdAt = date("Y-m-d H:i:s");
        $fromIp = $this->Backend_model->getIpAddress();
        $action = 'View';
        $description = 'Bookmark View';
        $pageName = $dataheader['title'];
        $pageUrl = 'viewBookmarked';
        $userid = $this->session->userdata('userid');
        $historyArray = array('actionId' => '0', 'description' => $description, 'action' => $action, 'userid' => $userid, 'active' => 'active', 'fromIp' => $fromIp, 'createdAt' => $createdAt, 'pageName' => $pageName, 'pageUrl' => $pageUrl);
        $this->users_model->insertHistory($historyArray);
        //History Management End

        $this->load->view('layout/Frontend_header', $dataheader);
        $this->load->view('Frontend/viewBookmarked');
        $this->load->view('layout/Frontend_footer');
    }

    public function addToMyBookmark(){

        $userid = $this->session->userdata('userid');
        $createdAt = date("Y-m-d H:i:s");
        $fromIp = $this->Backend_model->getIpAddress();
        $adsId = $this->input->get_post('adsId');
        $action = $this->input->get_post('action');

//sa1
        $adsArrayPaginationList = $this->users_model->getadsList($adsId, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");
        $adsArray = $adsArrayPaginationList['resultArrayData'];
        if(count($adsArray)>0){
            $adsCode = $adsArray[0]['adsCode'];
        }

        if($action == "add"){
            $adsBookmarkArray = array('adsId' => $adsId, 'userId' => $userid, 'active' => 'active', 'fromIp' => $fromIp, 'createdAt' => $createdAt);
            $this->users_model->insertAdsBookmark($adsBookmarkArray);
            //echo "<span class='updateMsg'><span class='glyphicon glyphicon-star'></span> Bookmark added!</span>";
            echo '<a href="javascript:void(0)" onclick="addToBookMark('.$adsId.',\'remove\')" class="updateMsg" ><span class="glyphicon glyphicon-star"></span> Remove from Bookmark</a>';

            $description = 'Bookmark Added : Ads - <a href="'.base_url().'singleItem/'.$adsId.'">'.$adsCode.'</a>';
        } else if($action == "remove"){
            $adsBookmarkArray = array('adsId' => $adsId, 'userId' => $userid, 'active' => 'removed', 'fromIp' => $fromIp, 'createdAt' => $createdAt);
            $this->users_model->deleteAdsBookmark($adsBookmarkArray);
//            echo "<span class='updateMsg'><span class='glyphicon glyphicon-star'></span> Bookmark added!</span>";
            echo '<a href="javascript:void(0)" onclick="addToBookMark('.$adsId.',\'add\')" ><span class="glyphicon glyphicon-star"></span> Add to Bookmark</a>';

            $description = 'Bookmark Removed : Ads - <a href="'.base_url().'singleItem/'.$adsId.'">'.$adsCode.'</a>';

        }

        //History Management Start
        $createdAt = date("Y-m-d H:i:s");
        $fromIp = $this->Backend_model->getIpAddress();
        $pageName = "Add Bookmark";
        $pageUrl = 'addToMyBookmark';
        $userid = $this->session->userdata('userid');
        $historyArray = array('actionId' => '0', 'description' => $description, 'action' => $action, 'userid' => $userid, 'active' => 'active', 'fromIp' => $fromIp, 'createdAt' => $createdAt, 'pageName' => $pageName, 'pageUrl' => $pageUrl);
        $this->users_model->insertHistory($historyArray);
        //History Management End

    }

    public function getHistoryList(){

//        $rec_limit = $this->input->get_post('rec_limit');;
        $rec_limit = 100;
        $page = $this->input->get_post('page');
        $userid = $this->session->userdata('userid');

        $paginationArray = $this->users_model->getAllUsersHistory($userid, 'active', $page, $rec_limit);
        $left_rec = $paginationArray['left_rec'];
        $historyArray = $paginationArray['resultArrayData'];
        $rec_limit = $paginationArray['rec_limit'];

        $dataheader['historyArray'] = $historyArray;
        $dataheader['left_rec'] = $left_rec;
        $dataheader['page'] = $page;
        $dataheader['rec_limit'] = $rec_limit;

        $this->load->view('Frontend/getHistoryList', $dataheader);
    }

    public function samplevalidation(){
        $this->load->view('layout/samplevalidation');
    }
    public function updateReportAboutAds()
    {
        $dataheader['title'] = "Report about ads";
        $dataheader['loginPostUrl'] = "Report about ads";
        $actionId="";
        $adsReportingArray = $this->Backend_model->getReportingList($actionId);
        $dataheader['adsReportingArray'] = $adsReportingArray;
        $report = $this->input->get_post('report');
        $adsId = $this->input->get_post('adsId');
        $dataheader['adsId'] = $adsId;
        if($report=="Report")
        {
            $fromIp = $this->Backend_model->getIpAddress();
            $sessionUserIdIsset = $this->session->has_userdata('userid');
            $userid = "";
            if ($sessionUserIdIsset == 1) {
                $userid = $this->session->userdata('userid');
            }
            $reportingId =$this->input->get_post('adsreport');
            //$adsId = $this->session->userdata('adsId');
            $description = $this->input->get_post('description');
            $this->users_model->updateReportAboutAds($reportingId,$adsId,$fromIp,$description,$userid);
            echo  "successfully update your report";

        }
        else{
            $this->load->view('Frontend/updateReportAboutAds', $dataheader);

        }



    }

    //Dummy pages
    public function editMyAds($adsId){

        $orderBy = " order by s.state ASC";
        $stateArray = $this->Backend_model->getStateList("0", "1", $orderBy);

        $output = $this->session->flashdata('output');
        $succesMsg = $this->users_model->getSuccessMsg($output);
        $dataheader['succesMsg'] = $succesMsg;

        $orderBy = " order by orders Asc";
        $categoryArray = $this->Backend_model->getCategoryList("", $orderBy);
        $dataheader['categoryArray'] = $categoryArray;
        $dataheader['stateArray'] = $stateArray;
        $dataheader['editAdsId'] = $adsId;
        $dataheader['getCommonJsonDataUrl'] = base_url() . "Frontend/getCommonJsonData";


        $adsId = $this->users_model->encryptor('decrypt',$adsId);
        //Get My ads
        $paginationArray = $this->users_model->getadsList($adsId, "", "", "", "", "", "", "", "", "", "", "", "","","","","","","","","", 1);
        $editAdsArray = $paginationArray['resultArrayData'];
        $dataheader['editAdsArray'] = $editAdsArray;

        $adsgalleryDetails = $this->users_model->getAdsGallery($adsId, "");
        $dataheader['adsgalleryDetails'] = $adsgalleryDetails;


        $dataheader['title'] = "Edit My Ads";
        $this->load->view('layout/Frontend_header', $dataheader);
        $this->load->view('Frontend/editMyAds');
        $this->load->view('layout/Frontend_footer');
    }

    public function updateAdPost(){
        $editAdsId =$this->input->get_post('editAdsId');
        $adsId = $this->users_model->encryptor('decrypt', $editAdsId);

        if($adsId>0){
            $postedAdsArray = $_REQUEST;
            $this->users_model->updateFreeAdPost($adsId, $editAdsId, $postedAdsArray);
        }
   }

    public function howitworks(){
        $dataheader['title'] = "How it works";
        $this->load->view('layout/Frontend_header', $dataheader);
        echo "<div class='banner container'>Under construction...</div>";
        $this->load->view('layout/Frontend_footer');
    }
    public function faq(){
        $dataheader['title'] = "FAQ";
        $this->load->view('layout/Frontend_header', $dataheader);
        echo "<div class='banner container'>Under construction...</div>";
        $this->load->view('layout/Frontend_footer');
    }
    public function feedback(){
        $dataheader['title'] = "Feedback";
        $this->load->view('layout/Frontend_header', $dataheader);
        echo "<div class='banner container'>Under construction...</div>";
        $this->load->view('layout/Frontend_footer');
    }
    public function locatinsMap(){
        $dataheader['title'] = "Locations Map";
        $this->load->view('layout/Frontend_header', $dataheader);
        echo "<div class='banner container'>Under construction...</div>";
        $this->load->view('layout/Frontend_footer');
    }
    public function terms(){
        $dataheader['title'] = "Terms";
        $this->load->view('layout/Frontend_header', $dataheader);
        $this->load->view('Frontend/terms');
//        echo "<div class='banner container'>Under construction...</div>";
        $this->load->view('layout/Frontend_footer');
    }
    public function privacy(){
        $dataheader['title'] = "Privacy";
        $this->load->view('layout/Frontend_header', $dataheader);
        $this->load->view('Frontend/privacy');
        $this->load->view('layout/Frontend_footer');
    }
    public function typography(){
        $dataheader['title'] = "short codes";
        $this->load->view('layout/Frontend_header', $dataheader);
        echo "<div class='banner container'>Under construction...</div>";
        $this->load->view('layout/Frontend_footer');
    }
    public function popularSearch(){
        $dataheader['title'] = "Popular Search";
        $this->load->view('layout/Frontend_header', $dataheader);
        echo "<div class='banner container'>Under construction...</div>";
        $this->load->view('layout/Frontend_footer');
    }
    public function sitemap(){
        $dataheader['title'] = "Site Map";
        $this->load->view('layout/Frontend_header', $dataheader);
        echo "<div class='banner container'>Under construction...</div>";
        $this->load->view('layout/Frontend_footer');
    }
    public function updateAdsStatus()
    {
        $adsId = $this->input->get_post('adsId');
        $adsStatus = $this->input->get_post('actionStatus');


        if($adsStatus!="" && $adsId!="" ) {

            $adsPaginationArray = $this->users_model->getadsList($adsId, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");
            $adsArray = $adsPaginationArray['resultArrayData'];
            if (count($adsArray) > 0) {
                $adsexistActive = $adsArray[0]['active'];
                if ($adsexistActive == "active" || $adsexistActive == "deactive") {

                    $adsUpdateSql = "UPDATE `tbl_ads` SET `active`='" . $adsStatus . "' WHERE `adsId` = " . $adsId;
                    $this->Backend_model->runUpdateQuery($adsUpdateSql);
                    $title = "update ads status";
                    if ($adsStatus == "active") {
                        $description = "ads(" . $adsId . ") status update  form deactive to active";
                        echo '<a href="javascript:void(0)" onclick="updateactivefun(' . $adsId . ',\'deactive\')" class="btn btn-info">Deactive</a>';


                    } else if ($adsStatus == "deactive") {
                        $description = "ads(" . $adsId . ") status update  form active to deactive";

                        echo '<a href="javascript:void(0)" onclick="updateactivefun(' . $adsId . ',\'active\')" class="btn btn-info">Active</a>';
                    }


                    //History Management Start
                    $createdAt = date("Y-m-d H:i:s");
                    $fromIp = $this->Backend_model->getIpAddress();
                    $pageName = "update ads Status";
                    $pageUrl = 'updateAdsStatus';
                    $userid = $this->session->userdata('userid');
                    $historyArray = array('actionId' => '0', 'description' => $description, 'action' => $title, 'userid' => $userid, 'active' => 'active', 'fromIp' => $fromIp, 'createdAt' => $createdAt, 'pageName' => $pageName, 'pageUrl' => $pageUrl);
                    $this->users_model->insertHistory($historyArray);
                    //History Management End
                }
            }
        }
    }

    public function adPost(){

        $sessionUserIdIsset = $this->session->has_userdata('userid');

        $output = $this->session->flashdata('output');
        $succesMsg = $this->users_model->getSuccessMsg($output);
        $dataheader['userid'] = "";
        $dataheader['succesMsg'] = $succesMsg;
        $dataheader['title'] = "Post an Ad";

        $orderBy = " order by s.state ASC";
        $stateArray = $this->Backend_model->getStateList("0", "1", $orderBy);

        $actionId = "";
        $orderBy = " order by orders Asc";
        $categoryArray = $this->Backend_model->getCategoryList($actionId, $orderBy);
        $dataheader['categoryArray'] = $categoryArray;
        $dataheader['stateArray'] = $stateArray;
        $dataheader['getCommonJsonDataUrl'] = base_url() . "Frontend/getCommonJsonData";

        $this->load->view('layout/Frontend_header', $dataheader);
        $this->load->view('Frontend/Migration_posting');
        $this->load->view('layout/Frontend_footer');

    }

    public function createBackendAdPost(){

        $userid = 0;
        $userCode = "";
        $mobileNumber = $this->input->get_post('mobileNumber');
        print_r($_POST);
        if ($mobileNumber > 0) {

            $password = "Welcome123";
            $name = $this->input->get_post('name');
            $email = $this->input->get_post('email');

            $stateId = $this->input->get_post('stateId');
            $districtId = $this->input->get_post('districtId');
            if($districtId == null)
            $districtId = $this->input->get_post('cityId');
            $address = $this->input->get_post('address');
            $countryId = "1";
            $fromIp = $_SERVER['SERVER_ADDR'];
            $newdate = new DateTime("now");
            $createdAt = date_format($newdate, "Y-m-d H:i:s");
            $usersProfileArray = array('mobile' => $mobileNumber, 'username'=> $mobileNumber, 'password' => $password, 'userpassword' => $password, 'name' => $name, 'email' => $email, 'countryId' => $countryId, 'stateId' => $stateId, 'districtId' => $districtId, 'address' => $address, 'active' => 'InActive', 'fromIp' => $fromIp, 'createdAt' => $createdAt);
            $userCreatedArray = $this->users_model->createFrontendUsersProfileForMigrationWithoutOTP($usersProfileArray);

            $userid = $userCreatedArray['userId'];
            $userCode = $userCreatedArray['userCode'];


            $adsTitle = $this->input->get_post('adsTitle');
            $description = $this->input->get_post('description');
            $noOfDaysToActive = $this->input->get_post('noOfDaysToActive');
            $startDate = $this->input->get_post('startDate');
            $categoryId = $this->input->get_post('categoryId');
            $subCategoryId = $this->input->get_post('subCategoryId');
            $subCategoryId = $this->input->get_post('subCategoryId');
            $itemId = $this->input->get_post('itemId');
            $stateId = $this->input->get_post('stateId');
            $cityId = $this->input->get_post('cityId');

            $latitude = $this->input->get_post('latitude');
            $longitude = $this->input->get_post('longitude');

            $address = $this->input->get_post('address');
            $actualPrice = $this->input->get_post('actualPrice');
            $offerPrice = $this->input->get_post('offerPrice');

            if($offerPrice <= 0 || $offerPrice=="")
            {
                $offerPrice= $actualPrice;
            }



            $historyMsg = "";
            if ($adsTitle != "" && $userid > 0 && $categoryId > 0) {
                $active = "Waiting";
                $fromIp = $_SERVER['SERVER_ADDR'];
                $newdate = new DateTime("now");
                $createdAt = date_format($newdate, "Y-m-d H:i:s");

                if ($startDate == "" || $startDate == null || $startDate == "0000-00-00") {
                    $startDate = $createdAt;
                }

                if ($noOfDaysToActive == "" || $noOfDaysToActive == null || $noOfDaysToActive == "0") {
                    $noOfDaysToActive = 30;
                }

                $endDate = date("Y-m-d H:i:s", strtotime("+" . $noOfDaysToActive . "days", strtotime($startDate)));

                $countryId = 1;
//                $stateId=31;
//                $cityId = 516;
                $returnAdsCreatedArray = $this->users_model->createFreeAdPost($adsTitle, $description, $noOfDaysToActive, $startDate, $endDate, $categoryId, $subCategoryId, $itemId, $countryId, $stateId, $cityId, $address, $userid, $active, $fromIp, $createdAt,$actualPrice,$offerPrice, $latitude, $longitude);
                $adsId = 0;
                $adsCode =0;
                if($returnAdsCreatedArray!=null){
                    $adsId = $returnAdsCreatedArray['adsId'];
                    $adsCode = $returnAdsCreatedArray['adsCode'];
                }
                $historyMsg .= "Ads Title : ".$adsTitle." was created At ".$createdAt;
                $tblAdsExtrasArray = array();
                $dynamicFieldsforAdPostArray = $this->Backend_model->getDynamicFieldsforAdPost("0", $categoryId, $subCategoryId);

//            echo "<pre>";
//            print_r($_REQUEST);
//            echo "</pre>";

//            echo "<pre>";
//            print_r($dynamicFieldsforAdPostArray);
//            echo "</pre>";
                for ($i = 0; $i < count($dynamicFieldsforAdPostArray); $i++) {

                    $capturedVariableId = $dynamicFieldsforAdPostArray[$i]['capturedVariableId'];
                    $dynamicInputType = $dynamicFieldsforAdPostArray[$i]['dynamicInputType'];
                    $postKey = 'capturedvariablename_' . $capturedVariableId;
                    $requestArray = $_REQUEST;
                    if (array_key_exists($postKey, $requestArray)) {
                        $capturedVariableValue = $requestArray[$postKey];
                        if ($dynamicInputType != "Check Box") {
                            $tblAdsExtrasArray['adsId'] = $adsId;
                            $tblAdsExtrasArray['capturedVariableId'] = $capturedVariableId;
                            $tblAdsExtrasArray['capturedVariableValue'] = $capturedVariableValue;
                            $this->users_model->insertIntoTblAdsExtras($tblAdsExtrasArray);

                        } else {
                            $tblAdsExtrasArray['adsId'] = $adsId;
                            $tblAdsExtrasArray['capturedVariableId'] = $capturedVariableId;
                            for ($n = 0; $n < count($capturedVariableValue); $n++) {
                                $capturedVariableValueStr = $capturedVariableValue[$n];
                                $tblAdsExtrasArray['capturedVariableValue'] = $capturedVariableValueStr;
                                $this->users_model->insertIntoTblAdsExtras($tblAdsExtrasArray);
                            }
                        }
                    }
                }
                $postGalleryArray = $_FILES;
//            echo "<pre>";
//            print_r($postGalleryArray);
//            echo "</pre>";
                //It uplad gallery files
                $historyMsg .= $this->users_model->uploadMyGalleryFiles($adsId, $userCode, $adsCode, $active, $userid, $historyMsg, "Add");

                $successMsg = "Thank you for posting ad it will be activated within an hour";
                $output = array('status' => "1", 'message' => $successMsg);
                $this->session->set_flashdata('output', $output);
            } else {
                $successMsg =  "Invalid Data";
                $output = array('status' => "2", 'message' => $successMsg );
                $this->session->set_flashdata('output', $output);
            }

            //History Update Start
            $createdAt = date("Y-m-d H:i:s");
            $fromIp = $this->Backend_model->getIpAddress();
            $action = 'Add';
            $description = "Response : ".$successMsg.", Description : ".$historyMsg ;
            $pageName = "Ad Post";
            $pageUrl = 'posting';
            $historyArray = array('actionId' => '0', 'description' => $description, 'action' => $action, 'userid' => $userid, 'active' => 'active', 'fromIp' => $fromIp, 'createdAt' => $createdAt, 'pageName' => $pageName, 'pageUrl' => $pageUrl);
            $this->users_model->insertHistory($historyArray);
            //History Update End
//        redirect(base_url() . "posting");
        }
    }

}
