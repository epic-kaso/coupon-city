@extends('layouts.merchant_dashboard')
@section('content')


<div class="merchant-body left clearfix" ng-controller="VerifyCouponController">

    <div class="hold right">
        <h1>Redeem Coupon</h1>

        <?= Form::open(['url' => action('MerchantDashboardController@postRedeemCoupon'), 'data-remote', 'data-remote-success-message' => 'Coupon Successfully Redeemed!']) ?>
        <input name="coupon_code" type="text" placeholder="Coupon Code ex. 1234567" required/>
        <input type="submit" class="btn btn-submit btn-small" data-success-message='Coupon Redeemed Successfully!'/>
        <?= Form::close() ?>

        @include('partials._infos')
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