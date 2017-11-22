var app = angular.module('app', ['ui.mask']);

app.controller('painelInicialController', function($scope, $http) {
    console.log("### painelInicialController begin ###");
    $scope.showCadastro = false;
    $scope.noticia = objNoticia();

    $scope.abreCadastroNoticia = function() {
        $scope.showCadastro = true;
    }

    $scope.cadastrarNovaNotica = function() {
        console.log($scope.noticia);
        $http
            .post('../api/cadastrarNovaNoticia', $scope.noticia)
            .success(function(data) {
                if(!data.erro) {
                    alert('Noticia cadastrada com sucesso.');
                    $scope.noticia = objNoticia();
                    $scope.showCadastro = false;
                } else {
                    alert('Falha ao cadastrar noticia.');
                }
            })
            .error(function() {
                alert('Erro de sistema.');
            });
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