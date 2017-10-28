var app = angular.module('app', ['pascalprecht.translate']);

app.config(function($translateProvider) {
    $translateProvider.translations('pt-br', {
        TITULO: "Seja bem vindo",
        PARAGRAFO1: "Ola mundo!",
        BTN_OK: "Confirmar",
        BTN_CANCEL: "Cancelar",
        BTN_EN: "English",
        BTN_PT_BR: "Portuguese"
    });

    $translateProvider.translations('en', {
        TITULO: "Welcome",
        PARAGRAFO1: "Hello world!",
        BTN_OK: "Confirm",
        BTN_CANCEL: "Cancel",
        BTN_EN: "Ingles",
        BTN_PT_BR: "Portugues"
    });

    $translateProvider.preferredLanguage("pt-br");
});

app.controller('Aula20Controller', function ($scope, $translate) {
    console.log("### Starting Aula20Controller ####");

    $scope.setIdioma = function(sigla) {
        $translate.use(sigla);
    }

    console.log("### Ending Aula20Controller ####");
});