<?php

/**
 * Created by IntelliJ IDEA.
 * User: root
 * Date: 3/10/16
 * Time: 10:44 PM
 */
class Users_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function migrationCountryStateCity()
    {

        /* State List Migration
        $sql = "SELECT * FROM `stateData` WHERE 1";
        $query = $this->db->query($sql);
        $stateList = $query->result_array();
        //echo "<pre>";
        //print_r($stateList);
        //echo "</pre>";
        $createdAt = date("Y-m-d H:i:s");
        for($s=0; $s<count($stateList); $s++){
            $stateId = $stateList[$s]['StateId'];
            $countryId = $stateList[$s]['CountryId'];
            $state = $stateList[$s]['StateName'];
            echo $insertQuery = "INSERT INTO `tbl_state`(`stateId`, `state`, `countryId`, `active`, `fromIp`, `createdAt`) VALUES (".$stateId.",'".$state."', ".$countryId.", 'active', NULL,'".$createdAt."'); <br>";
        }
        */

        /*
        // District List Migration
        $sql = "SELECT * FROM `districtData` WHERE 1";
        $query = $this->db->query($sql);
        $districtList = $query->result_array();
        //echo "<pre>";
        //print_r($stateList);
        //echo "</pre>";
        $createdAt = date("Y-m-d H:i:s");
        for ($s = 0; $s < count($districtList); $s++) {
            $DistrictId = $districtList[$s]['DistrictId'];
            $countryId = $districtList[$s]['countryId'];
            $DistrictName = $districtList[$s]['DistrictName'];
            $StateId = $districtList[$s]['StateId'];
            echo $insertQuery = "INSERT INTO `tbl_district`(`districtId`, `district`, `stateId`, `countryId`, `active`, `fromIp`, `createdAt`) VALUES (".$DistrictId.",'".$DistrictName."',".$StateId.",".$countryId.",'active',NULL,'".$createdAt."'); <br>";
        }*/


        // District List Migration
        $sql = "SELECT * FROM `subDistrictData` WHERE 1";
        $query = $this->db->query($sql);
        $subDistrictList = $query->result_array();
        //echo "<pre>";
        //print_r($stateList);
        //echo "</pre>";
        $createdAt = date("Y-m-d H:i:s");
        for ($s = 0; $s < count($subDistrictList); $s++) {
            $subDistrictId = $subDistrictList[$s]['SubDistrictId'];
            $subDistrict = $subDistrictList[$s]['SubDistrictName'];
            $StateId = 1;
            $DistrictId = $subDistrictList[$s]['DistrictId'];
            $countryId = 1;

            $insertQuery = "INSERT INTO `tbl_subdistrict`(`subDistrictId`, `subDistrict`, `districtId`, `stateId`, `countryId`, `active`, `fromIp`, `createdAt`) VALUES (" . $subDistrictId . ",'" . $subDistrict . "'," . $DistrictId . "," . $StateId . "," . $countryId . ",'active',NULL,'" . $createdAt . "'); <br>";
        }


        /*
       // update stateId Migration
        $sql = "SELECT * FROM `subDistrictData` WHERE 1";
        $query = $this->db->query($sql);
        $subDistrictList = $query->result_array();

        $sqlDistrict = "SELECT * FROM `tbl_district` WHERE 1";
        $query = $this->db->query($sqlDistrict);
        $districtList = $query->result_array();
        for ($s = 0; $s < count($districtList); $s++) {
            $districtId = $districtList[$s]['districtId'];
            $stateId = $districtList[$s]['stateId'];

            echo $insertQuery = " UPDATE `tbl_subDistrict` SET `stateId`=".$stateId." WHERE districtId=".$districtId."; <br>";
        }*/
    }

    public function getSuccessMsg($output)
    {
        $successMsg = "";
        $responseMsg = "";
        $responseStatus = "";
        if (isset($output)) {
            $responseStatus = $output['status'];
            $responseMsg = $output['message'];
        }

        if ($responseStatus == 1) {
            $successMsg = "<div class=\"alert alert-success alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>" . $responseMsg . "</div>";
        } else if ($responseStatus == 2) {
            $successMsg = "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>" . $responseMsg . "</div>";
        }

        return $successMsg;
    }

    public function checkUsersLoginCredential($userCredentialArray)
    {
        $username = $userCredentialArray['username'];
        $password = $userCredentialArray['userpassword'];
        $userListArray = array();

        // Select active list from both user and usertype table

        $sql = "SELECT t.userid, t.active, t.userCode, t.name, t.mobile, t.email, t.img, t.address, t.lastlogin FROM tbl_user t  WHERE t.mobile = '" . $username . "' and t.password = '" . $password . "' ";
        $query = $this->db->query($sql);
        $userList = $query->result_array();

        if (count($userList) > 0) {
            $userListArray['userid'] = $userList[0]['userid'];
            $userListArray['active'] = $userList[0]['active'];
            $userListArray['userCode'] = $userList[0]['userCode'];
            $userListArray['name'] = $userList[0]['name'];
            $userListArray['mobile'] = $userList[0]['mobile'];
            $userListArray['email'] = $userList[0]['email'];
            $userListArray['img'] = $userList[0]['img'];
            $userListArray['address'] = $userList[0]['address'];
            $userListArray['lastlogin'] = $userList[0]['lastlogin'];

            self::updateUsersLastlogin($userList[0]['userid']);
        }

        return $userListArray;
    }

    public function getUsersLoginCredential($mobileNumber)
    {
        $userListArray = array();
        $userid = "0";
        // Select active list from both user and usertype table
        $sql = "SELECT t.userid, t.active FROM tbl_user t  WHERE t.mobile = '" . $mobileNumber . "' ";
        $query = $this->db->query($sql);
        $userList = $query->result_array();

        if (count($userList) > 0) {
            $userid = $userList[0]['userid'];
        }

        return $userid;
    }

    public function updateUsersLastlogin($userid)
    {
        $data = array('lastlogin' => date('Y-m-d H:m:s'));
        $this->db->where('userid', $userid);
        return $this->db->update('tbl_user', $data);
    }

    public function getSuccessMsgOTPUpdated($mobileNumber, $otptext, $tableAction)
    {
        $resultArray = array('successMsg' => 0, 'userid' => null);
        $userSql = "SELECT u.userid FROM `tbl_user` u WHERE u.mobile = '" . $mobileNumber . "' ";
        $tablename = "tbl_profileactivationrequest";
        if ($tableAction == "forgotpasswordrequest") {
            $tablename = "tbl_forgotpasswordrequest";
        }
        $sql = "SELECT userid FROM " . $tablename . " t WHERE t.active = 'active' ";
        $sql .= " and t.otp = '" . $otptext . "' ";
        $sql .= " and t.userid in ($userSql) ";
        $userQuery = $this->db->query($sql);
        $returnValue = $userQuery->result_array();
        if (count($returnValue) > 0) {
            $userid = $returnValue[0]['userid'];
            $resultArray = array('successMsg' => 1, 'userid' => $userid);
            $usedAt = date("Y-m-d H:i:s");
            $forgotSql = "Update " . $tablename . " set active = 'used', usedAt = " . $this->db->escape($usedAt) . "  where userid = " . $this->db->escape($userid) . " and active='active' and otp = " . $this->db->escape($otptext);
            $this->db->query($forgotSql);
        }
        return $resultArray;
    }

    public function getFrontendUsers($actionId, $active)
    {
        $userList = array();

        //Select active list from both user and usertype table
        $sql = "SELECT * FROM tbl_user t WHERE ";
        if ($active != "" && $active != null) {
            $sql = $sql . " and t.active = " . $this->db->escape($active);
        }

        if ($actionId != "" && $actionId != null) {
            $sql = $sql . " and t.userid = " . $this->db->escape($actionId);
        }
        $sql = str_replace("WHERE  and", "WHERE ", $sql);
        $query = $this->db->query($sql);
        $userList = $query->result_array();
        return $userList;
    }

    public function updateFrontendUsers($usersProfileArray)
    {
        $userid = $usersProfileArray['userid'];
        $name = $usersProfileArray['name'];
        $active = "";
        //        $active  = $usersProfileArray['active'];
        $password = $usersProfileArray['password'];
        $mobileNumber = $usersProfileArray['mobile'];
        $email = $usersProfileArray['email'];
        $address = $usersProfileArray['address'];
        $stateId = $usersProfileArray['stateId'];
        $districtId = $usersProfileArray['districtId'];
        $countryId = $usersProfileArray['countryId'];
        $profilePhotoName = $usersProfileArray['profilePhotoName'];

        $profilePhotoPath = "";
        if($profilePhotoName!="" && $profilePhotoName!=null){
            $profilePhotoPath = ", img = ".$this->db->escape($profilePhotoName);
        }

        $updateSql = "UPDATE `tbl_user` SET `name`=" . $this->db->escape($name) . ",`mobile`=" . $this->db->escape($mobileNumber) . ",`email`=" . $this->db->escape($email) . ",`password`=" . $this->db->escape($password) . ",`address`=" . $this->db->escape($address) . ",`districtId`=" . $this->db->escape($districtId) . ",`stateId`=" . $this->db->escape($stateId) . ",`countryId`=" . $this->db->escape($countryId).$profilePhotoPath;

        if ($active != "" && $active != null) {
            $updateSql = $updateSql . ",`active`=" . $this->db->escape($active);
        }

        $updateSql = $updateSql . " WHERE userid=" . $this->db->escape($userid);
        return $this->db->query($updateSql);
    }

    public function getUserProfilePhoto($userCode, $img){

        $userProfiles = 'uploads/files/userprofiles/'.$userCode. '/'. $img;

        if(file_exists($userProfiles)){
            $userProfiles = base_url().$userProfiles;
        } else {
            $dummyProfile = "";
            $userProfiles = base_url(). $dummyProfile;
        }
        return $userProfiles;

    }
    public function isUserAlreadyExist($mobileNmber)
    {

        $alreadyExist = 0;
        $userSql = "SELECT userid FROM `tbl_user` t WHERE mobile = " . $mobileNmber;
        $userQuery = $this->db->query($userSql);
        $returnValue = $userQuery->result_array();
        if (count($returnValue) > 0) {
            $alreadyExist = 1;
        }
        return $alreadyExist;
    }

    public function createFrontendUsersProfile($usersProfileArray)
    {
        $alreadyExist = self::isUserAlreadyExist($usersProfileArray['mobile']);
        $otp = "";
        //$userSql = "SELECT userid FROM `tbl_user` t WHERE mobile = " . $this->db->escape($usersProfileArray['mobile']);
        //$userQuery = $this->db->query($userSql);
        //$returnValue = $userQuery->result_array();
        if ($alreadyExist == 0) {
            $mobileNumber = $usersProfileArray['mobile'];
            $sql = "INSERT INTO tbl_user (mobile, password, name, email, address, stateId, districtId, countryId, active, createdAt, fromIp) " . "VALUES ( " . $this->db->escape($usersProfileArray['mobile']) . ", " . $this->db->escape($usersProfileArray['password']) . "," . $this->db->escape($usersProfileArray['name']) . "," . $this->db->escape($usersProfileArray['email']) . "," . $this->db->escape($usersProfileArray['address']) . "," . $this->db->escape($usersProfileArray['stateId']) . "," . $this->db->escape($usersProfileArray['districtId']) . "," . $this->db->escape($usersProfileArray['countryId']) . "," . $this->db->escape($usersProfileArray['active']) . "," . $this->db->escape($usersProfileArray['createdAt']) . "," . $this->db->escape($usersProfileArray['fromIp']) . ")";
            $this->db->query($sql);

            $userId = $this->db->insert_id();

            $userCode = "MEM".sprintf('%04u', $userId);
            $updateSql = "Update tbl_user set userCode = ".$this->db->escape($userCode) . " Where userid = ".$this->db->escape($userId);
            $this->db->query($updateSql);


            $fromIp = $usersProfileArray['fromIp'];
            $baseUrl = base_url();
            self::getOTPForUserActivation($userId, $fromIp, $mobileNumber, $baseUrl);
        }
        return $alreadyExist;
    }

    public function checkUsersLoginCredentialOnlyUsername($userCredentialArray)
    {
        $username = $userCredentialArray['username'];
        $userListArray = array();

        // Select active list from both user and usertype table

        $sql = "SELECT t.userid, t.active, t.userCode FROM tbl_user t  WHERE t.mobile = '" . $username . "' ";
        $query = $this->db->query($sql);
        $userList = $query->result_array();

        if (count($userList) > 0) {
            $userListArray['userid'] = $userList[0]['userid'];
            $userListArray['active'] = $userList[0]['active'];
            $userListArray['userCode'] = $userList[0]['userCode'];
        }

        return $userListArray;
    }

    public function createFrontendUsersProfileForMigrationWithoutOTP($usersProfileArray)
    {

        $userNewArray = self::checkUsersLoginCredentialOnlyUsername($usersProfileArray);

        if (count($userNewArray) == 0) {
            $sql = "INSERT INTO tbl_user (mobile, password, name, email, address, stateId, districtId, countryId, active, createdAt, fromIp) " . "VALUES ( " . $this->db->escape($usersProfileArray['mobile']) . ", " . $this->db->escape($usersProfileArray['password']) . "," . $this->db->escape($usersProfileArray['name']) . "," . $this->db->escape($usersProfileArray['email']) . "," . $this->db->escape($usersProfileArray['address']) . "," . $this->db->escape($usersProfileArray['stateId']) . "," . $this->db->escape($usersProfileArray['districtId']) . "," . $this->db->escape($usersProfileArray['countryId']) . "," . $this->db->escape($usersProfileArray['active']) . "," . $this->db->escape($usersProfileArray['createdAt']) . "," . $this->db->escape($usersProfileArray['fromIp']) . ")";
            $this->db->query($sql);

            $userId = $this->db->insert_id();

            $userCode = "MEM".sprintf('%04u', $userId);
            $updateSql = "Update tbl_user set userCode = ".$this->db->escape($userCode) . " Where userid = ".$this->db->escape($userId);
            $this->db->query($updateSql);
            $userNewArray['userId'] = $userId;
            $userNewArray['userCode'] = $userCode;
        } else {
            $userNewArray['userId'] = $userNewArray['userid'];
            $userNewArray['userCode'] =  $userNewArray['userCode'];
        }
        return $userNewArray;
    }

    public function getOTPForUserActivation($userId, $fromIp, $mobileNumber, $baseUrl)
    {
        $newdate = new DateTime("now");
        $now = $createdAt = date_format($newdate, "Y-m-d H:i:s");
        $interval = new DateInterval('PT12H0S');
        $newdate->add($interval);

        $expiryDate = date_format($newdate, "Y-m-d H:i:s");
        $existSql = "Select * from `tbl_profileactivationrequest` where userid=" . $this->db->escape($userId) . " and active='active' and createdAt <= " . $this->db->escape($now) . " and expiryDate >= " . $this->db->escape($now);
        $executeQuery = $this->db->query($existSql);
        $returnValueArray = $executeQuery->result_array();

        if (count($returnValueArray) > 0) {
            $otp = $returnValueArray[0]['otp'];
        } else {
            $otp = rand(100000, 999999);
            $active = "active";
            $insertSql = "INSERT INTO `tbl_profileactivationrequest`(`userid`, `otp`, `expiryDate`, `active`, `fromIp`, `createdAt`) VALUES (" . $this->db->escape($userId) . "," . $this->db->escape($otp) . "," . $this->db->escape($expiryDate) . "," . $this->db->escape($active) . "," . $this->db->escape($fromIp) . "," . $this->db->escape($createdAt) . ")";
            $this->db->query($insertSql);
        }

        if ($mobileNumber != "") {
//            $sendUrl = $baseUrl . "sendSMS?";
//            $sendData = "to=" . $mobileNumber . "&msg=OTP for 1stepshop.in registration is " . $otp;
            self::curlSMSPost($mobileNumber, "OTP for 1stepshop.in registration is " . $otp);
        }
        return $otp;
    }

    public function getOTPForUserForgotPassword($userId, $mobileNumber, $fromIp, $baseUrl)
    {
        $newdate = new DateTime("now");
        $now = $createdAt = date_format($newdate, "Y-m-d H:i:s");
        $interval = new DateInterval('PT12H0S');
        $newdate->add($interval);

        $expiryDate = date_format($newdate, "Y-m-d H:i:s");
        $existSql = "Select * from `tbl_forgotpasswordrequest` where userid=" . $this->db->escape($userId) . " and active='active' and createdAt <= " . $this->db->escape($now) . " and expiryDate >= " . $this->db->escape($now);
        $executeQuery = $this->db->query($existSql);
        $returnValueArray = $executeQuery->result_array();

        if (count($returnValueArray) > 0) {
            $otp = $returnValueArray[0]['otp'];
        } else {
            $otp = rand(100000, 999999);
            $active = "active";
            $insertSql = "INSERT INTO `tbl_forgotpasswordrequest`(`userid`, `otp`, `expiryDate`, `active`, `fromIp`, `createdAt`) VALUES (" . $this->db->escape($userId) . "," . $this->db->escape($otp) . "," . $this->db->escape($expiryDate) . "," . $this->db->escape($active) . "," . $this->db->escape($fromIp) . "," . $this->db->escape($createdAt) . ")";
            $this->db->query($insertSql);
        }
        if ($mobileNumber != "") {
//            $sendUrl = $baseUrl . "sendSMS?";
//            $sendData = "to=" . $mobileNumber . "&msg=OTP for 1stepshop.in Forgot Password is " . $otp;
            self::curlSMSPost($mobileNumber,"OTP for 1stepshop.in Forgot Password is " . $otp);
        }
        return $otp;
    }

    public function activateMyProfile($userid)
    {
        if ($userid != null) {
            $active = "active";
            $sql = "UPDATE tbl_user set active = " . $this->db->escape($active) . " where userid = " . $this->db->escape($userid);
            $this->db->query($sql);
        }
    }

    public function updateMyPassword($userid, $password)
    {
        if ($userid != null) {
            $sql = "UPDATE tbl_user set password = " . $this->db->escape($password) . " where userid = " . $this->db->escape($userid);
            $this->db->query($sql);
        }
    }

    function curlSMSPost($to, $msg)
    {
        /*
        $ckfile = tempnam("/tmp", "CURLCOOKIE");
        $proxy = '';
        $ref = $url;
        $ch = curl_init();
        $agent = $_SERVER['HTTP_USER_AGENT'];

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: application/x-www-form-urlencoded", "Accept: /*"));
        curl_setopt($ch, CURLOPT_COOKIEJAR, "$ckfile");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_REFERER, $ref);
        return curl_exec($ch);
        */

        // Authorisation details.
        $username = "1stepshop.in@gmail.com";
        $hash = "ee0d4f20c3e75cf251603cc2de2b756f309446f8d4d5fe6fc382aa57fc88e432";
        $test = "0";
        $sender = "TXTLCL"; // This is who the message appears to be from.
        $numbers = "91".$to; // A single number or a comma-seperated list of numbers
        $message = $msg;
        $message = urlencode($message);
        $data = "username=" . $username . "&hash=" . $hash . "&message=" . $message . "&sender=" . $sender . "&numbers=" . $numbers . "&test=" . $test;
        $ch = curl_init('http://api.textlocal.in/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);     ////// i was missing this line.
        $result = curl_exec($ch); // This is the result from the API
        curl_close($ch);
        return $result;

    }

    public function createFreeAdPost($adsTitle, $description, $noOfDaysToActive, $startDate, $endDate, $categoryId, $subCategoryId, $itemId, $countryId, $stateId, $cityId, $address, $userid, $active, $fromIp, $createdAt,$actualPrice,$offerPrice,  $latitude, $longitude)
    {

        $insertSql = "INSERT INTO `tbl_ads`(`adsTitle`, `description`, `noOfDaysToActive`, `startDate`, `endDate`, `categoryId`, `subCategoryId`, `itemId`, `countryId`,  `stateId`, `cityId`,`address`,`latitude`, `longitude`, `userid`, `active`, `fromIp`,`actualPrice`, `offerPrice`, `createdAt`) VALUES (" . $this->db->escape($adsTitle) . ", " . $this->db->escape($description) . "," . $this->db->escape($noOfDaysToActive) . "," . $this->db->escape($startDate) . "," . $this->db->escape($endDate) . "," . $this->db->escape($categoryId) . "," . $this->db->escape($subCategoryId) . "," . $this->db->escape($itemId) . "," . $this->db->escape($countryId) . "," . $this->db->escape($stateId) . "," . $this->db->escape($cityId) . "," . $this->db->escape($address) . "," . $this->db->escape($latitude) . "," . $this->db->escape($longitude) . "," . $this->db->escape($userid) . "," . $this->db->escape($active) . "," . $this->db->escape($fromIp) . ",". $this->db->escape($actualPrice) . ",". $this->db->escape($offerPrice) . "," . $this->db->escape($createdAt) . ")";
        $this->db->query($insertSql);
        $adsId = $this->db->insert_id();

        $adsCode = "ADS".sprintf('%04u', $adsId);
        $updateSql = "Update tbl_ads set adsCode = ".$this->db->escape($adsCode) . " Where adsId = ".$this->db->escape($adsId);
        $this->db->query($updateSql);

        $returnArray['adsId']= $adsId;
        $returnArray['adsCode']= $adsCode;
        return $returnArray;
    }

    public function updateFreeAdPost($adsId, $editAdsEncryptedId, $postedAdsArray, $returnFormat){

        $historyString = "";
        $paginationArray = self::getadsList($adsId, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", 1);
        $editAdsArray = $paginationArray['resultArrayData'];

//        $adsTitle, $description, $noOfDaysToActive, $startDate, $endDate, $categoryId, $subCategoryId, $itemId, $countryId, $stateId, $cityId, $address, $userid, $active, $fromIp, $createdAt,$actualPrice,$offerPrice,  $latitude, $longitude
//        echo "<pre>";
        if(count($editAdsArray)>0) {
            $resultEditableAds = $editAdsArray[0];

            $noOfDaysToActive = self::checkKeyAndReturnValueFromArray('noOfDaysToActive', $postedAdsArray);
            $startDate = self::checkKeyAndReturnValueFromArray('startDate', $postedAdsArray);
            $endDate = "";

            $countryId = self::checkKeyAndReturnValueFromArray('countryId', $postedAdsArray);
            $stateId = self::checkKeyAndReturnValueFromArray('stateId', $postedAdsArray);
            $cityId = self::checkKeyAndReturnValueFromArray('cityId', $postedAdsArray);

            $address = self::checkKeyAndReturnValueFromArray('address', $postedAdsArray);
            $active = self::checkKeyAndReturnValueFromArray('active', $postedAdsArray);

            $categoryId = self::checkKeyAndReturnValueFromArray('categoryId', $postedAdsArray);
            $subCategoryId = self::checkKeyAndReturnValueFromArray('subCategoryId', $postedAdsArray);
            $itemId = self::checkKeyAndReturnValueFromArray('itemId', $postedAdsArray);

            $adsTitle = self::checkKeyAndReturnValueFromArray('adsTitle', $postedAdsArray);
            $description = self::checkKeyAndReturnValueFromArray('description', $postedAdsArray);
            $actualPrice = self::checkKeyAndReturnValueFromArray('actualPrice', $postedAdsArray);
            $offerPrice = self::checkKeyAndReturnValueFromArray('offerPrice', $postedAdsArray);

            $adsUpdateString = "";

            if($resultEditableAds['noOfDaysToActive'] != $noOfDaysToActive && $noOfDaysToActive != ""){
                $historyString .= " No.of Days To Active  was changed from ".$resultEditableAds['noOfDaysToActive']." to ".$noOfDaysToActive.", ";
                $adsUpdateString .= " noOfDaysToActive = ".$this->db->escape($noOfDaysToActive).",";
            }

            if($resultEditableAds['startDate'] != $startDate && $startDate != ""){
                $historyString .= " Start Date  was changed from ".$resultEditableAds['startDate']." to ".$startDate.", ";
                $adsUpdateString .= " startDate = ".$this->db->escape($startDate).",";
                // update end date
                $endDate = date("Y-m-d H:i:s", strtotime("+" . $noOfDaysToActive . "days", strtotime($startDate)));

                $adsUpdateString .= " endDate = ".$this->db->escape($endDate).",";
            }

            if($resultEditableAds['countryId'] != $countryId && $countryId != ""){
                //Country was changed
                $historyString .= " Country was changed from ".$resultEditableAds['countryId']." to ".$countryId.", ";
                $adsUpdateString .= " countryId = ".$this->db->escape($countryId).",";
            }
            if($resultEditableAds['stateId'] != $stateId && $stateId != ""){
                //stateId was changed
                $historyString .= " State was changed from ".$resultEditableAds['stateId']." to ".$stateId.", ";
                $adsUpdateString .= " stateId = ".$this->db->escape($stateId).",";
            }
            if($resultEditableAds['cityId'] != $cityId && $cityId != ""){
                //$cityId was changed
                $historyString .= " City was changed from ".$resultEditableAds['cityId']." to ".$cityId.", ";
                $adsUpdateString .= " cityId = ".$this->db->escape($cityId).",";
            }
            if($resultEditableAds['adsTitle'] != $adsTitle && $adsTitle != ""){
                //adsTitle was changed
                $historyString .= " Ads Title was changed from ".$resultEditableAds['adsTitle']." to ".$adsTitle.", ";
                $adsUpdateString .= " adsTitle = ".$this->db->escape($adsTitle).",";

            }
            if($resultEditableAds['categoryId'] != $categoryId && $categoryId != ""){
                // categoryId was changed
                $historyString .= " Category was changed from ".$resultEditableAds['categoryId']." to ".$categoryId .", ";
                $adsUpdateString .= " categoryId = ".$this->db->escape($categoryId).",";
            }

            if($resultEditableAds['subCategoryId'] != $subCategoryId && $subCategoryId != ""){
                // subCategoryId was changed
                $historyString .= " Sub Category was changed from ".$resultEditableAds['subCategoryId']." to ".$subCategoryId.", ";
                $adsUpdateString .= " subCategoryId = ".$this->db->escape($subCategoryId).",";
            }

            self::deleteFromTblAdsExtras($adsId);
            $dynamicFieldsforAdPostArray = $this->Backend_model->getDynamicFieldsforAdPost("", $categoryId, $subCategoryId);
            for ($n = 0; $n < count($dynamicFieldsforAdPostArray); $n++) {
                $capturedVariableId = $dynamicFieldsforAdPostArray[$n]['capturedVariableId'];
                $dynamicInputType = $dynamicFieldsforAdPostArray[$n]['dynamicInputType'];
                $postKey = 'capturedvariablename_' . $capturedVariableId;
                $capturedVariableValue = self::checkKeyAndReturnValueFromArray($postKey, $postedAdsArray);
                if($capturedVariableValue != ""){
                    if ($dynamicInputType != "Check Box") {
                        $tblAdsExtrasArray['adsId'] = $adsId;
                        $tblAdsExtrasArray['capturedVariableId'] = $capturedVariableId;
                        $tblAdsExtrasArray['capturedVariableValue'] = $capturedVariableValue;
                        self::insertIntoTblAdsExtras($tblAdsExtrasArray);
                    } else {
                        $tblAdsExtrasArray['adsId'] = $adsId;
                        $tblAdsExtrasArray['capturedVariableId'] = $capturedVariableId;
                        for ($k = 0; $k < count($capturedVariableValue); $k++) {
                            $capturedVariableValueStr = $capturedVariableValue[$k];
                            $tblAdsExtrasArray['capturedVariableValue'] = $capturedVariableValueStr;
                            self::insertIntoTblAdsExtras($tblAdsExtrasArray);
                        }
                    }
                }
            }


//            echo "<pre>";
//            echo $categoryId."<br>";
//            echo $adsId."<br>";
//            echo $subCategoryId."<br>";

//            print_r($dynamicFieldsforAdPostArray);
//            print_r($postedAdsArray);
//            echo "</pre>";
            if($resultEditableAds['itemId'] != $itemId && $itemId != ""){
                // itemId was changed
                $historyString .= " item was changed from ".$resultEditableAds['itemId']." to ".$itemId.", ";
                $adsUpdateString .= " itemId = ".$this->db->escape($itemId).",";
            }
            if($resultEditableAds['active'] != $active && $active != ""){
                //active was changed
                $historyString .= " active was changed from ".$resultEditableAds['active']." to ".$active.", ";
                $adsUpdateString .= " active = ".$this->db->escape($active).",";
            }
            if($resultEditableAds['address'] != $address && $address != ""){
                //address was changed

                $historyString .= " address was changed ".$resultEditableAds['address']." from to ".$address.", ";
                $adsUpdateString .= " address = ".$this->db->escape($address).",";
            }
            if($resultEditableAds['description'] != $description && $description != ""){
                //description was changed
                $historyString .= " description was changed from ".$resultEditableAds['description']." to ".$description.", ";
                $adsUpdateString .= " description = ".$this->db->escape($description).",";
            }
            if($resultEditableAds['actualPrice'] != $actualPrice && $actualPrice != ""){
                //actualPrice was changed
                $historyString .= " Price was changed from ".$resultEditableAds['actualPrice']." to ".$actualPrice.",";
                $adsUpdateString .= " actualPrice = ".$this->db->escape($actualPrice).",";
            }
            if($resultEditableAds['offerPrice'] != $offerPrice && $offerPrice != ""){
                //offerPrice was changed
                $historyString .= " Offer Price was changed from ".$resultEditableAds['offerPrice']." to ".$offerPrice.",";
                $adsUpdateString .= " offerPrice = ".$this->db->escape($offerPrice).",";
            }

//            echo $historyString."<br>";

            $adsUpdateString = trim($adsUpdateString, ",");
            if($adsUpdateString != ""){

                $updateSql = "UPDATE `tbl_ads` SET ".$adsUpdateString." WHERE adsId=".$this->db->escape($adsId);
                $this->db->query($updateSql);

                $statusMsg = "Your ads details are updated successfully!";
                $output = array('status' => "1", 'message' => $statusMsg);
                $this->session->set_flashdata('output', $output);

            }


            // Get gallery list with status
            $galleryList = self::getAdsGallery($adsId, "");
            $galleryUpdateString = "";
            foreach($galleryList as $gallery){
                $adsGalleryId = $gallery['adsGalleryId'];
                $adsGalleryExistingActive = $gallery['active'];
                $chekFileNameKey = "updateFileStatus_".$adsGalleryId;

                $adsGalleryNewActive = self::checkKeyAndReturnValueFromArray($chekFileNameKey, $postedAdsArray);
                if($adsGalleryNewActive!="nochange" && $adsGalleryNewActive!=$adsGalleryExistingActive){
                    // update galley status
                    $historyString .= " Gallery status was changed from ".$adsGalleryExistingActive." to ".$adsGalleryNewActive;

                    $galleryUpdateString = " UPDATE `tbl_adsgallery` SET `active`=".$this->db->escape($adsGalleryNewActive)." WHERE `adsGalleryId` = ".$this->db->escape($adsGalleryId)."; ";

                    if($galleryUpdateString!=""){
                        $this->db->query($galleryUpdateString);
                    }
                }
            }
//            echo $historyString."<br>";
            // Upload New Gallery
            $adsCode = $resultEditableAds['adsCode'];
            $userid = $resultEditableAds['userid'];
            $userArray = self::getFrontendUsers($resultEditableAds['userid'], "");
            $userCode = $userArray[0]['userCode'];
            $galleryHistoryString = self::uploadMyGalleryFiles($adsId, $userCode, $adsCode, "Waiting", $userid, "", "update");

            $historyString .= $galleryHistoryString;

//            print_r($resultEditableAds);
        }
//        echo "</pre>";

//        echo "<pre>";
//        print_r($postedAdsArray);
//        echo "</pre>";
//        echo $historyString."<br>";
        if($historyString != ""){
            //History Update Start
            $createdAt = date("Y-m-d H:i:s");
            $fromIp = $this->Backend_model->getIpAddress();
//                        $action = 'Add';
            $description = "Response : ".$statusMsg.", Description : ".$historyString ;
            $pageName = "Edit My Ad";
            $pageUrl = 'editMyAds/'.$editAdsEncryptedId;
            $historyArray = array('actionId' => '0', 'description' => $description, 'action' => 'Update', 'userid' => $userid, 'active' => 'active', 'fromIp' => $fromIp, 'createdAt' => $createdAt, 'pageName' => $pageName, 'pageUrl' => $pageUrl);
            self::insertHistory($historyArray);
        }

        if($returnFormat != "json")
            redirect(base_url() . "editMyAds/".$editAdsEncryptedId);

    }

    public function uploadMyGalleryFiles($adsId, $userCode, $adsCode, $active, $userid, $historyMsg, $action){

        $postGalleryArray = $_FILES;
        if(count($postGalleryArray)>0){
            $fileselectArray = $postGalleryArray['fileselect'];
//            print_r($fileselectArray);
            if ($this->input->post('fileSubmit') && !empty($fileselectArray['name'])) {
                    $filesCount = count($_FILES['fileselect']['name']);

                    $existingFileActiveCount = self :: getGalleryActiveCount($adsId);
                    $currentImageCount = 0;
                    for ($i = 0; $i < $filesCount && $existingFileActiveCount<6; $i++) {
                        $currentImageCount++;
                        $existingFileActiveCount++;
                        $existingFileActiveCount."<br/>";
                        $selectedFileName = $_FILES['userFile']['name'] = $_FILES['fileselect']['name'][$i];
                        $selectedFileTempName = $_FILES['userFile']['tmp_name'] = $_FILES['fileselect']['tmp_name'][$i];
                        if ($selectedFileName != "" && $selectedFileTempName != "") {

                            $_FILES['userFile']['type'] = $_FILES['fileselect']['type'][$i];
                            $_FILES['userFile']['error'] = $_FILES['fileselect']['error'][$i];
                            $_FILES['userFile']['size'] = $_FILES['fileselect']['size'][$i];

                            $uploadPath = 'uploads/files/userads/';
                            $uploadPath = $uploadPath . $userCode ;
                            if (!is_dir($uploadPath)) {
                                mkdir($uploadPath, 0777, TRUE);
                            }

                            $uploadPath = $uploadPath ."/". $adsCode ;
                            if (!is_dir($uploadPath)) {
                                mkdir($uploadPath, 0777, TRUE);
                            }

                            $config['upload_path'] = $uploadPath;
//                            $config['allowed_types'] = 'gif|jpg|png';
                            $config['allowed_types'] = 'gif|jpeg|jpg|png';
                            $config['encrypt_name'] = TRUE;
                            //$config['max_size']	= '100';
                            //$config['max_width'] = '1024';
                            //$config['max_height'] = '768';

                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if ($this->upload->do_upload('userFile')) {
                                $fileData = $this->upload->data();
                                $uploadData[$i]['file_name'] = $fileData['file_name'];
                                $uploadData[$i]['createdAt'] = date("Y-m-d H:i:s");
                                $uploadData[$i]['active'] = $active;
                                $uploadData[$i]['fromIp'] = $_SERVER['REMOTE_ADDR'];
                                $uploadData[$i]['adsId'] = $adsId;

                                $image_data = $fileData;
                                $config["manipulation"]['source_image']      =   $image_data['full_path'];
                                $this->load->library('image_lib', $config["manipulation"]);
                                $config["manipulation"]['wm_text'] = '1stepshop.in';
                                $config["manipulation"]['wm_type'] = 'text';
                                $this->image_lib->initialize($config["manipulation"]);
                                $this->image_lib->watermark();


//                    $uploadData[$i]['modified'] = date("Y-m-d H:i:s");
                            } else {
                                $message = $this->upload->display_errors();
                                $status = "2";
                                $output = array('status' => $status, 'message' => $message);
                                $this->session->set_flashdata('output', $output);
//                                redirect(base_url() . "posting");
                            }
                        }
                    }

                    if (!empty($uploadData)) {
                        $historyMsg .= " With ".$filesCount." gallery images are uploaded";
                        //Insert files data into the database
                        $insert = self::insertAdGallery($uploadData);
                        if ($insert) {
                            if($action == "Add"){
                                $statusMsg = "Thank you for posting ad it will be activated within an hour";
                            } else {
                                $statusMsg = "Your gallery images are uploaded. it will be activated within an hour";
                            }
                            $output = array('status' => "1", 'message' => $statusMsg);
                        } else {
                            $statusMsg = "Some problem occurred, please try again.";
                            $output = array('status' => "2", 'message' => $statusMsg);
                        }
                        $this->session->set_flashdata('output', $output);

                        //History Update Start
                        $createdAt = date("Y-m-d H:i:s");
                        $fromIp = $this->Backend_model->getIpAddress();
//                        $action = 'Add';
                        $description = "Response : ".$statusMsg.", Description : ".$historyMsg ;
                        $pageName = "Ad Post";
                        $pageUrl = 'posting';
                        $historyArray = array('actionId' => '0', 'description' => $description, 'action' => $action, 'userid' => $userid, 'active' => 'active', 'fromIp' => $fromIp, 'createdAt' => $createdAt, 'pageName' => $pageName, 'pageUrl' => $pageUrl);
                        self::insertHistory($historyArray);
                        //History Update End

//                        redirect(base_url() . "posting");
                    }
                }
            return $historyMsg;
        }
    }

    public function getGalleryActiveCount($adsId){

        $sql = "SELECT count(adsId) as activeCount FROM `tbl_adsgallery` WHERE (active='active' || active='Waiting') and adsId= " . $this->db->escape($adsId);
        $executeQuery = $this->db->query($sql);
        $resultArray = $executeQuery->result_array();

        return $resultArray[0]['activeCount'];
    }

    public function checkKeyAndReturnValueFromArray($key, $checkArray){
        $value = "";
        if(key_exists($key,$checkArray)){
            $value = $checkArray[$key];
        }
        return $value;
    }

    public function deleteFromTblAdsExtras($adsId)
    {
        $deleteSql = "DELETE FROM `tbl_adsextras` WHERE  adsId = ". $this->db->escape($adsId);
        $this->db->query($deleteSql);
    }

    public function insertIntoTblAdsExtras($tblAdsExtrasArray)
    {

        $adsId = $tblAdsExtrasArray['adsId'];
        $capturedVariableId = $tblAdsExtrasArray['capturedVariableId'];
        $capturedVariableValue = $tblAdsExtrasArray['capturedVariableValue'];
        $insertSql = "INSERT INTO `tbl_adsextras`(`adsId`, `capturedVariableId`, `capturedVariableValue`) VALUES (" . $this->db->escape($adsId) . "," . $this->db->escape($capturedVariableId) . "," . $this->db->escape($capturedVariableValue) . ")";
        $this->db->query($insertSql);

    }
    public function getadsList($actionId, $categoryId, $subCategoryId, $itemId, $countryId, $stateId, $cityId, $status, $galleryStatus, $dynamicSearchData, $searchUserId, $getListFromPage, $rangeArray, $amountRange, $searchText, $withphoto, $myLatitude, $myLongitude, $orderBy, $withOutId, $page, $rec_limit)
    {

        $conditionQuery = "";
        $orderByquery = "";
        $resultArray = array();
        if ($categoryId != "" && $categoryId != "0" && $categoryId != null) {
            $conditionQuery .= " and ta.categoryId='" . $categoryId . "'";
        }
        if ($subCategoryId != "" && $subCategoryId != "0" && $subCategoryId != null) {
            $conditionQuery .= " and ta.subCategoryId='" . $subCategoryId . "'";
        }
        if ($itemId != "" && $itemId != "0" && $itemId != null) {
            $conditionQuery .= " and ta.itemId='" . $itemId . "'";
        }
        if ($actionId != "" && $actionId != "0" && $actionId != null) {
            $conditionQuery .= " and ta.adsId='" . $actionId . "'";
        }
        if ($withOutId != "" && $withOutId != "0" && $withOutId != null) {
            $conditionQuery .= " and ta.adsId!='" . $withOutId . "'";
        }
        if ($searchUserId != "" && $searchUserId != "0" && $searchUserId != null && $getListFromPage != "View My Bookmarked List") {
            $conditionQuery .= " and ta.userid='" . $searchUserId . "'";
        }
        if ($amountRange != "" && $amountRange != null) {
            $paramsplit = explode("-", $amountRange);
            $startPrice = $paramsplit[0];
            $endPrice = $paramsplit[1];
            if (($startPrice != "" && $startPrice != null) && ($endPrice != "" && $endPrice != null)) {
                $conditionQuery .= " and (( ta.offerPrice>=" . $startPrice . " and ta.offerPrice <=" . $endPrice." ) or ta.offerPrice='' or ta.offerPrice IS NULL) ";
            }
        }


//        if ($adsType != "" && $adsType != null) {
//            $conditionQuery .= " and adsType='" . $adsType . "'";
//        }
//        if ($transactionType != "" && $transactionType != null) {
//            $conditionQuery .= " and transactionType='" . $transactionType . "'";
//        }
        if ($countryId != "" && $countryId != "0" && $countryId != null) {
            $conditionQuery .= " and ta.countryId='" . $countryId . "'";
        }
        if ($stateId != "" && $stateId != "0" && $stateId != null) {
            $conditionQuery .= " and ta.stateId='" . $stateId . "'";
        }
        if ($cityId != "" && $cityId != "0" && $cityId != null) {
            $conditionQuery .= " and ta.cityId='" . $cityId . "'";
        }
        if ($searchText != "" && $searchText != null) {
            $conditionQuery .= " and ta.adsTitle like '%" . $searchText . "%'";
        }

        if ($getListFromPage == "adsList") {
            $status = "active";
        }

        if ($status != "" && $status != "0" && $status != null) {
            $conditionQuery .= " and ta.active='" . $status . "'";
        }

        //condition based ads start date and end date

        $currentDate = date("Y-m-d");

//        echo $getListFromPage;

//        if($getListFromPage != "View All My Ads" && $getListFromPage != "View My Bookmarked List" && $getListFromPage!="adsMaster" && $getListFromPage!="viewAds"){
        if($getListFromPage == "adsList"){
            $conditionQuery .= " and ta.startDate <= '" . $currentDate . "' and ta.endDate >=  '" . $currentDate . "' ";
        }


        //condition based ads start date and end date end

        if ($orderBy == "HTL") {
            $orderByquery .= " order by ta.offerPrice desc ";

        } else if ($orderBy == "LTH") {
            $orderByquery .= " order by ta.offerPrice  ";
        } else {
            $orderByquery .= " order by ta.createdAt desc";

        }

        $joincontion="";
        if ($withphoto != "" && $withphoto != "no" && $withphoto != null) {
           // $conditionQuery .= "and ta.adsId in (SELECT adsId FROM `tbl_adsextras` WHERE `capturedVariableId` in(" . $dynamicVariableIdList . ") and `capturedVariableValue` in(" . $dynamicValueList . "))";
            $joincontion.="INNER JOIN  (SELECT adsId FROM tbl_adsgallery  group by adsId ) wp on wp.adsId=ta.adsId";
        }


        if (($dynamicSearchData != "" && count($dynamicSearchData)> 0 && $dynamicSearchData != null) ) {
            $dynamicSearchCondition="";
            $dynamicVariableIdList="";
            foreach ($dynamicSearchData as $key => $value) {
                $dynamicVariableIdList .= "'" . $key . "',";
               //$dynamicSearchCondition.="(capturedVariableId='".$key."' and capturedVariableValue in(".$value.")) and ";
               $dynamicSearchCondition.="(capturedVariableId='".$key."' and capturedVariableValue in(".$value.")) or ";
           }
            $dynamicVariableIdList = trim($dynamicVariableIdList, ",");
            $dynamicSearchCondition = trim($dynamicSearchCondition, " or");

            $checkCategoryVariable = "SELECT capturedVariableId FROM `tbl_dynamicadsvariablemaster` WHERE `capturedVariableId` in(" . $dynamicVariableIdList . ") and  categoryId=" . $categoryId;
            $checkCategoryexecuteQuery = $this->db->query($checkCategoryVariable);
            $checkCatresultArray = $checkCategoryexecuteQuery->result_array();
            //  echo count($checkCatresultArray);
            if (count($checkCatresultArray) > 0 && $dynamicSearchCondition!="") {
                $conditionQuery .= " and ta.adsId in (SELECT adsId FROM `tbl_adsextras` WHERE ".$dynamicSearchCondition.")";
            }
        }

        //   echo "ss". count($rangeArray);
        //check dynamic range  varaiable start
        if ($rangeArray != "" && count($rangeArray) > 0 && $rangeArray != null) {
            $dynamicRangeVariableIdList = "";
            foreach ($rangeArray as $key => $value) {
                $dynamicRangeVariableIdList = "'" . $key . "',";

            }
            $dynamicRangeVariableIdList = trim($dynamicRangeVariableIdList, ",");

            $checkRangeWithCatVariable = "SELECT capturedVariableId FROM `tbl_dynamicadsvariablemaster` WHERE `capturedVariableId` in(" . $dynamicRangeVariableIdList . ") and  categoryId=" . $categoryId;
            $checkRangeWithCatexecuteQuery = $this->db->query($checkRangeWithCatVariable);
            $checkRangeWithCatresultArray = $checkRangeWithCatexecuteQuery->result_array();

            if (count($checkRangeWithCatresultArray) > 0) {
                foreach ($rangeArray as $key => $value) {
                    $fromrange = "";
                    $torange = "";
                    $textSearch = "";
                    if (array_key_exists('from', $rangeArray[$key])) {
                        $fromrange = $rangeArray[$key]['from'];
                    }
                    if (array_key_exists('to', $rangeArray[$key])) {
                        $torange = $rangeArray[$key]['to'];
                    }
                    if (array_key_exists('textSearch', $rangeArray[$key])) {
                        $textSearch = $rangeArray[$key]['textSearch'];
                    }
                    if ($fromrange != "" && $torange != "") {
                        $conditionQuery .= " and ta.adsId in (SELECT adsId FROM `tbl_adsextras` WHERE `capturedVariableId`='" . $key . "' and `capturedVariableValue` between " . $fromrange . " and " . $torange . " )";

                    }
                    if ($textSearch != "") {
                        $conditionQuery .= " and ta.adsId in (SELECT adsId FROM `tbl_adsextras` WHERE `capturedVariableId`='" . $key . "' and `capturedVariableValue` like '%" . $textSearch . "%' )";

                    }


                }
            }
        }
        //check dynamic range  varaiable end


        // View Bookmark List
        if ($getListFromPage == "View My Bookmarked List") {
            $bookmarkArray = self::getMyBookMarkList($searchUserId);
            $bookmarkedAdsId = "";
            for ($n = 0; $n < count($bookmarkArray); $n++) {
                $bookmarkedAdsId .= $bookmarkArray[$n]['adsId'] . ",";
            }
            $bookmarkedAdsId = trim($bookmarkedAdsId, ",");
            if ($bookmarkedAdsId != "" && $bookmarkedAdsId != null) {
                $conditionQuery .= " and ta.adsId in (" . $bookmarkedAdsId . ")";
            }
        }

        $nearByYouAdsSelect = "";
//        $myLatitude = "13";
//        $myLongitude = "80";
        $myNearByDistance = "1000";
        if ($getListFromPage == "Near By You Ads") {
            if($myLatitude=="" || $myLongitude == ""){
                $myLatitude = "0";
                $myLongitude = "0";
            }
            $nearByYouAdsSelect = " , ( 3959 * acos( cos( radians(".$myLatitude.") ) * cos( radians( ta.latitude ) ) * cos( radians( ta.longitude ) - radians(".$myLongitude.") ) + sin( radians(".$myLatitude.") ) * sin( radians( ta.latitude ) ) ) ) AS distance ";
            $conditionQuery .= " HAVING distance < ".$myNearByDistance." ORDER BY distance";
            $orderByquery = "";
        }


        $left_rec = 0;
        // echo $dynamicVariableIdList;

        $conditionQuery = trim($conditionQuery, " and");
        if ($conditionQuery != "") {
            $paginationLimit = "";
            if ($rec_limit != "All" && is_numeric($rec_limit)) {
                $countquery = "select COUNT(ta.adsId) as count from tbl_ads ta WHERE " . $conditionQuery;
                if ($getListFromPage == "Near By You Ads") {
                    $countquery = "select COUNT(ta.adsId) as count ".$nearByYouAdsSelect." from tbl_ads ta " . $conditionQuery;
                }
                $paginationArray = self::paginationFunction($rec_limit, $page, $countquery);

                $left_rec = $paginationArray['left_rec'];
                $paginationLimit = $paginationArray['paginationLimit'];
                $page = $paginationArray['page'];
                $rec_limit = $paginationArray['rec_limit'];

            }
            if($galleryStatus == "" || $galleryStatus == null){
                $galleryStatus = "active";
            }

            $selectquery = "SELECT ta.`adsId`, ta.adsCode, ta.`adsTitle`, ta.`description`,ta.`actualPrice`,ta.`offerPrice`, ta.`noOfDaysToActive`, ta.`startDate`, ta.`endDate`, ta.`categoryId`, ta.`subCategoryId`, ta.`itemId`, ta.`address`, ta.`cityId`, ta.`stateId`, ta.`countryId`, ta.`userid`, ta.`active`, ta.`fromIp`, ta.`createdAt`, tuser.userCode, c.category, s.subCategory, i.item, co.country, ts.state, tc.district as city,g.file_name ".$nearByYouAdsSelect." FROM `tbl_ads` ta LEFT JOIN tbl_category c on c.categoryId=ta.categoryId LEFT JOIN tbl_subcategory s on s.subCategoryId=ta.subCategoryId LEFT JOIN tbl_item i on i.itemId=ta.itemId LEFT JOIN tbl_country co on co.countryId=ta.countryId LEFT JOIN tbl_state ts on ts.stateId=ta.stateId LEFT JOIN  tbl_user tuser on tuser.userid=ta.userid LEFT JOIN tbl_district tc on tc.districtId=ta.cityId LEFT JOIN (SELECT adsg.adsId , adsg.file_name FROM tbl_adsgallery adsg where adsg.active='".$galleryStatus."' group by adsg.adsId ) g on g.adsId=ta.adsId ".$joincontion;
            // This line added for having condition not working
            if ($getListFromPage != "Near By You Ads") {
                $selectquery .= " WHERE " ;
            }

//            echo $conditionQuery;
            $selectquery .= $conditionQuery . " " . $orderByquery . " " . $paginationLimit;

            $executeQuery = $this->db->query($selectquery);
            $resultArray = $executeQuery->result_array();
        }
        $adsArrayList['rec_limit'] = $rec_limit;
        $adsArrayList['left_rec'] = $left_rec;
        $adsArrayList['page'] = $page;
        $adsArrayList['resultArrayData'] = $resultArray;

        return $adsArrayList;
    }

    public function updateAdsViewed($adsId, $ipAddress, $userId)
    {
        if ($adsId && ($ipAddress != "" || $userId != "")) {
            $conditionQuery = "";

            if ($ipAddress != "" && $ipAddress != "0" && $ipAddress != null) {
                $conditionQuery .= " and ipAddress='" . $ipAddress . "'";
            }
            if ($userId != "" && $userId != "0" && $userId != null) {
                $conditionQuery .= " and userId='" . $userId . "'";
            }
            if ($adsId != "" && $adsId != "0" && $adsId != null) {
                $conditionQuery .= " and adsId='" . $adsId . "'";
            }
            $conditionQuery = trim($conditionQuery, " and");
            if ($conditionQuery != "") {
                $selectquery = "SELECT * FROM `tbl_adsviewed` WHERE " . $conditionQuery;
                $checkexecuteQuery = $this->db->query($selectquery);
                $checkresultArray = $checkexecuteQuery->result_array();
                if (count($checkresultArray) == 0) {
                    $newdate = new DateTime("now");
                    $now = $createdAt = date_format($newdate, "Y-m-d H:i:s");

                    $insertSql = "INSERT INTO `tbl_adsviewed`( `adsId`,`ipAddress`, `userId`, createAt) VALUES (" . $this->db->escape($adsId) . "," . $this->db->escape($ipAddress) . "," . $this->db->escape($userId) . "," . $this->db->escape($createdAt) . ")";
                    $this->db->query($insertSql);
                }
            }

        }


    }

    public function  getAdsViewedCount($adsId)
    {
        $countquery = "select COUNT(*) as count from tbl_adsviewed  WHERE adsId='" . trim($adsId) . "'";
        $checkexecuteQuery = $this->db->query($countquery);
        $checkresultArray = $checkexecuteQuery->result_array();
        // print_r($checkresultArray);
        return $rec_count = $checkresultArray[0]['count'];
    }

    public function  updateReportAboutAds($reportingId, $adsId, $fromIP, $description, $userId)
    {
        $newdate = new DateTime("now");
        $now = $createdAt = date_format($newdate, "Y-m-d H:i:s");

        $insertSql = "INSERT INTO `tbl_adsreportinguser`(`reportingId`, `adsId`, `fromIp`, `description`, `createdAt`) VALUES (" . $this->db->escape($reportingId) . "," . $this->db->escape($adsId) . "," . $this->db->escape($fromIP) . "," . $this->db->escape($description) . "," . $this->db->escape($createdAt) . ")";
        $this->db->query($insertSql);

    }

    public function getAdsGallery($adsId, $status)
    {

        $condition = "";
        $resultArray = array();
        if ($adsId != "" && $adsId != null) {
            $condition = $condition . " adsId = " . $this->db->escape($adsId) . " and";
        }
        if ($status != "" && $status != null) {
            $condition = $condition . " active= " . $this->db->escape($status) . " and";
        } else {
            $status = "deleted";
            $condition = $condition . " active!= " . $this->db->escape($status) . " and";
        }

        if ($condition != null && $condition != "") {
            $condition = trim($condition, "and");
            $sql = "SELECT * FROM `tbl_adsgallery` WHERE " . $condition;
            $executeQuery = $this->db->query($sql);
            $resultArray = $executeQuery->result_array();
        }

        return $resultArray;

    }

    public function getSingleAdsDetails($adsId)
    {
        $selectquery = "SELECT ta.`adsId`, ta.adsCode, ta.`adsTitle`,ta.`actualPrice`,ta.`offerPrice`, ta.`description`, ta.`noOfDaysToActive`, ta.`startDate`, ta.`endDate`, ta.`categoryId`, ta.`subCategoryId`, ta.`itemId`, ta.`address`, ta.`cityId`, ta.`stateId`, ta.`countryId`, ta.`userid`, ta.`active`, ta.`fromIp`, ta.`createdAt`,  tu.mobile, tu.userCode, tu.name, c.category,c.orders, s.subCategory, i.item, co.country, ts.state, tc.district as city FROM `tbl_ads` ta LEFT JOIN tbl_category c on c.categoryId=ta.categoryId LEFT JOIN tbl_subcategory s on s.subCategoryId=ta.subCategoryId LEFT JOIN tbl_item i on i.itemId=ta.itemId LEFT JOIN tbl_country co on co.countryId=ta.countryId LEFT JOIN tbl_state ts on ts.stateId=ta.stateId LEFT JOIN tbl_district tc on tc.districtId=ta.cityId LEFT JOIN tbl_user tu on tu.userid=ta.userid WHERE ta.adsId='" . $adsId . "' ";
        $executeQuery = $this->db->query($selectquery);
        $resultArray = $executeQuery->result_array();
        return $resultArray;
    }

    public function getSingleAdsDynamicDetails($adsId)
    {

        $selectquery = "SELECT dm.capturedvariablename, e.capturedVariableValue from tbl_adsextras e  LEFT JOIN tbl_dynamicadsvariablemaster dm on dm.capturedVariableId=e.capturedVariableId  WHERE adsId='" . $adsId . "' ";
        $executeQuery = $this->db->query($selectquery);
        $resultArray = $executeQuery->result_array();
        // print_r($resultArray);
        return $resultArray;
    }

    public function getRows($id = '')
    {
        $this->db->select('id,file_name,created');
        $this->db->from('files');
        if ($id) {
            $this->db->where('id', $id);
            $query = $this->db->get();
            $result = $query->row_array();
        } else {
            $this->db->order_by('created', 'desc');
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return !empty($result) ? $result : false;
    }

    public function insertAdGallery($data = array())
    {
        $insert = $this->db->insert_batch('tbl_adsgallery', $data);
        return $insert ? true : false;
    }

    public function getStateAndCityId($state, $city)
    {
        $result = array();

        $sql = "Select s.stateId, c.districtId from tbl_state s left JOIN tbl_district c on c.stateId=s.stateId and c.district='" . $city . "' where s.state='" . $state . "' ";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        $result['state'] = $state;
        $result['city'] = $city;

        return $result;
    }

    public function getCategoryAdsCount($categoryId, $cityId)
    {
        $conditionQuery = "";
        $resultArray = array();
        if ($categoryId != "" && $categoryId != null) {
            $conditionQuery .= " and categoryId='" . $categoryId . "'";
        }
        if ($cityId != "" && $cityId != null) {
            $conditionQuery .= " and cityId='" . $cityId . "'";
        }


        //condition based ads start date and end date

        $currentDate = date("Y-m-d");

        $conditionQuery .= " and startDate <= '" . $currentDate . "' and endDate >=  '" . $currentDate . "' ";


        //condition based ads start date and end date end

        $conditionQuery .= " and   `active`='active'";
        $conditionQuery = trim($conditionQuery, " and");
        if ($conditionQuery != "") {
            $selectquery = "SELECT `categoryId`,count(categoryId) FROM `tbl_ads`  WHERE " . $conditionQuery . "  group by categoryId ";
        } else {
            $selectquery = "SELECT `categoryId`,count(categoryId) FROM `tbl_ads` group by categoryId";
        }
        $executeQuery = $this->db->query($selectquery);
        $resultArray = $executeQuery->result_array();

        return $resultArray;


    }

    public function insertContactUS($contactUsArray)
    {

        $name = $contactUsArray['name'];
        $email = $contactUsArray['email'];
        $mobileNumber = $contactUsArray['mobileNumber'];
        $categoryId = $contactUsArray['categoryId'];
        $description = $contactUsArray['description'];
        $active = $contactUsArray['active'];
        $fromIp = $contactUsArray['fromIp'];
        $createdAt = $contactUsArray['createdAt'];

        $tomailIdArray = array($email);
        $message = "Dear ".$name.", <br/><br/>";
        $message .= "Thank you for contacting us. Your below submited details are send to our support team. We will get in touch with you within 24hrs..."."<br/><br/>";
        $message .= " Name : ".$name."<br/><br/>";
        $message .= " Email : ".$email."<br/><br/>";
        $message .= " Mobile Number : ".$mobileNumber."<br/><br/>";
        $message .= " Category : ".$categoryId."<br/><br/>";
        $message .= " Message : ".$description."<br/><br/>";
        $message .= " Cantact At : ".$createdAt."<br/><br/>";
        $message .= "Regards, "."<br/><br/>";
        $message .= "Support Team, "."<br/>";
        $message .= "1stepshop.in ". "<br/>";
        $subject = "Contact Us post confirmation from 1stepshop.in";
        $sendResponse = $this->Backend_model->sendEmail(null, null, $tomailIdArray, $subject, $message);

        $insertSql = "INSERT INTO `tbl_contactus`(`name`, `email`, `mobileNumber`, categoryId, description, active, fromIp, createdAt) VALUES (" . $this->db->escape($name) . "," . $this->db->escape($email) . "," . $this->db->escape($mobileNumber) . "," . $this->db->escape($categoryId) . "," . $this->db->escape($description) . "," . $this->db->escape($active) . "," . $this->db->escape($fromIp) . "," . $this->db->escape($createdAt) . ")";
        return $this->db->query($insertSql);
    }

    public function insertHistory($historyArray)
    {

        $action = $historyArray['action'];
        $pageName = $historyArray['pageName'];
        $pageUrl = $historyArray['pageUrl'];
        $userid = $historyArray['userid'];
        $description = $historyArray['description'];
        $active = $historyArray['active'];
        $fromIp = $historyArray['fromIp'];
        $createdAt = $historyArray['createdAt'];

        $insertSql = "INSERT INTO `tbl_history`(pageName, pageUrl, `action`, `userid`, description, active, fromIp, createdAt) VALUES (" . $this->db->escape($pageName) . "," . $this->db->escape($pageUrl) . "," . $this->db->escape($action) . "," . $this->db->escape($userid) . "," . $this->db->escape($description) . "," . $this->db->escape($active) . "," . $this->db->escape($fromIp) . "," . $this->db->escape($createdAt) . ")";
        return $this->db->query($insertSql);
    }

    public function getAllUsersHistory($userId, $status, $page, $rec_limit)
    {
        $historyArray = array();
        $resultArray = array();
        $conditionQuery = "WHERE active=" . $this->db->escape($status) . " and userId = " . $this->db->escape($userId);
        $paginationLimit = "";
        $left_rec = 0;

        if ($userId != "") {

            if ($rec_limit != "All" && is_numeric($rec_limit)) {
                $countquery = "select COUNT(id) as count from tbl_history " . $conditionQuery;
                $paginationArray = self::paginationFunction($rec_limit, $page, $countquery);

                $left_rec = $paginationArray['left_rec'];
                $paginationLimit = $paginationArray['paginationLimit'];
                $page = $paginationArray['page'];
                $rec_limit = $paginationArray['rec_limit'];
            }

            $selectquery = "select * from tbl_history " . $conditionQuery . " order by id desc" . $paginationLimit;
            $executeQuery = $this->db->query($selectquery);
            $resultArray = $executeQuery->result_array();
        }

        $historyArray['rec_limit'] = $rec_limit;
        $historyArray['left_rec'] = $left_rec;
        $historyArray['page'] = $page;
        $historyArray['resultArrayData'] = $resultArray;

        return $historyArray;
    }

    public function paginationFunction($rec_limit, $page, $countquery)
    {
        $paginationArray = array();

        $executeQuery = $this->db->query($countquery);
        $countArray = $executeQuery->result_array();
        $rec_count = 0;
        if($countArray!=null){
            $rec_count = $countArray[0]['count'];
        }


        if ((isset($page) && $page != "") || $page == "0") {
            $offset = $rec_limit * $page;
            $page = $page + 1;
        } else {
            $page = 0;
            $offset = 0;
        }

        $left_rec = $rec_count - ($page * $rec_limit);
        if ($page == "" || $page == 0) {
            $left_rec = $rec_count - (1 * $rec_limit);
        }

        $paginationLimit = " LIMIT $offset, $rec_limit ";

        $paginationArray['left_rec'] = $left_rec;
        $paginationArray['page'] = $page;
        $paginationArray['rec_limit'] = $rec_limit;
        $paginationArray['paginationLimit'] = $paginationLimit;

        return $paginationArray;

    }

    public function insertAdsBookmark($adsBookmarkArray)
    {

        $userId = $adsBookmarkArray['userId'];
        $adsId = $adsBookmarkArray['adsId'];
        $active = $adsBookmarkArray['active'];
        $fromIp = $adsBookmarkArray['fromIp'];
        $createdAt = $adsBookmarkArray['createdAt'];
        $insertSql = "INSERT INTO `tbl_adsbookmark`(`userId`, adsId, active, fromIp, createdAt) VALUES (" . $this->db->escape($userId) . "," . $this->db->escape($adsId) . "," . $this->db->escape($active) . "," . $this->db->escape($fromIp) . "," . $this->db->escape($createdAt) . ")";
        return $this->db->query($insertSql);
    }

    public function deleteAdsBookmark($adsBookmarkArray){
        $userId = $adsBookmarkArray['userId'];
        $adsId = $adsBookmarkArray['adsId'];
        $active = $adsBookmarkArray['active'];

        $insertSql = "UPDATE `tbl_adsbookmark` SET active=".$this->db->escape($active)."  WHERE userId=".$this->db->escape($userId)." and adsId=".$this->db->escape($adsId);
        return $this->db->query($insertSql);
    }

    public function getMyBookMarkList($userId)
    {
        $bookmarArray = array();
        if ($userId != "") {
            $selectquery = "select adsId from tbl_adsbookmark WHERE active='active' and userId = " . $this->db->escape($userId) . " group by adsId";
            $executeQuery = $this->db->query($selectquery);
            $bookmarArray = $executeQuery->result_array();
        }
        return $bookmarArray;
    }

    function encryptor($action, $string)
    {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        //pls set your unique hashing key
        $secret_key = '1stepshop';
        // $secret_iv = 'muni123';
        $secret_iv = 'shop123';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        //do the encyption given text/string/number
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            //decrypt the given text/string/number
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }
}


?>
