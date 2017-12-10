<!-- content-starts-here -->
<div class="content">
    <div class="categories">
        <div class="container">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <div data-WRID="WRID-151214299972740119" data-widgetType="Push Content"  data-class="affiliateAdsByFlipkart" height="50" width="120"></div>
                        <script async src="http://affiliate.flipkart.com/affiliate/widgets/FKAffiliateWidgets.js"></script>
                        <script type="text/javascript" language="javascript">
                            var aax_size='728x90';
                            var aax_pubname = 'myosssite-21';
                            var aax_src='302';
                        </script>
                        <script type="text/javascript" language="javascript" src="https://c.amazon-adsystem.com/aax2/assoc.js"></script>
                        <a target="_blank"
                           href="https://www.amazon.in/b?_encoding=UTF8&tag=myosssite-21&linkCode=ur2&linkId=31c477316db9a07c98263e6734b6ee53&camp=3638&creative=24630&node=3561110031">Amz
                            1</a>
                        <img src="https://ir-in.amazon-adsystem.com/e/ir?t=myosssite-21&l=ur2&o=31" width="1" height="1" border="0" alt=""
                             style="border:none !important; margin:0px !important;"/>
                    </div>
                </div>
            </div>
            <?php
            for($i=0; $i<count($categoryArray); $i++){ ?>
                <div class="col-md-2 focus-grid">
                    <a href="<?php echo base_url(); ?>categories?categoryId=<?php echo $categoryArray[$i]['categoryId']; ?>#parentVerticalTab<?php echo ($i+1) ?>">
                        <div class="focus-border">
                            <div class="focus-layout">
                                <div class="focus-image"><i class="<?php echo $categoryArray[$i]['icons']; ?>"></i></div>
                                <h4 class="clrchg"> <?php echo $categoryArray[$i]['category']; ?></h4>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </div>
<!--    <div class="trending-ads">-->
<!--        <div class="container">-->
<!--            <!-- slider -->
<!--            <div class="trend-ads">-->
<!--                <h2>Trending Ads</h2>-->
<!--                <ul id="flexiselDemo3">-->
<!--                    <li>-->
<!--                        <div class="col-md-3 biseller-column">-->
<!--                            <a href="single.html">-->
<!--                                <img src="--><?php //echo base_url(); ?><!--assets/web/images/p1.jpg"/>-->
<!--                                <span class="price"> &#x20B9; 450</span>-->
<!--                            </a>-->
<!--                            <div class="ad-info">-->
<!--                                <h5>There are many variations of passages</h5>-->
<!--                                <span>1 hour ago</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-md-3 biseller-column">-->
<!--                            <a href="single.html">-->
<!--                                <img src="--><?php //echo base_url(); ?><!--assets/web/images/p2.jpg"/>-->
<!--                                <span class="price"> &#x20B9; 399</span>-->
<!--                            </a>-->
<!--                            <div class="ad-info">-->
<!--                                <h5>Lorem Ipsum is simply dummy</h5>-->
<!--                                <span>3 hour ago</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-md-3 biseller-column">-->
<!--                            <a href="single.html">-->
<!--                                <img src="--><?php //echo base_url(); ?><!--assets/web/images/p3.jpg"/>-->
<!--                                <span class="price"> &#x20B9; 199</span>-->
<!--                            </a>-->
<!--                            <div class="ad-info">-->
<!--                                <h5>It is a long established fact that a reader</h5>-->
<!--                                <span>8 hour ago</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-md-3 biseller-column">-->
<!--                            <a href="single.html">-->
<!--                                <img src="--><?php //echo base_url(); ?><!--assets/web/images/p4.jpg"/>-->
<!--                                <span class="price"> &#x20B9; 159</span>-->
<!--                            </a>-->
<!--                            <div class="ad-info">-->
<!--                                <h5>passage of Lorem Ipsum you need to be</h5>-->
<!--                                <span>19 hour ago</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <div class="col-md-3 biseller-column">-->
<!--                            <a href="single.html">-->
<!--                                <img src="--><?php //echo base_url(); ?><!--assets/web/images/p5.jpg"/>-->
<!--                                <span class="price"> &#x20B9; 1599</span>-->
<!--                            </a>-->
<!--                            <div class="ad-info">-->
<!--                                <h5>There are many variations of passages</h5>-->
<!--                                <span>1 hour ago</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-md-3 biseller-column">-->
<!--                            <a href="single.html">-->
<!--                                <img src="--><?php //echo base_url(); ?><!--assets/web/images/p6.jpg"/>-->
<!--                                <span class="price"> &#x20B9; 1099</span>-->
<!--                            </a>-->
<!--                            <div class="ad-info">-->
<!--                                <h5>passage of Lorem Ipsum you need to be</h5>-->
<!--                                <span>1 day ago</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-md-3 biseller-column">-->
<!--                            <a href="single.html">-->
<!--                                <img src="--><?php //echo base_url(); ?><!--assets/web/images/p7.jpg"/>-->
<!--                                <span class="price"> &#x20B9; 109</span>-->
<!--                            </a>-->
<!--                            <div class="ad-info">-->
<!--                                <h5>It is a long established fact that a reader</h5>-->
<!--                                <span>9 hour ago</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-md-3 biseller-column">-->
<!--                            <a href="single.html">-->
<!--                                <img src="--><?php //echo base_url(); ?><!--assets/web/images/p8.jpg"/>-->
<!--                                <span class="price"> &#x20B9; 189</span>-->
<!--                            </a>-->
<!--                            <div class="ad-info">-->
<!--                                <h5>Lorem Ipsum is simply dummy</h5>-->
<!--                                <span>3 hour ago</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <div class="col-md-3 biseller-column">-->
<!--                            <a href="single.html">-->
<!--                                <img src="--><?php //echo base_url(); ?><!--assets/web/images/p9.jpg"/>-->
<!--                                <span class="price"> &#x20B9; 2599</span>-->
<!--                            </a>-->
<!--                            <div class="ad-info">-->
<!--                                <h5>Lorem Ipsum is simply dummy</h5>-->
<!--                                <span>3 hour ago</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-md-3 biseller-column">-->
<!--                            <a href="single.html">-->
<!--                                <img src="--><?php //echo base_url(); ?><!--assets/web/images/p10.jpg"/>-->
<!--                                <span class="price"> &#x20B9; 3999</span>-->
<!--                            </a>-->
<!--                            <div class="ad-info">-->
<!--                                <h5>It is a long established fact that a reader</h5>-->
<!--                                <span>9 hour ago</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-md-3 biseller-column">-->
<!--                            <a href="single.html">-->
<!--                                <img src="--><?php //echo base_url(); ?><!--assets/web/images/p11.jpg"/>-->
<!--                                <span class="price"> &#x20B9; 2699</span>-->
<!--                            </a>-->
<!--                            <div class="ad-info">-->
<!--                                <h5>passage of Lorem Ipsum you need to be</h5>-->
<!--                                <span>1 day ago</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-md-3 biseller-column">-->
<!--                            <a href="single.html">-->
<!--                                <img src="--><?php //echo base_url(); ?><!--assets/web/images/p12.jpg"/>-->
<!--                                <span class="price"> &#x20B9; 899</span>-->
<!--                            </a>-->
<!--                            <div class="ad-info">-->
<!--                                <h5>There are many variations of passages</h5>-->
<!--                                <span>1 hour ago</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                </ul>-->
<!--                <script type="text/javascript">-->
<!--                    $(window).load(function() {-->
<!--                        $("#flexiselDemo3").flexisel({-->
<!--                            visibleItems:1,-->
<!--                            animationSpeed: 1000,-->
<!--                            autoPlay: true,-->
<!--                            autoPlaySpeed: 5000,-->
<!--                            pauseOnHover: true,-->
<!--                            enableResponsiveBreakpoints: true,-->
<!--                            responsiveBreakpoints: {-->
<!--                                portrait: {-->
<!--                                    changePoint:480,-->
<!--                                    visibleItems:1-->
<!--                                },-->
<!--                                landscape: {-->
<!--                                    changePoint:640,-->
<!--                                    visibleItems:1-->
<!--                                },-->
<!--                                tablet: {-->
<!--                                    changePoint:768,-->
<!--                                    visibleItems:1-->
<!--                                }-->
<!--                            }-->
<!--                        });-->
<!---->
<!--                    });-->
<!--                </script>-->
<!--                <script type="text/javascript" src="--><?php //echo base_url(); ?><!--assets/web/js/jquery.flexisel.js"></script>-->
<!--            </div>-->
<!--        </div>-->
<!--        <!-- //slider -->
<!--    </div>-->
</div>
