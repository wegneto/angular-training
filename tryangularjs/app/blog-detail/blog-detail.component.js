'use strict';

angular.module('blogDetail')
    .component('blogDetail', {
        templateUrl: "./blog-detail/blog-detail.template.html",
        controller: function (Post, $http, $location, $routeParams, $scope) {
            console.log("blogDetail started");

            Post.query(function (data) {
                var found = false;
                angular.forEach(data, function (post) {
                    if (post.id == $routeParams.id) {
                        $scope.post = post;
                        found = true;
                    }
                });

                if (!found) {
                    console.log("Post not found.");
                    $location.path("/");
                }
            });
        }
    });
