<script>
    my_globals = my_globals || {};
    my_globals.categories = <?= json_encode($categories->items()); ?>
</script>


<div ng-init="base_url = '<?= base_url(); ?>'"></div>


<?php if ($merchant !== FALSE) { ?>

    <div class="container" ng-controller="CouponUploadController">
        <div class="row">
            <div class="span9">
                <div class="row">
                    <?php if (!empty($success_msg)) { ?>
                        <div class='alert alert-success'><p><?= $success_msg ?></p></div>
                    <?php } ?>
                    <?php if (!empty($error_msg)) { ?>
                        <div class='alert alert-error'><p><?= $error_msg ?></p></div>
                    <?php } ?>
                    <div class="card" style="min-height: 600px;padding-top: 20px;" >
                        <div class="multi-create-coupon">
                            <ul>
                                <li><a ui-sref-active="active" ui-sref="addcoupon-step1">1</a></li>
                                <li><a ui-sref-active="active" ui-sref="addcoupon-step2">2</a></li>
                                <li><a ui-sref-active="active" ui-sref="addcoupon-step3">3</a></li>
                            </ul>
                        </div>
                        <form ng-submit="submitCoupon(coupon)" class="dialog-form" name="coupon_form">
                            <div style="padding-top: 10px;" class="container add-coupon" ui-view>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="gap"></div>
            </div>
            <div class="span3">
                <div class="row">
                    <div class="span3" style="position: fixed;right:30px;top: 150px;">
                        <!-- COUPON THUMBNAIL -->
                        <a href="#" class="coupon-thumb">
                            <img ng-src="{{couponform.src}}" img-preview dynamic_src="couponform.src" alt="Image Alternative text" title="a turn" />
                            <div class="coupon-inner">
                                <h5 class="coupon-title" ng-bind="coupon.name">Diving with Sharks</h5>
                                <p class="coupon-desciption" ng-bind="coupon.summary | limitTo: 75">Eu justo scelerisque blandit vitae turpis curae nunc</p>
                                <div class="coupon-meta">
                                    <span class="coupon-time" ng-bind="coupon.end_date | date:'medium' ">10 days 40 h remaining</span>
                                    <span class="coupon-save" ng-bind="'Save ' + coupon.percentage_discount + ' % '">Save 20%</span>
                                    <div class="coupon-price"><span class="coupon-old-price" ng-bind="coupon.old_price | currency:'₦' ">365$</span>
                                        <span class="coupon-new-price" ng-bind="coupon.new_price | currency:'₦' ">292$</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } else { ?>

    <!--This shouldnt be here. Merchants dont see this page in the first place unless signed in. If they hit this url manually, they are redirected to login page-->
    <div class="container" ng-controller="CouponUploadController">
        <div class="row">
            <div class="span9">
                <h1>You need to <a  class="popup-text" data-effect="mfp-move-from-top" href="#register-dialog" data-effect="mfp-move-from-top">SignUp</a> or <a class="popup-text" data-effect="mfp-move-from-top" href="#login-dialog" data-effect="mfp-move-from-top">Login</a> to create a coupon.</h1>
            </div>
        </div>
    </div>
    <?php
}
?>

