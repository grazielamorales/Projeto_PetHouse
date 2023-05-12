<?php 
require_once "views/cabecalho.php";
?>

<!doctype html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Categoria</title>
	</head>
	<body>
	<div class="container">
		<div class="card mt-5 mb-5">
			<div class="card-header">
				<h1>Categoria - alterar</h1>
			</div>
			<div class="card-body">
				<form action="alterar_categoria.php" method="POST">
			
				<input class="form-control"  type="hidden" name="idcategoria" value="<?php echo $ret[0]->idcategoria;?>">
				
				<label class="form-label">Descritivo:</label>
				<input type="text" name="descritivo" value="<?php echo $ret[0]->descritivo;?>">
				<br><br>
				<input type="submit" value="Alterar" class="btn btn-primary">
			</form>
			</div>
		
		</div>
	</div>		
		
	</body>
</html>