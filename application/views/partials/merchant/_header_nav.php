<div class="merchant-header">
    <div class="center clearfix">

        <span class="_logo left"></span>

        <div class="merchant-nav left">
            
            <a href="<?= base_url(Merchant::MERCHANT_URL); ?>">Dashboard</a>
            <a href="<?= base_url('merchant/my-coupons'); ?>">Coupons</a>
            <a href="#verify-dialog" id="redeem">Redeem</a>
            <a href="<?= base_url(Merchant::MERCHANT_URL . '/profile'); ?>">Business</a>
            <a href="<?= base_url('merchant/settings'); ?>">Deposit</a>
        </div>

        <ul class="right clearfix">
            <?php if (!$merchant) { ?>
                <li class="left"><a href="<?= base_url(Merchant::MERCHANT_URL . '/login'); ?>" ><i class="icon-signin"></i>Sign in</a>
                </li>
                <li class="left"><a href="<?= base_url(Merchant::MERCHANT_URL . '/signup'); ?>"><i class="icon-edit"></i>Sign up</a>
                </li>
            <?php } else { ?>
                <li class="left">
                    <?= $merchant->business_name ?></a>
                </li>
                <li class="left _logout">
                    <a href="<?= base_url(Merchant::MERCHANT_URL . '/logout'); ?>">&raquo; &nbsp;Logout</a>
                </li>
            <?php } ?>
        </ul>

    </div>
</div>

<?= partial('partials/merchant/_login', array('merchant' => @$merchant)); ?>

<?= partial('partials/merchant/_register', array('merchant' => @$merchant)); ?>
<?= partial('partials/merchant/_redeem_coupon', array()); ?>


<div id="password-recover-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
    <i class="icon-retweet dialog-icon"></i>
    <h3>Password Recovery</h3>
    <h5>Fortgot your password? Don't worry we can deal with it</h5>
    <div class="row-fluid">
        <form class="dialog-form">
            <label>E-mail</label>
            <input type="text" placeholder="email@domain.com" class="span12">
            <input type="submit" value="Request new password" class="btn btn-primary">
        </form>
    </div>
</div>