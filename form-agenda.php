<?php 
	/*Verifica se o registro foi inserido com sucesso*/
	function verificaInsercao(){
		if(isset($_GET['inseriu']) && $_GET['inseriu'] == 1){
			echo
			"<div class='alert alert-success'>
				Filme/Série inserido com sucesso na agenda geral!
			</div>";
		}else if(isset($_GET['inseriu']) && $_GET['inseriu'] == 0){
			echo
			"<div class='alert alert-danger'>
				Ocorreu algum erro durante a inserção. Contate o desenvolvedor.
			</div>";
		}
	}
	$tituloAba = "GuiaSeries | Agenda";
	require_once("classes/Usuario.php");
	require_once("classes/Genero.php");
	require_once("banco/conexao.php");
	require_once("banco/GeneroDAO.php");
	require_once("include/head-bootstrap.php");
	$usuarioObj = new Usuario();
	$generoDAO = new GeneroDAO($conexao);
	$generos = $generoDAO->listar();
?>
<script type="text/javascript" src="js/datePickerBR.js"></script>
<script type="text/javascript" src="js/validacao.js"></script>
<script type="text/javascript" src="js/form-agenda.js"></script>
<?php require_once("include/body-bootstrap.php"); ?>
<div class="container">
	<?php verificaInsercao(); ?>
	<h1>Adicionar Filme/Série na Agenda</h1>
	<p>
		O filme/série será adicionado na agenda geral do sistema. <br>Para adicionar em sua agenda particular, selecione o item <strong>Agenda > Agenda Geral</strong> e clique em <strong>Adicionar em minha agenda</strong> no filme/série correspondente
	</p>
	<form id="formulario" action="php/adiciona-agenda.php" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label for="arquivo">Imagem de Divulgação</label>
			<input type="file" name="arquivo" id="arquivo">
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="titulo">Título</label>
					<input type="text" name="titulo" id="titulo" class="form-control" autofocus>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="genero">Gênero</label>
					<select name="genero" id="genero" class="form-control">
						<option value="">Selecione</option>
						<?php foreach($generos as $genero): ?>
						<option value="<?=$genero->getId()?>"><?=$genero->getNome()?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="estreia">Estreia</label>
					<input type="text" name="estreia" id="estreia" class="form-control">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10">
				<label for="sinopse">Sinopse</label>
				<textarea name="sinopse" id="sinopse" class="form-control" rows="4"></textarea>
			</div>
		</div>
		<br>
		<button type="submit" class="btn btn-primary">Concluir</button>
    	<button type="reset" class="btn btn-warning">Resetar</button>
        <button type="button" id="btnCancelar" class="btn btn-danger">Cancelar</button>
	</form>
</div>
<?php require_once("include/rodape-bootstrap.php"); ?>