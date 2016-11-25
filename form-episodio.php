<?php
function dateToAmerican($dataBrasil){
	$dataF = explode("/",$dataBrasil);
    $dataF = $dataF[2]."-".$dataF[1]."-".$dataF[0];
    return $dataF;
}
$tituloAba = "GuiaSeries | Episódio";
require_once("classes/Usuario.php");
require_once("classes/Obra.php");
require_once("classes/Genero.php");
require_once("classes/Serie.php");
require_once("banco/conexao.php");
require_once("banco/SerieDAO.php");
$usuarioObj = new Usuario();
$usuarioObj->protegePagina();
$dataAtual = date("d/m/Y");
$serieDAO = new SerieDAO($conexao);
$lista_series = $serieDAO->listar();
/**/
$tituloAba = "GuiaSeries | Episódio";
require_once("include/head-bootstrap.php");
?>
<script type="text/javascript" src="js/datePickerBR.js"></script>
<script type="text/javascript" src="js/validacao.js"></script>
<script type="text/javascript" src="js/form-episodios.js"></script>
<?php require_once("include/body-bootstrap.php"); ?>
<div class="container">
	<?php 
	if(isset($_GET['adicionou']) && ($_GET['adicionou'] == '1000')){
		echo
		"<div class='alert alert-success'>
			Episódio adicionado com sucesso!
		</div>";
	}
	?>
	<h1>Adicionar Novo Episódio</h1>
	<p>Verifique, previamente, se o episódio desejado já não está cadastrado na base de dados.</p>
	<form id="formulario" action="php/adiciona-episodio.php" method="POST">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="serie">Selecione a série</label>
					<select name="serie" id="serie" class="form-control">
						<option>Selecione</option>
						<?php foreach($lista_series as $serie): ?>
							<option value="<?=$serie->getId()?>"><?=$serie->getNome()?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="temporada">Selecione a temporada</label>
					<select name="temporada" id="temporada" class="form-control">
						<option>Selecione</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label for="numero-episodio">Número do Episódio</label>
					<input type="number" name="numero-episodio" id="numero-episodio" class="form-control">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="nome-episodio">Título do Episódio</label>
					<input type="text" id="nome-episodio" name="nome-episodio" class="form-control">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="lancamento-episodio">Lançamento</label>
					<input type="text" id="lancamento" name="lancamento-episodio" class="form-control"
					value="<?php echo $dataAtual; ?>">
				</div>
			</div>
		</div>
		<button type="submit" name="salvar" class="btn btn-primary">Concluir</button>
		<button type="reset" class="btn btn-warning">Limpar</button>
	</form>
</div>
<?php require_once("include/rodape-bootstrap.php"); ?>