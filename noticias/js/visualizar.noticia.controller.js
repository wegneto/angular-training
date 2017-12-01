var app = angular.module('app', ['ngSanitize']);

app.controller('visualizarNoticiaController', function($scope, $http, $location) {
    console.log("### visualizarNoticiaController ###");

    $scope.noticia = {};

    $scope.getNoticia = function() {
        $http.get("api/getNoticiaFrontend/"+$location.search().id)
            .success(function(data) {
                $scope.noticia = data.noticias[0].noticia;
            })
            .error(function() {
                alert('Erro de sistema.');
            });
    };

    $scope.imagem = "";

    $scope.showImageModal = function(imagem) {
        $scope.imagem = imagem;
        $("#verImagem").modal('show');
    };

    $scope.getNoticia();

});

app.config(function($locationProvider) {
    $locationProvider.html5Mode({
        enabled: true,
        requireBase: false
    });
});