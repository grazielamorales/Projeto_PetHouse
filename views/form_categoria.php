<?php 
	require_once "cabecalho.php";
?>

<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Nova Categoria</title>
	</head>
	<body>
		<div class="container">			
			<div class="card mt-5">
				<h5 class="card-header">Categoria</h5>
				<div class="card-body">
					<form action="inserir_categoria.php" method="POST">
						<label>Descritivo:</label>
						<input  type="text" name="descritivo">
					
						<input class="btn btn-primary" type="submit" value="Cadastrar">
					</form>
				</div>
			</div>
			
		</div>
		
	</body>
</html>