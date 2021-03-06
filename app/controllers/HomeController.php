<?php


    use Couponcity\Coupon\Coupon;
    use Couponcity\Coupon\CouponUser;
    use Couponcity\FrontEnd\FrontEnd;
    use Couponcity\User\User;
    use lib\MyFacebookRedirectLoginHelper;

    class HomeController extends BaseController
    {

        protected $data = [];
        protected $frontEnd;
        protected $couponUser;
        protected $coupon;


        public function __construct(FrontEnd $frontEnd,CouponUser $couponUser,Coupon $coupon)
        {
            parent::__construct();
            $this->frontEnd = $frontEnd;
            $this->couponUser = $couponUser;
            $this->coupon = $coupon;

        }

        public function getIndex()
        {

            $facebook_login_url =  $this->fbHelper
                                        ->getLoginUrl(array('email'));
            $this->data['fb_url'] = $facebook_login_url;

            $this->data['snippet'] = $this->frontEnd->getLandingPageCouponSnippets();
            $this->data['featured'] = $this->frontEnd->getFeaturedDeals();

            return View::make('home.index', $this->data);
        }

        public function getHowItWorks()
        {
            $facebook_login_url =  $this->fbHelper
                ->getLoginUrl(array('email'));
            $this->data['fb_url'] = $facebook_login_url;
            return View::make('home.how_it_works', $this->data);
        }

        public function getAbout()
        {
            return View::make('home.about_us', $this->data);
        }

        public function getContact()
        {
            $facebook_login_url =  $this->fbHelper
                ->getLoginUrl(array('email'));
            $this->data['fb_url'] = $facebook_login_url;
            return View::make('home.contact', $this->data);
        }

        public function getHelpFaq()
        {
            return View::make('home.help_faq', $this->data);
        }

        public function getAccount()
        {
            $facebook_login_url =  $this->fbHelper
                ->getLoginUrl(array('email'));
            $this->data['fb_url'] = $facebook_login_url;
            $coupons = $this->couponUser->where('user_id', Auth::id())->with('coupon')->get();
            $this->data['my_coupons'] = $coupons;

            return View::make('home.account', $this->data);
        }

        public function getWallet()
        {
            $facebook_login_url =  $this->fbHelper
                ->getLoginUrl(array('email'));
            $this->data['fb_url'] = $facebook_login_url;
            $user = User::findOrFail(Auth::id())->with('wallet_transactions')->first();
            $this->data['wallet_transactions'] = $user->wallet_transactions;

            return View::make('home.wallet', $this->data);
        }

        public function getSearch(){
            $facebook_login_url =  $this->fbHelper
                ->getLoginUrl(array('email'));
            $this->data['fb_url'] = $facebook_login_url;
            $search_phrase = trim(Input::get('q'));
            if(empty($search_phrase))
                return Redirect::back()->withError('Search String can\'t be empty');
            $search_result = $this->coupon->search($search_phrase);
            return View::make('home.search', $this->data)->with(compact('search_phrase','search_result'));
        }
    }
