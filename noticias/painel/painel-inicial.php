<?php
    session_start();
    if (!isset($_SESSION['logado'])) {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html ng-app="app">
    <head>
        <title>Painel Administrativo - Login</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="../js/angular/loading-bar.min.css">
        <link rel="stylesheet" href="../js/jquery/jquery.gritter.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
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

            <div class="container" ng-show="chatUsuarios.length > 0">
                <div class="row">
                    <div class="col-xs-12">
                        <h2>Atendimentos</h2>
                        <div class="col-xs-12">
                            <div id="mostra_mensagens" class="alert alert-info" style="height: 350px; overflow: scroll; overflow-x:hidden;">
                                <div class="well well-sm" ng-repeat="msg in chatUsuarios[usuarioAtivo].mensagens">
                                    <p>De: {{msg.de}}</p>
                                    <p>{{msg.msg}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-xs-12">
                        <a href="#" ng-repeat="(key,u) in chatUsuarios" ng-click="setUsuarioAtivo(key)" class="btn btn-primary">
                            {{u.usuario}}
                        </a>
                    </div>
                    <div class="col-xs-10">
                        <input type="text" class="form-control" placeholder="mensagem" ng-model="novaMensagem" 
                            ng-keyup="$event.keyCode == 13 ? enviarMensagem() : null">
                    </div>
                    <div class="col-xs-2">
                        <button class="btn btn-primary btn-block" type="button" ng-click="enviarMensagem()" ng-disabled="novaMensagem == ''">
                            Enviar
                        </button>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="well well-sm">
                            <button type="button" class="btn btn-primary" ng-click="abreCadastroNoticia()">
                                Cadastrar notícia
                            </button>
                            <button class="btn btn-success" type="button" ng-show="chat == true" ng-click="chatStatus()">
                                Chat Online
                            </button>
                            <button class="btn btn-danger" type="button" ng-show="chat == false" ng-click="chatStatus()">
                                Chat Offline
                            </button>
                            <a href="../api/logout" class="btn btn-danger pull-right">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- form -->
            <div class="container" ng-show="showCadastro">
                <form ng-submit="submitForm()"> 
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
                            <button class="btn btn-primary" type="submit" ng-show="noticia.id == -1">Cadastrar</button>
                            <button class="btn btn-primary" type="submit" ng-show="noticia.id != -1">Alterar</button>
                            <button class="btn btn-danger" type="button" ng-click="showCadastro=false">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /form -->

            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-bordered table-striped table-hover" ng-show="noticias.length!=0">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Título</th>
                                    <th width="50">Status</th>
                                    <th width="150">-</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="noticia in noticias">
                                    <td>{{noticia.data}}</td>
                                    <td>{{noticia.titulo}}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger" ng-show="noticia.status == 1" ng-click="trocaStatus(noticia,2)">
                                            <i class="glyphicon glyphicon-eye-open"></i>
                                        </button>
                                        <button type="button" class="btn btn-success" ng-show="noticia.status != 1" ng-click="trocaStatus(noticia,1)">
                                            <i class="glyphicon glyphicon-eye-close"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" ng-click="getNoticia(noticia.id)">
                                            <span class="glyphicon glyphicon-pencil"></span> 
                                        </button>
                                        <a href="gerenciar-imagens.php?idnoticia={{noticia.id}}" class="btn btn-primary" ng-click="getNoticia(noticia.id)">
                                            <span class="glyphicon glyphicon-upload"></span> 
                                        </a>
                                        <button type="button" class="btn btn-danger" ng-click="excluirNoticia(noticia.id)">
                                            <span class="glyphicon glyphicon-trash"></span> 
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="alert alert-warning" ng-show="noticias.length==0 && !showCadastro">
                            <strong>Nenhuma notícia cadastrada.</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="../js/jquery/jquery.gritter.min.js"></script>
        <script src="../js/angular/angular.min.js"></script>
        <script src="http://localhost:3000/socket.io/socket.io.js"></script>
        <script src="../js/angular/ng-socket-io.js"></script>
        <script src="../js/angular/ui-utils.min.js"></script>        
        <script src="../js/angular/loading-bar.min.js"></script>
        <script src="../js/painel-inicial.controller.js"></script>
    </body>
</html>