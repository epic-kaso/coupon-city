'use strict';


// Declare app level module which depends on filters, and services
var app = angular.module('endUserApp', [
    'ui.router',
    'facebook',
    'endUserApp.filters',
    'endUserApp.services',
    'endUserApp.directives',
    'endUserApp.controllers'
]);

app.config([
    'FacebookProvider',
    function(FacebookProvider) {
        var myAppId = '1413599752212245';

        // You can set appId with setApp method
        // FacebookProvider.setAppId('myAppId');

        /**
         * After setting appId you need to initialize the module.
         * You can pass the appId on the init method as a shortcut too.
         */
        FacebookProvider.init(myAppId);

    }
])

        .controller('LoginController', [
            '$scope',
            '$timeout',
            'Facebook', 'FacebookService','$window',
            function($scope, $timeout, Facebook, FacebookService,$window) {

                // Define user empty data :/
                $scope.user = function(response) {
                    console.log('inside user');
                    FacebookService.login(response)
                            .then(function(response) {
                                console.log(response);
                                if(response.success){
                                    $window.location = response.redirect;
                                }
                            }, function(response) {
                                console.log(response);
                            });
                };
                
                $scope.logout = function(){
                    $window.location = 'http://couponcity.com.ng/index.php/logout';
                };

                /**
                 * Watch for Facebook to be ready.
                 * There's also the event that could be used
                 */
                $scope.$watch(
                        function() {
                            return Facebook.isReady();
                        },
                        function(newVal) {
                            if (newVal)
                                $scope.facebookReady = true;
                            console.log('resdy called')
                        }
                );

                /**
                 * IntentLogin
                 */
                $scope.IntentLogin = function() {
                    console.log('intend login called');
                    Facebook.getLoginStatus(function(response) {
                        console.log(response);
                        if (response.status == 'connected') {
                            $scope.$apply(function() {
                                $scope.me();
                            });
                        }
                        else {
                            $scope.$apply(function() {
                                $scope.login();
                            });
                        }
                    });
                };

                /**
                 * Login
                 */
                $scope.login = function() {
                    Facebook.login(function(response) {
                        if (response.status == 'connected') {
                            $scope.$apply(function() {
                                $scope.me();
                            });
                        }

                    }, {
                        scope: 'email'
                    });
                };

                /**
                 * me 
                 */
                $scope.me = function() {
                    Facebook.api('/me', function(response) {
                        console.log('inside /me');
                        /**
                         * Using $scope.$apply since this happens outside angular framework.
                         */
                        $scope.$apply(function() {
                            $scope.user(response);
                        });

                    });
                };

                /**
                 * Logout
                 */
                $scope.logout = function() {
                    Facebook.logout(function() {
                        $scope.$apply(function() {
                            $scope.logged = false;
                        });
                    });
                }

                /**
                 * Taking approach of Events :D
                 */
                $scope.$on('Facebook:statusChange', function(ev, data) {
                    console.log('Status: ', data);
                    if (data.status == 'connected') {
                        $scope.$apply(function() {
                                $scope.me();
                            });
                    } else {
                        $scope.$apply(function() {
                            $scope.logout();
                        });
                    }


                });


            }
        ]);