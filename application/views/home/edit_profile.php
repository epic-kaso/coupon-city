<div class="gap"></div>
<div class="container">
    <div class="row" style="margin-top: 10px;">
        <div class="offset4 span4" >
            <div class="row-fluid">
                <form action="<?= base_url('edit-profile') ?>" method="post">
                    <?php
                    $values = $profile;

                    foreach ($values as $key => $value) {
                        ?>
                        <label><?= $key ?></label>
                        <input type="text" name="<?= strtolower(str_ireplace(' ', '_', $key)); ?>" placeholder="<?= $key ?>" value="<?= $value ?>" class="span12">
                        <?php
                    }
                    ?>
                    <input type="submit" value="Save" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>

