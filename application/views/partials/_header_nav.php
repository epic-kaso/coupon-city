<!--Header Navigation-->
<?php
if (!isset($active)) {
    $u = uri_string();
    $active = empty($u) ? 'home' : $u;
}
?>

<div class="header clearfix">

    <a href="" class="logo" title="logo" alt="CouponCity"></a>

    <div class="inner-pad">

        <ul class="controls right clearfix">
            
            <?php
            if (!$user) {
                ?>
                <li class="login"><a href="#login">Login</a></li>
                <li class="login"><a href="#register">Register</a></li>
            <?php } else { ?>

                <li class="current-user"><!--If user logged in?-->
                    <span><a href="<?= base_url('profile'); ?>"><?= $user->email; ?></a></span>

                    <div class="inner-nav">
                        <ul>
                            <li><a href="">My Coupons</a></li>
                            <li><a href="<?= base_url('settings') ?>">Account</a></li>
                            <li><a href="<?= base_url('logout'); ?>" ng-click="logout" >Logout</a></li>
                        </ul>
                    </div>
                </li>

                <li class="cart-icon"><a href="">₦ <?= $user->wallet_balance; ?></a></li>
            <?php } ?>

        </ul>

        <div class="search-bar right">
            <form>
                <input type="text" placeholder="Search...">
                <input class="search-button" value="Search" type="submit">
            </form>
        </div>

    </div>

    <nav class="mb clearfix">

        <li>
            <a href="">Fashion</a>

            <div class="sub-nav">
                <ul>
                    <li><a href="">Men</a></li>
                    <li><a href="">Women</a></li>
                    <li><a href="">Children</a></li>
                    <li><a href="">Accessories</a></li>
                </ul>
            </div>
        </li>

        <li>
            <a href="">Electronics</a>

            <div class="sub-nav">
                <ul class="sub-nav-list clearfix">
                    <li><a href="">Men</a></li>
                    <li><a href="">Women</a></li>
                    <li><a href="">Children</a></li>
                    <li><a href="">Accessories</a></li>
                </ul>
            </div>
        </li>

        <li><a href="">Travel</a>
            <div class="sub-nav">
                <ul class="sub-nav-list clearfix">
                    <li><a href="">Men</a></li>
                    <li><a href="">Women</a></li>
                    <li><a href="">Children</a></li>
                    <li><a href="">Accessories</a></li>
                </ul>
            </div>
        </li>

        <li><a href="">Food Items</a>
            <div class="sub-nav">
                <ul class="sub-nav-list clearfix">
                    <li><a href="">Men</a></li>
                    <li><a href="">Women</a></li>
                    <li><a href="">Children</a></li>
                    <li><a href="">Accessories</a></li>
                </ul>
            </div>
        </li>

    </nav>

</div><!--header close-->


