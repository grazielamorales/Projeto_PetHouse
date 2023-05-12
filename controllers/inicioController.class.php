<?php

require_once "models/Conexao.class.php";
require_once "models/ProdutoDAO.class.php";
require_once "models/Produto.class.php";
require_once "models/Categoria.class.php";
require_once "models/CategoriaDAO.class.php";

    class inicioController
    {
        private $parm;
		public function __construct()
		{
			$this->parm = Conexao::getInstancia();
		}
        public function inicio()
        {
            $produto = new Produto(status:"Ativo");
            $produtoDAO = new ProdutoDAO($this->parm);
            $retorno = $produtoDAO->buscar_todos_produtos_ativos($produto);
            
            require_once "views/menu.php";

        }

    }
?>