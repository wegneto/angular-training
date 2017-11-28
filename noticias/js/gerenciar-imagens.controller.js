var app = angular.module('app', ['angular-loading-bar', 'angularFileUpload']);

app.controller('gerenciarImagensController', function($scope, $http, $location, FileUploader) {
    console.log("### gerenciarImagensController begin ###");
    
    console.log($location.search().idnoticia)

    $scope.noticia = {};

    $scope.imagens = {};

    $scope.getNoticia = function(id) {
        $http.get("../api/getnoticia/" + id)
            .success(function(data) {
                $scope.noticia = data.noticia;
                $scope.showCadastro = true;
            })
            .error(function() {
                alert('Erro de sistema.');
            });
    };

    $scope.getImagens = function(id) {
        $http.get("../api/listarImagens/" + id)
            .success(function(data) {
                $scope.imagens = data.imagens;
            })
            .error(function() {
                alert('Erro de sistema.');
            });
    };

    $scope.excluirImagem = function(id) {
        if (confirm("Confirma exclusão?")) {
            $http.get("../api/excluirImagem/" + id)
                .success(function(data) {
                    $scope.getImagens($location.search().idnoticia);
                })
                .error(function() {
                    alert('Erro de sistema.');
                });
        }
    };

    $scope.getNoticia($location.search().idnoticia);
    $scope.getImagens($location.search().idnoticia);

    var uploader = $scope.uploader = new FileUploader({
        url: '../api/cadastrarImagem/'+$location.search().idnoticia
    });

    uploader.filters.push({
        name: "tamanhoFila",
        fn: function(item, options) {
            return this.queue.length < 4;
        }
    });

    uploader.onBeforeUploadItem = function(item) {
        item.formData.push({
            titulo: item.titulo
        });
    };

    uploader.onSuccessItem = function(fileItem) {
        console.log("Arquivo enviado com sucesso.");
        fileItem.remove();
        $scope.getImagens($location.search().idnoticia);
    };

    uploader.onErrorItem = function(fileItem) {
        console.log("Falha ao enviar o arquivo.", fileItem);
    };

    uploader.onWhenAddingFileFailed = function(fileItem) {
        console.log("Falha ao enviar o arquivo.", fileItem);
    };

    console.log("### gerenciarImagensController end ###");
});

app.config(function($locationProvider) {
    $locationProvider.html5Mode({
        enabled: true,
        requireBase: false
    });
});