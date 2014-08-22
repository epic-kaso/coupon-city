        <?php
        $items = $coupons->items();
        if(count($items) == 1 && property_exists($items[0], 'empty') ){
            ?>
            <div class="if-no-deal">
                <div class="no-deal no-coupons"></div>
                <p>You currently have no Coupons</p>
                <p>Give discounts and drive customers to your business. We are here to help you. <a href="">Start here</a></p>
            </div>
        <?php
        }else{ ?>
        <table>
            <tr>
                <th>Date</th>
                <th>ID</th>
                <th>Coupon Name</th>
                <th>State</th>
            </tr>
        <?php
        foreach ($coupons->items() as $coupon) {
        ?>
        <tr>
            <td><?= $coupon->created_at ?></td>
            <td><?= $coupon->coupon_code ?></td>
            <td class="align-left">
                <a href='<?= base_url(Merchant::MERCHANT_URL . '/my-coupon/' . $coupon->slug) ?>'>
                    <?= $coupon->name ?></a>
            </td>
            <td>
                <?=
                $coupon->deal_status == 1 ? '<span class="trans-state verified-trans">Active</span>' :
                    '<span class="trans-state pending-trans">Inactive</span>';
                ?>
            </td>
        </tr>
        <?php
            }
          ?>
        </table>
       <?php
        }
        ?>



