@extends('layouts.auth')
@section('content')
<div class="auth-closure">
    <h1>Join CouponCity</h1>

    <p class="auth-tagline">Create a CouponCity account and start dirivng massive sales to your business.</p>
</div>


<div class="auth-form hold">

    <div>
        @include('partials._infos')
    </div>

    <form class="dialog-form" method="post" action="<?= action('MerchantController@postSignUp') ?>">

        <input name="email" type="email" placeholder="you@example.com" required>
        <input name="password" type="password" placeholder="Password" required>
        <input name="password_confirmation" type="password" placeholder="Confirm Password" required>
        <input name="business_area" type="text" placeholder="Your Area e.g Lekki">

        <p class="tcs">By continuing, I agree to CouponCity's <a href="">Terms and conditions</a>.</p>
        <input type="submit" value="Create Account" class="btn btn-submit">
    </form>

    <ul class="clearfix reset-pass-register">
        <li class="left"><a href="<?= action('MerchantController@getLogin') ?>">Log in</a>
        </li>
        <li class="right"><a href="<?= action('MerchantController@getForgotPassword') ?>">Forgot password</a>
        </li>
    </ul>
</div>
@stop