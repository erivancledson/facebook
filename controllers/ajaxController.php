<?php
class ajaxController extends controller {

    public function __construct() {
        parent::__construct();
        $u = new Usuarios();
        $u->verificarLogin();
    }

    public function index() {}
//adicionando amigo
    public function add_friend() {

        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = addslashes($_POST['id']);

            $r = new Relacionamentos();
            //model usuarios
            $r->addFriend($_SESSION['lgsocial'], $id);
        }

    }
  //confirmando a amizade
    public function aceitar_friend() {

        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = addslashes($_POST['id']);

            $r = new Relacionamentos();
            $r->aceitarFriend($_SESSION['lgsocial'], $id);
        }

    }
   //recebendo do script.js
    
    public function curtir() {

        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = addslashes($_POST['id']);
            $id_usuario = $_SESSION['lgsocial'];    

            $p = new Posts();
            if($p->isLiked($id, $id_usuario)) {
                //remove o like
                $p->removeLike($id, $id_usuario);
            } else {
                //adiciona o curtir
                $p->addLike($id, $id_usuario);
            }
        }

    }
   //adicionando comentario
    public function comentar() {
        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = addslashes($_POST['id']);
            $id_usuario = $_SESSION['lgsocial'];
            $txt = addslashes($_POST['txt']);
            $p = new Posts();

            if(!empty($txt)) {
                $p->addComentario($id, $id_usuario, $txt);
            }
        }
    }

}