<table>
    <thead>
        <tr>
            <td>Name</td>
            <td>Summary</td>
            <td>Active</td>
            <td>Start Date</td>
            <td>End Date</td>
            <td>&nbsp;</td>
        </tr>
    </thead>

    <tbody>
        <?php
        foreach ($coupons->items() as $coupon) {
            if (property_exists($coupon, 'empty')) {
                ?>
                <tr>
                    <td colspan="6"><?= $coupon->name ?></td>
                </tr>
            <?php } else {
                ?>
                <tr>
                    <td><?= $coupon->name ?></td>
                    <td><?= $coupon->summary ?></td>
                    <td><?= $coupon->deal_status == 1 ? 'Active' : 'Inactive'; ?></td>
                    <td><?= $coupon->start_date ?></td>
                    <td><?= $coupon->end_date ?></td>
                    <td><a href='<?= base_url(Merchant::MERCHANT_URL . '/my-coupon/' . $coupon->slug) ?>'>Details..</a></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>