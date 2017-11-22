<?php
    session_start();
    if (!isset($_SESSION['logado'])) {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Painel Administrativo - Login</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body ng-app="app">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    Painel de Notícias
                </a>
                </div>
            </div>
        </nav>
        <div ng-controller="painelInicialController">

            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="well well-sm">
                            <button type="button" class="btn btn-primary" ng-click="abreCadastroNoticia()">
                                Cadastrar notícia
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- form -->
            <div class="container" ng-show="showCadastro">
                <form ng-submit="cadastrarNovaNotica()">
                    <div class="row mbottom">
                        <div class="col-xs-3 text-right">
                            Título:
                        </div>
                        <div class="col-xs-9">
                            <input type="text" class="form-control" ng-model="noticia.titulo" required>
                        </div>
                    </div>
                    <div class="row mbottom">
                        <div class="col-xs-3 text-right">
                            Descrição:
                        </div>
                        <div class="col-xs-9">
                            <input type="text" class="form-control" ng-model="noticia.descricao">
                        </div>
                    </div>
                    <div class="row mbottom">
                        <div class="col-xs-3 text-right">
                            Data:
                        </div>
                        <div class="col-xs-9">
                            <input class="form-control" ng-model="noticia.data" ui-mask="99/99/9999"
                                model-view-value="true">
                        </div>
                    </div>
                    <div class="row mbottom">
                        <div class="col-xs-3 text-right">
                            Texto:
                        </div>
                        <div class="col-xs-9">
                            <textarea class="form-control" ng-model="noticia.texto" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="row mbottom">
                        <div class="col-xs-9 col-xs-offset-3">
                            <button class="btn btn-primary" type="submit">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /form -->
        </div>
        
        <script src="../js/angular/angular.min.js"></script>
        <script src="../js/angular/ui-utils.min.js"></script>
        <script src="../js/painel-inicial.controller.js"></script>
    </body>
</html>