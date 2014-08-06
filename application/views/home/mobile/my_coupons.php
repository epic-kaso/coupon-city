<div class="gap"></div>
<?php if ($user !== FALSE) { ?>
    <div class="container">
        <div class="row">
            <div class="span3">
                <?= partial('partials/_category_nav', $categories); ?>
            </div>
            <div class="span9">
                <div class="row row-wrap">
                    <?= partial('partials/_display_coupons', $coupons); ?>
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
