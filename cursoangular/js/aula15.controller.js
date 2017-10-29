var app = angular.module('app', ['ngResource']);

app.factory('Livros', ['$resource', function($resource) {
    return $resource('api/livros/:livroid', {livroid : '@livroid'});
}]);

app.controller('Aula15Controller', function ($scope, Livros) {

    $scope.carregaLivros = function() {
        Livros.get(function(data) {
            console.log(data.mensagem);
        });
    };

    $scope.getLivro = function(id) {
        Livros.get({livroid: id}, function(data) {
            console.log(data.mensagem);
        });
    };

    $scope.salvarLivro = function() {
        livro = {
            "id": 2,
            "titulo": "Angular for noobies"
        };

        Livros.save({}, livro);
    };

});