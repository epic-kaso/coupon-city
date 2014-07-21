<script>
    var my_globals = {};
    my_globals.base_url = 'http://localhost/koupon/';
    my_globals.categories = <?= json_encode($categories->items()); ?>
</script>
<style>
    .invalid{
        color: red;
    }
    .add-coupon{
        -webkit-transition: all 2s linear;
        transition: all 2s linear;
    }

    .add-coupon.ng-enter{
        opacity: 0;
    }
    .add-coupon.ng-enter-active{
        opacity: 1;
    }

    .add-coupon.ng-leave{
        opacity: 1;
    }

    .add-coupon.ng-leave-active{
        opacity: 0;
    }
    .card{
        background-color: #ffffff;
        border-radius: 4px;
        box-shadow: 2px 2px #f2f2f2;
        margin-left: 10px;
        margin-right: 10px;
        margin-top: 15px;
        margin-bottom: 15px;
    }

    div.multi-create-coupon{
        width: 150px;
        margin-left: auto;
        margin-right: auto;
    }

    div.multi-create-coupon > ul > li{
        display: inline-block;
        list-style: none;
    }

    div.multi-create-coupon > ul > li > a{
        width: 40px;
        height: 40px;
        padding: 10px;
        border: thin solid #006dcc;
        border-radius: 50%;
        text-align: center;
    }

    div.multi-create-coupon > ul > li > a:hover,div.multi-create-coupon > ul > li > a:active,a.active{
        -webkit-transition: all 0.2s linear;
        transition: all 0.5s linear;
        background-color: #006dcc;
        color: #ffffff;
    }
</style>

<div ng-init="base_url = '<?= base_url(); ?>'"></div>
<!-- END LOGIN REGISTER LINKS CONTENT -->
<!-- SEARCH AREA -->
<?= partial('partials/merchant/_header_nav', array('logged_in' => $logged_in, 'merchant' => @$merchant)); ?>

<?= partial('partials/merchant/_login', array('logged_in' => $logged_in, 'merchant' => @$merchant)); ?>

<?= partial('partials/merchant/_register', array('logged_in' => $logged_in, 'merchant' => @$merchant)); ?>

<div id="password-recover-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
    <i class="icon-retweet dialog-icon"></i>
    <h3>Password Recovery</h3>
    <h5>Fortgot your password? Don't worry we can deal with it</h5>
    <div class="row-fluid">
        <form class="dialog-form">
            <label>E-mail</label>
            <input type="text" placeholder="email@domain.com" class="span12">
            <input type="submit" value="Request new password" class="btn btn-primary">
        </form>
    </div>
</div>
<!-- END LOGIN REGISTER LINKS CONTENT -->
<!-- END SEARCH AREA -->
<div class="gap"></div>

<!-- //////////////////////////////////
//////////////END MAIN HEADER//////////
////////////////////////////////////-->


<!-- //////////////////////////////////
//////////////PAGE CONTENT/////////////
////////////////////////////////////-->
<?php if ($logged_in) { ?>

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
<!-- //////////////////////////////////
//////////////END PAGE CONTENT/////////
////////////////////////////////////-->


