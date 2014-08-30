@extends('layouts.home',['categories'=>$categories])
@section('content')
    <div class="clearfix mb">
        <h2>Search Result for: {{ $search_phrase }}</h2>
    </div>

    <section class="category-deals mb">

        <ul class="clearfix">

            @if(isset($search_result) && !empty($search_result) && $search_result->count() > 0)
            @foreach($search_result as $coupon)

            <li>
                <a href="{{ URL::action('CouponController@getIndex',['slug'=>$coupon->slug]) }}">
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
<!--            <a href="" class="inactive">First</a>-->
<!--            <a href="" class="inactive">Prev</a>-->
<!--            <a href="" class="current-page">1</a>-->
<!--            <a href="">2</a>-->
<!--            <a href="">3</a>-->
<!--            <a href="">Next</a>-->
<!--            <a href="">Last</a>-->
            {{ $search_result->links() }}
        </div>
    </div>

</div>
@stop
