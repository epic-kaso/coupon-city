<?php
echo partial('partials/_header', array('title' => 'Couponcity'));
?>
<div ng-app="endUserApp">
    <?= $yield ?>
</div>
<?php
echo partial('partials/_footer', array('app_type' => 'user'));
?>
