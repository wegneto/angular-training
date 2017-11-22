var app = angular.module('app', ['ui.mask','angular-loading-bar']);

app.controller('painelInicialController', function($scope, $http) {
    console.log("### painelInicialController begin ###");
    $scope.showCadastro = false;
    $scope.noticia = objNoticia();
    $scope.noticias = {};
    $scope.abreCadastroNoticia = function() {
        $scope.showCadastro = true;
    }

    $scope.listarNoticias = function() {
        $http.get("../api/listarNoticias")
            .success(function(data) {
                $scope.noticias = data.noticias;
            })
            .error(function() {
                alert('Erro de sistema.');
            });
    };

    $scope.cadastrarNovaNotica = function() {
        $http
            .post('../api/cadastrarNovaNoticia', $scope.noticia)
            .success(function(data) {
                if(!data.erro) {
                    $.gritter.add({
                        title: "Sucesso!",
                        text: "Notícia cadastrada com sucesso",
                        class_name: "gritter"
                    });
                    $scope.noticia = objNoticia();
                    $scope.showCadastro = false;
                    $scope.listarNoticias();
                } else {
                    alert('Falha ao cadastrar noticia.');
                }
            })
            .error(function() {
                alert('Erro de sistema.');
            });
    };

    $scope.listarNoticias();

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