<script>
    my_globals = my_globals || {};
    my_globals.categories = <?= json_encode($categories->items()); ?>
</script>

<div ng-init="base_url = '<?= base_url(); ?>'"></div>

<div class="merchant-body left clearfix">

    <div class="hold right">

        <div class="clearfix export-header">
            <h1 class="left">Create Coupon</h1>

            <a href="<?= base_url('/merchant/my-coupons'); ?>" class="btn right export">&laquo; See all Coupons</a>
        </div>

        <form ng-submit="submitCoupon(coupon)" class="dialog-form" name="coupon_form">
            <div class="segment">

                <!--Holds form errors-->
                <?php if (!empty($success_msg)) { ?>
                    <div class='alert alert-success'><p><?= $success_msg ?></p></div>
                <?php } ?>
                <?php if (!empty($error_msg)) { ?>
                    <div class='alert alert-error'><p><?= $error_msg ?></p></div>
                <?php } ?>

                <h2>Coupon Information</h2>
                <input type="text" placeholder="Coupon Name">
                
                <div class="clearfix split-input">
                    <input type="text" placeholder="Tagline" class="left">
                    <div class="select-input right">
                        <select>
                            <option>Select Category</option>
                            <option>Advertising</option>
                            <option>Food &amp; Catering</option>
                        </select>
                    </div>
                </div>

                <p>You might know this as a fine print but essentially its any information related to the coupon and its use. You might know this as a fine print but essentially its any information related to the coupon and its use. <a href="">Learn more &raquo;</a></p>
                <textarea placeholder="What customers need to know"></textarea>

            </div>

            <div class="segment">
                <h2>Coupon Details</h2>

                <p>Enter details of the good or service you are offering through this coupon. Customers need all details of what they are buying. You might know this as a fine print but essentially its any information related to the coupon and its use.<a href="">Learn more &raquo;</a></p>
                <textarea placeholder="The details"></textarea>

                <div class="clearfix split-input">
                    <input type="text" placeholder="Start Date" class="left">
                    <input type="text" placeholder="End Date" class="right">
                </div>

                <div class="clearfix split-input">
                    <div class="clearfix split-input left">
                        <input type="text" placeholder="Price" class="old_price left">
                        <input type="text" placeholder="Max. Coupons" class="max_coupons right">
                    </div>
                    
                    <input type="text" placeholder="Market" class="right">
                </div>

                <div class="clearfix coupon-images">
                    <p>You can enter up to 5 images. Make sure they are hi-res, clear with a minimum resolution of 700px by 500px</p>

                    <div class="file-upload left">
                        <input type="file" class="upload" title="Upload Logo">
                        <img alt="" class="target" src="">
                    </div>

                    <div class="file-upload left">
                        <input type="file" class="upload" title="Upload Logo">
                        <img alt="" class="target" src="">
                    </div>

                    <div class="file-upload left">
                        <input type="file" class="upload" title="Upload Logo">
                        <img alt="" class="target" src="">
                    </div>

                    <div class="file-upload left">
                        <input type="file" class="upload" title="Upload Logo">
                        <img alt="" class="target" src="">
                    </div>

                    <div class="file-upload right">
                        <input type="file" class="upload" title="Upload Logo">
                        <img alt="" class="target" src="">
                    </div>
                </div>
            </div>
            
            <div class="segment clearfix">
                <h2>Pricing</h2>

                <div class="basic-type-pricing clearfix three-input">
                    <input type="text" placeholder="New Price" class="new_price left">
                    <input type="text" placeholder="% Discount" class="basic_discount left">
                    <input type="text" placeholder="Actual % Discount" class="actual_discount right">
                </div>


                <div class="segment-inner">
                    <p>You can turn on Advanced pricing here. Advanced Pricing lets you inspire more sales by dropping prices as customer number go up. <a href="">Learn more &raquo;</a></p>

                    <input type="checkbox" id="pricing-type" class="pricing-type" name="pricing-type" value="advanced">
                    <label for="pricing-type" class="m-b">Turn On Advanced Pricing</label>

                    <div class="advanced-type-pricing clearfix three-input">
                        <a href="">&laquo; Add Price Level</a>
                        <input type="text" placeholder="New Price" class="left">
                        <input type="text" placeholder="% Discount" class="left">
                        <input type="text" placeholder="No of Customers" class="right">
                    </div>

                </div>
              

            </div>

            <input type="submit" class="btn-submit btn" value="Create Coupon"> 
        </form>


    </div>
    <?php
    echo partial('partials/_merchant_footer', array('year' => time('y')));
    ?>
</div>


<div class="merchant-body right">
    <div class="hold">
        <h2>Create a Coupon</h2>
        <p>Complete your personal details and that of your business. This information is makes you look more reliable and commands trust and comfort in users who are interested in your business discounts.</p>
        <p>It also makes it easy for us to communicate with you regarding any business issues and make deposits to your bank account as promised without any hitch.</p>

        <h2>Our Margin</h2>
        <p>Our margin is 20% of your discount. If you are offering a discount of 12%, we take a 20% margin which means the customer gets a 9.6% discount. The view enable you adjust your parameters accordingly. </p>
    </div>
</div>



