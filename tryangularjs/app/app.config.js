'use strict';

angular.module('try')
    .config(function ($locationProvider, $routeProvider) {
        console.log('app.config.js init');

        $routeProvider
            .when("/", {
                template: "<blog-list></blog-list>"
            })
            .when("/about", {
                templateUrl: "/templates/about.html"
            })
            .when("/blog/:id", {
                template: "<blog-detail></blog-detail>"
            })
            .otherwise({
                template: "not found"
            });

    });
