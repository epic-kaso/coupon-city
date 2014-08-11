<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="offset3 span6">
            <div class="alert-error">
                <?php echo validation_errors(); ?>
            </div>
            <?php if (!empty($success_msg)) { ?>
                <div class='alert alert-success'><p><?= $success_msg ?></p></div>
            <?php } ?>
            <?php if (!empty($error_msg)) { ?>
                <div class='alert alert-error'><p><?= $error_msg ?></p></div>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="offset4 span4" style="margin-top: 10px;">
            <div>
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
                    <li><a href="<?= base_url(Merchant::MERCHANT_URL . '/forgot-password'); ?>">Forgot password</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>