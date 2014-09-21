<?php

    use Couponcity\Coupon\FeaturedCoupon;

    class CouponListingController extends \BaseController
    {

        public function __construct(){
            Breadcrumbs::addCrumb('category', 'category');
        }

        /**
         * Display a listing of the resource.
         * GET /couponlisting
         *
         * @return Response
         */
        public function index()
        {
            //
        }

        /**
         * Show the form for creating a new resource.
         * GET /couponlisting/create
         *
         * @return Response
         */
        public function create()
        {
            //
        }

        /**
         * Store a newly created resource in storage.
         * POST /couponlisting
         *
         * @return Response
         */
        public function store()
        {
            //
        }

        public function getShow($slug = NULL)
        {
            if (is_null($slug)) {
                App::abort(404, 'Not Found');
            }

            $categories = CouponCategory::with(['coupons'])->get();
            $category = CouponCategory::where('slug', $slug)->with('coupons')->first();

            $featured_deal = FeaturedCoupon::with(['coupon' => function ($query) use ($category) {
                    $query->where('category_id', $category->id);
                }])->first();
            if (is_null($category)) {
                App::abort(404, 'Not Found');
            }

            $this->data['current_category'] = $category;
            $this->data['categories'] = $categories;
            $this->data['featured_deal'] = $featured_deal;


            return View::make('home.category_list', $this->data);
        }

        /**
         * Show the form for editing the specified resource.
         * GET /couponlisting/{id}/edit
         *
         * @param  int $id
         * @return Response
         */
        public function edit($id)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         * PUT /couponlisting/{id}
         *
         * @param  int $id
         * @return Response
         */
        public function update($id)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         * DELETE /couponlisting/{id}
         *
         * @param  int $id
         * @return Response
         */
        public function destroy($id)
        {
            //
        }

    }