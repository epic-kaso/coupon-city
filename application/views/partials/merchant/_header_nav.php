<div class="merchant-header">
    <div class="center clearfix">

        <span class="_logo left"></span>

        <div class="merchant-nav left">
            <a href="<?= base_url('merchant/dashboard'); ?>">Dashboard</a>
            <a href="<?= base_url('merchant/my-coupons'); ?>">Coupons</a>
            <a href="#verify-dialog" id="redeem">Redeem</a>
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
                    <a href="<?= base_url('merchant/settings'); ?>">
                        <?= $merchant->business_name ?>
                    </a>
                </li>
                <li class="left _logout">
                    <a href="<?= base_url(Merchant::MERCHANT_URL . '/logout'); ?>">&raquo; &nbsp;Logout</a>
                </li>
            <?php } ?>
        </ul>

    </div>
</div>



