<?php

    //================================
    //Início
    //================================
    
    //Verificar Sessão
    if(!isset($_SESSION['a'])){
        exit();
    }

    $control = '0';
    $matricula = false;

    //Verificar se foi feito um POST
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Inserir o usuário admin
        $gestor = new cl_gestorBD();

        //if($control==1){
          $data = new DateTime();

          //Definição de parâmetros
          $parametros = [
              ':usuario'          => $_SESSION['nome'],
              ':password'         => $_POST['text_matricula'],
              ':nome'             => $_POST['text_nome'],
              ':email'            => $_POST['text_link'],
              ':criado_em'        => $data->format('Y-m-d H:i:s'),
              ':atualizado_em'    => $data->format('Y-m-d H:i:s') 
          ];

          //Inserir o usuário
          $gestor->EXE_NON_QUERY(
            'INSERT INTO usuarios(usuario, password, nome, email, criado_em, atualizado_em)
            VALUES(:usuario, :password, :nome, :email, :criado_em, :atualizado_em)',$parametros);
          
          $control=0;
        }
        /*else{
          $parametros = [
            ':password'  => $_POST['text_matricula']
        ];
    
        //Procurar o usuário na Base de dados
        $dados = $gestor->EXE_QUERY(
            'SELECT * FROM usuarios
            WHERE password = :password', $parametros);

        $matricula = true;
        }*/
?>
    <v-toolbar
      :clipped-left="$vuetify.breakpoint.lgAndUp"
      color="blue darken-3"
      dark
      app
      fixed
    >
      <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
        <span class="hidden-sm-and-down">Triangle</span>
      </v-toolbar-title>
        <v-btn icon>
            <v-icon>far fa-calendar-alt</v-icon>
        </v-btn>
        <v-btn icon>
            <v-icon>fas fa-chalkboard</v-icon>
        </v-btn>
        <v-spacer></v-spacer>
        <v-form action="?a=inicio" method="post">
            <v-text-field
            flat
            solo-inverted
            hide-details
            prepend-inner-icon="search"
            label="Matrícula"
            class="hidden-sm-and-down"
            name="text_matricula"
            ></v-text-field>
        </v-form>
        <v-spacer></v-spacer>
        <v-btn icon>
          <v-icon>fab fa-facebook-square</v-icon>
        </v-btn>
        <v-btn icon>
          <v-icon>fab fa-instagram</v-icon>
        </v-btn>
        <v-btn icon large>
          <v-avatar size="50px" tile>
            <img
              src="images/logo.png"
              alt="Triangle"
            >
          </v-avatar>
        </v-btn>
    </v-toolbar>

    <v-btn
      fab
      bottom
      left
      color="pink"
      dark
      fixed
      href="?a=logout"
    >
      <v-icon>fas fa-sign-out-alt</v-icon>
    </v-btn>
    
    <v-btn
      fab
      bottom
      right
      color="pink"
      dark
      fixed
      @click.stop="dialog = !dialog"
    >
      <v-icon>add</v-icon>
    </v-btn>
    
    <v-dialog v-model="dialog" width="800px">
        <v-card>
            <v-card-title
            class="grey lighten-4 py-4 title"
            >
            Adicionar aluno
            </v-card-title>
            <form action="?a=inicio" method="post">
            <v-container grid-list-sm class="pa-4">
            <v-layout row wrap>
                <v-flex xs12 align-center justify-space-between>
                <v-layout align-center>
                    <v-avatar size="40px" class="mr-3">
                    <img
                        src="//ssl.gstatic.com/s2/oz/images/sge/grey_silhouette.png"
                        alt=""
                    >
                    </v-avatar>
                    <v-text-field
                    placeholder="Nome"
                    name="text_nome"
                    ></v-text-field>
                </v-layout>
                </v-flex>
                <v-flex xs6>
                <v-text-field
                    prepend-icon="fas fa-edit"
                    placeholder="Matrícula"
                    name="text_matricula"
                ></v-text-field>
                </v-flex>
                <v-flex xs6>
                <v-text-field
                    placeholder="Link para a planilha"
                    name="text_link"
                ></v-text-field>
                </v-flex>
            </v-layout>
            </v-container>
            <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn flat color="primary" @click="dialog = false">Cancel</v-btn>
            <div class="form-group">
                <button role="submit" onClick="<?php $control=1; ?>"><v-btn flat>Confirmar</v-btn></button>
            </div>
            </form>
            </v-card-actions>
        </v-card>
        </v-dialog>

    <?php if($matricula): ?>
      <v-divider></v-divider>
      <v-divider></v-divider>
      <div class="sites-embed-border-on sites-embed sites-embed-full-width" style="width:100%;">
      <div class="sites-embed-object-title" style="display:none;">notasWeb.xlsx</div>
          <div class="sites-embed-content sites-embed-type-spreadsheet">
              <iframe 
                  src=<?php echo $dados[0]['email'] ?> width="100%" height="600"></iframe>
          </div>
      </div>
    </div>
    <?php else: ?>

    <?php endif; ?>