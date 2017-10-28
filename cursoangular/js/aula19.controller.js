var app = angular.module('app', ['ngCookies']);

app.controller('Aula19Controller', function ($scope, $cookieStore) {
    console.log("### Starting Aula19Controller ####");

    $scope.criarCookie = function() {
        $cookieStore.put("userData", {
            "nome" : "user name",
            "idade": 25
        });
    }

    $scope.getCookie = function() {
        console.log($cookieStore.get("userData"));
    }

    $scope.removeCookie = function() {
        $cookieStore.remove("userData");
    }

    console.log("### Ending Aula19Controller ####");
});

app.controller('Aula19Controller_2', function ($scope, $cookieStore) {
    console.log("### Starting Aula19Controller_2 ####");

    $scope.getCookie2 = function() {
        console.log($cookieStore.get("userData"));
    }

    console.log("### Ending Aula19Controller_2 ####");
});