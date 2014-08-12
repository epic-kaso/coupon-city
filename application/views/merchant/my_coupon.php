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
        </div>
        <div>
            <p><?= $coupon->description ?></p>
        </div>
    </div>
    <?php
}
?>