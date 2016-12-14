<?php
class perfilController extends controller {
//perfil do usuario
    public function __construct() {
        parent::__construct();
        $u = new Usuarios();
        $u->verificarLogin();
    }
 //editar perfil
    public function index() {
        $dados = array(
        	'usuario_nome' => ''
        );
        $u = new Usuarios();
       //alterar dados do perfil do usuario
        if(isset($_POST['nome']) && !empty($_POST['nome'])) {

            $nome = addslashes($_POST['nome']);
            $bio = addslashes($_POST['bio']);
            //informações que vão ser alteradas
            $u->updatePerfil(array(
                'nome' => $nome,
                'bio' => $bio
            ));
            //verificar a senha e atualiza-lá
            if(isset($_POST['senha']) && !empty($_POST['senha'])) {
                $senha = md5($_POST['senha']);
                 
                $u->updatePerfil(array(
                    'senha' => $senha
                ));
            }

        }

        $dados['usuario_nome'] = $u->getNome($_SESSION['lgsocial']);
        
        //editar perfil
         //pegar as informações do model getDados
        $dados['info'] = $u->getDados($_SESSION['lgsocial']);
        //envio para a view perfil
         //editar perfil
        $this->loadTemplate('perfil', $dados);
    }

}