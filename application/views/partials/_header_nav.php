<!-- //////////////////////////////////
//////////////MAIN HEADER/////////////
////////////////////////////////////-->
<?php
if (!isset($active)) {
    $active = 'home';
}
?>
<header class="main">
    <div class="container">
        <div class="row">
            <div class="span1">
                <a href="<?= base_url(); ?>">
                    <img src="<?= base_url('assets/img/logo_200.png'); ?>" alt="logo" title="logo" class="logo">
                </a>
            </div>
            <div class="span6">
                <!-- MAIN NAVIGATION -->
                <div class="flexnav-menu-button" id="flexnav-menu-button">Menu</div>
                <nav>
                    <ul class="nav nav-pills flexnav" id="flexnav" data-breakpoint="800">
                        <li <?= ($active === 'home') ? 'class="active"' : ''; ?>><a href="<?= base_url('index.php'); ?>">Home</a>
                        </li>
                        <li  <?= ($active === 'how-it-works') ? 'class="active"' : ''; ?>><a href="<?= base_url('index.php/how-it-works'); ?>">How it works</a>
                        </li>
                        <li <?= ($active === 'about') ? 'class="active"' : ''; ?>><a href="<?= base_url('index.php/about'); ?>">About us</a>
                        </li>
                        <li  <?= ($active === 'contact') ? 'class="active"' : ''; ?>><a href="<?= base_url('index.php/contact'); ?>">Contact</a>
                        </li>
                        <li  <?= ($active === 'help-faq') ? 'class="active"' : ''; ?>><a href="<?= base_url('index.php/help-faq'); ?>">Help & FAQ</a>
                        </li>
                    </ul>
                </nav>
                <!-- END MAIN NAVIGATION -->
            </div>
            <div class="span5">
                <!-- LOGIN REGISTER LINKS -->
                <?php
                $current_user = @$this->session->userdata(Home::USER_SESSION_VARIABLE);
                if (empty($current_user) || !$current_user) {
                    ?>
                    <ul class="login-register">
                        <li><a class="popup-text" href="#login-dialog" data-effect="mfp-move-from-top"><i class="icon-signin"></i>Sign in</a>
                        </li>
                        <li><a class="popup-text" href="#register-dialog" data-effect="mfp-move-from-top"><i class="icon-edit"></i>Sign up</a>
                        </li>
                    </ul>
                <?php } else { ?>
                    <ul class="nav nav-pills">
                        <li class="active"><a href="#"><?= $current_user['email']; ?></a>
                        </li>
                        <li><a  href="index-hero-image.html">Account Settings | </a>
                        </li>
                        <li><a href="<?= base_url('index.php/logout'); ?>">Logout</a>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </div>
</header>

