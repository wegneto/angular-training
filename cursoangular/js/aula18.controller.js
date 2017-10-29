app.controller('Aula18Controller', function ($scope, $location) {
    $scope.$location = $location;

    $scope.setId = function(p_id) {
        console.log("setId");
        $location.search({id: p_id});
    }

    $scope.$watch('$location.search().id', function(id) {
        console.log("mudou o valor do id para: " + id);
    });

}).config(function($locationProvider) {
    $locationProvider.html5Mode({
        enabled: true,
        requireBase: false
    }).hashPrefix('#');
});