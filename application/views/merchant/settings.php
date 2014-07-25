<!--
id	int(10)
email	varchar(100)
password	varchar(100)
business_name	text
contact_name	text
address_one	text
address_two	text
area	text
business_category	text
mobile_number	varchar(20)
short_description	text
website	text
logo	text
opening_hours	text
is_profile_complete	int(1)

-->
<?= partial('partials/merchant/_header_nav', array('logged_in' => $logged_in, 'merchant' => @$merchant)); ?>
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
    <div><h2>Account Settings</h2></div>
    <table class="table">
        <thead>
            <tr>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><h3>Change Password: </h3></td>
                <td><a class="popup-text" href="#change-password-dialog" data-effect="mfp-move-from-top"><h3><i class="icon-edit-sign"></i></h3></a></td>
            </tr>
        </tbody>
    </table>
</div>


<div id="change-password-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
    <i class="icon-edit-sign dialog-icon"></i>
    <h3>Change Password</h3>
    <div class="row-fluid">
        <form class="dialog-form" action="<?= base_url('merchant/change_password'); ?>" method="post">
            <input type="hidden" name="redirect" value="<?= str_replace('index.php', '', current_url()); ?>" />
            <input type="hidden" name="user_id" value="<?= $profile->id; ?>" />
            <label>New Password</label>
            <input name="password" type="password" placeholder="" class="span12">
            <label>Confirm New Password</label>
            <input name="re_password" type="password" placeholder="" class="span12">
            <input type="submit" value="Change" class="btn btn-primary">
        </form>
    </div>
</div>