<?php
class homeController extends controller {

    public function __construct() {
        parent::__construct();
        $u = new Usuarios();
        //vai em usuarios model e se tiver logado continua
        $u->verificarLogin();
    }

    public function index() {
        $u = new Usuarios();
        $p = new Posts();
        $r = new Relacionamentos();
        $g = new Grupos();

        $dados = array(
        	'usuario_nome' => ''
        );
        //retorna o nome do usuario na sua area do facebook
        $dados['usuario_nome'] = $u->getNome($_SESSION['lgsocial']);
        //campo do que vc está pensanndo está preenchido
        if(isset($_POST['post']) && !empty($_POST['post'])) {
            $postmsg = addslashes($_POST['post']);
            //recebando os dados de foto
            $foto = array();
             
            if(isset($_FILES['foto']) && !empty($_FILES['foto']['tmp_name'])) {
                $foto = $_FILES['foto'];
            }
            //envio  da postagem
            $p->addPost($postmsg, $foto);
        }
          //grupo
        if(isset($_POST['grupo']) && !empty($_POST['grupo'])) {
            $grupo = addslashes($_POST['grupo']);
            //criar grupo do model
            $id_grupo = $g->criar($grupo);
            header("Location: ".BASE."grupos/abrir/".$id_grupo);
        }
          //pega 3 suguestoes de amizade. model usuarios
        $dados['sugestoes'] = $u->getSugestoes(3);
        //confirmar amizade
        $dados['requisicoes'] = $r->getRequisicoes();
        //conta o total de amigos
        $dados['totalamigos'] = $r->getTotalAmigos($_SESSION['lgsocial']);
       //feed de noticias que recebe as postagens da minha rede social
        $dados['feed'] = $p->getFeed();
        //grupos
        $dados['grupos'] = $g->getGrupos();
        
        $this->loadTemplate('home', $dados);
    }

}