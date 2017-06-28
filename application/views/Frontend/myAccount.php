<div class=" profile">
    <div class="profile-bottom">
        <h3><i class="fa fa-user"></i>Profile</h3>
        <div class="profile-bottom-top">
            <div class="col-md-4 profile-bottom-img">
                <?php
                    $userProfiles = $this->users_model->getUserProfilePhoto($userArray['userCode'], $userArray['img']);
                ?>
                <img src="<?php echo $userProfiles; ?>" alt="">
            </div>
            <div class="col-md-8 profile-text">
                <h6><?php echo $userArray['name']; ?></h6>
                <table>
                    <tbody><tr><td>Mobile</td>
                        <td>:</td>
                        <td><?php echo $userArray['mobile']; ?></td></tr>

                    <tr>
                        <td>Email</td>
                        <td> :</td>
                        <td><a href="<?php echo $userArray['email']; ?>"><?php echo $userArray['email']; ?></a></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td> :</td>
                        <td> <?php echo $userArray['stateName']; ?></td>
                    </tr>
                    <tr>
                        <td>City </td>
                        <td>:</td>
                        <td>  <?php echo $userArray['cityName']; ?></td>
                    </tr>
                    <tr>
                        <td>Address </td>
                        <td>:</td>
                        <td> <?php echo $userArray['address']; ?></td>
                    </tr>
                    </tbody></table>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="profile-bottom-bottom">
            <!--<div class="col-md-4 profile-fo">
                <h4>23,5k</h4>
                <p>Followers</p>
                <a href="#" class="pro"><i class="fa fa-plus-circle"></i>Follow</a>
            </div>
            <div class="col-md-4 profile-fo">
                <h4>348</h4>
                <p>Following</p>
                <a href="#" class="pro1"><i class="fa fa-user"></i>View Profile</a>
            </div>
            <div class="col-md-4 profile-fo">
                <h4>23,5k</h4>
                <p>Snippets</p>
                <a href="#"><i class="fa fa-cog"></i>Options</a>
            </div>-->
            <div class="clearfix"></div>
        </div>
        <div class="profile-btn">
<!--            --><?php //print_r($userArray); ?>
            <button type="button" class="btn bg-red" onclick="redirect()">Edit <span class="fa fa-arrow-right"></span></button>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<script>
    function redirect(){
        window.location.href = "editMyProfile";
    }
</script>
<style>
    /*--profile--*/
    .profile{
        margin-top: 80px;
        padding:1em;
    }
    .profile-bottom{
        width: 55%;
        margin: 0em auto;
        background-color: #fff;
        padding: 1em 0 ;
        border: 1px solid #ebeff6;
        border-radius: 4px;
        -webkit-border-radius: 4px;
        -o-border-radius: 4px;
        -moz-border-radius: 4px;
        -ms-border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .profile-bottom h3{
        font-size: 1.4em;
        color:#000;
        padding: 0em 0.9em 1em;
        border-bottom: 1px solid #F3F3F4;
        margin-bottom: 1em;
    }
    .profile-bottom h3 i{
        font-size: 16px;
        width: 28px;
        height: 28px;
        background: #F7F7F7;
        border-radius: 100px;
        -webkit-border-radius: 100px;
        -o-border-radius: 100px;
        -moz-border-radius: 100px;
        -ms-border-radius: 100px;
        text-align: center;
        line-height: 1.7em;
        color: #8E8E8E;
        margin-right: 1%;
    }
    .profile-text h6{
        font-size: 1.5em;
        color:#000;
        padding: 0em 0.4em 0.3em;
    }
    .profile-text td{
        font-size: 0.9em;
        color:#999;
        padding: 0.3em 1em;
    }
    .profile-text td a{
        color:#D95459;
    }
    .profile-bottom-top img {
        /*border-radius: 100px;*/
        /*-webkit-border-radius: 100px;*/
        /*-o-border-radius: 100px;*/
        /*-moz-border-radius: 100px;*/
        /*-ms-border-radius: 100px;*/
    }
    .profile-fo h4{
        font-size: 2em;
        color:#000;

    }
    .profile-fo {
        text-align:center;
    }
    .profile-fo p{
        font-size: 0.9em;
        color:#999;
        margin: 0.5em 0;
    }
    .profile-fo a{
        text-decoration: none;
        font-size: 0.9em;
        color: #fff;
        padding: 0.5em;
        border-radius: 4px;
        -webkit-border-radius: 4px;
        -o-border-radius: 4px;
        -moz-border-radius: 4px;
        -ms-border-radius: 4px;
        background: #D95459;
        display: block;
        text-align: center;
    }
    .profile-fo a.pro{
        background: #FBB03B;
    }
    .profile-fo a.pro1{
        background: #3BB2D0;
    }
    .profile-fo a:hover{
        background: #1ABC9C;
    }
    .profile-fo a i{
        margin-right:2%;
    }
    .profile-btn {
        padding: 1em 1em 0;
        border-top: 1px solid #F3F3F4;
    }
    .profile-btn button.btn.bg-red{
        background:#59C2AF;
        color:#fff;
        float: right;
    }
    .profile-bottom-bottom {
        padding: 2em 0;
    }
    a#myTabDrop1,a#profile-tab,a#home-tab {
        padding: 0.8em;
    }
    @media(max-width:1024px){
        .profile-bottom {
            width: 80%;
        }
    }
    @media(max-width:768px){
        .profile-bottom {
            width: 95%;
        }
        .profile-bottom-img{
            text-align:center;
        }
        .profile-text {
            padding-top: 1em;
            text-align: center;
        }
        .profile-fo a {
            width: 50%;
            margin: 0 auto;
        }
        .profile-text table {
            width: 100%;
        }
        .profile-fo {
            margin-bottom: 1em;
        }
    }
    @media(max-width:640px){
        .profile-fo h4 {
            font-size: 1.7em;
        }
    }
    @media(max-width:404px){
        .profile-bottom {
            width: 100%;
        }
        .content-color {
            right: 9%;
            padding: 0.5em;
        }
        .profile-text td {
            font-size: 0.8em;
        }
        .top-content label {
            font-size: 1.6em;
        }
    }

</style>