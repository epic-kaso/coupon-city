<?php
    if (!isset($active)) {
        $u = uri_string();
        $active = empty($u) ? 'home' : $u;
    }
?>

<div class="footer">
    <div class="center clearfix">
        <div class="footer-nav left">

            <div class="clearfix">
                <ul class="left">
                    <li><h3>HOME</h3></li>
                    <li <?= ($active === 'home') ? 'class="active"' : ''; ?>><a href="<?= base_url(); ?>">Home</a>
                    </li>
                    <li  <?= ($active === 'how-it-works') ? 'class="active"' : ''; ?>><a href="<?= base_url('how-it-works'); ?>">How it works</a>
                    </li>
                    <li <?= ($active === 'about') ? 'class="active"' : ''; ?>><a href="<?= base_url('about'); ?>">About us</a>
                    </li>
                    <li  <?= ($active === 'contact') ? 'class="active"' : ''; ?>><a href="<?= base_url('contact'); ?>">Contact</a>
                    </li>
                    <li  <?= ($active === 'help-faq') ? 'class="active"' : ''; ?>><a href="<?= base_url('help-faq'); ?>">Help & FAQ</a>
                    </li>
                </ul>

                <ul class="left">
                    <li><h3>EXPLORE</h3></li>
                    <li><a href="">About Us</a></li>
                    <li><a href="">Jobs</a></li>
                    <li><a href="">Help</a></li>
                    <li><a href="">How it works</a></li>
                    <li><a href="">Contact Us</a></li>
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

            <div class="payment-buttons"></div>

            <p class="footer-pitch">Get the best deals, heavy discounts and discover more fun stuff in your city. Our coupons cover your everyday purchases from gadgets to food, beauty treatments and others at unbelieveable prices.</p>

            <p class="copy">&copy; 2014 CouponCity, NG. All Rights Reserved.</p> 
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
</div><!--Footer close-->