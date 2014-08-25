@extends('layouts.home',['categories'=>$categories])
@section('content')

<div class="inner-pad">

    <div class="breadcrumb mb">
        <a href="" class="bread-home">Home</a>/
        <a href="">Food &amp; Drinks</a>/
        &nbsp;&nbsp;Ladies and Women Fashion
    </div>


    <div class="clearfix featured-category-deal mb">


        <section class="side-nav left">
            <h3>Categories</h3>
            <ul>
                @foreach($categories as $category)
                <li><a href="{{ URL::action('CouponListingController@getShow',['slug'=>$category->slug]) }}">{{$category->name}}
                        <span>({{ $category->coupons->count()}})</span></a></li>
                @endforeach
            </ul>
        </section>

        <div class="right">
            @if(isset($current_category))
            <h1 class="majors">{{ $current_category->name }}</h1>
            @endif

            @if(isset($featured_deal) && !is_null($featured_deal->coupon))
            <section class="category-deal-big">
                <div class="deal-img-big left">
                    <a href="{{ URL::action('CouponController@getShow',['slug'=>$featured_deal->coupon->slug]) }}"><img src="{{ $featured_deal->coupon->image_one->url() }}"></a>
                </div>

                <div class="deal-details-big right">
                    <p class="featured-tag"><span></span>Featured Deal</p>
                    <br/>

                    <h3>{{ $featured_deal->coupon->name }}</h3>

                    <p>{{ $featured_deal->coupon->tag_line }}</p>

                    <p class="main-detail">{{ $featured_deal->coupon->summary }}</p>

                    <span class="deal-location" title="Deal Location">{{ $featured_deal->coupon->location }}</span>

                    <ul class="">
                        <li class="normal-price">N{{ $featured_deal->coupon->present()->oldPrice }}</li>
                        <li class="discount-price clearfix">
                            <a href="">
                                <span class="tag">BUY <em></em></span>
                                <span>₦{{ $featured_deal->coupon->present()->current_price }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </section>
            @endif
        </div>

    </div>

    <section class="category-deals mb">

        <ul class="clearfix">

            @if(isset($current_category) && !is_null($current_category) && $current_category->coupons->count() > 0)
            @foreach($current_category->coupons as $coupon)

            <li>
                <a href="{{ URL::action('CouponController@getShow',['slug'=>$coupon->slug]) }}">
                    <div class="deal-img"><img src="{{ $coupon->image_one->url('medium') }}"></div>

                    <div class="deal-details">
                        <h3>{{ $coupon->name }}</h3>

                        <p>{{ $coupon->tag_line }}</p>

                        <span class="deal-location" title="Deal Location">{{ $coupon->location }}</span>

                        <ul class="">
                            <li class="normal-price">N{{ $coupon->present()->oldPrice }}</li>
                            <li class="discount-price clearfix">
                                <span class="tag">DEAL <em></em></span>
                                <span>₦{{ $coupon->present()->current_price }}</span>
                            </li>
                        </ul>
                    </div>
                </a>
            </li>

            @endforeach
            @endif
        </ul>
    </section>

    <div class="pager mb clearfix">
        <div class="right">
            <a href="" class="inactive">First</a>
            <a href="" class="inactive">Prev</a>
            <a href="" class="current-page">1</a>
            <a href="">2</a>
            <a href="">3</a>
            <a href="">Next</a>
            <a href="">Last</a>
        </div>
    </div>

</div>

</div>
@stop
