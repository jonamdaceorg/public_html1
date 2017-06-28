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
            $("#subCategoryId").select2();
            
             $("#countryId").select2();
             $("#stateId").select2();
             $("#districtId").select2();
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

            if(divId=="districtDiv"){
                $("#districtId").select2();
            }

            if(divId=="subCategoryIdDiv"){
                $("#subCategoryId").select2();
            }
        }
    });
}

function loadMastersList(postData, postUrl) {
    $("#usersListDiv").html("<br><div class='loader-1'></div><br><br><br>");
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

function generateExcel(formId) {

    $("#getGenerateExcel").val("1");
    var postUrl = $('#getMastersListUrl').val();

    var formNm = document.getElementById(formId);
    formNm.method = "POST";
    formNm.action = postUrl;
    formNm.submit();

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



//Post Data
function loadAllStates( actionId, upperActionId, divId){

    var postData = "actionId="+actionId+"&upperActionId="+upperActionId+"&divId="+divId;
    var postUrl = "getCommonSelectBox";
    $.ajax({
        url: postUrl,
        type: "GET",
        data: postData,
        success: function (data) {
            $("#stateDiv").html(data);
            $("#stateId").select2();
            $("#cityId").select2();
            $("#activeStatus").select2();
            $("#searchCategoryId").select2();
        }
    });
}

function getCity(){
    var postData = "";
    var postUrl = "getStates";
    $.ajax({
        url: postUrl,
        type: "GET",
        data: postData,
        success: function (data) {
            var jsonData = JSON.parse(data);
            var stateLength = jsonData.length;
            var stateList = '<select name="cityId" id="cityId" class="form-control" > <option value="">Select City</option>';
            for(var i=0; i<stateLength; i++){
                stateList = stateList + '<option value="'+jsonData[i]+'">'+jsonData[i]+'</option>';
            }
            stateList = stateList + ' </select>';
            $("#cityDiv").html(stateList);
            $("#cityId").select2();
        }
    });
}

function getFieldsTypeAddContent(FieldsType, dynamicInputId){
    var returnString = "";
    var categoryId = "";
    if(FieldsType!=""){
        var addRows = "<div class='row'><label class='col-sm-3 control-label'>&nbsp;</label><div class='col-sm-6'><button type='button' class='btn btn-icon waves-effect waves-light btn-danger m-b-5' onclick='deleteRowFields(\""+FieldsType+"\")' ><i class='fa fa-minus'></i></button>&nbsp;<button type='button' class='btn btn-icon waves-effect waves-light btn-inverse m-b-5'  onclick='addRowFields(\""+FieldsType+"\")'><i class='fa fa-plus'></i></button></div><label class='col-sm-3 control-label'>&nbsp;</label></div>";
        returnString = "<div class='row'><label class='col-sm-3 control-label'>Fields Value</label>";
        returnString += "<div class='col-sm-6' id='FieldsValueDivId'>";
        //if(FieldsType == "Select Box" || FieldsType == "Check Box" || FieldsType == "Radio Button"){
            categoryId = $("#categoryId").val();
            if(categoryId!=''){
                var getCommonJsonDataUrl = $("#getCommonJsonDataUrl").val();
                var postData = "divId=DynamicFieldsDiv&dynamicInputType="+FieldsType+"&categoryId="+categoryId;
                var returnData = retrnDataUsingAjax(postData, getCommonJsonDataUrl);
                var status = returnData['status'];
                if(status==200){
                    var responseText = returnData['responseText'];
                    var responseTextParsed = JSON.parse(responseText);
                    var innerJsonData = responseTextParsed['jsonArrayData'];
                    var displayData = '<select class="form-control" name="dynamicInputId" id="dynamicInputId" required> ';
                    displayData = displayData + '<option value="">Dynamic Input</option>';
                    for(var i=0; i<innerJsonData.length; i++){
                        var id = innerJsonData[i]['dynamicInputId'];
                        var value = innerJsonData[i]['dynamicInputName'];
                        if(dynamicInputId == id){
                            displayData = displayData + '<option value="'+id+'" selected>'+value+'</option>';
                        } else {
                            displayData = displayData + '<option value="'+id+'">'+value+'</option>';
                        }
                    }
                    displayData = displayData + ' </select>';
                    returnString += displayData;
                }
            }
        //}
        //else if(FieldsType == "Check Box"){
        //    returnString += "<div class='checkBoxRow' id='checkBoxRow1'><input type='text' class='form-control'name='capturedVariableValue[]' placeholder='Check Box Value' required></div>";
        //} else if(FieldsType == "Radio Button"){
        //    returnString += "<div class='radioButtonRow' id='radioButtonRow1'><input type='text' class='form-control'name='capturedVariableValue[]' placeholder='Radio Box Options' required></div>";
        //}
        returnString += "</div><div class='col-sm-3'>&nbsp;</div></div>";
        //if(FieldsType == "Check Box") {
        //    returnString += addRows;
        //} else if(FieldsType == "Radio Button") {
        //    returnString += addRows;
        //}

        if(categoryId==""){
            //alert("Please Select Category!");
            $("#FieldsOptionsContent").html("");

        } else {
            $("#FieldsOptionsContent").html(returnString);
            if(categoryId!="")
                $("#dynamicInputId").select2();
        }
    } else {
        $("#FieldsOptionsContent").html(returnString);
    }
}

function checkFieldsTypeAndLoadContent(FieldsType, action, dynamicInputId){
    getFieldsTypeAddContent(FieldsType, dynamicInputId);
}

function retrnDataUsingAjax(postData, postUrl) {
    return $.ajax({
        type: "GET",
        url: postUrl,
        data: postData,
        async: !1,
        success: function(response){
            return response;
        },
        error: function() {
            alert("Please try again later!");
        }
    });
}

function deleteRowFields(FieldsType){
    var id = 1;
    var stringClassId = "";
    if(FieldsType == "Check Box"){
        stringClassId = "checkBoxRow";
    }
    if(FieldsType == "Radio Button"){
        stringClassId = "radioButtonRow";
    }

    if(stringClassId!=""){
        id = $("."+stringClassId).length;
        if(id>1)
            $("#"+stringClassId+id).remove();
    }

}

function addRowFields(FieldsType){

    var returnString = "";
    var id = 1;

    if(FieldsType == "Check Box"){
        id = $(".checkBoxRow").length+1
    }

    if(FieldsType == "Radio Button"){
        id = $(".radioButtonRow").length+1
    }

    if(FieldsType == "Check Box"){
        returnString = "<div class='checkBoxRow' id='checkBoxRow"+id+"'><input type='text' class='form-control'name='capturedVariableValue[]' placeholder='Check Box Value' required></div>";
    } else if(FieldsType == "Radio Button"){
        returnString = "<div class='radioButtonRow' id='radioButtonRow"+id+"'><input type='text' class='form-control'name='capturedVariableValue[]' placeholder='Radio Box Options' required></div>";
    }
    $("#FieldsValueDivId").append(returnString);
}

function getDynamicInputMasterList(selectedId){

    var postData = "";
    //var postData = "categoryId="+categoryId;
    var postUrl = "getDynamicSelectBox";
    $.ajax({
        url: postUrl,
        type: "GET",
        data: postData,
        success: function (data) {
            var jsonData = JSON.parse(data);
            var stateLength = jsonData.length;
            var stateList = '<select name="dynamicInputId" id="dynamicInputId" class="form-control" > <option value="">Select Dynamic Input Name</option>';
            for(var i=0; i<stateLength; i++){
                var dynamicInputId = jsonData[i]['dynamicInputId'];
                var dynamicInputName = jsonData[i]['dynamicInputName'];
                if(selectedId!=dynamicInputId){
                    stateList = stateList + '<option value="'+dynamicInputId+'">'+dynamicInputName+'</option>';
                }else{
                    stateList = stateList + '<option value="'+dynamicInputId+'" selected="selected">'+dynamicInputName+'</option>';
                }

            }
            stateList = stateList + ' </select>';
            $("#dynamicSelectBoxIdDiv").html(stateList);
            $("#dynamicInputId").select2();
        }
    });

}


function getDynamicFieldsforAdPost(divId){
    var postData = "categoryId="+$("#searchCategoryId").val();
    var postUrl = "../Frontend/getDynamicFieldsforAdPost";
    $.ajax({
        url: postUrl,
        type: "GET",
        data: postData,
        success: function (data) {
            $("#"+divId).html(data);

        }
    });
}

function changeIsSearch(val){
    if(val=="Yes"){
        $("#isSearchableDiv").show();
    } else {
        $("#isSearchableDiv").hide();
    }

}