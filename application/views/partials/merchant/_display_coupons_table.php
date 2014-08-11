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
                <img src="<?= base_url($coupon->cover_image_url) ?>" alt="Image Alternative text" title="The Violin" />
                <div class="coupon-inner">
                    <h5 class="coupon-title"><?= $coupon->name ?></h5>
                    <p class="coupon-desciption"><?= $coupon->summary ?></p>
                    <div class="coupon-meta">
                        <table>
                            <tr>
                                <td><p>Coupon Code:</p></td>
                                <td><h5><?= $coupon->coupon_code; ?></h5></td>
                            </tr>
                            <tr>
                                <td><p>Deal Status:</p></td>
                                <td><h5><?= $coupon->deal_status == 1 ? 'Active' : 'Inactive'; ?></h5></td>
                            </tr>
                            <tr>
                                <td><p>Sales Count:</p></td>
                                <td><h5><?= $coupon->sales_count ?></h5></td>
                            </tr>
                            <tr>
                                <td><p>View Count:</p></td>
                                <td><h5><?= $coupon->view_count ?></h5></td>
                            </tr>
                            <tr>
                                <td><p>Redemption Count:</p></td>
                                <td><h5><?= $coupon->redemption_count ?></h5></td>
                            </tr>
                        </table>
                        <span class="coupon-time"><?= $coupon->remaining ?></span>
                        <span class="coupon-save">Save <?= $coupon->discount ?>%</span>
                        <div class="coupon-price">
                            <span class="coupon-old-price">₦<?= $coupon->old_price ?></span>
                            <span class="coupon-new-price">₦<?= $coupon->new_price ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php
    }
}
?>