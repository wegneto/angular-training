app.controller('aula06Controller', function($scope) {

    console.log("iniciando o controller aula06Controller");

    $scope.nome = "Curso de AngularJS";

    $scope.helloWorld = function(name) {
        alert("Hello " + name + "!");
    };

    console.log("executou o controller aula06Controller");
});