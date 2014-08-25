<?php namespace Couponcity\Coupon;

class PublishCouponCommand
{

    public $name;
    public $tag_line;
    public $summary;
    public $description;
    public $old_price;
    public $new_price;
    public $discount;
    public $location;
    public $category_id;
    public $start_date;
    public $end_date;
    public $quantity;
    public $is_advanced_pricing;
    public $advanced_price_one_price;
    public $advanced_price_one_quantity;
    public $advanced_price_one_discount;
    public $advanced_price_two_price;
    public $advanced_price_two_quantity;
    public $advanced_price_two_discount;
    public $advanced_price_three_price;
    public $advanced_price_three_quantity;
    public $advanced_price_three_discount;
    public $image_one;
    public $image_two;
    public $image_three;
    public $image_four;
    public $image_five;

    /**
     * @param string attributes
     */

    public function __construct(
        $coupon = []
    )
    {
        $this->name = $coupon['name'];
        $this->tag_line = $coupon['tag_line'];
        $this->summary = $coupon['summary'];
        $this->description = $coupon['description'];
        $this->old_price = $coupon['old_price'];
        $this->new_price = $coupon['new_price'];
        $this->discount = $coupon['discount'];
        $this->location = $coupon['location'];
        $this->category_id = $coupon['category_id'];
        $this->start_date = $coupon['start_date'];
        $this->end_date = $coupon['end_date'];
        $this->quantity = $coupon['quantity'];
        $this->is_advanced_pricing = isset($coupon['is_advanced_pricing']) ? TRUE : FALSE;
        $this->advanced_price_one_price = $coupon['advanced_price_one_price'];
        $this->advanced_price_one_quantity = $coupon['advanced_price_one_quantity'];
        $this->advanced_price_one_discount = $coupon['advanced_price_one_discount'];
        $this->advanced_price_two_price = $coupon['advanced_price_two_price'];
        $this->advanced_price_two_quantity = $coupon['advanced_price_two_quantity'];
        $this->advanced_price_two_discount = $coupon['advanced_price_two_discount'];
        $this->advanced_price_three_price = $coupon['advanced_price_three_price'];
        $this->advanced_price_three_quantity = $coupon['advanced_price_three_quantity'];
        $this->advanced_price_three_discount = $coupon['advanced_price_three_discount'];
        $this->image_one = isset($coupon['image_one']) ? $coupon['image_one'] : STAPLER_NULL;
        $this->image_two = isset($coupon['image_two']) ? $coupon['image_two'] : STAPLER_NULL;
        $this->image_three = isset($coupon['image_three']) ? $coupon['image_three'] : STAPLER_NULL;
        $this->image_four = isset($coupon['image_four']) ? $coupon['image_four'] : STAPLER_NULL;
        $this->image_five = isset($coupon['image_five']) ? $coupon['image_five'] : STAPLER_NULL;
    }

}