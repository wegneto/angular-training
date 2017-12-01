<html ng-app="app">
    <head>
        <title>Lista de Notícias</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    </head>
    <body>
        <div ng-controller="indexController">

            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-header">
                            <h2>Angular News v1</h2>
                        </div>

                        <div class="jumbotron">
                            <h1>Seja bem vindo!</h1>
                            <p>Angular News v1</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="media" ng-repeat="item in noticias">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object" src="upload/{{item.noticia.imagens[0].arquivo}}" height="64" width="64" ng-show="item.noticia.imagens.length!=0">
                                    <img src="http://via.placeholder.com/64x64" ng-show="item.noticia.imagens.length==0">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="ver-noticia.php?id={{item.noticia.dados.id}}">{{item.noticia.dados.titulo}}</a>
                                    <span class="label label-primary">{{item.noticia.dados.data}}</span>                                
                                </h4>
                                <p>{{item.noticia.dados.descricao}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
        <script src="js/angular/angular.min.js"></script>
        <script src="js/app.module.js"></script>
        <script src="js/index.controller.js"></script>
    </body>
</html>