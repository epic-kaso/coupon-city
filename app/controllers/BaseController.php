<?php

    use Couponcity\User\User;
    use Facebook\FacebookSession;
    use Laracasts\Commander\CommanderTrait;

    class BaseController extends Controller
    {

        use CommanderTrait;

        protected $data = [];

        public function __construct()
        {

            Breadcrumbs::addCrumb('Home', '/');

            FacebookSession::setDefaultApplication(Config::get('facebook.key'), Config::get('facebook.secret'));

            $facebook_login_url = (new MyFacebookRedirectLoginHelper(URL::route('user-fb-login')))->getLoginUrl(array('email'));

            $data = [];
            $data['status'] = Session::get('status');
            $data['user'] = User::find(Auth::id());
            $data['fb_url'] = $facebook_login_url;


            $this->data = $data;
            $categories = CouponCategory::all();
            $this->data['categories'] = $categories;

        }

        /**
         * Setup the layout used by the controller.
         *
         * @return void
         */
        protected function setupLayout()
        {
            if (!is_null($this->layout)) {
                $this->layout = View::make($this->layout, $this->data);
            }
        }

    }
