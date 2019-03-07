<div class="submit-ad main-grid-border">
    <div class="container">
        <h2 class="head"><?php echo $title; ?></h2>

        <div class="post-ad-form">
            <form id="defaultForm" enctype="multipart/form-data" class="form-horizontal">
                <?php echo $succesMsg; ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="text-info myHeader">User Contact Details</h4>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-6 textlabel">Mobile Number <span class="redColor">*</span></div>
                                <div class="col-sm-6">
                                    <input type="text" class="selectboxWidth" name="mobileNumber" id="mobileNumber" placeholder="Mobile Number"  required
                                           data-parsley-name="mobileNumber">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-6 textlabel">Name <span class="redColor">*</span></div>
                                <div class="col-sm-6">
                                    <input type="text" class="selectboxWidth" name="name" id="name" placeholder="Name"  required
                                           data-parsley-name="name">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="text-info myHeader">Choose Your Location</h4>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="manualLocationDiv">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-6 textlabel">State <span class="redColor">*</span></div>
                                <div class="col-sm-6">
                                    <select name="stateId" id="stateId" class=" form-control selectboxWidth select2"
                                            parsley-trigger="change" onchange="getCity(this.value, 'cityIdDiv')"
                                            required>
                                        <option value="">Select State</option>
                                        <?php for ($s = 0; $s < count($stateArray); $s++) { ?>
                                            <option
                                                value="<?php echo $stateArray[$s]['stateId'] ?>"><?php echo $stateArray[$s]['state'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-6 textlabel">City <span class="redColor">*</span></div>
                                <div class="col-sm-6" id="cityIdDiv">
                                    <select name="cityId" id="cityId" class=" form-control selectboxWidth select2"
                                            parsley-trigger="change"
                                            required>
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
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-6 textlabel">Select Category <span class="redColor">*</span></div>
                                <div class="col-sm-6">
                                    <select class="form-control selectboxWidth select2" name="categoryId"
                                            id="categoryId"
                                            onchange="getCommonSelectBox(this.value,'0', 'subCategoryIdDiv'); getDynamicFieldsforAdPost('dynamicFieldsForCategoryDiv',  'Add', '0', categoryId.value, subCategoryId.value);"
                                            parsley-trigger="change"
                                            required>
                                        <option value="">Select Category</option>
                                        <?php for ($c = 0; $c < count($categoryArray); $c++) { ?>
                                            <option
                                                value="<?php echo $categoryArray[$c]['categoryId']; ?>"><?php echo $categoryArray[$c]['category']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row" id="subCategoryIdDiv">
                                <div class="col-sm-6 textlabel">Select Category <span class="redColor">*</span></div>
                                <div class="col-sm-6">
                                    <select class="form-control selectboxWidth select2" name="subCategoryId"
                                            id="subCategoryId"
                                            parsley-trigger="change"
                                            required>
                                        <option value="">Select Sub Category</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3 textlabel">Ad Title <span class="redColor">*</span></div>
                                <div class="col-sm-9">
                                    <input type="text" class="selectboxWidth" name="adsTitle" id="adsTitle"  required
                                           data-parsley-name="Ad Title"
                                           placeholder="Give product title for faster response...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row"  id="itemIdDiv">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <!--<div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-6 textlabel">No.of Days to Active <span class="redColor">*</span></div>
                                <div class="col-sm-6">
                                    <input type="text" class="selectboxWidth" name="noOfDaysToActive" id="noOfDaysToActive" value="30" placeholder="No.of days to be displayed on the site..."  required
                                           data-parsley-name="No.of Days to Active">
                                </div>
                            </div>
                        </div> -->
<input type="hidden" class="selectboxWidth" name="noOfDaysToActive" id="noOfDaysToActive" value="30" placeholder="No.of days to be displayed on the site..."  required
                                           data-parsley-name="No.of Days to Active">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-6 textlabel">Start Date <span class="redColor">*</span></div>
                                <div class="col-sm-6">
                                    <input type="text" placeholder="YYYY-MM-DD" name="startDate" id="startDate" class="selectboxWidth datepicker" required
                                           data-parsley-name="Start Date" value="<?php echo date_format(new DateTime(), 'Y-m-d'); ?>">
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
                                    <textarea class="mess selectboxWidth" placeholder="Write complete description of your product for faster response..." name="description" id="description" required
                                              data-parsley-name="No.of Days to Active"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="dynamicFieldsForCategoryDiv"></div>
                <div class="personal-details">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 upload-ad-photos">
                                <div class="col-sm-3 textlabel">Photos for your ad</div>
                                <div class="col-sm-9">
                                    <!--                                    <input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="2" />-->
                                    <div class="">
                                        <!--                                    <div class="photos-upload-view">-->
                                        <div id="upload">

                                            <input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE"
                                                   value="300000"/>
                                                <div id="filedrag">drop files here</div>
                                                <div id="uploadImageStatus" class="fileDesc" style="font-size: 16px"></div>
                                                <input type="file" id="fileselect" name="fileselect[]" multiple="multiple" />
                                                <span class="fileDesc">File Type - JPEG or PNG, File Size - 1MB</span>

                                            <input type="file" name="file" id="updateFile" style="display: none"/>
                                        </div>
                                        <div id="test"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <script>
                                        function deleteImg(id) {
                                            document.getElementById(id).removeAttribute("class");
                                            document.getElementById(id).innerHTML = "";
                                            document.getElementById(id).removeAttribute("id");
                                            galleryFileUploadRemainingCount--;
                                            incidentImageArray.splice(galleryFileUploadRemainingCount,1);
                                            alert("Removed from gallery List");
                                        }
                                    </script>
                                    <p class="post-terms">By clicking <strong>post Button</strong> you accept our <a
                                            href="terms" target="_blank">Terms of Use </a> and <a href="privacy"
                                                                                                  target="_blank">Privacy
                                            Policy</a></p>
                                    <!--                                    <input type="submit" value="Post">-->
                                    <div id="fileSubmitDiv"><input type="submit" name="fileSubmit" value="Post"/></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script src="<?php echo base_url(); ?>assets/web/js/filedrag.js"></script>
                    <!--                        <label>Your Name <span>*</span></label>-->
                    <!--                        <input type="text" class="name" name="Name"  id="Name" placeholder="">-->
                    <!--                        <div class="clearfix"></div>-->
                    <!--                        <label>Your Mobile No <span>*</span></label>-->
                    <!--                        <input type="text" class="phone" name="Phone" id="Mobile" placeholder="">-->
                    <!--                        <div class="clearfix"></div>-->
                    <!--                        <label>Your Email Address<span>*</span></label>-->
                    <!--                        <input type="text" class="email" name="Email" id="Email" placeholder="">-->
                </div>
                <input type="hidden" name="latitude" id="latitude" value=""/>
                <input type="hidden" name="longitude" id="longitude" value=""/>
            </form>
        </div>
    </div>
</div>
<!-- // Submit Ad -->
<input type="hidden" value="<?php echo $getCommonJsonDataUrl; ?>" name="getCommonJsonDataUrl"
       id="getCommonJsonDataUrl"/>
<style>
    .help-block {
        margin-top: 0px !important;
    }
</style>

<script>
    $(function() {
        $('#defaultForm').submit(function(e) {
            e.preventDefault();
            if ( $(this).parsley().isValid() ) {
                $("#fileSubmitDiv").html("<input type='submit' name='fileSubmitbtn' value='Processing...' disabled='false'/>");

                var fd = new FormData();
//                var file_data = $('input[type="file"]')[0].files; // for multiple files
                for(var i = 0;i<incidentImageArray.length;i++){
                    fd.append("fileselect[]", incidentImageArray[i]);
                }

//                var file_data = $('input[type="file"]')[0].files; // for multiple files
//                for(var i = 0;i<file_data.length;i++){
//                    fd.append("fileselect[]", file_data[i]);
//                }

                var other_data = $(this).serializeArray();
                $.each(other_data,function(key,input){
                    fd.append(input.name,input.value);
                });
                fd.append('fileSubmit','Post');
                $.ajax({
                    url: baseUrl+"createBackendAdPost",
                    data: fd,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function(reponse){
//                        alert(reponse);
                        window.location.replace(baseUrl+"adPost");
                    }
                });
            }
        });
    });

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
                            displayData = '<div class="col-sm-6 textlabel"> Select '+upperDataValue+' <span class="redColor">*</span></div> <div class="col-sm-6"><select class=" form-control selectboxWidth select2" name="subCategoryId" id="subCategoryId" onchange="getCommonSelectBox(categoryId.value, this.value, \'itemIdDiv\'); getDynamicFieldsforAdPost(\'dynamicFieldsForCategoryDiv\', \'Add\', \'0\', categoryId.value, subCategoryId.value)" parsley-trigger="change" required>';
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
                                displayData = '<div class="col-sm-6 textlabel"> Select '+upperDataValue+' <span class="redColor">*</span></div> <div class="col-sm-6"><select class=" form-control selectboxWidth select2" name="itemId" id="itemId" parsley-trigger="change" required>';
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
                $("#itemI").select2();
            }
        });
    }
</script>

<script src="http://maps.google.com/maps/api/js?key=AIzaSyDSpcghpRmu39ThwNSAP3cyEPMMnQBotQ0"></script>
<script>

    if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showPosition);
    }


    function showPosition(position){

        var latitude=position.coords.latitude;
        var longitude=position.coords.longitude;
        $("#latitude").val(latitude);
        $("#longitude").val(longitude);

        var geocoder = new google.maps.Geocoder();
        var latLng = new google.maps.LatLng(latitude, longitude);

        if (geocoder) {
            geocoder.geocode({ 'latLng': latLng}, function (results, status) {
//                alert(JSON.stringify(results[0]));
                if (status == google.maps.GeocoderStatus.OK) {
                    var city = results[3].address_components[0].long_name;
                    var state = results[3].address_components[1].long_name;
                    var country = "";
                    var registered_country_iso_code = "";

                    for (var ac = 0; ac < results[0].address_components.length; ac++) {
                        var component = results[0].address_components[ac];

                        switch(component.types[0]) {
                            case 'locality':
                                city = component.long_name;
                                break;
                            case 'administrative_area_level_1':
                                state = component.long_name;
                                break;
                            case 'country':
                                country = component.long_name;
                                registered_country_iso_code = component.short_name;
                                break;
                        }
                    };

                    if(state!=null && city!=null){
//                        var cityId = "";
//                        var stateId = "";
                        var postData = "state="+state+"&city="+city;
                        var postUrl = "getStateAndCityId";
                        $.ajax({
                            url : postUrl,
                            type : "GET",
                            data : postData,
                            success: function (data) {
                                var jsonData = JSON.parse(data);
                                if(jsonData!=null){
                                    var stateId = jsonData['stateId'];
                                    var cityId = jsonData['districtId'];
//                                    $("#cityId").val(districtId);
//                                    $("#stateId").val(stateId);
                                    $("#manualLocationDiv").html('<div class="row"><div class="col-sm-6"> <div class="col-sm-6 col-xs-6 textlabel">State</div><div class="col-sm-6  col-xs-6 textlabel text-warning ">'+state+'<input type="hidden" name="stateId" id="stateId" value="'+stateId+'"></div></div><div class="col-sm-6"> <div class="col-sm-6  col-xs-6 textlabel">City</div><div class="col-sm-6  text-danger col-xs-6 textlabel">'+city+'<input type="hidden" name="cityId" id="cityId" value="'+cityId+'"></div></div><div class="col-sm-12 text-right"><input type="button" onclick="chooseManualLocation()" value="Change Location Manually" class="btn text-warning"/></div></div>');
                                }
                            }
                        });
//                        $("#manualLocationDiv").html('<div class="row"><div class="col-sm-6"> <div class="col-sm-6 col-xs-6 textlabel">State</div><div class="col-sm-6  col-xs-6 textlabel text-warning ">'+state+'<input type="hidden" name="stateId" id="stateId" value="'+stateId+'"></div></div><div class="col-sm-6"> <div class="col-sm-6  col-xs-6 textlabel">City</div><div class="col-sm-6  text-danger col-xs-6 textlabel">'+city+'<input type="hidden" name="cityId" id="cityId" value="'+cityId+'"></div></div><div class="col-sm-12 text-right"><input type="button" onclick="chooseManualLocation()" value="Change Location Manually" class="btn text-warning"/></div></div>');
//                        getStateAndCityId(state, city);
                    }
                }
                else {
                    alert("Geocoding failed: " + status);
                }
            }); //geocoder.geocode()
        }
    }

    function chooseManualLocation(){
        var postData = "actionId=&divId=stateIdDiv";
        $.ajax({
            url : "getStates",
            type : "GET",
            data : postData,
            success : function(data){

                var jsonData = JSON.parse(data);
                var stateLength = jsonData.length;
                var stateList = '<select name="stateId" id="stateId" class="form-control selectboxWidth select2" onchange="getCity(this.value, \'cityIdDiv\', \' \')"  parsley-trigger="change" required> <option value="">Select State</option>';
                for(var i=0; i<stateLength; i++){
                    var stateId = jsonData[i]['stateId'];
                    var state = jsonData[i]['state'];
                    stateList = stateList + '<option value="'+stateId+'">'+state+'</option>';
                }
                stateList = stateList + ' </select>';
                $("#manualLocationDiv").html('<div class="row"> <div class="col-sm-6"> <div class="col-sm-6 textlabel">State <span class="redColor">*</span></div> <div class="col-sm-6"> '+stateList+' </div> </div> <div class="col-sm-6"> <div class="col-sm-6 textlabel">City <span class="redColor">*</span></div> <div class="col-sm-6" id="cityIdDiv"> <select name="cityId" id="cityId"  class=" form-control selectboxWidth select2" onchange=""  parsley-trigger="change" required> <option value="">Select City</option> </select> </div> </div> </div> ');
                $("#stateId").select2();
                $("#cityId").select2();
            }
        });
    }

    function getStateAndCityId(state, city){
        var postData = "state="+state+"&city="+city;
        var postUrl = "getStateAndCityId";
        $.ajax({
            url : postUrl,
            type : "GET",
            data : postData,
            success: function (data) {
                var jsonData = JSON.parse(data);
                if(jsonData!=null){
                    var stateId = jsonData['stateId'];
                    var districtId = jsonData['districtId'];
                    $("#cityId").val(districtId);
                    $("#stateId").val(stateId);
                }
            }
        });
    }
</script>





<script type="text/javascript" src=" <?php echo base_url(); ?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>

<script>
    $(document).ready(function () {
        $('form').parsley();
    });
</script>
<link href="<?php echo base_url(); ?>assets/css/components.css" rel="stylesheet" type="text/css"/>