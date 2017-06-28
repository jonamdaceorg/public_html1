<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller
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
        $this->load->model('Backend_model');
        $this->load->model('users_model');
        $this->load->library('session');
    }

    public function index()
    {
        $output = $this->session->flashdata('output');
        $succesMsg = $this->Backend_model->getSuccessMsg($output);

        $dataheader['succesMsg'] = $succesMsg;
        $dataheader['title'] = "Login";
        $dataheader['loginPostUrl'] = "index.php/checkLogin";

//		$this->load->view('layout/Backend_header', $dataheader);
//		$this->load->view('Backend/Backend_index');
//		$this->load->view('layout/Backend_footer');
    }

    public function manage()
    {
        $output = $this->session->flashdata('output');
        $succesMsg = $this->Backend_model->getSuccessMsg($output);

        $dataheader['succesMsg'] = $succesMsg;
        $dataheader['title'] = "Login";
        $dataheader['loginPostUrl'] = base_url() . "checkLogin";

        $this->load->view('layout/Backend_login_header', $dataheader);
        $this->load->view('Backend/Backend_index');
        $this->load->view('layout/Backend_login_footer');
    }

    public function checkLogin()
    {
        $username = $this->input->post('userName');
        $userpassword = $this->input->post('password');

        $userCredentialArray = array('username' => $username, 'userpassword' => $userpassword);
        $userCredential = $this->Backend_model->checkUserCredential($userCredentialArray);
        if (count($userCredential) > 0) {

            $this->session->set_userdata($userCredential);
            $this->Backend_model->updateLastlogin($userCredential['adminid']);

            redirect(base_url() . $userCredential['redirecturl']);
        } else {
            $output = array('status' => "2", 'message' => "Invalid Login!!");
            $this->session->set_flashdata('output', $output);
            redirect(base_url() . "Backend/manage");
        }
    }

    public function logout()
    {
//        $this->session->sess_destroy();
        $userListArray = array('adminid', 'name', 'email', 'usertypeid', 'adminid', 'mobile', 'lastlogin', 'redirecturl', 'usertype');
        $this->session->unset_userdata($userListArray);
        $output = array('status' => "1", 'message' => "Successfully logout !!!");
        $this->session->set_flashdata('output', $output);
        redirect(base_url() . "Backend/manage");
    }

    public function editProfile()
    {
        $output = $this->session->flashdata('output');
        $succesMsg = $this->Backend_model->getSuccessMsg($output);

        $dataheader['succesMsg'] = $succesMsg;
        $dataheader['title'] = "Edit Profile";
        $dataheader['loginPostUrl'] = "index.php/checkLogin";
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        $sessionUserTypeId = 0;
        $adminid = 0;
        if($sessionUserTypeIdIsset == 1) {
            $sessionUserTypeId = $this->session->userdata('usertypeid');
            $adminid = $this->session->userdata('adminid');
        }
        $dataheader['usertypeid'] = $sessionUserTypeId;
        $dataheader['adminid'] = $adminid;

        $dataheader['AddOrEditMasterContent'] = base_url() . "Backend/AddOrEditMasterContent";

        $this->load->view('layout/Backend_header', $dataheader);
        $this->load->view('layout/Backend_menu');
        $this->load->view('Backend/editProfile');
        $this->load->view('layout/Backend_footer');
    }

    public function forgotPassword()
    {
        $dataheader['title'] = "Forgot Password";
        $sendOTP = $this->input->get_post('sendOTP');
        $otptext = $this->input->get_post('otptext');
        $emailId = $this->input->get_post('emailId');
        $newPassword = $this->input->get_post('newPassword');
        $dataheader['sendOTP'] = $sendOTP;
        if ($sendOTP == 1 && $emailId != "") {
            $tomailIdArray = array($emailId);
            $otp = $this->Backend_model->insertAndReturnOTP($emailId);
            if ($otp != "") {
                $message = "<b>Dear User</b>, <br><br>Your One Time Password (OTP) for resetting the password for your <a href='http://www.jonam.in'>jonam.in</a> profile is <b>" . $otp . "</b><br><br>";
                $message = $message . "Please enter this code in the OTP code box listed on the page.<br><br>";
                $message = $message . "<b>Note: </b> Please note that this will be valid for the next 2 hours only.<br><br>";
                $message = $message . "Contact: support@jonam.in if you are unable to reset.<br><br><br>Regards,<br>jonam.in Team";
                $subject = "Your OTP for resetting password";
                $sendResponse = $this->Backend_model->sendEmail(null, null, $tomailIdArray, $subject, $message);
//                $sendResponse  = 1;
                if ($sendResponse == 1) {
                    $output = array("message" => "Please check your registered e-mail for OTP", "status" => "1");
                    $sendResponseMessage = $this->Backend_model->getSuccessMsg($output);
                } else {
                    $output = array("message" => "Please check your Internet connection", "status" => "2");
                    $sendResponseMessage = $this->Backend_model->getSuccessMsg($output);
                }
                $dataheader['sendResponseMessage'] = $sendResponseMessage;
                $dataheader['emailId'] = $emailId;
                $this->load->view('layout/Backend_header', $dataheader);
                $this->load->view('Backend/forgotPassword');
                $this->load->view('layout/Backend_footer');
            } else {
                $output = array("message" => "Invalid login details", "status" => "2");
                $this->session->set_flashdata('output', $output);
                redirect(base_url());
            }
        } else if ($sendOTP == 2) {
            if ($otptext != "" && $newPassword != "") {
                $email = $this->input->get_post('email');
                $resultArray = $this->Backend_model->getSuccessMsgOTPUpdated($email, $otptext);
                $successOTPUpdated = $resultArray['successMsg'];
                $adminid = $resultArray['adminid'];
                if ($otptext != "" && $email != "" && $successOTPUpdated == "1") {
                    $this->Backend_model->updateUsersPassword($adminid, $newPassword);
                    $output = array('status' => "1", 'message' => "Your Password Successfully updated! <br/>Please login again");
                    $this->session->set_flashdata('output', $output);
                } else {
                    $output = array('status' => "2", 'message' => "Incorrect OTP Details");
                    $this->session->set_flashdata('output', $output);
                }
                redirect(base_url());
            }
        } else {
            $this->load->view('Backend/forgotPassword', $dataheader);
        }
    }

    public function dashboard()
    {
        $dataheader['title'] = "Login";
        $this->load->view('layout/Backend_header', $dataheader);
        $this->load->view('layout/Backend_menu');
//        $this->load->view('Backend/Backend_dashboard');
        $this->load->view('layout/Backend_footer');
    }

    public function getMastersList()
    {
        $dataheader['title'] = "Master List";
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        if ($sessionUserTypeIdIsset != 1) {
            redirect(base_url() . "Backend/logout");
        }
        $title = $this->input->get_post("title");
        $actionId = $this->input->get_post("actionId");
        $getGenerateExcel = $this->input->get_post("getGenerateExcel");


        $categoryArray = array();
        $subCategoryArray = array();
        $itemArray = array();
        $countryArray = array();
        $stateArray = array();
        $districtArray = array();
        $subDistrictArray = array();
        $adsReportingArray = array();
        $membershipPackageArray = array();
        $dynamicAdsVariableArray = array();
        $dynamicInputMasterArray = array();
        $dynamicInputValueArray = array();
        $adsArray = array();

        $contactUsArray = array();

        if ($title == "Contact Us Master") {
            $orderBy = " order by id DESC";
            $contactUsArray = $this->Backend_model->getContactUsList($actionId, $orderBy);
        } else if ($title == "Category Master") {
            $orderBy = " order by orders ASC";
            $categoryArray = $this->Backend_model->getCategoryList($actionId, $orderBy);
        } else if ($title == "Sub Category Master") {
            $categoryId = "0";
            $orderBy = " order by s.subCategory ASC";
            $subCategoryArray = $this->Backend_model->getSubCategoryList($actionId, $categoryId,$orderBy);
        } else if ($title == "Item Master") {
            $categoryId = "0";
            $subCategoryId = "0";
            $itemArray = $this->Backend_model->getItemList($actionId, $categoryId, $subCategoryId);
        } else if ($title == "Country Master") {
            $countryArray = $this->Backend_model->getCountryList($actionId);
        } else if ($title == "State Master") {
            $countryId = "0";

            $orderBy = " order by s.state ASC";
            $stateArray = $this->Backend_model->getStateList($actionId, $countryId, $orderBy);
        } else if ($title == "District Master") {
            $countryId = "0";
            $stateId = "0";
            $orderBy = " order by s.district ASC";
            $districtArray = $this->Backend_model->getDistrictList($actionId, $countryId, $stateId, $orderBy);
        }  else if ($title == "Sub District Master") {
            $countryId = "0";
            $stateId = "0";
            $districtId = "0";
            $subDistrictArray = $this->Backend_model->getSubDistrictList($actionId, $countryId, $stateId, $districtId);
        } else if ($title == "Reporting Master") {
            $adsReportingArray = $this->Backend_model->getReportingList($actionId);
        } else if ($title == "Membership Package Master") {
            $membershipPackageArray = $this->Backend_model->getMembershipPackageList($actionId);
        } else if ($title == "Dynamic Fields") {
            $categoryId = $this->input->get_post("searchCategoryId");;
            $subCategoryId = $this->input->get_post("searchSubCategoryId");;

            $dynamicAdsVariableArray = $this->Backend_model->getDynamicAdsVariableList($actionId, $categoryId, $subCategoryId);
        } else if ($title == "Dynamic Input") {
            $dynamicInputType = $this->input->get_post("dynamicInputType");
            $dynamicInputMasterArray = $this->Backend_model->getDynamicInputMasterList("0", $dynamicInputType);
        } else if ($title == "Dynamic Input Value") {
            $dynamicInputValueArray = $this->Backend_model->getDynamicInputValueList( "0", "0");
        }  else if ($title == "Ads") {
            $categoryId = $this->input->get_post("searchCategoryId");;
            $subCategoryId = $this->input->get_post("subCategoryId");;
            $itemId = $this->input->get_post("itemId");;
            $countryId =$this->input->get_post("countryId");;
            $stateId = $this->input->get_post("stateId");;
            $cityId = $this->input->get_post("cityId");;
            $status = $this->input->get_post("activeStatus");;
            $searchUserId = "";
            $getListFromPage = "adsMaster";
            $dynamicVariableIdList = array();
            $dynamicSearchData = array();
            $amountRange = $this->input->get_post('amountRange');
            $searchText = $this->input->get_post('searchText');
            $orderBy = $this->input->get_post('orderBy');
            $withphoto = $this->input->get_post('withphoto');

            $page = $this->input->get_post('page');
            $rec_limit = 100;
            $rangeArray =array();
            $galleryStatus = "";
            $myLatitude = "0";
            $myLongitude = "0";
            $withOutadsId = "0";//s3
            $adsPaginationArray = $this->users_model->getadsList("", $categoryId, $subCategoryId, $itemId, $countryId, $stateId, $cityId, $status, $galleryStatus, $dynamicSearchData, $searchUserId, $getListFromPage, $rangeArray,$amountRange,$searchText,$withphoto,$myLatitude,$myLongitude, $orderBy, $withOutadsId, $page, $rec_limit);

            $rec_limit = $adsPaginationArray['rec_limit'];
            $left_rec = $adsPaginationArray['left_rec'];
            $adsArray = $adsPaginationArray['resultArrayData'];
            $page = $adsPaginationArray['page'];


            $dataheader['page'] = $page;
            $dataheader['left_rec'] = $left_rec;
            $dataheader['rec_limit'] = $rec_limit;
        }



        $dataheader['deletUrl'] = base_url() . "Backend/insertOrUpdateMaster";
        $dataheader['AddOrEditMasterContent'] = base_url() . "Backend/AddOrEditMasterContent";


        $dataheader['getGenerateExcel'] = $getGenerateExcel;
        $dataheader['categoryArray'] = $categoryArray;
        $dataheader['countryArray'] = $countryArray;
        $dataheader['stateArray'] = $stateArray;
        $dataheader['districtArray'] = $districtArray;
        $dataheader['subDistrictArray'] = $subDistrictArray;
        $dataheader['adsReportingArray'] = $adsReportingArray;
        $dataheader['membershipPackageArray'] = $membershipPackageArray;
        $dataheader['dynamicAdsVariableArray'] = $dynamicAdsVariableArray;
        $dataheader['dynamicInputMasterArray'] = $dynamicInputMasterArray;
        $dataheader['dynamicInputValueArray'] = $dynamicInputValueArray;
        $dataheader['adsArray'] = $adsArray;
        $dataheader['contactUsArray'] = $contactUsArray;


        $dataheader['subCategoryArray'] = $subCategoryArray;
        $dataheader['itemArray'] = $itemArray;
        $dataheader['title'] = $title;

        $this->load->view('Backend/getMastersList', $dataheader);
    }

    public function categoryMaster()
    {
        $dataheader['title'] = "Category Master";
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        if ($sessionUserTypeIdIsset != 1) {
            redirect(base_url() . "Backend/logout");
        }

        $dataheader['getMastersListUrl'] = base_url() . "Backend/getMastersList";

        $this->load->view('layout/Backend_header', $dataheader);
        $this->load->view('layout/Backend_menu');
        $this->load->view('Backend/categoryMaster');
        $this->load->view('layout/Backend_footer');
    }

    public function reportingMaster()
    {
        $dataheader['title'] = "Reporting Master";
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        if ($sessionUserTypeIdIsset != 1) {
            redirect(base_url() . "Backend/logout");
        }

        $dataheader['getMastersListUrl'] = base_url() . "Backend/getMastersList";

        $this->load->view('layout/Backend_header', $dataheader);
        $this->load->view('layout/Backend_menu');
        $this->load->view('Backend/categoryMaster');
        $this->load->view('layout/Backend_footer');
    }

    public function AddOrEditMasterContent()
    {
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        if ($sessionUserTypeIdIsset != 1) {
            redirect(base_url() . "Backend/logout");
        }

        $title = $this->input->get_post("title");
        $actionId = $this->input->get_post("actionId");
        $actionType = $this->input->get_post("actionType");
        $categoryArray = array();
        $subCategoryArray = array();
        $itemArray = array();
        $countryArray = array();
        $stateArray = array();
        $districtArray = array();
        $subDistrictArray = array();
        $adsReportingArray = array();
        $dynamicSelectBoxList = array();
        $dynamicSelectBoxValueList = array();

        if ($title == "Category Master") {
            if ($actionType == "Edit") {
                $orderBy = " order by orders Asc";
                $categoryArray = $this->Backend_model->getCategoryList($actionId, $orderBy);
            }
        }

        if ($title == "Sub Category Master") {
            $orderBy = " order by categoryId DESC";
            $categoryArray = $this->Backend_model->getCategoryList("0", $orderBy);
            if ($actionType == "Edit") {
                $orderBy = " order by s.subCategoryId DESC";
                $subCategoryArray = $this->Backend_model->getSubCategoryList($actionId, "0", $orderBy);
            }
        }

        if ($title == "Item Master") {
            $orderBy = " order by category Asc";
            $categoryArray = $this->Backend_model->getCategoryList("0", $orderBy);
            $categoryId = "0";
            if ($actionType == "Edit") {
                $itemArray = $this->Backend_model->getItemList($actionId, "0", "0");
                if(count($itemArray)>0){
                    $categoryId =  $itemArray[0]['categoryId'];
                }
                $orderBy = " order by s.subCategory DESC";
                $subCategoryArray = $this->Backend_model->getSubCategoryList("0", $categoryId, $orderBy);
            }
        }


        if ($title == "Country Master") {

            if ($actionType == "Edit") {
                $countryArray = $this->Backend_model->getCountryList($actionId);
            }
        }

        if ($title == "State Master") {
            $countryArray = $this->Backend_model->getCountryList("0");
            if ($actionType == "Edit") {
                $orderBy = " order by s.state ASC";
                $stateArray = $this->Backend_model->getStateList($actionId, "0", $orderBy);
            }
        }

        if ($title == "District Master") {
            $editCountryId = "0";
            if ($actionType == "Edit") {
                $orderBy = " order by s.district ASC";
                $districtArray = $this->Backend_model->getDistrictList($actionId, "0", "0", $orderBy);
                if(count($districtArray)>0){
                    $editCountryId = $districtArray[0]['countryId'];
                }
            }
            $orderBy = " order by s.state ASC";
            $stateArray = $this->Backend_model->getStateList("0", $editCountryId, $orderBy);
            $countryArray = $this->Backend_model->getCountryList("0");
        }

        if ($title == "Sub District Master") {
            $countryId = "0";
            $stateId = "0";
            $districtId = "0";
            if ($actionType == "Edit") {
                $subDistrictArray = $this->Backend_model->getSubDistrictList($actionId, $countryId, $stateId, $districtId);
                if(count($subDistrictArray)>0){
                    $countryId = $subDistrictArray[0]['countryId'];
                    $stateId = $subDistrictArray[0]['stateId'];
                    //                    $districtId = $subDistrictArray[0]['districtId'];
                    $orderBy = " order by s.district ASC";
                    $districtArray = $this->Backend_model->getDistrictList("0", $countryId, $stateId, $orderBy);
                    $orderBy = " order by s.state ASC";
                    $stateArray = $this->Backend_model->getStateList("0", $countryId, $orderBy);
                }
            }
            $countryArray = $this->Backend_model->getCountryList("0");
        }


        if ($title == "Reporting Master") {

            if ($actionType == "Edit") {
                $adsReportingArray = $this->Backend_model->getReportingList($actionId);
            }
        }
        $membershipPackageArray = array();
        if ($title == "Membership Package Master") {
            if ($actionType == "Edit") {
                $membershipPackageArray = $this->Backend_model->getMembershipPackageList($actionId);
            }
        }
        $profileArray = array();
        if ($title == "User Profile") {
            $usertypeid = $this->input->get_post("usertypeid");
            if ($actionType == "Edit") {
                $profileArray =  $this->Backend_model->getAdminUserProfileDetails($actionId, $usertypeid);
            }
        }

        $usersArray = array();
        $dynamicAdsVariableList = array();
        if ($title == "Dynamic Fields") {

            $orderBy = " order by category Asc";
            $categoryId = 0;
            $categoryArray = $this->Backend_model->getCategoryList("0", $orderBy);
            $dataheader['categoryId'] = $categoryId;
            if ($actionType == "Edit") {
                $dynamicAdsVariableList = $this->Backend_model->getDynamicAdsVariableList($actionId, "0", "0");
            }
        }
        if ($title == "Dynamic Input") {
            $orderBy = "DESC";
            if ($actionType == "Edit") {
                $dynamicInputType = $this->input->get_post("dynamicInputType");
                $dynamicSelectBoxList = $this->Backend_model->getDynamicInputMasterList($actionId, $dynamicInputType);
            }
        }
        if ($title == "Dynamic Input Value") {

            $orderBy = "DESC";



            if ($actionType == "Edit") {
                $dynamicSelectBoxValueList = $this->Backend_model->getDynamicInputValueList($actionId, "0");
//                if(count($dynamicSelectBoxValueList)>0){
//                }

            }
            $dynamicInputType = "";
            $dynamicSelectBoxList = $this->Backend_model->getDynamicInputMasterList("0", $dynamicInputType);
        }

        if ($title == "Users" || $title == "Users Master") {
            $actionId = $this->input->get_post("actionId");
            $activestatus = "";
            if ($actionType == "Edit") {
                $usersArray =  $this->users_model->getFrontendUsers($actionId, $activestatus);
            }
            $orderBy = " order by s.state ASC";
            $countryId = 1;
            $stateArray = $this->Backend_model->getStateList("0", $countryId, $orderBy);
        }

        $dataheader['categoryArray'] = $categoryArray;
        $dataheader['subCategoryArray'] = $subCategoryArray;
        $dataheader['itemArray'] = $itemArray;
        $dataheader['countryArray'] = $countryArray;
        $dataheader['stateArray'] = $stateArray;
        $dataheader['districtArray'] = $districtArray;
        $dataheader['districtArray'] = $districtArray;
        $dataheader['subDistrictArray'] = $subDistrictArray;
        $dataheader['adsReportingArray'] = $adsReportingArray;
        $dataheader['membershipPackageArray'] = $membershipPackageArray;
        $dataheader['profileArray'] = $profileArray;
        $dataheader['usersArray'] = $usersArray;
        $dataheader['dynamicSelectBoxList'] = $dynamicSelectBoxList;
        $dataheader['dynamicSelectBoxValueList'] = $dynamicSelectBoxValueList;
        $dataheader['dynamicAdsVariableList'] = $dynamicAdsVariableList;


        $dataheader['title'] = $title;
        $dataheader['actionId'] = $actionId;
        $dataheader['actionType'] = $actionType;
        $dataheader['insertOrUpdateMasterUrl'] = base_url() . "Backend/insertOrUpdateMaster";
        $dataheader['getCommonSelectBoxUrl'] = base_url() . "Backend/getCommonSelectBox";

        $this->load->view('Backend/AddOrEditMasterContent', $dataheader);
    }

    public function insertOrUpdateMaster()
    {
        $dataheader['title'] = "InsertOrUpdate Master";

        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        if ($sessionUserTypeIdIsset != 1) {
            redirect(base_url() . "Backend/logout");
        }

        $actionType = $this->input->get_post("actionType");
        $actionId = $this->input->get_post("actionId");
        $submit = $this->input->get_post("submit");

        $createdAt = date("Y-m-d H:i:s");
        $fromIp = $this->Backend_model->getIpAddress();

        if ($submit == "Category Master") {

            $category = $this->input->post('category');
            $orders = $this->input->post('orders');
            $isAmountRequired = $this->input->post('isAmountRequired');
            $isOfferAmountRequired = $this->input->post('isOfferAmountRequired');
            $CategoryDetailsArray = array('category' => $category,'isAmountRequired'=>$isAmountRequired,'isOfferAmountRequired'=>$isOfferAmountRequired, 'orders'=>$orders, 'categoryId' => $actionId, 'createdAt' => $createdAt, 'active' => 'active', 'fromIp' => $fromIp, 'createdAt' => $createdAt);

            $output = array('status' => "3", 'message' => "Invalid Request");
            if ($actionType == "Edit" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $insertSuccess = $userTypeArray = $this->Backend_model->updateCategoryMaster($CategoryDetailsArray); //For Create Brand
                if ($insertSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully updated");
                } else {
                    $output = array('status' => "2", 'message' => "Invalid update");
                }
            } else if ($actionType == "Delete" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $deletetSuccess = $userTypeArray = $this->Backend_model->deleteCategoryMaster($CategoryDetailsArray); //For Update Brand
                if ($deletetSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully deleted");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            } else if ($actionType == "Add" || $actionType == "") {
                $updateSuccess = $userTypeArray = $this->Backend_model->createCategoryMaster($CategoryDetailsArray); //For Update Brand
                if ($updateSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully created");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            }
            $this->session->set_flashdata('output', $output);
            redirect(base_url() . "Backend/categoryMaster");

        } else if ($submit == "Sub Category Master") {
            $categoryId = $this->input->post('categoryId');
            $subcategory = $this->input->post('subcategory');
            $subCategoryDetailsArray = array('subCategory' => $subcategory, 'categoryId' => $categoryId, 'subCategoryId' => $actionId, 'createdAt' => $createdAt, 'active' => 'active', 'fromIp' => $fromIp);

            $output = array('status' => "3", 'message' => "Invalid Request");
            if ($actionType == "Edit" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $insertSuccess = $userTypeArray = $this->Backend_model->updateSubCategoryMaster($subCategoryDetailsArray); //For Create Brand
                if ($insertSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully updated");
                } else {
                    $output = array('status' => "2", 'message' => "Invalid update");
                }
            } else if ($actionType == "Delete" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $deletetSuccess = $userTypeArray = $this->Backend_model->deleteSubCategoryMaster($subCategoryDetailsArray); //For Update Brand
                if ($deletetSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully deleted");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            } else if ($actionType == "Add" || $actionType == "") {
                $updateSuccess = $userTypeArray = $this->Backend_model->createSubCategoryMaster($subCategoryDetailsArray); //For Update Brand
                if ($updateSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully created");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            }
            $this->session->set_flashdata('output', $output);
            redirect(base_url() . "Backend/subCategoryMaster");

        } else if ($submit == "Item Master") {

            $categoryId = $this->input->post('categoryId');
            $subCategoryId = $this->input->post('subCategoryId');
            $item = $this->input->post('item');

            $itemDetailsArray = array('item'=>$item, 'subCategoryId' => $subCategoryId, 'categoryId' => $categoryId, 'itemId' => $actionId, 'createdAt' => $createdAt, 'active' => 'active', 'fromIp' => $fromIp);

            $output = array('status' => "3", 'message' => "Invalid Request");
            if ($actionType == "Edit" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $insertSuccess = $userTypeArray = $this->Backend_model->updateItemMaster($itemDetailsArray); //For Create Brand
                if ($insertSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully updated");
                } else {
                    $output = array('status' => "2", 'message' => "Invalid update");
                }
            } else if ($actionType == "Delete" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $deletetSuccess = $userTypeArray = $this->Backend_model->deleteItemMaster($itemDetailsArray); //For Update Brand
                if ($deletetSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully deleted");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            } else if ($actionType == "Add" || $actionType == "") {
                $updateSuccess = $userTypeArray = $this->Backend_model->createItemMaster($itemDetailsArray); //For Update Brand
                if ($updateSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully created");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            }
            $this->session->set_flashdata('output', $output);
            redirect(base_url() . "Backend/ItemMaster");

        } else if ($submit == "Membership Package Master") {

            $membershipPackageTitle = $this->input->post('membershippackage');
            $packageAmount = $this->input->post('packageAmount');
            $noOfDaysToActive = $this->input->post('noOfDaysToActive');
            $membershipPackageDetailsArray = array('membershipPackageTitle' => $membershipPackageTitle, 'packageAmount' => $packageAmount, 'noOfDaysToActive' => $noOfDaysToActive, 'packageId' => $actionId, 'createdAt' => $createdAt, 'active' => 'active', 'fromIp' => $fromIp);

            $output = array('status' => "3", 'message' => "Invalid Request");
            if ($actionType == "Edit" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $insertSuccess = $userTypeArray = $this->Backend_model->updateMembershipPackageMaster($membershipPackageDetailsArray); //For Create Brand
                if ($insertSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully updated");
                } else {
                    $output = array('status' => "2", 'message' => "Invalid update");
                }
            } else if ($actionType == "Delete" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $deletetSuccess = $userTypeArray = $this->Backend_model->deleteMembershipPackageMaster($membershipPackageDetailsArray); //For Update Brand
                if ($deletetSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully deleted");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            } else if ($actionType == "Add" || $actionType == "") {
                $updateSuccess = $userTypeArray = $this->Backend_model->createMembershipPackageMaster($membershipPackageDetailsArray); //For Update Brand
                if ($updateSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully created");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            }
            $this->session->set_flashdata('output', $output);
            redirect(base_url() . "Backend/membershipPackageMaster");

        } else if ($submit == "Country Master") {


            $country = $this->input->post('country');
            $CountryDetailsArray = array('country' => $country, 'countryId' => $actionId, 'createdAt' => $createdAt, 'active' => 'active', 'fromIp' => $fromIp, 'createdAt' => $createdAt);

            $output = array('status' => "3", 'message' => "Invalid Request");
            if ($actionType == "Edit" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $insertSuccess = $userTypeArray = $this->Backend_model->updateCountryMaster($CountryDetailsArray); //For Create Brand
                if ($insertSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully updated");
                } else {
                    $output = array('status' => "2", 'message' => "Invalid update");
                }
            } else if ($actionType == "Delete" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $deletetSuccess = $userTypeArray = $this->Backend_model->deleteCountryMaster($CountryDetailsArray); //For Update Brand
                if ($deletetSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully deleted");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            } else if ($actionType == "Add" || $actionType == "") {
                $updateSuccess = $userTypeArray = $this->Backend_model->createCountryMaster($CountryDetailsArray); //For Update Brand
                if ($updateSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully created");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            }
            $this->session->set_flashdata('output', $output);
            redirect(base_url() . "Backend/countryMaster");
        } else if ($submit == "State Master") {
            $countryId = $this->input->post('countryId');
            $state = $this->input->post('state');
            $stateDetailsArray = array('state' => $state, 'countryId' => $countryId, 'stateId' => $actionId, 'createdAt' => $createdAt, 'active' => 'active', 'fromIp' => $fromIp);

            $output = array('status' => "3", 'message' => "Invalid Request");
            if ($actionType == "Edit" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $insertSuccess = $userTypeArray = $this->Backend_model->updateStateMaster($stateDetailsArray); //For Create Brand
                if ($insertSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully updated");
                } else {
                    $output = array('status' => "2", 'message' => "Invalid update");
                }
            } else if ($actionType == "Delete" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $deletetSuccess = $userTypeArray = $this->Backend_model->deleteStateMaster($stateDetailsArray); //For Update Brand
                if ($deletetSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully deleted");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            } else if ($actionType == "Add" || $actionType == "") {
                $updateSuccess = $userTypeArray = $this->Backend_model->createStateMaster($stateDetailsArray); //For Update Brand
                if ($updateSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully created");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            }
            $this->session->set_flashdata('output', $output);
            redirect(base_url() . "Backend/stateMaster");

        } else if ($submit == "District Master") {

            $countryId = $this->input->post('countryId');
            $stateId = $this->input->post('stateId');
            $district = $this->input->post('district');
            $CityDetailsArray = array('district' => $district, 'countryId' => $countryId, 'stateId' => $stateId, 'districtId' => $actionId, 'createdAt' => $createdAt, 'active' => 'active', 'fromIp' => $fromIp);

            $output = array('status' => "3", 'message' => "Invalid Request");
            if ($actionType == "Edit" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $insertSuccess = $userTypeArray = $this->Backend_model->updateDistrictMaster($CityDetailsArray); //For Create Brand
                if ($insertSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully updated");
                } else {
                    $output = array('status' => "2", 'message' => "Invalid update");
                }
            } else if ($actionType == "Delete" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $deletetSuccess = $userTypeArray = $this->Backend_model->deleteDistrictMaster($CityDetailsArray); //For Update Brand
                if ($deletetSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully deleted");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            } else if ($actionType == "Add" || $actionType == "") {
                $updateSuccess = $userTypeArray = $this->Backend_model->createDistrictMaster($CityDetailsArray); //For Update Brand
                if ($updateSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully created");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            }
            $this->session->set_flashdata('output', $output);
            redirect(base_url() . "Backend/districtMaster");


        } else if ($submit == "Sub District Master") {

            $countryId = $this->input->post('countryId');
            $stateId = $this->input->post('stateId');
            $districtId = $this->input->post('districtId');
            $SubDistrict = $this->input->post('subDistrict');
            $SubDistrictArray = array('subDistrict' => $SubDistrict,'districtId' => $districtId, 'countryId' => $countryId, 'stateId' => $stateId, 'subDistrictId' => $actionId, 'createdAt' => $createdAt, 'active' => 'active', 'fromIp' => $fromIp);
            print_r($SubDistrictArray);
            $output = array('status' => "3", 'message' => "Invalid Request");
            if ($actionType == "Edit" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $insertSuccess = $userTypeArray = $this->Backend_model->updateSubDistrictMaster($SubDistrictArray); //For Create Brand
                if ($insertSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully updated");
                } else {
                    $output = array('status' => "2", 'message' => "Invalid update");
                }
            } else if ($actionType == "Delete" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $deletetSuccess = $userTypeArray = $this->Backend_model->deleteSubDistrictMaster($SubDistrictArray); //For Update Brand
                if ($deletetSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully deleted");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            } else if ($actionType == "Add" || $actionType == "") {
                $updateSuccess = $userTypeArray = $this->Backend_model->createSubDistrictMaster($SubDistrictArray); //For Update Brand
                if ($updateSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully created");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            }
            $this->session->set_flashdata('output', $output);
            redirect(base_url() . "Backend/subDistrictMaster");


        } else if ($submit == "Reporting Master") {


            $adsReporting = $this->input->post('adsReporting');
            $adsReportingDetailsArray = array('reportingType' => $adsReporting, 'reportingId' => $actionId, 'createdAt' => $createdAt, 'active' => 'active', 'fromIp' => $fromIp);

            $output = array('status' => "3", 'message' => "Invalid Request");
            if ($actionType == "Edit" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $insertSuccess = $userTypeArray = $this->Backend_model->updateReportingMaster($adsReportingDetailsArray); //For Create Brand
                if ($insertSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully updated");
                } else {
                    $output = array('status' => "2", 'message' => "Invalid update");
                }
            } else if ($actionType == "Delete" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $deletetSuccess = $userTypeArray = $this->Backend_model->deleteReportingMaster($adsReportingDetailsArray); //For Update Brand
                if ($deletetSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully deleted");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            } else if ($actionType == "Add" || $actionType == "") {
                $updateSuccess = $userTypeArray = $this->Backend_model->createReportingMaster($adsReportingDetailsArray); //For Update Brand
                if ($updateSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully created");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            }
            $this->session->set_flashdata('output', $output);
            redirect(base_url() . "Backend/reportingMaster");

        } else if ($submit == "User Profile") {

            $usertypeid = $this->input->get_post('usertypeid');
            $email = $this->input->get_post('email');
            $name = $this->input->get_post('name');
            $password = $this->input->get_post('password');
            $mobile = $this->input->get_post('mobile');
            $address = $this->input->get_post('address');

            $usersProfileArray = array('name' => $name,'usertypeid' => $usertypeid,'email' => $email,'password' => $password,'mobile' => $mobile,'address' => $address, 'adminid' => $actionId, 'createdAt' => $createdAt, 'active' => 'active', 'fromIp' => $fromIp);
            $output = array('status' => "3", 'message' => "Invalid Request");
            if ($actionType == "Edit" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $insertSuccess = $userTypeArray = $this->Backend_model->updateAdminUsersProfile($usersProfileArray); //For Create Brand
                if ($insertSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully updated");
                } else {
                    $output = array('status' => "2", 'message' => "Invalid update");
                }
            } else if ($actionType == "Delete" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $deletetSuccess = $userTypeArray = $this->Backend_model->deleteAdminUsersProfile($usersProfileArray); //For Update Brand
                if ($deletetSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully deleted");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            } else if ($actionType == "Add" || $actionType == "") {
                $updateSuccess = $userTypeArray = $this->Backend_model->createAdminUsersProfile($usersProfileArray); //For Update Brand
                if ($updateSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully created");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            }
            $this->session->set_flashdata('output', $output);
            redirect(base_url() . "Backend/editProfile");
        } else if ($submit == "Users" || $submit == "Users Master") {

            $mobileNumber = $this->input->get_post('mobileNumber');
            $password = $this->input->get_post('password');
            $name = $this->input->get_post('name');
            $email = $this->input->get_post('email');
            $stateId = $this->input->get_post('stateId');
            $districtId = $this->input->get_post('districtId');
            $address = $this->input->get_post('address');
            $countryId = "1";

            $usersProfileArray = array('userid'=> $actionId, 'mobile' => $mobileNumber, 'password' => $password, 'name' => $name, 'email' => $email, 'countryId' => $countryId, 'stateId' => $stateId, 'districtId' => $districtId, 'address' => $address, 'active' => 'InActive', 'fromIp' => $fromIp, 'createdAt' => $createdAt, 'profilePhotoName'=>"");

            $output = array('status' => "3", 'message' => "Invalid Request");
            if ($actionType == "Edit" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $insertSuccess = $userTypeArray = $this->users_model->updateFrontendUsers($usersProfileArray); //For Create Brand
                if ($insertSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully updated");
                } else {
                    $output = array('status' => "2", 'message' => "Invalid update");
                }
            } else if ($actionType == "Delete" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $deletetSuccess = $userTypeArray = $this->users_model->deleteFrontendUsers($usersProfileArray); //For Update Brand
                if ($deletetSuccess == 1) {
                    $output = array('status' => "1", 'message' => "Successfully deleted");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            } else if ($actionType == "Add" || $actionType == "") {
                $updateSuccess = $this->users_model->createFrontendUsersProfile($usersProfileArray); //For Update Brand
                if (!$updateSuccess) {
                    $output = array('status' => "1", 'message' => "Successfully created");
                } else {
                    $output = array('status' => "2", 'message' => "Mobile number already exist!");
                }
            }
            $this->session->set_flashdata('output', $output);
            redirect(base_url() . "Backend/allUsersList");
        } else if ($submit == "Dynamic Fields") {
            $isSearchable = $this->input->get_post('isSearchable');
            $searchType = $this->input->get_post('searchType');
            $categoryId = $this->input->get_post('categoryId');
            $subCategoryId = $this->input->get_post('subCategoryId');
            $DynamicFields = $this->input->get_post('DynamicFields');
            $dynamicInputId = $this->input->get_post('dynamicInputId');
            $capturedVariableValue = $this->input->get_post('capturedVariableValue[]');

            $dynamicFieldsArray  = array("isSearchable"=>$isSearchable, "searchType"=>$searchType, "capturedVariableId" => $actionId, 'capturedvariablename'=>$DynamicFields, 'dynamicInputId'=>$dynamicInputId, 'categoryId'=>$categoryId, 'subCategoryId' => $subCategoryId, 'active' => 'active', 'fromIp' => $fromIp, 'createdAt' => $createdAt,'capturedVariableValueArray'=>$capturedVariableValue);
            if ($actionType == "Edit" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $updateSuccess = $this->Backend_model->updateDynamicFields($dynamicFieldsArray);
                if (!$updateSuccess) {
                    $output = array('status' => "1", 'message' => "Successfully updated");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later!");
                }
            } else if ($actionType == "Delete" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $updateSuccess = $this->Backend_model->deleteDynamicFields($dynamicFieldsArray);
                if ($updateSuccess==1) {
                    $output = array('status' => "1", 'message' => "Successfully deleted");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later!");
                }
            } else if ($actionType == "Add" || $actionType == "") {
                $updateSuccess = $this->Backend_model->createDynamicFields($dynamicFieldsArray);
                if ($updateSuccess) {
                    $output = array('status' => "1", 'message' => "Successfully created");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later!");
                }
            }
            $this->session->set_flashdata('output', $output);
            redirect(base_url() . "Backend/dynamicFieldsMaster");
        } else if ($submit == "Dynamic Input") {

            $dynamicInputName = $this->input->get_post('dynamicInputName');
            $dynamicInputType = $this->input->get_post('dynamicInputType');
//            $dynamicInputType = "Select Box";

            $dynamicInputMasterArray  = array("dynamicInputId" => $actionId, 'dynamicInputName'=>$dynamicInputName, 'dynamicInputType'=>$dynamicInputType, 'active' => 'active', 'fromIp' => $fromIp, 'createdAt' => $createdAt);
            if ($actionType == "Edit" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $updateSuccess = $this->Backend_model->updateDynamicInputMaster($dynamicInputMasterArray);
                if ($updateSuccess) {
                    $output = array('status' => "1", 'message' => "Successfully updated");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later!");
                }
            } else if ($actionType == "Delete" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $updateSuccess = $this->Backend_model->deleteDynamicInputMaster($dynamicInputMasterArray);
                if ($updateSuccess==1) {
                    $output = array('status' => "1", 'message' => "Successfully updated");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later!");
                }
            } else if ($actionType == "Add" || $actionType == "") {
                $updateSuccess = $this->Backend_model->createDynamicInputMaster($dynamicInputMasterArray);
                if ($updateSuccess) {
                    $output = array('status' => "1", 'message' => "Successfully created");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later!");
                }
            }

            $this->session->set_flashdata('output', $output);
            redirect(base_url() . "Backend/dynamicInputMaster");

        } else if ($submit == "Dynamic Input Value") {
            $dynamicInputId = $this->input->get_post('dynamicInputId');
           echo $dynamicInputValue = $this->input->get_post('dynamicInputValue');
            $dynamicInputValueMasterArray  = array("dynamicInputValueId" => $actionId, 'dynamicInputValue'=>$dynamicInputValue, 'dynamicInputId'=>$dynamicInputId, 'active' => 'active', 'fromIp' => $fromIp, 'createdAt' => $createdAt);

            if ($actionType == "Edit" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $updateSuccess = $this->Backend_model->updateDynamicInputValue($dynamicInputValueMasterArray); //For Update dynamicInputValue

            } else if ($actionType == "Delete" && $actionId != "0" && $actionId != "" && $actionId != null) {
                $updateSuccess = $this->Backend_model->deleteDynamicInputValue($dynamicInputValueMasterArray); //For Delete dynamicInputValue
                if ($updateSuccess==1) {
                    $output = array('status' => "1", 'message' => "Successfully deleted");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later!");
                }
            } else if ($actionType == "Add" || $actionType == "") {
                $updateSuccess = $this->Backend_model->createDynamicInputValue($dynamicInputValueMasterArray); //For Add dynamicInputValue
                if ($updateSuccess) {
                    $output = array('status' => "1", 'message' => "Successfully created");
                } else {
                    $output = array('status' => "2", 'message' => "Please try again later!");
                }
            }
            $this->session->set_flashdata('output', $output);
            redirect(base_url() . "Backend/dynamicInputValueMaster");
        }


    }

    public function subCategoryMaster()
    {
        $dataheader['title'] = "Sub Category Master";
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        if ($sessionUserTypeIdIsset != 1) {
            redirect(base_url() . "Backend/logout");
        }

        $dataheader['getMastersListUrl'] = base_url() . "Backend/getMastersList";

        $this->load->view('layout/Backend_header', $dataheader);
        $this->load->view('layout/Backend_menu');
        $this->load->view('Backend/subCategoryMaster');
        $this->load->view('layout/Backend_footer');
    }

    public function itemMaster()
    {
        $dataheader['title'] = "Item Master";
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        if ($sessionUserTypeIdIsset != 1) {
            redirect(base_url() . "Backend/logout");
        }

        $dataheader['getMastersListUrl'] = base_url() . "Backend/getMastersList";

        $this->load->view('layout/Backend_header', $dataheader);
        $this->load->view('layout/Backend_menu');
        $this->load->view('Backend/itemMaster');
        $this->load->view('layout/Backend_footer');
    }

    public function membershipPackageMaster()
    {
        $dataheader['title'] = "Membership Package Master";
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        if ($sessionUserTypeIdIsset != 1) {
            redirect(base_url() . "Backend/logout");
        }
        $dataheader['getMastersListUrl'] = base_url() . "Backend/getMastersList";

        $this->load->view('layout/Backend_header', $dataheader);
        $this->load->view('layout/Backend_menu');
        $this->load->view('Backend/membershipPackageMaster');
        $this->load->view('layout/Backend_footer');
    }

    public function countryMaster()
    {
        $dataheader['title'] = "Country Master";
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        if ($sessionUserTypeIdIsset != 1) {
            redirect(base_url() . "Backend/logout");
        }

        $dataheader['getMastersListUrl'] = base_url() . "Backend/getMastersList";

        $this->load->view('layout/Backend_header', $dataheader);
        $this->load->view('layout/Backend_menu');
        $this->load->view('Backend/countryMaster');
        $this->load->view('layout/Backend_footer');
    }

    public function stateMaster()
    {
        $dataheader['title'] = "State Master";
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        if ($sessionUserTypeIdIsset != 1) {
            redirect(base_url() . "Backend/logout");
        }

        $dataheader['getMastersListUrl'] = base_url() . "Backend/getMastersList";


        $this->load->view('layout/Backend_header', $dataheader);
        $this->load->view('layout/Backend_menu');
        $this->load->view('Backend/stateMaster');
        $this->load->view('layout/Backend_footer');
    }

    public function contactUsMaster()
    {
        $dataheader['title'] = "Contact Us Master";
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        if ($sessionUserTypeIdIsset != 1) {
            redirect(base_url() . "Backend/logout");
        }

        $dataheader['getMastersListUrl'] = base_url() . "Backend/getMastersList";


        $this->load->view('layout/Backend_header', $dataheader);
        $this->load->view('layout/Backend_menu');
        $this->load->view('Backend/contactUsMaster');
        $this->load->view('layout/Backend_footer');
    }

    public function getCommonSelectBox()
    {
        $upperActionId = $this->input->get_post('upperActionId');
        $divId = $this->input->get_post('divId');
        $actionId = $this->input->get_post('actionId');
        $getListFromPage = $this->input->get_post('getListFromPage');
        $selectBox = "";
        if($divId == "stateDiv"){
            $orderBy = " order by s.state ASC";
            $stateArray = $this->Backend_model->getStateList($actionId, $upperActionId, $orderBy);
            $selectBox = '<select name="stateId" id="stateId" class="form-control" parsley-trigger="change" onchange="getCommonSelectBox(this.value, \'districtDiv\')" required ><option value="">Select State</option>';
            for($c=0; $c<count($stateArray); $c++){
                $stateId = $stateArray[$c]['stateId'];
                $state = $stateArray[$c]['state'];
                $selectBox = $selectBox . '<option value="'.$stateId.'">'.$state.'</option>';
            }
            $selectBox = $selectBox . '</select>';
        } else if($divId == "districtDiv" || $divId=="districtInAddOrEditDiv"){
            $orderBy = " order by s.district ASC";
            $stateArray = $this->Backend_model->getDistrictList("0", "0", $upperActionId, $orderBy);
            $selectBox = '<select name="districtId" id="districtId" class="selectboxWidth form-control select2" parsley-trigger="change" required><option value="">Select City</option>';
            if($getListFromPage == "editMyProfile")
                $selectBox = '<select name="districtId" id="districtId" class="selectboxWidth form-control select2" ><option value="">Select City</option>';

            for($c=0; $c<count($stateArray); $c++){
                $districtId = $stateArray[$c]['districtId'];
                $district = $stateArray[$c]['district'];
                $selected ="";
                if($actionId!="" && $actionId!=0 && $actionId>0 && $actionId == $districtId){
                    $selected = "selected";
                }
                $selectBox = $selectBox . '<option value="'.$districtId.'" '.$selected.'>'.$district.'</option>';
                $selected = "";
            }
            $selectBox = $selectBox . '</select>';
        } else if($divId == "subCategoryIdDiv" || $divId == "searchSubCategoryIdDiv"){
            $orderBy = " order by s.subCategory Asc";
            $subCategoryArray = $this->Backend_model->getSubCategoryList($actionId, $upperActionId, $orderBy);
            $selectBoxId = "subCategoryId";
            if($divId == "searchSubCategoryIdDiv"){
                $selectBoxId = "searchSubCategoryId";
            }
            $selectBox = '<select name="'.$selectBoxId.'" id="'.$selectBoxId.'" class="form-control" parsley-trigger="change" required><option value="">Select Sub Category</option>';
            for($c=0; $c<count($subCategoryArray); $c++){
                $subCategoryId = $subCategoryArray[$c]['subCategoryId'];
                $subCategory = $subCategoryArray[$c]['subCategory'];
                $selectBox = $selectBox . '<option value="'.$subCategoryId.'">'.$subCategory.'</option>';
            }
            $selectBox = $selectBox . '</select>';
        }
        echo $selectBox;
    }

    public function districtMaster()
    {
        $dataheader['title'] = "District Master";
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        if ($sessionUserTypeIdIsset != 1) {
            redirect(base_url() . "Backend/logout");
        }

        $dataheader['getMastersListUrl'] = base_url() . "Backend/getMastersList";


        $this->load->view('layout/Backend_header', $dataheader);
        $this->load->view('layout/Backend_menu');
        $this->load->view('Backend/districtMaster');
        $this->load->view('layout/Backend_footer');
    }

    public function subDistrictMaster()
    {
        $dataheader['title'] = "Sub District Master";
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        if ($sessionUserTypeIdIsset != 1) {
            redirect(base_url() . "Backend/logout");
        }
        $dataheader['getMastersListUrl'] = base_url() . "Backend/getMastersList";

        $this->load->view('layout/Backend_header', $dataheader);
        $this->load->view('layout/Backend_menu');
        $this->load->view('Backend/subDistrictMaster');
        $this->load->view('layout/Backend_footer');
    }

    public function allUsersList(){

        $dataheader['title'] = "Users";
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        if ($sessionUserTypeIdIsset != 1) {
            redirect(base_url() . "Backend/logout");
        }
        $output = $this->session->flashdata('output');
        $succesMsg = $this->Backend_model->getSuccessMsg($output);
        $dataheader['succesMsg'] = $succesMsg;
        $dataheader['getMastersListUrl'] = base_url() . "Backend/getUsersList";
        $dataheader['getCommonSelectBoxUrl'] = base_url() . "Backend/getCommonSelectBox";

        $this->load->view('layout/Backend_header', $dataheader);
        $this->load->view('layout/Backend_menu');
        $this->load->view('Backend/allUsersMaster');
        $this->load->view('layout/Backend_footer');

    }

    public function getUsersList(){

        $dataheader['title'] = "Users Master";
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        if ($sessionUserTypeIdIsset != 1) {
            redirect(base_url() . "Backend/logout");
        }
        $dataheader['getMastersListUrl'] = base_url() . "Backend/getMastersList";
        $actionId = $this->input->get_post('actionId');
        $getGenerateExcel = $this->input->get_post('getGenerateExcel');
        $start = $this->input->get_post('start');
        $end = $this->input->get_post('end');
        $stateId = $this->input->get_post('stateId');
        $districtId = $this->input->get_post('districtId');
        $activeStatus = $this->input->get_post('activeStatus');
        if($activeStatus=="" || $activeStatus==null){
            $activeStatus = "active";
        }
        $orderBy = "desc";
        $usersArray = $this->Backend_model->getUsersList($actionId, $activeStatus, $orderBy, $start, $end, $stateId, $districtId);

        $dataheader['usersArray'] = $usersArray;
        $dataheader['getGenerateExcel'] = $getGenerateExcel;
        $dataheader['AddOrEditMasterContent'] = base_url() . "Backend/AddOrEditMasterContent";
        $dataheader['deleteUrl'] = base_url() . "Backend/insertOrUpdateMaster";

        $this->load->view('Backend/getUsersList',$dataheader);


    }

    public function dynamicFieldsMaster(){

        $dataheader['title'] = "Dynamic Fields";
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        if ($sessionUserTypeIdIsset != 1) {
            redirect(base_url() . "Backend/logout");
        }

        $output = $this->session->flashdata('output');
        $succesMsg = $this->Backend_model->getSuccessMsg($output);
        $dataheader['succesMsg'] = $succesMsg;

        $orderBy = " order by category ASC";
        $categoryArray = $this->Backend_model->getCategoryList("0", $orderBy);
//        echo count($categoryArray);
        $dataheader['categoryArray'] = $categoryArray;
        $dataheader['getCommonSelectBoxUrl'] = base_url() . "Backend/getCommonSelectBox";
        $dataheader['getMastersListUrl'] = base_url() . "Backend/getMastersList";
        $dataheader['AddOrEditMasterContent'] = base_url() . "Backend/AddOrEditMasterContent";
        $dataheader['deleteUrl'] = base_url() . "Backend/insertOrUpdateMaster";
        $dataheader['getCommonJsonDataUrl'] = base_url() . "Frontend/getCommonJsonData";

        $this->load->view('layout/Backend_header', $dataheader);
        $this->load->view('layout/Backend_menu');
        $this->load->view('Backend/dynamicFieldsMaster');
        $this->load->view('layout/Backend_footer');

    }
    public function dynamicInputMaster(){

        $dataheader['title'] = "Dynamic Input";
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        if ($sessionUserTypeIdIsset != 1) {
            redirect(base_url() . "Backend/logout");
        }

        $output = $this->session->flashdata('output');
        $succesMsg = $this->Backend_model->getSuccessMsg($output);
        $dataheader['succesMsg'] = $succesMsg;

        $dataheader['getMastersListUrl'] = base_url() . "Backend/getMastersList";
        $dataheader['AddOrEditMasterContent'] = base_url() . "Backend/AddOrEditMasterContent";
        $dataheader['deleteUrl'] = base_url() . "Backend/insertOrUpdateMaster";

        $this->load->view('layout/Backend_header', $dataheader);
        $this->load->view('layout/Backend_menu');
        $this->load->view('Backend/dynamicInputMaster');
        $this->load->view('layout/Backend_footer');

    }

    public function dynamicInputValueMaster(){

        $dataheader['title'] = "Dynamic Input Value";
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        if ($sessionUserTypeIdIsset != 1) {
            redirect(base_url() . "Backend/logout");
        }

        $output = $this->session->flashdata('output');
        $succesMsg = $this->Backend_model->getSuccessMsg($output);
        $dataheader['succesMsg'] = $succesMsg;

        $dataheader['getMastersListUrl'] = base_url() . "Backend/getMastersList";
        $dataheader['AddOrEditMasterContent'] = base_url() . "Backend/AddOrEditMasterContent";
        $dataheader['deleteUrl'] = base_url() . "Backend/insertOrUpdateMaster";

        $this->load->view('layout/Backend_header', $dataheader);
        $this->load->view('layout/Backend_menu');
        $this->load->view('Backend/dynamicInputValueMaster');
        $this->load->view('layout/Backend_footer');

    }

    public function getDynamicSelectBox(){
//        $categoryId = $this->input->get_post('categoryId');
        $dynamicInputType = $this->input->get_post('dynamicInputType');

        $dynamicInputMasterArray = $this->Backend_model->getDynamicInputMasterList("0", $dynamicInputType);
        echo json_encode($dynamicInputMasterArray);
    }

    public function adsMaster(){

        $dataheader['title'] = "Ads";
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        if ($sessionUserTypeIdIsset != 1) {
            redirect(base_url() . "Backend/logout");
        }
        $output = $this->session->flashdata('output');
        $succesMsg = $this->Backend_model->getSuccessMsg($output);
        $dataheader['succesMsg'] = $succesMsg;

        $dataheader['getMastersListUrl'] = base_url() . "Backend/getMastersList";
        $dataheader['getCommonSelectBoxUrl'] = base_url() . "Backend/getCommonSelectBox";

        $orderBy = " order by category ASC";
        $categoryArray = $this->Backend_model->getCategoryList("0", $orderBy);
        $dataheader['categoryArray'] = $categoryArray;
        $dataheader['getCommonJsonDataUrl'] = base_url() . "Frontend/getCommonJsonData";

        $this->load->view('layout/Backend_header', $dataheader);
        $this->load->view('layout/Backend_menu');
        $this->load->view('Backend/adsMaster');
        $this->load->view('layout/Backend_footer');

    }

    public function viewAds(){
        $dataheader['title'] = "View Ads";
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        if ($sessionUserTypeIdIsset != 1) {
            redirect(base_url() . "Backend/logout");
        }
        $adsId = $this->input->get_post('adsId');
        $categoryId = $subCategoryId = $itemId = $countryId = $stateId = $cityId = $status = "";
        $searchUserId = "";
        $getListFromPage = "viewAds";
        $dynamicVariableIdList = array();
        $dynamicSearchData = array();
        $amountRange = $this->input->get_post('amountRange');
        $searchText = $this->input->get_post('searchText');
        $orderBy = $this->input->get_post('orderBy');

        $page = $this->input->get_post('page');
        $rec_limit = 5;
        $rangeArray =array();
        $galleryStatus = "";
        $withphoto = $this->input->get_post('withphoto');

        $myLatitude = "0";
        $myLongitude = "0";
        $withOutadsId = "0"; //s1
        $adsPaginationArray = $this->users_model->getadsList($adsId, $categoryId, $subCategoryId, $itemId, $countryId, $stateId, $cityId, $status, $galleryStatus,$dynamicSearchData, $searchUserId, $getListFromPage,  $rangeArray,$amountRange,$searchText,$withphoto,$myLatitude,$myLongitude, $orderBy, $withOutadsId, $page, $rec_limit);
        $rec_limit = $adsPaginationArray['rec_limit'];
        $left_rec = $adsPaginationArray['left_rec'];
        $adsArray = $adsPaginationArray['resultArrayData'];
        $page = $adsPaginationArray['page'];

        $dataheader['rec_limit'] = $rec_limit;
        $dataheader['left_rec'] = $left_rec;
        $dataheader['page'] = $page;

        $adsGalleryArray = $this->users_model->getAdsGallery($adsId, "");


        $dataheader['adsArray'] = $adsArray;
        $dataheader['adsGalleryArray'] = $adsGalleryArray;

        $output = $this->session->flashdata('output');
        $succesMsg = $this->Backend_model->getSuccessMsg($output);
        $dataheader['succesMsg'] = $succesMsg;

        $this->load->view('layout/Backend_header', $dataheader);
        $this->load->view('layout/Backend_menu');
        $this->load->view('Backend/viewAds');
        $this->load->view('layout/Backend_footer');
    }

    public function updateAdsStatusForm(){
        $adsId = $this->input->get_post('adsId');

        $adsGalleryArray = $this->users_model->getAdsGallery($adsId, "");

        $galleryUpdateSql = "";
        for($n=0; $n<count($adsGalleryArray); $n++){
            $adsGalleryId = $adsGalleryArray[$n]['adsGalleryId'];
            $adsGalleryStatus = $adsGalleryArray[$n]['active'];
            $postKey = 'galleryActiveStatus'.$adsGalleryId;
            $requestArray = $_REQUEST;
            if (array_key_exists($postKey, $requestArray)) {
                $postedStatus = $requestArray[$postKey];
                if($postedStatus!=$adsGalleryStatus){
                    $galleryUpdateSql = "UPDATE `tbl_adsgallery` SET `active`='".$postedStatus."' WHERE `adsGalleryId`=".$adsGalleryId."; ";
                    $this->Backend_model->runUpdateQuery($galleryUpdateSql);
                }
            }
        }

        //Update ads status
        $adsId = $this->input->get_post('adsId');
        $activeStatus = $this->input->get_post('activeStatus');
//s2
        $adsPaginationArray = $this->users_model->getadsList($adsId, "", "", "", "","", "", "", "", "", "", "", "",  "","","","","", "", "", "","");
        $adsArray = $adsPaginationArray['resultArrayData'];

        $rec_limit = $adsPaginationArray['rec_limit'];
        $left_rec = $adsPaginationArray['left_rec'];
        $page = $adsPaginationArray['page'];

        $dataheader['rec_limit'] = $rec_limit;
        $dataheader['left_rec'] = $left_rec;
        $dataheader['page'] = $page;

        if(count($adsArray)>0){
            $adsActive = $adsArray[0]['active'];
            if($adsActive!=$activeStatus){
                $adsUpdateSql = "UPDATE `tbl_ads` SET `active`='".$activeStatus."' WHERE `adsId` = ".$adsId;
                $this->Backend_model->runUpdateQuery($adsUpdateSql);

                if($adsActive == "active"){
                    $adsCode = $adsArray[0]['adsCode'];
                    $userid = $adsArray[0]['userid'];
                    $userDataArray = $this->Backend_model->getUsersList($userid, "active", "", "", "", "", "");
                    if(count($userDataArray)>0){
                        $mobile = $userDataArray[0]['mobile'];
                        $sendMessage = "Your 1stepshop.in Ads Code : ". $adsCode ." was activated successfully";
                        $baseUrl = base_url();
                        $sendUrl = $baseUrl . "sendSMS?";
                        $sendData = "to=" . $mobile . "&msg=" . $sendMessage;
                        $this->users_model->curlPost($sendUrl, $sendData);
                    }
                }
            }
        }
        $output = array('status' => "1", 'message' => "Status Successfully Updated");
        $this->session->set_flashdata('output', $output);

        redirect(base_url()."Backend/viewAds?adsId=".$adsId);
    }
    public function reportAboutAdsList(){

        $dataheader['title'] = "Report About Ads";
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        if ($sessionUserTypeIdIsset != 1) {
            redirect(base_url() . "Backend/logout");
        }

        $dataheader['getMastersListUrl'] = base_url() . "Backend/getMastersList";
        $actionId="0";
        $orderBy = " order by id DESC";
        $adsReportArray = $this->Backend_model->getReportAboutAdsList($actionId, $orderBy);
        $dataheader['adsReportArray'] =$adsReportArray;

        $this->load->view('layout/Backend_header', $dataheader);
        $this->load->view('layout/Backend_menu');
        $this->load->view('Backend/reportAboutAdsList');
        $this->load->view('layout/Backend_footer');
    }
}
