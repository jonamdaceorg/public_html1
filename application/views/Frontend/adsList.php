<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/web/css/jquery-ui1.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/categorydropdown.css">


<!--new
<div class="btn-group btn-input clearfix">
    <button type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown">
        <span data-bind="label">Select One</span> <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li><a href="#">Item 1</a></li>
        <li><a href="#">Another item</a></li>
        <li><a href="#">This is a longer item that will not fit properly</a></li>

    </ul>
</div>

<script>
    $( document.body ).on( 'click', '.dropdown-menu li', function( event ) {

        var $target = $( event.currentTarget );

        $target.closest( '.btn-group' )
            .find( '[data-bind="label"]' ).text( $target.text() )
            .end()
            .children( '.dropdown-toggle' ).dropdown( 'toggle' );

        return false;

    });

</script>

<!--new-->

<!-- Products -->
<div class="total-ads main-grid-border">
    <div class="container">
        <form name="adsSearchForm" id="adsSearchForm" method="post">
            <input type="hidden" name="getListFromPage" id="getListFromPage" value="<?php echo $title; ?>"/>

            <div class="select-box">
                <div class="select-city-for-local-ads ads-list">
                    <label>Select your city to see local ads</label>
                    <select name="city" id="city" onchange="oncitychange(this.value);pathchangefun()">
                        <option value="">All India</option>

                        <?php for ($i = 0; $i < count($stateArray); $i++) { ?>
                            <optgroup label="<?php echo $stateArray[$i]['state']; ?>">
                                <?php
                                $stateId = $stateArray[$i]['stateId'];
                                if (isset($citylist[$stateId])) {
                                    $cityInnerList = $citylist[$stateId];

                                    $citycounterval = count($cityInnerList['cityName']);


                                    for ($j = 0; $j < $citycounterval; $j++) { ?>
                                        <option
                                            value="<?php echo $cityInnerList['cityId'][$j] ?>"><?php echo $cityInnerList['cityName'][$j] ?></option>

                                    <?php }
                                } ?>
                            </optgroup>
                        <?php } ?>

                    </select>
                </div>
                <div class="browse-category ads-list">
                    <label>Browse Categories</label>

                    <div class="dropdown selectpicker show-tick">
                        <a role="button" data-toggle="dropdown" class="btn btn-default catlabel" data-target="#">
                            <span id="dLabel"> select Category</span> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu" id="demolist">
                            <?php for ($i = 0;
                            $i < count($categoryArray);
                            $i++){
                            $catId = $categoryArray[$i]['categoryId'];
                            ?>
                            <li <?php if (isset($subCategorylist[$catId])) { ?> class="dropdown-submenu" <?php } ?> ><a
                                    catVal="<?php echo $catId; ?>"><?php echo $categoryArray[$i]['category']; ?></a>
                                <?php

                                if (isset($subCategorylist[$catId])) {

                                    ?>
                                    <ul class="dropdown-menu">
                                        <?php
                                        $subcatInnerList = $subCategorylist[$catId];
                                        $counterval = count($subcatInnerList['subCategory']);
                                        for ($j = 0; $j < $counterval; $j++) {
                                            $subcat = $subcatInnerList['subCategoryId'][$j];
                                            $catval = $catId . "-" . $subcat;
                                            ?>
                                            <li>
                                                <a catVal="<?php echo $catval; ?>"> <?php echo $subcatInnerList['subCategory'][$j]; ?></a>
                                            </li>
                                            <?php

                                        }
                                        ?>

                                    </ul>

                                <?php }
                                } ?>
                            </li>


                        </ul>
                    </div>
                    <input type="hidden" name="categoryId" id="categoryId"/>
                    <input type="hidden" name="SubcategoryId" id="SubcategoryId"/>

                </div>
                <div class="search-product ads-list">
                    <label>Search for a specific product</label>

                    <div class="search">
                        <div id="custom-search-input">
                            <div class="input-group">
                                <?php
                                $searchText = $this->input->get_post('searchText');
                                $headerSearch = $this->input->get_post('headerSearch');
                                if ($searchText != "") {
                                    $searchText = $searchText;
                                } else {
                                    $searchText = $headerSearch;
                                }
                                ?>
                                <input type="text" name="searchText" id="searchText" class="form-control input-lg"
                                       placeholder="e.g. lenovo,hero, samsung galaxy, tv..." onchange="pathchangefun()"
                                       value="<?php echo $searchText; ?>"/>
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-lg" type="button" onclick="pathchangefun();">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <!--  <div class="all-categories">
                  <h3> Select your category and find the perfect ad</h3>
                  <ul class="all-cat-list">
                      <li><a href="mobiles.html">Mobiles <span class="num-of-ads">(5,78,076)</span></a></li>
                      <li><a href="electronics-appliances.html">Electronics & Appliances  <span class="num-of-ads">(3,66,495)</span></a></li>
                      <li><a href="real-estate.html">Real Estate  <span class="num-of-ads">(45,450)</span></a></li>
                      <li><a href="furnitures.html">Furniture    <span class="num-of-ads">(1,77,145)</span></a></li>
                      <li><a href="pets.html">Pets   <span class="num-of-ads">(1,81,250)</span></a></li>
                      <li><a href="books-sports-hobbies.html">Books, Sports & Hobbies    <span class="num-of-ads">(66,822)</span></a></li>
                      <li><a href="fashion.html">Fashion   <span class="num-of-ads">(29,156)</span></a></li>
                      <li><a href="kids.html">Kids   <span class="num-of-ads">(25,699)</span></a></li>
                      <li><a href="services.html">Services   <span class="num-of-ads">(2,15,895)</span></a></li>
                      <li><a href="cars.html">Cars   <span class="num-of-ads">(2,15,306)</span></a></li>
                  </ul>
              </div>-->


            <script>
                $('#demolist li').on('click', function (e) {
                    e.stopPropagation();
                    // alert($(e.target).attr("catVal"));
                    var myString = $(e.target).attr("catVal");
                    oncategoryChange(myString);

                });

                function oncategoryChange(myString) {

                    var subCategoryId = "0";
                    var arr = myString.split('-');
                    $("#categoryId").val(arr[0]);
                    if (arr.length > 1) {
                        $("#SubcategoryId").val(arr[1]);
                        subCategoryId = arr[1];
                    }

                    var labelText = $("[catVal=" + myString + "]").text();
                    $('#dLabel').text(labelText);
                    pathchangefun();
                    getDynamicFieldsforAdsSearch('dynamicFieldsForCategoryDiv', arr[0], subCategoryId);
                    loadsearchData();

                }

            </script>
            <!--- new end ---->
            <ol class="breadcrumb" style="margin-bottom: 5px;" id="pathdir">
                <li><a href="index.html">Home</a></li>
                <li class="active">All Ads</li>
                <?php //if(count($searchData)!=null){?>
                <li class="active"><?php //echo category; ?></li> <?php //}?>


            </ol>
            <input type="hidden" name="searchUserId" value="<?php echo $userparam; ?>">

            <?php if ($userparam != "") {
                if (count($userArray) > 0) {
                    ?>
                    <div class="total-ads main-grid-border">
                        <div class="container ">
                            <div class="focus-border  row  bg-info ">
                                <div class="col-md-5 col-sm-5">
                                    <span class="col-md-2 col-sm-2"><i class="fa fa-user fa-3x"></i> </span> <span
                                        class="col-md-4 col-sm-4"> <h3
                                            class="sear-head"> <?php echo $userArray[0]['name']; ?></h3>    User all ads
                           </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>


            <div class="ads-grid">
                <div class="side-bar col-md-3">
                    <!-- <div class="search-hotel">
                     <h3 class="sear-head">Name contains</h3>
                         <input type="text" value="Product name..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Product name...';}" required="">
                         <input type="submit" value=" ">
                 </div>-->
                    <script type="text/javascript" src="<?php echo base_url(); ?>assets/web/js/jquery-ui.js"></script>

                    <div id="dynamicFieldsForCategoryDiv"></div>

<!--                    <div class="featured-ads">-->
<!--                        <h2 class="sear-head fer">Featured Ads</h2>-->
<!---->
<!--                        <div class="featured-ad">-->
<!--                            <a href="single.html">-->
<!--                                <div class="featured-ad-left">-->
<!--                                    <img src="--><?php //echo base_url(); ?><!--assets/web/images/f1.jpg" title="ad image"-->
<!--                                         alt=""/>-->
<!--                                </div>-->
<!--                                <div class="featured-ad-right">-->
<!--                                    <h4>Lorem Ipsum is simply dummy text of the printing industry</h4>-->
<!---->
<!--                                    <p>  &#x20B9; 450</p>-->
<!--                                </div>-->
<!--                                <div class="clearfix"></div>-->
<!--                            </a>-->
<!--                        </div>-->
<!--                        <div class="featured-ad">-->
<!--                            <a href="single.html">-->
<!--                                <div class="featured-ad-left">-->
<!--                                    <img src="--><?php //echo base_url(); ?><!--assets/web/images/f2.jpg" title="ad image"-->
<!--                                         alt=""/>-->
<!--                                </div>-->
<!--                                <div class="featured-ad-right">-->
<!--                                    <h4>Lorem Ipsum is simply dummy text of the printing industry</h4>-->
<!---->
<!--                                    <p>  &#x20B9; 380</p>-->
<!--                                </div>-->
<!--                                <div class="clearfix"></div>-->
<!--                            </a>-->
<!--                        </div>-->
<!--                        <div class="featured-ad">-->
<!--                            <a href="single.html">-->
<!--                                <div class="featured-ad-left">-->
<!--                                    <img src="--><?php //echo base_url(); ?><!--assets/web/images/f3.jpg" title="ad image"-->
<!--                                         alt=""/>-->
<!--                                </div>-->
<!--                                <div class="featured-ad-right">-->
<!--                                    <h4>Lorem Ipsum is simply dummy text of the printing industry</h4>-->
<!---->
<!--                                    <p>  &#x20B9; 560</p>-->
<!--                                </div>-->
<!--                                <div class="clearfix"></div>-->
<!--                            </a>-->
<!--                        </div>-->
<!--                        <div class="clearfix"></div>-->
<!--                    </div>-->
                </div>
                <div class="ads-display col-md-9">
                    <div class="wrapper" id="myTabContent">


                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </form>

    </div>
</div>
<!-- // Products -->

<script>
    <?php if($selectedCategoryId!="" && $selectedSubcategoryId!=""){?>
    var selectedcat = "<?php echo $selectedCategoryId ?>";
    var selectedSubcategoryId = "<?php echo $selectedSubcategoryId ?>";
    getDynamicFieldsforAdsSearch('dynamicFieldsForCategoryDiv', selectedcat, selectedSubcategoryId)

    <?php } ?>

    <?php if($categoryParam!=""){ ?>

    var categoryParamm = "<?php echo $categoryParam; ?>";
    //  alert(categoryParamm);
    oncategoryChange(categoryParamm);
    <?php } ?>

    var value = localStorage.getItem("selectedCity");
    if (value == null) {
        value = "";
    }
    $("#city").val(value);


    loadsearchData();
    pathchangefun();
    function loadsearchData() {

//alert(1);
//var postData={ categoryId: "1", SubcategoryId: "3" };
        var postData = $("#adsSearchForm").serialize()
//        alert(postData);
        $.ajax({
            url: "searchAdsAjax",
            data: postData,
            method: "GET",
            success: function (response) {
                $("#myTabContent").html(response);
            }
        });


    }
    $("#adsSearchForm").change(function () {
        loadsearchData();
    });
    function pathchangefun() {
        // var value=	localStorage.getItem("selectedCity");
        var homelink = "<?php echo base_url(); ?>";
        var selectedcityText = $("#city option:selected").text();
        var selectedCategoryText = $("#dLabel").text();
        var content = '<li><a href="' + homelink + '">Home</a></li>';
        content += '<li class="active">' + selectedcityText + '</li>';
        if (selectedCategoryText != "") {
            content += '<li class="active">' + selectedCategoryText + '</li>';
        }
        $("#pathdir").html(content)
    }
    function oncitychange(value) {
        localStorage.setItem("selectedCity", value);
    }


</script>
