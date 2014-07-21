<div class="top-area">
    <div class="container">
        <div class="gap"></div>
        <div class="row row-reverce coupon">
            <div class="span3">
                <div class="box">
                    <h4><?= $featured_item->name ?></h4>
                    <p><?= $featured_item->description ?></p><a class="btn btn-primary btn-large btn-block" href="#">₦<?= $featured_item->new_price ?> Grab Now</a>
                    <ul class="list coupon-meta">
                        <li>
                            <ul class="list coupon-list-prices">
                                <li><span class="coupon-meta-title">Old Price</span><span class="coupon-price">₦<?= $featured_item->old_price ?></span>
                                </li>
                                <li><span class="coupon-meta-title">Discount</span><span class="coupon-price"><?= $featured_item->discount ?></span>
                                </li>
                                <li><span class="coupon-meta-title">Savings</span><span class="coupon-price">₦<?= ($featured_item->old_price - $featured_item->new_price) ?></span>
                                </li>
                            </ul>
                        </li>
                        <li><span class="coupon-meta-title">Time Left to Buy</span>
                            <!-- COUNTDOWN -->
                            <div data-countdown="<?= $featured_item->end_date ?>" class="countdown countdown-inline"></div>
                        </li>
                        <li><span class="coupon-meta-title">5000+ bought</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="span9">
                <!-- START BOOTSTRAP CAROUSEL -->
                <div id="my-carousel" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="active item">
                            <img src="<?= base_url('assets') ?>/img/cascada_960x540.jpg" alt="Image Alternative text" title="cascada" />
                        </div>
                        <div class="item">
                            <img src="<?= base_url('assets') ?>/img/waipio_valley_960x540.jpg" alt="Image Alternative text" title="waipio valley" />
                        </div>
                        <div class="item">
                            <img src="<?= base_url('assets') ?>/img/the_best_mode_of_transport_here_in_maldives_960x540.jpg" alt="Image Alternative text" title="the best mode of transport here in maldives" />
                        </div>
                    </div>
                    <a class="carousel-control left" href="#my-carousel" data-slide="prev"></a>
                    <a class="carousel-control right" href="#my-carousel" data-slide="next"></a>
                </div>
                <!-- END BOOTSTRAP CAROUSEL -->
            </div>
        </div>
        <div class="gap"></div>
    </div>
</div>