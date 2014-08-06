<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="offset3 span6">
            <div class="alert-error">
                <?php echo validation_errors(); ?>
            </div>
            <?php if (!empty($success_msg)) { ?>
                <div class='alert alert-success'><p><?= $success_msg ?></p></div>
            <?php } ?>
            <?php if (!empty($error_msg)) { ?>
                <div class='alert alert-error'><p><?= $error_msg ?></p></div>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="offset4 span4" style="margin-top: 10px;">
            <?= partial('partials/merchant/_login', array('echo_' => true)); ?>
        </div>
    </div>
</div>