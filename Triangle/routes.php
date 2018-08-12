<?php

    //================================
    //Routes
    //================================
    
    //Verificar Sessão
    if(!isset($_SESSION['a'])){
        exit();
    }

    $a='inicio';
    if(isset($_GET['a'])){
        $a=$_GET['a'];
    }

    //Verificar o login
    if(!funcoes::VerificarLogin()){
        //Casos especiais

        $routes_especiais = [
            'recuperar_password',
            'setup',
            'setup_criar_bd',
            'setup_inserir_usuarios',
            'cadastro'
        ];

        if(!in_array($a, $routes_especiais)){
            $a = 'login';
        }
    }

    switch($a){
        case 'login':                   include_once('users/login.php'); break;

        case 'logout':                  include_once('users/logout.php'); break;

        case 'recuperar_password':      include_once('users/recuperar_password.php'); break;

        case 'cadastro':                include_once('users/cadastro.php'); break;

        case 'inicio':                  include_once('inicio.php'); break;

        case 'about':                   include_once('about.php'); break;

        case 'setup':                   include_once('setup/setup.php'); break;

        case 'setup_criar_bd':          include_once('setup/setup.php'); break;

        case 'setup_inserir_usuarios':  include_once('setup/setup.php'); break;
    }
?>