<div>
    <?php if (isset($url)) { ?>
        <?= partial('partials/account/_change_password', array('change_password_url' => @$url, 'email' => @$email)) ?>
    <?php } else if (!empty($message)) { ?>
        <div class='alert alert-success'>
            <p><?= $message ?></p>
            <a class="popup-text" href="#login-dialog" data-effect="mfp-move-from-top"><i class="icon-signin"></i>Sign in</a>
        </div>
    <?php } ?>

</div>