app.directive('tooltip', function() {
    return {
        restrict: 'A',
        link: function(scope, element, attr) {
            element.tooltipsy({
                offset: [0, 10],
                content: scope.txtToolTip
            });
        }
    }
});

app.controller('Aula16Controller', function ($scope) {
    $scope.txtToolTip = "Novo texto";
});