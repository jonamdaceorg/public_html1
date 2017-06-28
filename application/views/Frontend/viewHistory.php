<!--single-page-->
<div class="single-page main-grid-border">
    <div class="container">
        <ol class="breadcrumb" style="margin-bottom: 5px;">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="active">View All My History</li>
        </ol>
        <form name="adsSearchForm" id="adsSearchForm" method="post" >
            <input type="hidden" name="getListFromPage" id="getListFromPage" value="<?php echo $title; ?>"/>
            <div id="myTabContent"></div>
        </form>

    </div>
</div>

<!--//single-page-->

<script>
    loadsearchData('');
    function loadsearchData(page)
    {
        $("#myTabContent").html("<div  style='text-align:center;'><span class='fa fa-circle-o-notch fa-spin fa-3x text-success'></span></div>");
        var postData=   $( "#adsSearchForm" ).serialize()+"&page="+page;
        $.get("getHistoryList",postData,function(data){
            $("#myTabContent").html(data);
            $('#datatable-responsive').DataTable();
        });
    }
    $( "#adsSearchForm" ).change(function() {
        loadsearchData('');
    });
</script>