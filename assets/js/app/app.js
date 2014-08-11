'use strict';


// Declare app level module which depends on filters, and services
var app = angular.module('myMerchantApp', [
    'ui.bootstrap',
    'ui.router',
    'myUserApp.filters',
    'myUserApp.services',
    'myUserApp.directives',
    'myUserApp.controllers'
]);

app.directive('imgPreview', function ($rootScope) {
    return {
        scope: {dynamic_src: '='},
        link: function (scope, element, attr) {
            $rootScope.$on('dynamic_src', function (e, arg) {
                console.log('directive called' + arg.file_path);
                element.attr('src', arg.file_path);
            });
        }
    };
});

app.controller('CouponUploadController', ['$scope', '$http', '$filter', '$window', function ($scope, $http, $filter, $window) {
        new Dropzone("div#my-awesome-dropzone",
                {
                    init: function () {
                        this.on("success", function (file, response) {
                            console.log(response);
                            var obj = JSON.parse(response);
                            console.log(obj);
                            $scope.couponform.src = obj.file_path;
                            $scope.$emit('dynamic_src', obj);
                            $scope.coupon.images = obj.images;
                            console.log($scope.coupon);
                        });
                    },
                    paramName: 'userfile',
                    url: my_globals.base_url + 'index.php/coupon/upload_image'
                });

        $scope.submitting = false;
        $scope.couponform = {};
        $scope.adv_price_form = {
            first: {visible: true},
            second: {visible: false},
            third: {visible: false}
        };

        $scope.add_next_adv_price_form = function () {
            if ($scope.adv_price_form.second.visible) {
                $scope.adv_price_form.third.visible = true;
            } else {
                $scope.adv_price_form.second.visible = true;
            }
        };

        $scope.remove_next_adv_price_form = function () {
            if (!$scope.adv_price_form.third.visible) {
                $scope.adv_price_form.second.visible = false;
            } else {
                $scope.adv_price_form.third.visible = false;
            }
        };


        $scope.couponform.src = my_globals.base_url + 'assets/images/no_image.png';
        $scope.$watch('coupon.start_date', function (newv, oldv) {
            if (newv !== oldv) {
                console.log('has ran');
                var $value = $filter('date')(newv, 'yyyy-MM-dd hh:mm:ss');
                $scope.coupon.start_date = $value;
            }
        });

        $scope.$watch('coupon.end_date', function (newv, oldv) {
            if (newv !== oldv) {
                console.log('has ran');
                var $value = $filter('date')(newv, 'yyyy-MM-dd hh:mm:ss');
                $scope.coupon.end_date = $value;
            }
        });
        $scope.categories = my_globals.categories;

        $scope.coupon = {
            'is_advanced_pricing': 0,
            'old_price': 0,
            'new_price': 0,
            'discount': 0,
            'advanced_pricing': {
                'first': {'price': 0, 'discount': 0},
                'second': {'price': 0, 'discount': 0},
                'third': {'price': 0, 'discount': 0}
            }
        };


        $scope.calculatePercentDiscount = function () {
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

        $scope.calculateNewPrice = function () {

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
        $scope.calculate_advanced_discount = function (position, price_model, discount_model) {
            //console.log(price_model);
            //console.log(discount_model);
            var $old_p = $scope.coupon.old_price;
            var $new_p = null;
            var $discount = null;
            $new_p = price_model;
            if ($new_p > $old_p) {
                $discount = 0;
                //$scope.$apply();
                return;
            }

            var $d = ($old_p - $new_p) / $old_p * 100.0;
            $discount = Math.ceil($d);
            discount_model = $discount;
            $scope.coupon.advanced_pricing[position]["discount"] = discount_model;

            //console.log(price_model);
            //console.log(discount_model);
        };

        $scope.calculate_advanced_price = function (position, price_model, discount_model) {
            //console.log(price_model);
            //console.log(discount_model);
            var $old_p = $scope.coupon.old_price;
            var $discount = null;
            $discount = discount_model;
            if ($old_p > 0 && $discount > 0) {

                var $reduction = $discount / 100 * $old_p;

                var $new_p = $old_p - $reduction;
                price_model = $new_p;

            } else {
                price_model = 0;

            }
            $scope.coupon.advanced_pricing[position]["price"] = price_model;
            //console.log(price_model);
            //console.log(discount_model);

        };

        $scope.submitCoupon = function (coupon, e) {
            $scope.submitting = true;
            var formdata = $.param(coupon);
            $http.post(my_globals.base_url + 'index.php/coupon/create', formdata, {
                headers: {
                    'content-type': 'application/x-www-form-urlencoded'
                }
            }).
                    success(function (data, status, headers, config) {
                        $window.location.href = my_globals.base_url + 'index.php/merchant';
                        // console.log(data);
                    }).
                    error(function (data, status, headers, config) {
                        console.log(data);// called asynchronously if an error occurs
                        // or server returns response with an error status.
                    });
            e.preventDefault();
        };
    }]);


app.controller('VerifyCouponController', ['$scope', '$http', '$timeout', function ($scope, $http, $timeout) {
        $scope.is_success = false;
        $scope.is_failure = false;
        $scope.is_working = false;
        $scope.message = "";


        $scope.verify_coupon = function (coupon, e) {
            $scope.is_working = true;
            var formdata = $.param(coupon);
            $http.post(my_globals.base_url + 'merchant/verify-coupon', formdata, {
                headers: {
                    'content-type': 'application/x-www-form-urlencoded'
                }
            }).
                    success(function (data, status, headers, config) {
                        $scope.is_working = false;
                        if (data.is_valid) {
                            $scope.is_success = true;
                        } else {
                            $scope.is_failure = true;
                        }
                        $scope.message = data.message;
                        $scope.coupon.coupon_code = "";
                        $timeout($scope.reset_params, 5000);
                        // console.log(data);
                    }).
                    error(function (data, status, headers, config) {
                        $scope.is_working = false;
                        $scope.is_failure = true;
                        $scope.message = status;
                        $scope.coupon.coupon_code = "";
                        $timeout($scope.reset_params, 5000);
                    });
            e.preventDefault();
        };

        $scope.reset_params = function () {
            $scope.is_success = false;
            $scope.is_failure = false;
            $scope.is_working = false;
            $scope.message = "";
        };
    }]);