<!-- END SEARCH AREA -->
<div class="top-title-area">
    <div class="container">
        <h1 class="title-page"><?= $item->name ?></h1>
    </div>
</div>
<div class="gap"></div>
<div class="container">
    <?php if (!empty($success_msg)) { ?>
        <div class='alert alert-success'><p><?= $success_msg ?></p></div>
    <?php } ?>
    <?php if (!empty($error_msg)) { ?>
        <div class='alert alert-error'><p><?= $error_msg ?></p></div>
    <?php } ?>

    <div class="row row-reverce coupon">
        <?= partial('partials/_featured_item', array('featured_item' => $item)); ?>
    </div>
    <div class="gap gap-small"></div>

    <div class="row-fluid">
        <div class="gap gap-small"></div>
        <div class="row">
            <div class="span6">
                <h5>Description</h5>
                <p><?= $item->description ?></p>
            </div>
            <div class="span3">
                <h5>In a Nutshell</h5>
                <p><?= $item->summary ?></p>
            </div>
            <div class="span3">
                <h5>Location</h5>
                <div class="gmap" id="gmap"></div>
            </div>
        </div>
        <div class="gap gap-mini"></div>
        <div class="row row-wrap">

        </div>
        <!--
        -----similar offers--------
        -->
        <div class="gap gap-small"></div>
    </div>
</div>
<?= partial('partials/_footer_nav', array()); ?>