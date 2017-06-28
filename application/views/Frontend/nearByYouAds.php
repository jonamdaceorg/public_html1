<!--single-page-->
<div class="single-page main-grid-border">
    <div class="container">
        <ol class="breadcrumb" style="margin-bottom: 5px;">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="active"><?php echo $title; ?></li>
        </ol>

        <form name="adsSearchForm" id="adsSearchForm" method="post" >
            <input type="hidden" name="getListFromPage" id="getListFromPage" value="<?php echo $title; ?>"/>
            <input type="hidden" name="myLatitude" id="myLatitude"/>
            <input type="hidden" name="myLongitude" id="myLongitude"/>
            <div id="myTabContent" class="tab-content">
            </div>
        </form>
    </div>
</div>
<!--//single-page-->
<script src="http://maps.google.com/maps/api/js?key=AIzaSyDSpcghpRmu39ThwNSAP3cyEPMMnQBotQ0"></script>
<script>

    if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showPosition);
    }


    function showPosition(position) {

        var latitude=position.coords.latitude;
        var longitude=position.coords.longitude;
        $("#myLatitude").val(latitude);
        $("#myLongitude").val(longitude);

        loadsearchData($("#getListFromPage").val());
    }

</script>


<script>
    loadsearchData($("#getListFromPage").val());
    function loadsearchData(page)
    {
        var longitude = $("#myLongitude").val();
        var latitude = $("#myLatitude").val();
        if(myLatitude!="" && myLongitude!=""){

        } else {
            if (navigator.geolocation){
                navigator.geolocation.getCurrentPosition(showPosition);
            }
        }
//        var postData=   $( "#adsSearchForm" ).serialize();
        var postData=   $( "#adsSearchForm" ).serialize()+"&page="+page;
        $.get("searchAdsAjax",postData,function(data){
            $("#myTabContent").html(data);
        });
    }
    $( "#adsSearchForm" ).change(function() {
        loadsearchData($("#getListFromPage").val());
    });
</script>