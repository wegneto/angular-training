app.controller('Aula13Controller', function($scope) {

});

app.directive('wgHello', function() {
    return {
        restrict: 'AEC',
        scope: {
            wgNome: '@'
        },
        template: '<h1>Hello {{wgNome}}!</h1>',
        controller: ['$scope', function($scope) {
            $scope.sayHello = function(nome) {
                alert('Hello ' + nome + '!');
            }
        }],
        link: function(scope, iElement, iAttrs) {
            console.log(iElement);
            console.log(iAttrs);
            scope.sayHello(iAttrs.wgNome);
        }
    };
});