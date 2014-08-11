<?php
echo partial('partials/_header', array('title' => 'Couponcity'));
?>

<?= partial('partials/merchant/_header_nav', array('merchant' => @$merchant)); ?>

<script>
    var my_globals = {};
    my_globals.base_url = '<?= base_url(); ?>'
</script>



<div class="merchant-body clearfix">
	<div class="hold _dash">
		<div ng-app="myMerchantApp">
		    <?= $yield ?>
		</div>
	</div>

	<?php
	echo partial('partials/_merchant_footer', array('year' => time('y')));
	?>
</div>

