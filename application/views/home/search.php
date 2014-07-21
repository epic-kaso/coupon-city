<?= partial('partials/_header_nav', array('active' => 'search')); ?>
<!-- LOGIN REGISTER LINKS CONTENT -->
<?= partial('partials/account/_login', array()); ?>
<?= partial('partials/account/_create_user', array()); ?>
<?= partial('partials/account/_forgot_password', array()); ?>

<!-- END LOGIN REGISTER LINKS CONTENT -->
<!-- SEARCH AREA -->
<?= partial('partials/_search', array('query' => $search_query)); ?>
<!-- END SEARCH AREA -->


<div class="gap"></div>

<div class="container">
    <div class="row">
        <div class="span12">
            <p class="coupon-search-title">
                We have found <b><?= $search_result->count ?></b> result<?= ($search_result->count > 1) ? 's' : '' ?> for <span class="highlight"><?= $search_query->query ?></span> in <b><?= $search_query->location ?></b>
            </p>
            <div class="row row-wrap">
                <?= partial('partials/_display_coupons', $coupons); ?>
            </div>
            <div class="pagination">
                <?= $links ?>
            </div>
            <div class="gap"></div>
        </div>
    </div>
</div>

