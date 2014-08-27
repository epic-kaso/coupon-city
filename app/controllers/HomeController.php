<?php


    use Couponcity\FrontEnd\FrontEnd;
    use Couponcity\User\User;

    class HomeController extends BaseController
    {

        protected $data = [];
        protected $frontEnd;


        public function __construct(FrontEnd $frontEnd)
        {
            parent::__construct();
            $this->frontEnd = $frontEnd;
        }

        public function getIndex()
        {
            $this->data['snippet'] = $this->frontEnd->getLandingPageCouponSnippets();
            $this->data['featured'] = $this->frontEnd->getFeaturedDeals();
            return View::make('home.index', $this->data);
        }

        public function getHowItWorks()
        {
            return View::make('home.how_it_works', $this->data);
        }

        public function getAbout()
        {
            return View::make('home.about_us', $this->data);
        }

        public function getContact()
        {
            return View::make('home.contact', $this->data);
        }

        public function getHelpFaq()
        {
            return View::make('home.help_faq', $this->data);
        }

        public function getAccount()
        {
            $user = User::findOrFail(Auth::id())->with('coupons')->first();
            $this->data['my_coupons'] = $user->coupons;
            return View::make('home.account', $this->data);
        }

        public function getWallet(){
            $user = User::findOrFail(Auth::id())->with('wallet_transactions')->first();
            $this->data['wallet_transactions'] = $user->wallet_transactions;
            return View::make('home.wallet', $this->data);
        }
    }
