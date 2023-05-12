<?php
	require_once "cabecalho.php";	
	if(!isset($_SESSION["perfil"]) || $_SESSION["perfil"] != "Administrador")
	{
		header("location:index.php");
	}
?>
	<div class="content">
	<div class="container">
		<h1>Categorias</h1>
		<table class="table table-striped">
			<tr>
				<th>Descritivo</th>
				<th>Situação</th>
				<th>Ações</th>
			</tr>
			
				<?php
					$categoriaDAO = new CategoriaDAO();
					$retorno = $categoriaDAO->buscar_todas_categorias();
					if(is_array($retorno))
					{
						foreach($retorno as $dados)
						{
							echo "<tr>";
							echo "<td>{$dados->descritivo}</td>";
							echo "<td>{$dados->status}</td>";
							echo "<td>
							
							<a href='edit_categoria.php?id={$dados->idcategoria}'>Alterar</a>
							
							&nbsp;&nbsp;
							
							<a href='excluir.php?id={$dados->idcategoria}'>Excluir</a>
							
							&nbsp;&nbsp;";
							
							if($dados->status == "Ativo")
							{
								echo "<a href='alterar_status.php?id={$dados->idcategoria}&status=Inativo'>Inativar</a>";
							}
							else
							{
								echo "<a href='alterar_status.php?id={$dados->idcategoria}&status=Ativo'>Ativar</a>";
							}
							echo "</td></tr>";
						}
					}
				?>
		</table>
		<br><br><a href="form_categoria.html">Nova Categoria</a>
<?php
	require_once "rodape.html";
?>