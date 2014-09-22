<?php

    use Couponcity\Services\FacebookLoginService;
    use Couponcity\User\CreateUserCommand;
    use Couponcity\User\CreateUserFormValidator;
    use Couponcity\User\User;
    use Facebook\FacebookRequest;
    use Facebook\FacebookRequestException;
    use Facebook\GraphUser;
    use lib\MyFacebookRedirectLoginHelper;

    class UserController extends \BaseController
    {
        protected $layout = 'layouts.home';

        protected $createUserFormValidator;

        protected $data = [];
        protected $facebookLoginService;

        public function __construct(CreateUserFormValidator $createUserFormValidator,
    FacebookLoginService $facebookLoginService)
        {
            parent::__construct();
            Breadcrumbs::addCrumb('user', 'user');
            $this->createUserFormValidator = $createUserFormValidator;

            $this->facebookLoginService = $facebookLoginService;
            $this->callback_url = URL::route('user-fb-login');
            $this->fbHelper = new MyFacebookRedirectLoginHelper($this->callback_url);

            $this->beforeFilter('csrf', array('on' => 'post'));

            $this->beforeFilter('guest', ['except' => ['getLogout', 'postUpdate', 'postChangePassword']]);
        }


        public function getLogout()
        {
            Auth::logout();

            return Redirect::back()->withStatus('Logged Out!');
        }

        public function getLogin()
        {
            //return View::make('', [])->withStatus('status');
        }

        public function postLogin()
        {
            return $this->performLogin();
        }

        public function postUpdate()
        {
            $data = Input::only(['first_name', 'last_name', 'phone']);

            $user = User::findOrFail(Auth::id())->first();

            if (!$user) {
                return Redirect::back()->withStatus('Could not save!');
            }

            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->phone = $data['phone'];

            if ($user->save()) {
                return Redirect::action('HomeController@getAccount')->withStatus('Saved Successfully!');
            } else {
                return Redirect::back()->withStatus('Could not save!');
            }

        }

        public function postChangePassword()
        {
            $user = User::findOrFail(Auth::id())->first();

            $data = Input::only(['password', 'password_confirmation', 'old_password']);
            $rules = ['password' => 'required|confirmed', 'old_password' => 'required'];

            $validation = Validator::make($data, $rules);
            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation);
            } else {
                if (Auth::validate(['email' => $user->email, 'password' => $data['old_password']])) {
                    $user->password = $data['password'];

                    return Redirect::back()->withStatus('Password Changed Successfully');
                } else {
                    return Redirect::back()->withStatus('Old Password Incorrect, Failed to Change');
                }
            }
        }

        public function getSignUp()
        {

        }

        public function postSignUp()
        {
            $this->createUserFormValidator->validate(Input::all());

            $user = $this->execute(CreateUserCommand::class);

            return $this->loginUser($user);
        }

        public function postForgotPassword()
        {

        }

        public function getSetPassword()
        {
            $user_id = Session::get(FacebookLoginService::INCOMPLETE_USER_ID, NULL);
            if (is_null($user_id)) {
                return Redirect::back()->withStatus('User id missing from session');
            } else {
                $user = User::find($user_id);
                $this->layout->content = View::make('user.set_password', array('email' => $user->email));
            }
        }

        public function postSetPassword()
        {
            $user_id = Session::get('incomplete_user_id', NULL);
            if (is_null($user_id)) {
                return Redirect::back()->withStatus('User id missing from session');
            }

            $validator = Validator::make(Input::all(), array('password' => 'required|min:5|confirmed'));
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            } else {
                $user = User::find($user_id);
                $user->password = Input::get('password');
                $user->save();
                Auth::login($user);

                return Redirect::action('HomeController@getIndex');
            }
        }


        public function fbLogin()
        {
            try {
                $session = $this->fbHelper->getSessionFromRedirect();
                $response = $this->facebookLoginService->facebookLogin($session);
                if ($response == FacebookLoginService::GOTO_DASHBOARD) {
                    return Redirect::intended(action('HomeController@getIndex'));
                } else if ($response == FacebookLoginService::GOTO_SET_PASSWORD) {
                    return Redirect::action('UserController@getSetPassword');
                }
            } catch (FacebookRequestException $ex) {
                return $ex->getMessage();
            } catch (\Exception $ex) {
                return $ex->getMessage();
            }
        }


        private function loginUser($user)
        {
            Auth::login($user);

            return Redirect::to(URL::action('HomeController@getIndex'))->withStatus('Welcome Back!');
        }

        private function performLogin()
        {
            $validation = Validator::make(
                Input::only(['email', 'password']),
                ['email' => 'required|email', 'password' => 'required']
            );

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation);
            }

            if (Auth::attempt(Input::only(['email', 'password']))) {
                return Redirect::back()->with('status', 'Welcome back');
            } else {
                return Redirect::back()->withInput()->withErrors(['Invalid email/password combination']);
            }
        }

//        protected function perform_fb_signup(GraphUser $fb_user)
//        {
//            $user = User::firstOrCreate(array('email' => $fb_user->getProperty('email')));
//            $user->first_name = $fb_user->getFirstName();
//            $user->last_name = $fb_user->getLastName();
//
//
//            if (!$user->oauth_enabled) {
//                $user->fb_oauth_id = $fb_user->getId();
//                $user->oauth_enabled = TRUE;
//            }
//            $user->save();
//            if (property_exists($user, 'password') && !empty($user->password) && is_string($user->password)) {
//                Auth::login($user);
//
//                return Redirect::intended('/');
//            } else {
//                Session::set('incomplete_user_id', $user->id);
//
//                return Redirect::action('UserController@getSetPassword');
//            }
//        }
    }