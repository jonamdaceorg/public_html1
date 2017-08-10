<?php
/**
 * Created by IntelliJ IDEA.
 * User: jonam
 * Date: 10/8/17
 * Time: 10:40 PM
 */
?>
<link href="<?php echo base_url(); ?>assets/web/css/myCustomized.css" rel="stylesheet" type="text/css" media="all" />
<?php
$requestURI = $_SERVER['REQUEST_URI'];
$requestURIArray = explode("/", $requestURI);

if (count($requestURIArray) > 3) { ?>
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
<head>
<title>404 - Page Not Found</title>
</head>
<body style="width: auto; height: auto; background-color: #59C2AF;text-align: center">
    <div class="logo" style="padding-top: 150px">
        <span class="logoFirstPart" style="font-size:60px">1step</span><span class="logoSecondPart" style="font-size:60px">shop</span>
        <p class="logoFirstPart" style=" font-size:40px"><span>404</span> <span class="logoSecondPart">Page Not Found</span></p>
        <input type="button" style="text-decoration: none; color: #fff; font-size: 17px; background-color: #f3c500; padding: 10px 20px;" value="Go Back" onclick="goBack()"/>
    </div>
</body>
<script>
    function goBack(){
        window.history.back()
    }
</script>