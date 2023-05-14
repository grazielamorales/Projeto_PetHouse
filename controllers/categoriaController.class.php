<?php
	require_once "models/Conexao.class.php";
	require_once "models/CategoriaDAO.class.php";
	require_once "models/Categoria.class.php";
	
	if(!isset($_SESSION)){
		session_start();

		class categoriaController
		{
			private $parm;
			public function __construct()
			{
				$this->parm = Conexao::getInstancia();
			}

			public function listar()
			{
				if(!isset($_SESSION["perfil"]) || $_SESSION["perfil"] != "Administrador")
				{
					header("location:index.php");
				}
				$categoriaDAO = new CategoriaDAO($this->parm);
				$retorno = $categoriaDAO->buscar_todas_categorias();
				if(is_array($retorno))
				{
					require_once "views/listar_categorias.php";
				}
				else
				{
					echo $retorno;
				}
			}
			public function inserir()
			{
				if($_POST)
				{
					if($_POST["descritivo"] == "")
					{
						echo "<script>alert('Preencha o descritivo da categoria')</script>";
					}
					else
					{
						$categoria = new Categoria(descritivo:$_POST["descritivo"], status:"Ativo");
						
						$categoriaDAO = new CategoriaDAO($this->parm);
						
						$categoriaDAO->inserir_categoria($categoria);
						
						header("location:index.php?controle=categoriaController&metodo=listar");
					}
				}
		
				require_once "views/form_categoria.php";
			}

			public function alterar()
			{
				$msg = "";				
				
				if(isset($_GET["id"]))
				{
					//buscar a categoria no BD
					$categoria = new Categoria($_GET["id"]);
					$categoriaDAO = new CategoriaDAO($this->parm);
					$ret = $categoriaDAO->buscar_uma_categoria($categoria);
					require_once "views/edit_categoria.php";					

					//alterar no BD a categoria
					if($_POST)
					{
						$categoria = new Categoria($_POST["idcategoria"], descritivo:$_POST["descritivo"]);
						$categoriaDAO = new CategoriaDAO($this->parm);
						$categoriaDAO->alterar_categoria($categoria);
						echo $retorno;						
					}
					header("Location:views/listar_categorias.php");
					
				}
					
								
				
			}
				
		}

	}	
		
?>