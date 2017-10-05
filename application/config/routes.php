<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Frontend';

$route['Backend_controller'] = 'Backend';
$route['manage'] = 'Backend/manage';
$route['checkLogin'] = 'Backend/checkLogin';
$route['dashboard'] = 'Backend/dashboard';

$route['categoryMaster'] = 'Backend/categoryMaster';
$route['subCategoryMaster'] = 'Backend/subCategoryMaster';
$route['membershipPackageMaster'] = 'Backend/membershipPackageMaster';

$route['countryMaster'] = 'Backend/countryMaster';
$route['stateMaster'] = 'Backend/stateMaster';
$route['districtMaster'] = 'Backend/districtMaster';
$route['subDistrictMaster'] = 'Backend/subDistrictMaster';

$route['reportingMaster'] = 'Backend/reportingMaster';
$route['getStateSelectBox'] = 'Backend/getStateSelectBox';
$route['editProfile'] = 'Backend/editProfile';


$route['getMastersList'] = 'Backend/getMastersList';
$route['AddOrEditMasterContent'] = 'Backend/AddOrEditMasterContent';
$route['insertOrUpdateMaster'] = 'Backend/insertOrUpdateMaster';

$route['dynamicFieldsMaster'] = 'Backend/dynamicFieldsMaster';
$route['dynamicInputMaster'] = 'Backend/dynamicInputMaster';
$route['dynamicInputValueMaster'] = 'Backend/dynamicInputValueMaster';
$route['getDynamicSelectBox'] = 'Backend/getDynamicSelectBox';
$route['adsMaster'] = 'Backend/adsMaster';
$route['viewAds'] = 'Backend/viewAds';
$route['updateAdsStatusForm'] = 'Backend/updateAdsStatusForm';
$route['reportAboutAdsList'] = 'Backend/reportAboutAdsList';



//Frontend

$route['login'] = 'Frontend/login';
$route['register'] = 'Frontend/register';
$route['activateProfile'] = 'Frontend/activateProfile';
$route['confirmOtp'] = 'Frontend/confirmOtp';
$route['forgotPassword'] = 'Frontend/forgotPassword';
$route['confirmUserAndSendOtp'] = 'Frontend/confirmUserAndSendOtp';
$route['usersRegister'] = 'Frontend/usersRegister';
$route['logout'] = 'Frontend/logout';
$route['signup'] = 'Frontend/signup';
$route['usersCheckLogin'] = 'Frontend/usersCheckLogin';
$route['myAccount'] = 'Frontend/myAccount';
$route['contactUs'] = 'Frontend/contactUs';
$route['sendContactUsDetails'] = 'Frontend/sendContactUsDetails';
$route['aboutUs'] = 'Frontend/aboutUs';
$route['posting'] = 'Frontend/posting';
$route['adPost'] = 'Frontend/adPost';
$route['createBackendAdPost'] = 'Frontend/createBackendAdPost';
$route['getDynamicFieldsforAdPost'] = 'Frontend/getDynamicFieldsforAdPost';
$route['getDynamicFieldsforSearchAds'] = 'Frontend/getDynamicFieldsforSearchAds';
$route['categories'] = 'Frontend/categories';
$route['adsList'] = 'Frontend/adsList';
$route['singleItem/(:any)'] = 'Frontend/singleItem/$1';
$route['getStates'] = 'Frontend/getStates';
$route['sendSMS'] = 'Frontend/sendSMS';
$route['getCommonJssudo apt-get install sbtonData'] = 'Frontend/getCommonJsonData';
$route['createAdPost'] = 'Frontend/createAdPost';
$route['searchAdsAjax'] = 'Frontend/searchAdsAjax';
$route['getStateAndCityId'] = 'Frontend/getStateAndCityId';
$route['categoryAjax'] = 'Frontend/categoryAjax';
$route['changePassword'] = 'Frontend/changePassword';
$route['updatePassword'] = 'Frontend/updatePassword';
$route['editMyProfile'] = 'Frontend/editMyProfile';
$route['updateMyProfile'] = 'Frontend/updateMyProfile';
$route['viewAllMyAds'] = 'Frontend/viewAllMyAds';
$route['nearByYouAds'] = 'Frontend/nearByYouAds';
$route['viewHistory'] = 'Frontend/viewHistory';
$route['viewBookmarked'] = 'Frontend/viewBookmarked';
$route['addToMyBookmark'] = 'Frontend/addToMyBookmark';
$route['getHistoryList'] = 'Frontend/getHistoryList';
$route['samplevalidation'] = 'Frontend/samplevalidation';

$route['updateReportAboutAds'] = 'Frontend/updateReportAboutAds';
$route['updateAdPost'] = 'Frontend/updateAdPost';
$route['editMyAds/(:any)'] = 'Frontend/editMyAds/$1';


$route['howitworks'] = 'Frontend/howitworks';
$route['faq'] = 'Frontend/faq';
$route['feedback'] = 'Frontend/feedback';
$route['locatinsMap'] = 'Frontend/locatinsMap';
$route['terms'] = 'Frontend/terms';
$route['privacy'] = 'Frontend/privacy';
$route['typography'] = 'Frontend/typography';
$route['popularSearch'] = 'Frontend/popularSearch';
$route['sitemap'] = 'Frontend/sitemap';
$route['updateAdsStatus'] = 'Frontend/updateAdsStatus';

//Apps Routings
$route['getLoginFromApps'] = 'Apps/getLoginFromApps';
$route['confirmUserAndSendOtpFromApps'] = 'Apps/confirmUserAndSendOtpFromApps';

//$route['home'] = 'Frontend/home';


$route['404_override'] = 'CustomizedError';
$route['translate_uri_dashes'] = FALSE;
