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
            $this->couponFormValidator = $couponFormValidator;
            parent::__construct();
            $this->beforeFilter('auth', ['only' => ['postGrabCoupon']]);
        }


        /**
         * Display a listing of the resource.
         * GET /coupon
         *
         * @return Response
         */
        public function getIndex()
        {
            //
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


        public function getShow($slug = NULL)
        {


            if (is_null($slug)) {
                return App::abort(404, 'Not Found');
            }

            $coupon = Coupon::where('slug', $slug)->first();

            if (is_null($coupon)) {
                return App::abort(404, 'Not Found');
            }

            $this->data['coupon'] = $coupon;

            if (Auth::check()) {
                $user_coupon = CouponUser::where('user_id', Auth::id())->where('coupon_id', $coupon->id)->first();

                $this->data['user_owns_coupon'] = !empty($user_coupon) ? TRUE : NULL;
            }


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
            } catch (UserOwnsCouponException $ex) {
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