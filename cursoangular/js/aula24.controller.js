var app = angular.module('app', ['uiGmapgoogle-maps']);

app.controller('Aula24Controller', function($scope){
    console.log("### Starting Aula24Controller ####");

    $scope.map = {
        center : {
            latitude: 45, 
            longitude: -73
        }, 
        zoom: 10 
    };

    $scope.marker = {
        id: 0,
        coords: {
            latitude: 45,
            longitude: -73
        }
    }

    console.log("### Ending Aula24Controller ####");
});