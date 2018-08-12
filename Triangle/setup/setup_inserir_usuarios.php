<?php

    //================================
    //Setup - Iserir usuários
    //================================

    //Verificar Sessão
    if(!isset($_SESSION['a'])){
        exit();
    }

    //Inserir o usuário admin
    $gestor = new cl_gestorBD();

    $data = new DateTime();

    //Definição de parâmetros
    $parametros = [
        ':usuario'          => 'admin',
        ':password'         => md5('admin'),
        ':nome'             => 'Administrador',
        ':email'            => 'gabriel1997.marques97@gmail.com',
        ':criado_em'        => $data->format('Y-m-d H:i:s'),
        ':atualizado_em'    => $data->format('Y-m-d H:i:s') 
    ];

    //Inserir o usuário
    $gestor->EXE_NON_QUERY(
        'INSERT INTO usuarios(usuario, password, nome, email, criado_em, atualizado_em)
        VALUES(:usuario, :password, :nome, :email, :criado_em, :atualizado_em)',$parametros);

    
?>

<div class="alert alert-success text-center">Usuários inseridos com sucesso</div>