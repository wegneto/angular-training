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
                        resetReply();
                        found = true;
                    }
                });

                if (!found) {
                    console.log("Post not found.");
                    $location.path("/");
                }
            });

            function resetReply() {
                $scope.reply = {
                    "id": $scope.post.comments.length + 1,
                    "text": ""
                };
            }

            $scope.addReply = function () {
                console.log($scope.reply);
                $scope.post.comments.push($scope.reply);
                resetReply();
            }
        }
    });
