<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Deal Site</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="icon" type="image/ico" href="favicon.ico">
    <link rel="author" href="humans.txt"/>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,600' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="<?= URL::asset('css/normalize.min.css') ?>">
    <link rel="stylesheet" href="<?= URL::asset('css/main.css'); ?>">

    <script src="<?= URL::asset('js/vendor/modernizr-2.6.2-respond-1.1.0.min.js') ?>"></script>
</head>
<body>
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to
    improve your experience.</p>
<![endif]-->


<div class="main-contain">

    <div class="top-header">
        <div class="mobile-nav hidden">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="container center">
        <div class="header clearfix">

            <a href="/" class="logo" title="logo" alt="priceam"><img src="{{URL::asset('img/logo.png')}}"></a>

            <div class="inner-pad">

                <ul class="controls right clearfix">

                    @if(isset($user) && !is_null($user))

                    <li class="current-user"><!--If user logged in?-->
                        <span>{{ $user->present()->display_name }}</span>

                        <div class="inner-nav">
                            <ul>
                                <li><a href="<?= action('HomeController@getAccount') ?>">My Coupons</a></li>
                                <li><a href="<?= action('HomeController@getAccount') ?>">Account</a></li>
                                <li class="nav-help" target="_blank"><a href="">Help</em></a></li>
                                <li><a href="<?= action('UserController@getLogout'); ?>">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="cart-icon"><a href="{{ action('HomeController@getWallet') }}">₦ {{
                            number_format($user->wallet_balance,2) }}</a></li>

                    @else

                    <li class="login"><a href="#register">Register</a></li>
                    <li class="login"><a href="#login">Login</a></li>
                    <!--Login if user is has not signed in-->

                    @endif
                </ul>

                <div class="search-bar right">
                    <form action="{{ action('HomeController@getSearch') }}">
                        <input type="text" name="q" placeholder="Search...">
                        <input class="search-button" value="Search" type="submit">
                    </form>
                </div>
            </div>


            <nav class="mb clearfix">

                @if(isset($categories))
                @foreach($categories as $cat)
                <li>
                    <a href="{{ URL::action('CouponListingController@getShow',['slug'=>$cat->slug]) }}">{{ $cat->name
                        }}</a>

                    <div class="sub-nav">
                        <ul>
                            <li><a href="">Men</a></li>
                            <li><a href="">Women</a></li>
                            <li><a href="">Children</a></li>
                            <li><a href="">Accessories</a></li>
                        </ul>
                    </div>
                </li>
                @endforeach
                @endif

            </nav>

        </div>
        <!--End of header-->
        @include('partials._infos')