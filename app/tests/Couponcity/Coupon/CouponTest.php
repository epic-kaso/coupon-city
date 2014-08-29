<?php
/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 8/28/14
 * Time: 11:36 AM
 */

namespace Couponcity\Coupon;


class CouponTest extends \TestCase {

    public function setUp(){
        parent::setUp();
        $this->coupon = new Coupon(['merchant_id'=>1]);
    }
    public function testSlugIsCreatedOnSettingName(){
        $name = "Blackberry Bold 5";
        $expected_slug = "blackberry-bold-5";

        $this->coupon->name = $name;
        $this->coupon->save();

        $this->assertEquals($expected_slug,$this->coupon->slug);
    }

    public function testCouponCodeGenerationIsUnique(){
        $code = $this->coupon->createCouponCode();

        $pattern = '/[a-zA-Z0-9]+/';
        $this->assertEquals(1,preg_match($pattern,$code),"Code Matches expected pattern");
    }

    public function testCouponNotAvailableAtQuantityZero(){
        $name = "Blackberry Bold 7";
        $this->coupon->name = $name;
        $this->coupon->quantity = 0;
        $this->coupon->save();
        $this->assertFalse($this->coupon->is_available());
    }
} 