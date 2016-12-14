<?php
class buscaController extends controller {

    public function __construct() {
        parent::__construct();
        $u = new Usuarios();
        $u->verificarLogin();
 	}
       //buscando usuario
 	public function index() {
 		$u = new Usuarios();

        $dados = array(
        	'usuario_nome' => ''
        );
        $dados['usuario_nome'] = $u->getNome($_SESSION['lgsocial']);
          //resultado da busca de usuarios model do metodo busca
        $dados['resultado'] = $u->procurar($_GET['q']);

        $this->loadTemplate('busca', $dados);
    }
}