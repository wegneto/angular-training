app.controller('loginController', function($scope, $http) {
    console.log("### login controller ###");

    $scope.usuario = {
        usuario: "",
        senha: ""
    };

    $scope.login = function() {
        $http.post('../api/login', $scope.usuario)
            .success(function(data) {
                console.log(data);

                if (data.logado) {
                     window.location = 'painel-inicial.php'
                } else {
                    alert("Usuario/senha inexistente.")
                }

            });
    };
});