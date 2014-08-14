<!--
<div class="top-title-area">
    <div class="container">
        <h1 class="title-page"><?php //$item->name                        ?></h1>
    </div>
</div>
<div class="gap"></div>
<div class="container">
    <div class="row row-reverce coupon">
<?php //partial('partials/_coupon_item', array('featured_item' => $item)); ?>
    </div>
    <div class="row-fluid">
        <div class="gap gap-small"></div>
        <div class="row">
            <div class="span6">
                <h5>Description</h5>
                <p><?php //$item->description                         ?></p>
            </div>
            <div class="span3">
                <h5>In a Nutshell</h5>
                <p><?php //$item->summary                         ?> </p>
            </div>
            <div class="span3">
                <h5>Location</h5>
                <div class="gmap" id="gmap"></div>
            </div>
        </div>
    </div>
</div>
-->
<?php if (isset($item) && $item !== FALSE) { ?>
    <div class="inner-pad clearfix">
        <div class="breadcrumb mb">
            <a href="" class="bread-home">Home</a>/
            <a href="">Categories</a>/
            <a href="">Food &amp; Drinks</a>/
            &nbsp;&nbsp;Ladies and Women Fashion
        </div>



        <section class="deal clearfix mb">
            <div class="mb">
                <h1 class="majors"><?= $item->name ?></h1>
                <p class="deal-tagline"><?= $item->tag_line ?></p>
            </div>
            <br/>

            <div class="left details-of-deal">
                <div class="deal-pictures-wrap">

                    <?php
                    $index = 0;
                    if (property_exists($item, 'coupon_medias') && !empty($item->coupon_medias)) {
                        ?>
                        <div class = "deal-pictures <?= ($index === 0 ? 'active ' : '') ?>item">
                            <img src = "<?= base_url($item->cover_image_url) ?>" alt = "Image Alternative text" title = "cascada" />
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class = "deal-pictures  active item">
                            <img src = "<?= base_url('assets/images/no_image.png') ?>" alt = "Image Alternative text" title = "cascada" />
                        </div>
                        <?php
                    }
                    ?>

                </div>

                <ul class="thumbnails clearfix">
                    <?php
                    if (property_exists($item, 'coupon_medias') && !empty($item->coupon_medias)) {
                        foreach ($item->coupon_medias as $media) {
                            ?>
                            <li style="display: inline-block">
                                <a href="">
                                    <img height="80" width="80" src="<?= base_url($media->media_url) ?>" alt = "Image Alternative text" title = "cascada" />
                                </a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>

            <h2 class="majors">What you should know</h2>
            <p>Expires 90 days after purchase. Limit 1 per person, may buy 2 additional as gifts. Limit 1 per table. Limit 1 per visit. Valid only for option purchased. Reservation recommended. Dine-in only. Valid only for dinner. Must purchase 1 food item. Must use promotional value in 1 visit. Not valid on 2/14-2/16. Not valid on holidays, including Easter and Mother's Day.</p>
    </div>

    <div class="right buy">
        <a href="<?= $item->grab_link ?>" class="deal-button clearfix">
            <span>Buy</span>
            <span>~</span>
            ₦<?= $item->new_price ?>
        </a>

        <a href="" class="price-details">Price Details <span>&#x25BC;</span></a>

        <div class="border">
            <ul class="price-discount-save clearfix">
                <li>Value <span>₦<?= $item->old_price ?></span></li>
                <li>Discount <span><?= $item->discount ?>%<span></li>
                            <li>Savings <span>₦<?= $item->savings ?></span></li>
                            </ul>

                            <a href="" class="gift-button"><span></span>Gift this deal</a>

                            <div class="little-detail clearfix">
                                <li class="no-sold"><?= $item->sales ?> Sold</li>
                                <li class="delivery-avail right">Free Delivery</li>
                            </div>
                            </div>

                            <p class="time-left"></p>
                            <p class="deadline hidden"><?= $item->end_date ?></p>

                            <fieldset class="share-button">
                                <legend>Share this Deal</legend>

                                <ul class="clearfix share-buttons">
                                    <li class="facebk"><a href=""></a></li>
                                    <li class="twitr"><a href=""></a></li>
                                    <li class="share-mail"><a href=""></a></li>
                                    <li class="likeBtn"><img src="img/dummy-fb.png"></li>
                                </ul>
                            </fieldset>

                            </div>

                            </section>
                            <br/>

                            <div class="clearfix">
                                <section class="left details-mobile mb">
                                    <div class="details-deal mbs">
                                        <h2 class="majors">The Details</h2>
                                        <?= $item->description ?>

                                        <li>₦25 for ₦50 worth of contemporary Nigerian dinner for two or more</li>
                                        <li>₦50 for ₦100 worth of contemporary Ijebu dinner for four or more</li>
                                        <br>
                                        <h2 class="majors">The Business</h2>
                                        <p><?= $item->merchant->short_description ?></p>
                                    </div>

                                    <div class="redeem-mobile mb clearfix">
                                        <h2 class="majors">Redeem with your mobile</h2>

                                        <div class="big-phone left"></div>

                                        <div class="how-to-redeem right">

                                            <ol>
                                                <li>Buy any deal that you like</li>
                                                <li>Go to "My Deals" find the deal that you want to redeem</li>
                                                <li>Show your screen at the time of purchase. No need to print.</li>
                                            </ol>

                                            <p>*Just in case you don't have a phone, you can redeem your offer by printing out your voucher or presenting your reference number at the deal location. Help save the planet.</p>
                                        </div>

                                    </div>
                                </section>

                                <section class="right business-related mb">

                                    <div class="deal-business mbs">
                                        <div class="maps"><img src="<?= base_url($item->merchant->logo) ?>"></div>

                                        <h2><?= $item->merchant->business_name ?></h2>
                                        <p><?= substr($item->merchant->short_description, 0, 70) ?></p>

                                        <ul>
                                            <li><span>Address:</span><?= $item->merchant->address ?></li>
                                            <li><span>Phone no:</span><?= $item->merchant->mobile_number ?></li>
                                            <li><span>Menu:</span> See Website</li>
                                            <li><span>Opening Days:</span><?= $item->merchant->opening_hours ?></li>
                                            <li><span>Website:</span> <a href="<?= $item->merchant->website ?>"><?= $item->merchant->website ?></a></li>
                                        </ul>
                                    </div>

                                </section>
                            </div><!--End of sections-->

                            <div class="related-deals mb"><!--Related deals-->
                                <h2 class="majors">Related Deals</h2>

                                <ul class="clearfix">

                                    <li>
                                        <a href="">
                                            <div class="deal-img"><img src="offers/1.webp"></div>

                                            <div class="deal-details">
                                                <h3>Free Amala and Ewedu</h3>
                                                <p>Eya Basira</p>

                                                <span class="deal-location" title="Deal Location">Mushin</span>

                                                <ul class="">
                                                    <li class="normal-price">N2,000</li>
                                                    <li class="discount-price clearfix">
                                                        <span class="tag">DEAL <em></em></span>
                                                        <span>₦1,200</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="">
                                            <div class="deal-img"><img src="offers/1.webp"></div>

                                            <div class="deal-details">
                                                <h3>Free Amala and Ewedu</h3>
                                                <p>Eya Basira</p>

                                                <span class="deal-location" title="Deal Location">Mushin</span>

                                                <ul class="">
                                                    <li class="normal-price">N2,000</li>
                                                    <li class="discount-price clearfix">
                                                        <span class="tag">DEAL <em></em></span>
                                                        <span>₦1,200</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="">
                                            <div class="deal-img"><img src="offers/1.webp"></div>

                                            <div class="deal-details">
                                                <h3>Free Amala and Ewedu</h3>
                                                <p>Eya Basira</p>

                                                <span class="deal-location" title="Deal Location">Mushin</span>

                                                <ul class="">
                                                    <li class="normal-price">N2,000</li>
                                                    <li class="discount-price clearfix">
                                                        <span class="tag">DEAL <em></em></span>
                                                        <span>₦1,200</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="">
                                            <div class="deal-img"><img src="offers/1.webp"></div>

                                            <div class="deal-details">
                                                <h3>Free Amala and Ewedu</h3>
                                                <p>Eya Basira</p>

                                                <span class="deal-location" title="Deal Location">Mushin</span>

                                                <ul class="">
                                                    <li class="normal-price">N2,000</li>
                                                    <li class="discount-price clearfix">
                                                        <span class="tag">DEAL <em></em></span>
                                                        <span>₦1,200</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </a>
                                    </li>

                                </ul>
                            </div><!--End related deals-->

                            </div>

                        <?php }
                        ?>