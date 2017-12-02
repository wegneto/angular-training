var app = angular.module('app', ['ui.mask','angular-loading-bar', 'socket-io']);

app.controller('painelInicialController', function($scope, $http, socket) {
    console.log("### painelInicialController begin ###");
    
    //chat--
    $scope.senha = "123456";
    $scope.chat = false;
    $scope.chatUsuarios = [];
    $scope.novaMensagem = '';
    $scope.usuarioAtivo = 0;

    socket.emit('adminlogin', $scope.senha);

    $scope.chatStatus = function() {
        socket.emit('setChatStatus', $scope.senha);
    };

    socket.on('chatstatus', function(data) {
        $scope.chat = data.online;
    });

    socket.on('usuarioentrou', function(email) {
        $scope.chatUsuarios.push({usuario: email, mensagens: []});

        if ($scope.chatUsuarios.length == 1) {
            $scope.usuarioAtivo = 0;
        }
    });

    socket.on('novamensagemparaadmin', function(mensagem){
        var index = $scope.buscaUsuario(mensagem.de);
        $scope.chatUsuarios[index].mensagens.push({de: mensagem.de, msg: mensagem.msg});
    });

    $scope.buscaUsuario = function(usuario) {
        var status = false;
        var cont = 0;
        while (cont < $scope.chatUsuarios.length) {
            if ($scope.chatUsuarios[cont].usuario == usuario) {
                return cont;
            }
            cont++;
        }

        return false;
    };

    $scope.enviarMensagem = function() {
        $scope.chatUsuarios[$scope.usuarioAtivo].mensagens.push({
            de: 'Admin', msg: $scope.novaMensagem
        });

        socket.emit('enviarmensagemparausuario', {
            para: $scope.chatUsuarios[$scope.usuarioAtivo].usuario, 
            msg: $scope.novaMensagem
        });

        $scope.novaMensagem = '';
        $scope.scrollDown();
    };

    $scope.setUsuarioAtivo = function(index) {
        $scope.usuarioAtivo = index;
    };

    $scope.scrollDown = function() {
        setTimeout(function() {
            $("#mostra_mensagens").scrollTop(1E10);
        }, 800);
    };

    //--chat
    
    $scope.showCadastro = false;
    $scope.noticia = objNoticia();
    $scope.noticias = {};
    $scope.abreCadastroNoticia = function() {
        $scope.noticia = objNoticia();
        $scope.showCadastro = true;
    }

    $scope.listarNoticias = function() {
        $http.get("../api/listarNoticias")
            .success(function(data) {
                $scope.noticias = data.noticias;
            })
            .error(function() {
                alert('Erro de sistema.');
            });
    };

    $scope.cadastrarNovaNotica = function() {
        $http
            .post('../api/cadastrarNovaNoticia', $scope.noticia)
            .success(function(data) {
                if(!data.erro) {
                    $.gritter.add({
                        title: "Sucesso!",
                        text: "Notícia cadastrada com sucesso",
                        class_name: "gritter"
                    });
                    $scope.noticia = objNoticia();
                    $scope.showCadastro = false;
                    $scope.listarNoticias();
                } else {
                    alert('Falha ao cadastrar noticia.');
                }
            })
            .error(function() {
                alert('Erro de sistema.');
            });
    };

    $scope.alterarNotica = function() {
        $http
            .post('../api/alterarNoticia/'+$scope.noticia.id, $scope.noticia)
            .success(function(data) {
                if(!data.erro) {
                    $.gritter.add({
                        title: "Sucesso!",
                        text: "Notícia alterada com sucesso",
                        class_name: "gritter"
                    });
                    $scope.noticia = objNoticia();
                    $scope.showCadastro = false;
                    $scope.listarNoticias();
                } else {
                    alert('Falha ao alterar noticia.');
                }
            })
            .error(function() {
                alert('Erro de sistema.');
            });
    };

    $scope.submitForm = function() {
        if ($scope.noticia.id == -1) {
            $scope.cadastrarNovaNotica();
        } else  {
            $scope.alterarNotica();
        }
    }

    $scope.getNoticia = function(id) {
        $http.get("../api/getnoticia/" + id)
            .success(function(data) {
                $scope.noticia = data.noticia;
                $scope.showCadastro = true;
            })
            .error(function() {
                alert('Erro de sistema.');
            });
    }

    $scope.trocaStatus = function(noticia, status) {
        $http.get("../api/trocastatus/" + noticia.id + "/" + status)
            .success(function(data) {
                noticia.status = status;
            })
            .error(function() {
                alert('Erro de sistema.');
            });
    }

    $scope.excluirNoticia = function(id) {
        $http.get("../api/excluirNoticia/" + id)
            .success(function(data) {
                $scope.listarNoticias();
                $.gritter.add({
                        title: "Sucesso!",
                        text: "Notícia excluida com sucesso",
                        class_name: "gritter"
                    });
            })
            .error(function() {
                alert('Erro de sistema.');
            });
    }

    $scope.listarNoticias();

    console.log("### painelInicialController end ###");
});

function objNoticia() {
    return {
        id: -1,
        titulo: "",
        descricao: "",
        texto: "",
        data: ""
    };
}