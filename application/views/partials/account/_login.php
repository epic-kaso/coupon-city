
<div ng-controller="LoginController" id="login" class="login-form">

    <h2>Login to your account</h2>
    <p>Welcome Back to CouponCity</p>

    <a href="" class="social-login"><span></span> Sign in with facebook</a>



    <p class="divide"></p>

    <form action="<?= base_url('login'); ?>" method="post">
        <input type="hidden" name="redirect" value="<?= str_replace('index.php', '', current_url()); ?>" />
        <input name="email" type="text" placeholder="me@example.com">
        <input name="password" type="password" placeholder="Password">
        <p class="checkbox-reg"><input type="checkbox"> Remember me</p>
        <input type="submit" value="Login" class="text-button">
    </form>

    <ul class="clearfix">
        <li class="left register">Not a member? <a href="#register">Register</a></li>
        <li class="right forgot"><a href="#forgot">Forgot password?</a></li>
    </ul>
</div>

