'use strict';

angular.module('blogDetail')
    .component('blogDetail', {
        templateUrl: "./blog-detail/blog-detail.template.html",
        controller: function ($routeParams, $scope) {
            console.log("blogDetail started: " + $routeParams.id);

            var blogItems = [
                {id: 1, title: "some title 1", description: "this is the description"},
                {id: 2, title: "some title 2", description: "this is the description"},
                {id: 3, title: "some title 3", description: "this is the description"},
                {id: 4, title: "some title 4", description: "this is the description"}
            ];

            $scope.title = "Blog " + $routeParams.id;

        }
    });
