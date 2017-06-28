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
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title"><?php echo $title; ?> Master</h4>
            </div>
        </div>
        <!-- Page-Title -->
        <!-- Custom Modals -->
        <div class="card-box">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <p class="text-muted m-b-20 font-13">
                                Add, Edit and Delete <?php echo $title; ?>
                                <?php $loadAddOrEditModalUrl = base_url()."Backend/AddOrEditMasterContent"; ?>
                            </p>
                            <button class="btn btn-primary waves-effect waves-light m-t-10" onclick="getAddOrEditModalContent('actionType=Add&actionId=0&title=<?php echo $title; ?>', '<?php echo $loadAddOrEditModalUrl; ?>')">Add <?php echo $title; ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div id="msgDiv"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div id="usersListDiv"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End row -->
        <div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content p-0 b-0" id="modalContentArea">

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- End Footer -->
        <?php include_once "innerFooter.php"; ?>
    </div> <!-- end container -->
</div>
<!-- End wrapper -->
<input type="hidden" name="getMastersListUrl" id="getMastersListUrl" value="<?php echo $getMastersListUrl; ?>">
<input type="hidden" name="title" id="title" value="<?php echo $title; ?>">
<script>
    var postData = "title="+$("#title").val();
    loadMastersList(postData, $("#getMastersListUrl").val());
</script>

