@extends('layouts.home',['categories'=>$categories])
@section('content')

<div class="inner-pad">
    <ul class="coupon-promise clearfix mb">
        <li><a href="">Free shipping on deliveries</a></li>
        <li><a href="">Why we use Wallets</a></li>
        <li><a href="">Why you'll love us</a></li>
    </ul>

    <div class="how-works mb"></div>


    <div class="featured-deal clearfix mb">
        <div class="left slide-list-vert">
            <ul>
                @if(!empty($featured))
                @foreach($featured as $item)
                <li>
                    <div class="list-img">
                        <img src="{{ $item->image_one->url('thumb') }}">
                    </div>

                    <div class="right">
                        <h3>{{ $item->name }}</h3>

                        <p>{{ $item->tag_line }}</p>
                        <a href="{{ URL::action('CouponController@getIndex',['slug'=>$item->slug]) }}">See Deal</a>
                    </div>
                </li>
                @endforeach
                @endif
            </ul>
        </div>

        <div class="right actual-slider">
            <ul class="bjqs">
                @if(!empty($featured))
                @foreach($featured as $item)
                <li>
                    <a href="{{ URL::action('CouponController@getIndex',['slug'=>$item->slug]) }}"
                       title="{{ $item->name }}"><img src="{{ $item->image_one->url() }}"></a>
                </li>
                @endforeach
                @endif
            </ul>
        </div>
    </div>

    <div class="special-feature mb clearfix">
        <div class="feature-one left"></div>
        <div class="feature-two right"></div>
    </div>

    @if(!empty($snippet))
    @foreach($snippet as $section)
    @if(count($section->coupons) > 0)
    <section class="category-deals mb">
        <h2>{{ $section->name }}<a href="{{ URL::action('CouponListingController@getShow',['slug'=>$section->slug]) }}">View
                all &raquo;</a></h2>
        <ul class="clearfix">
            @foreach($section->coupons as $coupon)
            <li>
                <a href="{{ URL::action('CouponController@getIndex',['slug'=>$coupon->slug]) }}">
                    <div class="deal-img"><img src="{{ $coupon->image_one->url('medium') }}"></div>

                    <div class="deal-details">
                        <h3>{{ $coupon->name }}</h3>

                        <p>{{ $coupon->tag_line }}</p>

                        <span class="deal-location" title="Deal Location">{{ $coupon->location }}</span>

                        <ul class="">
                            <li class="normal-price">N{{ $coupon->old_price }}</li>
                            <li class="discount-price clearfix">
                                <span class="tag">DEAL <em></em></span>
                                <span>₦{{ $coupon->present()->current_price }}</span>
                            </li>
                        </ul>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </section>
    @endif
    @endforeach
    @endif

    <div class="featured-merchants clearfix mb">
        <h2 class="majors">Featured Merchants</h2>
        <br/>
        <ul>
            <li><img src="img/merchant-dummy.png"></li>
            <li><img src="img/dummy-merchant.png"></li>
            <li><img src="img/merchant-dummy.png"></li>
            <li><img src="img/dummy-merchant.png"></li>
            <li><img src="img/merchant-dummy.png"></li>
        </ul>
    </div>

</div>

</div><!--container end-->
@stop