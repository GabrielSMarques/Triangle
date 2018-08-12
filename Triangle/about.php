<?php

    //================================
    //Routes
    //================================
    
    //Verificar Sessão
    if(!isset($_SESSION['a'])){
        exit();
    }

    $configs = include('inc/config.php');

    echo $configs['NOME_BD'];
?>

<p>About!!</p>