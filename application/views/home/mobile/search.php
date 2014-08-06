<div class="container-fluid">
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

<?= partial('partials/_footer_nav', array()); ?>

