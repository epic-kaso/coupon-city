
<!--Forgot Password-->

<div id="forgot" class="reset-password">

    <h2>Forgot Your Password?</h2>
    <p>Please enter your email address below and we will send you an email to confirm your password.</p>

    <form class="dialog-form" action="<?= base_url($user . '/forgot-password') ?>" method="post">
        <input type="text" name="email" placeholder="me@example.com">
        <input type="submit" value="Reset Password" class="text-button">
    </form>

    <ul class="clearfix">
        <li class="left register">Not a member? <a href="#register">Register</a></li>
        <li class="right login"><a href="#login">Login</a></li>
    </ul>
</div>