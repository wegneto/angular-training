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

                        <button class="btn btn-success btn-block" type="button" ng-show="chat == true" ng-click="abrirModalChat()">
                            Chat Online
                        </button>
                        <button class="btn btn-danger btn-block" type="button" ng-show="chat == false" disabled>
                            Chat Offline
                        </button>
                        <hr>

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

            <div class="modal fade" id="chat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Chat</h4>
                        </div>
                        <div class="modal-body">
                            <div>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div ng-show="mostra_entrar_chat">
                                            <div class="col-xs-12 text-center">Informe seu nickname:</div>
                                                <div class="col-xs-10">
                                                    <input 
                                                        type="text" 
                                                        class="form-control" 
                                                        placeholder="fulano@email.com" ng-model="usuariochat.email">
                                                </div>
                                                <div class="col-xs-2">
                                                    <button 
                                                            type="button" 
                                                            class="btn btn-success btn-block" 
                                                            ng-disabled="usuariochat.email==''" 
                                                            ng-click="entrarChat()">
                                                        Entrar
                                                    </button>
                                                </div>
                                            </div>
                                            <div ng-show="mostra_batepapo">
                                                <div class="col-xs-12">
                                                    <div class="alert alert-info" style="height:350px; overflow:scroll; overflow-x:hidden" id="mostra_mensagens">
                                                        <div class="well well-sm" ng-repeat="msg in usuariochat.mensagens">
                                                            <p>De: {{msg.de}}</p>
                                                            <p>{{msg.msg}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr/>
                                                <div class="col-xs-10">
                                                    <input type="text" 
                                                        class="form-control" 
                                                        placeholder="Mensagem" 
                                                        ng-model="novaMensagem" 
                                                        id="cp_texto_enviar"
                                                        ng-keyup="$event.keyCode == 13 ? enviarMensagem() : null">
                                                </div>
                                                <div class="col-xs-2">
                                                    <button type="button" class="btn btn-success btn-block" ng-click="enviarMensagem()" ng-disabled="novaMensagem==''">Enviar</button>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" ng-click="sairChat()">Sair do chat</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="js/angular/angular.min.js"></script>
        <script src="http://localhost:3000/socket.io/socket.io.js"></script>
        <script src="js/angular/ng-socket-io.js"></script>
        <script src="js/index.controller.js"></script>
    </body>
</html>