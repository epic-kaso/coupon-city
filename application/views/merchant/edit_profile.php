<div class="container">
    <?= $breadcrumbs ?>
</div>
<div class="gap"></div>
<div class="merchant-body left clearfix">
    <div class="hold right">
        <div class="clearfix">
            <h1 class="left">Edit your Profile</h1>
        </div>
        <?php if (!empty($success_msg)) { ?>
            <div class='alert form-alert alert-success'><p><?= $success_msg ?></p></div>
        <?php } ?>
        <?php if (!empty($error_msg)) { ?>
            <div class='alert form-alert alert-error'><p><?= $error_msg ?></p></div>
        <?php } ?>
        <form action="<?= base_url(Merchant::MERCHANT_URL . '/edit-profile') ?>" method="post" enctype="multipart/form-data">
            <fieldset class="segment clearfix">
                <legend>Basic Information</legend>

                <ul class="clearfix">
                    <li class="left split-input">
                        <label>Full Name:</label>
                        <input type="text" value="<?= $profile->contact_name; ?>" name="contact_name" />
                    </li>
                    <li class="left split-input">
                        <label>Mobile No:</label>
                        <input type="text" value="<?= $profile->mobile_number; ?>" name="mobile_number" />
                    </li>
                </ul>
            </fieldset>

            <fieldset class="segment clearfix">
                <legend>Business Information</legend>

                <ul class="clearfix">
                    <li class="left split-input">
                        <label>Business Logo:</label>
                        <input type="file" name="userfile"/>
                    </li>
                    <li class="left split-input">
                        <label>Business Name:</label>
                        <input type="text" value="<?= $profile->business_name; ?>" name="business_name" />
                    </li>
                    <li class="left split-input">
                        <label>Category:</label>
                        <input type="text" value="<?= $profile->category; ?>" name="category" />
                    </li>
                    <li class="left split-input">
                        <label>Website:</label>
                        <input type="text" value="<?= $profile->website; ?>" name="website" />
                    </li>
                    <li class="left split-input">
                        <label>Address:</label>
                        <input type="text" value="<?= $profile->address_one; ?>" name="address_one" /><br/>
                        <label>Address 2:</label>
                        <input type="text" value="<?= $profile->address_two; ?>" name="address_two" /><br/>
                        <label>City:</label>
                        <input type="text" value="<?= $profile->city; ?>" name="city" /><br/>
                        <label>State:</label>
                        <input type="text" value="<?= $profile->state; ?>" name="state" /><br/>
                    </li>
                    <li class="left split-input">
                        <label>Description:</label>
                        <textarea name="short_description" placeholder="" cols="4" rows="10">
                            <?= $profile->short_description; ?>
                        </textarea>
                    </li>
                    <li class="left split-input"><label>Operating Hours:</label>
                        <textarea name="opening_hours" placeholder="" cols="4">
                            <?= $profile->opening_hours; ?>
                        </textarea>
                    </li>
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
            <input type="submit" value="Save" class="btn btn-primary">
        </form>
    </div>
    <?php
    echo partial('partials/_merchant_footer', array('year' => time('y')));
    ?>
</div>
<div class="merchant-body right">
    <div class="hold">
        <h2>Create your Profile</h2>
        <p>Complete your personal details and that of your business. This information is makes you look more reliable and commands trust and comfort in users who are interested in your business discounts.</p>
        <p>It also makes it easy for us to communicate with you regarding any business issues and make deposits to your bank account as promised without any hitch.</p>
    </div>
</div>
