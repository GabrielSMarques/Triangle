<?php

    //=======================================
    //index
    //=======================================

    //Controle de sessão
    session_start();
    if(!isset($_SESSION['a'])){
        $_SESSION['a']='inicio';
    }

    //Inclui as funções necessários do sistema
    include_once('inc/funcoes.php');
    include_once('inc/gestorBD.php');
    include_once('inc/emails.php');

    //Barra do usuário

    include_once('_cabecalho.php');

    include_once('users/barra_usuario.php');

    include_once('routes.php');

    include_once('_rodape.php');

?>