



<!-- Large modal -->
			
		
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
					aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										&times;</button>
									<h4 class="modal-title" id="myModalLabel">
										Please Choose Your Location</h4>
								</div>
								<div class="modal-body">
									 <form class="form-horizontal" role="form">
										<div class="form-group">
											<select id="basic2" name="citySelectBox" class="show-tick form-control" multiple onchange="changeCity(this.value)">
																								 <option selected style="display:none;color:#eee;" value="">Select City</option>

												 <?php for($i=0; $i<count($stateArray); $i++){ ?>
												<optgroup label="<?php echo $stateArray[$i]['state'];   ?>">
													 <?php 
													 $stateId= $stateArray[$i]['stateId'];
									if(isset($citylist[$stateId])){
                                       $cityInnerList=      $citylist[$stateId];
                                     
                                  $citycounterval= count($cityInnerList['cityName']);
									

													 for($j=0; $j<$citycounterval; $j++){ ?>	
													<option value="<?php echo $cityInnerList['cityId'][$j] ?>"><?php echo $cityInnerList['cityName'][$j] ?></option>
													
													<?php } } ?>
												</optgroup>
												<?php } ?>

											
											</select>
										</div>
									  </form>    
								</div>
							</div>
						</div>
					</div>
				<script>
				$('#myModal').modal('');
				</script>
			</div>
		</div>
		</div>

	

<!------ssss--- -->
<!---->
<!--<div class="main-banner banner text-center">-->
<!--    <div class="container">-->
<!--        <h1>Sell or Advertise   <span class="segment-heading">    anything online </span> with Resale</h1>-->
<!--        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>-->
<!--        <a href="--><?php //echo base_url().'posting'; ?><!--">Post Free Ad</a>-->
<!--    </div>-->
<!--</div>-->


<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/easy-responsive-tabs.css " />
    <script src="<?php echo base_url(); ?>assets/js/easyResponsiveTabs.js"></script>

<!-- Categories -->
	<!--Vertical Tab-->
	<div class="categories-section main-grid-border">
		<div class="container">
			<h2 class="head">Main Categories</h2>
			<div class="category-list">
				<div id="parentVerticalTab">
					<span class="active total" style="display:block;" data-toggle="modal" data-target="#myModal" id="selectedcity">(Select your city to see local ads)</span>

					<ul class="resp-tabs-list hor_1">

            <?php

          // print_r($citylist);
                for($i=0; $i<count($categoryArray); $i++){ ?>

              <li><?php echo $categoryArray[$i]['category']; ?> </li>
                <?php } ?>

						<a href="<?php echo base_url(); ?>adsList">All Ads</a>
					</ul>

					<div class="resp-tabs-container hor_1" id="responsdiv" >


						<?php	for($i=0; $i<count($categoryArray); $i++){ ?>
							<div >
							<div class="category">
								<div class="category-img">
									<!-- <img src="images/cat1.png" title="image" alt="" />-->
								 <div class="focus-image"><i class="<?php echo $categoryArray[$i]['icons']; ?>"></i></div>
								</div>


								<div class="category-info">
									<h4><?php echo $categoryArray[$i]['category']; ?> </h4>
									<span> <?php $catId=$categoryArray[$i]['categoryId'];
										if(array_key_exists($catId, $categoryAdsCount)) {
											if ($categoryAdsCount[$catId] > 0) {
												echo $categoryAdsCount[$catId];
											} else {
												echo "0";
											}
										}
										else{
											echo "0";
										}

										$urlparamStr=$catId;
										$urlparam=$users_model->encryptor('encrypt',$urlparamStr);

										?>  Ads</span>
									<a href="<?php echo base_url(); ?>adsList?param=<?php echo $urlparam; ?>">View all Ads</a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="sub-categories">
								<ul>
									<?php
									 // print_r($subCategorylist);
									$catId= $categoryArray[$i]['categoryId'];
									if(isset($subCategorylist[$catId])){
                                       $subcatInnerList=      $subCategorylist[$catId];
                                     
                                  $counterval= count($subcatInnerList['subCategory']);
										for($j=0; $j<$counterval; $j++){

										    $subcat=$subcatInnerList['subCategoryId'][$j];
											 $urlparamStr=$catId.":::".$subcat;
											 $urlparam=$users_model->encryptor('encrypt',$urlparamStr);

											?>
									<li><a href="<?php echo base_url(); ?>adsList?param=<?php echo $urlparam; ?>" > <?php echo $subcatInnerList['subCategory'][$j]; ?> </a></li>
									
									<?php  } } ?>
									<div class="clearfix"></div>
								</ul>
							</div>
						</div>

 <?php } ?>


					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>

		<script src="http://maps.google.com/maps/api/js?key=AIzaSyDSpcghpRmu39ThwNSAP3cyEPMMnQBotQ0"></script>
		<script>

			if (navigator.geolocation){
				navigator.geolocation.getCurrentPosition(showPosition);
			}
			function showPosition(position){

				var latitude=position.coords.latitude;
				var longitude=position.coords.longitude;

				var geocoder = new google.maps.Geocoder();
				var latLng = new google.maps.LatLng(latitude, longitude);

				if (geocoder) {
					geocoder.geocode({ 'latLng': latLng}, function (results, status) {
//                alert(JSON.stringify(results[0]));
						if (status == google.maps.GeocoderStatus.OK) {
							var city = results[3].address_components[0].long_name;
							var state = results[3].address_components[1].long_name;
							var country = "";
							var registered_country_iso_code = "";

							for (var ac = 0; ac < results[0].address_components.length; ac++) {
								var component = results[0].address_components[ac];

								switch(component.types[0]) {
									case 'locality':
										city = component.long_name;
										break;
									case 'administrative_area_level_1':
										state = component.long_name;
										break;
									case 'country':
										country = component.long_name;
										registered_country_iso_code = component.short_name;
										break;
								}
							};

							if(state!=null && city!=null){
								var cityId = "";
								var stateId = "";
								//$("#manualLocationDiv").html('<div class="row"><div class="col-sm-6"> <div class="col-sm-6 col-xs-6 textlabel">State</div><div class="col-sm-6  col-xs-6 textlabel text-warning ">'+state+'<input type="hidden" name="stateId" id="stateId" value="'+stateId+'"></div></div><div class="col-sm-6"> <div class="col-sm-6  col-xs-6 textlabel">City</div><div class="col-sm-6  text-danger col-xs-6 textlabel">'+city+'<input type="hidden" name="cityId" id="cityId" value="'+cityId+'"></div></div><div class="col-sm-12 text-right"><input type="button" onclick="chooseManualLocation()" value="Change Location Manually" class="btn text-warning"/></div></div>');
								getStateAndCityId(state, city);
							}
						}
						else {
							alert("Geocoding failed: " + status);
						}
					}); //geocoder.geocode()
				}
			}

			function getStateAndCityId(state, city){
				var postData = "state="+state+"&city="+city;
				var postUrl = "getStateAndCityId";
				$.ajax({
					url : postUrl,
					type : "GET",
					data : postData,
					success: function (data) {
						var jsonData = JSON.parse(data);
						if(jsonData!=null){
							var stateId = jsonData['stateId'];
							var districtId = jsonData['districtId'];
							$("#basic2").val(districtId);
							//alert(districtId);

							changeCity(districtId)
							//$("#cityId").val(districtId);
							//$("#stateId").val(stateId);
						}
					}
				});
			}
</script>

			<script type="text/javascript">
    $(document).ready(function() {
		//loadfun();

	var value=	localStorage.getItem("selectedCity");
		if(value==null)
		{
			value="";
		}
		$("#basic2").val(value);
		//alert(value);
		changeCity(value)

    });

			function changeCity(value)
			{
				var selectedcityText=$("#basic2 option:selected").text();
				$("#selectedcity").html(selectedcityText);
				localStorage.setItem("selectedCity",value);
				var postData={ selectedcity: value };
				$.get("categoryAjax",postData,function(data){
					$("#responsdiv").html(data);


					loadfun();
				});


			}
			function loadfun()
			{
				//Vertical Tab
				$('#parentVerticalTab').easyResponsiveTabs({
					type: 'vertical', //Types: default, vertical, accordion
					width: 'auto', //auto or any width like 600px
					fit: true, // 100% fit in a container
					closed: 'accordion', // Start closed if in accordion view
					tabidentify: 'hor_1', // The tab groups identifier
					activate: function(event) { // Callback function if tab is switched
						var $tab = $(this);
						var $info = $('#nested-tabInfo2');
						var $name = $('span', $info);
						$name.text($tab.text());
						$info.show();
					}
				});
			}
</script>