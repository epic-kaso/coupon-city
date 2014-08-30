@extends('layouts.auth')
@section('content')
<div class="auth-closure">
    <h1>Welcome back</h1>

    <p class="auth-tagline">Log into your Couponcity account and start creating coupons and drive revenue up.</p>
</div>


<div class="auth-form hold">
    <div>
        @include('partials._infos')
    </div>
    <form class="dialog-form" method="post" action="<?= action('MerchantController@postLogin') ?>">

        <input name="email" type="email" placeholder="you@example.com" required>
        <input name="password" type="password" placeholder="Password" required>
        <br/>
        <label class="checkbox" style="font-size:14px;">
            <input name="keep_logged_in" type="checkbox"> Remember me
        </label>
        <input type="submit" value="Sign in" class="btn btn-submit">
    </form>

    <ul class="clearfix reset-pass-register">
        <li class="left"><a href="<?= action('MerchantController@getSignUp') ?>">Not member yet?</a>
        </li>
        <li class="right"><a href="<?= action('MerchantController@getForgotPassword') ?>">Forgot password</a>
        </li>
    </ul>
</div>
@stop