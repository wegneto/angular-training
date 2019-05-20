'use strict';

angular.module('confirmClick')
    .directive('confirmClick', function ($rootScope, $location) {
        return {
            scope: {
                message: "@message",
                post: "=post"
            },
            restrict: "E",
            template: "<a href='#'>{{post.title}}</a>",
            link: function (scope, element, attr) {
                var msg = scope.message || "Are you sure?";
                element.bind("click", function (event) {
                    if (window.confirm(msg)) {
                        event.preventDefault();
                        $rootScope.$evalAsync(function () {
                            $location.path('/blog/' + scope.post.id);
                        });
                    }
                });
            }
        };
    });
