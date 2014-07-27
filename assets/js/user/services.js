'use strict';

/* Services */


// Demonstrate how to register services
// In this case it is a simple value service.
var app = angular.module('endUserApp.services', []).
        value('version', '0.1');
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
