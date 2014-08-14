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

<!---->

<div class="if-no-deal">
    <div class="no-deal no-coupons"></div>
    <p>You currently have no Coupons</p>
    <p>Give discounts and drive customers to your business. We are here to help you. <a href="">Start here</a></p>
</div> 


<table>
    <tr>
        <th>Date</th>
        <th>ID</th>
        <th>Coupon Name</th>
        <th>State</th>
    </tr>

    <tr>
        <td>12 May 3:20pm</td>
        <td>34567890DFFC</td>
        <td class="align-left"><a href="">The Chicken Pie Deal 50% Off</a></td>
        <td><span class="trans-state verified-trans">Active</span></td>
    </tr>

    <tr>
        <td>12 May 3:20pm</td>
        <td>34567890DFFC</td>
        <td class="align-left"><a href="">The Chicken Pie Deal 50% Off</a></td>
        <td><span class="trans-state pending-trans">Pending</span></td>
    </tr>

    <tr>
        <td>12 May 3:20pm</td>
        <td>34567890DFFC</td>
        <td class="align-left"><a href="">The Chicken Pie Deal 50% Off</a></td>
        <td><span class="trans-state cancelled-trans">Completed</span></td>
    </tr>
</table>



