<?php

    //================================
    //Instalação
    //================================

    //Verificar Sessão
    if(!isset($_SESSION['a'])){
        exit();
    }

    if(isset($_GET['a'])){
        $a=$_GET['a'];
    }

    switch ($a) {
        case 'setup_criar_bd':
            //Executa os procedimentos para a criação da base de dados
            include('setup/setup_criar_bd.php');
            break;

        case 'setup_inserir_usuarios':
            //Inserir usuários
            include('setup/setup_inserir_usuarios.php');
            break;
    }
?>

<div class="container-fluid pad-20">
    <h2 class="text-center">SETUP</h2>

    <div class="text-center">
        <p><a href="?a=setup_criar_bd" class="btn btn-secondary btn-size-250">Criar a base de dados</a></p>
        <p><a href="?a=setup_inserir_usuarios" class="btn btn-secondary btn-size-250">Inserir usuários</a></p>
        <hr>
        <p><a href="?a=inicio" class="btn btn-secondary btn-size-150">Voltar</a></p>
    </div>
</div>