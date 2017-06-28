var baseUrl = "http://localhost/public_html1/";
function getAddOrEditModalContent(postBrandData, loadAddOrEditModalUrl) {
    $.ajax({
        url: loadAddOrEditModalUrl,
        type: "get",
        data : postBrandData,
        success: function (responseFromSite) {

            $("#modalContentArea").html(responseFromSite);
            $("#addOrEditUserDetailsForm").parsley();
            $("#panel-modal").modal('show');

            $("#categoryId").select2();
             $("#countryId").select2();
             $("#stateId").select2();
            // $("#categorytypeid").select2();

        }
    });
}

function loadAddOrEditContentWithOutModal(postData, displayDiv) {
    var postUrl = $("#AddOrEditMasterContent").val();
    $.ajax({
        url: postUrl,
        type: "get",
        data: postData,
        success: function (responseFromSite) {
            $("#" + displayDiv).html(responseFromSite);
            $("#panel-modal").modal('show');
            $("#addOrEditUserDetailsForm").parsley();
        }

    });
}

function getCommonSelectBox(upperActionId, divId) {
    var getCommonSelectBoxUrl = $("#getCommonSelectBoxUrl").val();
    var postFormData = "upperActionId="+upperActionId+"&divId="+divId
    $.ajax({
        url: getCommonSelectBoxUrl,
        type: "get",
        data : postFormData,
        success: function (responseFromSite) {

            $("#"+divId).html(responseFromSite);
            // $("#addOrEditUserDetailsForm").parsley();
            if(divId=="stateDiv"){
                $("#stateId").select2();
            }
        }
    });
}

function loadMastersList(postData, postUrl) {

    $.ajax({
        url: postUrl,
        type: "GET",
        data: postData,
        success: function (data) {

            $("#usersListDiv").html(data);
            $('#datatable-responsive').DataTable();
        }
    });

}

function deleteMaster(title, postData, postUrl) {
    var isdelete = confirm("Are you sure to delete!");
    if(isdelete){
        $.ajax({
            url: postUrl,
            type: "GET",
            data: postData,
            success: function (data) {
                var postData = "title="+$("#title").val();
                loadMastersList(postData, $("#getMastersListUrl").val())

                /*if(title == "size"){
                    var postData = "type=sizeList";
                    loadMastersList(postData);
                }
                if(title == "Category Type"){
                    var postData = "type=Category Type";
                    loadMastersList(postData);
                }*/
            }
        });
    }
}

function getCity(actionId, divId, selectedCityId){
    var postData = "actionId="+actionId+"&divId="+divId;
    var postUrl = baseUrl + "getStates";
    $.ajax({
        url: postUrl,
        type: "GET",
        data: postData,
        success: function (data) {
            var jsonData = JSON.parse(data);

            if(divId == "cityIdDiv"){
                var stateLength = jsonData.length;
                var stateList = '<select name="cityId" id="cityId" class="select2 selectboxWidth" parsley-trigger="change" required> <option value="">Select City</option>';
                for(var i=0; i<stateLength; i++){
                    var innserJson = jsonData[i];
                    //alert(JSON.stringify(innserJson));
                    //alert(innserJson['districtId']);
                    if(innserJson!=null){
                        var cityId = innserJson['districtId'];
                        var cityName = innserJson['district'];
                        if(cityId == selectedCityId){
                            stateList = stateList + '<option value="'+cityId+'" selected>'+cityName+'</option>';
                        } else {
                            stateList = stateList + '<option value="'+cityId+'" >'+cityName+'</option>';
                        }
                    }
                }
                stateList = stateList + ' </select>';

            }
            $("#"+divId).html(stateList);
            alert("loading...");
            if(divId == "cityIdDiv"){
                $("#cityId").select2();
            }
        }
    });
}

function posAjaxAndWriteContentToDiv(postUrl, postData, divId){
    $.ajax({
        url: postUrl,
        type: "GET",
        data: postData,
        success: function (data) {
            $("#"+divId).html(data);
        }
    })
}

function getDynamicFieldsforAdPost(divId, action, adsId, categoryId, subCategoryId){

    //var categoryId = $("#categoryId").val();
    //var subCategoryId = $("#subCategoryId").val();
    var postData = "categoryId="+categoryId+"&action="+action+"&adsId="+adsId+"&subCategoryId="+subCategoryId;
    var postUrl = baseUrl+"getDynamicFieldsforAdPost";
    posAjaxAndWriteContentToDiv(postUrl, postData, divId);

}

function getDynamicFieldsforAdsSearch(divId,categoryID, selectedSubcategoryId){
    var postData = "categoryId="+categoryID+"&subCategoryId="+selectedSubcategoryId;
    var postUrl = baseUrl+"getDynamicFieldsforSearchAds";
    $.ajax({
        url: postUrl,
        type: "GET",
        data: postData,
        success: function (data) {
          //  alert(data);
            $("#"+divId).html(data);
            $(".select2").select2({
                placeholder: "Select a Value"
            });

          //  alert(1);

        }
    });
}
