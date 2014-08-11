<div class="container">
    <?= $breadcrumbs ?>
</div>
<div class="gap"></div>
<div class="row">
    <div class="offset3 span6">
        <?php if (!empty($success_msg)) { ?>
            <div class='alert alert-success'><p><?= $success_msg ?></p></div>
        <?php } ?>
        <?php if (!empty($error_msg)) { ?>
            <div class='alert alert-error'><p><?= $error_msg ?></p></div>
        <?php } ?>
    </div>
</div>
<div class="offset3 span6">
    <div><h3>Profile Status: <?= $profile->status; ?></h3></div>
    <table class="table">
        <thead>
            <tr>
                <td></td>
                <td><a href="<?= base_url(Merchant::MERCHANT_URL . '/edit-profile'); ?>">Edit</a></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Logo: </td>
                <td><img style="width: 80px;height: 80px" src="<?= ($profile->logo === 'N/A') ? base_url('assets/images/no_image.png') : base_url($profile->logo); ?>" /></td>
            </tr>
            <tr>
                <td>Email: </td>
                <td><?= $profile->email; ?></td>

            </tr>
            <tr>
                <td>Business Name: </td>
                <td><?= $profile->business_name; ?></td>

            </tr>
            <tr>
                <td>Contact Name: </td>
                <td><?= $profile->contact_name; ?></td>

            </tr>
            <tr>
                <td>Address 1: </td>
                <td><?= $profile->address_one; ?></td>

            </tr>
            <tr>
                <td>Address 2: </td>
                <td><?= $profile->address_two; ?></td>

            </tr>
            <tr>
                <td>City: </td>
                <td><?= $profile->city; ?></td>

            </tr>
            <tr>
                <td>State: </td>
                <td><?= $profile->state; ?></td>

            </tr>
            <tr>
                <td>Mobile Number: </td>
                <td><?= $profile->mobile_number; ?></td>

            </tr>
            <tr>
                <td>Website: </td>
                <td><?= $profile->website; ?></td>

            </tr>
            <tr>
                <td>Short description: </td>
                <td><?= $profile->short_description; ?></td>

            </tr>
            <tr>
                <td>Operating Hours: </td>
                <td><?= $profile->opening_hours; ?></td>

            </tr>
        </tbody>
    </table>
</div>
