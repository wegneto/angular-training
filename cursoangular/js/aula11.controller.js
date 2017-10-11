angular.module('app', ['ngRoute'])
.controller('Aula11Controller', function($scope, $route, $routeParams, $location) {
    $scope.$route = $route;
    $scope.$location = $location;
    $scope.$routeParams = $routeParams;
})
.controller('InicialController', function($scope) {
    console.log("Entrou no controller inicial");
}) 
.controller('Pagina1Controller', function($scope) {
    console.log("Entrou no controller da pagina 1");
}) 
.controller('Pagina2Controller', function($scope, $routeParams) {
    $scope.parametros = $routeParams;
    console.log("Entrou no controller da pagina 2");
    console.log("Parametro: " + $scope.parametros.id);
}) 
.config(function($routeProvider, $locationProvider) {
    $routeProvider
    .when('/inicio', {
        templateUrl: 'aula11_inicial.html',
        controller: 'InicialController'
    })
    .when('/Pagina1', {
        templateUrl: 'aula11_pagina1.html',
        controller: 'Pagina1Controller'
    })
    .when('/Pagina2/:id', {
        templateUrl: 'aula11_pagina2.html',
        controller: 'Pagina2Controller'
    })
    .otherwise({
        redirectTo: '/inicio'
    });

    $locationProvider.html5Mode(true);
});