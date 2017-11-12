var app = angular.module('app', ['ui.highlight', 'ui.mask', 'ngSanitize']);

app.controller('Aula22Controller', function ($scope) {
    console.log("### Starting Aula22Controller ####");

    $scope.text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam pulvinar.';

    $scope.maskcpf = '999.999.999-99';

    $scope.maskphone = '(99) 9999-9999';

    console.log("### Ending Aula22Controller ####");
});