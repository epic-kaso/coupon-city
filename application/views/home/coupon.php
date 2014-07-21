<?= partial('partials/_header_nav', array('active' => 'coupon')); ?>
<!-- LOGIN REGISTER LINKS CONTENT -->
<?= partial('partials/account/_login', array()); ?>
<?= partial('partials/account/_create_user', array()); ?>
<?= partial('partials/account/_forgot_password', array()); ?>

<!-- END LOGIN REGISTER LINKS CONTENT -->
<!-- SEARCH AREA -->
<?= partial('partials/_search', array('query' => @$search_query)); ?>
<!-- END SEARCH AREA -->
<div class="top-title-area">
    <div class="container">
        <h1 class="title-page"><?= $featured_item->name ?></h1>
    </div>
</div>

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
                <h5>Description</h5>
                <p><?= $featured_item->summary ?></p>
            </div>
            <div class="span3">
                <h5>In a Nutshell</h5>
                <p></p>
            </div>
            <div class="span3">
                <h5>Location</h5>
                <!-- GOOGLE MAP -->
                <div class="gmap" id="gmap"></div>
            </div>
        </div>
        <div class="gap gap-mini"></div>
        <div class="row row-wrap">

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
        </div>
    </div>
    <!-- END CONTENT SLIDER -->
    <div class="gap gap-small"></div>
</div>




<?= partial('partials/_footer_nav', array()); ?>