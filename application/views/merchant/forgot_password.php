
<div class="auth-closure">
    <h1>Reset Password</h1>
    <p class="auth-tagline">Enter your email address and check your inbox for reset instructions.</p>
</div>

<?php if (!empty($success_msg)) { ?>
    <div class='alert form-alert alert-success'><p><?= $success_msg ?></p></div>
<?php } ?>
<?php if (!empty($error_msg)) { ?>
    <div class='alert form-alert alert-error'><p><?= $error_msg ?></p></div>
<?php } ?>

<div class="auth-form hold">

    <form class="dialog-form" action="<?= base_url('merchant/forgot-password') ?>" method="post">
        <input type="email" name="email" placeholder="you@example.com" class="span12">
        <input type="submit" value="Reset Password" class="btn btn-submit">
    </form>

    <ul class="clearfix reset-pass-register">
        <li class="right"><a href="<?= base_url(Merchant::MERCHANT_URL . '/signup'); ?>">Not member yet? Register</a>
        </li>
        <li class="left"><a href="<?= base_url(Merchant::MERCHANT_URL . '/login'); ?>">Login</a>
        </li>
    </ul>

</div>