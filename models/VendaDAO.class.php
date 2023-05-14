<?php
	class vendaDAO extends Conexao
	{
		public function __construct(private $conexao){}	
		
		public function inserir_venda($venda)
		{
			$this->conexao->beginTransaction();
			$sql = "INSERT INTO venda (data_venda, idusuario) VALUES(?,?)";
			try
			{
				$stm = $this->conexao->prepare($sql);
				$stm->bindValue(1, $venda->getData_venda());
				$stm->bindValue(2, $venda->getUsuario()->getIdusuario());
				$stm->execute();
				$idvenda = $this->conexao->lastInsertId();
			}
			catch(PDOException $e)
			{
				return "Problema com a venda";
			}
			
			$sql = "INSERT INTO itens (quantidade, precoUnitario, idproduto,idvenda) VALUES(?,?,?,?)";
			
			foreach($venda->getItens() as $dado)
			{
				try
				{
					$stm = $this->conexao->prepare($sql);
					$stm->bindValue(1, $dado->getQuantidade());
					$stm->bindValue(2, $dado->getPrecoUnitario());
					$stm->bindValue(3, $dado->getProduto()->getIdproduto());
					$stm->bindValue(4, $idvenda);
					$stm->execute();
					
				}
				catch(PDOException $e)
				{
					$this->conexao->rollback();
					$this->conexao = null;
					return "Erro ao inserir itens da venda";
				}
			}//fim do foreach
			$this->conexao->commit();
			$this->conexao = null;
			return "Venda com sucesso";
			
		}
	}
?>