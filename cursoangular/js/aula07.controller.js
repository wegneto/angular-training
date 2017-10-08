app.controller('aula07Controller', function($scope) {
    console.log("iniciando o controller aula07Controller");

    $scope.nomes = ["Alfie", "Angel", "Bella", "Charlie", "Chloe"];

    $scope.pessoas = [];

    for(var i = 0; i < 10; i++) {
        $scope.pessoas.push(
            {nome: "Usuario " + i, idade: 20 + i, status: false}
        );
    }
    
    console.log($scope.pessoas);

    $scope.addPessoa = function() {
        var nome = document.getElementById("nome");
        var idade = document.getElementById("idade");
        $scope.pessoas.push(
            {nome: nome.value, idade: idade.value, status: true}
        );

        nome.value = "";
        idade.value = "";
    };

    console.log("concluindo a execucao do controller aula07Controller");
});