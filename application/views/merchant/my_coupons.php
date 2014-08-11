<div class="container">
    <?= $breadcrumbs ?>
</div>
<div class="gap"></div>
<div class="container">
    <div>
        <div style="width: 150px; float: left">
            <?= partial('partials/_category_nav', $categories); ?>
        </div>
        <div>
            <div class="row row-wrap">
                <?= partial('partials/merchant/_display_coupons_table', $coupons); ?>
            </div>
            <div class="pagination">
                <?= $links ?>
                <?php //echo partial('partials/_pagination', $pagination); ?>
            </div>
            <div class="gap"></div>
        </div>
    </div>
</div>

