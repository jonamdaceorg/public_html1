<?php

//print_r($searchData);
?>


<?php if(count($searchData)>0) { ?>
<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
    <ul id="myTab" class="nav nav-tabs nav-tabs-responsive" role="tablist">
        <li role="presentation" <?php if($withphoto=="yes"){ ?>class="active" <?php } ?> >
            <a href="#home" id="home-tab" role="tab" data-toggle="tab" onclick="photofun('yes')" aria-controls="home" aria-expanded="true">
                <span class="text"> Ads with Photos </span>
            </a>
        </li>
        <li role="presentation" class="next <?php if($withphoto==""){ echo 'active'; } ?>">
            <a href="#profile" role="tab" id="profile-tab"  onclick="photofun('')" data-toggle="tab" aria-controls="profile">
                <span class="text">All Ads</span>
            </a>
        </li>
<input type="hidden" name="withphoto" id="withphoto" value="<?php if($withphoto!=""){echo $withphoto;}  ?>" >
    </ul>
    <div  class="tab-content">

<div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
    <div>
        <div id="container">
            <div class="view-controls-list" id="viewcontrols">
                <label>view :</label>
                <a class="gridview"><i class="glyphicon glyphicon-th"></i></a>
                <a class="listview active"><i class="glyphicon glyphicon-th-list"></i></a>
            </div>
            <div class="sort">
                <div class="sort-by">
                    <label>Sort By : </label>
                    <select name="orderBy" id="orderBy">
                        <option value="MR" <?php if($orderBy=="MR"){ echo "selected"; } ?> >Most recent</option>
                        <option value="LTH" <?php if($orderBy=="LTH"){ echo "selected"; } ?>  >Price: Rs Low to High</option>
                        <option value="HTL" <?php if($orderBy=="HTL"){ echo "selected"; } ?> >Price: Rs High to Low</option>
                    </select>
                </div>
            </div>
            <div class="clearfix"></div>
            <ul class="list">
                <?php
                for ($i = 0; $i < count($searchData); $i++) { ?>
                <li>
                    <?php
                    $filename="";
                    if($searchData[$i]['file_name']!="") {
                        $chekfilename = base_url() . "uploads/files/userads/".$searchData[$i]['userCode']."/" . $searchData[$i]['adsCode']."/".$searchData[$i]['file_name'];
                        $filename = $chekfilename;
                    }
                    else{
                        $filename = base_url() . "assets/images/noimage.jpg";
                    }

                    ?>
                    <img src="<?php echo $filename; ?>" title="" alt="Loading..."/>
                    <section class="list-left">
                        <h5 class="title"><?php echo $searchData[$i]['adsTitle']; ?></h5>
                        <?php if($isAmountRequired=="Required" ){ ?>
                      <span class="adprice">
                            <?php if($searchData[$i]['offerPrice'] >0 && $searchData[$i]['offerPrice'] != $searchData[$i]['actualPrice'] ){ ?>
                              <del>  &#x20B9; <?php echo $searchData[$i]['actualPrice']; ?> ;</del>
                                &#x20B9; <?php echo $searchData[$i]['offerPrice']; ?> </span>
                          <?php } else {?>
                           &#x20B9; <?php echo $searchData[$i]['actualPrice']; ?>
                          <?php  } ?>

                        <?php  } ?>
                        <p><?php $description= $searchData[$i]['description'];
                            if(strlen($description)>150){ $description=substr($description,0,150)."..."; }
                            echo $description;
                            ?></p>
                        <?php if($getListFromPage == "View All My Ads") { ?>
                            <p>Start date : <?php echo $searchData[$i]['startDate']; ?></p>
                            <p>End date : <?php echo $searchData[$i]['endDate']; ?></p>
                            <p>Create At : <?php echo $searchData[$i]['endDate']; ?></p>
                            <?php if($searchData[$i]['active']=='active'){  ?>
                            <p id="adsStatusDivId<?php echo $searchData[$i]['adsId']; ?>" ><a href="javascript:void(0)" onclick="updateactivefun('<?php echo $searchData[$i]['adsId']; ?>','deactive')" class="btn btn-info">Deactive</a> </p>
                                <?php } else if($searchData[$i]['active']=='deactive'){  ?>
                                <p id="adsStatusDivId<?php echo $searchData[$i]['adsId']; ?>" ><a href="javascript:void(0)" onclick="updateactivefun('<?php echo $searchData[$i]['adsId']; ?>','active')" class="btn btn-info">Active</a> </p>
                            <?php } ?>

                        <?php } ?>
                        <p class="catpath"><?php echo $searchData[$i]['category']; ?> » <?php echo $searchData[$i]['subCategory']; ?></p>
                        <p><a href="<?php echo base_url(); ?>singleItem/<?php echo $searchData[$i]['adsId']; ?>">View More Details <span class="glyphicon glyphicon-arrow-right"></span></a></p>
                    </section>
                    <section class="list-right">
                        <?php if($getListFromPage == "View My Bookmarked List"  || $getListFromPage == "View All My Ads") { ?>
                            <span class="date"><a href="<?php echo base_url(); ?>editMyAds/<?php echo $this->users_model->encryptor('encrypt', $searchData[$i]['adsId']); ?>">Edit</a></span>
                            <span class="<?php if($searchData[$i]['active']=='active'){ echo 'text-success'; }else { echo 'text-warning'; }  ?>">
                            <?php echo $searchData[$i]['active']; ?></span>
                            <?php if($getListFromPage != "View All My Ads") { ?>
                                <p id="bookmarkDivId<?php echo $searchData[$i]['adsId']; ?>" ><a href="javascript:void(0)" onclick="addToBookMark('<?php echo $searchData[$i]['adsId']; ?>', 'remove')" class="updateMsg"><span class="glyphicon glyphicon-star"></span> Remove from Bookmark</a></p>
                            <?php } ?>
                            <span class="date"><?php echo $searchData[$i]['createdAt']; ?></span>
                        <?php } else {  ?>
                            <?php if(!in_array($searchData[$i]['adsId'], $bookmarkArray)){ ?>
                            <p id="bookmarkDivId<?php echo $searchData[$i]['adsId']; ?>"><a href="javascript:void(0)" onclick="addToBookMark('<?php echo $searchData[$i]['adsId']; ?>','add')"><span class="glyphicon glyphicon-star"></span> Add to Bookmark</a></p>
                                <?php } else { ?>
                                <p id="bookmarkDivId<?php echo $searchData[$i]['adsId']; ?>" ><a href="javascript:void(0)" onclick="addToBookMark('<?php echo $searchData[$i]['adsId']; ?>', 'remove')" class="updateMsg"><span class="glyphicon glyphicon-star"></span> Remove from Bookmark</a></p>
                            <?php } ?>
                        <?php } ?>
                        <span class="cityname"><?php echo $searchData[$i]['city']; ?></span>
                    </section>
                    <div class="clearfix"></div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<!--<div role="tabpanel" class="tab-pane fade" fid="profile" aria-labelledby="profile-tab">
    <div>
        <div id="container">
            <div class="view-controls-list" id="viewcontrols">
                <label>view :</label>
                <a class="gridview"><i class="glyphicon glyphicon-th"></i></a>
                <a class="listview active"><i class="glyphicon glyphicon-th-list"></i></a>
            </div>
            <div class="sort">
                <div class="sort-by">
                    <label>Sort By : </label>
                    <select>
                        <option value="">Most recent</option>
                        <option value="">Price: Rs Low to High</option>
                        <option value="">Price: Rs High to Low</option>
                    </select>
                </div>
            </div>
            <div class="clearfix"></div>
            <ul class="list">
                <?php for ($i = 0; $i < count($searchData); $i++) { ?>
                    <a href="<?php echo base_url(); ?>singleItem/<?php echo $searchData[$i]['adsId']; ?>">
                        <li>
                            <img src="images/m1.jpg" title="" alt=""/>
                            <section class="list-left">
                                <h5 class="title"><?php echo $searchData[$i]['adsTitle']; ?></h5>
                                <span class="adprice">Rs.<?php //echo $searchData[$i]['offerPrice'];   ?></span>

                                <p class="catpath">Mobile Phones » Brand</p>
                            </section>
                            <section class="list-right">
                                <span class="date"> <?php echo $searchData[$i]['createdAt']; ?> </span>
                                <span class="cityname"> <?php echo $searchData[$i]['city']; ?></span>
                            </section>
                            <div class="clearfix"></div>
                        </li>
                    </a>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>-->
<!--<div role="tabpanel" class="tab-pane fade" id="samsa" aria-labelledby="samsa-tab">-->
<!--    <div>-->
<!--        <div id="container">-->
<!--            <div class="view-controls-list" id="viewcontrols">-->
<!--                <label>view :</label>-->
<!--                <a class="gridview"><i class="glyphicon glyphicon-th"></i></a>-->
<!--                <a class="listview active"><i class="glyphicon glyphicon-th-list"></i></a>-->




<!--            </div>-->
<!--            <div class="sort">-->
<!--                <div class="sort-by">-->
<!--                    <label>Sort By : </label>-->
<!--                    <select>-->
<!--                        <option value="">Most recent</option>-->
<!--                        <option value="">Price: Rs Low to High</option>-->
<!--                        <option value="">Price: Rs High to Low</option>-->
<!--                    </select>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="clearfix"></div>-->
<!--            <ul class="list">-->
<!---->
<!--                <li>-->
<!--                    <img src="images/m1.jpg" title="" alt=""/>-->
<!--                    <section class="list-left">-->
<!--                        <h5 class="title">There are many variations of passages of Lorem Ipsum</h5>-->
<!--                        <span class="adprice">$290</span>-->
<!---->
<!--                        <p class="catpath">Mobile Phones » Brand</p>-->
<!--                    </section>-->
<!--                    <section class="list-right">-->
<!--                        <span class="date">Today, 17:55</span>-->
<!--                        <span class="cityname">City name</span>-->
<!--                    </section>-->
<!--                    <div class="clearfix"></div>-->
<!--                </li>-->
<!---->
<!---->
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

    </div>
</div>
<!--<ul class="pagination pagination-sm">-->
<!--    <li><a href="#">Prev</a></li>-->
<!--    <li><a href="#">1</a></li>-->
<!--    <li><a href="#">2</a></li>-->
<!--    <li><a href="#">3</a></li>-->
<!--    <li><a href="#">4</a></li>-->
<!--    <li><a href="#">5</a></li>-->
<!--    <li><a href="#">6</a></li>-->
<!--    <li><a href="#">7</a></li>-->
<!--    <li><a href="#">8</a></li>-->
<!--    <li><a href="#">Next</a></li>-->
<!--</ul>-->
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12 text-right">
                <?php
                $previousPage = $page-1;
                $nextPage = $page+1;
                if($previousPage>=0){
//                echo '<a href="javascript:void(0)" onclick="loadsearchData('.$previousPage.')">Previous '.$rec_limit.'</a>';
                    echo '&nbsp;<a href="javascript:void(0)" onclick="loadsearchData('.$previousPage.')" class="btn btn-danger btn-sm"><span class="fa fa-arrow-left text-white fa-1x"></span>&nbsp;Previous '.$rec_limit.'</a>';

                }
                if($left_rec>0)
                    echo '&nbsp;<a href="javascript:void(0)" onclick="loadsearchData('.$nextPage.')" class="btn btn-success btn-sm">Next '.$rec_limit.' <span class="fa fa-arrow-right text-white fa-1x"></span></a>';
                ?>
            </div>
        </div>
    </div>

<script type="text/javascript">
    function photofun(val)
    {
        $("#withphoto").val(val);
        loadsearchData();

    }
    $(document).ready(function () {
        var elem = $('#container ul');
        $('#viewcontrols a').on('click', function (e) {
            if ($(this).hasClass('gridview')) {
                elem.fadeOut(1000, function () {
                    $('#container ul').removeClass('list').addClass('grid');
                    $('#viewcontrols').removeClass('view-controls-list').addClass('view-controls-grid');
                    $('#viewcontrols .gridview').addClass('active');
                    $('#viewcontrols .listview').removeClass('active');
                    elem.fadeIn(1000);
                });
            }
            else if ($(this).hasClass('listview')) {
                elem.fadeOut(1000, function () {
                    $('#container ul').removeClass('grid').addClass('list');
                    $('#viewcontrols').removeClass('view-controls-grid').addClass('view-controls-list');
                    $('#viewcontrols .gridview').removeClass('active');
                    $('#viewcontrols .listview').addClass('active');
                    elem.fadeIn(1000);
                });
            }
        });
    });

    function addToBookMark(adsId, action){
        $.ajax({
            url : "addToMyBookmark",
            data : "adsId="+adsId+"&action="+action,
            method: "GET",
            success : function(response){
                $("#bookmarkDivId"+adsId).html(response);
            }
        });
    }
   function updateactivefun(adsId,action)
   {
       var cnfm = confirm("Are you sure to " +action +"?");
        if(cnfm) {
            $.ajax({
                url: "updateAdsStatus",
                data: "adsId=" + adsId + "&actionStatus=" + action,
                method: "GET",
                success: function (response) {
                    $("#adsStatusDivId" + adsId).html(response);
                }
            });
        }
   }
</script>
<?php  } else{ ?>

<center><h3>No results found</h3></center>
<?php  } ?>
