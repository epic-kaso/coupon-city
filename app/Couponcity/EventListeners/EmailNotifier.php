<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/23/14
     * Time: 11:14 PM
     */

    namespace Couponcity\EventListeners;

    use Couponcity\Events\MerchantSignedUp;
    use Couponcity\Events\UserSignedUp;
    use Laracasts\Commander\Events\EventListener;
    use Mail;


    class EmailNotifier extends EventListener
    {

        public function whenUserSignedUp(UserSignedUp $event)
        {
            $user = $event->user;
            try {
                Mail::queue('emails.welcome-user', ['email' => $user->email], function ($message) use ($user) {
                    $message
                        ->to($user->email)
                        ->from(\Config::get('couponcity.admin_email'))
                        ->subject('Welcome to COuponcity');
                });
            } catch (\Exception $e) {
                \Session::flash('error', 'Could not send email');
            }
        }

        public function whenMerchantSignedUp(MerchantSignedUp $event)
        {

            $user = $event->merchant;

            try {
                Mail::queue('emails.welcome-user', ['email' => $user->email], function ($message) use ($user) {
                    $message
                        ->to($user->email)
                        ->from(\Config::get('couponcity.admin_email'))
                        ->subject('Welcome to Couponcity');
                });
            } catch (\Exception $e) {
                \Session::flash('error', 'Could not send email');
            }
        }


    }