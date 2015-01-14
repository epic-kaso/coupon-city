/**
 * Created by kaso on 10/7/2014.
 */
var App = angular.module('CouponcityBuyCoupon',[]);

App.directive('creditCardForm',function(){
    var generateMerchantRef = function(){
        var date = Date.now() * Math.random();
        return date.toString().substr(0,10);
    };

    var generateUserRef = function(){
        var date = Date.now() * Math.random();
        return date.toString().substr(0,10);
    };

    var setUpForm = function(element,scope){
        var itemName = element.find('input[name=itemName]'),
            itemPrice = element.find('input[name=itemPrice]'),
            itemDesc = element.find('input[name=itemDesc]'),
            successURL = element.find('input[name=successURL]'),
            failedURL = element.find('input[name=failedURL]'),
            merchantTransRef = element.find('input[name=merchantTransRef]'),
            email = element.find('input[name=email]'),
            customerName = element.find('input[name=customerName]'),
            card = element.find('input[name=card]'),
            transactionRef = element.find('input[name=transactionRef]');
        var submit = element.find('input[type=submit]');

        itemName.attr('value',scope.itemName);
        itemPrice.attr('value',scope.itemPrice);
        itemDesc.attr('value',scope.itemDesc);
        successURL.attr('value',scope.successUrl);
        failedURL.attr('value',scope.failedUrl);
        merchantTransRef.attr('value',generateMerchantRef());
        email.attr('value',scope.email);
        customerName.attr('value',scope.customerName);
        card.attr('value',scope.card);
        transactionRef.attr('value',generateUserRef());

        submit.click();
    };

   return {
       restrict: 'EA',
       templateUrl: 'creditCardForm.html',
       replace: true,
       transclude: true,
       scope: {
            'itemName': "@",
            'itemPrice': "@",
            'itemDesc': "@",
            'successUrl': "@",
            'failedUrl': "@",
            'email': "@",
            'customerName': "@",
            'card': "="
       },
       link: function(scope,element,attrs){
           var dialog = $('.notification-dialog');
           scope.$watch('card',function(newv,oldv){
               console.log(newv);
               if(newv){
                   setUpForm(element,scope);
               }
           });
       }
   }
});
App.directive('buyProduct',function($timeout){
    return {
        restrict: 'EA',
        link: function(scope,element,attrs){
            var originalContent = element.text();
            var loadingContent = 'please wait...';

            var action = function(){
                setLoading(true);
                $timeout(function(){
                    setLoading(false);
                },3000);
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
        $scope.transactNow = false;
        $scope.setTransactNow = function(param){
            $scope.transactNow = param || false;
        };

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

