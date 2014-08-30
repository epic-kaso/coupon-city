<?php
/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 8/29/14
 * Time: 12:24 PM
 */

namespace Couponcity\Coupon;

use Mail;

class UserCouponRefundHandler {

    private $couponSales;
    private $mailer;


    private $currentUser;
    private $currentCouponId;
    private $currentCoupon;
    private $currentCouponSale;

    public function __construct(CouponSale $couponSales,Mail $mailer){
        $this->$couponSales = $couponSales;
        $this->mailer = $mailer;
    }

    public function refundUsersOf($coupon_id,$price){
        $this->currentCouponId = $coupon_id;
        $this->execute($price);
    }

    private function execute($price){
        $couponSales = $this->getUsersFor($this->currentCouponId);
        $response = [];
        foreach($couponSales as $couponSale){
            $this->currentCouponSale = $couponSale;
            $this->currentUser = $couponSale->user;
            $this->currentCoupon = $couponSale->coupon;
            $response[$couponSale->id] = $this->processCouponSaleRefund($price);
        }
        return $response;
    }

    private function getUsersFor($coupon_id){
        return $this->couponSales->with('coupon','user')->where('coupon_id',$coupon_id)->get();
    }

    private function processCouponSaleRefund($price){

        $difference = $this->currentCouponSale->sales_price - $price;
        $this->currentCouponSale->sales_price = $price;

        return $this->refundUser($difference);

    }

    private function refundUser($amount){
        if($this->currentUser->creditWallet($amount)){
            return $this->notifyUserOfRefund();
        }else{
            return false;
        }
    }

    private function notifyUserOfRefund()
    {
        $coupon_name = "";
        $refund_amount = "";
        $user = $this->currentUser;

        $this->mailer->queue('emails.coupon-refund',compact('coupon_name','refund_amount'),function($message) use ($user){
            $message->to($user->email)
                ->from('finance@couponcity.com.ng')
                ->subject('Couponcity: Coupon Refund Alert');
        });
        return true;
    }

} 