<?php

    //================================
    //Login
    //================================
    
    //Verificar Sessão
    if(!isset($_SESSION['a'])){
        exit();
    }

    $erro = true;
    $mensagem = '';

    //Verificar se foi feito um POST
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Verificar se os dados do login estão corretos
        $gestor = new cl_gestorBD();

        $parametros = [
            ':usuario'   => $_POST['text_usuario'],
            ':password'  => md5($_POST['text_password'])
        ];

        //Procurar o usuário na Base de dados
        $dados = $gestor->EXE_QUERY(
            'SELECT * FROM usuarios
            WHERE usuario = :usuario
            AND password = :password',$parametros);

        if(count($dados) == 0){
            //Login inválido
            $mensagem = 'Dados de login inválidos.';
        } else {
            $erro = false;
            funcoes::IniciarSessao($dados);

            //Armazena no LOG
            funcoes::CriarLOG('usuario'.$_SESSION['nome'].'fez login', $_SESSION['nome']);
        }
    }

?>

<?php if($erro) : //================================?>

    <?php
        if($mensagem!=''){
            echo '<div class="alert alert-danger text-center">'.$mensagem.'</div>'; 
        }
    ?>

    <v-content>
        <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <v-flex xs12 sm8 md4>
                    <v-card class="elevation-12">
                        <v-toolbar dark color="blue darken-3">
                            <v-toolbar-title>Login</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-btn flat href="?a=cadastro">Cadastre-se</v-btn>
                        </v-toolbar>
                        <v-card-text>
                            <form action="?a=login" method="post">
                                <v-text-field  color="black" prepend-icon="person" label="Login" type="text" name="text_usuario">
                                </v-text-field>
                                <v-text-field  color="black" prepend-icon="lock" label="Password" type="password" name="text_password">
                                </v-text-field>
                                <v-card-actions>
                                    <a href="?a=recuperar_password">Recuperar senha</a>
                                    <v-spacer></v-spacer>
                                    <div class="form-group text-center">
                                        <button role="submit">
                                            <v-btn color="blue darken-3">Login</v-btn>
                                        </button>
                                    </div>
                                </v-card-actions>
                            </form>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </v-content>

<?php else : //================================?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4 card m-3 p-3 text-center">
                <p>Bem vindo, <strong><?php echo $dados[0]['nome'] ?></strong></p>
                <a href="?a=inicio" class="btn btn-primary">Avançar</a>
            </div>
        </div>
    </div>
<?php endif; //================================?>