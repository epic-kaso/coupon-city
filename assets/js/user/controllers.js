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
    'Facebook', 'FacebookService', '$window',
    function($scope, $timeout, Facebook, FacebookService, $window) {
        $scope.is_logging_in = false;

        // Define user empty data :/
        $scope.user = function(response) {
            console.log('inside user');
            FacebookService.login(response)
                    .then(function(response) {
                        console.log(response);
                        if (response.success) {
                            $window.location = response.redirect;
                        }
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
            $scope.is_logging_in = true;
            Facebook.login(function(response) {
                if (response.status === 'connected') {
                    $scope.$apply(function() {
                        $scope.me();
                    });
                } else {
                    alert('login failed');
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
                    $window.location = 'http://couponcity.com.ng/index.php/logout';
                });
            });
        };

        /**
         * Taking approach of Events :D
         */
        $scope.$on('Facebook:statusChange', function(ev, data) {
            console.log('Status: ', data);
            $scope.is_logging_in = true;
            if (data.status === 'connected') {
                $scope.$apply(function() {
                    $scope.me();
                });
            }
        });
    }
]);
