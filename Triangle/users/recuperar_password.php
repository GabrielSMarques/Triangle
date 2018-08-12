<?php

    //================================
    //Recuperar a senha
    //================================
    
    //Verificar Sessão
    if(!isset($_SESSION['a'])){
        exit();
    }

    $erro = true;
    $mensagem = '';

    //Verificar se foi feito um POST
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Verificar se os dados estão corretos
        $gestor = new cl_gestorBD();

        $parametros = [
            ':email'   => $_POST['text_email'],
        ];

        //Procurar o usuário na Base de dados
        $dados = $gestor->EXE_QUERY(
            'SELECT * FROM usuarios
            WHERE email = :email',$parametros);

        if(count($dados) == 0){
            //Login inválido
            $mensagem = 'Email inválido.';
        } else {
            $erro = false;

            //Gera nova senha
            $nova_senha = funcoes::CriarCodigoAlfanumerico(10);

            //Envia a nova senha pelo email
            $email = new emails();

            $mensagem_enviada = $email->EnviarEmail([$dados[0]['email'], 'Recuperação de senha', 'Sua nova senha é: '.$nova_senha]);
            

            if($mensagem_enviada){
                //Altera a senha
                $id_usuario = $dados[0]['id_usuario'];

                //Definição de parâmetros
                $parametros = [
                    ':id_usuario'       => $id_usuario,
                    ':password'         => md5($nova_senha),
                ];

                //Att a senha
                $gestor->EXE_NON_QUERY(
                    'UPDATE usuarios
                    SET password = :password
                    WHERE id_usuario = :id_usuario',$parametros);

                //Armazena no LOG
                funcoes::CriarLOG('usuario'.$dados[0]['nome'].'recuperou a senha', $dados[0]['nome']);
            }
            else{
                $erro=true;
                $mensagem='Ocorreu um erro. Tente novamente';
            }
        }
    }

?>

<?php if($erro) : //================================?>

    <?php
        if($mensagem!=''){
            echo '<div class="alert alert-danger text-center">'.$mensagem.'</div>';
        }
    ?>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4 card m-3 p-3">
                <h2 class="p-3">Recuperar senha</h2>

                <form action="?a=recuperar_password" method="post">
                    <div class="form-group">
                        <input type="email" name="text_email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group text-center">
                        <a href="?a=inicio" class="btn btn-primary btn-size-150">Cancelar</a>
                        <button role="submit" class="btn btn-primary btn-size-150">Recuperar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php else : //================================?>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4 card m-3 p-3 text-center">
                <p>Um email foi enviado</p>
                <a href="?a=inicio" class="btn btn-primary">Inicio</a>
            </div>
        </div>
    </div>

<?php endif; //================================?>