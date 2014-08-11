<script>
    my_globals = my_globals || {};
    my_globals.categories = <?= json_encode($categories->items()); ?>
</script>
<div ng-init="base_url = '<?= base_url(); ?>'"></div>
<?= partial('partials/merchant/_header_nav', array('merchant' => @$merchant)); ?>
<div class="container">
    <?= $breadcrumbs ?>
</div>
<div class="gap"></div>

<div class="container" ng-controller="CouponUploadController">
    <div class="row">
        <div class="span12">
            <div class="row">
                <?php if (!empty($success_msg)) { ?>
                    <div class='alert alert-success'><p><?= $success_msg ?></p></div>
                <?php } ?>
                <?php if (!empty($error_msg)) { ?>
                    <div class='alert alert-error'><p><?= $error_msg ?></p></div>
                <?php } ?>
                <div class="card" style="min-height: 600px;padding-top: 20px;" >
                    <form ng-submit="submitCoupon(coupon)" class="dialog-form" name="coupon_form">
                        <div style="padding-top: 10px;">
                            <div class="span5" style="border: thin dashed #003bb3;">
                                <div id="my-awesome-dropzone"
                                     class="dropzone" >
                                </div>
                                <label>Coupon Full Description</label>
                                <textarea name="coupon_description" ng-model="coupon.description" class="span5" style="height: 200px;">
                                </textarea>
                            </div>
                            <div class="span6">
                                <div ng-show="coupon_form.coupon_name.$dirty && !coupon_form.coupon_name.$pristine" class="invalid">Invalid.
                                    <span ng-show="coupon_form.coupon_name.$error.required">You need to Specify coupon name.</span>
                                </div>
                                <label>Name</label>
                                <input name="coupon_name" required ng-model="coupon.name" type="text" placeholder="email@domain.com" class="span3">
                                <div ng-show="coupon_form.coupon_summary.$dirty && !coupon_form.coupon_summary.$pristine" class="invalid">
                                    <span ng-show="coupon_form.coupon_summary.$error.required">You Summarize a bit.</span>
                                </div>
                                <label>Summary</label>
                                <textarea name="coupon_summary" required ng-model="coupon.summary" class="span3"></textarea>
                                <div ng-show="coupon_form.old_price.$dirty && !coupon_form.old_price.$pristine" class="invalid">
                                    <span ng-show="coupon_form.old_price.$error.required">You need to Specify Old Price.</span>
                                </div>
                                <div>
                                    <fieldset>
                                        <label>Pricing</label>
                                        <label>
                                            <input type="radio" name="is_advanced_pricing" ng-value="0" checked="true" ng-model="coupon.is_advanced_pricing">Basic
                                        </label>
                                        <label>
                                            <input type="radio" name="is_advanced_pricing" ng-value="1" ng-model="coupon.is_advanced_pricing">Advanced
                                        </label>
                                    </fieldset>
                                </div>
                                <label>Old Price</label>
                                <input name="old_price" ng-change="calculatePercentDiscount()" required ng-model="coupon.old_price" type="number" placeholder="Old Price" class="span3">
                                <div ng-show="coupon_form.new_price.$dirty && !coupon_form.new_price.$pristine" class="invalid">
                                    <span ng-show="coupon_form.new_price.$error.required">You need to Specify New Price.</span>
                                </div>
                                <div ng-show="coupon.is_advanced_pricing == 0">
                                    <label>New Price</label>
                                    <input name="new_price" ng-change="calculatePercentDiscount(null, null)" required ng-model="coupon.new_price" type="number" placeholder="New Price" class="span3">
                                    <label>Percentage Discount</label>
                                    <input name="percentage_discount" ng-change="calculateNewPrice(null, null)" required ng-model="coupon.discount" type="number" placeholder="Percentage Discount" class="span3">
                                </div>

                                <div ng-show="coupon.is_advanced_pricing == 1" class="text-center">
                                    <table>
                                        <thead>
                                            <tr>
                                                <td><label>New Price</label></td>
                                                <td colspan="2"><label>Sales Range</label></td>
                                                <td><label>% Discount</label></td>
                                            </tr>
                                        </thead>
                                        <tr ng-show="adv_price_form.first.visible">
                                            <td>
                                                <input name="advanced_pricing[first][price]"
                                                       ng-change="calculate_advanced_discount('first', coupon.advanced_pricing.first.price, coupon.advanced_pricing.first.discount)"
                                                       required ng-model="coupon.advanced_pricing.first.price" type="number" placeholder="New Price" class="span1">
                                            </td>
                                            <td>
                                                <label class="span1">0 -</label>
                                            </td>
                                            <td>
                                                <input name="advanced_pricing[first][count]"
                                                       required ng-model="coupon.advanced_pricing.first.count"
                                                       type="number" placeholder="New Price" class="span1">
                                            </td>
                                            <td>
                                                <input name="advanced_pricing[first][percentage_discount]"
                                                       ng-change="calculate_advanced_price('first', coupon.advanced_pricing.first.price, coupon.advanced_pricing.first.discount)"
                                                       required ng-model="coupon.advanced_pricing.first.discount" type="number" placeholder="Percentage Discount" class="span1">
                                            </td>
                                        </tr>
                                        <tr ng-show="adv_price_form.second.visible">
                                            <td>
                                                <input name="advanced_pricing[second][price]" ng-change="calculate_advanced_discount('second', coupon.advanced_pricing.second.price, coupon.advanced_pricing.second.discount)"
                                                       required ng-model="coupon.advanced_pricing.second.price" type="number" placeholder="New Price" class="span1">
                                            </td>
                                            <td>
                                                <label class="span1" ng-bind="coupon.advanced_pricing.first.count + 1 + ' -'"></label>
                                            </td>
                                            <td>
                                                <input name="advanced_pricing[second][count]" required
                                                       ng-model="coupon.advanced_pricing.second.count" type="number" placeholder="New Price" class="span1" >
                                            </td>
                                            <td>
                                                <input name="advanced_pricing[second][percentage_discount]"
                                                       ng-change="calculate_advanced_price('second', coupon.advanced_pricing.second.price, coupon.advanced_pricing.second.discount)"
                                                       required ng-model="coupon.advanced_pricing.second.discount" type="number" placeholder="Percentage Discount" class="span1">
                                            </td>
                                        </tr>
                                        <tr ng-show="adv_price_form.third.visible">
                                            <td>
                                                <input name="advanced_pricing[third][price]"
                                                       ng-change="calculate_advanced_discount('third', coupon.advanced_pricing.third.price, coupon.advanced_pricing.third.discount)"
                                                       required ng-model="coupon.advanced_pricing.third.price" type="number" placeholder="New Price" class="span1">
                                            </td>
                                            <td>
                                                <label class="span1" ng-bind="coupon.advanced_pricing.second.count + 1 + ' -'"></label>
                                            </td>
                                            <td>
                                                <input name="advanced_pricing[third][count]" required
                                                       ng-model="coupon.advanced_pricing.third.count" type="number" placeholder="New Price" class="span1">
                                            </td>
                                            <td>
                                                <input name="advanced_pricing[third][percentage_discount]"
                                                       ng-change="calculate_advanced_price('third', coupon.advanced_pricing.third.price, coupon.advanced_pricing.third.discount)"
                                                       required ng-model="coupon.advanced_pricing.third.discount" type="number" placeholder="Percentage Discount" class="span1">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <span ng-click="add_next_adv_price_form()" class="btn btn-mini inline">Add</span>
                                                <span ng-click="remove_next_adv_price_form()" class="btn btn-mini inline">Remove</span>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </div>

                                <label>Start Date</label>
                                <div ng-show="coupon_form.start_date.$dirty && !coupon_form.start_date.$pristine" class="invalid">
                                    <span ng-show="coupon_form.start_date.$error.required">You need to Specify Start Date.</span>
                                </div>
                                <input ng-required='true' type='text' name="start_date" class="span3" datepicker-popup='yyyy-MM-dd' format='yyyy-MM-dd' ng-model="coupon.start_date" />

                                <label>End Date Date</label>
                                <div ng-show="coupon_form.end_date.$dirty && !coupon_form.start_date.$pristine" class="invalid">
                                    <span ng-show="coupon_form.end_date.$error.required">You need to Specify Start Date.</span>
                                </div>
                                <input ng-required='true' type='text' name="end_date" class="span3" datepicker-popup='yyyy-MM-dd' format='yyyy-MM-dd' ng-model="coupon.end_date" min-date='coupon.start_date' />
                                <label>Location & Areas </label>
                                <input name="coupon_publish" ng-model="coupon.location" type="text" class="span3">
                                <label class="checkbox">
                                    <input name="coupon_publish" ng-model="coupon.published" ng-true-value='1' ng-false-value='0' checked="true" type="checkbox">Make Available to All Users Immediately
                                </label>
                                <hr/>
                                <label>Select Coupon Category</label>
                                <select required="" name="brand" ng-model="coupon.category_id">
                                    <option ng-repeat="cat in categories" value="{{cat.id}}">{{cat.name}}</option>
                                </select>
                                <p class="alert alert-info">
                                    Please go back and verify all the data you have inputed, when you click finish, this Coupon will be added to your portfolio
                                </p>
                                <button type="submit" class="btn btn-primary btn-large" ng-disabled="coupon_form.$invalid" ng-bind="(submitting) ? 'Uploading....' : 'Finish'"></button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //////////////////////////////////
//////////////END PAGE CONTENT/////////
////////////////////////////////////-->


