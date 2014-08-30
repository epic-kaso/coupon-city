@extends('layouts.merchant_dashboard')
@section('content')
<div class="merchant-body clearfix">
    <div class="hold _dash">
        <div class="clearfix export-header tagline-header">
            <h1 class="left">Dashboard</h1>

            <p>An overview of your Coupon City</p>

        </div>

        <div class="coupon-talk">
            <div class="segment-inner m-b">
                <p class="coupon-price-type">Need Help?</p>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus consequat, justo eu sodales mattis,
                    sem ligula mollis nunc, ut fringilla massa urna quis nunc.</p>

            </div>
        </div>

        <div class="clearfix">

            <div class="clearfix">
                <div class="today-details left m-b clearfix">
                    <h4>Today</h4>

                    <div class="wrap-center clearfix">
                        <div class="left sales-guage">
                        <!-- 'sales_today','sales_month','sales_all_time' -->
                            <canvas id="sales-guage"
                                    data-current-value="{{ $sales_today['redemption_count'] }}"
                                    data-max-value="{{ $sales_today['sales_count'] }}"
                                    style="width: 400px !important; height: 205px !important;"></canvas>

                            <span class="start left" style="margin-left: 10px;">{{ $sales_today['redemption_count'] }} <label>Redeem'd</label></span>
                            <span style="margin-left: -10px;">{{ percentage($sales_today['redemption_count'],$sales_today['sales_count']) }}</span>
                            <span class="end right">{{ $sales_today['sales_count'] }} <label>Sold</label></span>
                        </div>

                        <div class="left today-sale-numbers">
                            <ul>
                                <li>{{ $sales_today['view_count'] }} <span>Views</span></li>
                                <li>{{ $sales_today['sales_count'] }} <span>Coupons Sold</span></li>
                                <li>₦{{ $sales_today['sales_revenue'] }} <span>Amount Earned</span></li>
                                <li>₦{{ number_format($sales_today['sales_revenue']/$sales_today['sales_count'],2) }} <span>Average Sale</span></li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="coupon-details right m-b">
                    <h4>Top Performing Coupons</h4>

                    <div class="wrap-center">
                        @if(isset($top_performing) && !empty($top_performing))
                            @foreach($top_performing as $coupon)
                        <p><span class="trans-state verified-trans">{{ $coupon->sales->count() }}</span> <label>{{ $coupon->name }}</label></p>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="coupon-graph">
                <h4>Total Sales This Month</h4>

                <div id="chart-div"></div>
            </div>

            <div class="coupon-in-numbers m-b">
                <ul class="clearfix">
                    <li class="bbb">{{ $sales_month['view_count'] }} <span>Views</span></li>
                    <li>{{ $sales_month['sales_count'] }} <span>Coupons Sold</span></li>
                    <li>₦{{ $sales_month['sales_revenue'] }} <span>Amount Sold</span></li>
                    <li>₦{{ number_format($sales_month['sales_revenue']/$sales_month['sales_count'],2) }} <span>Average Sale</span></li>
                </ul>
            </div>

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
@stop
