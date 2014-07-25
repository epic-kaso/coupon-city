'use strict';


// Declare app level module which depends on filters, and services
var app = angular.module('endUserApp', [
    'ui.router',
    'facebook',
    'endUserApp.filters',
    'endUserApp.services',
    'endUserApp.directives',
    'endUserApp.controllers'
]);

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