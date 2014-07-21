<?php
foreach ($coupons->items() as $coupon) {
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
                <img src="<?= base_url('assets') ?>/img/the_violin_800x600.jpg" alt="Image Alternative text" title="The Violin" />
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
}
?>