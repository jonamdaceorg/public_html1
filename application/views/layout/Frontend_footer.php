</div>
<div class="col-md-2  sideComericalads">
    <!-- <SCRIPT charset="utf-8" type="text/javascript" src="//ws-in.amazon-adsystem.com/widgets/q?rt=tf_mfw&ServiceVersion=20070822&MarketPlace=IN&ID=V20070822%2FIN%2Fmyosssite-21%2F8001%2F681e333e-224b-40ba-9209-44ebe89aedb8"> </SCRIPT> <NOSCRIPT><A rel="nofollow" HREF="//ws-in.amazon-adsystem.com/widgets/q?rt=tf_mfw&ServiceVersion=20070822&MarketPlace=IN&ID=V20070822%2FIN%2Fmyosssite-21%2F8001%2F681e333e-224b-40ba-9209-44ebe89aedb8&Operation=NoScript">Amazon.in Widgets</A></NOSCRIPT> -->
<?php //print_r($adBannerArray);
    if(count($adBannerArray)>0){
        for($i=0; $i<count($adBannerArray); $i++){
            $typeOfPosition = $adBannerArray[$i]['typeOfPosition'];
            if($typeOfPosition == "Right"){
                echo $adsCode = $adBannerArray[$i]['adsCode'];
            }
        }
    }
    ?>
    <!--21 dec end --->
</div>
</div>
</div>

<!--footer section start-->
<footer>
    <div class="footer-top" style="background-color: #D3E1E6">
        <div class="container">
            <div class="foo-grids">
                <div class="col-md-3 footer-grid">
                    <h4 class="footer-head">Help</h4>
                    <ul>
<!--                        <li><a href="--><?php //echo base_url(); ?><!--howitworks">How it Works</a></li>-->
                        <li><a href="<?php echo base_url(); ?>sitemap">Sitemap</a></li>
<!--                        <li><a href="--><?php //echo base_url(); ?><!--faq">Faq</a></li>-->
                        <li><a href="<?php echo base_url(); ?>contactUs">Feedback</a></li>
<!--                        <li><a href="--><?php //echo base_url(); ?><!--feedback">Feedback</a></li>-->
<!--                        <li><a href="--><?php //echo base_url(); ?><!--typography">Shortcodes</a></li>-->
                    </ul>
                </div>
                <div class="col-md-3 footer-grid">
                    <h4 class="footer-head">Information</h4>
                    <ul>
<!--                        <li><a href="--><?php //echo base_url(); ?><!--locatinsMap">Locations Map</a></li>-->
                        <li><a href="<?php echo base_url(); ?>terms">Terms of Use</a></li>
<!--                        <li><a href="--><?php //echo base_url(); ?><!--popularSearch">Popular searches</a></li>-->
                        <li><a href="<?php echo base_url(); ?>privacy">Privacy Policy</a></li>
                        <li><a href="<?php echo base_url(); ?>contactUs">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-6 footer-grid">
                    <h4 class="footer-head">Mobile Apps</h4>
                    <ul>
                        <li class="footer-grid-text">1StepShop App is the <span>Easiest</span> way for Selling and buying goods</li>
                    </ul>
                    <div class="app-buttons">
                        <div class="app-button">
<!--                            <a href="#"><img src="--><?php //echo base_url(); ?><!--assets/web/images/1.png" alt=""></a>-->
                        </div>
                        <div class="app-button">
<!--                            <a href="#"><img src="--><?php //echo base_url(); ?><!--assets/web/images/2.png" alt=""></a>-->
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <!--<div class="col-md-3 footer-grid">
                    <h4 class="footer-head">Contact Us</h4>
                    <span class="hq">Our headquarters</span>
                    <address>
                        <ul class="location">
                            <li><span class="glyphicon glyphicon-map-marker"></span></li>
                            <li>CENTER FOR FINANCIAL ASSISTANCE TO DEPOSED NIGERIAN ROYALTY</li>
                            <div class="clearfix"></div>
                        </ul>
                        <ul class="location">
                            <li><span class="glyphicon glyphicon-earphone"></span></li>
                            <li>+0 561 111 235</li>
                            <div class="clearfix"></div>
                        </ul>
                        <ul class="location">
                            <li><span class="glyphicon glyphicon-envelope"></span></li>
                            <li><a href="mailto:info@example.com">mail@example.com</a></li>
                            <div class="clearfix"></div>
                        </ul>
                    </address>
                </div>-->
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="footer-bottom text-center">
        <div class="container">
<!--            <div class="footer-logo">-->
<!--                <a href="--><?php //echo base_url(); ?><!--"><   n>1Step</span>Shop</a>-->
<!--            </div>-->
            <div class="footer-social-icons">
                <ul>
                    <li><a class="iconcss"  target="_blank" href="https://twitter.com/1stepshop"><i class="fa fa-twitter" style=" margin-top: 5px" aria-hidden="true"></i> <span>Twitter</span></a></li>
                    <li><a class="iconcss"   href="javascript:void(0)" onclick="gotoLink()"><i class="fa fa-linkedin" style="margin-top: 5px" aria-hidden="true"></i> <span>Linkedin</span></a></li>
                    <li><a class="iconcss"  target="_blank" href="https://www.facebook.com/1stepshop.in/"><i class="fa fa-facebook" style=" margin-top: 5px" aria-hidden="true"></i> <span>Facebook</span></a></li>
                    <li><a class="iconcss"  target="_blank" href="https://plus.google.com/110477558775619195162"><i class="fa fa-google-plus" style=" margin-top: 5px" aria-hidden="true"></i> <span>Google+</span></a></li>
<img src="assets/web/images/p.gif" alt="1stepshopSearch" title="1stepshopSearch" />
<!--                    <li><a class="twitter" target="_blank" href="https://twitter.com/1stepshop"><span>Twitter</span></a></li>-->
<!--                    <li><a class="dribbble" target="_blank" href="https://www.linkedin.com/in/1stepshop-in-770806142/"><span>Linkedin</span></a></li>-->
<!--                    <li><a class="facebook" target="_blank" href="https://www.facebook.com/1stepshop.in/"><span>Facebook</span></a></li>-->
<!--                    <li><a class="googleplus" target="_blank" href="https://plus.google.com/110477558775619195162"><span>Google+</span></a></li>-->
<!--                    <li><a class="dribbble" href="#"><span>Dribbble</span></a></li>-->
                </ul>
            </div>
            <div class="copyrights">
                <p> <span class="fa fa-copyright"></span> 2017 1stepshop. All Rights Reserved | Design by  <a href="http://www.1stepshop.in/"> 1stepshop.in</a></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</footer>
<!--footer section end-->
</body>

<div class="modal modalloaidng"><!-- Place at bottom of page --></div>
<script>
    $body = $("body");

    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });

    function gotoLink()
    {
       var url="https://www.linkedin.com/in/1stepshop-in-770806142/";
        var win = window.open(url, '_blank');
        win.focus();

    }
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
        url('assets/web/images/loading.gif')
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
</html>