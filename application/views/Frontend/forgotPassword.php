<link rel="stylesheet" href="<?php echo base_url(); ?>assets/validation/css/formValidation.css"/>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/validation/js/formValidation.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/validation/js/framework/bootstrap.js"></script>

<div id="page-wrapper" class="sign-in-wrapper">
    <div class="graphs">
        <div class="sign-in-form">
            <div class="sign-in-form-top new_people">
                <h2>Forgot Password</h2>
            </div>
            <h2></h2>
            <p class="text-info">We have sent an OTP via SMS to your registered Mobile Number. (<?php echo $mobileNumber; ?>)</p>
            <p><br/></p>
            <?php echo $succesMsg; ?>
            <div class="signin">
                <form action="<?php echo $confirmOtpUrl; ?>" method="POST" id="defaultForm" class="form-horizontal">
                    <input type="hidden" placeholder="Mobile Number" name="mobileNumber" id="mobileNumber" value="<?php echo $mobileNumber; ?>"/>
                    <?php echo $succesMsg; ?>
                    <div class="log-input">
                        <div class="log-input-left">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="password" class="lock" placeholder="OTP" name="otpText" id="otpText"/>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="log-input">
                        <div class="log-input-left">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="password" class="lock" placeholder="Password" name="password"
                                           id="password"/>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="log-input">
                        <div class="log-input-left">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="password" class="lock" placeholder="Confirm Password" name="confirmPassword" id="confirmPassword" />
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="signin-rit">
<!--								<span class="checkbox1">-->
<!--									 <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">Forgot-->
<!--                                         Password ?</a>-->
<!--								</span>-->

                        <p></p>

                        <div class="clearfix"></div>
                    </div>
                    <input type="submit" value="Confirm">
                </form>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function () {
            $('#defaultForm').formValidation({
                message: 'This value is not valid',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    otpText: {
                        validators: {
                            notEmpty: {
                                message: 'The OTP is required'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'The Password is required'
                            },
                            stringLength: {
                                min: 6,
                                max: 10,
                                message: 'The Password must be more than 6 and less than 10 characters long'
                            },
                            regexp: {
                                regexp : /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{6,}$/,
                                message : 'The Password must contain at least one number, one lowercase and one uppercase letter'
                            }
                        }
                    },
                    confirmPassword: {
                        validators: {
                            notEmpty: {
                                message: 'The Confirm password is required'
                            },
                            stringLength: {
                                min: 6,
                                max: 10,
                                message: 'The Confirm password must be more than 6 and less than 10 characters long'
                            },
                            identical: {
                                field: 'password',
                                message: 'The Confirm password must be same as the Password'
                            }
                        }
                    }
                }
            });
        });
    </script>

</div>
<script>
    $('#myModal').modal('');
</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-sm  modal-md">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                &times;</button>

            <form action="confirmUserAndSendOtp" method="POST" name="forgotPasswordForm" id="forgotPasswordForm" class="form-horizontal">
                <h4 class="text-center">Forgot Password</h4>
                <br>
                <div class="log-input">
                    <div class="log-input-left">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="text" class="user" placeholder="Mobile Number" id="mobileNumber" maxlength="10"
                                       name="mobileNumber"/>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <input type="submit" value="Send Otp" class="btn btn-warning">
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#forgotPasswordForm').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                mobileNumber: {
                    message: 'The Mobile Number is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Mobile Number is required'
                        },
                        stringLength: {
                            min: 10,
                            max: 10,
                            message: 'The Mobile Number must be 10 characters long'
                        },
                        digits: {
                            message: 'The Mobile Number can only consist of number'
                        }
                    }
                }
            }
        });
    });
</script>