<?php
echo partial('partials/_header', array('title' => 'Couponcity'));
?>

<?php
if (isset($merchant)) {
    echo partial('partials/merchant/_header_nav', array('merchant' => @$merchant));
}
?>
<div ng-app="myMerchantApp">
    <?= $yield ?>
</div>

