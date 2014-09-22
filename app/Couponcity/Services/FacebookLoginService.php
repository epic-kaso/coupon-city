<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/31/14
     * Time: 3:21 AM
     */

    namespace Couponcity\Services;


    use Auth;
    use Couponcity\User\User;
    use Facebook\FacebookRequest;
    use Facebook\GraphUser;
    use Redirect;
    use Session;

    class FacebookLoginService
    {

        const GOTO_DASHBOARD = 'dashboard__';
        const GOTO_SET_PASSWORD = 'set_password__';
        protected $user;
        protected $notificationService;


        const INCOMPLETE_USER_ID = 'incomplete_user_id';

        function __construct(NotificationService $notificationService, User $user)
        {
            $this->notificationService = $notificationService;
            $this->user = $user;
        }

        public function facebookLogin($session)
        {
            $this->setFacebookSession($session);
            if (!$session) {
                throw new \Exception('Invalid Session object passed');
            } else {

                $me = $this->createFacebookMeRequest($session);
               // dd($me);
                $response = $this->perform_facebook_signup($me);
                return $response;
            }
        }

        protected function perform_facebook_signup(GraphUser $fb_user)
        {
            $user = $this->createMemberUserFromFacebookUser($fb_user);
            //dd($user);
            $password = $user->password;

            if (!empty($password)) {
                $this->loginUser($user);
                return static::GOTO_DASHBOARD;
            } else {
                $this->welcomeNewUser($user);
                Session::set(self::INCOMPLETE_USER_ID, $user->id);
                return static::GOTO_SET_PASSWORD;
            }
        }

        /**
         * @param $session
         */
        protected function setFacebookSession($session)
        {
            Session::set('fb_session', $session);
        }

        /**
         * @param $session
         * @return mixed
         * @throws \Facebook\FacebookRequestException
         */
        protected  function createFacebookMeRequest($session)
        {
            $me = (new FacebookRequest(
                $session, 'GET', '/me'
            ))->execute()->getGraphObject(GraphUser::className());

            return $me;
        }

        /**
         * @param GraphUser $fb_user
         * @return static
         */
        protected function createMemberUserFromFacebookUser(GraphUser $fb_user)
        {
            $user_email = $fb_user->getProperty('email');

            $user = $this->checkIfUserExists($user_email);
            if (!$user) {
                $user = $this->createUserFromFbObj($fb_user);
            }

            $fbenabled = $this->checkIfUserIsFacebookEnabled($user);
            if (!$fbenabled) {
                $user = $this->enableUserForFacebookLogin($user, $fb_user);
            }

            return $user;
        }

        /**
         * @param $user
         */
        protected function loginUser($user)
        {
            Auth::login($user);
        }

        /**
         * @param $user
         */
        protected function welcomeNewUser($user)
        {
//            $this->notificationService
//                ->byEmail('emails.default',['body'=>'Welcome'],$user->email,"Welcome to Couponcity");
//
        }

        private function checkIfUserExists($user_email)
        {
            $user = $this->user->where('email', $user_email)->first();
            if (!$user) {
                return FALSE;
            } else {
                return $user;
            }
        }

        private function createUserFromFbObj($fb_user)
        {
            $user = User::Create(['email' => $fb_user->getProperty('email')]);
            $user->first_name = $fb_user->getFirstName();
            $user->last_name = $fb_user->getLastName();
            $user->fb_oauth_id = $fb_user->getId();
            $user->oauth_enabled = TRUE;
            $user->save();
            return $user;
        }

        private function checkIfUserIsFacebookEnabled($user)
        {
            if (!$user->oauth_enabled ) {
                return FALSE;
            } else {
                return TRUE;
            }
        }

        private function enableUserForFacebookLogin($user, $fb_user)
        {
            $user->fb_oauth_id = $fb_user->getId();
            $user->oauth_enabled = TRUE;
            $user->save();
            return $user;
        }
    }