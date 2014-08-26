@extends('layouts.home',['categories'=>$categories])
@section('content')

<div class="inner-pad clearfix">
<div class="breadcrumb mb">
    <a href="" class="bread-home">Home</a>/
    <a href="">Categories</a>/
    <a href="">Food &amp; Drinks</a>/
    &nbsp;&nbsp;Ladies and Women Fashion
</div>


<section class="deal clearfix mb">
    <div class="mb">
        <h1 class="majors">{{ $coupon->name }}</h1>

        <p class="deal-tagline">{{ $coupon->tag_line }}</p>
    </div>
    <br/>

    <div class="left details-of-deal">
        <div class="deal-pictures-wrap">

            <div class="deal-pictures"></div>

            <ul class="thumbnails clearfix">
                <li><a href=""><img src="{{ $coupon->image_one->url() }}"></a></li>
                <li><a href=""><img src="{{ $coupon->image_two->url() }}"></a></li>
                <li><a href=""><img src="{{ $coupon->image_three->url() }}"></a></li>
                <li><a href=""><img src="{{ $coupon->image_four->url() }}"></a></li>
            </ul>
        </div>

        <h2 class="majors" style="margin-top: 50px;">What you should know</h2>

        <p>Expires 90 days after purchase. Limit 1 per person, may buy 2 additional as gifts. Limit 1 per table. Limit 1
            per visit. Valid only for option purchased. Reservation recommended. Dine-in only. Valid only for dinner.
            Must purchase 1 food item. Must use promotional value in 1 visit. Not valid on 2/14-2/16. Not valid on
            holidays, including Easter and Mother's Day.</p>
    </div>

    <div class="right buy">
        @if(isset($user_owns_coupon) && $user_owns_coupon)
            <a href="" class="deal-button clearfix">
                <span>You Own this Coupon</span>
            </a>
        @elseif($coupon->is_available())

            <?= Form::open(['url'=>action('CouponController@postGrabCoupon',
                ['id'=>$coupon->id]),'data-remote','data-remote-success-message'=>'Successfully added coupon']) ?>
                <?= Form::submit("Buy ₦{$coupon->present()->current_price}",
                    ['class'=>'deal-button clearfix','data-success-message'=>'You Own this Coupon'])?>
            <?= Form::close()?>
        @else
            <a href="" class="deal-button clearfix">
                <span>Out of Stock</span>
            </a>
        @endif


        @if($coupon->is_advanced_pricing)
        <a href="" class="price-details">Price Details <span>&#x25BC;</span></a>
        @endif
        <div class="border">
            <ul class="price-discount-save clearfix">
                <li>Value <span>₦{{ $coupon->present()->oldPrice }}</span></li>
                <li>Discount <span>{{ $coupon->discount }}%<span></li>
                <li>Savings <span>₦{{ $coupon->old_price - $coupon->present()->current_price }}</span></li>
            </ul>

            <a href="" class="gift-button"><span></span>Gift this deal</a>

            <div class="little-detail clearfix">
                <li class="no-sold">{{ $coupon->sales->count() }} Sold</li>
                <li class="delivery-avail right">Free Delivery</li>
            </div>
        </div>

        <p class="time-left"></p>

        <p class="deadline hidden">{{ $coupon->end_date }}</p>

        <fieldset class="share-button">
            <legend>Share this Deal</legend>

            <ul class="clearfix share-buttons">
                <li class="facebk"><a href=""></a></li>
                <li class="twitr"><a href=""></a></li>
                <li class="share-mail"><a href=""></a></li>
                <li class="likeBtn"><img src="{{ URL::asset('img/dummy-fb.png') }}"></li>
            </ul>
        </fieldset>

    </div>

</section>
<br/>

<div class="clearfix">
    <section class="left details-mobile mb">
        <div class="details-deal mbs">
            <h2 class="majors">The Details</h2>

            <p>
                {{ $coupon->description }}
            </p>
            <br>

            <h2 class="majors">The Business</h2>

            <p>{{ $coupon->summary }}</p>
        </div>

        <div class="redeem-mobile mb clearfix">
            <h2 class="majors">Redeem with your mobile</h2>

            <div class="big-phone left"></div>

            <div class="how-to-redeem right">

                <ol>
                    <li>Buy any deal that you like</li>
                    <li>Go to "My Deals" find the deal that you want to redeem</li>
                    <li>Show your screen at the time of purchase. No need to print.</li>
                </ol>

                <p>*Just in case you don't have a phone, you can redeem your offer by printing out your voucher or
                    presenting your reference number at the deal location. Help save the planet.</p>
            </div>

        </div>
    </section>

    <section class="right business-related mb">

        <div class="deal-business mbs">
            <div class="maps"><img src="{{URL::asset('img/maps.jpg') }}"></div>

            <h2>{{ $coupon->merchant->business_name }}</h2>

            <p>{{ $coupon->merchant->short_description }}</p>

            <ul>
                <li><span>Address:</span>{{ $coupon->merchant->address_one.",". $coupon->merchant->city }}</li>
                <li><span>Phone no:</span> {{ $coupon->merchant->mobile_number }}</li>
                <li><span>Menu:</span> See Website</li>
                <li><span>Opening Days:</span>{{ $coupon->merchant->opening_hours }}</li>
                <li><span>Website:</span> <a href="">{{ $coupon->merchant->website }}</a></li>
            </ul>
        </div>

    </section>
</div>
<!--End of sections-->

<div class="related-deals mb"><!--Related deals-->
    <?php $related_deals = $coupon->related(); ?>

    @if($related_deals->count() > 0)
    <h2 class="majors">Related Deals</h2>

    <ul class="clearfix">
        @foreach($related_deals as $deal)
        <li>
            <a href="{{ URL::action('CouponController@getShow',['slug'=>$deal->slug]) }}">
                <div class="deal-img"><img src="{{ $deal->image_one->url('thumb') }}"></div>

                <div class="deal-details">
                    <h3>{{ $deal->name }}</h3>

                    <p>{{ $deal->tag_line }}</p>

                    <span class="deal-location" title="Deal Location">{{ $deal->location }}</span>

                    <ul class="">
                        <li class="normal-price">N{{ $deal->present()->oldPrice }}</li>
                        <li class="discount-price clearfix">
                            <span class="tag">DEAL <em></em></span>
                            <span>₦{{ $deal->present()->current_price }}</span>
                        </li>
                    </ul>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
    @endif
</div>
<!--End related deals-->

</div>

</div>
@stop