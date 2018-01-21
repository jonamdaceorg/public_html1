<?php

/**
 * Created by IntelliJ IDEA.
 * User: root
 * Date: 9/10/16
 * Time: 11:38 PM
 */
class Backend_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function updateCategoryMaster($CategoryDetailsArray)
    {

        $orders = $CategoryDetailsArray['orders'];
        $isAmountRequired = $CategoryDetailsArray['isAmountRequired'];
        $isOfferAmountRequired = $CategoryDetailsArray['isOfferAmountRequired'];

        $sql = "UPDATE tbl_category set category = " . $this->db->escape($CategoryDetailsArray['category']) . " , isAmountRequired= " . $this->db->escape($isAmountRequired) . ", isOfferAmountRequired= " . $this->db->escape($isOfferAmountRequired) . ", orders= " . $this->db->escape($orders) . " where categoryId = " . $this->db->escape($CategoryDetailsArray['categoryId']);
        return $this->db->query($sql);
    }

    public function deleteCategoryMaster($CategoryTypeDetailsArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_category set active = " . $this->db->escape($active) . " where categoryId = " . $this->db->escape($CategoryTypeDetailsArray['categoryId']);
        return $this->db->query($sql);
    }

    public function createCategoryMaster($CategoryDetailsArray)
    {
        $active = "active";
        $sql = "INSERT INTO tbl_category (category, isAmountRequired,isOfferAmountRequired, orders, active,createdAt,fromIp) " . "VALUES (" . $this->db->escape($CategoryDetailsArray['category']) . "," . $this->db->escape($CategoryDetailsArray['isAmountRequired']) . "," . $this->db->escape($CategoryDetailsArray['isOfferAmountRequired']) . "," . $this->db->escape($CategoryDetailsArray['orders']) . "," . $this->db->escape($active) . "," . $this->db->escape($CategoryDetailsArray['createdAt']) . "," . $this->db->escape($CategoryDetailsArray['fromIp']) . ")";
        $this->db->query($sql);
    }

    //Ads Banner Master Update, delete, create Action
    public function updateAdBannerMaster($adBannerDetailsArray)
    {
        $bannerTitle = $adBannerDetailsArray['bannerTitle'];
        $description = $adBannerDetailsArray['description'];
        $bannerType = $adBannerDetailsArray['bannerType'];
        $bannerImage = $adBannerDetailsArray['bannerImage'];
        $bannerImageUrl = $adBannerDetailsArray['bannerImageUrl'];
        $bannerAdsCode = $adBannerDetailsArray['bannerAdsCode'];
        $bannerLinkURL = $adBannerDetailsArray['bannerLinkURL'];
        $typeOfPosition = $adBannerDetailsArray['typeOfPosition'];
        $startDate = $adBannerDetailsArray['startDate'];
        $endDate = $adBannerDetailsArray['endDate'];
        $height = $adBannerDetailsArray['height'];
        $width = $adBannerDetailsArray['width'];
        $adBannerId = $adBannerDetailsArray['adBannerId'];
        $isMobileView = $adBannerDetailsArray['isMobileView'];

        $sql = "UPDATE tbl_adbanner set title = " . $this->db->escape($bannerTitle) . ", isMobileView = " . $this->db->escape($isMobileView) . ", description = " . $this->db->escape($description) . " , bannerType = " . $this->db->escape($bannerType) . " , bannerImage = " . $this->db->escape($bannerImage) . " , bannerImageUrl = " . $this->db->escape($bannerImageUrl) . " , adsCode = " . $this->db->escape($bannerAdsCode) . " , bannerLinkURL = " . $this->db->escape($bannerLinkURL) . ", typeOfPosition = " . $this->db->escape($typeOfPosition) . ", startDate = " . $this->db->escape($startDate) . " , endDate= " . $this->db->escape($endDate) . ", width= " . $this->db->escape($width) . ", height= " . $this->db->escape($height) . " where adBannerId = " . $this->db->escape($adBannerId);
        return $this->db->query($sql);
    }

    public function deleteAdBannerMaster($adBannerDetailsArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_adbanner set active = " . $this->db->escape($active) . " where adBannerId = " . $this->db->escape($adBannerDetailsArray['adBannerId']);
        return $this->db->query($sql);
    }

    public function createAdBannerMaster($adBannerDetailsArray)
    {
        $bannerTitle = $adBannerDetailsArray['bannerTitle'];
        $description = $adBannerDetailsArray['description'];
        $bannerType = $adBannerDetailsArray['bannerType'];
        $bannerImage = $adBannerDetailsArray['bannerImage'];
        $bannerImageUrl = $adBannerDetailsArray['bannerImageUrl'];
        $bannerAdsCode = $adBannerDetailsArray['bannerAdsCode'];
        $bannerLinkURL = $adBannerDetailsArray['bannerLinkURL'];
        $typeOfPosition = $adBannerDetailsArray['typeOfPosition'];
        $startDate = $adBannerDetailsArray['startDate'];
        $endDate = $adBannerDetailsArray['endDate'];
        $height = $adBannerDetailsArray['height'];
        $width = $adBannerDetailsArray['width'];
        $isMobileView = $adBannerDetailsArray['isMobileView'];
        $noOfDaysToActive = "";

        $active = "active";
        $sql = "INSERT INTO tbl_adbanner ( title, description, startDate, endDate, noOfDaysToActive, isMobileView, typeOfPosition, height, width, bannerType, bannerLinkURL, bannerImage, bannerImageUrl, adsCode, active, fromIp, createdAt ) VALUES (" . $this->db->escape($bannerTitle) . "," . $this->db->escape($description) . "," . $this->db->escape($startDate) . "," . $this->db->escape($endDate) . "," . $this->db->escape($noOfDaysToActive) . "," . $this->db->escape($isMobileView) . "," . $this->db->escape($typeOfPosition) . "," . $this->db->escape($height) . "," . $this->db->escape($width) . "," . $this->db->escape($bannerType) . "," . $this->db->escape($bannerLinkURL) . "," . $this->db->escape($bannerImage) . "," . $this->db->escape($bannerImageUrl) . "," . $this->db->escape($bannerAdsCode) . "," . $this->db->escape($active) . "," . $this->db->escape($adBannerDetailsArray['fromIp']) . "," . $this->db->escape($adBannerDetailsArray['createdAt']) . ")";
        $this->db->query($sql);
    }

    //Sub category Master Update, delete, create Action
    public function updateSubCategoryMaster($CategoryDetailsArray)
    {
        $sql = "UPDATE tbl_subcategory set subCategory = " . $this->db->escape($CategoryDetailsArray['subCategory']) . ", categoryId = " . $this->db->escape($CategoryDetailsArray['categoryId']) . " where subCategoryId = " . $this->db->escape($CategoryDetailsArray['subCategoryId']);
        return $this->db->query($sql);
    }

    public function deleteSubCategoryMaster($CategoryTypeDetailsArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_subcategory set active = " . $this->db->escape($active) . " where subCategoryId = " . $this->db->escape($CategoryTypeDetailsArray['subCategoryId']);
        return $this->db->query($sql);
    }

    public function createSubCategoryMaster($CategoryDetailsArray)
    {
        $active = "active";
        $sql = "INSERT INTO tbl_subcategory (`categoryId`, `subCategory`, `active`, `createdAt`, `fromIp`) " . "VALUES (" . $this->db->escape($CategoryDetailsArray['categoryId']) . "," . $this->db->escape($CategoryDetailsArray['subCategory']) . "," . $this->db->escape($active) . "," . $this->db->escape($CategoryDetailsArray['createdAt']) . "," . $this->db->escape($CategoryDetailsArray['fromIp']) . ")";
        $this->db->query($sql);
    }

    public function getCategoryList($actionId, $orderBy)
    {

        $categoryArray = array();
        $sql = "SELECT * FROM `tbl_category` t WHERE t.active = 'active' ";
        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $sql .= " and t.categoryId = '" . $actionId . "' ";
        }
//        $sql = $sql . " order by categoryId ".$orderBy;
        //Order By condition
        if ($orderBy != null && $orderBy != "") {
            $sql = $sql . $orderBy;
        }

        $userQuery = $this->db->query($sql);

        $categoryArray = $userQuery->result_array();

        return $categoryArray;
    }

    public function getAdBannerList($actionId, $orderBy, $active)
    {
        $adBannerArray = array();
        $sql = "SELECT * FROM `tbl_adbanner` t ";

        $condition = "";
        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $condition .= " and t.adBannerId = '" . $actionId . "' ";
        }
        if ($active != "" && $active != null) {
            $condition .= " and t.active = '" . $active . "' ";
        }

        if($condition != ""){
            $condition = trim($condition, ' and ');

            $condition = " WHERE " . $condition;
        }
        $sql .= $condition;

        if ($orderBy != null && $orderBy != "") {
            $sql = $sql . $orderBy;
        }

        $adBannerArrayQuery = $this->db->query($sql);

        $adBannerArray = $adBannerArrayQuery->result_array();

        return $adBannerArray;
    }

    public function getReportAboutAdsList($actionId, $orderBy)
    {
        $categoryArray = array();
        $sql = "SELECT t.id,t.reportingId,t.adsId,t.fromIp,t.createdAt,arm.reportingType,t.description FROM `tbl_adsreportinguser` t left JOIN tbl_adsreportingmaster arm on arm.reportingId=t.reportingId WHERE t.active = 'active' ";
        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $sql .= " and t.id = '" . $actionId . "' ";
        }
//        $sql = $sql . " order by categoryId ".$orderBy;
        //Order By condition
        if ($orderBy != null && $orderBy != "") {
            $sql = $sql . $orderBy;
        }

        $userQuery = $this->db->query($sql);

        $categoryArray = $userQuery->result_array();

        return $categoryArray;
    }

    public function getSubCategoryList($actionId, $categoryId, $orderBy)
    {

        $categoryArray = array();
        $sql = "SELECT s.subCategoryId, s.categoryId, s.subCategory, s.active, s.fromIp, s.createdAt, c.category FROM `tbl_subcategory` s Left JOIN tbl_category c on c.categoryId = s.categoryId WHERE s.active = 'active' ";
        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $sql .= " and s.subCategoryId = '" . $actionId . "' ";
        }
        if ($categoryId != "" && $categoryId != null && $categoryId != "0" && $categoryId != 0) {
            $sql .= " and s.categoryId = '" . $categoryId . "' ";
        }
//        $sql = $sql . " order by s.subCategoryId desc";
        if ($orderBy != null && $orderBy != "") {
            $sql = $sql . $orderBy;
        }
        $userQuery = $this->db->query($sql);

        $categoryArray = $userQuery->result_array();

        return $categoryArray;
    }

    //Item Master start By Mathan 30 Oct 2016
    public function updateItemMaster($ItemDetailsArray)
    {
        $sql = "UPDATE tbl_item set item = " . $this->db->escape($ItemDetailsArray['item']) . ", subCategoryId = " . $this->db->escape($ItemDetailsArray['subCategoryId']) . ", categoryId = " . $this->db->escape($ItemDetailsArray['categoryId']) . " where itemId = " . $this->db->escape($ItemDetailsArray['itemId']);
        return $this->db->query($sql);
    }

    public function deleteItemMaster($ItemDetailsArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_item set active = " . $this->db->escape($active) . " where itemId = " . $this->db->escape($ItemDetailsArray['itemId']);
        return $this->db->query($sql);
    }

    public function createItemMaster($ItemDetailsArray)
    {
        $active = "active";
        $sql = "INSERT INTO tbl_item (`item`, `categoryId`, `subCategoryId`, `active`, `createdAt`, `fromIp`) " . "VALUES (" . $this->db->escape($ItemDetailsArray['item']) . ", " . $this->db->escape($ItemDetailsArray['categoryId']) . "," . $this->db->escape($ItemDetailsArray['subCategoryId']) . "," . $this->db->escape($active) . "," . $this->db->escape($ItemDetailsArray['createdAt']) . "," . $this->db->escape($ItemDetailsArray['fromIp']) . ")";
        $this->db->query($sql);
    }

    public function getItemList($actionId, $categoryId, $subCategoryId)
    {
        $sql = "SELECT i.itemId, i.item, i.subCategoryId, i.categoryId, i.active, i.fromIp, i.createdAt, c.category, s.subCategory FROM tbl_item i Left JOIN  `tbl_subcategory` s on i.subCategoryId=s.subCategoryId Left JOIN tbl_category c on c.categoryId = s.categoryId WHERE i.active = 'active' ";
        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $sql .= " and i.itemId = '" . $actionId . "' ";
        }
        if ($categoryId != "" && $categoryId != null && $categoryId != "0" && $categoryId != 0) {
            $sql .= " and i.categoryId = '" . $categoryId . "' ";
        }
        if ($subCategoryId != "" && $subCategoryId != null && $subCategoryId != "0" && $subCategoryId != 0) {
            $sql .= " and i.subCategoryId = '" . $subCategoryId . "' ";
        }
        $sql = $sql . " order by i.itemId desc";
        $itemQuery = $this->db->query($sql);
        $categoryArray = $itemQuery->result_array();
        return $categoryArray;
    }
    //Item Master End


    //country master start
    public function getCountryList($actionId)
    {

        $categoryArray = array();
        $sql = "SELECT * FROM `tbl_country` t WHERE t.active = 'active' ";
        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $sql .= " and t.countryId = '" . $actionId . "' ";
        }
        $sql = $sql . " order by countryId desc";
        $userQuery = $this->db->query($sql);

        $categoryArray = $userQuery->result_array();

        return $categoryArray;
    }

    public function createCountryMaster($CountryDetailsArray)
    {
        $active = "active";
        $sql = "INSERT INTO tbl_country (country,active,createdAt,fromIp) " . "VALUES (" . $this->db->escape($CountryDetailsArray['country']) . "," . $this->db->escape($active) . "," . $this->db->escape($CountryDetailsArray['createdAt']) . "," . $this->db->escape($CountryDetailsArray['fromIp']) . ")";
        $this->db->query($sql);
    }

    public function updateCountryMaster($CountryDetailsArray)
    {
        $sql = "UPDATE tbl_country set country = " . $this->db->escape($CountryDetailsArray['country']) . " where countryId = " . $this->db->escape($CountryDetailsArray['countryId']);
        return $this->db->query($sql);
    }

    public function deleteCountryMaster($CountryDetailsArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_country set active = " . $this->db->escape($active) . " where countryId = " . $this->db->escape($CountryDetailsArray['countryId']);
        return $this->db->query($sql);
    }
//country master end  

//state master start


    public function getStateList($actionId, $countryId, $orderBy)
    {

        $categoryArray = array();
        $sql = "SELECT s.stateId, s.countryId, s.state, s.active, s.fromIp, s.createdAt, c.country FROM `tbl_state` s Left JOIN tbl_country c on c.countryId = s.countryId WHERE s.active = 'active' ";
        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $sql .= " and s.stateId = '" . $actionId . "' ";
        }
        if ($countryId != "" && $countryId != null && $countryId != "0" && $countryId != 0) {
            $sql .= " and s.countryId = '" . $countryId . "' ";
        }
        if ($orderBy != null && $orderBy != "") {
            $sql = $sql . $orderBy;
        }

        $userQuery = $this->db->query($sql);

        $categoryArray = $userQuery->result_array();

        return $categoryArray;
    }

    public function updateStateMaster($StateDetailsArray)
    {
        $sql = "UPDATE tbl_state set state = " . $this->db->escape($StateDetailsArray['state']) . ", countryId = " . $this->db->escape($StateDetailsArray['countryId']) . " where stateId = " . $this->db->escape($StateDetailsArray['stateId']);
        return $this->db->query($sql);
    }

    public function deleteStateMaster($StateDetailsArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_state set active = " . $this->db->escape($active) . " where stateId = " . $this->db->escape($StateDetailsArray['stateId']);
        return $this->db->query($sql);
    }

    public function createStateMaster($StateDetailsArray)
    {
        $active = "active";
        $sql = "INSERT INTO tbl_state (`countryId`, `state`, `active`, `createdAt`, `fromIp`) " . "VALUES (" . $this->db->escape($StateDetailsArray['countryId']) . "," . $this->db->escape($StateDetailsArray['state']) . "," . $this->db->escape($active) . "," . $this->db->escape($StateDetailsArray['createdAt']) . "," . $this->db->escape($StateDetailsArray['fromIp']) . ")";
        $this->db->query($sql);
    }

    //state master end

    //District master start
    public function getDistrictList($actionId, $countryId, $stateId, $orderBy)
    {

        $districtArray = array();
        $sql = "SELECT s.districtId, s.countryId,s.stateId, s.district, s.active, s.fromIp, s.createdAt, c.state,m.country FROM `tbl_district` s Left JOIN tbl_state c on c.stateId = s.stateId Left JOIN tbl_country m on m.countryId = s.countryId WHERE s.active = 'active' ";
        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $sql .= " and s.districtId = '" . $actionId . "' ";
        }
        if ($countryId != "" && $countryId != null && $countryId != "0" && $countryId != 0) {
            $sql .= " and s.countryId = '" . $countryId . "' ";
        }
        if ($stateId != "" && $stateId != null && $stateId != "0" && $stateId != 0) {
            $sql .= " and s.stateId = '" . $stateId . "' ";
        }
        if ($orderBy != "" && $orderBy != null) {
            $sql = $sql . $orderBy;
        }

        $userQuery = $this->db->query($sql);

        $districtArray = $userQuery->result_array();

        return $districtArray;
    }

    public function updateDistrictMaster($districtDetailsArray)
    {
        $sql = "UPDATE tbl_district set district=" . $this->db->escape($districtDetailsArray['district']) . ",stateId = " . $this->db->escape($districtDetailsArray['stateId']) . ", countryId = " . $this->db->escape($districtDetailsArray['countryId']) . " where districtId = " . $this->db->escape($districtDetailsArray['districtId']);
        return $this->db->query($sql);
    }

    public function deleteDistrictMaster($districtDetailsArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_district set active = " . $this->db->escape($active) . " where districtId = " . $this->db->escape($districtDetailsArray['districtId']);
        return $this->db->query($sql);
    }

    public function createDistrictMaster($districtDetailsArray)
    {
        $active = "active";
        $sql = "INSERT INTO tbl_district (`district`,`countryId`, `stateId`, `active`, `createdAt`, `fromIp`) " . "VALUES (" . $this->db->escape($districtDetailsArray['district']) . "," . $this->db->escape($districtDetailsArray['countryId']) . "," . $this->db->escape($districtDetailsArray['stateId']) . "," . $this->db->escape($active) . "," . $this->db->escape($districtDetailsArray['createdAt']) . "," . $this->db->escape($districtDetailsArray['fromIp']) . ")";
        $this->db->query($sql);
    }
    //District master end

    //Sub District master start
    public function getSubDistrictList($actionId, $countryId, $stateId, $districtId)
    {
        $sql = "SELECT sd.subDistrictId, sd.countryId, sd.stateId, sd.districtId, sd.subDistrict, sd.active, sd.fromIp, sd.createdAt, s.district, c.state, m.country From tbl_subdistrict sd LEFT JOIN `tbl_district` s on s.districtId=sd.districtId Left JOIN tbl_state c on c.stateId = sd.stateId Left JOIN tbl_country m on m.countryId = sd.countryId WHERE sd.active = 'active' ";
        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $sql .= " and sd.subDistrictId = '" . $actionId . "' ";
        }
        if ($countryId != "" && $countryId != null && $countryId != "0" && $countryId != 0) {
            $sql .= " and sd.countryId = '" . $countryId . "' ";
        }
        if ($stateId != "" && $stateId != null && $stateId != "0" && $stateId != 0) {
            $sql .= " and sd.stateId = '" . $stateId . "' ";
        }

        if ($districtId != "" && $districtId != null && $districtId != "0" && $districtId != 0) {
            $sql .= " and sd.districtId = '" . $districtId . "' ";
        }
        $sql = $sql . " order by sd.subDistrictId desc";
        $subDistrictQuery = $this->db->query($sql);

        $subDistrictArray = $subDistrictQuery->result_array();
        return $subDistrictArray;
    }

    public function updateSubDistrictMaster($subDistrictDetailsArray)
    {
        $sql = "UPDATE tbl_subdistrict set subDistrict=" . $this->db->escape($subDistrictDetailsArray['subDistrict']) . ", districtId=" . $this->db->escape($subDistrictDetailsArray['districtId']) . ", stateId = " . $this->db->escape($subDistrictDetailsArray['stateId']) . ", countryId = " . $this->db->escape($subDistrictDetailsArray['countryId']) . " where subDistrictId = " . $this->db->escape($subDistrictDetailsArray['subDistrictId']);
        return $this->db->query($sql);
    }

    public function deleteSubDistrictMaster($subDistrictDetailsArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_subdistrict set active = " . $this->db->escape($active) . " where subDistrictId = " . $this->db->escape($subDistrictDetailsArray['subDistrictId']);
        return $this->db->query($sql);
    }

    public function createSubDistrictMaster($subDistrictDetailsArray)
    {
        $active = "active";
        $sql = "INSERT INTO tbl_subdistrict (`subDistrict`, `districtId`,`countryId`, `stateId`, `active`, `createdAt`, `fromIp`) " . "VALUES (" . $this->db->escape($subDistrictDetailsArray['subDistrict']) . "," . $this->db->escape($subDistrictDetailsArray['districtId']) . "," . $this->db->escape($subDistrictDetailsArray['countryId']) . "," . $this->db->escape($subDistrictDetailsArray['stateId']) . "," . $this->db->escape($active) . "," . $this->db->escape($subDistrictDetailsArray['createdAt']) . "," . $this->db->escape($subDistrictDetailsArray['fromIp']) . ")";
        $this->db->query($sql);
    }
    //Sub District master end

    //Reporting master start 

    public function getReportingList($actionId)
    {

        $categoryArray = array();
        $sql = "SELECT * FROM `tbl_adsreportingmaster` t WHERE t.active = 'active' ";
        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $sql .= " and t.reportingId = '" . $actionId . "' ";
        }
        $sql = $sql . " order by reportingId desc";
        $userQuery = $this->db->query($sql);

        $adsReportingArray = $userQuery->result_array();

        return $adsReportingArray;
    }

    public function createReportingMaster($adsReportingArray)
    {
        $active = "active";
        echo $sql = "INSERT INTO tbl_adsreportingmaster (reportingType,active,createdAt,fromIp) " . "VALUES (" . $this->db->escape($adsReportingArray['reportingType']) . "," . $this->db->escape($active) . "," . $this->db->escape($adsReportingArray['createdAt']) . "," . $this->db->escape($adsReportingArray['fromIp']) . ")";
        $this->db->query($sql);
    }

    public function updateReportingMaster($adsReportingArray)
    {
        $sql = "UPDATE tbl_adsreportingmaster set reportingType = " . $this->db->escape($adsReportingArray['reportingType']) . " where reportingId = " . $this->db->escape($adsReportingArray['reportingId']);
        return $this->db->query($sql);
    }

    public function deleteReportingMaster($adsReportingArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_adsreportingmaster set active = " . $this->db->escape($active) . " where reportingId = " . $this->db->escape($adsReportingArray['reportingId']);
        return $this->db->query($sql);
    }


    //Reporting master end

    // Start Dynamic Ads Variable Master
    public function getDynamicFieldsforAdPost($actionId, $categoryId, $subCategoryId)
    {
        $sql = "SELECT t.capturedVariableId ,t.isSearchable,t.searchType, t.capturedvariablename, t.categoryId, t.subCategoryId, t.active, t.fromIp, t.createdAt, c.category, s.subCategory, dim.dynamicInputType, dim.dynamicInputName, dim.dynamicInputId FROM `tbl_dynamicadsvariablemaster` t LEFT JOIN tbl_category c on c.categoryId=t.categoryId LEFT JOIN tbl_subcategory s on s.subCategoryId=t.subCategoryId LEFT JOIN tbl_dynamicinputmaster dim on dim.dynamicInputId=t.dynamicInputId WHERE t.active = 'active' ";
        // ." and t.subCategoryId = ".$this->db->escape($subCategoryId)

        if ($categoryId != "" && $categoryId != null && $categoryId != "0" && $categoryId != 0) {
            $sql .= " and t.categoryId = " . $this->db->escape($categoryId);
            $sql .= " and t.subCategoryId = " . $this->db->escape($subCategoryId);  // Must return the value in sub category By MM 22 Apr 2017
        }

        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $sql .= " and t.capturedVariableId = '" . $actionId . "' ";
        }
        $sql = $sql . " order by t.capturedVariableId desc";
        $userQuery = $this->db->query($sql);
        $dynamicAdsVariableList = $userQuery->result_array();
        return $dynamicAdsVariableList;
    }

    public function getDynamicAdsVariableList($actionId, $categoryId, $subCategoryId)
    {
        $sql = "SELECT t.isSearchable,t.searchType,t.capturedVariableId, t.capturedvariablename, t.dynamicInputId, t.categoryId, t.subCategoryId, t.active, t.fromIp, t.createdAt, c.category, s.subCategory, dim.dynamicInputType, dim.dynamicInputName FROM `tbl_dynamicadsvariablemaster` t LEFT JOIN tbl_category c on c.categoryId=t.categoryId LEFT JOIN tbl_subcategory s on s.subCategoryId=t.subCategoryId  LEFT JOIN tbl_dynamicinputmaster dim on dim.dynamicInputId=t.dynamicInputId WHERE t.active = 'active' ";
        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $sql .= " and t.capturedVariableId = '" . $actionId . "' ";
        }
//        if ($subCategoryId != "" && $subCategoryId != null && $subCategoryId != "0" && $subCategoryId != 0) {
//            $sql .= " and t.subCategoryId = '" . $subCategoryId . "' ";
//        }
        if ($categoryId != "" && $categoryId != null && $categoryId != "0" && $categoryId != 0) {
            $sql .= " and t.categoryId = '" . $categoryId . "' ";
            $sql .= " and t.subCategoryId = '" . $subCategoryId . "' ";  // Must return the value in sub category By MM 22 Apr 2017
        }
        $sql = $sql . " order by t.capturedVariableId desc";
        $userQuery = $this->db->query($sql);
        $dynamicAdsVariableList = $userQuery->result_array();
        return $dynamicAdsVariableList;
    }

    public function createDynamicFields($dynamicFieldsArray)
    {
        $searchType = $dynamicFieldsArray['searchType'];
        $isSearchable = $dynamicFieldsArray['isSearchable'];
        if ($isSearchable == "No") {
            $searchType = "";
        }
        $sql = "INSERT INTO tbl_dynamicadsvariablemaster (dynamicInputId, capturedvariablename, categoryId, subCategoryId, isSearchable, searchType, active, createdAt, fromIp) " . "VALUES (" . $this->db->escape($dynamicFieldsArray['dynamicInputId']) . "," . $this->db->escape($dynamicFieldsArray['capturedvariablename']) . "," . $this->db->escape($dynamicFieldsArray['categoryId']) . "," . $this->db->escape($dynamicFieldsArray['subCategoryId']) . "," . $this->db->escape($isSearchable) . "," . $this->db->escape($searchType) . "," . $this->db->escape($dynamicFieldsArray['active']) . "," . $this->db->escape($dynamicFieldsArray['createdAt']) . "," . $this->db->escape($dynamicFieldsArray['fromIp']) . ")";
        $successMsg = $this->db->query($sql);
        $capturedVariableId = $this->db->insert_id();

        return $successMsg;
    }

    public function updateDynamicFields($dynamicFieldsArray)
    {
        $searchType = $dynamicFieldsArray['searchType'];
        $isSearchable = $dynamicFieldsArray['isSearchable'];
        if ($isSearchable == "No") {
            $searchType = "";
        }

        $sql = "UPDATE tbl_dynamicadsvariablemaster set dynamicInputId= " . $this->db->escape($dynamicFieldsArray['dynamicInputId']) . ", isSearchable= " . $this->db->escape($isSearchable) . ", searchType= " . $this->db->escape($searchType) . ",  capturedvariablename= " . $this->db->escape($dynamicFieldsArray['capturedvariablename']) . ", categoryId=" . $this->db->escape($dynamicFieldsArray['categoryId']) . " , subCategoryId=" . $this->db->escape($dynamicFieldsArray['subCategoryId']) . " WHERE capturedVariableId=" . $this->db->escape($dynamicFieldsArray['capturedVariableId']);
        $successMsg = $this->db->query($sql);
        return $successMsg;
    }

    public function deleteDynamicFields($dynamicFieldsArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_dynamicadsvariablemaster set active=" . $this->db->escape($active) . " WHERE capturedVariableId=" . $this->db->escape($dynamicFieldsArray['capturedVariableId']);
        $successMsg = $this->db->query($sql);
        return $successMsg;
    }
    // End Dynamic Ads Variable Master

    //Start dynamic ads variable values master

    public function getDynamicAdsVariableValuesMaster($capturedVariableId)
    {
        $sql = "SELECT * FROM `tbl_dynamicadsvariablemaster` WHERE capturedVariableId=" . $this->db->escape($capturedVariableId);
        $query = $this->db->query($sql);
        $DynamicAdsVariableValuesMaster = $query->result_array();
        return $DynamicAdsVariableValuesMaster;
    }

    //End dynamic ads variable values master


    // Start Dynamic Input Master
    public function createDynamicInputMaster($dynamicInputMasterArray)
    {
        $sql = "INSERT INTO tbl_dynamicinputmaster (dynamicInputName, dynamicInputType, active, createdAt, fromIp) " . "VALUES (" . $this->db->escape($dynamicInputMasterArray['dynamicInputName']) . "," . $this->db->escape($dynamicInputMasterArray['dynamicInputType']) . "," . $this->db->escape($dynamicInputMasterArray['active']) . "," . $this->db->escape($dynamicInputMasterArray['createdAt']) . "," . $this->db->escape($dynamicInputMasterArray['fromIp']) . ")";
        $successMsg = $this->db->query($sql);
        return $successMsg;
    }

    public function updateDynamicInputMaster($dynamicInputMasterArray)
    {
        $sql = "UPDATE tbl_dynamicinputmaster set dynamicInputName = " . $this->db->escape($dynamicInputMasterArray['dynamicInputName']) . ", dynamicInputType= " . $this->db->escape($dynamicInputMasterArray['dynamicInputType']) . " WHERE dynamicInputId=" . $this->db->escape($dynamicInputMasterArray['dynamicInputId']);
        $successMsg = $this->db->query($sql);
        return $successMsg;
    }

    public function deleteDynamicInputMaster($dynamicInputMasterArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_dynamicinputmaster set active=" . $this->db->escape($active) . " WHERE dynamicInputId=" . $this->db->escape($dynamicInputMasterArray['dynamicInputId']);
        $successMsg = $this->db->query($sql);
        return $successMsg;
    }

    public function getDynamicInputMasterList($actionId, $dynamicInputType)
    {

        $sql = "SELECT t.dynamicInputId, t.dynamicInputName, t.dynamicInputType, t.active, t.fromIp, t.createdAt FROM `tbl_dynamicinputmaster` t WHERE t.active = 'active' ";
        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $sql .= " and t.dynamicInputId = '" . $actionId . "' ";
        }
        if ($dynamicInputType != "" && $dynamicInputType != null && $dynamicInputType != "0") {
            $sql .= " and t.dynamicInputType = '" . $dynamicInputType . "' ";
        }
        $sql = $sql . " order by t.dynamicInputId desc";
        $userQuery = $this->db->query($sql);
        $dynamicInputList = $userQuery->result_array();
        return $dynamicInputList;
    }
    // End Dynamic Input Master

    // Start Dynamic Input Value Master
    public function createDynamicInputValue($dynamicInputValueMasterArray)
    {
        $sql = "INSERT INTO tbl_dynamicinputvaluemaster (dynamicInputValue, dynamicInputId, active, createdAt, fromIp) " . "VALUES (" . $this->db->escape($dynamicInputValueMasterArray['dynamicInputValue']) . "," . $this->db->escape($dynamicInputValueMasterArray['dynamicInputId']) . "," . $this->db->escape($dynamicInputValueMasterArray['active']) . "," . $this->db->escape($dynamicInputValueMasterArray['createdAt']) . "," . $this->db->escape($dynamicInputValueMasterArray['fromIp']) . ")";
        $successMsg = $this->db->query($sql);
        return $successMsg;
    }

    public function updateDynamicInputValue($dynamicInputValueMasterArray)
    {
        $sql = "UPDATE tbl_dynamicinputvaluemaster set dynamicInputValue= " . $this->db->escape($dynamicInputValueMasterArray['dynamicInputValue']) . ", dynamicInputId=" . $this->db->escape($dynamicInputValueMasterArray['dynamicInputId']) . " WHERE dynamicInputValueId=" . $this->db->escape($dynamicInputValueMasterArray['dynamicInputValueId']);
        $successMsg = $this->db->query($sql);
        return $successMsg;
    }

    public function deleteDynamicInputValue($dynamicInputValueMasterArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_dynamicinputvaluemaster set active=" . $this->db->escape($active) . " WHERE dynamicInputValueId=" . $this->db->escape($dynamicInputValueMasterArray['dynamicInputValueId']);
        $successMsg = $this->db->query($sql);
        return $successMsg;
    }

    public function getDynamicInputValueList($actionId, $dynamicInputId)
    {
        $sql = "SELECT t.dynamicInputValueId, t.dynamicInputValue, t.dynamicInputId, t.active, t.fromIp, t.createdAt, s.dynamicInputName, s.dynamicInputType FROM `tbl_dynamicinputvaluemaster` t LEFT JOIN tbl_dynamicinputmaster s on s.dynamicInputId=t.dynamicInputId WHERE t.active = 'active' ";
        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $sql .= " and t.dynamicInputValueId = '" . $actionId . "' ";
        }
        if ($dynamicInputId != "" && $dynamicInputId != null && $dynamicInputId != "0" && $dynamicInputId != 0) {
            $sql .= " and t.dynamicInputId = '" . $dynamicInputId . "' ";
        }
        $sql = $sql . " order by t.dynamicInputValueId asc";
        $userQuery = $this->db->query($sql);

        $dynamicInputValueMasterArray = $userQuery->result_array();
        return $dynamicInputValueMasterArray;
    }

    // End Dynamic Input Value Master
    public function getIpAddress()
    {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        return $ipAddress;
    }

    //Membership package master start

    public function getMembershipPackageList($actionId)
    {
        $sql = "SELECT * FROM `tbl_membershippackage` t WHERE t.active = 'active' ";
        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $sql .= " and t.packageId = '" . $actionId . "' ";
        }
        $sql = $sql . " order by t.packageId desc";
        $userQuery = $this->db->query($sql);

        $membershipPackage = $userQuery->result_array();

        return $membershipPackage;
    }

    public function createMembershipPackageMaster($membershipPackageDetailsArray)
    {
        $active = "active";
        $sql = "INSERT INTO tbl_membershippackage (membershipPackageTitle, noOfDaysToActive, packageAmount, active, createdAt, fromIp) " . "VALUES (" . $this->db->escape($membershipPackageDetailsArray['membershipPackageTitle']) . ", " . $this->db->escape($membershipPackageDetailsArray['noOfDaysToActive']) . ", " . $this->db->escape($membershipPackageDetailsArray['packageAmount']) . "," . $this->db->escape($active) . "," . $this->db->escape($membershipPackageDetailsArray['createdAt']) . "," . $this->db->escape($membershipPackageDetailsArray['fromIp']) . ")";
        $this->db->query($sql);
    }

    public function updateMembershipPackageMaster($membershipPackageDetailsArray)
    {
        $sql = "UPDATE tbl_membershippackage set membershipPackageTitle = " . $this->db->escape($membershipPackageDetailsArray['membershipPackageTitle']) . ", noOfDaysToActive = " . $this->db->escape($membershipPackageDetailsArray['noOfDaysToActive']) . ", packageAmount = " . $this->db->escape($membershipPackageDetailsArray['packageAmount']) . " where packageId = " . $this->db->escape($membershipPackageDetailsArray['packageId']);
        return $this->db->query($sql);
    }

    public function deleteMembershipPackageMaster($membershipPackageDetailsArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_membershippackage set active = " . $this->db->escape($active) . " where packageId = " . $this->db->escape($membershipPackageDetailsArray['packageId']);
        return $this->db->query($sql);
    }
    //Membership package master End

    //Users Profile Start
    public function createAdminUsersProfile($usersProfileArray)
    {
        $active = "active";
        $sql = "INSERT INTO tbl_adminuser (usertypeid, name, mobile,email,password, address, active, createdAt, fromIp) " . "VALUES (" . $this->db->escape($usersProfileArray['usertypeid']) . ", " . $this->db->escape($usersProfileArray['name']) . ", " . $this->db->escape($usersProfileArray['mobile']) . "," . $this->db->escape($usersProfileArray['email']) . "," . $this->db->escape($usersProfileArray['password']) . "," . $this->db->escape($usersProfileArray['address']) . "," . $this->db->escape($active) . "," . $this->db->escape($usersProfileArray['createdAt']) . "," . $this->db->escape($usersProfileArray['fromIp']) . ")";
        $this->db->query($sql);
    }

    public function updateAdminUsersProfile($usersProfileArray)
    {
        $sql = "UPDATE tbl_adminuser set name = " . $this->db->escape($usersProfileArray['name']) . ", mobile = " . $this->db->escape($usersProfileArray['mobile']) . ", email = " . $this->db->escape($usersProfileArray['email']) . ", password = " . $this->db->escape($usersProfileArray['password']) . ", address = " . $this->db->escape($usersProfileArray['address']) . " where adminid = " . $this->db->escape($usersProfileArray['adminid']);
        return $this->db->query($sql);
    }

    public function deleteAdminUsersProfile($usersProfileArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_adminuser set active = " . $this->db->escape($active) . " where adminid = " . $this->db->escape($usersProfileArray['adminid']);
        return $this->db->query($sql);
    }

    //Users Profile End

    //Backend users
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

    public function getAdminUserProfileDetails($actionId, $usertypeid)
    {
        $userList = array();

        //Select active list from both user and usertype table
        $sql = "SELECT t.adminid, t.name, t.email, t.usertypeid, t.mobile, t.address, t.password, t.lastlogin, u.redirecturl, u.usertype  FROM tbl_adminuser t INNER JOIN  `tbl_usertype` u ON u.usertypeid = t.usertypeid and u.active='active' WHERE t.adminid = '" . $actionId . "' and t.usertypeid = '" . $usertypeid . "' and t.active = 'active' ";
        $query = $this->db->query($sql);
        foreach ($query->result() as $row) {
            $userList['adminid'] = $row->adminid;
            $userList['name'] = $row->name;
            $userList['email'] = $row->email;
            $userList['address'] = $row->address;
            $userList['password'] = $row->password;
            $userList['usertypeid'] = $row->usertypeid;
            $userList['mobile'] = $row->mobile;
            $userList['lastlogin'] = $row->lastlogin;
            $userList['redirecturl'] = $row->redirecturl;
            $userList['usertype'] = $row->usertype;
        }
        return $userList;
    }

    public function checkUserCredential($userCredentialArray)
    {
        $username = $userCredentialArray['username'];
        $password = $userCredentialArray['userpassword'];
        $userList = array();

        //Select active list from both user and usertype table
        $sql = "SELECT t.adminid, t.name, t.email, t.usertypeid, t.mobile, t.address, t.lastlogin, u.redirecturl, u.usertype  FROM tbl_adminuser t INNER JOIN  `tbl_usertype` u ON u.usertypeid = t.usertypeid and u.active='active' WHERE t.email = '" . $username . "' and t.password = '" . $password . "' and t.active = 'active' ";
        $query = $this->db->query($sql);
        foreach ($query->result() as $row) {
            $userList['adminid'] = $row->adminid;
            $userList['name'] = $row->name;
            $userList['email'] = $row->email;
            $userList['usertypeid'] = $row->usertypeid;
            $userList['mobile'] = $row->mobile;
            $userList['lastlogin'] = $row->lastlogin;
            $userList['redirecturl'] = $row->redirecturl;
            $userList['usertype'] = $row->usertype;
        }
        return $userList;
    }

    public function updateLastlogin($adminid)
    {
        $data = array('lastlogin' => date('Y-m-d H:m:s'));
        $this->db->where('adminid', $adminid);
        return $this->db->update('tbl_adminuser', $data);
    }

    public function sendEmail($fromMailId, $fromMailName, $tomailIdArray, $subject, $message)
    {
        if ($fromMailId != "" && $fromMailId != null) {
            $fromMailId = $fromMailId;
            $fromMailName = $fromMailName;
        } else {
            $fromMailId = "support@1stepshop.in";
            $fromMailName = "1stepshop Support Team";
        }
        $ccmailIdArray = array("1stepshop@gmail.com");
//        print_r($tomailIdArray);
        $ci = get_instance();
        $ci->load->library('email');
        $ci->email->from($fromMailId, $fromMailName);
        $ci->email->to($tomailIdArray);
        $ci->email->cc($ccmailIdArray);
        $ci->email->reply_to($fromMailId, $fromMailName);
        $ci->email->subject($subject);
        $ci->email->message($message);
        return $ci->email->send();
    }

    public function getSuccessMsgOTPUpdated($email, $otptext)
    {
        $resultArray = array('successMsg' => 0, 'adminid' => null);
        $userSql = "SELECT adminid FROM `tbl_adminuser` t WHERE t.active = 'active' and email = '" . $email . "' ";
        $sql = "SELECT adminid FROM `tbl_forgotPasswordRequest` t WHERE t.active = 'active' ";
        $sql .= " and otp = '" . $otptext . "' ";
        $sql .= " and adminid in ($userSql) ";
        $userQuery = $this->db->query($sql);
        $returnValue = $userQuery->result_array();
        if (count($returnValue) > 0) {
            $adminid = $returnValue[0]['adminid'];
            $resultArray = array('successMsg' => 1, 'adminid' => $adminid);
            $usedAt = date("Y-m-d H:i:s");
            $forgotSql = "Update `tbl_forgotPasswordRequest` set active = 'used', usedAt = " . $this->db->escape($usedAt) . "  where adminid = " . $this->db->escape($adminid) . " and active='active' and otp = " . $this->db->escape($otptext);
            $this->db->query($forgotSql);
        }


        return $resultArray;
    }

    public function updateUsersPassword($adminid, $newPassword)
    {
        if ($adminid != null && $newPassword != "") {
            $sql = "UPDATE tbl_adminuser set password = " . $this->db->escape($newPassword) . " where adminid = " . $this->db->escape($adminid);
            $this->db->query($sql);
        }
    }

    public function insertAndReturnOTP($emailid)
    {
        $otp = "";
        $userArray = array();
        if ($emailid != "" && $emailid != null) {
            $sql = "SELECT adminid FROM `tbl_adminuser` t WHERE t.active = 'active' ";
            $sql .= " and email = '" . $emailid . "' ";
            $userQuery = $this->db->query($sql);
            $k = 0;
            $adminid = "";
            foreach ($userQuery->result() as $row) {
                $adminid = $row->adminid;
            }
            if ($adminid != "") {

                $newdate = new DateTime("now");
                $now = $createdAt = date_format($newdate, "Y-m-d H:i:s");
                $interval = new DateInterval('PT12H0S');
                $newdate->add($interval);

                $expiryDate = date_format($newdate, "Y-m-d H:i:s");
                $existSql = "Select * from `tbl_forgotPasswordRequest` where adminid=" . $this->db->escape($adminid) . " and active='active' and createdAt <= " . $this->db->escape($now) . " and expiryDate >= " . $this->db->escape($now);
                $executeQuery = $this->db->query($existSql);
                $returnValueArray = $executeQuery->result_array();

                if (count($returnValueArray) > 0) {
                    $otp = $returnValueArray[0]['otp'];
                } else {
                    $otp = rand(100000, 999999);
                    $active = "active";
                    $forgotSql = "INSERT INTO `tbl_forgotPasswordRequest`( `adminid`, `otp`, `createdAt`, `expiryDate`, `active`) VALUES (" . $this->db->escape($adminid) . "," . $this->db->escape($otp) . "," . $this->db->escape($createdAt) . "," . $this->db->escape($expiryDate) . "," . $this->db->escape($active) . ")";
                    $this->db->query($forgotSql);
                }
            }
        }

        return $otp;
    }

    public function getUsersList($actionId, $activeStatus, $orderBy, $start, $end, $stateId, $districtId)
    {
        $sql = "SELECT * FROM `tbl_user` t WHERE t.active =" . $this->db->escape($activeStatus);

        $searchQuery = "";
        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $searchQuery .= " and t.userid = " . $this->db->escape($actionId);
        }
        if ($start != "" && $start != null && $end != "" && $end != null) {
            $searchQuery = " and createdat > " . $this->db->escape($start) . " and createdat < " . $this->db->escape($end);
        }
        if ($stateId != "" && $stateId != null && $stateId != "0" && $stateId != 0) {
            $searchQuery = " and stateId = " . $this->db->escape($stateId);
        }
        if ($districtId != "" && $districtId != null && $districtId != "0" && $districtId != 0) {
            $searchQuery = " and districtId = " . $this->db->escape($districtId);
        }

        if ($searchQuery != "" && $searchQuery != null) {
            $sql .= $searchQuery;
        }

        $sql = $sql . " order by t.userid " . $orderBy;
        $userQuery = $this->db->query($sql);

        $membershipPackage = $userQuery->result_array();

        return $membershipPackage;
    }

    public function getContactUsList($actionId, $orderBy)
    {
        $sql = "SELECT t.`id`, t.`name`, t.`email`, t.`mobileNumber`, t.`categoryId`, t.`description`, t.`active`, t.`fromIp`, t.`createdAt`, c.category FROM `tbl_contactus` t LEFT JOIN tbl_category c on c.categoryId=t.categoryId WHERE t.active = 'active' ";

        $searchQuery = "";
        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $searchQuery .= " and t.userid = " . $this->db->escape($actionId);
        }
        if ($searchQuery != "" && $searchQuery != null) {
            $sql .= $searchQuery;
        }

        if ($orderBy != "" && $orderBy != null) {
            $sql .= $orderBy;
        }

        $userQuery = $this->db->query($sql);
        $contactUsList = $userQuery->result_array();

        return $contactUsList;

    }

    public function runUpdateQuery($updateBatchSql)
    {
        if ($updateBatchSql != "" && $updateBatchSql != null) {
            $userQuery = $this->db->query($updateBatchSql);
        }
    }

}
