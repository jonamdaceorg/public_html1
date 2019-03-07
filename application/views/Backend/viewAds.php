<?php
/**
 * Created by IntelliJ IDEA.
 * User: jonam
 * Date: 30/1/17
 * Time: 7:49 PM
 */
?>

<?php
//
//echo "<br><br><br><br><br><br><br><br>";
//print_r($adsArray);

?>
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
            <?php if (count($adsArray) > 0) { ?>
                <form action="updateAdsStatusForm" name="updateAdsStatusForm" method="post">
                    <input type="hidden" name="adsId" id="adsId" value="<?php echo $adsArray[0]['adsId']?>"/>
                    <?php print_r($succesMsg); ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <p class="text-muted m-b-20 font-13">
                                        <?php echo $title; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="text-muted m-b-20 note-fontsize-10">No Of Days To Active</p>
                            </div>
                            <div class="col-md-3">
                                <?php echo $adsArray[0]['noOfDaysToActive']; ?>
                            </div>
                            <div class="col-md-3">
                                <p class="text-muted m-b-20 note-fontsize-10">Status</p>
                            </div>
                            <div class="col-md-3">
                                <span class="text-danger" style="font-weight: bold"><?php echo $adsStatus = $adsArray[0]['active']; ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="text-muted m-b-20 note-fontsize-10">Start Date</p>
                            </div>
                            <div class="col-md-3">
                                <?php echo $adsArray[0]['startDate']; ?>
                            </div>
                            <div class="col-md-3">
                                <p class="text-muted m-b-20 note-fontsize-10">End Date</p>
                            </div>
                            <div class="col-md-3">
                                <?php echo $adsArray[0]['endDate']; ?>
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="text-muted m-b-20 note-fontsize-10">Category</p>
                            </div>
                            <div class="col-md-3">
                                <?php echo $adsArray[0]['category']; ?>
                            </div>
                            <div class="col-md-3">
                                <p class="text-muted m-b-20 note-fontsize-10">Sub Category</p>
                            </div>
                            <div class="col-md-3">
                                <?php echo $adsArray[0]['subCategory']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="text-muted m-b-20 note-fontsize-10">Item</p>
                            </div>
                            <div class="col-md-3">
                                <?php echo $adsArray[0]['item']; ?>
                            </div>
                            <div class="col-md-3">
                                <p class="text-muted m-b-20 note-fontsize-10">Country</p>
                            </div>
                            <div class="col-md-3">
                                <?php echo $adsArray[0]['country']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="text-muted m-b-20 note-fontsize-10">State</p>
                            </div>
                            <div class="col-md-3">
                                <?php echo $adsArray[0]['state']; ?>
                            </div>
                            <div class="col-md-3">
                                <p class="text-muted m-b-20 note-fontsize-10">City</p>
                            </div>
                            <div class="col-md-3">
                                <?php echo $adsArray[0]['city']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="text-muted m-b-20 note-fontsize-10">From Ip</p>
                            </div>
                            <div class="col-md-3">
                                <?php echo $adsArray[0]['fromIp']; ?>
                            </div>
                            <div class="col-md-3">
                                <p class="text-muted m-b-20 note-fontsize-10">Created At</p>
                            </div>
                            <div class="col-md-3">
                                <?php echo $adsArray[0]['createdAt']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-muted m-b-20 note-fontsize-10">Title</p>
                                <?php echo $adsArray[0]['adsTitle']; ?>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted m-b-20 note-fontsize-10">Description</p>
                                <?php echo $adsArray[0]['description']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-1">
                                &nbsp;
                            </div>
                            <div class="col-md-8 text-center">
                                <p class="text-muted m-b-20 note-fontsize-10 text-center"><b>Approve Gallery Images</b></p>

                                <?php
                                $userId = $adsArray[0]['userid'];
                                $adsId = $adsArray[0]['adsId'];
                                $adsCode = $adsArray[0]['adsCode'];
                                $userCode = $adsArray[0]['userCode'];
                                    for($n=0; $n<count($adsGalleryArray); $n++){
                                        $adsGalleryId = $adsGalleryArray[$n]['adsGalleryId'];
                                        $galleryActive = $adsGalleryArray[$n]['active'];

                                        $imageName = $adsGalleryArray[$n]['file_name'];
                                        ?>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <?php $imgPath = base_url() . "uploads/files/userads/".$userCode."/".$adsCode."/" . $imageName; ?>
                                                        <a href="javascript:void(0)" onclick='viewMyAdsPhoto("<?php echo $imgPath; ?>")'><img src="<?php echo base_url() . 'uploads/files/userads/'.$userCode."/".$adsCode."/" . $imageName; ?>" width="100" height="100"/></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <select name="galleryActiveStatus<?php echo $adsGalleryId; ?>"
                                                                id="galleryActiveStatus<?php echo $adsGalleryId; ?>"
                                                                class="form-control">

                                                            <option value="">Select Status</option>

                                                            <option value="Waiting" <?php if ($galleryActive == "Waiting") {
                                                                echo "selected";
                                                            } ?>>Waiting
                                                            </option>
                                                            <option value="active" <?php if ($galleryActive == "active") {
                                                                echo "selected";
                                                            } ?>>active
                                                            </option>
                                                            <option value="InActive" <?php if ($galleryActive == "InActive") {
                                                                echo "selected";
                                                            } ?>>InActive
                                                            </option>
                                                            <option value="deleted" <?php if ($galleryActive == "deleted") {
                                                                echo "selected";
                                                            } ?>>deleted
                                                            </option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="col-md-1">
                                &nbsp;
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                &nbsp;
                            </div>
                            <div class="col-sm-3 text-center">
                                Update Ads Status :
                            </div>
                            <div class="col-sm-3 text-center">
                                <select name="activeStatus" id="activeStatus" class="form-control">
                                    <option value="">Select Status</option>

                                    <option value="Waiting" <?php if ($adsStatus == "Waiting") {
                                        echo "selected";
                                    } ?>>Waiting
                                    </option>
                                    <option value="active" <?php if ($adsStatus == "active") {
                                        echo "selected";
                                    } ?>>active
                                    </option>
                                    <option value="InActive" <?php if ($adsStatus == "InActive") {
                                        echo "selected";
                                    } ?>>InActive
                                    </option>
                                    <option value="deleted" <?php if ($adsStatus == "deleted") {
                                        echo "selected";
                                    } ?>>deleted
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                &nbsp;
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                &nbsp;
                            </div>
                            <div class="col-md-4 text-center">
                                <input type="submit" name="UpdateStatus" value="Update status" class="btn btn-primary"/>
                            </div>
                            <div class="col-md-4">
                                &nbsp;
                            </div>
                        </div>
                    </div>
                </form>
            <?php } ?>
        </div>

        <!-- End Footer -->
        <?php include_once "innerFooter.php"; ?>
    </div>

    <script>
        function viewMyAdsPhoto(path){
            var str = "<img src='"+path+"' class='imgresponsive'>";
            $("#imgFile").html(str);
//            alert(path);
            $('#myModal').modal('show');
        }
    </script>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-sm  modal-md">
            <div class="modal-content">
<!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">-->
<!--                    &times;</button>-->

                    <h4 class="text-center">View uploaded Image</h4>
                    <br>
                    <div id="imgFile" class="text-center"></div>


                    <br/>
                <div class="text-center">
                    <input type="button" value="Close" class="btn btn-warning" data-dismiss="modal" aria-hidden="true">
                </div>

            </div>
        </div>
    </div>
    <!-- end container -->
</div>

<style>
    .card-box{
        margin-bottom: 80px;
    }
</style>