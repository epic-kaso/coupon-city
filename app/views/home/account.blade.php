@extends('layouts.home',['categories'=>$categories])
@section('content')

<div class="inner-pad clearfix">

    <div class="account-nav">
        <h2 class="majors">Hey {{$user->present()->display_name}},</h2>

        <br>

        <div class="clearfix">
            <a href="#my-deals">My Deals</a>
            <a href="#my-account">My Account</a>
            <a href="#my-pass">Change Password</a>
        </div>
    </div>

    <div class="deal-no-deal clearfix">

        @if(isset($my_coupons) && $my_coupons->count() <= 0)
        <div class="if-no-deal">
            <p>You have no deals yet.</p>

            <div class="no-deal"></div>

            <p>Get discounts at unbelievable prices. <a href="">Browse all deals.</a></p>
        </div>
        @else
        <div class="all-my-deals left account-deals" id="my-deals">
            <h2 class="majors">My Deals</h2>
            @foreach($my_coupons as $c)
            <div class="my-deals clearfix"
                data-name="{{ $c->coupon->name }}"
                data-coupon-code="{{ $c->user_coupon_code }}"
                data-tag-line="{{ $c->coupon->tag_line }}"
                data-merchant-address="{{ $c->coupon->merchant->full_address }}"
                >
                <li class="my-deal-img">
                    <div><img src="{{ $c->coupon->image_one->url('medium') }}"></div>
                </li>
                <li>
                    <h3>{{ $c->coupon->name }}</h3>

                    <p>Purchased: {{ $c->coupon->created_at }}</p>

                    <a href="" data-text="{{ $c->coupon->toJson() }}">View Voucher</a>
                </li>
                <li><span>Expires:</span> {{ $c->coupon->end_date }}</li>
                <li><span>Coupon Code: </span><strong style="color: red">{{ $c->user_coupon_code }}</strong></li>
            </div>
            @endforeach
        </div>
        @endif
        <div class="redeem-mobile right clearfix">
            <h2 class="majors">Redeem with your mobile</h2>

            <div class="big-phone left"></div>

            <div class="how-to-redeem right">

                <ol>
                    <li>Buy any deal that you like</li>
                    <li>Go to "My Deals" find the deal that you want to redeem</li>
                    <li>Show your screen at the time of purchase. No need to print.</li>
                </ol>
            </div>
            <p>*Just in case you don't have a phone, you can redeem your offer by printing out your voucher or
                presenting your reference number at the deal location. Help save the planet.</p>

        </div>


        <div class="left account-deals" id="my-account">
            <h2 class="majors">Your Account <span>&raquo; {{ $user->email }}</span></h2>

            <br/>

            <?= Form::model($user, ['url' => action('UserController@postUpdate')]) ?>
            <li>
                <label>Firstname:</label>
                <?= Form::text('first_name') ?>
            </li>

            <li>
                <label>Lastname:</label>
                <?= Form::text('last_name') ?>
            </li>

            <li>
                <label>Mobile Number:</label>
                <?= Form::text('phone') ?>
            </li>

            <li>
                <input type="submit" class="text-button" value="Submit Changes">
            </li>
            <?= Form::close() ?>
        </div>


        <div class="left account-deals" id="my-pass">
            <h2 class="majors">Change Your Password</h2>
            <br>

            <?= Form::open(['url' => action('UserController@postChangePassword')]) ?>

            <li>
                <label>Old Password:</label>
                <input type="password" name="old_password">
            </li>

            <li>
                <label>New Password:</label>
                <input type="password" name="password">
            </li>

            <li>
                <label>Confirm Password:</label>
                <input type="password" name="password_confirmation">
            </li>

            <li>
                <input type="submit" class="text-button" value="Change Password">
            </li>

            <?= Form::close() ?>
        </div>

    </div>

</div>

<div class="v-border">
    <div class="voucher">
        <div class="v-header">
            <div class="logo-hold"></div>
        </div>

        <div class="v-center">
            <div class="top">
                <h2 class="majors" id="name">50% off free Amala and Ewedu</h2>

                <p id="tag_line">Limit is 1 voucher per person. You may buy additional for your friends. EXPIRES
                    February 2014</p>

                            <span class="barcode">
                                <img id="image_url" src="img/dummy-code.png">
                            </span>
            </div>

            <div class="clearfix">
                <div class="left">
                    <h4>Redeem at:</h4>

                    <p>Eya Basira</p>
                    <li>No 6, Oshodi Road,</li>
                    <li>Under mango tree,</li>
                    <li>Abule, Lagos.</li>
                    <li>07031234567</li>
                </div>

                <div class="right">
                    <h4>How to Redeem this</h4>
                    <ol>
                        <li>Print this voucher or user your phone</li>
                        <li>Present to server at the retaurant</li>
                    </ol>
                    <br>
                    <h4>Contact us anytime:</h4>
                    <li>070812345637, 070312345673</li>
                    <li>deal@pricedis.com</li>
                </div>
            </div>
        </div>

        <div class="v-footer">
            <div class="v-center">
                <p>Get discounts for goods at unbelieveable prices! </p>
            </div>
        </div>
    </div>
</div>

</div>

@stop