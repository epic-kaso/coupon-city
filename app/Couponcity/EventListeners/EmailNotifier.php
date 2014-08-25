<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/23/14
     * Time: 11:14 PM
     */

    namespace Couponcity\EventListeners;

    use Couponcity\Events\UserSignedUp;
    use Laracasts\Commander\Events\EventListener;


    class EmailNotifier extends EventListener
    {

        public function whenUserSignedUp(UserSignedUp $event)
        {
            var_dump('send an email');
        }

    }