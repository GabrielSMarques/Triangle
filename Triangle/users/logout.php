<?php

    //================================
    //Barra de usuário
    //================================
    
    //Verificar Sessão
    if(!isset($_SESSION['a'])){
        exit();
    }

    $nome = $_SESSION['nome'];

    //Executa o logout (destruição) da sessão
    funcoes::DestroiSessao();

    //Armazena no LOG
    funcoes::CriarLOG('usuario'.$nome.'fez logout', $nome);
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-4 card m-3 p-3 text-center">
            <p>Até mais, <strong><?php echo $nome ?></strong></p>
            <a href="?a=inicio" class="btn btn-primary">Início</a>
        </div>
    </div>
</div>