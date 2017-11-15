var app = angular.module('app', ['ui.bootstrap']);

app.controller('Aula26Controller', function ($scope) {
    console.log("### Starting Aula26Controller ####");

    $scope.grupos = [
        {heading: "Titulo dinamico 1", content: "Conteudo dinamico 1"},
        {heading: "Titulo dinamico 2", content: "Conteudo dinamico 2"},
        {heading: "Titulo dinamico 3", content: "Conteudo dinamico 3"}
    ];

    console.log("### Ending Aula26Controller ####");
});