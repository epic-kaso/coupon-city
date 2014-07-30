<?php
echo partial('partials/_header', array('title' => 'Couponcity'));
?>
<div ng-app="endUserApp">
    <?= partial('partials/_header_nav', array('user' => $user)); ?>
    <!-- LOGIN REGISTER LINKS CONTENT -->
    <?= partial('partials/account/_login', array('show_fb_login' => TRUE, 'user' => $user)); ?>
    <?= partial('partials/account/_create_user', array('show_fb_login' => TRUE, 'user' => $user)); ?>
    <?= partial('partials/account/_forgot_password', array('user' => $user)); ?>
    <?= partial('partials/_wallet', array('user' => $user)); ?>

    <!-- END LOGIN REGISTER LINKS CONTENT -->

    <!-- SEARCH AREA -->
    <?= partial('partials/_search', array('user' => $user)); ?>

    <!-- TOP AREA -->
    <div class="container">
        <?php if (!empty($success_msg)) { ?>
            <div class='alert alert-success'><p><?= $success_msg ?></p></div>
        <?php } ?>
        <?php if (!empty($error_msg)) { ?>
            <div class='alert alert-error'><p><?= $error_msg ?></p></div>
                <?php } ?>
                <?= $breadcrumbs ?>
    </div>
    <?= $yield ?>
</div>
<?php
echo partial('partials/_footer', array('app_type' => 'user'));
?>
