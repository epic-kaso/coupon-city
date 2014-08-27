<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 8/26/14
     * Time: 12:50 PM
     */

    namespace Couponcity\EventListeners;


    use Illuminate\Support\ServiceProvider;

    class EventListenersServiceProvider extends ServiceProvider
    {

        /**
         * Register the service provider.
         *
         * @return void
         */
        public function register()
        {

            $listeners = $this->app['config']->get('couponcity.listeners');

            foreach ($listeners as $listener) {
                $this->app['events']->listen('Couponcity.*', $listener);
            }
        }
    }