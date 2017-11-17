var app = angular.module('app', ['ui.mask']);

app.controller('painelInicialController', function($scope, $http) {
    console.log("### painelInicialController begin ###");
    $scope.showCadastro = true;
    $scope.noticia = objNoticia();

    $scope.cadastrarNovaNotica = function() {

    };

    console.log("### painelInicialController end ###");
});

function objNoticia() {
    return {
        id: -1,
        titulo: "",
        descricao: "",
        texto: "",
        data: ""
    };
}