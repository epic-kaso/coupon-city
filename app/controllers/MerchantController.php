<?php

    use Couponcity\Merchant\CreateMerchantCommand;
    use Couponcity\Merchant\CreateMerchantFormValidator;
    use Couponcity\Merchant\Merchant;

    class MerchantController extends \BaseController
    {

        protected $createFormValidator;


        public function __construct(CreateMerchantFormValidator $createFormValidator)
        {
            $this->createFormValidator = $createFormValidator;
            $data = [];
            $data['status'] = Session::get('status');
            $data['user'] = Merchant::getCurrentMerchant();

            $this->data = $data;

            $this->beforeFilter("auth_merchant",
                [
                    'except' => ['getIndex', 'getLogin', 'getSignUp', 'postSignUp', 'postLogin', 'getForgotPassword', 'postForgotPassword']
                ]);
            $this->beforeFilter('merchant_guest', [
                'only' => ['getLogin', 'getSignUp', 'postSignUp', 'postLogin', 'getForgotPassword', 'postForgotPassword']
            ]);
        }

        /**
         * Display a listing of the resource.
         * GET /merchant
         *
         * @return Response
         */
        public function getIndex()
        {
            return View::make('merchant.landing-page', $this->data);
        }

        public function postEditProfile($id)
        {
            return $this->processUpdate();
        }

        public function postDestroy($id)
        {
            //
        }

        public function getLogout()
        {
            Merchant::logout();

            return Redirect::back()->withStatus('Logged Out!');
        }

        public function getLogin()
        {
            return View::make('merchant.login', $this->data);
        }

        public function postLogin()
        {
            return $this->performLogin();
        }


        public function getSignUp()
        {
            return View::make('merchant.create', $this->data);
        }

        public function postSignUp()
        {
            return $this->processSignUp();
        }

        public function postForgotPassword()
        {

        }

        public function getForgotPassword()
        {

        }


        private function processSignUp()
        {
            $this->createFormValidator->validate(Input::all());

            $user = $this->execute(CreateMerchantCommand::class);

            Merchant::loginMerchant($user);

            return Redirect::action('MerchantDashboardController@getIndex')->withStatus('Welcome Back!');

        }


        private function performLogin()
        {
            $email = Input::get('email');
            $password = Input::get('password');

            $rules = ['email' => 'required|email', 'password' => 'required'];
            $validation = Validator::make(['email' => $email, 'password' => $password], $rules);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation);
            }

            if (Merchant::attemptLogin($email, $password)) {
                return Redirect::intended(URL::action('MerchantDashboardController@getIndex'))->withStatus('Welcome Back!');
            } else {
                return Redirect::back()->withInput()->withErrors(['Login failed. Invalid email/password combination']);
            }
        }

        private function processUpdate()
        {
            $acceptable = [
                'business_name'       => '',
                'contact_name'        => '',
                'address_one'         => '',
                'address_two'         => '',
                'city'                => 'alpha|required_with:address_one,address_two',
                'state'               => 'alpha|required_with:address_one,address_two',
                'business_category'   => 'integer',
                'mobile_number'       => 'digits:11',
                'short_description'   => '',
                'website'             => '',
                'opening_hours'       => '',
                'is_profile_complete' => '',
                'bank_name'           => '',
                'account_type'        => '',
                'account_number'      => 'digits:10',
                'logo'                => 'image'
            ];

            $input = Input::only(array_keys($acceptable));
            $validation = Validator::make($input, $acceptable);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation);
            } else {
                $merchant = Merchant::getCurrentMerchant();

                foreach ($input as $attr => $value) {
                    $merchant->$attr = is_string($value) ? trim($value) : $value;
                }
                $merchant->logo = is_null(Input::file('logo')) ? STAPLER_NULL : Input::file('logo');

                $merchant->save();

                return Redirect::action('MerchantDashboardController@getBusiness')->withStatus('Updated Successfully');
            }
        }
    }