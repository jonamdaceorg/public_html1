<!--
Author: 1stepshop
Author URL: http://1stepshop.in
-->
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/bootstrap-select.css">
    <link href="<?php echo base_url(); ?>assets/web/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo base_url(); ?>assets/web/css/navbar.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo base_url(); ?>assets/web/css/myCustomized.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/flexslider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/font-awesome.min.css" />
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/logo/21.jpg">


	<meta name="keywords" content="Classifieds, Free classifieds, Online Classifieds, free online classifieds, free ads , jobs, house, rent, events online ads,<?php echo $title; ?>" />
	
	<!--<meta name="description" content="Free online classified ads. Sell, Buy, Find - faster and easier: flats, apartments, houses, PG, jobs, cars, bikes, motorcycles, mobiles, computers, tuition.- 1stepshop.in, <?php //echo $title; ?>" />-->
<?php
        $titleContent = "Classifieds, Free classifieds, Online Classifieds, free online classifieds, free ads , jobs, house, rent, events online ads, ".$title;
        $titleContent = substr($titleContent, -155);
    ?>
	<meta name="description" content="<?php echo $titleContent; ?>" />

    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- //for-mobile-apps -->
    <!--fonts-->
    <link href='//fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <!--//fonts-->
<!-- infolinks started -->
<script type="text/javascript">
var infolinks_pid = 3050491;
var infolinks_wsid = 0;
</script>
<script type="text/javascript" src="//resources.infolinks.com/js/infolinks_main.js"></script>
<!-- infolinks end -->

 

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/web/js/jquery.min.js"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url(); ?>assets/web/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/web/js/bootstrap-select.js"></script>
    <script>
        $(document).ready(function () {
            var mySelect = $('#first-disabled2');

            $('#special').on('click', function () {
                mySelect.find('option:selected').prop('disabled', true);
                mySelect.selectpicker('refresh');
            });

            $('#special2').on('click', function () {
                mySelect.find('option:disabled').prop('disabled', false);
                mySelect.selectpicker('refresh');
            });

            $('#basic2').selectpicker({
                liveSearch: true,
                maxOptions: 1
            });
        });
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/web/js/jquery.leanModal.min.js"></script>
    <link href="<?php echo base_url(); ?>assets/web/css/jquery.uls.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/web/css/jquery.uls.grid.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/web/css/jquery.uls.lcd.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/plugins/select2/select2.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- Source -->
    <script src="<?php echo base_url(); ?>assets/web/js/jquery.uls.data.js"></script>
    <script src="<?php echo base_url(); ?>assets/web/js/jquery.uls.data.utils.js"></script>
    <script src="<?php echo base_url(); ?>assets/web/js/jquery.uls.lcd.js"></script>
    <script src="<?php echo base_url(); ?>assets/web/js/jquery.uls.languagefilter.js"></script>
    <script src="<?php echo base_url(); ?>assets/web/js/jquery.uls.regionfilter.js"></script>
    <script src="<?php echo base_url(); ?>assets/web/js/jquery.uls.core.js"></script>

    <script src="<?php echo base_url(); ?>assets/plugins/select2/select2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/usersCustomized.js"></script>
    <script>
        $( document ).ready( function() {
            $( '.uls-trigger' ).uls( {
                onSelect : function( language ) {
                    var languageName = $.uls.data.getAutonym( language );
                    $( '.uls-trigger' ).text( languageName );
                },
                quickList: ['en', 'hi', 'he', 'ml', 'ta', 'fr'] //FIXME
            } );
            $(".select2").select2();
            $('.datepicker').datepicker({
                format: "yyyy-mm-dd",
                autoclose: true,
                todayHighlight: true,
                orientation: "top" // add this
            });
            $(".datepicker").attr( 'readOnly' , 'true' );
        } );
    </script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/web/css/easy-responsive-tabs.css " />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/build.css"/>
    <script src="<?php echo base_url(); ?>assets/web/js/easyResponsiveTabs.js"></script>
</head>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed text-warning" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
<!--            <a class="navbar-brand brandpadding" href="--><?php //echo base_url(); ?><!--"><img src="--><?php //echo base_url(); ?><!--assets/logo/1stepshop-1.jpg" alt="" class="logoimg"/></a>-->
          <h1 title="Free classifieds in business,Free classifieds in India, Classified ads in India, Online Classified Advertising" >  <a class="navbar-brand brandpadding" href="<?php echo base_url(); ?>"><div class="logo"><span class="logoFirstPart">1step</span><span class="logoSecondPart">shop</span></div></a></h1>

        </div>
        <?php
//            print_r($_SERVER);
            $requestURI = $_SERVER['REQUEST_URI'];
            $requestURIArray = explode("/", $requestURI);

            if(count($requestURIArray)>=3) { ?>
                <style>
                    @font-face {
                        font-family: myFirstFont;
                        src: url(../assets/logo/FerroRosso.ttf);
                    }
                </style>
            <?php

                } else { ?>
                <style>
                    @font-face {
                        font-family: myFirstFont;
                        src: url(assets/logo/FerroRosso.ttf);
                    }
                </style>
            <?php
                }
            ?>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <!--<ul class="nav navbar-nav">
                <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>-->
            <?php   $userid = 0;
                    if(key_exists('userid', $_SESSION)){
                        $userid = $_SESSION['userid'];
                    }
                    if($userid>0) { ?>
                <ul class="nav navbar-nav navbar-right">
                    <li id="topnav">
                        <form role="search" id="headerSearchForm" class="navbar-left app-search " action="<?php base_url();?>adsList" method="POST">
                            <input type="text" placeholder="Search..." class="form-control input-lg" name="headerSearch" value="<?php if(isset($_REQUEST['searchText'])){
                                echo $_REQUEST['searchText'];
                            } elseif(isset($_REQUEST['headerSearch'])){
                                echo $_REQUEST['headerSearch'];
                            }?>">
                            <a href="javascript:void(0)" onclick="document.getElementById('headerSearchForm').submit();" ><i class="fa fa-search"></i></a>
                        </form>
                    </li>
                    <li><a href="<?php echo base_url(); ?>"><span class="fa fa-home"></span>&nbsp;Home</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-adn"></span>&nbsp;Ads <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url(); ?>viewAllMyAds"><span class="fa fa-list"></span>&nbsp;View All My Ads</a></li>
                            <li><a href="<?php echo base_url(); ?>nearByYouAds"><span class="fa fa-adn"></span>&nbsp;Near By You Ads</a></li>
                            <li><a href="<?php echo base_url(); ?>viewBookmarked"><span class="fa fa-star"></span>&nbsp;Bookmarked</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-user"></span>&nbsp;My Account <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url(); ?>myAccount"><span class="fa fa-user"></span>&nbsp;&nbsp;View My Profile</a></li>
                            <li><a href="<?php echo base_url(); ?>changePassword"><span class="fa fa-key"></span>&nbsp;&nbsp;Change Password</a></li>
                            <li><a href="<?php echo base_url(); ?>viewHistory"><span class="fa fa-list"></span>&nbsp;History</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url(); ?>logout"><span class="fa fa-sign-out"></span>&nbsp;&nbsp;Sign Out</a></li>
                    <li><div class="banner text-center">
                            <a href="<?php echo base_url().'posting'; ?>">Post Free Ad</a>
                        </div>
                    </li>
                    <!--<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </li>-->
                </ul>
            <?php } else { ?>
                <ul class="nav navbar-nav navbar-right">
                    <li id="topnav">
                        <form role="search" id="headerSearchForm1"  class="navbar-left app-search " action="<?php base_url();?>adsList" method="GET">
                            <input type="text" placeholder="Search..." class="form-control" name="headerSearch" value="<?php if(isset($_REQUEST['searchText'])){
                                echo $_REQUEST['searchText'];
                            } elseif(isset($_REQUEST['headerSearch'])){
                                echo $_REQUEST['headerSearch'];
                            }?>">
                            <a href="javascript:void(0)" onclick="document.getElementById('headerSearchForm1').submit();" ><i class="fa fa-search"></i></a>
                        </form>
                    </li>
                    <li><a href="<?php echo base_url(); ?>login"><span class="fa fa-sign-in"></span>&nbsp;Sign In</a></li>
                    <li><a href="<?php echo base_url(); ?>register"><span class="fa fa-user"></span>&nbsp;Sign up</a></li>
                    <li><div class="banner text-center">
                            <a href="<?php echo base_url().'adPost'; ?>">Post Free Ad</a>
                        </div>
                    </li>
                    <!--<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </li>-->
                </ul>
            <?php } ?>
            <?php //print_r($_SESSION); ?>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<!--<div class="header navbar-fixed-top navbar">
    <div class="container">
        <div class="logo">
            <a href="<?php //echo base_url(); ?>"><span>1Step</span>Shop</a>
        </div>
        <div class="header-right">
            <a class="account" href="<?php //echo base_url(); ?>login">My Account</a>
            <div class="selectregion">
                <a class="btn btn-primary md-account-box " href="<?php //echo base_url(); ?>register">
                    Sign up</a>
            </div>
        </div>
    </div>
</div>-->
<body>
<div class="container-fluid ">
<div class="row ">
    <div class="col-md-2 sideComericalads text-center">
        <!--21 dec start -->
        <?php //print_r($adBannerArray);
            if(count($adBannerArray)>0){
                for($i=0; $i<count($adBannerArray); $i++){
                    $typeOfPosition = $adBannerArray[$i]['typeOfPosition'];
                    if($typeOfPosition == "Left"){


                        $bannerType = $adBannerArray[$i]['bannerType'];
                        $bannerLinkURL = $adBannerArray[$i]['bannerLinkURL'];

                        if($bannerLinkURL != ""){
                            echo "<a href='".$bannerLinkURL."'>";
                        }

                        if($bannerType == 'bannerAdsCode') {
                            echo $adsCode = $adBannerArray[$i]['adsCode'];
                        } else if($bannerType == "bannerImage" || $bannerType == "bannerImageUrl"){
                            if($bannerType == "bannerImageUrl"){
                                $bannerImageUrl = $adBannerArray[$i]['bannerImageUrl'];
                            } else {
                                $bannerImage = $adBannerArray[$i]['bannerImage'];
                                $bannerImageUrl = "uploads/files/adbanners/" . $bannerImage;
                            }
                            $height = $adBannerArray[$i]['height'];
                            $width = $adBannerArray[$i]['width'];
                            if($width == "" || $width == "0") $width = "100%";
                            echo "<img src='".$bannerImageUrl."' height='".$height."' width='".$width."' />";
                        }

                        if($bannerLinkURL != ""){
                            echo "</a>";
                        }
//                        echo $adsCode = $adBannerArray[$i]['adsCode'];
//                        echo $adsCode = $adBannerArray[$i]['adsCode'];
                    }
                }
            }
        ?>
      <!-- <iframe style="width:120px;height:240px;" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" src="//ws-in.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&OneJS=1&Operation=GetAdHtml&MarketPlace=IN&source=ac&ref=tf_til&ad_type=product_link&tracking_id=myosssite-21&marketplace=amazon&region=IN&placement=B01LTHND2O&asins=B01LTHND2O&linkId=75dc2bb84a61556a1dea8aa65e17ef35&show_border=false&link_opens_in_new_window=false&price_color=333333&title_color=0066c0&bg_color=ffffff">
        </iframe>-->

    </div>
    <div class="col-md-8">

<!----- amazon ads start ----->
<?php if(count($adBannerArray)>0){ 
                for($i=0; $i<count($adBannerArray); $i++){
                    $typeOfPosition = $adBannerArray[$i]['typeOfPosition'];
                    if($typeOfPosition == "Top"){ ?>


<div class="content">
    <div class="categories">
        <div class="">
 <div class="form-group">
			<div class="row">
				<div class="col-sm-12">

<?php

                                            $bannerType = $adBannerArray[$i]['bannerType'];
                                            $bannerLinkURL = $adBannerArray[$i]['bannerLinkURL'];

                                            if($bannerLinkURL != ""){
                                                echo "<a href='".$bannerLinkURL."'>";
                                            }

                                            if($bannerType == 'bannerAdsCode') {
                                                echo $adsCode = $adBannerArray[$i]['adsCode'];
                                            } else if($bannerType == "bannerImage" || $bannerType == "bannerImageUrl"){
                                                if($bannerType == "bannerImageUrl"){
                                                    $bannerImageUrl = $adBannerArray[$i]['bannerImageUrl'];
                                                } else {
                                                    $bannerImage = $adBannerArray[$i]['bannerImage'];
                                                    $bannerImageUrl = "uploads/files/adbanners/" . $bannerImage;
                                                }
                                                $height = $adBannerArray[$i]['height'];
                                                $width = $adBannerArray[$i]['width'];
                                                if($width == "" || $width == "0") $width = "100%";
                                                echo "<img src='".$bannerImageUrl."' height='".$height."' width='".$width."' />";
                                            }

                                            if($bannerLinkURL != ""){
                                                echo "</a>";
                                            }
                                            ?>
<!--
<script type="text/javascript" language="javascript">
    var aax_size='728x90';
    var aax_pubname = 'myosssite-21';
    var aax_src='302';
</script>
<script type="text/javascript" language="javascript" src="https://c.amazon-adsystem.com/aax2/assoc.js"></script>-->


				</div>
			</div>
		</div>
		</div>
		</div>
		</div>

<?php   
                    }
                }

         }
        ?>
<!---- ads end -->

<style>
    body{
        margin-top: 50px !important;
    }

    #topnav .app-search {
        position: relative;
        margin: 20px 20px 15px 10px;

    }
    #topnav .app-search a {
        position: absolute;
        top: 5px;
        right: 20px;
        color: rgba(255, 255, 255, 0.7);
    }
    #topnav .app-search .form-control,
    #topnav .app-search .form-control:focus {
        border: none;
        font-size: 13px;
        color: #ffffff;
        padding-left: 20px;
        padding-right: 40px;
        background: rgba(255, 255, 255, 0.1);
        box-shadow: none;
        border-radius: 30px;
      /*  height: 30px;
        width: 180px;*/
    }
    #topnav .app-search input::-webkit-input-placeholder {
        color: rgba(255, 255, 255, 0.7);
        font-weight: normal;
    }
    #topnav .app-search input:-moz-placeholder {
        color: rgba(255, 255, 255, 0.7);
    }
    #topnav .app-search input::-moz-placeholder {
        color: rgba(255, 255, 255, 0.7);
    }
    #topnav .app-search input:-ms-input-placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

</style>

