<table class="table table-striped">
    <thead>
        <tr>
            <td>Name</td>
            <td>Summary</td>
            <td>Active</td>
            <td>Start Date</td>
            <td>End Date</td>
            <td>Details</td>
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
                    <td><button>Details..</button></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>