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

    <link rel="stylesheet" href="{{ URL::asset('css/normalize.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css'); }}">
</head>
<body>
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to
    improve your experience.</p>
<![endif]-->


<div class="main-contain">
        @include('partials._infos')
<div class="inner-pad clearfix">
    {{ BreadCrumbs::render() }}
    @yield('content')
</div>
</div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?= URL::asset('js/vendor/jquery-1.10.1.min.js') ?>"><\/script>')</script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
<script src="<?= URL::asset('js/basic.js') ?>"></script>
<script src="<?= URL::asset('js/modal.js') ?>"></script>
<script src="<?= URL::asset('js/gauge.js') ?>"></script>
<script src="<?= URL::asset('js/waypoints.min.js') ?>"></script>
<script src="<?= URL::asset('js/plugin.min.js') ?>"></script>
<script src="<?= URL::asset('js/countdown.min.js') ?>"></script>
<script src="<?= URL::asset('js/main.js') ?>"></script>

</body>
</html>
