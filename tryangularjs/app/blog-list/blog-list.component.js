'use strict';

angular.module('blogList')
    .component('blogList', {
        templateUrl: "./blog-list/blog-list.template.html",
        controller: function ($routeParams, $scope) {
            console.log("teste: " + $routeParams.id);

            var blogItems = [
                {id: 1, title: "some title 1", description: "this is the description"},
                {id: 2, title: "some title 2", description: "this is the description"},
                {id: 3, title: "some title 3", description: "this is the description"},
                {id: 4, title: "some title 4", description: "this is the description"}
            ];

            $scope.items = blogItems;

            $scope.title = "Hi there from AngularJS!";
            $scope.clicks = 0;
            $scope.someClickTest = function () {
                console.log('clicked');
                $scope.clicks++;
                $scope.title = "Clicked " + $scope.clicks + " times";
            };
        }
    });
