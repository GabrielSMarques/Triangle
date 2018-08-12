<?php

    //================================
    //Barra de usuário
    //================================
    
    //Verificar Sessão
    if(!isset($_SESSION['a'])){
        exit();
    }

    $nome_usuario='Nenhum usuário ativo';

    if(funcoes::VerificarLogin()){
        $nome_usuario=$_SESSION['nome'];
    }
?>