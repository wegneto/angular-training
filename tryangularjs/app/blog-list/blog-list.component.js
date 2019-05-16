'use strict';

angular.module('blogList')
    .component('blogList', {
        templateUrl: "./blog-list/blog-list.template.html",
        controller: function ($scope) {
            console.log('BlogListController init');
            $scope.title = "Hi there from AngularJS!";
            $scope.clicks = 0;
            $scope.someClickTest = function () {
                console.log('clicked');
                $scope.clicks++;
                $scope.title = "Clicked " + $scope.clicks + " times";
            };
        }
    });
