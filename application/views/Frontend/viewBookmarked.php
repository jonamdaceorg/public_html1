<!--single-page-->
<div class="single-page main-grid-border">
    <div class="container">
        <ol class="breadcrumb" style="margin-bottom: 5px;">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="active">View All My Bookmarked</li>
        </ol>

        <form name="adsSearchForm" id="adsSearchForm" method="post" >
            <input type="hidden" name="getListFromPage" id="getListFromPage" value="<?php echo $title; ?>"/>
            <div id="myTabContent" class="tab-content">
            </div>
        </form>
    </div>
</div>
<!--//single-page-->



<script>
    loadsearchData('');
    function loadsearchData(page)
    {
        var postData=   $( "#adsSearchForm" ).serialize()+"&page="+page;
//        var postData=   $( "#adsSearchForm" ).serialize();
        $.get("searchAdsAjax",postData,function(data){
            $("#myTabContent").html(data);
        });
    }
    $( "#adsSearchForm" ).change(function() {
        loadsearchData();
    });
</script>