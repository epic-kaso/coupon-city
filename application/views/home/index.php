
<div class="inner-pad">

    <ul class="coupon-promise clearfix mb">
        <li><a href="">Free shipping on deliveries</a></li>
        <li><a href="">Why we use Wallets</a></li>
        <li><a href="">Why you'll love us</a></li>
    </ul>

    <div class="how-works mb"></div>


    <?php
    if (strcmp(site_url(), current_url()) === 0) {
        echo partial('partials/_featured_items', $featured_items);
    }
    ?>

    <div class="special-feature mb clearfix">
        <div class="feature-one left"></div>
        <div class="feature-two right"></div>
    </div>

</div><!--inner pad end-->









