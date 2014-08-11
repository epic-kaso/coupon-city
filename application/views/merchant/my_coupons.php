
<a href="<?= base_url('merchant/add-coupon'); ?>" class="coupon-thumb">Add Coupons</a>


<?php if ($merchant !== FALSE) { ?>

<?= partial('partials/_category_nav', $categories); ?>
<?= partial('partials/merchant/_display_coupons', $coupons); ?>

<?php } else { ?>

    <div class="if-no-deal">
        <p>You currently have no Coupons</p>

        <div class="no-deal"></div>

        <p>Give discounts and drive customers to your business. We are here to help you. <a href="">Start here</a></p>
    </div> 

    <?php
}
?>
