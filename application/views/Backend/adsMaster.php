<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jonam
 * Date: 8/10/16
 * Time: 2:25 PM
 */
?>
<!-- =======================
     ===== START PAGE ======
     ======================= -->

<div class="wrapper">
    <div class="container">

        <!-- Page-Title -->
<!--        <div class="row">-->
<!--            <div class="col-sm-12">-->
<!--                <h4 class="page-title">--><?php //echo $title; ?><!-- Master</h4>-->
<!--            </div>-->
<!--        </div>-->
        <!-- Page-Title -->
        <!-- Custom Modals -->
        <div class="card-box">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <p class="text-muted m-b-20 font-13">
                                Add, Edit and Delete <?php echo $title; ?>
                                <?php $loadAddOrEditModalUrl = base_url() . "Backend/AddOrEditMasterContent"; ?>
                            </p>
                            <div class="col-md-3">
                            <button class="btn btn-primary waves-effect waves-light m-t-10"
                                    onclick="getAddOrEditModalContent('actionType=Add&actionId=0&title=<?php echo $title; ?>', '<?php echo $loadAddOrEditModalUrl; ?>')">
                                Add <?php echo $title; ?></button>
                                </div>
                            <div class="col-md-6">
                            <?php echo $succesMsg; ?>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
            <form class="form-horizontal group-border-dashed" action="" method="POST"
                  name="addOrEditUserDetailsForm" id="addOrEditUserDetailsForm" data-parsley-validate novalidate>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <label class="">Ads Status</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <select name="activeStatus" id="activeStatus" class="form-control">
                                <option value="">Select Status</option>
                                <option value="Waiting">Waiting</option>
                                <option value="active">active</option>
                                <option value="InActive">InActive</option>
                                <option value="deleted">deleted</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label class="">State</label>
                        </div>
                        <div class="col-md-3 col-sm-3" id="stateDiv">
                            <select name="stateId" id="stateId" class="form-control">
                                <option value="">Select State</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <label class="">City</label>
                        </div>
                        <div class="col-md-3 col-sm-3" id="districtDiv">
                            <select name="cityId" id="cityId" class="form-control">
                                <option value="">Select City</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="">Created At Between</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="input-daterange input-group" id="date-range">
                                <input type="text" class="form-control" name="start" placeholder="Start Date"/>
                                <span class="input-group-addon bg-primary b-0 text-white">to</span>
                                <input type="text" class="form-control" name="end" placeholder="End Date"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <label class="">Category</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <select class="form-control" name="searchCategoryId" id="searchCategoryId" onchange="getCommonSelectBox(this.value,'0', 'subCategoryIdDiv'); getDynamicFieldsforAdPost('dynamicFieldsForCategoryDiv')" >
                                <option value="">Select Category</option>
                                <?php for($c=0; $c<count($categoryArray); $c++){ ?>
                                    <option value="<?php echo $categoryArray[$c]['categoryId']; ?>"><?php echo $categoryArray[$c]['category']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div id="subCategoryIdDiv"></div>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div id="itemIdDiv"></div>
                        </div>

                    </div>
                </div>
                <div id="dynamicFieldsForCategoryDiv"></div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <input type="button" name="getUsersList" value="Get Ads List" class="btn btn-info form-control"
                                   onclick="loadMastersList($('#addOrEditUserDetailsForm').serialize(), $('#getMastersListUrl').val())"/>
                        </div>
                        <div class="col-md-3 col-sm-3">
                        </div>
                        <div class="col-md-3 col-sm-3">
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <input type="button" name="getUsersList" value="Generate Excel" class="btn btn-warning form-control"
                                   onclick="generateExcel('addOrEditUserDetailsForm')"/>
                        </div>

                    </div>
                </div>
                <input type="hidden" name="getGenerateExcel" id="getGenerateExcel"
                       value="0">
                <input type="hidden" name="getMastersListUrl" id="getMastersListUrl"
                       value="<?php echo $getMastersListUrl; ?>">
                <input type="hidden" name="getCommonSelectBoxUrl" id="getCommonSelectBoxUrl"
                       value="<?php echo $getCommonSelectBoxUrl; ?>">
                <input type="hidden" name="title" id="title" value="<?php echo $title; ?>">
            </form>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div id="usersListDiv"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content p-0 b-0" id="modalContentArea">

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <?php include_once "innerFooter.php"; ?>
    </div>
    <!-- end container -->
</div>
<!-- End wrapper -->

<script>
    //    var postData = "type=Category Type";
    //  loadMastersList(postData);

    var postData = $("#addOrEditUserDetailsForm").serialize();
    // alert(postData)
    loadMastersList(postData, $("#getMastersListUrl").val());
    loadAllStates("0", "0", "stateDiv");
</script>
<input type="hidden" value="<?php echo $getCommonJsonDataUrl; ?>" name="getCommonJsonDataUrl" id="getCommonJsonDataUrl"/>

<script>

    function getCommonSelectBox(categoryId, subCategoryId, divId) {

        var getCommonJsonDataUrl = $("#getCommonJsonDataUrl").val();
        var postFormData = "categoryId="+categoryId+"&subCategoryId="+subCategoryId+"&divId="+divId;
        $.ajax({
            url: getCommonJsonDataUrl,
            type: "get",
            data : postFormData,
            success: function (responseFromSite) {

                var jsonData = JSON.parse(responseFromSite);
                var categoryId = jsonData['categoryId'];
                var subCategoryId = jsonData['subCategoryId'];
                var upperDataValue = jsonData['upperDataValue'];
                var jsonArrayData = jsonData['jsonArrayData'];
                var displayData = '';
                if(jsonArrayData != ""){
                    var innerJsonDataLength = jsonArrayData.length;
                    if(innerJsonDataLength > 0){

                        var innerJsonData = jsonArrayData;
                        var returnInnerData = '';

                        if(divId=="subCategoryIdDiv"){
                            displayData = '<div class="col-sm-6 textlabel"> Select '+upperDataValue+' <span class="redColor">*</span></div> <div class="col-sm-6"><select class="form-control" name="subCategoryId" id="subCategoryId" onchange="getCommonSelectBox(categoryId.value, this.value, \'itemIdDiv\')"> ';
                            displayData = displayData + '<option value="">Select</option>';
                            for(var i=0; i<innerJsonData.length; i++){
                                var id = innerJsonData[i]['subCategoryId'];
                                var value = innerJsonData[i]['subCategory'];
                                displayData = displayData + '<option value="'+id+'">'+value+'</option>';
                            }
                            displayData = displayData + ' </select></div>';
                        }

                        if(divId=="itemIdDiv"){
                            var innerJsonDataLength = innerJsonData.length;
                            if(innerJsonDataLength>0){
                                displayData = '<div class="col-sm-6 textlabel"> Select '+upperDataValue+' <span class="redColor">*</span></div> <div class="col-sm-6"><select class="form-control" name="itemId" id="itemId" > ';
                                displayData = displayData + '<option value="">Select</option>';
                                for(var i=0; i<innerJsonData.length; i++){
                                    var id = innerJsonData[i]['itemId'];
                                    var value = innerJsonData[i]['item'];
                                    displayData = displayData + '<option value="'+id+'">'+value+'</option>';
                                }
                                displayData = displayData + ' </select></div>';
                            }
                        }
                    }
                }
                $("#"+divId).html(displayData);
                if(divId=="subCategoryIdDiv"){
                    $("#itemIdDiv").html("");
                    $("#subCategoryId").select2();
                } else if(divId=="itemIdDiv"){
                    $("#itemId").select2();
                }

                $("#itemId").select2();

//            if(divId=="stateDiv"){
//                $("#stateId").select2();
//            }
//
//            if(divId=="districtDiv"){
//                $("#districtId").select2();
//            }

            }
        });
    }
</script>