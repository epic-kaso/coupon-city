'use strict';

/* Directives */


var app = angular.module('myUserApp.directives', []).
  directive('appVersion', ['version', function(version) {
    return function(scope, elm, attrs) {
      elm.text(version);
    };
  }]);
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