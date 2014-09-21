@extends('layouts.merchant_dashboard')
@section('content')
<div class="merchant-body left clearfix">
    <div class="hold right">
        <div class="clearfix export-header tagline-header">
            <h1 class="left">{{ $coupon->name }}</h1>
            <a href="{{ URL::action('CouponController@getIndex',['slug'=>$coupon->slug]) }}" class="export right btn">View Deal</a>

            <p>{{ $coupon->tag_line }}</p>

        </div>

        <div class="clearfix">

            <div class="clearfix">
                <div class="today-details left m-b clearfix">
                    <h4>Today</h4>

                    <div class="wrap-center clearfix">
                        <div class="left sales-guage">

                            <canvas id="sales-guage"
                                    data-current-value="{{ $coupon->present()->redemption_all_time }}"
                                    data-max-value="{{ $coupon->present()->sales_all_time }}">

                                    </canvas>

                            <span class="start left">{{ $coupon->present()->redemption_all_time }}<label>Redeem'd</label></span>
                            <span style="margin-left: -21px;">{{ $coupon->present()->redemption_all_time_percentage }}</span>
                            <span class="end right">{{ $coupon->present()->sales_all_time }} <label>Sold</label></span>
                        </div>

                        <div class="left today-sale-numbers">
                            <ul>
                                <li>{{ $coupon->present()->views_today }}<span>Views</span></li>
                                <li>{{ $coupon->present()->sales_today }} <span>Coupons Sold</span></li>
                                <li>₦{{ $coupon->present()->earnings_today }} <span>Amount Earned</span></li>
                                <li>₦{{ $coupon->present()->average_sales_today }} <span>Average Sale</span></li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="coupon-details right m-b">
                    <h4>At a Glance</h4>

                    <div class="wrap-center">
                        <p><label>Deal status: </label>{{ $coupon->present()->status }}</p>

                        <p><label>Sales cap: </label> {{ $coupon->quantity }}</p>

                        <p><label>Launch date:</label> {{ relative_time($coupon->start_date) }}</p>

                        <p><label>End date:</label> {{ relative_time($coupon->end_date) }}</p>

                        <p><label>Market:</label> {{ $coupon->location }}</p>
                    </div>
                </div>
            </div>

            <div class="coupon-graph">
                <h4>Sales This Month</h4>

                <div id="chart-div"></div>
            </div>

            <div class="coupon-in-numbers m-b">
                <ul class="clearfix">
                    <li class="bbb">{{ $coupon->present()->views_month }} <span>Views</span></li>
                    <li>{{ $coupon->present()->sales_month }} <span>Coupons Sold</span></li>
                    <li>₦{{ $coupon->present()->earnings_month }} <span>Amount Sold</span></li>
                    <li>₦{{ $coupon->present()->average_sales_month }} <span>Average Sale</span></li>
                </ul>
            </div>

            <div class="coupon-talk">

                <p class="view-price"><label>Old Price:</label> ₦{{ $coupon->present()->oldPrice }}</p>

                @if($coupon->is_advanced_pricing)
                <div class="segment-inner">
                    <p class="coupon-price-type">This coupon uses Advanced Pricing.</p>

                    <table>

                        <tr>
                            <td>100 Coupons</td>
                            <td>&raquo;</td>
                            <td>28% Discount</td>
                            <td>&raquo;</td>
                            <td class="_coupon-price">₦300</td>
                        </tr>

                        <tr>
                            <td>200 Coupons</td>
                            <td>&raquo;</td>
                            <td>30% Discount</td>
                            <td>&raquo;</td>
                            <td class="_coupon-price">₦200</td>
                        </tr>

                        <tr>
                            <td>300 Coupons</td>
                            <td>&raquo;</td>
                            <td>35% Discount</td>
                            <td>&raquo;</td>
                            <td class="_coupon-price">₦100</td>
                        </tr>
                    </table>

                </div>
                @else
                <div class="segment-inner">
                    <p class="coupon-price-type">This coupon uses Basic Pricing.</p>

                    <table>

                        <tr>
                            <td>{{ $coupon->discount }}% Discount</td>
                            <td>&raquo;</td>
                            <td class="_coupon-price">₦ {{ $coupon->present()->basicNewPrice }}</td>
                        </tr>
                    </table>

                </div>
                @endif
                <ul class="cou">
                    <li>
                        <label>Short Description</label>

                        <p>{{ $coupon->summary }}</p>
                    </li>

                    <li>
                        <label>Details</label>

                        <p>{{ $coupon->description }}</p>
                    </li>

                    <li>
                        <label>Images</label>
                        <ul class="images-preview clearfix">
                            <li><img src="{{ $coupon->image_one->url('thumb') }}"></li>
                            <li><img src="{{ $coupon->image_two->url('thumb') }}"></li>
                            <li><img src="{{ $coupon->image_three->url('thumb') }}"></li>
                            <li><img src="{{ $coupon->image_four->url('thumb') }}"></li>
                            <li><img src="{{ $coupon->image_five->url('thumb') }}"></li>
                        </ul>
                    </li>
                </ul>


            </div>

            <br/>
            <br/>

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
        <h2>Coupon Details</h2>

        <p>We payout your cumulative sales amount every Wednesday excluding weekends.</p>

        <p>Let us know if your require any special needs as regards our deposit schedule and we'll be sure to adjust. We
            are trying hard to make deposits happen on next business day for previous day sales.</p>
    </div>
</div>
@stop