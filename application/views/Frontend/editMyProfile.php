<link rel="stylesheet" href="<?php echo base_url(); ?>assets/validation/css/formValidation.css"/>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/validation/js/formValidation.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/validation/js/framework/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/web/js/bootstrap-filestyle.min.js"></script>

<?php

    $name = "";
    $mobile = "";
    $email = "";
    $districtId = "";
    $stateId = "";
    $countryId = "";
    $address = "";
    $lastlogin = "";

    if(count($userDataArray)>0){
        $name = $userDataArray[0]['name'];
        $mobile = $userDataArray[0]['mobile'];
        $email = $userDataArray[0]['email'];
        $districtId = $userDataArray[0]['districtId'];
        $stateId = $userDataArray[0]['stateId'];
        $countryId = $userDataArray[0]['countryId'];
        $address = $userDataArray[0]['address'];
        $lastlogin = $userDataArray[0]['lastlogin'];
    }
?>
<div id="page-wrapper" class="sign-in-wrapper">
    <div class="graphs">
        <div class="sign-up">
            <form action="<?php echo $updateMyProfileUrl; ?>" method="POST" id="editMyProfileForm" name="editMyProfileForm" class="form-horizontal" enctype="multipart/form-data">
                <?php echo $succesMsg; ?>

                <div class="sign-u">
                    <div class="sign-up1">
                        <h4>Name* :</h4>
                    </div>
                    <div class="sign-up2">
                        <div class="form-group">
                            <div class="col-sm-12">
                        <input type="text" placeholder="Name" name="name" id="name" value="<?php echo $name;?>"/>
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
                                <input type="text" placeholder="Email" name="email" id="email" value="<?php echo $email;?>"/>
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
                        <div class="form-group">
                            <div class="col-sm-12">
                                <select name="stateId" id="stateId" class="selectboxWidth form-control select2"
                                        onchange="getDistrictSelectBox(this.value, '', 'districtDiv')">
                                    <option value="">Select State</option>
                                    <?php for ($s = 0; $s < count($stateArray); $s++) { ?>
                                        <option
                                            value="<?php echo $stateArray[$s]['stateId'] ?>" <?php if($stateId==$stateArray[$s]['stateId']){ echo 'selected'; } ?>><?php echo $stateArray[$s]['state'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="sign-u">
                    <div class="sign-up1">
                        <h4>City :</h4>
                    </div>
                    <div class="sign-up2">
                        <div class="form-group">
                            <div class="col-sm-12" id="districtDiv">
                                <select name="districtId" id="districtId" class="selectboxWidth form-control select2">
                                    <option value="">Select City</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="sign-u">
                    <div class="sign-up1">
                        <h4>Address * :</h4>
                    </div>
                    <div class="sign-up2">
                        <div class="form-group">
                            <div class="col-sm-12" id="districtDiv">
                                <textarea name="address" id="address" cols="30" rows="5" class="form-control"><?php echo $address; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="sign-u">
                    <div class="sign-up1">
                        <h4>Profile Photo :</h4>
                    </div>
                    <div class="sign-up2">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <?php
                                    $userProfiles = $this->users_model->getUserProfilePhoto($userDataArray[0]['userCode'], $userDataArray[0]['img']);

                                ?>
                                <img src="<?php echo $userProfiles; ?>" title="edit profile" alt="edit profile" class="img-responsive img" style="height: 150px"/>

                                <input type="file" class="form-control" id="input01" name="userFile"/>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="sub_home">
                    <div class="sub_home_left">

                    </div>
                    <div class="sub_home_right">
                        <input type="submit" value="Update My Profile"  style="padding: 10px;">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .filebtn{
        margin-top: 20px;
        padding-bottom: 20px;
    }
    .form-group{
        margin: 1em 0px;
    }
</style>

<input type="hidden" name="getCommonSelectBoxUrl" id="getCommonSelectBoxUrl" value="<?php echo $getCommonSelectBoxUrl; ?>">
<script>
    function getDistrictSelectBox(upperActionId, selectedId, divId) {
        var getCommonSelectBoxUrl = $("#getCommonSelectBoxUrl").val();
        var postFormData = "upperActionId=" + upperActionId + "&divId=" + divId+ "&actionId=" + selectedId;
        $.ajax({
            url: getCommonSelectBoxUrl,
            type: "get",
            data: postFormData,
            success: function (responseFromSite) {

                $("#" + divId).html(responseFromSite);
                if (divId == "stateDiv") {
                    $("#stateId").select2();
                }

                if (divId == "districtDiv") {
                    $("#districtId").select2();
                    $("#districtId").addClass("form-control");
                }
            }
        });
    }

</script>
<?php if($stateId!="" && $stateId>0) { ?>
    <script>
        getDistrictSelectBox("<?php echo $stateId; ?>", "<?php echo $districtId; ?>", 'districtDiv');
    </script>
<?php
    }
?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#editMyProfileForm').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                name: {
                    message: 'The name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The name is required'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: 'The name can only consist of alphabetical, number, dot and underscore'
                        }
                    }
                },
                email: {
                    message: 'The Email is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Email is required'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        }
                    }
                },
                address: {
                    message: 'The Address is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Address is required'
                        }
                    }
                }
            }
        });
    });
    $('#input01').filestyle({
        iconName : 'glyphicon glyphicon-picture',
        buttonText : 'Choose file'
    })
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