<div class="merchant-body clearfix">

    <div class="hold _dash">
        <div class="auth-closure">
            <h1>Change your Password</h1>

            <p class="auth-tagline">Not comfortable with your current password? We've got your back. Change it here.</p>
        </div>

        <?php if (!empty($success_msg)) { ?>
            <div class='alert form-alert alert-success'><p><?= $success_msg ?></p></div>
        <?php } ?>
        <?php if (!empty($error_msg)) { ?>
            <div class='alert form-alert alert-error'><p><?= $error_msg ?></p></div>
        <?php } ?>

        <div class="auth-form hold">
            <form class="dialog-form" action="<?= base_url('merchant/change_password'); ?>" method="post">

                <input type="hidden" name="redirect" value="<?= str_replace('index.php', '', current_url()); ?>"/>

                <input name="password" type="password" placeholder="New Password" required>
                <input name="re_password" type="password" placeholder="Confirm New Password" required>

                <input type="submit" value="Change Password" class="btn btn-submit">
            </form>

        </div>
    </div>

    <?php
        echo partial('partials/_merchant_footer', array('year' => time('y')));
    ?>
</div>
