<?= partial('partials/_header_nav', array('logged_in' => $logged_in, 'user' => @$user)); ?>
<!-- LOGIN REGISTER LINKS CONTENT -->
<?= partial('partials/account/_login', array('show_fb_login', TRUE)); ?>
<?= partial('partials/account/_create_user', array('show_fb_login', TRUE)); ?>
<?= partial('partials/account/_forgot_password', array()); ?>
<?= partial('partials/_wallet', array()); ?>
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
