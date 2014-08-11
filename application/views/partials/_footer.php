

	<?= partial('partials/_footer_nav', array()); ?>

	<!--Login/Register-->
	<div class="login-register">
	    <?= partial('partials/account/_login', array('show_fb_login' => TRUE, 'user' => @$user)); ?>
	    <?= partial('partials/account/_create_user', array('show_fb_login' => TRUE, 'user' => @$user)); ?>
	    <?= partial('partials/account/_forgot_password', array('user' => 'user')); ?>
	</div>

</div><!--main contain close-->

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
