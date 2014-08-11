
<?php
echo partial('partials/_header', array('title' => 'Couponcity'));
?>

<div class="main-contain">
    <div class="top-header">
        <div class="mobile-nav hidden">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

<div class="container center">

    <?= partial('partials/_header_nav', array('user' => @$user)); ?>
        
        <?php if (!empty($success_msg)) { ?>
            <div class='alert alert-success'><p><?= $success_msg ?></p></div>
        <?php } ?>
        <?php if (!empty($error_msg)) { ?>
            <div class='alert alert-error'><p><?= $error_msg ?></p></div>
        <?php } ?>
        
        <?= @$breadcrumbs ?>

    <?= $yield ?>

</div><!--container end-->

<?php
echo partial('partials/_footer', array('app_type' => 'user'));
?>

