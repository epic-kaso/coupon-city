'use strict';

/* Controllers */

var app = angular.module('endUserApp.controllers', []);

app.controller('MyCtrl1', ['$scope', function($scope) {

    }]);
app.controller('MyCtrl2', ['$scope', function($scope) {

    }]);

app.controller('LoginController', [
    '$scope',
    '$timeout',
    'Facebook', 'FacebookService', '$window', '$cookieStore',
    function($scope, $timeout, Facebook, FacebookService, $window, $cookieStore) {
        $scope.is_logging_in = false;
        $scope.fb_logged = $cookieStore.get('fb_logged') || false;

        // Define user empty data :/
        $scope.user = function(response) {
            console.log('inside user');
            FacebookService.login(response)
                    .then(function(response) {
                        console.log(response);
                        $window.location = response.redirect;
                        $scope.fb_logged = $cookieStore.put('fb_logged', true);
                    }, function(response) {
                        console.log(response);
                    });
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
                    console.log('resdy called');
                }
        );

        /**
         * IntentLogin
         */
        $scope.IntentLogin = function() {
            $scope.is_logging_in = true;
            console.log('intend login called');
            Facebook.getLoginStatus(function(response) {
                console.log(response);
                if (response.status === 'connected') {
                    $scope.$apply(function() {
                        $scope.me();
                    });
                } else if (response.status === 'not_authorized') {
                    $scope.$apply(function() {
                        $scope.login();
                        $scope.is_logging_in = false;
                    });
                } else {
                    $scope.$apply(function() {
                        $scope.login();
                        $scope.is_logging_in = false;
                    });
                }
            });
        };

        /**
         * Login
         */
        $scope.login = function() {
            $scope.is_logging_in = true;
            Facebook.login(function(response) {
                if (response.status === 'connected') {
                    $scope.$apply(function() {
                        $scope.me();
                    });
                } else {
                    //alert('login failed');
                    $scope.is_logging_in = false;
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
            if ($scope.fb_logged) {
                Facebook.logout(function() {
                    $scope.$apply(function() {
                        $scope.fb_logged = false;
                        $cookieStore.remove('fb_logged');
                        $window.location = base_url + '/logout';
                    });
                });
            } else {
                $window.location = base_url + '/logout';
            }
        };

        /**
         * Taking approach of Events :D
         */
        $scope.$on('Facebook:statusChange', function(ev, data) {
            console.log('Status: ', data);
            //$scope.IntentLogin();
            if (data.status === 'connected') {
                $scope.$apply(function() {
                    $scope.me();
                });
            }
        });
    }
]);
