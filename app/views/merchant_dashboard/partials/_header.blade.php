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
    <link rel="stylesheet" href="<?= URL::asset('css/main.css') ?>">
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css"/>

    <script src="<?= URL::asset('js/modernizr.min.js') ?>"></script>
</head>
<body>
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to
    improve your experience.</p>
<![endif]-->


<div class="merchant-header">
    <div class="center clearfix">

        <span class="_logo left"></span>

        <div class="merchant-nav left">

            <a href="{{ action('MerchantDashboardController@getIndex') }}">Dashboard</a>
            <a href="{{ action('MerchantDashboardController@getCoupons') }}" class="active_">Coupons</a>
            <a href="{{ action('MerchantDashboardController@getRedeem') }}">Redeem</a>
            <a href="{{ action('MerchantDashboardController@getBusiness') }}">Business</a>
            <a href="{{ action('MerchantDashboardController@getDeposit') }}">Deposit</a>
        </div>

        <ul class="right clearfix">
            <li class="left">
                {{ $user->business_name or $user->email }}
            </li>
            <li class="left _logout"><a href="{{ action('MerchantController@getLogout') }}">&raquo; &nbsp;Logout</a>
            </li>
        </ul>
    </div>
</div>