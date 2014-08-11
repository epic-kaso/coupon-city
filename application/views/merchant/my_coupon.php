<div class="container">
    <?= $breadcrumbs ?>
</div>
<?php
if (property_exists($coupon, 'empty')) {
    ?>
    <div class="span3">
        <!-- COUPON THUMBNAIL -->
        <a href="#" class="coupon-thumb">
            <div class="coupon-inner">
                <h5 class="coupon-title text-center"><?= $coupon->name ?></h5>
            </div>
        </a>
    </div>
<?php } else {
    ?>

    <div class="container">
        <div class = "span6">
            <h4><?= $coupon->name ?></h4>
            <p><?= $coupon->summary ?></p>
            <ul class="list coupon-meta">
                <li>
                    <ul class="list coupon-list-prices">
                        <li><span class="coupon-meta-title">Old Price</span><span class="coupon-price">₦<?= $coupon->old_price ?></span>
                        </li>
                        <li><span class="coupon-meta-title">Discount</span><span class="coupon-price"><?= $coupon->discount ?></span>
                        </li>
                        <li><span class="coupon-meta-title">Savings</span><span class="coupon-price">₦<?= ($coupon->old_price - $coupon->new_price) ?></span>
                        </li>
                    </ul>
                </li>
                <li><span class="coupon-meta-title">Time Left to Buy</span>
                    <!-- COUNTDOWN -->
                    <div data-countdown="<?= $coupon->end_date ?>" class="countdown countdown-inline"></div>
                </li>
                <li>
                </li>
            </ul>
        </div>
        <div class="span6">
            <!-- START BOOTSTRAP CAROUSEL -->
            <div id="my-carousel" class="carousel slide">
                <div class="carousel-inner">
                    <?php
                    $index = 0;
                    if (property_exists($coupon, 'coupon_medias') && !empty($coupon->coupon_medias)) {
                        foreach ($coupon->coupon_medias as $media) {
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
        </div>
        <div>
            <p><?= $coupon->description ?></p>
        </div>
    </div>
    <?php
}
?>