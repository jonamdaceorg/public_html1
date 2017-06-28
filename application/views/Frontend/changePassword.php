<link rel="stylesheet" href="<?php echo base_url(); ?>assets/validation/css/formValidation.css"/>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/validation/js/formValidation.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/validation/js/framework/bootstrap.js"></script>

<div id="page-wrapper" class="sign-in-wrapper">
    <div class="graphs">
        <div class="sign-in-form">
            <div class="sign-in-form-top new_people">
                <h2>Change Password</h2>
            </div>
            <div class="signin">
                <form action="<?php echo $updatePasswordUrl; ?>" method="POST" id="changePasswordForm" name="changePasswordForm" class="form-horizontal">
                    <?php echo $succesMsg; ?>
                    <div class="log-input">
                        <div class="log-input-left">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="password" class="lock" placeholder="Password" name="newPassword"
                                           id="newPassword"/>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="log-input">
                        <div class="log-input-left">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="password" class="lock" placeholder="Re-enter New Password" name="rePassword"
                                           id="rePassword"/>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <input type="submit" value="Update">
                </form>

            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function () {
        $('#changePasswordForm').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                newPassword: {
                    message: 'The Password is not valid',
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
                rePassword: {
                    message: 'The Re-Password is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Re-Password is required'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: 'The Re-Password can only consist of alphabetical, number, dot and underscore'
                        }
                    }
                }
            }
        });
    });
</script>