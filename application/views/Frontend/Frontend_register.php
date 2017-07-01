<link rel="stylesheet" href="<?php echo base_url(); ?>assets/validation/css/formValidation.css"/>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/validation/js/formValidation.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/validation/js/framework/bootstrap.js"></script>

<div id="page-wrapper" class="sign-in-wrapper">
    <div class="graphs">
        <form action="<?php echo $registerPostUrl; ?>" method="post" id="defaultForm" class="form-horizontal">
            <div class="sign-up">
                <h1>Create an account</h1>

<!--                <h2>Personal Information</h2>-->
                <?php echo $succesMsg; ?>
                <div class="sign-u">
                    <div class="sign-up1">
                        <h4>Mobile Number* :</h4>
                    </div>
                    <div class="sign-up2">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="text" placeholder="Mobile Number" name="mobileNumber" id="mobileNumber" maxlength="10" required=" "/>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="sign-u">
                    <div class="sign-up1">
                        <h4>Password* :</h4>
                    </div>
                    <div class="sign-up2">
                        <div class="form-group">
                            <div class="col-sm-12">
                        <input type="password" placeholder="Password" name="password" id="password" required=" "/>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="sign-u">
                    <div class="sign-up1">
                        <h4>Confirm Password* :</h4>
                    </div>
                    <div class="sign-up2">
                        <div class="form-group">
                            <div class="col-sm-12">
                        <input type="password" placeholder="Confirm Password" name="repassword" id="repassword"/>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="sign-u">
                    <div class="sign-up1">
                        <h4>First Name * :</h4>
                    </div>
                    <div class="sign-up2">
                        <div class="form-group">
                            <div class="col-sm-12">
                            <input type="text" placeholder="First Name" name="name" id="name" required=" "/>
                                </div>
                            </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="sign-u">
                    <div class="sign-up1">
                        <h4>Last Name :</h4>
                    </div>
                    <div class="sign-up2">
                        <div class="form-group">
                            <div class="col-sm-12">
                            <input type="text" placeholder="Last Name" name="lastname" id="lastname" />
                                </div>
                            </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="sign-u">
                    <div class="sign-up1">
                        <h4>Email Id* :</h4>
                    </div>
                    <div class="sign-up2">
                        <div class="form-group">
                            <div class="col-sm-12">

                            <input type="text" placeholder="Email" name="email" id="email" required=" "/>
                                </div>
                            </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="sign-u">
                    <div class="sign-up1">
                        <h4>State :</h4>
                    </div>
                    <div class="sign-up2">
                        <?php //print_r($stateArray);?>
                        <select name="stateId" id="stateId" class="selectboxWidth form-control select2"
                                onchange="getCommonSelectBox(this.value, 'districtDiv')" style="margin: 1.6em 0 1em">
                            <option value="">Select State</option>
                            <?php for ($s = 0; $s < count($stateArray); $s++) { ?>
                                <option
                                    value="<?php echo $stateArray[$s]['stateId'] ?>"><?php echo $stateArray[$s]['state'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="sign-u">
                    <div class="sign-up1">
                        <h4>City :</h4>
                    </div>
                    <div class="sign-up2" id="districtDiv">
                        <select name="districtId" id="districtId" class="selectboxWidth form-control select2">
                            <option value="">Select City</option>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="sign-u">
                    <div class="sign-up1">
                        <h4>Address* :</h4>
                    </div>
                    <div class="sign-up2">
                        <div class="form-group">
                            <div class="col-sm-12">

                        <textarea name="Address" id="Address" cols="30" rows="5" required=" "
                                  class="form-control"></textarea>
                                </div>
                            </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="sub_home">
                    <div class="sub_home_left">
                        <input type="submit" value="Create">
                    </div>
                    <div class="sub_home_right">
                        <p>Go Back to <a href="<?php echo base_url(); ?>">Home</a></p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </form>
    </div>
</div>
<input type="hidden" name="getCommonSelectBoxUrl" id="getCommonSelectBoxUrl" value="<?php echo $getCommonSelectBoxUrl; ?>">
<script>
    function getCommonSelectBox(upperActionId, divId) {
        var getCommonSelectBoxUrl = $("#getCommonSelectBoxUrl").val();
        var postFormData = "upperActionId=" + upperActionId + "&divId=" + divId
        $.ajax({
            url: getCommonSelectBoxUrl,
            type: "get",
            data: postFormData,
            success: function (responseFromSite) {

                $("#" + divId).html(responseFromSite);
                // $("#addOrEditUserDetailsForm").parsley();
                if (divId == "stateDiv") {
                    $("#stateId").select2();
                }

                if (divId == "districtDiv") {
                    $("#districtId").select2();
                }

                if (divId == "subCategoryIdDiv") {
                    $("#subCategoryId").select2();
                }
            }
        });
    }

</script>

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
                mobileNumber: {
                    message: 'The Mobile Number is not valid',
                    validators: {
                        digits: {},
                        notEmpty: {
                            message: 'The Mobile Number is required'
                        },
                        stringLength: {
                            min: 10,
                            max: 10,
                            message: 'The Mobile Number must be more than 10 and less than 10 digits long'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: 'The Mobile Number can only consist of alphabetical, number, dot and underscore'
                        }
                    }
                },
                name: {
                    message: 'The Name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The first name is required'
                        },
                        stringLength: {
                            max: 30,
                            message: 'The first name must be less than 30 characters long'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z_\.]+$/,
                            message: 'The first name can only consist of alphabetical'
                        }
                    }
                },
                Address: {
                    message: 'The Address is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Address is required'
                        },
                        stringLength: {
                            max: 30,
                            message: 'The Address must be less than 30 characters long'
                        }
                    }
                },
                email: {
                    message: 'The email is not valid',
                    validators: {
                        emailAddress: {},
                        notEmpty: {
                            message: 'The email is required'
                        },
                        stringLength: {
                            max: 30,
                            message: 'The email must be more less than 30 characters long'
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
                        different: {
                            field: 'mobileNumber',
                            message: 'The Password cannot be the same as Mobile Number'
                        },
                        regexp: {
                            regexp : /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{6,}$/,
                            message : 'The Password must contain at least one number, one lowercase and one uppercase letter'
                        }
                    }
                },
                repassword: {
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

<style>
    .form-horizontal .has-feedback .form-control-feedback {
        padding-top: 18px !important;
    }
    .help-block {

        margin-top: -5px !important;
        margin-bottom: 5px !important;
    }
    textarea.form-control {
        margin-bottom: 10px;
    }
    @media (max-width: 414px){
        .form-horizontal .has-feedback .form-control-feedback {
            padding-top: 6px !important;
        }
        .help-block {

            margin-top: 5px !important;
            margin-bottom: -20px !important;
        }
    }
</style>