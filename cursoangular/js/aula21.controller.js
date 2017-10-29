var app = angular.module('app', ['angularFileUpload']);

app.controller('Aula21Controller', function ($scope, FileUploader) {
    console.log("### Starting Aula21Controller ####");

    var uploader = $scope.uploader = new FileUploader({
        url: 'service/upload.php'
    });

    uploader.filters.push({
        name: "tamanhoFila",
        fn: function(item, options) {
            return this.queue.length < 4;
        }
    });

    uploader.onSuccessItem = function(fileItem) {
        console.log("Arquivo enviado com sucesso.");
        fileItem.remove();
    };

    uploader.onErrorItem = function(fileItem) {
        console.log("Falha ao enviar o arquivo.", fileItem);
    };

    uploader.onWhenAddingFileFailed = function(fileItem) {
        console.log("Falha ao enviar o arquivo.", fileItem);
    };

    console.log("### Ending Aula21Controller ####");
});