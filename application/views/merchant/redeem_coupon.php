
<div class="merchant-body left clearfix" ng-controller="VerifyCouponController">

    <div class="hold right">
        <h1>Redeem Coupon</h1>

        <div class='text-center'>
            <span ng-show="is_success">
                <p class='alert alert-success'  ng-bind="message"></p>
                <button class="btn btn-success pull-right">Click For Details</button>
            </span>
            <span ng-show="is_failure">
                <p class='alert alert-error'  ng-bind="message"></p>
                <button class="btn btn-success pull-right" ng-click="reset_params();">Dismiss</button>
            </span>
            <p class="alert alert-info" ng-show='is_working'>Working....</p>
        </div>
        <form method='post' action="#">
            <input required name="coupon_code" type="text" placeholder="Coupon Code ex. 1234567" ng-model='coupon.coupon_code'>
            <input type="submit" ng-click="verify_coupon(coupon, $event)" ng-value="is_working ? 'Working....':'Verify'" class="btn btn-primary">
        </form>

    </div>
    <?php
    echo partial('partials/_merchant_footer', array('year' => time('y')));
    ?>
</div>


<div class="merchant-body right">
    <div class="hold">
        <h2>Redeem Coupons</h2>
        <p>Verify and redeem coupons for customers who show up at your business. This feature is available on mobile so you can redeem on the go if you run a service business.</p>
    </div>
</div>
