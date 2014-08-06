<!-- Scripts queries -->
<?php
if (!isset($app_type)) {
    $app_type = 'app';
}
?>
<script src="<?= base_url('assets/js/lib/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url() ?>assets/js/lib/dropzone.min.js"></script>
<script src="<?= base_url('assets/js/boostrap.min.js'); ?>"></script>
<script src="<?php echo base_url() ?>assets/js/lib/angular.min.js"></script>

<script src="<?= base_url('assets/js/nivo_slider.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/countdown.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/flexnav.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/magnific.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/tweet.min.js'); ?>"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script src="<?= base_url('assets/js/gmap3.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/wilto_slider.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/mediaelement.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/fitvids.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/mail.min.js'); ?>"></script>

<!-- Custom scripts -->
<script src="<?= base_url('assets/js/custom.js'); ?>"></script>
<script src="<?= base_url('assets/js/switcher.js'); ?>"></script>


<script src="<?php echo base_url() ?>assets/js/lib/ui-bootstrap-tpls.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/lib/angular-ui-router.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/lib/angular-facebook.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/lib/angular-cookies.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/<?= $app_type ?>/app.js"></script>
<script src="<?php echo base_url() ?>assets/js/<?= $app_type ?>/services.js"></script>
<script src="<?php echo base_url() ?>assets/js/<?= $app_type ?>/controllers.js"></script>
<script src="<?php echo base_url() ?>assets/js/<?= $app_type ?>/filters.js"></script>
<script src="<?php echo base_url() ?>assets/js/<?= $app_type ?>/directives.js"></script>

</body>

</html>
