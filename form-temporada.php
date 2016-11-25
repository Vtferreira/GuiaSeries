<?php
$tituloAba = "GuiaSeries | Temporada";
require_once("classes/Usuario.php");
require_once("banco/conexao.php");
require_once("banco/SerieDAO.php");
$usuarioObj = new Usuario();
$usuarioObj->protegePagina();
$serie_nome = filter_input(INPUT_POST, 'filme');
$temporada = filter_input(INPUT_POST, 'temporada');
/**/
$tituloAba = "GuiaSeries | Temporada";
require_once("include/head-bootstrap.php");
?>
<script type="text/javascript" src="js/validacao.js"></script>
<script type="text/javascript" src="js/form-temporada.js"></script>
<?php require_once("include/body-bootstrap.php"); ?>
<div class="container">
	<div class="alert alert-success" style="display:none">
		Temporada, com respectivos episódios, adicionada com sucesso!
	</div>
	<h1>Adicionar Nova Temporada</h1>
	<p>Ao adicionar uma nova temporada, os episódios correspondentes também são adicionados</p>
	<form action="json/buscaSerie.php" method="POST">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="filme">Série</label>
					<input type="text" name="filme" id="filme" class="form-control" autofocus>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="temporada">Número da Temporada</label>
					<input type="number" name="temporada" id="temporada" class="form-control">
				</div>
			</div>
		</div>
		<button type="button" class="btn btn-primary" id="adicionar">Concluir</button>
		<button type="reset" class="btn btn-warning">Limpar</button>
	</form>
</div>
<?php require_once("include/rodape-bootstrap.php"); ?>