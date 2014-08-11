<div class="mfp-dialog clearfix">

    <h2>Change Your Password?</h2>
    <p><strong>Email:</strong><?= @$email ?></p>

    <form class="dialog-form" action="<?= $change_password_url ?>" method="post">
        <input type="hidden" name="change_password" value="true" />

        <input type="password" placeholder="Password" name="password">

        <input type="password" placeholder="Confirm Password" name="re_password">

        <input type="submit" value="Change Password" class="text-button">
    </form>

    <ul class="clearfix">
        <li class="left register">Not a member? <a href="#register">Register</a></li>
        <li class="right login"><a href="#login">Login</a></li>
    </ul>
</div>