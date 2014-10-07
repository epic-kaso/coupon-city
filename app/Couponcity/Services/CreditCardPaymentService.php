<?php
/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 10/7/2014
 * Time: 8:39 PM
 */

namespace Couponcity\Services;


class CreditCardPaymentService {

    public function generateTransaction($coupon,$user_id){

    }
}

    /*
     * <form method="post" action="http://gpayexpress.com/gpay/gpayexpress.php">
            <input type="hidden" name="merchantID" value="140201"/>
            <input type="hidden" name="itemName" value="Blackberry"/>
            <input type="hidden" name="itemPrice" value="40000"/>
            <input type="hidden" name="itemDesc" value="Blackberry Phone"/>
            <input type="hidden" name="itemImageURL" value="http://localhost:8000/system/Couponcity/Coupon/Coupon/image_twos/000/000/001/normal/BlackBerry-Z10-Images.jpg"/>
            <input type="hidden" name="successURL" value="/credit-card/success"/>
            <input type="hidden" name="failURL" value="/credit-card/failure"/>
            <input type="image" src="http://gpayexpress.com/gpay/images/gpay_express.png"/>
        </form>
     */