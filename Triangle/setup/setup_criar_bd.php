<?php

    //================================
    //Setup - Criar a base de dados
    //================================

    //Verificar Sessão
    if(!isset($_SESSION['a'])){
        exit();
    }

    if(isset($_GET['a'])){
        $a=$_GET['a'];
    }
    

    //Cria a base de dados
    $gestor = new cl_gestorBD();

    $configs = include('inc/config.php');

    //Apagar a base de dados caso ela já exista
    $gestor->EXE_NON_QUERY('DROP DATABASE IF EXISTS '.$configs['BD_DATABASE']);

    //Cria a base de dados
    $gestor->EXE_NON_QUERY('CREATE DATABASE '.$configs['BD_DATABASE'].' CHARACTER SET UTF8 COLLATE utf8_general_ci');
    $gestor->EXE_NON_QUERY('USE '.$configs['BD_DATABASE']);

    //==================================================
    //Criação das tabelas
    //==================================================

    //--------------------------------------------------
    //Usuários
    $gestor->EXE_NON_QUERY(
        'CREATE TABLE usuarios('.
        'id_usuario                 INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT, '.
        'usuario                    NVARCHAR(50), '.
        'password                   NVARCHAR(200), '.
        'nome                       NVARCHAR(50), '.
        'email                      NVARCHAR(200), '.
        'criado_em                  DATETIME, '.
        'atualizado_em              DATETIME)'
    );

    //---------------------------------------------------
    //Logs
    $gestor->EXE_NON_QUERY(
        'CREATE TABLE logs('.
        'id_log                 BIGINT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT, '.
        'data_hora              DATETIME, '.
        'usuario                NVARCHAR(50), '.
        'mensagem               NVARCHAR(200))'
    );

?>

<div class="alert alert-success text-center">Base de dados criada com sucesso</div>