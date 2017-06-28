<!--<div class="banner text-center">-->
<!--	  <div class="container">    -->
<!--			<h1>Sell or Advertise   <span class="segment-heading">    anything online </span> with Resale</h1>-->
<!--			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>-->
<!--			<a href="--><?php //echo base_url().'posting'; ?><!--" >Post Free Ad</a>-->
<!--	  </div>-->
<!--	</div>-->

<?php
//print_r($adsDetails); $adsCode = "ADS".sprintf('%04u', $adsId);
	$userid = 0;
	$adsId = 0;
	$adsCode = 0;
	$userCode = 0;
 $itemType="";

	if(count($adsDetails)>0){
		$adsId = $adsDetails[0]['adsId'];
		$userid = $adsDetails[0]['userid'];
		$adsCode = $adsDetails[0]['adsCode'];
		$userCode = $adsDetails[0]['userCode'];
		$itemType = $adsDetails[0]['subCategory'];
	}
//print_r($adsDetails);
?>
	<!--single-page-->
	<div class="single-page main-grid-border">
		<div class="container">
			<ol class="breadcrumb" style="margin-bottom: 5px;">
				<li><a href="<?php echo base_url(); ?>">Home</a></li>
				<li><a href="javascript:void(0)" onclick="loadCityBasedSearch('<?php echo  $adsDetails[0]['cityId'] ?>')"><?php echo  $adsDetails[0]['city'] ?></a></li>
				<li class="active"><a href="<?php echo base_url(); ?>categories?categoryId=<?php echo  $adsDetails[0]['categoryId'] ?>#parentVerticalTab<?php echo  $adsDetails[0]['orders'] ?>"><?php echo  $adsDetails[0]['category'] ?></a></li>
				<li class="active"><?php echo  $adsDetails[0]['subCategory'] ?></li>
			</ol>

			<div class="product-desc">
				<?php if(count($adsDetails)>0){ ?>
				<div class="col-md-7 product-view">
					<h2><?php echo $adsDetails[0]['adsTitle']; ?></h2>
					<p> <i class="glyphicon glyphicon-map-marker"></i><a href="#"><?php echo $adsDetails[0]['state']; ?></a>, <a href="#"><?php echo $adsDetails[0]['city']; ?></a>| Added at <?php echo $adsDetails[0]['createdAt']; ?></p>
					<div class="flexslider">
						<ul class="slides">
							<?php if(count($adsgalleryDetails)>0) {
								for ($i = 0; $i < count($adsgalleryDetails); $i++) { ?>
									<li data-thumb="<?php echo base_url() . 'uploads/files/userads/'.$userCode.'/'.$adsCode.'/' . $adsgalleryDetails[$i]['file_name']; ?>">
										<img src="<?php echo base_url() . 'uploads/files/userads/'.$userCode.'/' .$adsCode.'/'. $adsgalleryDetails[$i]['file_name']; ?>"/>
									</li>
								<?php }
							} else {
							?>

								<li data-thumb="<?php echo base_url(); ?>assets/images/noimage.jpg">
									<img src="<?php echo base_url(); ?>assets/images/noimage.jpg"/>
								</li>

							<?php } ?>

						</ul>
					</div>
					<!-- FlexSlider -->
					  <script defer src="<?php echo base_url(); ?>assets/js/jquery.flexslider.js"></script>
					<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/flexslider.css" type="text/css" media="screen" />

						<script>
					// Can also be used with $(document).ready()
					$(window).load(function() {
					  $('.flexslider').flexslider({
						animation: "slide",
						controlNav: "thumbnails"
					  });
					});
					</script>
					<!-- //FlexSlider -->
					<div class="product-details">
						<?php if($isAmountRequired=="Required" ){ ?>
							<h4>Price : <strong>
									<?php if($adsDetails[0]['offerPrice'] >0){ ?>
                              <del>  &#x20B9; <?php echo $adsDetails[0]['actualPrice']; ?> ;</del>
                                &#x20B9; <?php echo $adsDetails[0]['offerPrice']; ?> </span>
                          <?php } else {?>
                           &#x20B9; <?php echo $adsDetails[0]['actualPrice']; ?>
                          <?php  } ?>
									</strong></h4>

						<?php  } ?>
						<?php  for ($i = 0; $i <count($dynamicAdsDetails); $i++) { ?>
							<h4><?php echo $dynamicAdsDetails[$i]['capturedvariablename']; ?> : <strong><?php echo $dynamicAdsDetails[$i]['capturedVariableValue']; ?></strong></h4>

 <?php  } ?>
						<div><strong>Product Details</strong> :<p> <?php
                                         $description=$adsDetails[0]['description'];
								$description=str_replace("\r", "<br/>",$description);
							 echo	$description=str_replace("\n", "<br/>",$description);
								 ?></p></div>
					
					</div>
				</div>
				<?php  } ?>
				<div class="col-md-5 product-details-grid">



					<div class="item-price">

					<div class="product-price">
						<p class="p-price">AD Id</p>
						<h3 class="rate"><?php echo $adsDetails[0]['adsCode']; ?></h3>
						<div class="clearfix"></div>
					</div>
					<div class="condition">
						<p class="p-price">Views</p>
						<h4><?php echo $adsViewcount; ?></h4>
						<div class="clearfix"></div>
					</div>
					<div class="itemtype">
						<p class="p-price">Item Type</p>
						<h4><?php echo $itemType; ?></h4>
						<div class="clearfix"></div>
					</div>




					</div>
					<?php if(count($adsDetails)>0){ ?>
					<div class="interested text-left">
						<h4>Interested in this Ad?<small> Contact the Seller!</small></h4>
						<p><i class="glyphicon glyphicon-user"></i><?php echo $adsDetails[0]['name']; ?></p>

						<p><i class="glyphicon glyphicon-earphone"></i><?php echo $adsDetails[0]['mobile']; ?></p>
              <?php   if( $encryptsearchuserId!=""){
				  ?>
				  <p>	<a href="javascript:void(0)" onclick="gotoUSerads('<?php echo $encryptsearchuserId; ?>')" >other ads from this user</a></p>
						<?php
			  } ?>

					</div>
					<?php } ?>
					<div class="interested ">
						<?php $loadAddOrEditModalUrl = base_url()."Frontend/updateReportAboutAds"; ?>
						<p>	<i class="glyphicon glyphicon-flag"></i> <a onclick="getAddOrEditModalContent('adsId=<?php echo $adsId ?>', '<?php echo $loadAddOrEditModalUrl; ?>')">  Report</a></p>
					</div>
<!--						<div class="tips">-->
<!--						<h4>Safety Tips for Buyers</h4>-->
<!--							<ol>-->
<!--								<li><a href="#">Contrary to popular belief.</a></li>-->
<!--								<li><a href="#">Contrary to popular belief.</a></li>-->
<!--								<li><a href="#">Contrary to popular belief.</a></li>-->
<!--								<li><a href="#">Contrary to popular belief.</a></li>-->
<!--								<li><a href="#">Contrary to popular belief.</a></li>-->
<!--								<li><a href="#">Contrary to popular belief.</a></li>-->
<!--								<li><a href="#">Contrary to popular belief.</a></li>-->
<!--								<li><a href="#">Contrary to popular belief.</a></li>-->
<!--								<li><a href="#">Contrary to popular belief.</a></li>-->
<!--							</ol>-->
<!--						</div>-->
				</div>
			<div class="clearfix"></div>
			</div>

		</div>
	</div>

<div class="trending-ads">
	<div class="container">
		<!-- slider -->
		<div class="trend-ads">
			<h2>Similar Ads</h2>
			<ul id="flexiselDemo3">
				<li>
				<?php
				for ($i = 0; $i < count($similaradsArray); $i++) { ?>



					<?php
					$filename="";
					if($similaradsArray[$i]['file_name']!="") {
						$chekfilename = base_url() . "uploads/files/userads/".$similaradsArray[$i]['userCode']."/" . $similaradsArray[$i]['adsCode']."/".$similaradsArray[$i]['file_name'];
						$filename = $chekfilename;
					}
					else{
						$filename = base_url() . "assets/images/noimage.jpg";
					}

					?>
					<div class="col-md-3 biseller-column">
						<a href="<?php echo base_url(); ?>singleItem/<?php echo $similaradsArray[$i]['adsId']; ?>">
							<img src="<?php echo $filename; ?>"/>
							<?php if($isAmountRequired=="Required" ){ ?>	<span class="price">

								<?php if($similaradsArray[$i]['offerPrice'] >0){ ?>
                              <del>  &#x20B9; <?php echo $similaradsArray[$i]['actualPrice']; ?> ;</del>
                                &#x20B9; <?php echo $similaradsArray[$i]['offerPrice']; ?> </span>
                          <?php } else {?>
                           &#x20B9; <?php echo $similaradsArray[$i]['actualPrice']; ?>
                          <?php  } ?>

								  </span>
							<?php  } ?>
						</a>
						<div class="ad-info">
							<h5><?php echo $similaradsArray[$i]['adsTitle']; ?></h5>
							<span> <?php echo $similaradsArray[$i]['startDate']; ?></span>
						</div>
					</div>
					<?php if($i%4==0 && $i!=0 && $i!=count($similaradsArray)){?>  </li> <li><?php } ?>

				<?php  } ?>

				</li>

			</ul>
			<script type="text/javascript">
				$(window).load(function() {
					$("#flexiselDemo3").flexisel({
						visibleItems:1,
						animationSpeed: 1000,
						autoPlay: true,
						autoPlaySpeed: 5000,
						pauseOnHover: true,
						enableResponsiveBreakpoints: true,
						responsiveBreakpoints: {
							portrait: {
								changePoint:480,
								visibleItems:1
							},
							landscape: {
								changePoint:640,
								visibleItems:1
							},
							tablet: {
								changePoint:768,
								visibleItems:1
							}
						}
					});

				});
			</script>
			<script type="text/javascript" src="<?php echo base_url(); ?>assets/web/js/jquery.flexisel.js"></script>
		</div>
	</div>
	<!-- //slider -->
</div>



<div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	 aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content p-0 b-0" >
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Report</h4>
			</div>
			<div class="modal-body" id="modalContentArea">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript" src=" <?php echo base_url(); ?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>

	<!--//single-page-->
<script>
	function loadCityBasedSearch(city)
	{
		localStorage.setItem("selectedCity",city);
		window.location.href=" <?php echo base_url(); ?>adsList"
	}
function gotoUSerads(userparam){
	localStorage.setItem("selectedCity","");
			window.location.href=" <?php echo base_url(); ?>adsList?userparam="+userparam;
	}
</script>