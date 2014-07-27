<div class="span3">
    <ul class="nav nav-list">
        <li><a href="<?= base_url('settings'); ?>">Settings</a></li>
        <li><a href="<?= base_url('my-coupons'); ?>">My coupons</a></li>
    </ul>
</div>


<div class="offset3 span6">
    <div><h3>Profile Status: <?= $profile->status; ?></h3></div>
    <table class="table">
        <thead>
            <tr>
                <td></td>
                <td><a href="<?= base_url('edit-profile'); ?>">Edit</a></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Email: </td>
                <td><?= $profile->email; ?></td>

            </tr>
            <tr>
                <td>First Name: </td>
                <td><?= $profile->first_name; ?></td>

            </tr>
            <tr>
                <td>Last Name: </td>
                <td><?= $profile->last_name; ?></td>

            </tr>

            <tr>
                <td>Phone Number: </td>
                <td><?= $profile->phone; ?></td>

            </tr>
        </tbody>
    </table>
</div>
