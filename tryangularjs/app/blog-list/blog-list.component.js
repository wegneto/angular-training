'use strict';

angular.module('blogList')
    .component('blogList', {
        templateUrl: "./blog-list/blog-list.template.html",
        controller: function (Post, $routeParams, $scope) {
            console.log("blogList started");

            $scope.items = Post.query();
        }
    });
