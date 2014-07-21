<?= partial('partials/_header_nav', array()); ?>
<!-- LOGIN REGISTER LINKS CONTENT -->
<?= partial('partials/account/_login', array()); ?>
<?= partial('partials/account/_create_user', array()); ?>
<?= partial('partials/account/_forgot_password', array()); ?>

<!-- END LOGIN REGISTER LINKS CONTENT -->


<!-- TOP AREA -->
<div class="container">
    <?= $breadcrumbs ?>
</div>

<?= partial('partials/_featured_item', $featured_item); ?>
<!-- END TOP AREA -->


<!-- SEARCH AREA -->
<?= partial('partials/_search', array()); ?>
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
                <?php //echo partial('partials/_pagination', $pagination); ?>
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