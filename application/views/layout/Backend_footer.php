<?php
/**
 * Created by IntelliJ IDEA.
 * User: jonam
 * Date: 23/7/16
 * Time: 11:08 AM
 */


?>


<!-- jQuery  -->

<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/detect.js"></script>
<script src="<?php echo base_url(); ?>assets/js/fastclick.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.blockUI.js"></script>
<script src="<?php echo base_url(); ?>assets/js/waves.js"></script>
<script src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.scrollTo.min.js"></script>

<!-- Counter Up  -->
<script src="<?php echo base_url(); ?>assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/counterup/jquery.counterup.min.js"></script>

<!-- circliful Chart -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-circliful/js/jquery.circliful.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

<!-- skycons -->
<script src="<?php echo base_url(); ?>assets/plugins/skyicons/skycons.min.js" type="text/javascript"></script>

<!-- Page js  -->
<script src="<?php echo base_url(); ?>assets/pages/jquery.dashboard.js"></script>

<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- Datatables-->

<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.keyTable.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/responsive.bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/pages/jquery.sweet-alert.init.js"></script>

<!-- Custom main Js -->
<script src="<?php echo base_url(); ?>assets/js/jquery.core.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.app.js"></script>
<script src="<?php echo base_url(); ?>assets/pages/datatables.init.js"></script>
<script type="text/javascript" src=" <?php echo base_url(); ?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>

<!-- Notification js -->
<script src="<?php echo base_url(); ?>assets/plugins/notifyjs/dist/notify.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/notifications/notify-metro.js"></script>

<!----Select2----------->
<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.min.js" type="text/javascript"></script>


<!-- Notification js -->
<script src="<?php echo base_url(); ?>assets/plugins/notifyjs/dist/notify.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/notifications/notify-metro.js"></script>

<script type="text/javascript">
    /*jQuery(document).ready(function($) {
     $('.counter').counterUp({
     delay: 100,
     time: 1200
     });
     $('.circliful-chart').circliful();
     });

     /* BEGIN SVG WEATHER ICON */

    $(document).ready(function () {

        $('form').parsley();
        $(".select2").select2();
    });
    if (typeof Skycons !== 'undefined') {
        var icons = new Skycons(
            {"color": "#00b19d"},
            {"resizeClear": true}
            ),
            list = [
                "clear-day", "clear-night", "partly-cloudy-day",
                "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                "fog"
            ],
            i;

        for (i = list.length; i--;)
            icons.set(list[i], list[i]);
        icons.play();
    }
    ;
    // Date Picker

    jQuery('.datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    $(".select2").select2();


    $(document).ready(function () {
        $('#datatable').dataTable();

        $('#datatable-responsive').DataTable();

    });

    jQuery('#date-range').datepicker({
        autoclose: true,
        toggleActive: true,
        format: "yyyy-mm-dd",
        orientation: "top" // add this
    });

</script>
<script>
</script>


<div class="modal modalloaidng"><!-- Place at bottom of page --></div>
<script>
    $body = $("body");

    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });
</script>

<style>



    /*****css for loading image start  ****/


    .modalloaidng  {
        display:    none;
        position:   fixed;
        z-index:    1000;
        top:        0;
        left:       0;
        height:     100%;
        width:      100%;
        background: rgba( 255, 255, 255, .8 )
        url('../assets/web/images/loading.gif')
        50% 50%
        no-repeat;
    }

    /* When the body has the loading class, we turn
       the scrollbar off with overflow:hidden */
    body.loading {
        overflow: hidden;
    }

    /* Anytime the body has the loading class, our
       modal element will be visible */
    body.loading .modal {
        display: block;
    }
    /*******css for loading image end **/
</style>
</body>
</html>

