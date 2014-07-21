<div class="search-area" style="background-color: #f2f2f2">
    <div class="container">
        <div class="row-fluid">
            <div class="span4">
                <h3 class="pull-right">Merchant Page</h3>
                <a href="http://localhost/koupon/index.php/merchant/">
                    <img src="http://localhost/koupon/assets/img/logo_200.png" alt="logo" title="logo" class="logo">
                </a>

            </div>
            <div class="spa6">
                <!-- LOGIN REGISTER LINKS -->
                <?php if (!$logged_in) { ?>
                    <ul class="login-register">
                        <li><a class="popup-text" href="#login-dialog" data-effect="mfp-move-from-top"><i class="icon-signin"></i>Sign in</a>
                        </li>
                        <li><a class="popup-text" href="#register-dialog" data-effect="mfp-move-from-top"><i class="icon-edit"></i>Sign up</a>
                        </li>
                    </ul>
                <?php } else { ?>
                    <ul class="nav nav-pills login-register">
                        <li class="active"><a href="#"><?= $merchant->email ?></a>
                        </li>
                        <li><a href="index-2.html">Profile</a>
                        </li>
                        <li><a href="index-hero-image.html">Account Settings</a>
                        </li>
                        <li><a href="<?= base_url('index.php/merchant/logout'); ?>">Logout</a>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </div>
</div>