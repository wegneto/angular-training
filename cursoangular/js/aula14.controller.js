app.controller('Aula14Controller', function ($scope, $http) {

    $scope.dados = [];
    $scope.url = "http://api.openweathermap.org/data/2.5/weather?q=";
    $scope.cidade = "Lisbon";
    $scope.icone = "";
    $scope.descricaoTempo = "";

    $scope.carregaDados = function () {
        $http
            .get('dados.json')
            .then(function (data) {
                console.log(data);
                $scope.dados = data.data;
            }, function (error) {
                alert("Nao foi possivel carregar os dados");
            });
    };

    $scope.carregaPrevisao = function () {
        $http
            .get($scope.url+$scope.cidade+"&units=metric&appid=c0622f5aa29476a45f67d360353baa18")
            .then(function (data) {
                console.log(data);
                $scope.icone = data.data.weather[0].icon + ".png";
                $scope.descricaoTempo = data.data.weather[0].description;
            }, function (error) {
                alert("Nao foi possivel carregar os dados");
            });
    };

});