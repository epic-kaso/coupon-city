

	<div class="merchant-footer">
        <div class="center">
            &copy; 2014 Couponcity. 
            <a href="">Terms</a>
            <a href="">Privacy</a>
            <a href="<?= base_url('help-faq') ?>">Help</a>
            <a href="<?= base_url('contact') ?>">Contact</a>
        </div>
    </div>

</div><!--Merchant Body clode-->

	<!-- Scripts queries -->
	<?php
	if (!isset($app_type)) {
	    $app_type = 'app';
	}
	?>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script src="<?= base_url('assets/js/modal.js'); ?>"></script>
	<script src="<?= base_url('assets/js/waypoints.js'); ?>"></script>
	<script src="<?= base_url('assets/js/main.js'); ?>"></script>


</body>

</html>
