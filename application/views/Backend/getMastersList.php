<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jonam
 * Date: 8/10/16
 * Time: 2:25 PM
 */
?>

<?php if($title == "Ad Banner Master"){ ?>
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive example"
           cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Sno</th>
            <th>Banner title</th>
            <th>Description</th>
            <th>Position</th>
            <th>Banner Type</th>
            <th>Mobile View</th>
            <th>Days to Active</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($adBannerArray); $i++) { ?>
            <tr>
                <?php $adBannerId = $adBannerArray[$i]['adBannerId']; ?>
                <td><?php echo $i + 1; ?></td>
                <td>
                    <?php echo substr($adBannerArray[$i]['title'], 0, 50);
                        if(strlen($adBannerArray[$i]['title']) > 50)
                            echo "...";
                    ?>
                </td>
                <td>
                    <?php echo substr($adBannerArray[$i]['description'], 0, 50);
                        if(strlen($adBannerArray[$i]['description']) > 50)
                            echo "...";
                    ?>
                </td>
                <td><?php echo $adBannerArray[$i]['typeOfPosition']; ?></td>
                <td><?php echo $adBannerArray[$i]['bannerType']; ?></td>
                <td><?php echo $adBannerArray[$i]['isMobileView']; ?></td>
                <td><?php echo $adBannerArray[$i]['noOfDaysToActive']; ?></td>
                <td><?php echo $adBannerArray[$i]['startDate']; ?></td>
                <td><?php echo $adBannerArray[$i]['endDate']; ?></td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-primary m-b-5" type="button" onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $adBannerId; ?>&title=<?php echo $title; ?>', '<?php echo $AddOrEditMasterContent; ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" type="button" onclick="deleteMaster('<?php echo $title; ?>','submit=<?php echo $title; ?>&actionType=Delete&actionId=<?php echo $adBannerId; ?>','<?php echo $deletUrl; ?>')">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php } else if($title == "Category Master"){ ?>
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive example"
           cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Sno</th>
            <th>Category</th>
            <th>Order Place</th>
            <th>Is Amount</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($categoryArray); $i++) { ?>
            <tr>
                <?php $categoryId = $categoryArray[$i]['categoryId']; ?>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $categoryArray[$i]['category']; ?></td>
                <td><?php echo $categoryArray[$i]['orders']; ?></td>
                <td><?php if($categoryArray[$i]['isAmountRequired']=="Required"){ echo "Required"; } else { echo "Not Required"; } ?></td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-primary m-b-5" type="button" onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $categoryId; ?>&title=<?php echo $title; ?>', '<?php echo $AddOrEditMasterContent; ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" type="button" onclick="deleteMaster('<?php echo $title; ?>','submit=<?php echo $title; ?>&actionType=Delete&actionId=<?php echo $categoryId; ?>','<?php echo $deletUrl; ?>')">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php } else if($title == "Sub Category Master"){ ?>
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive example"
           cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Sno</th>
            <th>Sub Category</th>
            <th>Category</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($subCategoryArray); $i++) { ?>
            <tr>
                <?php $categoryId = $subCategoryArray[$i]['subCategoryId']; ?>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $subCategoryArray[$i]['subCategory']; ?></td>
                <td><?php echo $subCategoryArray[$i]['category']; ?></td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-primary m-b-5" type="button" onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $categoryId; ?>&title=<?php echo $title; ?>', '<?php echo $AddOrEditMasterContent; ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" type="button" onclick="deleteMaster('<?php echo $title; ?>','submit=<?php echo $title; ?>&actionType=Delete&actionId=<?php echo $categoryId; ?>','<?php echo $deletUrl; ?>')">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <!---------country master start ---------------->


<?php } else if($title == "Item Master"){ ?>
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive example"
           cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Sno</th>
            <th>Item</th>
            <th>Sub Category</th>
            <th>Category</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($itemArray); $i++) { ?>
            <tr>
                <?php $itemId = $itemArray[$i]['itemId']; ?>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $itemArray[$i]['item']; ?></td>
                <td><?php echo $itemArray[$i]['subCategory']; ?></td>
                <td><?php echo $itemArray[$i]['category']; ?></td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-primary m-b-5" type="button" onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $itemId; ?>&title=<?php echo $title; ?>', '<?php echo $AddOrEditMasterContent; ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" type="button" onclick="deleteMaster('<?php echo $title; ?>','submit=<?php echo $title; ?>&actionType=Delete&actionId=<?php echo $itemId; ?>','<?php echo $deletUrl; ?>')">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <!---------country master start ---------------->


<?php } else if($title == "Country Master"){ ?>
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive example"
           cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Sno</th>
            <th>Country</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($countryArray); $i++) { ?>
            <tr>
                <?php $categoryId = $countryArray[$i]['countryId']; ?>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $countryArray[$i]['country']; ?></td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-primary m-b-5" type="button" onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $categoryId; ?>&title=<?php echo $title; ?>', '<?php echo $AddOrEditMasterContent; ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" type="button" onclick="deleteMaster('<?php echo $title; ?>','submit=<?php echo $title; ?>&actionType=Delete&actionId=<?php echo $categoryId; ?>','<?php echo $deletUrl; ?>')">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <!-------- state master end----------- -->

    <?php } else if($title == "State Master"){ ?>
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive example"
           cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Sno</th>
            <th>city</th>
            <th>Country</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($stateArray); $i++) { ?>
            <tr>
                <?php $stateId = $stateArray[$i]['stateId']; ?>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $stateArray[$i]['state']; ?></td>
                <td><?php echo $stateArray[$i]['country']; ?></td>

                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-primary m-b-5" type="button" onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $stateId; ?>&title=<?php echo $title; ?>', '<?php echo $AddOrEditMasterContent; ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" type="button" onclick="deleteMaster('<?php echo $title; ?>','submit=<?php echo $title; ?>&actionType=Delete&actionId=<?php echo $stateId; ?>','<?php echo $deletUrl; ?>')">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <!-------- state master end----------- -->


    <!-------- District master end----------- -->

    <?php } else if($title == "District Master"){ ?>
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive example"
           cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Sno</th>
            <th>District</th>
            <th>State</th>
            <th>Country</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($districtArray); $i++) { ?>
            <tr>
                <?php $districtId = $districtArray[$i]['districtId']; ?>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $districtArray[$i]['district']; ?></td>

                <td><?php echo $districtArray[$i]['state']; ?></td>
                <td><?php echo $districtArray[$i]['country']; ?></td>

                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-primary m-b-5" type="button" onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $districtId; ?>&title=<?php echo $title; ?>', '<?php echo $AddOrEditMasterContent; ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" type="button" onclick="deleteMaster('<?php echo $title; ?>','submit=<?php echo $title; ?>&actionType=Delete&actionId=<?php echo $districtId; ?>','<?php echo $deletUrl; ?>')">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <!-------- District master end----------- -->

    <!---------Reporting master start ---------------->


<?php }  else if($title == "Sub District Master"){ ?>
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive example"
           cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Sno</th>
            <th>Taulk</th>
            <th>District</th>
            <th>State</th>
            <th>Country</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($subDistrictArray); $i++) { ?>
            <tr>
                <?php $subDistrictId = $subDistrictArray[$i]['subDistrictId']; ?>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $subDistrictArray[$i]['subDistrict']; ?></td>
                <td><?php echo $subDistrictArray[$i]['district']; ?></td>
                <td><?php echo $subDistrictArray[$i]['state']; ?></td>
                <td><?php echo $subDistrictArray[$i]['country']; ?></td>

                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-primary m-b-5" type="button" onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $subDistrictId; ?>&title=<?php echo $title; ?>', '<?php echo $AddOrEditMasterContent; ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" type="button" onclick="deleteMaster('<?php echo $title; ?>','submit=<?php echo $title; ?>&actionType=Delete&actionId=<?php echo $subDistrictId; ?>','<?php echo $deletUrl; ?>')">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <!-------- District master end----------- -->

    <!---------Reporting master start ---------------->


<?php } else if($title == "Reporting Master"){ ?>
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive example"
           cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Sno</th>
            <th>Report</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($adsReportingArray); $i++) { ?>
            <tr>
                <?php $adsReportingId = $adsReportingArray[$i]['reportingId']; ?>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $adsReportingArray[$i]['reportingType']; ?></td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-primary m-b-5" type="button" onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $adsReportingId; ?>&title=<?php echo $title; ?>', '<?php echo $AddOrEditMasterContent; ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" type="button" onclick="deleteMaster('<?php echo $title; ?>','submit=<?php echo $title; ?>&actionType=Delete&actionId=<?php echo $adsReportingId; ?>','<?php echo $deletUrl; ?>')">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>



<?php } else if($title == "Membership Package Master"){ ?>
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive example"
           cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>S.No</th>
            <th>Package Name</th>
            <th>No.of Days</th>
            <th>Amount</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($membershipPackageArray); $i++) { ?>
            <tr>
                <?php $packageId = $membershipPackageArray[$i]['packageId']; ?>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $membershipPackageArray[$i]['membershipPackageTitle']; ?></td>
                <td><?php echo $membershipPackageArray[$i]['noOfDaysToActive']; ?></td>
                <td><?php echo $membershipPackageArray[$i]['packageAmount']; ?></td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-primary m-b-5" type="button" onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $packageId; ?>&title=<?php echo $title; ?>', '<?php echo $AddOrEditMasterContent; ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" type="button" onclick="deleteMaster('<?php echo $title; ?>','submit=<?php echo $title; ?>&actionType=Delete&actionId=<?php echo $packageId; ?>','<?php echo $deletUrl; ?>')">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>



<?php } else if($title == "Dynamic Fields"){
//        print_r($dynamicAdsVariableArray);

    ?>
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive example"
           cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>S.No</th>
            <th>Captured Variable Name</th>
            <th>Captured Variable Type</th>
            <th>Dynamic Input Name</th>
            <th>Category</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($dynamicAdsVariableArray); $i++) { ?>
            <tr>
                <?php $capturedVariableId = $dynamicAdsVariableArray[$i]['capturedVariableId']; ?>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $dynamicAdsVariableArray[$i]['capturedvariablename']; ?></td>
                <td><?php echo $dynamicAdsVariableArray[$i]['dynamicInputType']; ?></td>
                <td><?php echo $dynamicAdsVariableArray[$i]['dynamicInputName']; ?></td>
                <td><?php echo $dynamicAdsVariableArray[$i]['category']; ?></td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-primary m-b-5" type="button" onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $capturedVariableId; ?>&title=<?php echo $title; ?>', '<?php echo $AddOrEditMasterContent; ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" type="button" onclick="deleteMaster('<?php echo $title; ?>','submit=<?php echo $title; ?>&actionType=Delete&actionId=<?php echo $capturedVariableId; ?>','<?php echo $deletUrl; ?>')">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php } else if($title == "Dynamic Input"){ ?>
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive example"
           cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>S.No</th>
            <th>Input Name</th>
            <th>Input Type</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($dynamicInputMasterArray); $i++) { ?>
            <tr>
                <?php $dynamicSelectBoxId = $dynamicInputMasterArray[$i]['dynamicInputId']; ?>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $dynamicInputMasterArray[$i]['dynamicInputName']; ?></td>
                <td><?php echo $dynamicInputMasterArray[$i]['dynamicInputType']; ?></td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-primary m-b-5" type="button" onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $dynamicSelectBoxId; ?>&title=<?php echo $title; ?>', '<?php echo $AddOrEditMasterContent; ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" type="button" onclick="deleteMaster('<?php echo $title; ?>','submit=<?php echo $title; ?>&actionType=Delete&actionId=<?php echo $dynamicSelectBoxId; ?>','<?php echo $deletUrl; ?>')">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } else if($title == "Dynamic Input Value"){ ?>
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive example"
           cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>S.No</th>
            <th>Options</th>
            <th>Dynamic Input Name</th>
            <th>Input Type</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($dynamicInputValueArray); $i++) { ?>
            <tr>
                <?php $dynamicInputValueId = $dynamicInputValueArray[$i]['dynamicInputValueId']; ?>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $dynamicInputValueArray[$i]['dynamicInputValue']; ?></td>
                <td><?php echo $dynamicInputValueArray[$i]['dynamicInputName']; ?></td>
                <td><?php echo $dynamicInputValueArray[$i]['dynamicInputType']; ?></td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-primary m-b-5" type="button" onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $dynamicInputValueId; ?>&title=<?php echo $title; ?>', '<?php echo $AddOrEditMasterContent; ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" type="button" onclick="deleteMaster('<?php echo $title; ?>','submit=<?php echo $title; ?>&actionType=Delete&actionId=<?php echo $dynamicInputValueId; ?>','<?php echo $deletUrl; ?>')">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } else if($title == "Contact Us Master"){  ?>
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive example"
           cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile Number</th>
            <th>Category</th>
            <th>Description</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($contactUsArray); $i++) { ?>
            <tr>
                <?php $id = $contactUsArray[$i]['id']; ?>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $contactUsArray[$i]['name']; ?></td>
                <td><?php echo $contactUsArray[$i]['email']; ?></td>
                <td><?php echo $contactUsArray[$i]['mobileNumber']; ?></td>
                <td><?php echo $contactUsArray[$i]['category']; ?></td>
                <td><?php echo $contactUsArray[$i]['description']; ?></td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-primary m-b-5" type="button" onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $id; ?>&title=<?php echo $title; ?>', '<?php echo $AddOrEditMasterContent; ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" type="button" onclick="deleteMaster('<?php echo $title; ?>','submit=<?php echo $title; ?>&actionType=Delete&actionId=<?php echo $id; ?>','<?php echo $deletUrl; ?>')">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php } else if($title == "Ads") {
    if ($getGenerateExcel == 1) {
        $fileNameOfExcel = "UsersList".date("YmdHis");
        header("Content-Type: application/vnd.ms-excel");
        header("Content-disposition: attachment; filename=".$fileNameOfExcel.".xls");

        $content = "S.No\t";
        $content .= "Title\t";
        $content .= "Status\t";
        $content .= "No Of Days To Active\t";
        $content .= "StartDate\t";
        $content .= "EndDate\t";
        $content .= "Category\t";
        $content .= "SubCategory\t";
        $content .= "Item\t";
        $content .= "Country\t";
        $content .= "State\t";
        $content .= "City\t";
        $content .= "From IP\t";
        $content .= "Created At\t";
        $content .= "\n";

        for ($i = 0; $i < count($adsArray); $i++) {
            $sno = $i + 1;
            $adsId = $adsArray[$i]['adsId'];
            $adsTitle = $adsArray[$i]['adsTitle'];
            $active = $adsArray[$i]['active'];
            $noOfDaysToActive = $adsArray[$i]['noOfDaysToActive'];
            $startDate = $adsArray[$i]['startDate'];
            $endDate = $adsArray[$i]['endDate'];
            $createdat = $adsArray[$i]['createdAt'];
            $category = $adsArray[$i]['category'];
            $subCategory = $adsArray[$i]['subCategory'];
            $item = $adsArray[$i]['item'];
            $country = $adsArray[$i]['country'];
            $state = $adsArray[$i]['state'];
            $city = $adsArray[$i]['city'];
            $fromIp = $adsArray[$i]['fromIp'];

            if($item=="" || $item==null){
                $item = "-";
            }
            $content .= $sno . "\t";
            $content .= $adsTitle . "\t";
            $content .= $active . "\t";
            $content .= $noOfDaysToActive . "\t";
            $content .= $startDate . "\t";
            $content .= $endDate . "\t";
            $content .= $createdat . "\t";
            $content .= $category . "\t";
            $content .= $subCategory . "\t";
            $content .= $item . "\t";
            $content .= $country . "\t";
            $content .= $state . "\t";
            $content .= $city . "\t";
            $content .= $fromIp . "\t";
            $content .= "\n";
        }
        echo $content;

    } else {
        ?>
       <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive example"
               cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>SNo</th>
                <th>View</th>
                <th>Title</th>
                <th>Status</th>
                <th>No Of Days To Active</th>
                <!-- <th>StartDate</th>
                <th>EndDate</th> -->
                <th>CreatedAt</th>
                <th>Category</th>
                <th>SubCategory</th>
                <th>Item</th>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>From IP</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($adsArray); $i++) { ?>
                <tr>
                    <?php $dynamicSelectBoxValueId = $adsArray[$i]['adsId']; ?>
                    <td><?php echo $i + 1; ?></td>
                    <td>
                        <a href="<?php echo base_url().'Backend/viewAds?adsId='.$dynamicSelectBoxValueId; ?>" target="_blank"><button class="btn btn-icon waves-effect waves-light btn-info m-b-5" type="button">
                            <i class="fa fa-eye"></i>
                        </button></a>
                    </td>
                    <td><?php echo $adsArray[$i]['adsTitle']; ?></td>
                    <td><?php echo $adsArray[$i]['active']; ?></td>
                    <td><?php echo $adsArray[$i]['noOfDaysToActive']; ?></td>
                    <!-- <td><?php echo $adsArray[$i]['startDate']; ?></td>
                    <td><?php echo $adsArray[$i]['endDate']; ?></td> -->
                    <td><?php echo $adsArray[$i]['createdAt']; ?></td>
                    <td><?php echo $adsArray[$i]['category']; ?></td>
                    <td><?php echo $adsArray[$i]['subCategory']; ?></td>
                    <td><?php if($adsArray[$i]['item']!="" && $adsArray[$i]['item']!=null){ echo $adsArray[$i]['item']; } else { echo "-"; }  ?></td>
                    <td><?php echo $adsArray[$i]['country']; ?></td>
                    <td><?php echo $adsArray[$i]['state']; ?></td>
                    <td><?php echo $adsArray[$i]['city']; ?></td>
                    <td><?php echo $adsArray[$i]['fromIp']; ?></td>
                    <td>
                        <button class="btn btn-icon waves-effect waves-light btn-primary m-b-5" type="button"
                                onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $dynamicSelectBoxValueId; ?>&title=<?php echo $title; ?>', '<?php echo $AddOrEditMasterContent; ?>')">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" type="button"
                                onclick="deleteMaster('<?php echo $title; ?>','submit=<?php echo $title; ?>&actionType=Delete&actionId=<?php echo $dynamicSelectBoxValueId; ?>','<?php echo $deletUrl; ?>')">
                            <i class="fa fa-remove"></i>
                        </button>
                    </td>

                </tr>
            <?php } ?>
            </tbody>
        </table>


    <?php }

}
?>

