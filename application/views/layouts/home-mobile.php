<?php
echo partial('partials/mobile/_header', array('title' => 'Couponcity'));
?>
<div ng-app="endUserApp">
    <?= partial('partials/mobile/_header_nav', array('user' => @$user)); ?>

    <!-- TOP AREA -->
    <div class="container">
        <?php if (!empty($success_msg)) { ?>
            <div class='alert alert-success'><p><?= $success_msg ?></p></div>
        <?php } ?>
        <?php if (!empty($error_msg)) { ?>
            <div class='alert alert-error'><p><?= $error_msg ?></p></div>
                <?php } ?>
                <?= @$breadcrumbs ?>
    </div>
    <?= $yield ?>
</div>
<?php
echo partial('partials/mobile/_footer', array('app_type' => 'user'));
?>
