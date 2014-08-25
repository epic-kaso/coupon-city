<?php

    use Couponcity\Coupon\Coupon;
    use Couponcity\Coupon\CouponFormValidator;
    use Couponcity\Coupon\LogCouponViewCommand;
    use Couponcity\Coupon\PublishCouponCommand;

    class CouponController extends \BaseController {

    protected $couponFormValidator;

    public function __construct(CouponFormValidator $couponFormValidator)
    {
        $this->couponFormValidator = $couponFormValidator;
        parent::__construct();
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
		dd($coupon);
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

            $this->execute(LogCouponViewCommand::class, ['coupon_id' => $coupon->id]);

            return View::make('home.product', $this->data);
        }

	/**
	 * Show the form for editing the specified resource.
	 * GET /coupon/{id}/edit
	 *
	 * @param  int  $id
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
	 * @param  int  $id
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
	 * @param  int  $id
	 * @return Response
	 */
	public function postDestroy($id)
	{
		//
	}

}