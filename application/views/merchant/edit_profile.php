
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

            <div class="segment clearfix">
                <h2>Basic Information</h2>
                <input type="text" value="<?= $profile->contact_name; ?>" name="contact_name" placeholder="Full Name" />

                <div class="split-input clearfix">
                    <input type="text" value="<?= $profile->email; ?>" name="email" placeholder="you@business.com" class="left" />
                    <input type="text" value="<?= $profile->mobile_number; ?>" name="mobile_number" class="right" />
                </div>
            </div>

            <div class="segment clearfix">
                <h2>Business Information</h2>

                <input type="text" value="<?= $profile->business_name; ?>" name="business_name" placeholder="Business Name" />

                <div class="left b-details">

                    <div class="clearfix split-input">
                        <input type="text" value="<?= $profile->website; ?>" name="website" placeholder="Website" class="left" />

                        <div class="select-input right">
                            <select>
                                <option>Select Category</option>
                                <option>Advertising</option>
                                <option>Food &amp; Catering</option>
                            </select>
                        </div>
                    </div>

                    <input type="text" value="<?= $profile->address_one; ?>" name="address_one" placeholder="Address 1" />
                    <input type="text" value="<?= $profile->address_two; ?>" name="address_two" placeholder="Address 2" />

                    <div class="clearfix split-input">
                        <input type="text" value="<?= $profile->city; ?>" name="city" placeholder="City" class="left" />
                        <input type="text" value="<?= $profile->state; ?>" name="state" placeholder="State" class="right" />
                    </div>

                </div>

                <div class="file-upload right">
                    <input type="file" name="userfile" class="upload business-logo" title="Upload Logo" />
                    <img alt="" class="target" src="">
                </div>

                <div class="clearfix split-input">
                    <textarea name="short_description" placeholder="Business Description" cols="4" rows="10" class="left"><?= $profile->short_description; ?></textarea>

                    <textarea name="opening_hours" placeholder="Operating Hours" cols="4" rows="10" class="right"><?= $profile->opening_hours; ?></textarea>
                </div>

            </div>

            <div class="segment">
                <h2>Bank Details</h2>
                <input type="text" placeholder="Account Number" value="<?= $profile->account_number; ?>" name="account_number" />

                <div class="split-input clearfix">

                    <div class="select-input left">
                        <select name="bank_name">
                            <option>Choose Bank</option>
                            <?php $selected = $profile->bank_name == 'Access Bank' ?>
                            <option <?= $selected ? 'selected' : '' ?>>Access Bank</option>
                            <?php $selected = $profile->bank_name == 'Keystone Bank' ?>
                            <option <?= $selected ? 'selected' : '' ?>>Keystone Bank</option>
                        </select>
                    </div>

                    <div class="select-input right">
                        <select name="account_type">
                            <option>Account Type</option>
                            <?php $selected = $profile->account_type == 'Savings' ?>
                            <option <?= $selected ? 'selected' : '' ?>>Savings</option>
                            <?php $selected = $profile->account_type == 'Current' ?>
                            <option <?= $selected ? 'selected' : '' ?>>Current</option>
                        </select>
                    </div>

                </div>

                <div class="bank-logo"></div>
            </div>

            <input type="submit" value="Update Business Profile" class="btn btn-submit">

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
