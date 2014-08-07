<?php
if (strcmp(site_url(), current_url()) === 0) {
    echo partial('partials/_featured_item', $featured_item);
}
?>
<!-- END TOP AREA -->
<div class="gap"></div>
<!-- END SEARCH AREA -->

<!-- //////////////////////////////////
//////////////END MAIN HEADER//////////
////////////////////////////////////-->


<!-- //////////////////////////////////
//////////////PAGE CONTENT/////////////
////////////////////////////////////-->


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
                <?php //echo partial('partials/_pagination', $pagination);   ?>
            </div>
            <div class="gap"></div>
        </div>
    </div>
</div>


<!-- //////////////////////////////////
//////////////END PAGE CONTENT/////////
////////////////////////////////////-->



<!-- //////////////////////////////////
//////////////MAIN FOOTER//////////////
////////////////////////////////////-->
<?= partial('partials/_footer_nav', array()); ?>
<!-- //////////////////////////////////
//////////////END MAIN  FOOTER/////////
////////////////////////////////////-->