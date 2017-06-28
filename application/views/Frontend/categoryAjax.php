
<!-- Categories -->
	<!--Vertical Tab-->



						<?php	for($i=0; $i<count($categoryArray); $i++){ ?>
							<div>
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
										$urlparam=$users_model->encryptor('encrypt',$urlparamStr)
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





		<script type="text/javascript">


</script>