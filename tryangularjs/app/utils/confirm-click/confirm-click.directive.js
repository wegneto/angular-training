'use strict';

angular.module('confirmClick')
    .directive('confirmClick', function ($rootScope) {
        return {
            restrict: "A",
            link: function (scope, element, attr) {
                var msg = attr.confirmClick || "Are you sure?";
                var clickAction = attr.confirmedClick;
                element.bind('click', function (event) {
                    event.stopImmediatePropagation();
                    event.preventDefault();
                    if (window.confirm(msg)) {
                        scope.$eval(clickAction);
                    } else {
                        console.log("cancelled")
                    }
                });
            }
        };
    });



// angular.module('confirmClick')
//     .directive('confirmClick', function ($rootScope, $location) {
//         return {
//             scope: {
//                 message: "@message",
//                 post: "=post"
//             },
//             restrict: "E",
//             template: "<a href='#'>{{post.title}}</a>",
//             link: function (scope, element, attr) {
//                 var msg = scope.message || "Are you sure?";
//                 element.bind("click", function (event) {
//                     if (window.confirm(msg)) {
//                         event.preventDefault();
//                         $rootScope.$evalAsync(function () {
//                             $location.path('/blog/' + scope.post.id);
//                         });
//                     }
//                 });
//             }
//         };
//     });
