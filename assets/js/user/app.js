'use strict';


// Declare app level module which depends on filters, and services
var app = angular.module('endUserApp', ['facebook']);

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
]);


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


app.controller('WalletController', function($scope, TransactionService) {
    $scope.wallet = {};
    $scope.wallet.processing = false;
    //$scope.wallet.redirect = "";

    $scope.wallet.submit = function($event) {
        $scope.wallet.processing = true;
        TransactionService.generate_code($scope.wallet.amount)
                .then(function(response) {
                    console.log(response);
            $scope.wallet.processing = false;
                    if (response.status == 'success') {
                        $scope.wallet.redirect += "?code=" + response.code;
                        console.log($scope.wallet.redirect);                        
                        $('form#payment_form').submit();
                    }
                }, function(data) {
                    $scope.wallet.processing = false;
                    console.log(data);
                });
                
                console.log($event);
            };
});


app.directive('loader', ['$rootScope', function($rootScope) {
        return {
            link: function(scope, element, attrs) {
                element.addClass('hide');
                $rootScope.$on('$stateChangeStart', function() {
                    element.removeClass('animated fadeOutUp');

                });

                $rootScope.$on('$stateChangeSuccess', function() {
                    element.addClass('animated fadeInDown');
                });
            }
        };
    }]);




app.factory('FacebookService', function($http, $q, $location) {
    var FB_DATA_URL = "http://localhost/coupon-city/index.php/home/fb_login";
    var response = {
        /**
         * @param {object} params this should contain 
         * school_id,form,class,session
         */
        login: function(params) {
            params.redirect_url = $location.absUrl();
            var data = $.param({'fb_user': params});
            var deferred = $q.defer();
            $http.post(FB_DATA_URL, data, {
                headers: {
                    'content-type': 'application/x-www-form-urlencoded'
                }
            })
                    .success(function(response) {
                        deferred.resolve(response);
                    })
                    .error(function(response) {
                        deferred.reject(response);
                    });
            return deferred.promise;
        }
    };
    return response;
});

app.factory('TransactionService', function($http, $q) {
    var TRANX_URL = base_url + 'wallet/generate-transaction-code/';
    return {
        generate_code: function(amount) {
            var deferred = $q.defer();
            $http.get(TRANX_URL + amount)
                    .success(function(response) {
                        deferred.resolve(response);
                    })
                    .error(function(response) {
                        deferred.reject(response);
                    });
            return deferred.promise;
        }
    };
});
