<div class="merchant-body left clearfix">

    <div class="hold right">
        <div class="clearfix">
            <h1 class="left">Your Profile </h1>
            <?= $profile->status; ?>

            <a href="<?= base_url(Merchant::MERCHANT_URL . '/edit-profile'); ?>" class="export btn right">Edit</a>
        </div>

        <?php if (!empty($success_msg)) { ?>
            <div class='alert form-alert alert-success'><p><?= $success_msg ?></p></div>
        <?php } ?>
        <?php if (!empty($error_msg)) { ?>
            <div class='alert form-alert alert-error'><p><?= $error_msg ?></p></div>
        <?php } ?>

        <div class="profile-top">
            <div>
                <img src="<?= ($profile->logo === 'N/A') ? base_url('assets/images/coke.png') : base_url($profile->logo); ?>" />
            </div>

            <h3><?= $profile->business_name; ?></h3>
            <p><?= $profile->address_one; ?></p>
            <p><?= $profile->address_two; ?></p>
            <p><?= $profile->city; ?></p>
            <p><?= $profile->state; ?></p>
        </div>

        <fieldset class="segment clearfix">
            <legend>Basic Information</legend>

            <ul class="clearfix">
                <li class="left split-input"><label>Full Name:</label> <?= $profile->contact_name; ?></li>
                <li class="left split-input"><label>Email:</label> <?= $profile->email; ?></li>
                <li class="left split-input"><label>Mobile No:</label> <?= $profile->mobile_number; ?></li>
            </ul>
        </fieldset>

        <fieldset class="segment clearfix">
            <legend>Business Information</legend>

            <ul class="clearfix">
                <li class="left split-input"><label>Business Name:</label> <?= $profile->business_name; ?></li>
                <li class="left split-input"><label>Category:</label> Food, Entertainment</li>
                <li class="left split-input"><label>Website:</label> <?= $profile->website; ?></li>
                <li class="left split-input">
                    <label>Address:</label> 
                    <?= $profile->address_one; ?><br/>
                    <?= $profile->address_two; ?><br/>
                    <?= $profile->city; ?><br/>
                    <?= $profile->state; ?>
                </li>
                <li class=""><label>Description:</label> <?= $profile->short_description; ?></li>
                <li class=""><label>Operating Hours:</label> <?= $profile->opening_hours; ?></li>
            </ul>
        </fieldset>

        <fieldset class="segment clearfix">
            <legend>Bank Details</legend>

            <ul class="clearfix">
                <li class="left split-input"><label>Bank Name:</label> Diamond Bank</li>
                <li class="left split-input"><label>Account No:</label> 1234567890</li>
                <li class="left split-input"><label>Account Type:</label> Savings</li>

            </ul>
        </fieldset>

    </div>
    <div class="merchant-footer">
        <div class="center">
            &copy; 2014 Couponcity. 
            <a href="">Terms</a>
            <a href="">Privacy</a>
            <a href="">Legal</a>
            <a href="">Help</a>
        </div>
    </div>
</div>

<div class="merchant-body right">
    <div class="hold">
        <h2>Your Profile</h2>
        <p>Complete your personal details and that of your business. This information is makes you look more reliable and commands trust and comfort in users who are interested in your business discounts.</p>
        <p>It also makes it easy for us to communicate with you regarding any business issues and make deposits to your bank account as promised without any hitch.</p>
    </div>
</div>
