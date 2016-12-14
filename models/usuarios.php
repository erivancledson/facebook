<?php
class Usuarios extends model {

	public function verificarLogin() {
               //verifica se o usuario está logado
		if(!isset($_SESSION['lgsocial']) || (isset($_SESSION['lgsocial']) && empty($_SESSION['lgsocial']))) {
			header("Location: ".BASE."login");
			exit;
		}

	}
  //loga o usuario na rede social
	public function logar($email, $senha) {

		$sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
		$sql = $this->db->query($sql);
                //fex o login
		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();

			$_SESSION['lgsocial'] = $sql['id'];
                       //entra no sistema
			header("Location: ".BASE);
			exit;
		} else {
			return "E-mail e/ou senha errados!";
		}

	}
       //cadastrar usuario
	public function cadastrar($nome, $email, $senha, $sexo) {
               //verifica se o email já está cadastrado
		$sql = "SELECT * FROM usuarios WHERE email = '$email'";
		$sql = $this->db->query($sql);
                  //se não tem nenhum registro
		if($sql->rowCount() == 0) {
                         //inserindo usuario no banco
			$sql = "INSERT INTO usuarios SET nome = '$nome', email = '$email', senha = MD5('$senha'), sexo = '$sexo'";
			$sql = $this->db->query($sql);
                        //pega o id do usuario para o login
			$id = $this->db->lastInsertId();
			$_SESSION['lgsocial'] = $id;
                         //redireciona para a pagina inicial
			header("Location: ".BASE);

		} else {
			return "E-mail já está cadastrado!";
		}

	}
          //pegar o nome do usuario para 
        //mostrar em sua area de usuario
	public function getNome($id) {
		$sql = "SELECT nome FROM usuarios WHERE id = '$id'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();

			return $sql['nome'];
		} else {
			return '';
		}
	} //editar perfil
         //retorna todos os dados do usuario para editar
	public function getDados($id) {
		$array = array();

		$sql = "SELECT * FROM usuarios WHERE id = '$id'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	} 
       //aatualizar perfil do usuario
	public function updatePerfil($array = array()) {
             //se foi enviado algum arquivo
		if(count($array) > 0) {
                       
			$sql = "UPDATE usuarios SET ";

			$campos = array();
			foreach($array as $campo => $valor) {
				$campos[] = $campo." = '".$valor."'";
			}

			$sql .= implode(', ', $campos);

			$sql .= " WHERE id = '".($_SESSION['lgsocial'])."'";

			$this->db->query($sql);
			
		}

	}
        //sugestoes do usuario para amizade
	public function getSugestoes($limit = 5) {
		$array = array();
		$meuid = $_SESSION['lgsocial'];
                 //pegando o id dos meus amigos
		$r = new Relacionamentos();
		$ids = $r->getIdsFriends($meuid);

		if(count($ids) == 0) {
			$ids[] = $meuid;
		}
      //pega o id do usuario que é diferente do meu
                //e quando eu não for amigo dela
                //implode tira os amigos que já tem da lista de sugestões
		$sql = "
		SELECT 
			usuarios.id,
			usuarios.nome
		FROM
			usuarios 
		WHERE 
			usuarios.id != '$meuid' AND
			usuarios.id NOT IN (".implode(',', $ids).")
		ORDER BY RAND()
		LIMIT $limit
		";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}


		return $array;
	}
  //procurar do controller busca que encontra usuarios
	public function procurar($q) {
		$array = array();

		$q = addslashes($q);

		$sql = "SELECT * FROM usuarios WHERE nome LIKE '%$q%'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}










}