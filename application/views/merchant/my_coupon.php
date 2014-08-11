<?= partial('partials/merchant/_header_nav', array('merchant' => @$merchant)); ?>
<div class="container">
    <?= $breadcrumbs ?>
</div>
<div class="gap"></div>
<div class="container">
    <div class = "row row-reverce coupon">
        <div class = "span3">
            <div class = "box">
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
        </div>
        <div class="span9">
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
            <!-- END BOOTSTRAP CAROUSEL -->
        </div>
    </div>
</div>
<div class="row">
    <div class="span6">
        <h5>Description</h5>
        <p><?= $item->description ?></p>
    </div>
    <div class="span3">
        <h5>In a Nutshell</h5>
        <p><?= $item->summary ?></p>
    </div>
    <div class="span3">
        <h5>Location</h5>
        <div class="gmap" id="gmap"></div>
    </div>
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
    <div class="span3">
        <!-- COUPON THUMBNAIL -->
        <a href="<?= $coupon->link ?>" class="coupon-thumb">
            <img src="<?= base_url($coupon->cover_image_url) ?>" alt="Image Alternative text" title="The Violin" />
            <div class="coupon-inner">
                <h5 class="coupon-title"><?= $coupon->name ?></h5>
                <p class="coupon-desciption"><?= $coupon->summary ?></p>
                <div class="coupon-meta"><span class="coupon-time"><?= $coupon->remaining ?></span><span class="coupon-save">Save <?= $coupon->discount ?>%</span>
                    <div class="coupon-price"><span class="coupon-old-price">₦<?= $coupon->old_price ?></span><span class="coupon-new-price">₦<?= $coupon->new_price ?></span>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <?php
}
?>