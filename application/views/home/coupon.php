<?= partial('partials/_header_nav', array('active' => 'coupon')); ?>
<!-- LOGIN REGISTER LINKS CONTENT -->
<?= partial('partials/account/_login', array()); ?>
<?= partial('partials/account/_create_user', array()); ?>
<?= partial('partials/account/_forgot_password', array()); ?>

<!-- END LOGIN REGISTER LINKS CONTENT -->
<!-- SEARCH AREA -->
<?= partial('partials/_search', array('query' => @$search_query)); ?>
<!-- END SEARCH AREA -->


<div class="gap"></div>



<div class="container">
    <div class="row row-reverce coupon">
        <?= partial('partials/_featured_item', $featured_item); ?>
    </div>
    <div class="gap gap-small"></div>

    <div class="row-fluid">
        <div class="gap gap-small"></div>
        <div class="row">
            <div class="span6">
                <h5>About Awesome Vacation Pack</h5>
                <p>Posuere mauris habitant facilisis in ridiculus vulputate montes curae dictumst lobortis volutpat suscipit praesent habitant habitasse senectus sollicitudin proin suspendisse tristique molestie egestas egestas lectus enim tristique pellentesque eu venenatis himenaeos torquent ridiculus cum praesent cubilia quis quisque mollis consequat nascetur eu urna ante arcu phasellus maecenas parturient natoque ipsum</p>
            </div>
            <div class="span3">
                <h5>In a Nutshell</h5>
                <p>Facilisi cubilia vel litora vel eleifend mollis euismod mus curae dictum taciti platea nullam dui parturient litora suspendisse magna nunc</p>
            </div>
        </div>
        <div class="gap gap-mini"></div>
        <div class="row row-wrap">
            <div class="span6">
                <h5>Location</h5>
                <!-- GOOGLE MAP -->
                <div class="gmap" id="gmap"></div>
            </div>
            <div class="span3">
                <h5>How It's Work</h5>
                <p class="small">
                    Ligula natoque habitasse eros rhoncus viverra orci mattis vulputate senectus porttitor suspendisse egestas facilisi iaculis est aptent conubia accumsan dolor</p>
                <a href="#" class="btn btn-primary">Ask Question</a>
            </div>
        </div>
        <div class="span10">
            <h3>Similar Offers</h3>
        </div>
        <div class="span2">
            <ul class="wilto-controls pull-right top">
                <li>
                    <a href="#wilto-slider" class="prev"></a>
                </li>
                <li>
                    <a href="#wilto-slider" class="next"></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- START CONTENT SLIDER -->
    <div class="wilto-slider-wrap" id="wilto-slider-wrap">
        <div id="wilto-slider" class="wilto-slider">
            <div class="wilto-slide row-fluid row-wrap">
                <div class="span3">
                    <!-- COUPON THUMBNAIL -->
                    <a href="#" class="coupon-thumb coupon-thumb-hold">
                        <img src="img/the_hidden_power_of_the_heart_800x600.jpg" alt="Image Alternative text" title="The Hidden Power of the Heart" />
                        <div class="coupon-inner">
                            <h5 class="coupon-title">Beach Holidays</h5>
                            <p class="coupon-desciption">Inceptos tellus aliquet scelerisque velit fames tellus ac</p>
                            <div class="coupon-meta"><span class="coupon-time">5 days 21 h remaining</span><span class="coupon-save">Save 65%</span>
                                <div class="coupon-price"><span class="coupon-old-price">749$</span><span class="coupon-new-price">262$</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="span3">
                    <!-- COUPON THUMBNAIL -->
                    <a href="#" class="coupon-thumb coupon-thumb-hold">
                        <img src="img/amaze_800x600.jpg" alt="Image Alternative text" title="AMaze" />
                        <div class="coupon-inner">
                            <h5 class="coupon-title">New Glass Collection</h5>
                            <p class="coupon-desciption">Rutrum pulvinar sed ridiculus sed leo amet facilisi</p>
                            <div class="coupon-meta"><span class="coupon-time">5 days 9 h remaining</span><span class="coupon-save">Save 75%</span>
                                <div class="coupon-price"><span class="coupon-old-price">290$</span><span class="coupon-new-price">73$</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="span3">
                    <!-- COUPON THUMBNAIL -->
                    <a href="#" class="coupon-thumb coupon-thumb-hold">
                        <img src="img/ana_29_800x600.jpg" alt="Image Alternative text" title="Ana 29" />
                        <div class="coupon-inner">
                            <h5 class="coupon-title">Hot Summer Collection</h5>
                            <p class="coupon-desciption">Etiam ad dis et neque dictumst est euismod</p>
                            <div class="coupon-meta"><span class="coupon-time"> 42 h remaining</span><span class="coupon-save">Save 55%</span>
                                <div class="coupon-price"><span class="coupon-old-price">213$</span><span class="coupon-new-price">96$</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="span3">
                    <!-- COUPON THUMBNAIL -->
                    <a href="#" class="coupon-thumb coupon-thumb-hold">
                        <img src="img/food_is_pride_800x600.jpg" alt="Image Alternative text" title="Food is Pride" />
                        <div class="coupon-inner">
                            <h5 class="coupon-title">Best Pasta</h5>
                            <p class="coupon-desciption">Nostra pharetra platea mus nec viverra et molestie</p>
                            <div class="coupon-meta"><span class="coupon-time">4 days 37 h remaining</span><span class="coupon-save">Save 65%</span>
                                <div class="coupon-price"><span class="coupon-old-price">441$</span><span class="coupon-new-price">154$</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="wilto-slide row-fluid row-wrap">
                <div class="span3">
                    <!-- COUPON THUMBNAIL -->
                    <a href="#" class="coupon-thumb coupon-thumb-hold">
                        <img src="img/gamer_chick_800x600.jpg" alt="Image Alternative text" title="Gamer Chick" />
                        <div class="coupon-inner">
                            <h5 class="coupon-title">Playstation Accessories</h5>
                            <p class="coupon-desciption">Magna libero nascetur aptent ullamcorper sed sollicitudin amet</p>
                            <div class="coupon-meta"><span class="coupon-time">3 days 31 h remaining</span><span class="coupon-save">Save 35%</span>
                                <div class="coupon-price"><span class="coupon-old-price">803$</span><span class="coupon-new-price">522$</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="span3">
                    <!-- COUPON THUMBNAIL -->
                    <a href="#" class="coupon-thumb coupon-thumb-hold">
                        <img src="img/green_furniture_800x600.jpg" alt="Image Alternative text" title="Green Furniture" />
                        <div class="coupon-inner">
                            <h5 class="coupon-title">Green Furniture Pack</h5>
                            <p class="coupon-desciption">Potenti quisque tellus maecenas ad mus ante nulla</p>
                            <div class="coupon-meta"><span class="coupon-time">4 days 29 h remaining</span><span class="coupon-save">Save 70%</span>
                                <div class="coupon-price"><span class="coupon-old-price">214$</span><span class="coupon-new-price">64$</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="span3">
                    <!-- COUPON THUMBNAIL -->
                    <a href="#" class="coupon-thumb coupon-thumb-hold">
                        <img src="img/our_coffee_miss_u_800x600.jpg" alt="Image Alternative text" title="Our Coffee miss u" />
                        <div class="coupon-inner">
                            <h5 class="coupon-title">Coffe Shop Discount</h5>
                            <p class="coupon-desciption">Dignissim praesent sem imperdiet faucibus est a vulputate</p>
                            <div class="coupon-meta"><span class="coupon-time"> 12 h remaining</span><span class="coupon-save">Save 25%</span>
                                <div class="coupon-price"><span class="coupon-old-price">221$</span><span class="coupon-new-price">166$</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="span3">
                    <!-- COUPON THUMBNAIL -->
                    <a href="#" class="coupon-thumb coupon-thumb-hold">
                        <img src="img/urbex_esch_lux_with_laney_and_laaaaag_800x600.jpg" alt="Image Alternative text" title="Urbex Esch/Lux with Laney and Laaaaag" />
                        <div class="coupon-inner">
                            <h5 class="coupon-title">Canon Camera</h5>
                            <p class="coupon-desciption">Suscipit metus ornare varius porttitor tempor primis elementum</p>
                            <div class="coupon-meta"><span class="coupon-time">3 days 27 h remaining</span><span class="coupon-save">Save 45%</span>
                                <div class="coupon-price"><span class="coupon-old-price">463$</span><span class="coupon-new-price">255$</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="wilto-slide row-fluid row-wrap">
                <div class="span3">
                    <!-- COUPON THUMBNAIL -->
                    <a href="#" class="coupon-thumb coupon-thumb-hold">
                        <img src="img/waipio_valley_800x600.jpg" alt="Image Alternative text" title="waipio valley" />
                        <div class="coupon-inner">
                            <h5 class="coupon-title">Awesome Vacation</h5>
                            <p class="coupon-desciption">Litora non penatibus magna nascetur lacinia dolor imperdiet</p>
                            <div class="coupon-meta"><span class="coupon-time">8 days 26 h remaining</span><span class="coupon-save">Save 20%</span>
                                <div class="coupon-price"><span class="coupon-old-price">136$</span><span class="coupon-new-price">109$</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="span3">
                    <!-- COUPON THUMBNAIL -->
                    <a href="#" class="coupon-thumb coupon-thumb-hold">
                        <img src="img/iphone_5_ipad_mini_ipad_3_800x600.jpg" alt="Image Alternative text" title="iPhone 5 iPad mini iPad 3" />
                        <div class="coupon-inner">
                            <h5 class="coupon-title">Apple Big Deal</h5>
                            <p class="coupon-desciption">Himenaeos scelerisque pretium euismod nulla sapien sollicitudin ante</p>
                            <div class="coupon-meta"><span class="coupon-time">4 days 21 h remaining</span><span class="coupon-save">Save 70%</span>
                                <div class="coupon-price"><span class="coupon-old-price">772$</span><span class="coupon-new-price">232$</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="span3">
                    <!-- COUPON THUMBNAIL -->
                    <a href="#" class="coupon-thumb coupon-thumb-hold">
                        <img src="img/old_no7_800x600.jpg" alt="Image Alternative text" title="Old No7" />
                        <div class="coupon-inner">
                            <h5 class="coupon-title">Jack Daniels Huge Pack</h5>
                            <p class="coupon-desciption">Integer pellentesque sociis sodales conubia velit iaculis sed</p>
                            <div class="coupon-meta"><span class="coupon-time"> 46 h remaining</span><span class="coupon-save">Save 40%</span>
                                <div class="coupon-price"><span class="coupon-old-price">418$</span><span class="coupon-new-price">251$</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="span3">
                    <!-- COUPON THUMBNAIL -->
                    <a href="#" class="coupon-thumb coupon-thumb-hold">
                        <img src="img/the_violin_800x600.jpg" alt="Image Alternative text" title="The Violin" />
                        <div class="coupon-inner">
                            <h5 class="coupon-title">Violin Lessons</h5>
                            <p class="coupon-desciption">Praesent blandit nullam aliquet rhoncus varius justo aliquam</p>
                            <div class="coupon-meta"><span class="coupon-time"> 39 h remaining</span><span class="coupon-save">Save 25%</span>
                                <div class="coupon-price"><span class="coupon-old-price">630$</span><span class="coupon-new-price">473$</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT SLIDER -->
    <div class="gap gap-small"></div>
</div>




<?= partial('partials/_footer_nav', array()); ?>