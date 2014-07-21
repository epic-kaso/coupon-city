'use strict';

/* Services */


// Demonstrate how to register services
// In this case it is a simple value service.
angular.module('myUserApp.services', []).
  value('version', '0.1')
  .factory('CartService',function($http,$q){
    var CART_DATA_URL = "http://localhost/print-rabbit-new/index.php/start/get_cart_json";
    var response = {
        /**
         * @param {object} params this should contain 
         * school_id,form,class,session
         */
        getCart: function(params){
            var deferred = $q.defer();
            $http.get(CART_DATA_URL,params)
                    .success(function(response){
                        deferred.resolve(response);
            })
                    .error(function(response){
                        deferred.reject(response);
            });
            return deferred.promise;
        }
    };
    return response;
});
