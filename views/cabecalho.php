<?php
	if(!isset($_SESSION))
		session_start();
	
	
?>
<!doctype html>
<html lang="pt-BR">
	<head>
		<title>PetHouse</title>
		<!-- CSS only -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
	</head>
	<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" 		data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
			<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
		
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="index.php">Home</a>
					</li>
					<?php
						if(isset($_SESSION["perfil"]) && $_SESSION["perfil"] == "Administrador")
						{
							echo "<li class='nav-item'>
								<a class='nav-link' aria-current='page' href='index.php?controle=categoriaController&metodo=listar'>Categoria</a></li>
								
								<li class='nav-item'>
								<a class='nav-link' aria-current='page' href='index.php?controle=produtoController&metodo=listar'>Produto</a></li>";
						}
					?>
				</ul>
				<div class='collapse navbar-collapse justify-content-end'>
					
					<ul class='navbar-nav'>
							<li class='nav-item'>
							<a href='index.php?controle=vendaController&metodo=mostar_carrinho'class='nav-link'>Carrinho</a>
						</li>
						
						<?php	
							if(isset($_SESSION["idusuario"]))
							{
								echo "<li class='nav-item'>
								<a href='index.php?controle=usuarioController&metodo=logout' class='nav-link me-4 ms-2' >Sair</a>
								</li>";
							}
							else
							{
								echo "<li class='nav-item'><a href='index.php?controle=usuarioController&metodo=inserir'class='nav-link'>Cadastre-se</a>
								</li><li class='nav-item ms-2'>
								<a href='index.php?controle=usuarioController&metodo=login'class='nav-link'>Entrar</a></li>";
							}
						?>					
					</ul>
					<form class="d-flex" role="search">
						<input class="form-control me-2" type="search" placeholder="o que você deseja?" aria-label="Search">
						<button class="btn btn-success" type="submit">Buscar</button>
					</form>
				</div>        
  			</div>
		</div>
	</nav>
<?php 
require_once "views/rodape.html";
?>
