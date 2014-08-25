@extends('layouts.merchant_dashboard')
@section('content')
<div class="merchant-body left clearfix">
    <div class="hold right">
        <div class="clearfix export-header">
            <h1 class="left">Create Coupon</h1>
            <a href="<?= URL::action('MerchantDashboardController@getCoupons') ?>" class="btn right export">&laquo; See
                all Coupons</a>
        </div>
        <?= Form::open(['url'=>action('CouponController@postStore'),'files'=>true,'class'=>'dialog-form','name'=>'coupon_form']) ?>

            <div class="segment">

                @include('partials._infos')

                <h2>Coupon Information</h2>


                <input name="coupon[name]" required ng-model="coupon.name" type="text" placeholder="Coupon Name">

                <div class="clearfix split-input">
                    <input type="text" placeholder="Tagline" class="left" name="coupon[tag_line]">

                    <div class="select-input right">
                        <select name="coupon[category_id]">
                            <option>Select Category</option>
                            @if(isset($categories))
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <p>You might know this as a fine print but essentially its any information related to the coupon and its
                    use. You might know this as a fine print but essentially its any information related to the coupon
                    and its use. <a href="">Learn more &raquo;</a></p>
                <textarea placeholder="What customers need to know" name="coupon[description]"
                          ng-model="coupon.description" class="span5" style="height: 200px;"></textarea>

            </div>

            <div class="segment">
                <h2>Coupon Details</h2>

                <p>Enter details of the good or service you are offering through this coupon. Customers need all details
                    of what they are buying. You might know this as a fine print but essentially its any information
                    related to the coupon and its use.<a href="">Learn more &raquo;</a></p>

                <div ng-show="coupon_form.coupon_summary.$dirty && !coupon_form.coupon_summary.$pristine"
                     class="invalid">
                    <span
                        ng-show="coupon_form.coupon_summary.$error.required">Give a little detail about the Coupon.</span>
                </div>
                <textarea name="coupon[summary]" required ng-model="coupon.summary"
                          placeholder="The details"></textarea>

                <div class="clearfix split-input">
                    <input type="text" placeholder="Start Date" class="from-dati left" name="coupon[start_date]">
                    <input type="text" placeholder="End Date" class="to-dati right" name="coupon[end_date]">
                </div>

                <div class="clearfix split-input">
                    <div ng-show="coupon_form.old_price.$dirty && !coupon_form.old_price.$pristine" class="invalid">
                        <span ng-show="coupon_form.old_price.$error.required">You need to specify old price.</span>
                    </div>

                    <div class="clearfix split-input left">
                        <input type="text" placeholder="Price" ng-model="coupon.old_price" class="old_price left"
                               name="coupon[old_price]">
                        <input type="text" placeholder="Max. Coupons" class="max_coupons right" name="coupon[quantity]">
                    </div>

                    <input type="text" name="coupon[location]" placeholder="Market" class="right">
                </div>

                <div class="clearfix coupon-images">
                    <p>You can enter up to 5 images. Make sure they are hi-res, clear with a minimum resolution of 700px
                        by 500px</p>

                    <div class="file-upload left">
                        <input type="file" class="upload" title="Upload Logo" name="coupon[image_one]">
                        <img alt="" class="target" src="">
                    </div>

                    <div class="file-upload left">
                        <input type="file" class="upload" title="Upload Logo" name="coupon[image_two]">
                        <img alt="" class="target" src="">
                    </div>

                    <div class="file-upload left">
                        <input type="file" class="upload" title="Upload Logo" name="coupon[image_three]">
                        <img alt="" class="target" src="">
                    </div>

                    <div class="file-upload left">
                        <input type="file" class="upload" title="Upload Logo" name="coupon[image_four]">
                        <img alt="" class="target" src="">
                    </div>

                    <div class="file-upload right">
                        <input type="file" class="upload" title="Upload Logo" name="coupon[image_five]">
                        <img alt="" class="target" src="">
                    </div>
                </div>
            </div>

            <div class="segment clearfix">
                <h2>Pricing</h2>

                <div class="basic-type-pricing clearfix three-input">
                    <input type="text" placeholder="New Price" class="new_price left"
                           ng-model="coupon.new_price"
                           name="coupon[new_price]"
                        >
                    <input type="text" placeholder="% Discount" class="basic_discount left"
                           ng-model="coupon.discount"
                           name="coupon[virtual_discount]">
                    <input type="text" placeholder="Actual % Discount" class="actual_discount right"
                           ng-model="coupon.actual_discount"
                           name="coupon[discount]">
                </div>


                <div class="segment-inner">
                    <p>You can turn on Advanced pricing here. Advanced Pricing lets you inspire more sales by dropping
                        prices as customer number go up. <a href="">Learn more &raquo;</a></p>

                    <input type="checkbox" id="pricing-type" class="pricing-type" name="coupon[is_advanced_pricing]"
                           value="1">
                    <label for="pricing-type" class="m-b">Turn On Advanced Pricing</label>

                    <div class="advanced-type-pricing clearfix three-input">
                        <a href="" ng-click="add_next_adv_price_form()">&laquo; Add Price Level</a>
                        <input type="text" placeholder="New Price" class="left"
                               name="coupon[advanced_price_one_price]">
                        <input type="text" placeholder="% Discount" class="left"
                               name="coupon[advanced_price_one_discount]">
                        <input type="text" placeholder="No of Customers" class="right"
                               name="coupon[advanced_price_one_quantity]">

                        <div ng-show="adv_price_form.second.visible">
                            <input type="text" placeholder="New Price" class="left"
                                   name="coupon[advanced_price_two_price]">
                            <input type="text" placeholder="% Discount" class="left"
                                   name="coupon[advanced_price_two_discount]">
                            <input type="text" placeholder="No of Customers" class="right"
                                   name="coupon[advanced_price_two_quantity]">
                        </div>

                        <div ng-show="adv_price_form.third.visible">
                            <input type="text" placeholder="New Price" class="left"
                                   name="coupon[advanced_price_three_price]">
                            <input type="text" placeholder="% Discount" class="left"
                                   name="coupon[advanced_price_three_discount]">
                            <input type="text" placeholder="No of Customers" class="right"
                                   name="coupon[advanced_price_three_quantity]">
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" class="btn-submit btn" value="Create Coupon">
        <?= Form::close() ?>
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
        <h2>Create a Coupon</h2>

        <p>Complete your personal details and that of your business. This information is makes you look more reliable
            and commands trust and comfort in users who are interested in your business discounts.</p>

        <p>It also makes it easy for us to communicate with you regarding any business issues and make deposits to your
            bank account as promised without any hitch.</p>

        <h2>Our Margin</h2>

        <p>Our margin is 20% of your discount. If you are offering a discount of 12%, we take a 20% margin which means
            the customer gets a 9.6% discount. The view enable you adjust your parameters accordingly. </p>
    </div>
</div>
@stop
