
<div class="auth-closure">
    <h1>Join CouponCity</h1>
    <p class="auth-tagline">Create a CouponCity account and start dirivng massive sales to your business.</p>
</div>



<div class="auth-form hold">

    <div class="alert-error form-alert">
        <?php echo validation_errors(); ?>

    </div>
    <?php if (!empty($success_msg)) { ?>
        <div class='alert form-alert alert-success'><p><?= $success_msg ?></p></div>
    <?php } ?>
    <?php if (!empty($error_msg)) { ?>
        <div class='alert form-alert alert-error'><p><?= $error_msg ?></p></div>
    <?php } ?>

    <form class="dialog-form" method="post" action="<?= base_url(Merchant::MERCHANT_URL . '/signup'); ?>">

        <input name="email" type="email" placeholder="you@example.com" required>
        <input name="password" type="password" placeholder="Password" required>
        <input name="re_password" type="password" placeholder="Confirm Password" required>
        <input name="area" type="text" placeholder="Your Area e.g Lekki">
        <p class="tcs">By continuing, I agree to CouponCity's <a href="">Terms and conditions</a>.</p>
        <input type="submit" value="Create Account" class="btn btn-submit">
    </form>

    <ul class="clearfix reset-pass-register">
        <li class="left"><a href="<?= base_url(Merchant::MERCHANT_URL . '/login'); ?>">Log in</a>
        </li>
        <li class="right"><a href="<?= base_url(Merchant::MERCHANT_URL . '/forgot-password'); ?>">Forgot password</a>
        </li>
    </ul>
</div>