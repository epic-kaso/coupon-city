<?php
echo partial('partials/_header', array('title' => 'Couponcity'));
?>

<?php if (isset($merchant)) {
    echo partial('partials/merchant/_header_nav', array('merchant' => @$merchant));
} ?>

<script>
    var my_globals = {};
    my_globals.base_url = '<?= base_url(); ?>'
</script>

	
<div ng-app="myMerchantApp">
    <?= $yield ?>
</div>
	
