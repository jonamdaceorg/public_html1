<?php
/**
 * Created by IntelliJ IDEA.
 * User: root
 * Date: 9/10/16
 * Time: 10:51 PM
 */
?>
<div class="panel panel-color panel-primary">
    <div class="panel-heading">
        <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="panel-title"><?php echo $actionType . " " . $title; ?></h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal group-border-dashed" action="<?php echo $insertOrUpdateMasterUrl; ?>" method="POST"
              name="addOrEditUserDetailsForm" id="addOrEditUserDetailsForm" data-parsley-validate novalidate>
            <input type="hidden" name="actionType" id="actionType" value="<?php echo $actionType; ?>">
            <input type="hidden" name="actionId" id="actionId" value="<?php echo $actionId; ?>">
            <input type="hidden" name="getCommonSelectBoxUrl" id="getCommonSelectBoxUrl" value="<?php echo $getCommonSelectBoxUrl; ?>">
            <input type="hidden" name="title" id="title" value="<?php echo $title; ?>">

            <?php if ($title == "Category Master") {
                $catgory = "";
                $isAmountRequired = "";
                $orders = "";
                $isOfferAmountRequired = "";
                if (count($categoryArray) > 0) {
                    $catgory = $categoryArray[0]["category"];
                    $isAmountRequired = $categoryArray[0]["isAmountRequired"];
                    $orders = $categoryArray[0]["orders"];
                    $isOfferAmountRequired = $categoryArray[0]["isOfferAmountRequired"];

                }
                ?>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Category</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="category" name="category" required
                                   data-parsley-name="category" placeholder="Category" value="<?php echo $catgory; ?>"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Orders</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="orders" name="orders" required
                                   data-parsley-name="orders" placeholder="Orders" value="<?php echo $orders; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Is Amount</label>
                        <div class="col-sm-6">
                            <div class="checkBoxRow radio-info radio-inline">
                                <input type="checkbox" id="isAmountRequired" value="Required" name="isAmountRequired" <?php if($isAmountRequired=="Required"){ echo "checked"; } ?>>
                                <label for="isAmountRequired1"> Price </label>
                            </div>
                            <div class="checkBoxRow radio-warning  radio-inline">
                                <input type="checkbox" id="isOfferAmountRequired" value="Required" name="isOfferAmountRequired" <?php if($isOfferAmountRequired=="Required"){ echo "checked"; } ?>>
                                <label for="isAmountRequired2"> Offer Price </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-9 m-t-15">
                            <button type="submit" value="<?php echo $title; ?>" id="submit" name="submit"
                                    class="btn btn-primary waves-effect waves-light">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-default waves-effect m-l-5">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            <?php }/* else if ($title == "Sub Category Master") {
                $subcategory = "";
                $categoryId = "";

                if (count($subCategoryArray) > 0) {
                    $subcategory = $subCategoryArray[0]['subCategory'];
                    $categoryId = $subCategoryArray[0]['categoryId'];
                }

                ?>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Category</label>
                        <div class="col-sm-6">
                            <select name="categoryId" id="categoryId" class="form-control" parsley-trigger="change"
                                    required>
                                <option value="">Select Category</option>
                                <?php for ($c = 0; $c < count($categoryArray); $c++) { ?>
                                    <option
                                        value="<?php echo $categoryArray[$c]['categoryId']; ?>" <?php if ($categoryId == $categoryArray[$c]['categoryId']) {
                                        echo "selected";
                                    } ?> ><?php echo $categoryArray[$c]['category']; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Sub Category</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="subcategory" name="subcategory" required
                                   data-parsley-name="category" placeholder="Sub Category"
                                   value="<?php echo $subcategory; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-9 m-t-15">
                            <button type="submit" value="<?php echo $title; ?>" id="submit" name="submit"
                                    class="btn btn-primary waves-effect waves-light">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-default waves-effect m-l-5">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            <?php } */else if ($title == "Ad Banner Master") {
            $bannerTitle = "";
            $description = "";
            $bannerType = "";
            $bannerImage = "";
            $bannerImageUrl = "";
            $bannerAdsCode = "";
            $bannerLinkURL = "";
            $typeOfPosition = "";
            $startDate = "";
            $endDate = "";
            $height = "";
            $width = "";
            $isMobileView = "";
            $noOfDaysToActive = "";
            $status = "";

            if (count($adBannerArray) > 0) {

                    $adBannerDetailsArray = $adBannerArray[0];

                    $bannerTitle = $adBannerDetailsArray['title'];
                    $description = $adBannerDetailsArray['description'];
                    $bannerType = $adBannerDetailsArray['bannerType'];
                    $bannerImage = $adBannerDetailsArray['bannerImage'];
                    $bannerImageUrl = $adBannerDetailsArray['bannerImageUrl'];
                    $bannerAdsCode = $adBannerDetailsArray['adsCode'];
                    $bannerLinkURL = $adBannerDetailsArray['bannerLinkURL'];
                    $typeOfPosition = $adBannerDetailsArray['typeOfPosition'];
                    $startDate = $adBannerDetailsArray['startDate'];
                    $endDate = $adBannerDetailsArray['endDate'];
                    $height = $adBannerDetailsArray['height'];
                    $width = $adBannerDetailsArray['width'];
                    $isMobileView = $adBannerDetailsArray['isMobileView'];
                    $status = $adBannerDetailsArray['active'];
                    $noOfDaysToActive = "";


                }
                ?>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Banner Title</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="bannerTitle" name="bannerTitle" required
                                   data-parsley-name="Banner title" placeholder="Banner title" value="<?php echo $bannerTitle; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="description" name="description" required
                                   data-parsley-name="description" placeholder="Description" ><?php echo $description; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Ad Banner Type</label>
                        <div class="col-sm-6">
                            <select name="bannerType" id="bannerType" class="form-control" parsley-trigger="change"
                                    required onchange="loadBannerImageDiv(this.value)">
                                <option value="">Select Banner Type</option>
                                <option value="bannerImage" <?php if($bannerType == "bannerImage"){ echo "selected"; } ?>>Banner Image upload</option>
                                <option value="bannerImageUrl" <?php if($bannerType == "bannerImageUrl"){ echo "selected"; } ?> >Banner Image URL</option>
                                <option value="bannerAdsCode" <?php if($bannerType == "bannerAdsCode"){ echo "selected"; } ?> >Banner Ads Code</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="bannerImageDiv">
                    <div class="row">
                        <label class="col-sm-3 control-label">Banner Image</label>
                        <div class="col-sm-6">
                            <input type="file" class="form-control" id="bannerImage" name="bannerImage"
                                   data-parsley-name="bannerImage" placeholder="Banner Image" value="<?php echo $bannerImage; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="bannerImageUrlDiv">
                    <div class="row">
                        <label class="col-sm-3 control-label">Banner ImageUrl</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="bannerImageUrl" name="bannerImageUrl"
                                   data-parsley-name="bannerImageUrl" placeholder="Banner ImageUrl" value="<?php echo $bannerImageUrl; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="bannerAdsCodeDiv">
                    <div class="row">
                        <label class="col-sm-3 control-label">Banner Ads Code</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="bannerAdsCode" name="bannerAdsCode"
                                   data-parsley-name="bannerAdsCode" placeholder="Banner Ads Code" ><?php echo $bannerAdsCode; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Banner Link URL</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="bannerLinkURL" name="bannerLinkURL" required
                                   data-parsley-name="bannerLinkURL" placeholder="Banner Link URL" value="<?php echo $bannerLinkURL; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Type Of Position</label>
                        <div class="col-sm-6">
                            <select name="typeOfPosition" id="typeOfPosition" class="form-control" parsley-trigger="change"
                                    required>
                                <option value="">Select Type Of Position</option>
                                <option value="Top" <?php if($typeOfPosition == "Top"){ echo "selected"; } ?> >Top</option>
                                <option value="Bottom" <?php if($typeOfPosition == "Bottom"){ echo "selected"; } ?> >Bottom</option>
                                <option value="Left" <?php if($typeOfPosition == "Left"){ echo "selected"; } ?> >Left</option>
                                <option value="Right" <?php if($typeOfPosition == "Right"){ echo "selected"; } ?>>Right</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Date</label>
                        <div class="col-sm-6">
                            <div class="">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="startDate" name="startDate" required
                                               data-parsley-name="startDate" placeholder="start Date" value="<?php echo $startDate; ?>"/>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="endDate" name="endDate" required
                                               data-parsley-name="endDate" placeholder="end Date" value="<?php echo $endDate; ?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Dimension</label>
                        <div class="col-sm-6">
                            <div class="">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="height" name="height" required
                                               data-parsley-name="height" placeholder="height" value="<?php echo $height; ?>"/>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="width" name="width" required
                                               data-parsley-name="width" placeholder="width" value="<?php echo $width; ?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!--                <div class="form-group">-->
<!--                    <div class="row">-->
<!--                        <label class="col-sm-3 control-label">No Of Days Active</label>-->
<!--                        <div class="col-sm-6">-->
<!--                            <input type="text" class="form-control" id="noOfDaysToActive" name="noOfDaysToActive" required-->
<!--                                   data-parsley-name="noOfDaysToActive" placeholder="no Of Days To Active" value="--><?php //echo $catgory; ?><!--"/>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Is MobileView</label>
                        <div class="col-sm-6">
                            <div class="checkBoxRow radio-info radio-inline">
                                <input type="radio" value="Yes" name="isMobileView" <?php if($isMobileView=="Yes"){ echo "checked"; } ?>>
                                <label for="isMobileView"> Yes </label>
                            </div>
                            <div class="checkBoxRow radio-warning  radio-inline">
                                <input type="radio" value="No" name="isMobileView" <?php if($isMobileView=="No"){ echo "checked"; } ?>>
                                <label for="isMobileView"> No</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-6">
                            <select name="status" id="status" class="form-control select2">
                                <option value="active" <?php if($status == "active"){ echo "selected"; } ?>>active</option>
                                <option value="deleted" <?php if($status == "deleted"){ echo "selected"; } ?>>deleted</option>
                                <option value="expired" <?php if($status == "expired"){ echo "selected"; } ?>>expired</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-9 m-t-15">
                            <button type="submit" value="<?php echo $title; ?>" id="submit" name="submit"
                                    class="btn btn-primary waves-effect waves-light">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-default waves-effect m-l-5">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
                <script>
                    $('#startDate').datepicker({
                        format: 'yyyy-mm-dd'

                    });
                    $('#endDate').datepicker({
                        format: 'yyyy-mm-dd'

                    });
                    $("#bannerType").select2();
                    $("#typeOfPosition").select2();
                    $("#status").select2();
                    loadBannerImageDiv("");
                    function loadBannerImageDiv(bannerType){
                        if(bannerType == "") {
                            $("#bannerImageDiv").hide();
                            $("#bannerImageUrlDiv").hide();
                            $("#bannerAdsCodeDiv").hide();
                        } else if(bannerType == "bannerImage"){
                            $("#bannerImageDiv").show();
                            $("#bannerImageUrlDiv").hide();
                            $("#bannerAdsCodeDiv").hide();
                        } else if(bannerType == "bannerImageUrl"){
                            $("#bannerImageDiv").hide();
                            $("#bannerImageUrlDiv").show();
                            $("#bannerAdsCodeDiv").hide();
                        } else if(bannerType == "bannerAdsCode"){
                            $("#bannerImageDiv").hide();
                            $("#bannerImageUrlDiv").hide();
                            $("#bannerAdsCodeDiv").show();
                        }
                    }

                </script>



            <?php if (count($adBannerArray) > 0) { ?>
                <script>
                    loadBannerImageDiv("<?php echo $bannerType; ?>");
                </script>

            <?php } ?>
            <?php } else if ($title == "Sub Category Master") {
            $subcategory = "";
            $categoryId = "";

            if (count($subCategoryArray) > 0) {
                $subcategory = $subCategoryArray[0]['subCategory'];
                $categoryId = $subCategoryArray[0]['categoryId'];
            }

            ?>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Category</label>
                        <div class="col-sm-6">
                            <select name="categoryId" id="categoryId" class="form-control" parsley-trigger="change"
                                    required>
                                <option value="">Select Category</option>
                                <?php for ($c = 0; $c < count($categoryArray); $c++) { ?>
                                    <option
                                        value="<?php echo $categoryArray[$c]['categoryId']; ?>" <?php if ($categoryId == $categoryArray[$c]['categoryId']) {
                                        echo "selected";
                                    } ?> ><?php echo $categoryArray[$c]['category']; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Sub Category</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="subcategory" name="subcategory" required
                                   data-parsley-name="category" placeholder="Sub Category"
                                   value="<?php echo $subcategory; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-9 m-t-15">
                            <button type="submit" value="<?php echo $title; ?>" id="submit" name="submit"
                                    class="btn btn-primary waves-effect waves-light">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-default waves-effect m-l-5">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            <?php }else if ($title == "Item Master") {
                $item = "";
                $subCategoryId = "";
                $categoryId = "";

                if (count($itemArray) > 0) {
                    $item = $itemArray[0]['item'];
                    $subCategoryId = $itemArray[0]['subCategoryId'];
                    $categoryId = $itemArray[0]['categoryId'];
                }

                ?>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Category</label>
                        <div class="col-sm-6">
                            <select name="categoryId" id="categoryId" class="form-control" onchange="getCommonSelectBox(this.value, 'subCategoryIdDiv')" parsley-trigger="change"
                                    required>
                                <option value="">Select Category</option>
                                <?php for ($c = 0; $c < count($categoryArray); $c++) { ?>
                                    <option
                                        value="<?php echo $categoryArray[$c]['categoryId']; ?>" <?php if ($categoryId == $categoryArray[$c]['categoryId']) {
                                        echo "selected";
                                    } ?> ><?php echo $categoryArray[$c]['category']; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Sub Category</label>
                        <div class="col-sm-6" id="subCategoryIdDiv">
                            <select name="subCategoryId" id="subCategoryId" class="form-control" parsley-trigger="change"
                                    required>
                                <option value="">Select Sub Category</option>
                                <?php for ($c = 0; $c < count($subCategoryArray); $c++) { ?>
                                    <option
                                        value="<?php echo $subCategoryArray[$c]['subCategoryId']; ?>" <?php if ($subCategoryId == $subCategoryArray[$c]['subCategoryId']) {
                                        echo "selected";
                                    } ?> ><?php echo $subCategoryArray[$c]['subCategory']; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Item</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="item" name="item" required
                                   data-parsley-name="item" placeholder="Item"
                                   value="<?php echo $item; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-9 m-t-15">
                            <button type="submit" value="<?php echo $title; ?>" id="submit" name="submit"
                                    class="btn btn-primary waves-effect waves-light">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-default waves-effect m-l-5">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            <?php } else if ($title == "Country Master") {
                $country = "";

                if (count($countryArray) > 0) {
                    $country = $countryArray[0]["country"];
                }

                ?>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Country</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="country" name="country" required
                                   data-parsley-name="Country" placeholder="Country" value="<?php echo $country; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-9 m-t-15">
                            <button type="submit" value="<?php echo $title; ?>" id="submit" name="submit"
                                    class="btn btn-primary waves-effect waves-light">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-default waves-effect m-l-5">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            <?php } else if ($title == "State Master") {
                $state = "";
                $countryId = "";

                if (count($stateArray) > 0) {
                    $state = $stateArray[0]['state'];
                    $countryId = $stateArray[0]['countryId'];
                }

                ?>


                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Country</label>
                        <div class="col-sm-6">
                            <select name="countryId" id="countryId" class="form-control" parsley-trigger="change"
                                    required>
                                <option value="">Select Country</option>
                                <?php for ($c = 0; $c < count($countryArray); $c++) { ?>
                                    <option
                                        value="<?php echo $countryArray[$c]['countryId']; ?>" <?php if ($countryId == $countryArray[$c]['countryId']) {
                                        echo "selected";
                                    } ?> ><?php echo $countryArray[$c]['country']; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">State</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="state" name="state" required
                                   data-parsley-name="state" placeholder="State" value="<?php echo $state; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-9 m-t-15">
                            <button type="submit" value="<?php echo $title; ?>" id="submit" name="submit"
                                    class="btn btn-primary waves-effect waves-light">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-default waves-effect m-l-5">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            <?php } else if ($title == "District Master") {
                $stateId = "";
                $countryId = "";
                $district = "";

                if (count($districtArray) > 0) {
                    $stateId = $districtArray[0]['stateId'];
                    $countryId = $districtArray[0]['countryId'];
                    $district = $districtArray[0]['district'];
                }
                ?>

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Country</label>
                        <div class="col-sm-6">
                            <select name="countryId" id="countryId" class="form-control" onchange="getCommonSelectBox(this.value, 'stateDiv')" parsley-trigger="change"
                                    required>
                                <option value="">Select Country</option>
                                <?php for ($c = 0; $c < count($countryArray); $c++) { ?>
                                    <option
                                        value="<?php echo $countryArray[$c]['countryId']; ?>" <?php if ($countryId == $countryArray[$c]['countryId']) {
                                        echo "selected";
                                    } ?> ><?php echo $countryArray[$c]['country']; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">State</label>
                        <div class="col-sm-6" id="stateDiv">
                            <select name="stateId" id="stateId" class="form-control" parsley-trigger="change" required>
                                <option value="">Select State</option>
                                <?php for ($c = 0; $c < count($stateArray); $c++) { ?>
                                    <option
                                        value="<?php echo $stateArray[$c]['stateId']; ?>" <?php if ($stateId == $stateArray[$c]['stateId']) {
                                        echo "selected";
                                    } ?> ><?php echo $stateArray[$c]['state']; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">District</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="district" name="district" required
                                   data-parsley-name="District" placeholder="District" value="<?php echo $district; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-9 m-t-15">
                            <button type="submit" value="<?php echo $title; ?>" id="submit" name="submit"
                                    class="btn btn-primary waves-effect waves-light">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-default waves-effect m-l-5">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>


            <?php } else if ($title == "Sub District Master") {
                $stateId = "";
                $countryId = "";
                $districtId = "";
                $subDistrict = "";

                if (count($subDistrictArray) > 0) {
                    $stateId = $subDistrictArray[0]['stateId'];
                    $countryId = $subDistrictArray[0]['countryId'];
                    $districtId = $subDistrictArray[0]['districtId'];
                    $subDistrict = $subDistrictArray[0]['subDistrict'];
                }
                ?>

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Country</label>
                        <div class="col-sm-6">
                            <select name="countryId" id="countryId" class="form-control" onchange="getCommonSelectBox(this.value, 'stateDiv')" parsley-trigger="change"
                                    required>
                                <option value="">Select Country</option>
                                <?php for ($c = 0; $c < count($countryArray); $c++) { ?>
                                    <option
                                        value="<?php echo $countryArray[$c]['countryId']; ?>" <?php if ($countryId == $countryArray[$c]['countryId']) {
                                        echo "selected";
                                    } ?> ><?php echo $countryArray[$c]['country']; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">State</label>
                        <div class="col-sm-6" id="stateDiv">
                            <select name="stateId" id="stateId" class="form-control" parsley-trigger="change" onchange="getCommonSelectBox(this.value, 'districtDiv')" required>
                                <option value="">Select State</option>
                                <?php for ($c = 0; $c < count($stateArray); $c++) { ?>
                                    <option
                                        value="<?php echo $stateArray[$c]['stateId']; ?>" <?php if ($stateId == $stateArray[$c]['stateId']) {
                                        echo "selected";
                                    } ?> ><?php echo $stateArray[$c]['state']; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">District</label>
                        <div class="col-sm-6" id="districtDiv">
                            <select name="districtId" id="districtId" class="form-control" parsley-trigger="change" required>
                                <option value="">Select District</option>
                                <?php for ($c = 0; $c < count($districtArray); $c++) { ?>
                                    <option
                                        value="<?php echo $districtArray[$c]['districtId']; ?>" <?php if ($districtId == $districtArray[$c]['districtId']) {
                                        echo "selected";
                                    } ?> ><?php echo $districtArray[$c]['district']; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Sub District</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="subDistrict" name="subDistrict" required
                                   data-parsley-name="Sub District" placeholder="Sub District" value="<?php echo $subDistrict; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-9 m-t-15">
                            <button type="submit" value="<?php echo $title; ?>" id="submit" name="submit"
                                    class="btn btn-primary waves-effect waves-light">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-default waves-effect m-l-5">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>


            <?php } else if ($title == "Reporting Master") {
                $adsReporting = "";

                if (count($adsReportingArray) > 0) {
                    $adsReporting = $adsReportingArray[0]["reportingType"];
                }

                ?>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Reporting Type</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="adsReporting" name="adsReporting" required
                                   data-parsley-name="adsReporting" placeholder="Reporting Type"
                                   value="<?php echo $adsReporting; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-9 m-t-15">
                            <button type="submit" value="<?php echo $title; ?>" id="submit" name="submit"
                                    class="btn btn-primary waves-effect waves-light">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-default waves-effect m-l-5">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>


            <?php } else if ($title == "Membership Package Master") {
                $membershippackage = "";
                $packageAmount = "";
                $noOfDaysToActive = "";
                if (count($membershipPackageArray) > 0) {
                    $membershippackage = $membershipPackageArray[0]['membershipPackageTitle'];
                    $noOfDaysToActive = $membershipPackageArray[0]['noOfDaysToActive'];
                    $packageAmount = $membershipPackageArray[0]['packageAmount'];
                }
                ?>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Package Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="membershippackage" name="membershippackage"
                                   required
                                   data-parsley-name="Package" placeholder="Package Name"
                                   value="<?php echo $membershippackage; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">No.of Days</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="noOfDaysToActive" name="noOfDaysToActive"
                                   required
                                   data-parsley-name="No.of Days" placeholder="No.of Days"
                                   value="<?php echo $noOfDaysToActive; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Package Amount</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="packageAmount" name="packageAmount" required
                                   data-parsley-name="packageAmount" placeholder="Package Amount"
                                   value="<?php echo $packageAmount; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-9 m-t-15">
                            <button type="submit" value="<?php echo $title; ?>" id="submit" name="submit"
                                    class="btn btn-primary waves-effect waves-light">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-default waves-effect m-l-5">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            <?php } else if ($title == "User Profile") {

                $address = "";
                $email = "";
                $mobile = "";
                $password = "";
                
                if(count($profileArray)>0){
                    $address = $profileArray['address'];
                    $email = $profileArray['email'];
                    $mobile = $profileArray['mobile'];
                    $password = $profileArray['password'];
                }

                ?>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="email" name="email" parsley-trigger="change" required placeholder="Email ID" value="<?php echo $email; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="password" name="password" parsley-trigger="change" required placeholder="Password" value="<?php echo $password; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Mobile</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="mobile" name="mobile" parsley-trigger="change" required placeholder="Mobile" value="<?php echo $mobile; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Address</label>
                        <div class="col-sm-6">
                            <textarea class="form-control autogrow" id="address" name="address" parsley-trigger="change" required placeholder="Address" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"><?php echo $address; ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Upload Profile Photo</label>
                        <div class="col-sm-6">
                            <input type="file" class="md-file-upload  fileupload" id="profilephoto" name="profilephoto" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-9 m-t-15">
                            <button type="submit" value="<?php echo $title; ?>" id="submit" name="submit"
                                    class="btn btn-primary waves-effect waves-light">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-default waves-effect m-l-5">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>

            <?php } else if ($title == "Users"  || $title == "Users Master") {

                $name = "";
                $email = "";
                $mobile = "";
                $password = "";
                $address = "";
                $districtId = "";
                $stateId = "";

                if(count($usersArray)>0){
                    $name = $usersArray[0]['name'];
                    $email = $usersArray[0]['email'];
                    $mobile = $usersArray[0]['mobile'];
                    $password = $usersArray[0]['password'];
                    $address = $usersArray[0]['address'];
                    $districtId = $usersArray[0]['districtId'];
                    $stateId = $usersArray[0]['stateId'];
                }

                ?>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Mobile Number</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="mobileNumber" name="mobileNumber" parsley-trigger="change" required placeholder="Mobile Number" value="<?php echo $mobile; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="password" name="password" parsley-trigger="change" required placeholder="Password" value="<?php echo $password; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="name" name="name" parsley-trigger="change" required placeholder="Name" value="<?php echo $name; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Email Id</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="email" name="email" parsley-trigger="change" required placeholder="Email ID" value="<?php echo $email; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">State</label>
                        <div class="col-sm-6">
                            <select name="stateId" id="stateId" class="form-control" onchange="getCommonSelectBox(this.value, 'districtInAddOrEditDiv')">
                                <option value="">Select State</option>
                                <?php for($s=0; $s<count($stateArray); $s++){ ?>
                                    <option value="<?php echo $stateArray[$s]['stateId']?>" <?php if($stateId==$stateArray[$s]['stateId']){ echo 'selected'; }?>><?php echo $stateArray[$s]['state']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">City</label>
                        <div class="col-sm-6" id="districtInAddOrEditDiv">
                            <select name="districtId" id="districtId"  class="form-control" onchange="">
                                <option value="">Select City</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Address</label>
                        <div class="col-sm-6" id="districtDiv">
                            <input type="text" placeholder="Address" name="address" id="address" required=" " class="form-control" value="<?php echo $address;  ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-9 m-t-15">
                            <button type="submit" value="<?php echo $title; ?>" id="submit" name="submit"
                                    class="btn btn-primary waves-effect waves-light">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-default waves-effect m-l-5">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
                <?php

                    if($stateId!=""){ ?>
			<script>
                            getCommonSelectBox("<?php echo $stateId; ?>", 'districtInAddOrEditDiv');
                            alert("Loading...");
                            var cityId = "<?php echo $districtId; ?>";
                            $("#districtId").val(cityId);
                        </script>                    
                        <?php
                    }
                ?>

            <?php } else if ($title == "Dynamic Fields") {
                    $dynamicInputType = "";
                    $capturedvariablename = "";
                    $categoryId = "";
                    $dynamicInputId = "";
                    $isSearchable = "";
                    $searchType = "";
                    if(count($dynamicAdsVariableList)>0){
                        $dynamicInputType = $dynamicAdsVariableList[0]['dynamicInputType'];
                        $capturedvariablename = $dynamicAdsVariableList[0]['capturedvariablename'];
                        $categoryId = $dynamicAdsVariableList[0]['categoryId'];
                        $subCategoryId = $dynamicAdsVariableList[0]['subCategoryId'];
                        $dynamicInputId = $dynamicAdsVariableList[0]['dynamicInputId'];
                        $isSearchable = $dynamicAdsVariableList[0]['isSearchable'];
                        $searchType = $dynamicAdsVariableList[0]['searchType'];

                    }
                    ?>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Category</label>
                        <div class="col-sm-6">
                            <select name="categoryId" id="categoryId" class="form-control"onchange="checkFieldsTypeAndLoadContent(FieldsType.value, '<?php echo $actionType; ?>'); getCommonSelectBox(this.value, 'subCategoryIdDiv')" parsley-trigger="change"
                                    required>
                                <option value="">Select Category</option>
                                <?php for ($c = 0; $c < count($categoryArray); $c++) { ?>
                                    <option
                                        value="<?php echo $categoryArray[$c]['categoryId']; ?>" <?php if ($categoryId == $categoryArray[$c]['categoryId']) {
                                        echo "selected";
                                    } ?> ><?php echo $categoryArray[$c]['category']; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Sub Category</label>
                        <div class="col-sm-6" id="subCategoryIdDiv">
                            <select name="subCategoryId" id="subCategoryId" class="form-control" onchange="checkFieldsTypeAndLoadContent(FieldsType.value, '<?php echo $actionType; ?>')" parsley-trigger="change"
                                    required>
                                <option value="">Select Sub Category</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Dynamic Fields</label>
                        <div class="col-sm-6">
                            <input type="text" placeholder="Dynamic Fields" name="DynamicFields" id="DynamicFields" required=" " class="form-control" value="<?php echo $capturedvariablename; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group" >
                    <div class="row">
                        <label class="col-sm-3 control-label">Is Searchable</label>
                        <div class="col-sm-6">
                            <input type="radio" placeholder="Is Searchable" name="isSearchable" value="Yes" onclick="changeIsSearch(this.value)"  <?php if($isSearchable == 'Yes'){  echo 'checked'; }?>/> Yes
                            <input type="radio" placeholder="Is Searchable" name="isSearchable" value="No" onclick="changeIsSearch(this.value)" <?php if($isSearchable != 'Yes'){  echo 'checked'; }?>/> No
                        </div>
                    </div>
                </div>

                <div class="form-group" id="isSearchableDiv">
                    <div class="row">
                        <label class="col-sm-3 control-label">Search Type</label>
                        <div class="col-sm-6">
                            <select name="searchType" id="searchType" class="form-control">
                                <option value="">Select Search Type</option>
                                <option value="yearRange"  <?php if($searchType == 'yearRange'){  echo 'selected'; }?>>Year Range</option>
                                <option value="DateRange"  <?php if($searchType == 'DateRange'){  echo 'selected'; }?>>Date Range</option>
                                <option value="TimeRange"  <?php if($searchType == 'DateRange'){  echo 'selected'; }?>>Time Range</option>
                                <option value="TextSearch"  <?php if($searchType == 'Text'){  echo 'selected'; }?>>Text Search</option>
                                <option value="NumberRange" <?php if($searchType == 'NumberRange'){  echo 'selected'; }?>>Number Range (Amount)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label">Fields Type</label>
                        <div class="col-sm-6">
                            <select name="FieldsType" id="FieldsType" class="form-control" onchange="getFieldsTypeAddContent(this.value)" required>
                                <option value="">Select Fields Type</option>
                                <option value="Input Box" <?php if($dynamicInputType=="Input Box"){ echo "selected"; }?>>Input Box</option>
                                <option value="Textarea" <?php if($dynamicInputType=="Textarea"){ echo "selected"; }?>>Textarea</option>
                                <option value="Check Box" <?php if($dynamicInputType=="Check Box"){ echo "selected"; }?>>Check Box</option>
                                <option value="Radio Button" <?php if($dynamicInputType=="Radio Button"){ echo "selected"; }?>>Radio Button</option>
                                <option value="Select Box" <?php if($dynamicInputType=="Select Box"){ echo "selected"; }?>>Select Box</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row" id="FieldsOptionsContent"></div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-9 m-t-15">
                            <button type="submit" value="<?php echo $title; ?>" id="submit" name="submit"
                                    class="btn btn-primary waves-effect waves-light">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-default waves-effect m-l-5">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            <?php if ($categoryId != "" && $dynamicInputType != ""){ ?>
                <script>
                    checkFieldsTypeAndLoadContent("<?php echo $dynamicInputType; ?>",'<?php echo $actionType; ?>','<?php echo $dynamicInputId; ?>');
                    getCommonSelectBox("<?php echo $categoryId; ?>", 'subCategoryIdDiv');
                    alert("Loading...");
                    $("#subCategoryId").val("<?php echo $subCategoryId; ?>");
                </script>
            <?php } ?>

                <style>
                    .checkBoxRow{
                        padding: 7px 0px;
                    }

                    .radioButtonRow{
                        padding: 7px 0px;
                    }
                </style>
                <script>
                    $("#FieldsType").select2();
                    $("#SearchType").select2();
                    changeIsSearch("<?php echo $isSearchable; ?>");
                </script>
            <?php } else if ($title == "Dynamic Input") {

                $dynamicSelectBox = "";
                $dynamicInputType = "";

                if(count($dynamicSelectBoxList)>0){
                    $dynamicSelectBox = $dynamicSelectBoxList[0]['dynamicInputName'];
                    $dynamicInputType = $dynamicSelectBoxList[0]['dynamicInputType'];
                }
            ?>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-4 control-label">Dynamic Input Type</label>
                        <div class="col-sm-6">
                            <select name="dynamicInputType" id="dynamicInputType" class="form-control" required>
                                <option value="">Select Dynamic Input Type</option>
                                <option value="Input Box" <?php if($dynamicInputType=="Input Box"){ echo "selected"; }?>>Input Box</option>
                                <option value="Textarea" <?php if($dynamicInputType=="Textarea"){ echo "selected"; }?>>Textarea</option>
                                <option value="Check Box" <?php if($dynamicInputType=="Check Box"){ echo "selected"; }?>>Check Box</option>
                                <option value="Radio Button" <?php if($dynamicInputType=="Radio Button"){ echo "selected"; }?>>Radio Button</option>
                                <option value="Select Box" <?php if($dynamicInputType=="Select Box"){ echo "selected"; }?>>Select Box</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-4 control-label">Dynamic Input Name</label>
                        <div class="col-sm-6">
                            <input type="text" placeholder="Dynamic Input Name" name="dynamicInputName" id="dynamicInputName" required=" " class="form-control" value="<?php echo $dynamicSelectBox; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-offset-4 col-sm-9 m-t-15">
                            <button type="submit" value="<?php echo $title; ?>" id="submit" name="submit"
                                    class="btn btn-primary waves-effect waves-light">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-default waves-effect m-l-5">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
                <script>
                    $("#dynamicInputType").select2();
                </script>
            <?php } else if ($title == "Dynamic Input Value") {

//                $categoryId = "";
                $dynamicInputId = "";
                $dynamicInputValue = "";

                if(count($dynamicSelectBoxValueList)>0){
//                    $categoryId =  $dynamicSelectBoxValueList[0]['categoryId'];
                    $dynamicInputId =  $dynamicSelectBoxValueList[0]['dynamicInputId'];
                    $dynamicInputValue =  $dynamicSelectBoxValueList[0]['dynamicInputValue'];
                }

            ?>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-4 control-label">Dynamic Input Name</label>
                        <div class="col-sm-6" id="dynamicSelectBoxIdDiv">
                            <select name="dynamicInputId" id="dynamicInputId" class="form-control" parsley-trigger="change"
                                    required>
                                <option value="">Select Dynamic Input Name</option>
                                <?php
                                    for($d=0; $d<count($dynamicSelectBoxList); $d++){
                                        $dynamicSelectBox = $dynamicSelectBoxList[$d]['dynamicInputName'];
                                        $dynamicInputType = $dynamicSelectBoxList[$d]['dynamicInputType'];
                                        $dynamicInputIdValue = $dynamicSelectBoxList[$d]['dynamicInputId'];
                                        if($dynamicInputIdValue == $dynamicInputId){
                                            echo '<option value="'.$dynamicInputIdValue.'" selected="selected">'.$dynamicSelectBox.'</option>';
                                        } else {
                                            echo '<option value="'.$dynamicInputIdValue.'">'.$dynamicSelectBox.'</option>';
                                        }

                                } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-4 control-label">Options</label>
                        <div class="col-sm-6">
                            <input type="text" placeholder="Dynamic Input Value" name="dynamicInputValue" id="dynamicInputValue" required=" " class="form-control" value="<?php echo $dynamicInputValue; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-offset-4 col-sm-9 m-t-15">
                            <button type="submit" value="<?php echo $title; ?>" id="submit" name="submit"
                                    class="btn btn-primary waves-effect waves-light">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-default waves-effect m-l-5">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>

                <script>
                    $("#dynamicInputId").select2();
//                    getDynamicInputMasterList("<?php //echo $dynamicInputId; ?>//");
                </script>

                <script>
                    $("#dynamicSelectBoxId").select2();
                </script>
            <?php } ?>

        </form>
    </div>
</div>

