<?php

require 'Slim/Slim.php';
require 'Db.class.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$db = new Db;

session_start();

header("Content-Type: application/json");

$app->get('/getNoticiaFrontend(/:idnoticia)', function ($idnoticia = NULL) use ($app, $db) {
    
        if($idnoticia==NULL){
            $where = "";
            $limit = " LIMIT 8 ";
        } else {
            $where = sprintf(' AND id = %s ', $idnoticia);   
            $limit = "";
        }
        
        $consulta = $db->con()->prepare("SELECT
                                            id,
                                            titulo,
                                            descricao,
                                            texto,
                                            status,
                                            DATE_FORMAT(data,'%d/%m/%Y') AS data
                                        FROM
                                            noticia
                                        WHERE
                                            status = 2
                                        ".$where."
                                        ORDER BY
                                            data DESC,
                                            titulo ASC
                                        ".$limit);
        $consulta->execute();
        $noticias = $consulta->fetchAll(PDO::FETCH_ASSOC);
    
        $noticias_array = array();
        $cont = 0;
        
        foreach($noticias as $not){
            
            $noticias_array[$cont]['noticia']['dados'] = $not;
            
            $noticias_array[$cont]['noticia']['dados']['texto'] = nl2br($noticias_array[$cont]['noticia']['dados']['texto']);
            
            $consulta = $db->con()->prepare("SELECT
                                                id,
                                                titulo,
                                                arquivo
                                            FROM
                                                imagem
                                            WHERE
                                                id_noticia = :IDNOTICIA
                                            ");
            $consulta->bindParam(':IDNOTICIA', $not['id']);
            $consulta->execute();
            $noticias_array[$cont]['noticia']['imagens'] = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $cont++;
        }
    
        echo json_encode(array("noticias"=>$noticias_array));
        
    }
);

$app->post(
    '/login',
    function () use ($app) {
        
        $data = json_decode($app->request()->getBody());
        $usuario = (isset($data->usuario)) ? $data->usuario : "";
	    $senha   = (isset($data->senha)) ? $data->senha : "";
        
        if($usuario=="admin" && $senha=="123"){
            
            $_SESSION['logado']=true;
            
            echo json_encode(array("logado"=>true));
        } else {
            echo json_encode(array("logado"=>false));   
        }
        
    }
);

$app->get(
    '/logout',
    function () use ($app) {
        session_destroy();
        header("Location: ../painel/index.php");
        exit;
    }
);

$app->post('/cadastrarNovaNoticia', 'auth', function () use ($app, $db) {
        sleep(2);
        $formData = json_decode($app->request()->getBody());
        $titulo = (isset($formData->titulo)) ? $formData->titulo : "";
	    $descricao = (isset($formData->descricao)) ? $formData->descricao : "";
        $data = (isset($formData->data)) ? $formData->data : "";
        $texto = (isset($formData->texto)) ? $formData->texto : "";
        
        $data_tmp = explode('/',$data);
    
        if(checkdate($data_tmp[1], $data_tmp[0], $data_tmp[2])){
            $data = sprintf('%s-%s-%s', $data_tmp[2], $data_tmp[1], $data_tmp[0]);
        } else {
            $data = NULL; 
        }
        
        $consulta = $db->con()->prepare('INSERT INTO noticia(titulo, descricao, texto, data) VALUES (:TITULO, :DESCRICAO, :TEXTO, :DATA)');
        $consulta->bindParam(':TITULO', $titulo);
        $consulta->bindParam(':DESCRICAO', $descricao);
        $consulta->bindParam(':TEXTO', $texto);
        $consulta->bindParam(':DATA', $data);
    
        if($consulta->execute()){
            echo json_encode(array("erro"=>false));
        } else {
            echo json_encode(array("erro"=>true));
        }
        
    }
);

$app->post('/alterarNoticia/:idnoticia', 'auth', function ($idnoticia) use ($app, $db) {
        
        $data = json_decode($app->request()->getBody());
    
        $idnoticia = (int)$idnoticia;
    
        $noticiatitulo = (isset($data->titulo)) ? $data->titulo : "";
	    $noticiadescricao = (isset($data->descricao)) ? $data->descricao : "";
        $noticiadata = (isset($data->data)) ? $data->data : "";
        $noticiatexto = (isset($data->texto)) ? $data->texto : "";
        
        $data_tmp = explode('/',$noticiadata);
    
        if(checkdate($data_tmp[1], $data_tmp[0], $data_tmp[2])){
            $data = sprintf('%s-%s-%s', $data_tmp[2], $data_tmp[1], $data_tmp[0]);
        } else {
            $data = NULL; 
        }
        
        $consulta = $db->con()->prepare('UPDATE noticia 
                                        SET 
                                            titulo = :NOTICIATITULO, 
                                            descricao = :NOTICIADESCRICAO, 
                                            texto = :NOTICIATEXTO, 
                                            data = :NOTICIADATA
                                        WHERE 
                                            id = :IDNOTICIA');
    
        $consulta->bindParam(':NOTICIATITULO', $noticiatitulo);
        $consulta->bindParam(':NOTICIADESCRICAO', $noticiadescricao);
        $consulta->bindParam(':NOTICIATEXTO', $noticiatexto);
        $consulta->bindParam(':NOTICIADATA', $data);
        $consulta->bindParam(':IDNOTICIA', $idnoticia);
    
        if($consulta->execute()){
            echo json_encode(array("erro"=>false));
        } else {
            echo json_encode(array("erro"=>true));
        }
        
    }
);

$app->get('/listarNoticias', 'auth', function () use ($app, $db) {
            
        $consulta = $db->con()->prepare("SELECT
                                            id,
                                            titulo,
                                            descricao,
                                            texto,
                                            status,
                                            DATE_FORMAT(data,'%d/%m/%Y') AS data
                                        FROM
                                            noticia
                                        ORDER BY
                                            data DESC,
                                            titulo ASC
                                        ");
        $consulta->execute();
        $noticias = $consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("noticias"=>$noticias));
        
    }
);

$app->get('/getnoticia/:idnoticia', 'auth', function ($idnoticia) use ($app, $db) {
        $idnoticia = (int)$idnoticia;
    
        $consulta = $db->con()->prepare("SELECT
                                            id,
                                            titulo,
                                            descricao,
                                            texto,
                                            DATE_FORMAT(data,'%d/%m/%Y') AS data
                                        FROM
                                            noticia
                                        WHERE
                                            id = :ID                                            
                                        ORDER BY
                                            data DESC,
                                            titulo ASC
                                        ");
        $consulta->bindParam(':ID', $idnoticia);
        $consulta->execute();
        $noticias = $consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("noticia"=>$noticias[0]));
        
    }
);

$app->get('/trocastatus/:idnoticia/:novostatus', 'auth', function ($idnoticia, $novostatus) use ($app, $db) {       
    
        $idnoticia = (int)$idnoticia;
        $novostatus = (int)$novostatus;
        
        $consulta = $db->con()->prepare('UPDATE noticia 
                                        SET 
                                            status = :NOTICIASTATUS
                                        WHERE 
                                            id = :IDNOTICIA');
    
        $consulta->bindParam(':NOTICIASTATUS', $novostatus);
        $consulta->bindParam(':IDNOTICIA', $idnoticia);
    
        if($consulta->execute()){
            echo json_encode(array("erro"=>false));
        } else {
            echo json_encode(array("erro"=>true));
        }
        
    }
);

$app->get('/excluirNoticia/:idnoticia', 'auth', function ($idnoticia) use ($app, $db) {       
    
        $idnoticia = (int)$idnoticia;
        
        // excluir as imagens
        $consulta = $db->con()->prepare("SELECT
                                            arquivo
                                        FROM
                                            imagem
                                        WHERE
                                            id_noticia = :IDNOTICIA                                        
                                        ");
        $consulta->bindParam(':IDNOTICIA', $idnoticia);
        $consulta->execute();
    
        $imagens = $consulta->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($imagens as $img){
            @unlink('../upload/'.$img['arquivo']);   
        }
    
        // excluir a notícia
        $consulta = $db->con()->prepare("DELETE FROM imagem WHERE id_noticia = :IDNOTICIA");
        $consulta->bindParam(':IDNOTICIA', $idnoticia);
        $consulta->execute();
    
        $consulta = $db->con()->prepare("DELETE FROM noticia WHERE id = :IDNOTICIA");
        $consulta->bindParam(':IDNOTICIA', $idnoticia);        
    
        if($consulta->execute()){
            echo json_encode(array("erro"=>false));
        } else {
            echo json_encode(array("erro"=>true));
        }
        
    }
);

// gerenciamento de imagens
$app->post('/cadastrarImagem/:idnoticia', 'auth', function ($idnoticia) use ($app, $db) {
        
        if ( !empty( $_FILES ) ) {
            $imagemtitulo = $_POST['titulo'];
            //$imagemtitulo = "temp";
            $imagemarquivo = $idnoticia."_".uniqid()."_".$_FILES[ 'file' ][ 'name' ];
            $idnoticia = (int)$idnoticia;
            
            $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
            $uploadPath = '../upload/'.$imagemarquivo;            
            move_uploaded_file( $tempPath, $uploadPath );
            
            $consulta = $db->con()->prepare('INSERT INTO imagem(titulo, arquivo, id_noticia) VALUES (:IMAGEMTITULO, :IMAGEMARQUIVO, :IDNOTICIA)');
            $consulta->bindParam(':IMAGEMTITULO', $imagemtitulo);
            $consulta->bindParam(':IMAGEMARQUIVO', $imagemarquivo);
            $consulta->bindParam(':IDNOTICIA', $idnoticia);

            if($consulta->execute()){
                echo json_encode(array("erro"=>false));
            } else {
                echo json_encode(array("erro"=>true));
            }
            
            
        } else {
            echo json_encode(array("erro"=>true));
        }
        
    }
);

$app->get('/listarImagens/:idnoticia', 'auth', function ($idnoticia) use ($app, $db) {
        
        $idnoticia = (int)$idnoticia;
    
        $consulta = $db->con()->prepare("SELECT
                                            id,
                                            titulo,
                                            arquivo
                                        FROM
                                            imagem
                                        WHERE
                                            id_noticia = :IDNOTICIA                                        
                                        ");
        $consulta->bindParam(':IDNOTICIA', $idnoticia);
        $consulta->execute();
    
        $imagens = $consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("imagens"=>$imagens));
        
    }
);

$app->get('/excluirImagem/:idimagem', 'auth', function ($idimagem) use ($app, $db) {
        
        $idimagem = (int)$idimagem;
    
        $consulta = $db->con()->prepare("SELECT
                                            arquivo
                                        FROM
                                            imagem
                                        WHERE
                                            id = :IDIMAGEM                                        
                                        ");
        $consulta->bindParam(':IDIMAGEM', $idimagem);
        $consulta->execute();
    
        $imagem = $consulta->fetchAll(PDO::FETCH_ASSOC)[0];
    
        @unlink("../upload/".$imagem['arquivo']);
    
        $consulta = $db->con()->prepare("DELETE FROM imagem WHERE id = :IDIMAGEM");
        $consulta->bindParam(':IDIMAGEM', $idimagem);
        $consulta->execute();
    
        echo json_encode(array("erro"=>false));
        
    }
);

function auth(){
    if(isset($_SESSION['logado'])){
        return true;
    } else {
        $app = \Slim\Slim::getInstance();
        echo json_encode(array("loginerror"=>true,"msg"=>"Acesso Negado"));
        $app->stop();
    }
}

$app->run();
