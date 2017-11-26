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
                <a class="navbar-brand" href="painel-inicial.php">
                    Gerenciar Imagens
                </a>
                </div>
            </div>
        </nav>
        <div ng-controller="painelInicialController">
            
        </div>
        
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="../js/jquery/jquery.gritter.min.js"></script>
        <script src="../js/angular/angular.min.js"></script>
        <script src="../js/angular/ui-utils.min.js"></script>        
        <script src="../js/angular/loading-bar.min.js"></script>
        <script src="../js/painel-inicial.controller.js"></script>
    </body>
</html>