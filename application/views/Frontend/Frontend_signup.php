<!--<div class="wrapper-page card-box">-->
<!--    <div class="text-center">-->
<!--        <a href="" class="logo logo-lg"><i class="md md-equalizer"></i> <span>1stepshop</span> </a>-->
<!--    </div>-->
<!--</div>-->
<div class="wrapper-page card-box">

    <div class="text-center">
        <a href="" class="logo logo-lg"><i class="md md-equalizer"></i> <span>1stepshop</span> </a>
    </div>

    <form class="form-horizontal m-t-20" action="<?php echo $loginPostUrl; ?>" method="POST" data-parsley-validate novalidate>
        <?php print_r($succesMsg); ?>
        <div class="form-group">
            <div class="col-xs-12">
                <p>Please login</p>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <input type="text" name="userName" parsley-trigger="change" required placeholder="Username" class="form-control btn-rounded" id="userName">
                <i class="fa fa-user form-control-feedback l-h-34"></i>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <input  type="password" name="password" parsley-trigger="change" required  placeholder="Password" class="form-control btn-rounded" id="password">
                <i class="md md-vpn-key form-control-feedback l-h-34"></i>
            </div>
        </div>
        <div class="form-group m-t-30  text-right">
            <div class="col-xs-12">
                <a href="javascript:void(0)" class="text-muted" onclick="loadAddOrEditContentWithModal('forgotPassword','sendOTP=0','modalContentArea')"><i class="fa fa-lock m-r-5"></i> Forgot your
                    password?</a>
            </div>
            <div class="col-sm-5 text-right">

            </div>
        </div>
        <div class="form-group m-t-20">
            <div class="col-xs-6">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-signup" type="checkbox">
                    <label for="checkbox-signup">
                        Remember me
                    </label>
                </div>
            </div>
            <div class="col-xs-6  text-right">
                <button class="btn btn-primary btn-rounded btn-custom w-md waves-effect waves-light" type="submit">Log In
                </button>
            </div>
        </div>
        <hr/>
        <div class="form-group">    
            <div class="col-xs-12">
                    <label for="checkbox-signup">
                        Don't have an account yet?
                    </label>
                <p>Create an account <a >here</a></p>
            </div>
        </div>
    </form>
</div>
<style>
    body {
        padding-bottom: 0px !important;
    }
    .card-box{
        margin-top: 100px !important;
    }
</style>