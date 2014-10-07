/**
 * Created by kaso on 10/7/2014.
 */
var App = angular.module('CouponcityBuyCoupon',[]);

App.directive('buyProduct',function(BuyProductService){
    return {
        restrict: 'EA',
        scope: true,
        link: function(scope,element,attrs){
            var originalContent = element.text();
            var loadingContent = 'please wait...';

            var action = function(){
                setLoading(true);
                var promise = BuyProductService.buy(attrs.url,
                    {   name: attrs.name,
                        price: attrs.price,
                        poster: attrs.poster,
                        summary: attrs.summary
                    });
                promise.then(function(data){
                    console.log(data);
                },function(response){
                    console.log(response.data);
                    if(response.data == 'Unauthorized'){

                        setLoading(false);
                        //console.log('Showing login Dialog');
                        scope.showLoginDialog();
                    }
                    console.log(arguments);

                    setLoading(false);
                });
            };

            var setLoading = function(state){
                if(state == true){
                    element.addClass('disabled');
                    element.text(loadingContent);
                    element.unbind('click');
                }else{
                    element.removeClass('disabled');
                    element.text(originalContent);
                    element.bind('click',action);
                }
            };

            element.bind('click',action);

        }
    }
});

App.directive('buyReservation',function(BuyReservationService){
    return {
        restrict: 'EA',
        scope: true,
        link: function(scope,element,attrs){
            var originalContent = element.text();
            var loadingContent = 'please wait...';
            var action = function(){
                setLoading(true);
                var promise = BuyReservationService.buy(attrs.url);
                promise.then(function(data){
                    console.log(data);
                    setLoading(false);
                },function(response){
                    if(response.data.wallet_error){
                        scope.showNotification('Insufficient Wallet Balance, Please Fund Wallet and try Again');
                    }
                    console.log('error');
                    setLoading(false);
                });
            };



            var setLoading = function(state){
                if(state == true){
                    element.addClass('disabled');
                    element.text(loadingContent);
                    element.unbind('click');
                }else{
                    element.removeClass('disabled');
                    element.text(originalContent);
                    element.bind('click',action);
                }
            };

            element.bind('click',action);
        }
    }
});


App.factory('BuyProductService',function($q,$http){
    var successURL = '/credit-card/success',
        failureURL = '/credit-card/failure';

    var buyProduct = function(url,coupon){
        var deferred = $q.defer();
        var data = {};
        var promise =  $http.post(url,data,{
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        promise.then(function(data){
            console.log(data);
            if(data.auth == 'true'){
                generateForm(coupon);
                deferred.resolve(data);
            }else{
                deferred.reject(response);
            }
        },function(response){
            console.log('error');
            if(response.data.wallet_error){
                generateForm(coupon);
            }
            deferred.reject(response);
        });

        return deferred.promise;
    };

    var generateForm = function(coupon){
         var form =
             '<form id="gpayForm" method="post" action="http://gpayexpress.com/gpay/gpayexpress.php">'+
             '<input type="hidden" name="merchantID" value="140201"/>'+
             '<input type="hidden" name="itemName" value="'+coupon.name+'"/>'+
             '<input type="hidden" name="itemPrice" value="'+coupon.price+'"/>'+
             '<input type="hidden" name="itemDesc" value="'+coupon.summary+'"/>'+
             '<input type="hidden" name="itemImageURL" value="'+coupon.poster+'"/>'+
             '<input type="hidden" name="successURL" value="'+successURL+'"/>'+
             '<input type="hidden" name="failURL" value="'+failureURL+'"/>'+
             '<input type="submit" value="submit"/>'+
             '</form>';

        $(form).appendTo('body');
        $('form#gpayForm input[type=submit]').click();
        $('form#gpayForm').remove();
    };

    return {
        buy: function(url,coupon){
            return buyProduct(url,coupon);
        }
    }
});


App.factory('BuyReservationService',function($q,$http){
    var buyReservation = function(url){
        var data = {};
        return $http.post(url,data,{
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
    };

    return {
        buy: function(url){
            return buyReservation(url);
        }
    }
});


App.controller('CouponItemController',
    function($scope){

        $scope.showLoginDialog = function(){
            console.log('Show Login Dialog Called!');
            $('a[href=#login]').click();
        };

        $scope.showNotification = function(msg){
            $('.notification-dialog').text(msg);
            $('.notification-dialog').modal();
            //alert(msg);
        };
    }
);

