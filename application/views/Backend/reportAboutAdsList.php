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
                        <div id="msgDiv"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div id="usersListDiv">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive example"
                                   cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Sno</th>
                                    <th>reporting Title</th>
                                    <th>Ads Id </th>
                                    <th>description</th>
                                    <th>Time</th>
                                    <th>Edit</th>
<!--                                    <th>Delete</th>-->
                                </tr>
                                </thead>
                                <tbody>

                                <?php for ($i = 0; $i < count($adsReportArray); $i++) { ?>
                                    <tr>
                                        <?php $categoryId = $adsReportArray[$i]['id']; ?>
                                        <td><?php echo $i + 1; ?></td>
                                        <td><?php echo $adsReportArray[$i]['reportingType']; ?></td>
                                        <td><?php echo $adsReportArray[$i]['adsId']; ?></td>
                                        <td><?php echo $adsReportArray[$i]['description']; ?></td>
                                        <td><?php echo $adsReportArray[$i]['createdAt']; ?></td>

                                        <td>
                                            <?php $dynamicSelectBoxValueId=$adsReportArray[$i]['adsId'];  ?>
                                            <a href="<?php echo base_url().'Backend/viewAds?adsId='.$dynamicSelectBoxValueId; ?>" target="_blank">    <button class="btn btn-icon waves-effect waves-light btn-primary m-b-5" type="button" >
                                               <i class="fa fa-edit"></i>
                                            </button></a>
                                        </td>
<!--                                        <td>-->
<!--                                            <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" type="button" >-->
<!--                                                <i class="fa fa-remove"></i>-->
<!--                                            </button>-->
<!--                                        </td>-->
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>





                        </div>
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


    </div> <!-- end container -->
</div>


