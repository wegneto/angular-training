var app = angular.module('app', ['ui.unique', 'ui.validate']);

app.controller('Aula23Controller', function ($scope) {
    console.log("### Starting Aula23Controller ####");

    $scope.usuarios = [
        {nome: "Teste 1", email: "teste1@teste.com"},
        {nome: "Teste 2", email: "teste2@teste.com"},
        {nome: "Teste 3", email: "teste3@teste.com"},
        {nome: "Teste 4", email: "teste3@teste.com"},
        {nome: "Teste 5", email: "teste3@teste.com"},
        {nome: "Teste 5", email: "teste3@teste.com"}
    ];

    $scope.validar = function(valor) {
        return valor === $scope.senha;
    };

    console.log("### Ending Aula23Controller ####");
});