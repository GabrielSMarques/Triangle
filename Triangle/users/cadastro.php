<?php

    //================================
    //Cadastro
    //================================
    
    //Verificar Sessão
    if(!isset($_SESSION['a'])){
        exit();
    }

    //Verificar se foi feito um POST
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Inserir o usuário admin
        $gestor = new cl_gestorBD();

        $data = new DateTime();

        //Definição de parâmetros
        $parametros = [
            ':usuario'          => $_POST['text_usuario'],
            ':password'         => md5($_POST['text_password']),
            ':nome'             => $_POST['text_nome'],
            ':email'            => $_POST['text_usuario'],
            ':criado_em'        => $data->format('Y-m-d H:i:s'),
            ':atualizado_em'    => $data->format('Y-m-d H:i:s') 
        ];

        //Inserir o usuário
        $gestor->EXE_NON_QUERY(
            'INSERT INTO usuarios(usuario, password, nome, email, criado_em, atualizado_em)
            VALUES(:usuario, :password, :nome, :email, :criado_em, :atualizado_em)',$parametros);
    }
?>
    <v-content>
        <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <v-flex xs12 sm8 md4>
                    <v-card class="elevation-12">
                        <v-toolbar dark color="blue darken-3">
                            <v-toolbar-title>Cadastro</v-toolbar-title>
                        </v-toolbar>
                        <v-card-text>
                            <form action="?a=cadastro" method="post">
                                <v-text-field  color="black" prepend-icon="home" label="Escola" type="text" name="text_nome">
                                </v-text-field>
                                <v-text-field  color="black" prepend-icon="email" label="E-mail" type="text" name="text_usuario">
                                </v-text-field>
                                <v-text-field  color="black" prepend-icon="lock" label="Password" type="password" name="text_password">
                                </v-text-field>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <div class="form-group text-center">
                                        <button role="submit"><v-btn color="blue darken-3">Confirmar</v-btn></button>
                                    </div>
                                </v-card-actions>
                            </form>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </v-content>