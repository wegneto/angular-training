app.controller('Aula18Controller', function ($scope, $location) {
    $scope.$location = $location;

    $scope.setId = function(p_id) {
        console.log("setId");
        $location.search({id: p_id});
    }

}).config(function($locationProvider) {
    $locationProvider.html5Mode({
        enable: true,
        requireBase: false
    }).hashPrefix('#');
});