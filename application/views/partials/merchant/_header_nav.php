<div class="merchant-header">
    <div class="center clearfix">
        <span class="_logo left"></span>
        <div class="merchant-nav left">
<<<<<<< HEAD
            <a href="<?= base_url('merchant/dashboard'); ?>">Dashboard</a>
=======
            <a href="<?= base_url(Merchant::MERCHANT_URL); ?>">Dashboard</a>
>>>>>>> b10b6cc9a4b679c0c03b8296dc54820be651ca7f
            <a href="<?= base_url('merchant/my-coupons'); ?>">Coupons</a>
            <a href="<?= base_url('merchant/redeem-coupon'); ?>" id="redeem">Redeem</a>
            <a href="<?= base_url(Merchant::MERCHANT_URL . '/profile'); ?>">Business</a>
            <a href="">Deposit</a>
        </div>
        <ul class="right clearfix">
            <?php if (!$merchant) { ?>
                <li class="left"><a href="<?= base_url(Merchant::MERCHANT_URL . '/login'); ?>" ><i class="icon-signin"></i>Sign in</a>
                </li>
                <li class="left"><a href="<?= base_url(Merchant::MERCHANT_URL . '/signup'); ?>"><i class="icon-edit"></i>Sign up</a>
                </li>
            <?php } else { ?>
                <li class="left">
<<<<<<< HEAD
                    <a href="<?= base_url('merchant/settings'); ?>">
                        <?= $merchant->business_name ?>
                    </a>
=======
                    <?= $merchant->business_name ?>
>>>>>>> b10b6cc9a4b679c0c03b8296dc54820be651ca7f
                </li>
                <li class="left _logout">
                    <a href="<?= base_url(Merchant::MERCHANT_URL . '/logout'); ?>">&raquo; &nbsp;Logout</a>
                </li>
            <?php } ?>
        </ul>

    </div>
</div>
<<<<<<< HEAD



=======
>>>>>>> b10b6cc9a4b679c0c03b8296dc54820be651ca7f
