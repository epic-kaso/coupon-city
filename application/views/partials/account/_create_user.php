
<!--Register-->
<div id="register" class="register-form">

    <h2>Register with CouponCity</h2>
    <p>Get deals covering your everyday purchases from gadgets to groceries, beauty and others at unbelieveable prices.</p>

    <a href="" class="social-login"><span></span> Sign in with facebook</a>

    <p class="divide"></p>

    <form action="<?= base_url('signup') ?>" method="post">
        <input type="hidden" name="redirect" value="<?= current_url(); ?>" />

        <input type="text" name="email" placeholder="me@example.com">
        <input type="password" placeholder="Password" name="password" class="span12">
        <input type="password" placeholder="Confirm Password" name="re_password">

        <p class="sara">By clicking "Register" you accept our <a href="">Terms of Use</a> and <a href="">Privacy Policy</a>.</p>

        <input type="submit" value="Register" class="text-button">
    </form>

    <ul>
        <li class="login">Already a member? <a href="#login">Login</a></li>
    </ul>

    
</div>