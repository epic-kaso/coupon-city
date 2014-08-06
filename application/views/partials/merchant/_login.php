<!-- LOGIN REGISTER LINKS CONTENT -->
<div
<?php if (!isset($echo_)) { ?>
        id="login-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix"

    <?php } ?>>
    <i class="icon-signin dialog-icon"></i>
    <h3>Member Login</h3>
    <h5>Welcome back, friend. Login to get started</h5>
    <div class="row-fluid">
        <form class="dialog-form" method="post" action="<?= base_url(Merchant::MERCHANT_URL . '/login'); ?>">
            <label>E-mail</label>
            <input name="email" type="text" placeholder="email@domain.com" class="span12">
            <label>Password</label>
            <input name="password" type="password" placeholder="My secret password" class="span12">
            <label class="checkbox">
                <input name="keep_logged_in" type="checkbox">Remember me
            </label>
            <input type="submit" value="Sign in" class="btn btn-primary">
        </form>
    </div>
    <ul class="dialog-alt-links">
        <li><a href="<?= base_url(Merchant::MERCHANT_URL . '/signup'); ?>">Not member yet</a>
        </li>
        <li><a class="popup-text" href="#password-recover-dialog" data-effect="mfp-zoom-out">Forgot password</a>
        </li>
    </ul>
</div>

<?= partial('partials/account/_forgot_password', array('user' => 'merchant')) ?>