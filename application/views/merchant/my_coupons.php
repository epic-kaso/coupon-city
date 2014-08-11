<!-- END LOGIN REGISTER LINKS CONTENT -->
<!-- SEARCH AREA -->
<?= partial('partials/merchant/_header_nav', array('merchant' => @$merchant)); ?>

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
<?php if ($merchant !== FALSE) { ?>
    <div class="container">
        <div class="row">
            <div class="span3">
                <?= partial('partials/_category_nav', $categories); ?>
            </div>
            <div class="span9">
                <div class="row row-wrap">
                    <?= partial('partials/merchant/_display_coupons', $coupons); ?>
                </div>
                <div class="pagination">
                    <?= $links ?>
                    <?php //echo partial('partials/_pagination', $pagination); ?>
                </div>
                <div class="gap"></div>
            </div>
        </div>
    </div>

<?php } else { ?>

    <div class="container" ng-controller="CouponUploadController">
        <div class="row">
            <div class="span9">
                <h1>You need to
                    <a  class="popup-text"
                        data-effect="mfp-move-from-top"
                        href="#register-dialog"
                        data-effect="mfp-move-from-top">SignUp
                    </a> or
                    <a class="popup-text"
                       data-effect="mfp-move-from-top"
                       href="#login-dialog"
                       data-effect="mfp-move-from-top">Login
                    </a> to have coupons.
                </h1>
            </div>
        </div>
    </div>
    <?php
}
?>
