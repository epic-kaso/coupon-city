<?php
echo partial('partials/mobile/_header', array('title' => 'Couponcity'));
?>
<script>
    var my_globals = {};
    my_globals.base_url = '<?= base_url(); ?>'
</script>
<div ng-app="myMerchantApp">
    <?= $yield ?>
</div>
<?php
echo partial('partials/mobile/_footer', array('year' => time('y')));
?>