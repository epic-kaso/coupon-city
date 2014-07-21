<?php
echo partial('partials/_header', array('title' => 'Couponcity'));
?>
<div ng-app="myUserApp">
    <?= $yield ?>
</div>
<?php
echo partial('partials/_footer', array('year' => time('y')));
?>