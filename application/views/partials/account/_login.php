<div ng-controller="LoginController" id="login-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
    <i class="icon-signin dialog-icon"></i>
    <h3>Member Login</h3>
    <h5>Welcome back, friend. Login to get started</h5>
    <div class="row-fluid">
        <form class="dialog-form" action="<?= base_url('login'); ?>" method="post">
            <input type="hidden" name="redirect" value="<?= current_url(); ?>" />
            <label>E-mail</label>
            <input name="email" type="text" placeholder="email@domain.com" class="span12">
            <label>Password</label>
            <input name="password" type="password" placeholder="My secret password" class="span12">
            <label class="checkbox">
                <input type="checkbox">Remember me
            </label>
            <input type="submit" value="Sign in" class="btn btn-primary">
        </form>
        <hr/>
        <?php if (@show_fb_login) { ?>
            <button ng-disabled="!facebookReady" class="btn btn-primary btn-block" ng-click="IntentLogin()">Login with Facebook</button>
        <?php } ?>
        <div class="gap gap-small"></div>
        <ul class="dialog-alt-links">
            <li><a class="popup-text" href="#register-dialog" data-effect="mfp-zoom-out">Not member yet</a>
            </li>
            <li><a class="popup-text" href="#password-recover-dialog" data-effect="mfp-zoom-out">Forgot password</a>
            </li>
        </ul>
    </div>

</div>