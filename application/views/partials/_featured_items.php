
<?php if ($featured_items !== FALSE) { ?>

    <!--structure 3 featured coupons at any given time-->
    <div class="featured-deal clearfix mb">
        <div class="left slide-list-vert">
            <ul>
                <?php foreach ($featured_items as $row) { ?>
                    <li>
                        <div class="list-img"><!--Coupon image-->
                            <img src="<?= $row->cover_image_url ?>">
                        </div>

                        <div class="right">
                            <h3><?= $row->name ?></h3><!--Coupon Name-->
                            <p><?= $row->summary ?></p><!--Coupon Description-->
                            <a href="<?= $row->link ?>">See Deal</a><!--link to coupon page-->
                        </div>
                    </li>
                <?php }
                ?>
            </ul>
        </div>

        <div class="right actual-slider">
            <ul class="bjqs">
                <!--These same coupons appear here in a list-->
                <?php foreach ($featured_items as $row) { ?>
                    <li>
                        <a href="<?= $row->link ?>" title="<?= $row->name ?>"><img src="<?= $row->cover_image_url ?>"></a>
                    </li>
                <?php }
                ?>
            </ul>
        </div>
    </div>
    <?php
}?>