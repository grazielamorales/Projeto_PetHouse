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
											
						foreach($ret as $dados)
						{
							echo "<tr>";
							echo "<td>{$dados->descritivo}</td>";
							echo "<td>{$dados->status}</td>";
							echo "<td>
							
							<a class='btn btn-warning' href='index.php?controle=categoriaController&metodo=alterar&id={$dados->idcategoria}'>Alterar</a>
							
							&nbsp;&nbsp;
							
							<a class='btn btn-danger' href=index.php?controle=categoriaController&metodo=excluir&id={$dados->idcategoria}'>Excluir</a>
							
							&nbsp;&nbsp;";
							
							if($dados->status == "Ativo")
							{
								echo "<a class='btn btn-secondary' href='index.php?controle=categoriaController&metodo=inativar&id={$dados->idcategoria}&status=Inativo'>Inativar</a>";
							}
							else
							{
								echo "<a class='btn btn-success' href='index.php?controle=categoriaController&metodo=ativar&id={$dados->idcategoria}&status=Ativo'>Ativar</a>";
							}
							echo "</td></tr>";
						}
						
					?>
			</table>
			<br><br><a class='btn btn-primary' href="index.php?controle=categoriaController&metodo=inserir">Nova Categoria</a>

<?php 
	require_once "rodape.html";
?>
