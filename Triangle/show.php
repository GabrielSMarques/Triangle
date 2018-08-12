<?php

    //================================
    //Show
    //================================

    $q='0';
    if(isset($_GET['q'])){
        $q=$_GET['q'];
    }

    include_once('inc/gestorBD.php');

    $gestor = new cl_gestorBD();


    $parametros = [
        ':password'  => $q
    ];

    //Procurar o usuário na Base de dados
    $dados = $gestor->EXE_QUERY(
        'SELECT * FROM usuarios
        WHERE password = :password', $parametros);

?>
<div class="sites-embed-border-on sites-embed sites-embed-full-width" style="width:100%;">
    <div class="sites-embed-object-title" style="display:none;">notasWeb.xlsx</div>
        <div class="sites-embed-content sites-embed-type-spreadsheet">
            <iframe 
                src=<?php echo $dados[0]['email'] ?> width="100%" height="100%"></iframe>
        </div>
    </div>
</div>