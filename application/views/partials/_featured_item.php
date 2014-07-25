<?php if ($featured_item !== FALSE) { ?>

    <div class = "top-area">
        <div class = "container">
            <div class = "gap"></div>
            <div class = "row row-reverce coupon">
                <div class = "span3">
                    <div class = "box">
                        <h4><?= $featured_item->name ?></h4>
                        <p><?= $featured_item->summary ?></p><a class="btn btn-primary btn-large btn-block" href="<?= $featured_item->grab_link ?>">₦<?= $featured_item->new_price ?> Grab Now</a>
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
                            <?php
                            $index = 0;
                            if (property_exists($featured_item, 'coupon_medias') && !empty($featured_item->coupon_medias)) {
                                foreach ($featured_item->coupon_medias as $media) {
                                    ?>
                                    <div class = "<?= ($index === 0 ? 'active ' : '') ?>item">
                                        <img src = "<?= base_url($media->media_url) ?>" alt = "Image Alternative text" title = "cascada" />
                                    </div>
                                    <?php
                                    $index++;
                                }
                            } else {
                                ?>
                                <div class = "active item">
                                    <img src = "<?= base_url('assets/images/no_image.png') ?>" alt = "Image Alternative text" title = "cascada" />
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                        if ($index > 1) {
                            ?>
                            <a class="carousel-control left" href="#my-carousel" data-slide="prev"></a>
                            <a class="carousel-control right" href="#my-carousel" data-slide="next"></a>
                        <?php } ?>
                    </div>
                    <!-- END BOOTSTRAP CAROUSEL -->
                </div>
            </div>
            <div class="gap"></div>
        </div>
    </div>

    <?php
}?>