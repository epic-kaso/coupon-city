@extends('layouts.merchant_dashboard')
@section('content')
<div class="merchant-body left clearfix">
    <div class="hold right">
        <div class="clearfix">
            <h1 class="left">Edit your Profile</h1>
        </div>
        @include('partials._infos')

        <?= Form::model($user, ['url' => action('MerchantController@postEditProfile', ['user_id' => $user->id]), 'files' => true]) ?>
        <div class="segment clearfix">
            <h2>Basic Information</h2>
            <?= Form::text('contact_name', null, ['placeholder' => 'Full Name']) ?>

            <div class="split-input clearfix">
                <?= Form::email('email', null, ['placeholder' => 'you@yourbusiness.com', 'class' => 'left']) ?>
                <?= Form::text('mobile_number', null, ['placeholder' => 'Mobile Number', 'class' => 'right']) ?>
            </div>
        </div>

        <div class="segment clearfix">
            <h2>Business Information</h2>
            <?= Form::text('business_name', null, ['placeholder' => 'Business Name']) ?>

            <div class="left b-details">

                <div class="clearfix split-input">
                    <?= Form::text('website', null, ['placeholder' => 'Website', 'class' => 'left']) ?>
                    <div class="select-input right">
                        <select name="business_category">
                            <option value="1">Select Category</option>
                            <option value="2">Advertising</option>
                            <option value="3">Food &amp; Catering</option>
                        </select>
                    </div>
                </div>

                <?= Form::text('address_one', null, ['placeholder' => 'Address 1']) ?>
                <?= Form::text('address_two', null, ['placeholder' => 'Address 2']) ?>

                <div class="clearfix split-input">
                    <?= Form::text('city', null, ['placeholder' => 'City', 'class' => 'left']) ?>
                    <?= Form::text('state', null, ['placeholder' => 'State', 'class' => 'right']) ?>
                </div>

            </div>

            <div class="file-upload right">
                <?= Form::file('logo', ['class' => 'upload business-logo', 'title' => 'Upload Logo']) ?>
                <img alt="" class="target" src="">
            </div>

            <div class="clearfix split-input">
                <?= Form::textarea('short_description', null, ['placeholder' => 'Business Description', 'class' => 'left', 'cols' => '4', 'rows' => '10']) ?>
                <?= Form::textarea('opening_hours', null, ['placeholder' => 'Operating Hours', 'class' => 'right', 'cols' => '4', 'rows' => '10']) ?>
            </div>

        </div>

        <div class="segment">
            <h2>Bank Details</h2>
            <?= Form::text('account_number', null, ['placeholder' => 'Account Number']) ?>

            <div class="split-input clearfix">

                <div class="select-input left">
                    <select name="bank_name">
                        <option>Choose Bank</option>
                        <option>Access Bank</option>
                        <option>Keystone Bank</option>
                    </select>
                </div>

                <div class="select-input right">
                    <select name="account_type">
                        <option>Account Type</option>
                        <option>Savings</option>
                        <option>Current</option>
                    </select>
                </div>

            </div>

            <div class="bank-logo"></div>
        </div>

        <input type="submit" value="Update Business Profile" class="btn btn-submit">

        <?= Form::close() ?>
    </div>
</div>
<div class="merchant-body right">
    <div class="hold">
        <h2>Create your Profile</h2>

        <p>Complete your personal details and that of your business. This information is makes you look more reliable
            and commands trust and comfort in users who are interested in your business discounts.</p>

        <p>It also makes it easy for us to communicate with you regarding any business issues and make deposits to your
            bank account as promised without any hitch.</p>
    </div>
</div>
@stop