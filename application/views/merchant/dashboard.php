<?= partial('partials/merchant/_header_nav', array('merchant' => @$merchant)); ?>
<?= partial('partials/merchant/_redeem_coupon', array()); ?>

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
<div class="container">
    <?= $breadcrumbs ?>
</div>
<div class="gap"></div>

<!-- //////////////////////////////////
//////////////END MAIN HEADER//////////
////////////////////////////////////-->


<!-- //////////////////////////////////
//////////////PAGE CONTENT/////////////
////////////////////////////////////-->


<div class="container">
    <div class="row">
        <div class="span12">

            <?php if (!empty($success_msg)) { ?>
                <div class='alert alert-success'><p><?= $success_msg ?></p></div>
            <?php } ?>
            <?php if (!empty($error_msg)) { ?>
                <div class='alert alert-error'><p><?= $error_msg ?></p></div>
            <?php } ?>
            <div class="row row-wrap">
                <div class="span3">
                    <!-- COUPON THUMBNAIL -->
                    <a href="<?= base_url('merchant/add-coupon'); ?>" class="coupon-thumb">
                        <div class="text-center" style="background-color: #ffffff">
                            <span class="icon-plus-sign" style="font-size: 150px;">
                            </span>
                        </div><div class="coupon-inner">
                            <h3 class="coupon-title">Add a Coupon</h3>
                        </div>
                    </a>
                </div>
                <div class="span3">
                    <!-- COUPON THUMBNAIL -->
                    <a href="#verify-dialog" data-effect="mfp-move-from-top" class="coupon-thumb popup-text">
                        <div class="text-center" style="background-color: #ffffff">
                            <span class="icon-tags" style="font-size: 150px;">
                            </span>
                        </div><div class="coupon-inner">
                            <h3 class="coupon-title">Verify a Coupon</h3>
                        </div>
                    </a>
                </div>
                <div class="span3">
                    <!-- COUPON THUMBNAIL -->
                    <a href="<?= base_url('merchant/my-coupons'); ?>" class="coupon-thumb">
                        <div class="text-center" style="background-color: #ffffff">
                            <span class="icon-ticket" style="font-size: 150px;">
                            </span>
                        </div><div class="coupon-inner">
                            <h3 class="coupon-title">My Coupons</h3>
                        </div>
                    </a>
                </div>
                <div class="span3">
                    <!-- COUPON THUMBNAIL -->
                    <a href="#" class="coupon-thumb">
                        <div class="text-center" style="background-color: #ffffff">
                            <span class="icon-bolt" style="font-size:150px;">
                            </span>
                        </div><div class="coupon-inner">
                            <h3 class="coupon-title">Statistics</h3>
                        </div>
                    </a>
                </div>
                <div class="span3">
                    <!-- COUPON THUMBNAIL -->
                    <a href="<?= base_url('merchant/settings'); ?>" class="coupon-thumb">
                        <div class="text-center" style="background-color: #ffffff">
                            <span class="icon-edit" style="font-size: 150px;">
                            </span>
                        </div><div class="coupon-inner">
                            <h3 class="coupon-title">Account Settings</h3>

                        </div>
                    </a>
                </div>
                <div class="span3">
                    <!-- COUPON THUMBNAIL -->
                    <a href="<?= base_url('help-faq') ?>" class="coupon-thumb">
                        <div class="text-center" style="background-color: #ffffff">
                            <span class="icon-question-sign" style="font-size: 150px;">
                            </span>
                        </div> <div class="coupon-inner">
                            <h3 class="coupon-title">Help / F.A.Q</h3>

                        </div>
                    </a>
                </div>

                <div class="span3">
                    <!-- COUPON THUMBNAIL -->
                    <a href="<?= base_url('contact') ?>" class="coupon-thumb">
                        <div class="text-center" style="background-color: #ffffff">
                            <span class="icon-envelope" style="font-size: 150px;">
                            </span>
                        </div>
                        <div class="coupon-inner">
                            <h3 class="coupon-title">Contact Us</h3>

                        </div>
                    </a>
                </div>
            </div>
            <div class="gap"></div>
        </div>
    </div>
</div>


<!-- //////////////////////////////////
//////////////END PAGE CONTENT/////////
////////////////////////////////////-->
