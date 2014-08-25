@extends('layouts.merchant_dashboard')
@section('content')
<div class="merchant-body left clearfix" ng-controller="VerifyCouponController">

    <div class="hold right">
        <h1>Redeem Coupon</h1>

        <form ng-submit="verify_coupon(coupon, $event)">
            <input name="coupon_code" type="text" placeholder="Coupon Code ex. 1234567" ng-model='coupon.coupon_code'
                   required/>
            <input type="submit" ng-click="verify_coupon(coupon, $event)" ng-value="is_working ? 'Working....':'Verify'"
                   class="btn btn-submit btn-small"/>
        </form>
    </div>
</div>


<div class="merchant-body right">
    <div class="hold">
        <h2>Redeem Coupon</h2>

        <p>Verify and redeem coupons for customers who show up at your business. This feature is available on mobile so
            you can redeem on the go if you run a service business.</p>
    </div>
</div>
@stop