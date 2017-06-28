<!-- Submit Ad -->
<div class="submit-ad main-grid-border">
    <div class="container">
        <?php if (count($editAdsArray) > 0) {
        $resultEditableAds = $editAdsArray[0];
//        print_r($resultEditableAds);
        ?>
            <script>
                var categoryId = "<?php echo $resultEditableAds['categoryId']; ?>";
                var subCategoryId = "<?php echo $resultEditableAds['subCategoryId']; ?>";
                var adsId = "<?php echo $editAdsId; ?>";
            </script>

            <h2 class="head"><?php echo $title; ?></h2>
        <div class="post-ad-form">
                <form action="<?php echo base_url(); ?>updateAdPost" enctype="multipart/form-data" method="post">
                    <div class="row">
                        <div class="col-sm-12 text-right text-danger"><?php echo $resultEditableAds['adsCode'] ." : ".$resultEditableAds['active']; ?></div>
                    </div>
                    <?php echo $succesMsg; ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="text-info">Choose Your Location</h4>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="manualLocationDiv">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6 textlabel">State <span class="redColor">*</span></div>
                                    <div class="col-sm-6">
                                        <select name="stateId" id="stateId" class="selectboxWidth select2"
                                                onchange="getCity(this.value, 'cityIdDiv')"
                                                required
                                                data-parsley-name="State">
                                            <option value="">Select State</option>
                                            <?php for ($s = 0; $s < count($stateArray); $s++) { ?>
                                                <option
                                                    value="<?php echo $stateArray[$s]['stateId'] ?>" <?php if ($resultEditableAds['stateId'] == $stateArray[$s]['stateId']) {
                                                    echo 'selected';
                                                } ?>><?php echo $stateArray[$s]['state'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6 textlabel">City <span class="redColor">*</span></div>
                                    <div class="col-sm-6" id="cityIdDiv">
                                        <select name="cityId" id="cityId" class="selectboxWidth select2"
                                                onchange=""
                                                required
                                                data-parsley-name="City">
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="text-info">Ad Details</h4>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3 textlabel">Ad Title <span class="redColor">*</span></div>
                                    <div class="col-sm-9">
                                        <input type="text" class="selectboxWidth" name="adsTitle" id="adsTitle"
                                               placeholder="Give product title for faster response..."
                                               value="<?php echo $resultEditableAds['adsTitle']; ?>"
                                               required
                                               data-parsley-name="Ad Title">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6 textlabel">Select Category <span class="redColor">*</span>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="selectboxWidth select2" name="categoryId" id="categoryId"
                                                onchange="getCommonSelectBox(this.value,'0', 'subCategoryIdDiv'); getDynamicFieldsforAdPost('dynamicFieldsForCategoryDiv', 'Edit', adsId, this.value, subCategoryId.value)"
                                                required
                                                data-parsley-name="Category">
                                            <option value="">Select Category</option>
                                            <?php for ($c = 0; $c < count($categoryArray); $c++) { ?>
                                                <option
                                                    value="<?php echo $categoryArray[$c]['categoryId']; ?>" <?php if ($resultEditableAds['categoryId'] == $categoryArray[$c]['categoryId']) {
                                                    echo 'selected';
                                                } ?>><?php echo $categoryArray[$c]['category']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row" id="subCategoryIdDiv">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6" id="itemIdDiv">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6 textlabel">No.of Days to Active <span class="redColor">*</span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="selectboxWidth" name="noOfDaysToActive"
                                               id="noOfDaysToActive"
                                               placeholder="No.of days to be displayed on the site..."
                                               value="<?php echo $resultEditableAds['noOfDaysToActive']; ?>"
                                               required
                                               data-parsley-name="No.of Days to Active">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6 textlabel">Start Date <span class="redColor">*</span></div>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="YYYY-MM-DD" name="startDate" id="startDate"
                                               class="selectboxWidth datepicker"
                                               value="<?php echo date_format(new DateTime($resultEditableAds['startDate']), 'Y-m-d'); ?>"
                                               required
                                               data-parsley-name="Start Date">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3 textlabel">Ad Description <span class="redColor">*</span></div>
                                    <div class="col-sm-9">
                                        <textarea class="mess selectboxWidth"
                                                  placeholder="Write complete description of your product for faster response..."
                                                  name="description"
                                                  id="description"
                                                  required
                                                  data-parsley-name="Ad Description"><?php echo $resultEditableAds['description']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="dynamicFieldsForCategoryDiv"></div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="row">
                                    <div class="col-sm-12 textlabel">Photos for your ad <span class="redColor">*</span></div>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="text-left">
                                            <input type="file" id="fileselect" name="fileselect[]" multiple="multiple"/> <span
                                                class="fileDesc">File Type - JPEG or PNG, File Size - 1MB</span>
                                        </div>
                                        <!--                                    <input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="2" />-->
                                        <?php
                                        //                                    print_r($adsgalleryDetails);

                                        $adsCode = $resultEditableAds['adsCode'];
                                        $userCode = $resultEditableAds['userCode'];

                                        foreach ($adsgalleryDetails as $adsgallerySingleDetails) {

                                            $imgName = $adsgallerySingleDetails['file_name'];
                                            $imgId = $adsgallerySingleDetails['adsGalleryId'];
                                            $active = $adsgallerySingleDetails['active'];

                                            $filePath = "uploads/files/userads/" . $userCode . "/" . $adsCode . "/" . $imgName;
                                            $fileExist = $filePath;

                                            if (file_exists($fileExist)) {
                                                $fileFullPath = base_url() . $filePath;
                                            } else {
                                                $fileFullPath = base_url() . $filePath;
                                            }
                                            ?>
                                            <div class="col-sm-4">
                                                <img src="<?php echo $fileFullPath; ?>" style="width: 150px; height: 150px"
                                                     class="img-thumbnail"><br/>
                                                <select name="updateFileStatus_<?php echo $imgId; ?>" id="updateFileStatus_<?php echo $imgId; ?>" style="width:150px">
                                                    <option value="nochange">No Change</option>
                                                    <option value="deleted">Delete</option>
                                                </select>
                                            </div>


                                            <?php //echo '<img src="'.$filePath.'" alt="tes" width="100px" height="100px"/>'.$active;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <input type="submit" name="fileSubmit" value="Update"/>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" value="<?php echo $editAdsId; ?>" name="editAdsId" id="editAdsId"/>
                </form>
                <input type="hidden" value="<?php echo $getCommonJsonDataUrl; ?>" name="getCommonJsonDataUrl"
                       id="getCommonJsonDataUrl"/>
                <script>
                    function getCommonSelectBox(categoryId, subCategoryId, divId) {
                        var getCommonJsonDataUrl = $("#getCommonJsonDataUrl").val();
                        var postFormData = "categoryId=" + categoryId + "&subCategoryId=" + subCategoryId + "&divId=" + divId;
                        $.ajax({
                            url: getCommonJsonDataUrl,
                            type: "get",
                            data: postFormData,
                            success: function (responseFromSite) {

                                var jsonData = JSON.parse(responseFromSite);
                                var categoryId = jsonData['categoryId'];
                                var subCategoryId = jsonData['subCategoryId'];
                                var upperDataValue = jsonData['upperDataValue'];
                                var jsonArrayData = jsonData['jsonArrayData'];
                                var displayData = '';
                                if (jsonArrayData != "") {
                                    var innerJsonDataLength = jsonArrayData.length;
                                    if (innerJsonDataLength > 0) {

                                        var innerJsonData = jsonArrayData;
                                        var returnInnerData = '';

                                        if (divId == "subCategoryIdDiv") {
                                            var editAdsId = "<?php echo $editAdsId; ?>";
                                            displayData = '<div class="col-sm-6 textlabel"> Select ' + upperDataValue + ' <span class="redColor">*</span></div> <div class="col-sm-6"><select class="selectboxWidth select2" name="subCategoryId" id="subCategoryId" onchange="getCommonSelectBox(categoryId.value, this.value, \'itemIdDiv\'); getDynamicFieldsforAdPost(\'dynamicFieldsForCategoryDiv\', \'Edit\', \' '+editAdsId+' \', categoryId.value, subCategoryId.value)" required data-parsley-name="Sub Category"> ';
                                            displayData = displayData + '<option value="">Select</option>';
                                            for (var i = 0; i < innerJsonData.length; i++) {
                                                var id = innerJsonData[i]['subCategoryId'];
                                                var value = innerJsonData[i]['subCategory'];
                                                if (id == subCategoryId) {
                                                    displayData = displayData + '<option value="' + id + '" selected>' + value + '</option>';
                                                } else {
                                                    displayData = displayData + '<option value="' + id + '">' + value + '</option>';
                                                }
                                            }
                                            displayData = displayData + ' </select></div>';
                                        }

                                        if (divId == "itemIdDiv") {
                                            var innerJsonDataLength = innerJsonData.length;
                                            if (innerJsonDataLength > 0) {
                                                displayData = '<div class="col-sm-6 textlabel"> Select ' + upperDataValue + ' <span class="redColor">*</span></div> <div class="col-sm-6"><select class="selectboxWidth select2" name="itemId" id="itemId" required data-parsley-name="Item"> ';
                                                displayData = displayData + '<option value="">Select</option>';
                                                for (var i = 0; i < innerJsonData.length; i++) {
                                                    var id = innerJsonData[i]['itemId'];
                                                    var value = innerJsonData[i]['item'];
                                                    displayData = displayData + '<option value="' + id + '">' + value + '</option>';
                                                }
                                                displayData = displayData + ' </select></div>';
                                            }
                                        }
                                    }
                                }
                                $("#" + divId).html(displayData);

                                if (divId == "subCategoryIdDiv") {
//                                    $(".select2").select2()
//                                    doSelect2()
                                } else if (divId == "itemIdDiv") {
//                                    $("#itemId").select2();
                                }
                            }
                        });
                    }

                    $("#startDate").datepicker({format: "yyyy-mm-dd"});
//                    $("#categoryId").select2();
                    var stateId = "<?php echo $resultEditableAds['stateId']; ?>";
                    var cityId = "<?php echo $resultEditableAds['cityId']; ?>";

                    getCity(stateId, 'cityIdDiv', cityId);
                    getCommonSelectBox(categoryId, subCategoryId, 'subCategoryIdDiv');
                    getDynamicFieldsforAdPost('dynamicFieldsForCategoryDiv', 'Edit', adsId, categoryId, subCategoryId);
                </script>
        </div>
        <?php } ?>
    </div>
</div>

<script type="text/javascript" src=" <?php echo base_url(); ?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>

<script>
    function doSelect2(){
        $("#itemIdDiv").html("");
        $("#subCategoryId").select2();
    }
    $(document).ready(function () {
        $('form').parsley();
    });
</script>
<link href="<?php echo base_url(); ?>assets/css/components.css" rel="stylesheet" type="text/css"/>