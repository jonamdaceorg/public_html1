<div id="page-wrapper" class="sign-in-wrapper">
    <div class="graphs">
        <form action="<?php echo $sendContactUsDetailsUrl; ?>" method="post">
            <div class="sign-up">
                <h1>Contact Us</h1>

                <!--                <h2>Personal Information</h2>-->
                <?php echo $succesMsg; ?>
                <div class="sign-u">
                    <div class="sign-up1">
                        <h4>Name* :</h4>
                    </div>
                    <div class="sign-up2">
                        <input type="text" placeholder="Name" name="name" id="name" required=" "/>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="sign-u">
                    <div class="sign-up1">
                        <h4>Email Id* :</h4>
                    </div>
                    <div class="sign-up2">
                        <input type="text" placeholder="Email" name="email" id="email" required=" "/>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="sign-u">
                    <div class="sign-up1">
                        <h4>Mobile Number* :</h4>
                    </div>
                    <div class="sign-up2">
                        <input type="text" placeholder="Mobile Number" name="mobileNumber" id="mobileNumber"
                               maxlength="10" required=" "/>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="sign-u">
                    <div class="sign-up1">
                        <h4>Category* :</h4>
                    </div>
                    <div class="sign-up2">
                        <select class="selectboxWidth select2" name="categoryId" id="categoryId" style="padding-top: 15px;">
                            <option value="">Select Category</option>
                            <?php for($c=0; $c<count($categoryArray); $c++){ ?>
                                <option value="<?php echo $categoryArray[$c]['categoryId']; ?>"><?php echo $categoryArray[$c]['category']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="sign-u">
                    <div class="sign-up1">
                        <h4>Description* :</h4>
                    </div>
                    <div class="sign-up2">
                        <textarea name="description" id="description" cols="30" rows="5" required=" "
                                  class="form-control"></textarea>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="sub_home">
                    <div class="sub_home_left">
                        <input type="submit" value="Submit">
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

<script>
    $("#categoryId").select2();
</script>
