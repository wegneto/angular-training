app.controller('aula09Controller', ['$scope', 'operacoes', 'Pessoa', function($scope, operacoes, Pessoa) {
    console.log(operacoes.somar(10, 1));

    $scope.pessoa = new Pessoa();
}]);

app.controller('aula09Controller2', ['$scope', 'operacoes', function($scope, operacoes) {
    console.log(operacoes.subtrair(10, 1));

}]);