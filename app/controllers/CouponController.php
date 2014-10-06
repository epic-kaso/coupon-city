<?php

    use Couponcity\Coupon\BuyCouponCommand;
    use Couponcity\Coupon\Coupon;
    use Couponcity\Coupon\CouponFormValidator;
    use Couponcity\Coupon\CouponUser;
    use Couponcity\Coupon\LogCouponSaleCommand;
    use Couponcity\Coupon\LogCouponViewCommand;
    use Couponcity\Coupon\NotEnoughMoneyException;
    use Couponcity\Coupon\PublishCouponCommand;
    use Couponcity\Coupon\UserOwnsCouponException;

    class CouponController extends \BaseController
    {

        protected $couponFormValidator;

        public function __construct(CouponFormValidator $couponFormValidator)
        {
            Breadcrumbs::addCrumb('coupon', 'coupon');
            $this->couponFormValidator = $couponFormValidator;
            parent::__construct();
            $this->beforeFilter('auth', ['only' => ['postGrabCoupon']]);
        }
        /**
         * Store a newly created resource in storage.
         * POST /coupon
         *
         * @return Response
         */
        public function postStore()
        {
            $this->couponFormValidator->validate(Input::get('coupon'));

            $coupon = $this->execute(PublishCouponCommand::class);

            return Redirect::action('MerchantDashboardController@getCoupons')->withStatus('Coupon Added Successfully');
        }


        public function getIndex($slug = NULL)
        {
            $facebook_login_url =  $this->fbHelper
                ->getLoginUrl(array('email'));
            $this->data['fb_url'] = $facebook_login_url;

            if (is_null($slug)) {
                App::abort(404, 'Not Found');
            }

            $coupon = Coupon::where('slug', $slug)->with('sales')->first();

            if (is_null($coupon)) {
                App::abort(404, 'Not Found');
            }

            $this->data['coupon'] = $coupon;

            $this->execute(LogCouponViewCommand::class, ['coupon_id' => $coupon->id]);

            return View::make('home.product', $this->data);
        }

        /**
         * Show the form for editing the specified resource.
         * GET /coupon/{id}/edit
         *
         * @param  int $id
         * @return Response
         */
        public function getEdit($id)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         * PUT /coupon/{id}
         *
         * @param  int $id
         * @return Response
         */
        public function postUpdate($id)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         * DELETE /coupon/{id}
         *
         * @param  int $id
         * @return Response
         */
        public function postDestroy($id)
        {
            //
        }

        /**
         * @param $id
         * @return mixed
         */
        public function postGrabCoupon($id)
        {
            $coupon = Coupon::findOrFail($id);

            $user_id = Auth::id();

            try {
                $response = $this->execute(BuyCouponCommand::class, ['coupon_id' => $coupon->id, 'user_id' => $user_id]);

            } catch (NotEnoughMoneyException $ex) {
                $response = $ex->getMessage();
                if (Request::ajax()) {
                    return Response::json($response, 403);
                } else {
                    return Redirect::back()->withError($response);
                }
            }

            $this->execute(LogCouponSaleCommand::class, ['coupon' => $coupon]);

            if (Request::ajax()) {
                return Response::json($response);
            } else {
                return Redirect::back()->withStatus('Coupon Bought Successfully!');
            }

        }

    }