<div

    <?php if (!isset($echo_)) { ?>
        id="register-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix"
    <?php } ?>>
    <i class="icon-edit dialog-icon"></i>
    <h3>Member Register</h3>
    <h5>Ready to get best offers? Let's get started!</h5>
    <div class="row-fluid">
        <form class="dialog-form" method="post" action="<?= base_url(Merchant::MERCHANT_URL . '/signup'); ?>">
            <label>E-mail</label>
            <input name="email" type="text" placeholder="email@domain.com" class="span12">
            <label>Password</label>
            <input name="password" type="password" placeholder="My secret password" class="span12">
            <label>Repeat Password</label>
            <input name="re_password" type="password" placeholder="Type your password again" class="span12">
            <label>Your Area</label>
            <input name="area" type="text" placeholder="Lekki" class="span12">
            <label class="checkbox">
                <input type="checkbox">Accept terms and Condition
            </label>
            <input type="submit" value="Sign up" class="btn btn-primary">
        </form>
    </div>
    <?php if (!isset($echo_)) { ?>
        <ul class="dialog-alt-links">
            <li><a class="popup-text" href="#login-dialog" data-effect="mfp-zoom-out">Already member</a>
            </li>
        </ul>
    <?php } ?>
</div>