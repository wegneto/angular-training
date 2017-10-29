function Aula10Controller($scope, $filter) {
    console.log("iniciou o controller Aula10Controller");

    $scope.pessoa = {
        nome: "Joao de Deus",
        idade: 38
    };

    console.log(
        $filter('sayHello')('Teste')
    );
} 

app.controller('Aula10Controller', Aula10Controller);