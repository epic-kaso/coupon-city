</div>

<div class="footer">
    <div class="center clearfix">
        <div class="footer-nav left">

            <div class="clearfix">
                <ul class="left">
                    <li><h3>HOME</h3></li>
                    <li><a href="{{ URL::action('HomeController@getAbout') }}">About Us</a></li>
                    <li><a href="{{ URL::action('HomeController@getHelpFaq') }}">Help</a></li>
                    <li><a href="{{ URL::action('HomeController@getHowItWorks') }}">How it works</a></li>
                    <li><a href="{{ URL::action('HomeController@getContact') }}">Contact Us</a></li>
                </ul>

                <ul class="left">
                    <li><h3>EXPLORE</h3></li>
                    <li><a href="{{ URL::action('HomeController@getAbout') }}">About Us</a></li>
                    <li><a href="{{ URL::action('HomeController@getHelpFaq') }}">Help</a></li>
                    <li><a href="{{ URL::action('HomeController@getHowItWorks') }}">How it works</a></li>
                    <li><a href="{{ URL::action('HomeController@getContact') }}">Contact Us</a></li>
                </ul>

                <ul class="left">
                    <li><h3>INFORMATION</h3></li>
                    <li><a href="">Terms of use</a></li>
                    <li><a href="">Discounts</a></li>
                    <li><a href="">How it works</a></li>
                    <li><a href="">Help</a></li>
                    <li><a href="">Privacy</a></li>
                </ul>
            </div>

            <div class="payment-buttons">

            </div>

            <p class="footer-pitch">Get the best deals and discounts and discover more fun stuff in your city. Our deals
                cover your everyday purchases from gadgets to groceries, beauty treatments and others at unbelieveable
                prices.</p>

            <p class="copy">&copy; 2013 CouponCity, NG. All Rights Reserved.</p>
        </div>

        <div class="footer-social right">
            <div class="mobile-redeem">
                <div class="phone"></div>
                <h2>Redeem on your mobile</h2>

                <p>Buy and redeem your deals from your mobile. No need to print anything.</p>
            </div>

            <ol class="clearfix">
                <li class="gplus"><a href=""></a></li>
                <li class="twitr"><a href=""></a></li>
                <li class="facebk"><a href=""></a></li>
            </ol>

        </div>

    </div>
</div>


<!--Login/Register-->

<div class="login-register">

    <!--Login-->
    <div id="login" class="login-form">
        <div class="login-reg-logo"></div>

        <h2>Login to your account</h2>

        <p>Welcome Back to CouponCity</p>

        <a href="{{ $fb_url or '' }}" class="social-login"><span></span> Sign in with facebook</a>

        <p class="divide"></p>

        {{ Form::open(['url' => URL::action('UserController@postLogin')]) }}
        {{ Form::email('email', '', ['placeholder' => 'Email']) }}
        {{ Form::password('password', '', ['placeholder' => 'Password']) }}

        <p class="checkbox-reg"><input type="checkbox" name="remember_me"> Remember me</p>
        <input type="submit" value="Login" class="text-button">
        {{ Form::close() }}

        <ul class="clearfix">
            <li class="left register">Not a member? <a href="#register">Register</a></li>
            <li class="right forgot"><a href="#forgot">Forgot password?</a></li>
        </ul>
    </div>

    <!--Register-->
    <div id="register" class="register-form">
        <div class="login-reg-logo"></div>

        <h2>Register with CouponCity</h2>

        <p>Get deals covering your everyday purchases from gadgets to groceries, beauty and others at unbelieveable
            prices.</p>

        <a href="{{ $fb_url or '' }}" class="social-login"><span></span> Sign in with facebook</a>

        <p class="divide"></p>

        {{ Form::open(['url' => URL::action('UserController@postSignUp')]) }}
        {{ Form::email('email', '', ['placeholder' => 'Email']) }}
        {{ Form::password('password', '', ['placeholder' => 'Password']) }}
        {{ Form::password('password_confirmation', '', ['placeholder' => 'Confirm Password']) }}

        <p class="sara">By clicking "Register" you accept our <a href="">Terms of Use</a> and <a href="">Privacy
                Policy</a>.</p>

        <input type="submit" value="Register" class="text-button">
        {{ Form::close() }}

        <ul>
            <li class="login">Already a member? <a href="#login">Login</a></li>
        </ul>


    </div>

    <!--Forgot Password-->
    <div id="forgot" class="reset-password">
        <div class="login-reg-logo"></div>

        <h2>Forgot Your Password?</h2>

        <p>Please enter your email address below and we will send you an email to confirm your password.</p>

        <form action="{{ action('RemindersController@postRemind') }}" method="POST">
            <input type="email" name="email" placeholder="Email address">
            <input type="submit" value="Reset Password" class="text-button">
        </form>

        <ul class="clearfix">
            <li class="left register">Not a member? <a href="#register">Register</a></li>
            <li class="right login"><a href="#login">Login</a></li>
        </ul>
    </div>

</div>
<!--Login - Register ends-->
<div id="price-details">
    <div class="funds-holder">

        <h2>Price Details</h2>

        <p class="price-details-deal">Amala, ewedu with goat meat.</p>

        <div>
            <p>If certain number of coupons are sold, the corresponding price would apply to all coupons no matter when
                you bought it.</p>

            <h2 class="current-price">Current Price: N200</h2>

            <ul>
                <li class="header_">
                    <label>No of Coupons</label>
                    <label>Price</label>
                </li>
                <li>
                    <label>100 Coupons</label>
                    N300
                </li>
                <li>
                    <label>200 Coupons</label>
                    N200
                </li>
                <li>
                    <label>300 Coupons</label>
                    N100
                </li>
            </ul>

            <p><strong>Our advice:</strong> Share this coupon with your friends.</p>

        </div>

    </div>
</div>


</div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="{{ URL::asset('js/jquery.js') }}"><\/script>')</script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
<script src="{{ URL::asset('js/basic.js') }}"></script>
<script src="{{ URL::asset('js/modal.js') }}"></script>
<script src="{{ URL::asset('js/gauge.js') }}"></script>
<script src="{{ URL::asset('js/waypoints.min.js') }}"></script>
<script src="{{ URL::asset('js/plugin.min.js') }}"></script>
<script src="{{ URL::asset('js/countdown.min.js') }}"></script>
<script src="{{ URL::asset('js/main.js') }}"></script>

</body>
</html>

