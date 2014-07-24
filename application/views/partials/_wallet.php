<div id="wallet-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
    <i class="icon-credit-card dialog-icon"></i>
    <h3>Wallet</h3>
    <div class="row-fluid">
        <h1>Fund your Coupon Wallet.</h1>
        <p>It's so easy, all you need is your master/visa card</p>

        <form class="dialog-form" id="payment_form" method="post" action="http://gpayexpress.com/gpay/gpayexpress.php" >
            <input type="hidden" name="merchantID" value="140201"/>
            <input type="hidden" name="itemName" value="Coupon Wallet"/>
            <input type="hidden" name="itemDesc" value="Coupon Wallet, easy way to grab coupons on the go"/>
            <input type="hidden" name="itemImageURL" value="<?= base_url('assets/img/logo_200.png'); ?>"/>
            <input type="hidden" name="successURL" value="<?= base_url('wallet/success/' . $user_id); ?>"/>
            <input type="hidden" name="failURL" value="<?= base_url('wallet/failure/' . $user_id); ?>"/>
            <label>Select Amount:
                <select id="select-amount"
                        name="itemPrice"
                        class="span12">
                    <option value="1">N1</option>
                    <option value="2000" selected="true">N2,000</option>
                    <option value="5000">N5,000</option>
                    <option value="7000">N7,000</option>
                    <option value="10000">N10,000</option>
                    <option value="15000">N15,000</option>
                    <option value="20000">N20,000</option>
                </select>
            </label>
            <label for="password"><strong>Confirm Password:</strong></label>
            <input required class="span12" type="password" name="password" id="password" value="" placeholder="your password">
            <input class="btn btn-primary btn-large" type="submit" id="pay_now" name="pay_now" value="Pay Now" />
            <img src="http://gpayexpress.com/gpay/images/gpay_express.png" />

        </form>
    </div>

</div>