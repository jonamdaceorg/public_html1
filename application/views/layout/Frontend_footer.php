<!--footer section start-->
<footer>
    <div class="footer-top" style="background-color: #D3E1E6">
        <div class="container">
            <div class="foo-grids">
                <div class="col-md-3 footer-grid">
                    <h4 class="footer-head">Help</h4>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>howitworks">How it Works</a></li>
                        <li><a href="<?php echo base_url(); ?>sitemap">Sitemap</a></li>
                        <li><a href="<?php echo base_url(); ?>faq">Faq</a></li>
                        <li><a href="<?php echo base_url(); ?>feedback">Feedback</a></li>
                        <li><a href="<?php echo base_url(); ?>typography">Shortcodes</a></li>
                    </ul>
                </div>
                <div class="col-md-3 footer-grid">
                    <h4 class="footer-head">Information</h4>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>locatinsMap">Locations Map</a></li>
                        <li><a href="<?php echo base_url(); ?>terms">Terms of Use</a></li>
                        <li><a href="<?php echo base_url(); ?>popularSearch">Popular searches</a></li>
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
                            <a href="#"><img src="<?php echo base_url(); ?>assets/web/images/1.png" alt=""></a>
                        </div>
                        <div class="app-button">
                            <a href="#"><img src="<?php echo base_url(); ?>assets/web/images/2.png" alt=""></a>
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
                    <li><a class="facebook" href="#"><span>Facebook</span></a></li>
                    <li><a class="twitter" href="#"><span>Twitter</span></a></li>
                    <li><a class="flickr" href="#"><span>Flickr</span></a></li>
                    <li><a class="googleplus" href="#"><span>Google+</span></a></li>
                    <li><a class="dribbble" href="#"><span>Dribbble</span></a></li>
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