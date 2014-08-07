<div class="mfp-dialog clearfix">
    <i class="icon-edit dialog-icon"></i>
    <h3>Change Password</h3>
    <div class="row-fluid">
        <form class="dialog-form" action="<?= $change_password_url ?>" method="post">
            <label>Email: <strong><?= @$email ?></strong></label>
            <input type="hidden" name="change_password" value="true" />
            <label>Password</label>
            <input type="password" placeholder="My secret password" name="password" class="span12">
            <label>Repeat Password</label>
            <input type="password" placeholder="Type your password again" name="re_password" class="span12">
            <label class="checkbox">
                <input type="checkbox">Accept terms and Condition
            </label>
            <input type="submit" value="Sign up" class="btn btn-primary">
        </form>
    </div>
</div>


