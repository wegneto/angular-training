app.controller('aula08Controller', function($scope) {
    $scope.estados = ['BA', 'PE', 'SE', 'AL'];
    $scope.pessoa = novaPessoa();
    $scope.pessoas = [];

    $scope.addPessoa = function(pessoa) {
        $scope.pessoas.push(pessoa);
        $scope.pessoa = novaPessoa();

        $scope.frm.$setUntouched();
        $scope.frm.$setPristine();
    };

    console.log($scope.pessoa);
});

function novaPessoa() {
    return {
        nome: "",
        email: "",
        sexo: "",
        estado: "AL"
    };
}