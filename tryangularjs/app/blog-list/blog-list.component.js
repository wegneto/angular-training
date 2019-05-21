'use strict';

angular.module('blogList')
    .component('blogList', {
        templateUrl: "./blog-list/blog-list.template.html",
        controller: function (Post, $routeParams, $scope, $location, $timeout) {
            console.log("blogList started");

            $scope.items = Post.query();

            $scope.goToPost = function (post) {
                console.log("go to post: " + post.id);
                $timeout(function () {
                    $location.path('/blog/' + post.id);
                }, 1);

            }
        }
    });
