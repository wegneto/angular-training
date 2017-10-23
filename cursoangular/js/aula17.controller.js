var app = angular.module('app', ['ngAnimate']);

app.controller('Aula17Controller', function ($scope) {
    $scope.itens = ['1','2','3'];

    $scope.addItem = function() {
        if ($scope.itens.indexOf($scope.itemadd) == -1) {
            $scope.itens.push($scope.itemadd);
        }
    };
});