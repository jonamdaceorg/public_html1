<div id="page-wrapper" class="sign-in-wrapper">
    <div class="graphs">
        <form action="<?php echo $confirmOtpUrl; ?>" method="post">
            <div class="sign-up">
                <h1>Activate Your Profile</h1>
                <h2></h2>
                <?php echo $succesMsg; ?>
                <div class="sign-u">
                    <div class="sign-up1">
                        <h4>Mobile Number :</h4>
                    </div>
                    <div class="sign-up2">
                        <input type="text" <?php if($activateMobileNumber!='') { echo 'readonly';  }  ?> placeholder="Mobile Number" name="mobileNumber" id="mobileNumber" value="<?php echo $activateMobileNumber; ?>"/>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="sign-u">
                    <div class="sign-up1">
                        <h4>Enter Otp* :</h4>
                    </div>
                    <div class="sign-up2">
                            <input type="text" placeholder="OTP" name="otpText" id="otpText" maxlength="6" required=" "/>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="sub_home">
                    <div class="sub_home_left">
                            <input type="submit" value="Confirm">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </form>
    </div>
</div>
