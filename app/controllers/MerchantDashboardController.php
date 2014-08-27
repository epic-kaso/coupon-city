<?php

    use Couponcity\Coupon\Coupon;
    use Couponcity\Coupon\CouponSale;
    use Couponcity\Coupon\InvalidCouponCodeException;
    use Couponcity\Coupon\LogCouponRedemptionCommand;
    use Couponcity\Coupon\RedeemCoupon;
    use Couponcity\Merchant\Merchant;

    class MerchantDashboardController extends \BaseController
    {

        protected $data = [];

        protected $redeemCoupon;

        /**
         * Display a listing of the resource.
         * GET /merchantdashboard
         *
         * @return Response
         */

        public function __construct(RedeemCoupon $redeemCoupon)
        {
            $this->redeemCoupon = $redeemCoupon;

            $this->beforeFilter("auth_merchant");
            $this->beforeFilter("check_merchant_profile", ['except' => ['getBusiness', 'getEditProfile']]);

            $data = [];
            $data['status'] = Session::get('status');
            $data['user'] = Merchant::getCurrentMerchant();

            $this->data = $data;

        }


        public function getIndex()
        {
            return View::make('merchant_dashboard.index', $this->data);
        }

        public function getCoupons()
        {
            $items = Coupon::where('merchant_id', Merchant::getCurrentMerchant()->id)->get();

            $coupon_sales = CouponSale::totalSales(Merchant::getCurrentMerchant()->id);

            //$count = CouponView::totalViews(Merchant::getCurrentMerchant()->id);

            //dd($count);

            $this->data['items'] = $items;
            $this->data['coupon_sales'] = $coupon_sales;

            return View::make('merchant_dashboard.coupons', $this->data);

        }

        public function getCoupon($slug = NULL)
        {
            if (is_null($slug)) {
                return App::abort(404, 'Not Found');
            }

            $coupon = Coupon::where('slug', $slug)->where('merchant_id', Merchant::getCurrentMerchant()->id)->first();

            if (is_null($coupon)) {
                return App::abort(404, 'Not Found');
            }

            $this->data['coupon'] = $coupon;

            return View::make('merchant_dashboard.coupon-details', $this->data);
        }

        public function getAddCoupon()
        {
            $this->data['categories'] = CouponCategory::all(['id', 'name']);

            return View::make('merchant_dashboard.add-coupon', $this->data);
        }

        public function getRedeem()
        {
            return View::make('merchant_dashboard.redeem', $this->data);
        }

        public function getBusiness()
        {
            return View::make('merchant_dashboard.profile', $this->data);
        }

        public function getEditProfile()
        {
            return View::make('merchant_dashboard.edit-profile', $this->data);
        }

        public function getDeposit()
        {
            return View::make('merchant_dashboard.deposit', $this->data);
        }

        public function postRedeemCoupon()
        {
            $data = ['coupon_code' => 'required'];
            $coupon_code = Input::only(['coupon_code']);

            $validation = Validator::make($coupon_code, $data);

            if ($validation->fails()) {
                if (Request::ajax()) {
                    return Response::json(['error'], 403);
                } else {
                    return Redirect::back(403)->withError('Coupon Code Required or Invalid');
                }
            } else {
                $code = $coupon_code['coupon_code'];

                try {
                    $response = $this->redeemCoupon->redeem($code);
                } catch (InvalidCouponCodeException $ex) {
                    if (Request::ajax()) {
                        return Response::json($ex->getMessage(), 403);
                    } else {
                        return Redirect::back(403)->withError('Coupon Code Required or Invalid');
                    }
                }

                $this->execute(LogCouponRedemptionCommand::class, ['coupon_id' => $response->coupon_id, 'user_id' => $response->user_id]);

                if (Request::ajax()) {
                    return Response::json($response);
                } else {
                    return Redirect::back()->withStatus('Coupon Code redeemed Successfully!!');
                }
            }
        }

    }