<div id="register-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
    <i class="icon-edit dialog-icon"></i>
    <h3>Member Register</h3>
    <h5>Ready to get best offers? Let's get started!</h5>
    <div class="row-fluid">
        <form class="dialog-form" action="<?= base_url('signup') ?>" method="post">
            <input type="hidden" name="redirect" value="<?= current_url(); ?>" />
            <label>E-mail</label>
            <input type="text" name="email" placeholder="email@domain.com" class="span12">
            <label>Password</label>
            <input type="password" placeholder="My secret password" name="password" class="span12">
            <label>Repeat Password</label>
            <input type="password" placeholder="Type your password again" name="re_password" class="span12">
            <label class="checkbox">
                <input type="checkbox">Accept terms and Condition
            </label>
            <input type="submit" value="Sign up" class="btn btn-primary">
        </form>
    </div>
    <ul class="dialog-alt-links">
        <li><a class="popup-text" href="#login-dialog" data-effect="mfp-zoom-out">Already member</a>
        </li>
    </ul>
</div>

