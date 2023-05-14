<?php
	class CategoriaDAO 
	{
		public function __construct( private $conexao){}
		
		public function buscar_todas_categorias()
		{
			$sql = "SELECT * FROM categoria";

			try {
				//prepara a frase sql antes de executar
				$stm = $this->conexao->prepare($sql);
				//executa a frase sql no BD
				$stm->execute();
				//fecha a conexao com o BD
				$this->conexao = null;
				//returna o resultado no formato de OBJETOS
			return $stm->fetchAll(PDO::FETCH_OBJ);

			} catch (PDOException $e){
				$this->conexao = null;
				return "Problema ao listar categorias!";
			}
			
		}
		
		public function buscar_uma_categoria($categoria)
		{
			$sql = "SELECT * FROM categoria WHERE idcategoria = ?";

			try {
				$stm = $this->conexao->prepare($sql);
				$stm->bindValue(1, $categoria->getIdcategoria());
				$stm->execute();
				$this->conexao = null;
				return $stm->fetchAll(PDO::FETCH_OBJ);

			} catch (PDOException $e) {
				$this->conexao = null;
				return "Problema ao listar a categoria!";
			}
			
		}
		
		public function inserir_categoria($categoria)
		{
			$sql = "INSERT INTO categoria(descritivo, status)VALUES(?,?)";

			try {
				$stm = $this->conexao->prepare($sql);
				//substituir os pontos de interrogação
				$stm->bindValue(1, $categoria->getDescritivo());
				$stm->bindValue(2, $categoria->getStatus());
				
				$stm->execute();
			
				$this->conexao = null;

			} catch (PDOException $e) {
				$this->conexao = null;
				return "Problema ao inserir a categoria!";
			}
			
			
			
		}
		
		public function alterar_categoria($categoria)
		{
			$sql = "UPDATE categoria SET descritivo = ? WHERE idcategoria = ?";

			try {
				$stm = $this->conexao->prepare($sql);
				$stm->bindValue(1, $categoria->getDescritivo());
				$stm->bindValue(2, $categoria->getIdcategoria());
				$stm->execute();
				$this->conexao = null;
				return "Categoria alterada com sucesso!";

			} catch (PDOException $e) {
				$this->conexao = null;
				return "Problema ao alterar a categoria!";
			}		
			
		}
		
		public function excluir_categoria($categoria)
		{
			$sql = "DELETE FROM categoria WHERE idcategoria = ?";

			try {
				$stm = $this->conexao->prepare($sql);
				$stm->bindValue(1, $categoria->getIdcategoria());
				$stm->execute();
				$this->conexao = null;
				return "Categoria excluida com sucesso!";

			} catch (PDOException $e) {
				$this->conexao = null;
				return "Problema ao excluir a categoria!";
			}
			
			
		}
		public function alterar_status($categoria)
		{
			$sql = "UPDATE categoria SET status = ? WHERE idcategoria = ?";
			$stm = $this->conexao->prepare($sql);
			$stm->bindValue(1, $categoria->getStatus());
			$stm->bindValue(2, $categoria->getIdcategoria());
			$stm->execute();
			$this->conexao = null;
		}
		//novo
		public function buscar_todas_categorias_ativas($categoria)
		{
			//novo
			$sql = "SELECT * FROM categoria WHERE status = ?";
			
			$stm = $this->conexao->prepare($sql);
			//novo
			$stm->bindValue(1, $categoria->getStatus());
			
			//executa a frase sql no BD
			$stm->execute();
			//fecha a conexao com o BD
			$this->conexao = null;
			//returna o resultado no formato de OBJETOS
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
	}//fim classe
?>