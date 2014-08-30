@include('merchant.partials._header', array('title' => 'CouponCity Merchant Services | Drive customers to your business online and offline'))
<div class="merchant-landing-page">

    <div class="hero-banner">
        <div class="hero-touch2">
            <div class="hero-touch">
                <div class="_header center clearfix">
                    <div class="left">
                        <a href="" class="landing-logo"></a>
                        <a href="#intro">Why CouponCity</a>
                        <a href="#pricing">Pricing</a>
                        <a href="#merchant-contact-us">Contact Us</a>
                    </div>

                    <div class="right">
                        <a href="<?= URL::action('MerchantController@getLogin') ?>" class="btn login__">Login</a>
                        <a href="<?= URL::action('MerchantController@getSignUp') ?>" class="btn">Create Account</a>
                    </div>
                </div>

                <div class="center">
                    <h1>Get more customers to your business</h1>

                    <p>Drive lots of customers to your business both online and offline by offering discount coupons.
                        Use the tools included in our platform to measure, track and gain valuable insights on your
                        business. It's a win-win for everyone. </p>
                    <a href="<?= URL::action('MerchantController@getSignUp') ?>" class="btn-trans">Get Started Now</a>
                </div>
            </div>
        </div>
    </div>

    <div class="top-header top-banner-landing"></div>

    <div class="intro" id="intro">
        <ol class="center clearfix">
            <h1>Businesses sell more</h1>

            <p class="value-prop">Let's connect your to thousands of user willing to buy from trusted sellers offering
                amazing discounts. We sell an experience along with your goods and services that leaves your brand name
                in the mouth of customers.</p>

            <li class="left">
                <h2>More customers</h2>

                <p>We drive more customers to your door of which many would be repeat customers with potential of
                    sharing and dragging their friends along.</p>
            </li>

            <li class="left">
                <h2>More Money</h2>

                <p>We are all in business for the money and we are building a never ending source of revenue for your
                    business. You can only make money and make more of it.</p>
            </li>

            <li class="right">
                <h2>Better Insights</h2>

                <p>Understand your customers more with the tools on our platform which gives you access to insights and
                    performance data.</p>
            </li>

        </ol>
    </div>

    <div id="pricing" class="landing-pricing" style="background:#0f75bc;color:#fff;">
        <div class="center">
            <h1>PRICING</h1>

            <div class="price-block">
                <h2><span>₦</span>0</h2>
                <span class="free-price">100% FREE!</span>
            </div>

            <p>There is no sign on fee. We only make money when you sell. We are commited to being open. Our margins are
                small, you won't even notice.</p>
        </div>
    </div>

    <div class="landing-us" id="merchant-contact-us">
        <div class="center">
            <br/>

            <h1>Business is fun. Drive sales. Make money</h1>

            <a href="<?= URL::action('MerchantController@getSignUp') ?>" class="btn-trans">Get Started Now</a>

            <p><strong>Phone:</strong> 07012345678</p>

            <p><strong>Email:</strong> merchant@couponcity.ng</p>

            <p><strong>Support Service:</strong> support@couponcity.ng</p>
        </div>
    </div>

    <div class="landing-footer">
        <div class="center">
            &copy; 2014 Couponcity, NG.
            <a href="">Terms</a>
            <a href="">Privacy</a>
            <a href="<?= URL::action('HomeController@getHelpFaq') ?>">Help</a>
            <a href="<?= URL::action('HomeController@getContact') ?>">Contact</a>
        </div>
    </div>
</div>

<!--Analytics/ JS files -->


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?= URL::asset('js/jquery.js') ?>"><\/script>')</script>

<script src="<?= URL::asset('js/basic.js') ?>"></script>
<script src="<?= URL::asset('js/modal.js') ?>"></script>
<script src="<?= URL::asset('js/waypoints.js') ?>"></script>
<script src="<?= URL::asset('js/plugin.min.js') ?>"></script>
<script src="<?= URL::asset('js/countdown.min.js') ?>"></script>
<script src="<?= URL::asset('js/main.js') ?>"></script>

</body>
</html>