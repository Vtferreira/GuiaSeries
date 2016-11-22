<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Upload de Imagens com PHP</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
	<div class="container">
		<h1>Upload de Imagens</h1>
		<form action="php/gravar-upload.php" enctype="multipart/form-data" method="POST">
			<div class="form-group">
				<label for="nome">Nome do Usuário:</label>
				<input type="text" name="nome" class="form-control">
			</div>
			<div class="form-group">
				<label for="imagem">Foto de Perfil</label>
				<input type="file" name="imagem">
			</div>
			<button type="submit" class="btn btn-info">Enviar</button>
		</form>
	</div>
</body>
</html>