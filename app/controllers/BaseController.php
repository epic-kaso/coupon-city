<?php

    use Couponcity\User\User;
    use Facebook\FacebookSession;
    use Laracasts\Commander\CommanderTrait;
    use lib\MyFacebookRedirectLoginHelper;

    class BaseController extends Controller
    {

        use CommanderTrait;

        protected $data = [];
        protected $breadcrumbs;
        public $fbHelper;

        public function __construct()
        {
            Breadcrumbs::addCssClasses("breadcrumb mb");
            Breadcrumbs::addCrumb('Home', '/');

            FacebookSession::setDefaultApplication(
                Config::get('facebook.key'),
                Config::get('facebook.secret')
            );
            $this->fbHelper = new MyFacebookRedirectLoginHelper(
                URL::route('user-fb-login')
            );

            $data = [];
            $data['status'] = Session::get('status');
            $data['user'] = User::find(Auth::id());



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
