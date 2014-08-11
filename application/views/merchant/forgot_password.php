<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="offset3 span6">
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
                <i class="icon-retweet dialog-icon"></i>
                <h3>Password Recovery</h3>
                <h5>Forgot your password? Don't worry we can deal with it</h5>
                <div class="row-fluid">
                    <form class="dialog-form" action="<?= base_url('merchant/forgot-password') ?>" method="post">
                        <label>E-mail</label>
                        <input type="text" name="email" placeholder="email@domain.com" class="span12">
                        <input type="submit" value="Request new password" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>