<div class="container">
    <?= $breadcrumbs ?>
</div>
<div class="gap"></div>
<div class="container">
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
    <div class="row" style="margin-top: 10px;">
        <div class="offset4 span4" >
            <div class="row-fluid">
                <form action="<?= base_url(Merchant::MERCHANT_URL . '/edit-profile') ?>" method="post">
                    <?php
                    $values = $profile;
                    /*
                      $keys = array();
                      $values = array();
                      array_keys($keys);
                      array_values($values);

                     *
                     */
                    ?>
                    <?php
                    foreach ($values as $key => $value) {
                        if ($key == 'Short Description' || $key == 'Opening Hours') {
                            ?>
                            <label><?= $key ?></label>
                            <textarea name="<?= strtolower(str_ireplace(' ', '_', $key)); ?>" placeholder="<?= $key ?>" class="span12" cols="6">
                                <?= $value ?>
                            </textarea>
                            <?php
                        } else {
                            ?>
                            <label><?= $key ?></label>
                            <input type="text" name="<?= strtolower(str_ireplace(' ', '_', $key)); ?>" placeholder="<?= $key ?>" value="<?= $value ?>" class="span12">
                            <?php
                        }
                    }
                    ?>
                    <input type="submit" value="Save" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>

