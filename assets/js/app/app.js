'use strict';


// Declare app level module which depends on filters, and services
var app = angular.module('myUserApp', [
    'ui.bootstrap',
    'ui.router',
    'myUserApp.filters',
    'myUserApp.services',
    'myUserApp.directives',
    'myUserApp.controllers'
]);

app.directive('imgPreview',function($rootScope){
    return {
        scope:{dynamic_src:'='},
        link: function(scope,element,attr){
            $rootScope.$on('dynamic_src',function(e,arg){
                console.log('directive called'+arg.file_path);
                element.attr('src',arg.file_path);
            });
        }
    };
});

app.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.otherwise('/step-1');
        $stateProvider
                .state('addcoupon-step1', {
                    url: '/step-1',
                    templateUrl: my_globals.base_url + 'assets/views/AddCouponStep1.html',
                    controller: function($scope) {
                        new Dropzone("div#my-awesome-dropzone",
                                {
                                    init: function() {
                                        this.on("success", function(file, response) {
                                            console.log(response);
                                            var obj = JSON.parse(response);
                                            console.log(obj);
                                            $scope.couponform.src = obj.file_path;
                                            $scope.$emit('dynamic_src',obj);
                                            $scope.coupon.images = obj.images;
                                            console.log($scope.coupon);
                                        });
                                    },
                                    paramName: 'userfile',
                                    url: my_globals.base_url + 'index.php/coupon/upload_image'
                                });
                    }
                })
                .state('addcoupon-step2', {
                    url: '/step-2',
                    templateUrl: my_globals.base_url + 'assets/views/AddCouponStep2.html'
                })
                .state('addcoupon-step3', {
                    url: '/step-3',
                    templateUrl: my_globals.base_url + 'assets/views/AddCouponStep3.html'
                });
    }]);


app.controller('CouponUploadController', ['$scope', '$http', '$filter','$window', function($scope, $http, $filter,$window) {
        $scope.submitting = false;
        $scope.couponform = {};
        $scope.couponform.src = my_globals.base_url+'assets/img/dummy.jpg';
        $scope.$watch('coupon.start_date', function(newv, oldv) {
            if (newv !== oldv) {
                console.log('has ran');
                var $value = $filter('date')(newv, 'yyyy-MM-dd hh:mm:ss');
                $scope.coupon.start_date = $value;
            }
        });

        $scope.$watch('coupon.end_date', function(newv, oldv) {
            if (newv !== oldv) {
                console.log('has ran');
                var $value = $filter('date')(newv, 'yyyy-MM-dd hh:mm:ss');
                $scope.coupon.end_date = $value;
            }
        });
        $scope.categories = my_globals.categories;

        $scope.coupon = {
            'old_price': 0,
            'new_price': 0,
            'discount': 0
        };

        $scope.calculatePercentDiscount = function() {
            var $old_p = $scope.coupon.old_price;
            var $new_p = $scope.coupon.new_price;
            if ($new_p > $old_p) {
                $scope.coupon.discount = 0;
                //$scope.$apply();
                return;
            }

            var $discount = ($old_p - $new_p) / $old_p * 100.0;
            $scope.coupon.discount = Math.ceil($discount);
            //$scope.$apply();
        };

        $scope.calculateNewPrice = function() {

            var $old_p = $scope.coupon.old_price;
            var $discount = $scope.coupon.discount;
            if ($old_p > 0 && $discount > 0) {

                var $reduction = $discount / 100 * $old_p;

                var $new_p = $old_p - $reduction;
                $scope.coupon.new_price = $new_p;
            } else {
                $scope.coupon.new_price = 0;
                return;

            }
            //$scope.$apply();
        };

        $scope.submitCoupon = function(coupon, e) {
            $scope.submitting = true;
            var formdata = $.param(coupon);
            $http.post(my_globals.base_url + 'index.php/coupon/create', formdata, {
                headers: {
                    'content-type': 'application/x-www-form-urlencoded'
                }
            }).
                    success(function(data, status, headers, config) {
                       $window.location.href = my_globals.base_url+'index.php/merchant';
                       // console.log(data);
                    }).
                    error(function(data, status, headers, config) {
                        console.log(data);// called asynchronously if an error occurs
                        // or server returns response with an error status.
                    });
            e.preventDefault();
        };
    }]);
