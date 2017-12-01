<html ng-app="app">
    <head>
        <title>Visualizar Notícia</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    </head>
    <body>
        <div ng-controller="visualizarNoticiaController">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-header">
                            {{noticia.dados.titulo}}
                            <span class="label label-info pull-right">
                                {{noticia.dados.data}}
                            </span>
                        </div>
                        <p ng-bind-html=noticia.dados.texto></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-2" ng-repeat="imagem in noticia.imagens">
                        <a href="#" ng-click="showImageModal(imagem.arquivo)">
                            <img src="upload/{{imagem.arquivo}}" title="{{imagem.titulo}}" class="img-responsive">
                        </a>
                    </div>
                </div>
            </div>

            <div id="verImagem" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-12">
                                    <img ng-src="upload/{{imagem}}" class="img-responsive">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="js/angular/angular.min.js"></script>
        <script src="js/angular/angular-sanitize.min.js"></script>
        <!--script src="js/app.module.js"></script-->
        <script src="js/visualizar.noticia.controller.js"></script>
    </body>
</html>