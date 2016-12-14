<?php
class loginController extends controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();
        
        $this->loadView('login', $dados);
    }
   //fazendo o login na rede social
    public function entrar() {
    	$dados = array('erro'=>'');
 //verifica o email
    	if(isset($_POST['email']) && !empty($_POST['email'])) {
    		
                $email = addslashes($_POST['email']);
    		$senha = md5($_POST['senha']);
                //chama o model usuarios
    		$u = new Usuarios();
                //logando no sistema
    		$dados['erro'] = $u->logar($email, $senha);
    	}

    	$this->loadView('login_entrar', $dados);
    }
      //cadastrar usuario
    public function cadastrar() {
    	$dados = array();

    	if(isset($_POST['email']) && !empty($_POST['email'])) {
    		$nome = addslashes($_POST['nome']);
    		$email = addslashes($_POST['email']);
    		$senha = addslashes($_POST['senha']);
    		$sexo = addslashes($_POST['sexo']);

    		$u = new Usuarios();
    		$dados['erro'] = $u->cadastrar($nome, $email, $senha, $sexo);
    	}

    	$this->loadView('login_cadastrar', $dados);
    }
 //sair da rede social
    public function sair() {
    	unset($_SESSION['lgsocial']);
    	header("Location: ".BASE);
    }

}