<?= partial('partials/merchant/_header_nav', array('merchant' => @$merchant)); ?>
<div class="container">
    <?= $breadcrumbs ?>
</div>
<div class="gap"></div>
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