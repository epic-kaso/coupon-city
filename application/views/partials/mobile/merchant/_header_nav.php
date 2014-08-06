<div class="search-area" style="background-color: #f2f2f2">
    <div class="container">
        <div class="row-fluid">
            <div class="span4">
                <h3 class="pull-right">Merchant Page</h3>
                <a href="<?= base_url(Merchant::MERCHANT_URL); ?>">
                    <img src="<?= base_url('assets/img/logo_200.png') ?>" alt="logo" title="logo" class="logo">
                </a>

            </div>
            <div class="spa6">
                <!-- LOGIN REGISTER LINKS -->
                <?php if (!$merchant) { ?>
                    <ul class="login-register">
                        <li><a href="<?= base_url(Merchant::MERCHANT_URL . '/login'); ?>" ><i class="icon-signin"></i>Sign in</a>
                        </li>
                        <li><a href="<?= base_url(Merchant::MERCHANT_URL . '/signup'); ?>"><i class="icon-edit"></i>Sign up</a>
                        </li>
                    </ul>
                <?php } else { ?>
                    <ul class="nav nav-pills login-register">
                        <li><a href="<?= base_url(Merchant::MERCHANT_URL . '/profile'); ?>"><?= $merchant->email ?></a>
                        </li>
                        <li><a href="<?= base_url(Merchant::MERCHANT_URL . '/logout'); ?>">Logout</a>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </div>
</div>