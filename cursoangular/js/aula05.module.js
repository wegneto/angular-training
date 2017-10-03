var app = angular.module('app', []);

app.filter('ola', function() {
    return function(nome) {
        return "Ola " + nome + "!";
    }
});