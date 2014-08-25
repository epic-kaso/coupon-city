@extends('layouts.merchant_dashboard')
@section('content')
<div class="merchant-body left clearfix">

    <div class="hold right">
        <div class="clearfix">
            <h1 class="left">Your Profile </h1>
            <?= $user->present()->status; ?>

            <a href="<?= URL::action('MerchantDashboardController@getEditProfile') ?>" class="export btn right">Edit</a>
        </div>

        @include('partials._infos')

        <div class="profile-top">
            <div>
                <img src="<?= ($user->logo->url('thumb')); ?>"/>
            </div>

            <h3><?= $user->business_name; ?></h3>
            <?= $user->present()->address; ?>
        </div>

        <fieldset class="segment clearfix">
            <legend>Basic Information</legend>

            <ul class="clearfix">
                <li class="left split-input"><label>Full Name:</label> <?= $user->contact_name; ?></li>
                <li class="left split-input"><label>Email:</label> <?= $user->email; ?></li>
                <li class="left split-input"><label>Mobile No:</label> <?= $user->mobile_number; ?></li>
            </ul>
        </fieldset>

        <fieldset class="segment clearfix">
            <legend>Business Information</legend>

            <ul class="clearfix">
                <li class="left split-input"><label>Business Name:</label> <?= $user->business_name; ?></li>
                <li class="left split-input"><label>Category:</label>{{ $user->present()->category }}</li>
                <li class="left split-input"><label>Website:</label> <a
                        href="http://<?= $user->website; ?>"><?= $user->website; ?></a></li>
                <li class="left split-input">
                    <label>Address:</label>
                    <?= $user->address_one; ?>,<br/>
                    <label class="empty-label"></label><?= $user->address_two; ?>,<br/>
                    <label class="empty-label"></label><?= $user->city; ?>,<br/>
                    <label class="empty-label"></label><?= $user->state; ?>.
                </li>
                <li class=""><label>Description:</label> <?= $user->short_description; ?></li>
                <li class=""><label>Operating Hours:</label> <?= $user->opening_hours; ?></li>
            </ul>
        </fieldset>

        <fieldset class="segment clearfix">
            <legend>Bank Details</legend>

            <ul class="clearfix">
                <li class="left split-input"><label>Bank Name:</label><?= $user->bank_name; ?></li>
                <li class="left split-input"><label>Account No:</label> <?= $user->account_number; ?></li>
                <li class="left split-input"><label>Account Type:</label><?= $user->account_type; ?></li>

            </ul>
        </fieldset>

    </div>
    <div class="merchant-footer">
        <div class="center">
            &copy; 2014 Couponcity.
            <a href="">Terms</a>
            <a href="">Privacy</a>
            <a href="">Legal</a>
            <a href="">Help</a>
        </div>
    </div>
</div>

<div class="merchant-body right">
    <div class="hold">
        <h2>Your Profile</h2>

        <p>Complete your personal details and that of your business. This information is makes you look more reliable
            and commands trust and comfort in users who are interested in your business discounts.</p>

        <p>It also makes it easy for us to communicate with you regarding any business issues and make deposits to your
            bank account as promised without any hitch.</p>
    </div>
</div>
@stop