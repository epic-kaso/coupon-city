@extends('layouts.merchant_dashboard')
@section('content')

<div class="merchant-body left clearfix">
    <div class="hold right">
        <div class="clearfix export-header">
            <h1 class="left">My Coupons</h1>
            <a href="<?= URL::action('MerchantDashboardController@getAddCoupon') ?>" class="btn right export">Add
                Coupon</a>
        </div>

        <div class="cart-order tableau segment">

            <ul class="stats-summ clearfix">
                <li>{{ $coupon_sales['count'] }} <span>Total Coupons Sold</span></li>
                <li>₦{{ $coupon_sales['sales'] }} <span>In Total Sales</span></li>
                <li>₦{{ $coupon_sales['sales'] }}<span>Net Sales</span></li>
            </ul>
            @if(!isset($items) || empty($items))
            <div class="if-no-deal">
                <div class="no-deal no-coupons"></div>
                <p>You currently have no Coupons</p>

                <p>Give discounts and drive customers to your business. We are here to help you. <a href="">Start
                        here</a></p>
            </div>
            @else
            <table>
                <tr>
                    <th>Date</th>
                    <th>ID</th>
                    <th>Coupon Name</th>
                    <th>State</th>
                </tr>
                @foreach ($items as $coupon)
                <tr>
                    <td>{{ $coupon->present()->creation_date }}</td>
                    <td>{{ $coupon->coupon_code }}</td>
                    <td class="align-left">
                        <a href="{{ URL::action('MerchantDashboardController@getCoupon',['slug'=>$coupon->slug]) }}">
                            {{ $coupon->name }}</a>
                    </td>
                    <td>
                        {{ $coupon->present()->status }}
                    </td>
                </tr>
                @endforeach
            </table>
            @endif
        </div>

    </div>

    <div class="merchant-footer">
        <div class="center">
            &copy; 2014 Couponcity.
            <a href="">Terms</a>
            <a href="">Privacy</a>
            <a href="">Legal</a>
            <a href="">Help</a>
        </div>
    </div>

</div>

<div class="merchant-body right">
    <div class="hold">
        <h2>Your Coupons</h2>

        <p>All details of your coupons are available here. See every detail and access statistical data generated once
            your discounted deals are live.</p>
    </div>
</div>

@stop