
<div class="auth-closure">
    <h1>Welcome back</h1>
    <p class="auth-tagline">Log into your Couponcity account and start creating coupons and drive revenue up.</p>
</div>

<div class="alert-error form-alert">
    <?php echo validation_errors(); ?>
</div>
<?php if (!empty($success_msg)) { ?>
    <div class='alert form-alert alert-success'><p><?= $success_msg ?></p></div>
<?php } ?>
<?php if (!empty($error_msg)) { ?>
    <div class='alert form-alert alert-error'><p><?= $error_msg ?></p></div>
<?php } ?>

<div class="auth-form hold">
    <form class="dialog-form" method="post" action="<?= base_url(Merchant::MERCHANT_URL . '/login'); ?>">

        <input name="email" type="email" placeholder="you@example.com" required>
        <input name="password" type="password" placeholder="Password" required>
        <br/>
        <label class="checkbox" style="font-size:14px;">
            <input name="keep_logged_in" type="checkbox"> Remember me
        </label>
        <input type="submit" value="Sign in" class="btn btn-submit">
    </form>

    <ul class="clearfix reset-pass-register">
        <li class="left"><a href="<?= base_url(Merchant::MERCHANT_URL . '/signup'); ?>">Not member yet?</a>
        </li>
        <li class="right"><a href="<?= base_url(Merchant::MERCHANT_URL . '/forgot-password'); ?>">Forgot password</a>
        </li>
    </ul>
</div>