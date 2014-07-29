<div ng-controller="VerifyCouponController"
     id="verify-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
    <i class="icon-tag dialog-icon"></i>
    <h3>Redeem Coupon</h3>
    <div class="row-fluid">
        <div class='text-center'>
            <p class='alert alert-success' ng-show="is_success" ng-bind="message"></p>
            <p class='alert alert-error' ng-show="is_failure" ng-bind="message"></p>
            <p class="alert alert-info" ng-show='is_working'>Working....</p>
        </div>
        <form method='post' action="#">
            <label>User Coupon Code</label>
            <input required name="coupon_code" type="text" placeholder="coupon code" class="span12" ng-model='coupon.coupon_code'>
            <input type="submit" ng-click="verify_coupon(coupon, $event)" ng-value="is_working ? 'Working....':'Verify'" class="btn btn-primary">
        </form>
    </div>
</div>