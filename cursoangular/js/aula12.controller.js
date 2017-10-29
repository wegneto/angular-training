var app = angular.module('app', ['ngSanitize']);

function Aula12Controller($scope, $filter) {
    console.log("iniciou o controller Aula12Controller");

    $scope.show = true;

    $scope.variavelHTML = "<b>Hello world!</b>";

    $scope.minhaClass = "";

    $scope.variavelCloak = "teste teste teste teste teste teste ";

    $scope.minhaImagem = "imagem1.png";
} 

app.controller('Aula12Controller', Aula12Controller);