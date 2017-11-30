app.controller('indexController', function($scope, $http) {
    console.log("### index controller ###");

    $scope.noticias = {};

    $scope.listarNoticias = function() {
        $http.get("api/getNoticiaFrontend")
            .success(function(data) {
                $scope.noticias = data.noticias;
            })
            .error(function() {
                alert('Erro de sistema.');
            });
    };

    $scope.listarNoticias();

});