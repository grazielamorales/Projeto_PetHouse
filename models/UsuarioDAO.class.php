<?php
	class UsuarioDAO {
		public function __construct( private $conexao){}
		
		public function autenticar($usuario)
		{
			$sql = "SELECT idusuario, nome, perfil FROM usuario WHERE email = ? AND senha = ?";
			$stm = $this->conexao->prepare($sql);
			$stm->bindValue(1, $usuario->getEmail());
			$stm->bindValue(2, $usuario->getSenha());
			$stm->execute();
			$this->conexao = null;
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		public function inserir($usuario)
		{
			$sql = "INSERT INTO usuario (nome, email, senha, perfil) VALUES(?,?,?,?)";
			try {
				$stm = $this->conexao->prepare($sql);
				$stm->bindValue(1, $usuario->getNome());
				$stm->bindValue(2, $usuario->getEmail());
				$stm->bindValue(3, $usuario->getSenha());
				$stm->bindValue(4, $usuario->getPerfil());
				$stm->execute();
				$this->conexao = null;

			} catch (PDOException $e) {
				$this->conexao = null;
				return "Problema ao cadastrar usuário";
			}
			
		}
		public function verificar_por_email($usuario)
		{
			$sql = "SELECT email FROM usuario WHERE	email=?";
			try {
				$stm = $this->conexao->prepare($sql);
				$stm->bindValue(1, $usuario->getEmail());
				$stm->execute();
				$this->conexao = null;
				return $stm->fetchAll(PDO::FETCH_OBJ);
			} catch (PDOException $e) {
				$this->conexao = null;
				return "Problema ao verificar usuário por email!";

			}
		}
	}//fim da classe
?>