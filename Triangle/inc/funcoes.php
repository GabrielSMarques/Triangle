<?php

    //================================
    //Funções Estáticas
    //================================

    //Verificar Sessão
    if(!isset($_SESSION['a'])){
        exit();
    }

    //=================================================
    class funcoes{

        //=============================================
        public static function VerificarLogin(){
            //Verifica se  o usuário tem sessão ativa
            $resultado = false;
            if(isset($_SESSION['id_usuario'])){
                $resultado = true;
            }

            return $resultado;
        }

        //============================================
        public static function IniciarSessao($dados){
            //Inicia a sessão
            $_SESSION['id_usuario'] = $dados[0]['id_usuario'];
            $_SESSION['nome'] = $dados[0]['nome'];
        }

        //============================================
        public static function DestroiSessao(){
            //Destroi as variáveis da sessão
            unset($_SESSION['id_usuario']);
            unset($_SESSION['nome']);
        }

        //===========================================
        public static function CriarCodigoAlfanumerico($tam){
            $codigo = '';
            $caracteres = 'abcdefghijklmnopqrstivwxyzABCDEFGHIJKLMNOPQRSTIVWXYZ@#$%&*!?/\|';

            for($i=0; $i<$tam; $i++){
                $codigo .= substr($caracteres, rand(0, strlen($caracteres)-1), 1);
            }

            return $codigo;
        }

        //==============================================
        public static function CriarLOG($mensagem, $usuario){
            //Cria um registro em LOG
            $gestor = new cl_gestorBD();

            $data_hora = new DateTime();

            $parametros = [
                ':data_hora'        => $data_hora->format('Y-m-d H:i:s'),
                ':usuario'          => $usuario, 
                ':mensagem'         => $mensagem
            ];

            $gestor->EXE_NON_QUERY(
                'INSERT INTO logs(data_hora, usuario, mensagem)
                 VALUES(:data_hora, :usuario, :mensagem)', $parametros);
        }
    }

?>