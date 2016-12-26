<?php 
	require_once("classes/Usuario.php");
	require_once("classes/Obra.php");
	require_once("classes/Genero.php");
	require_once("classes/Serie.php");
	require_once("classes/Ajudantes.php");
	require_once("banco/conexao.php");
	require_once("banco/SerieDAO.php");
	$usuarioObj = new Usuario();
	$usuarioObj->protegePagina();
	$usuario_id = $_SESSION['idUsuario'];
	$serieDAO = new SerieDAO($conexao);
	$generos = $serieDAO->geraEstatisticaPorGenero($usuario_id);
	$episodios_genero = $serieDAO->consultaEpisodiosPorGenero($usuario_id);
	$i = 0;
	for($i = 0; $i < count($episodios_genero);$i++){
		$generos[$i]['total_episodios'] = $episodios_genero[$i]['total_episodios'];
	}
	/*Arrays referentes à outras estatísticas*/
	$maiorNota = $serieDAO->geraEstatistica($usuario_id,"s.avaliacao DESC");
	$menorNota = $serieDAO->geraEstatistica($usuario_id,"s.avaliacao ASC");
	$maisRecente = $serieDAO->geraEstatistica($usuario_id,"s.anoEstreia DESC");
	$maisAntiga = $serieDAO->geraEstatistica($usuario_id,"s.anoEstreia ASC");
	$maisTemporadas = $serieDAO->geraEstatistica($usuario_id,"s.totalTemporadas DESC");
	$menosTemporadas = $serieDAO->geraEstatistica($usuario_id,"s.totalTemporadas ASC");
	$tituloAba = "GuiaSeries | Estatisticas";
	require_once("include/head-bootstrap.php");
?>
	<style type="text/css">
		.table tr > td:first-child{
			width: 55%;
		}
	</style>
	<script type="text/javascript" src="js/validacao.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			criaDatePicker("dataInicio");
			criaDatePicker("dataFim");
		});
	</script>
	<!-- INÍCIO GOOGLE CHARTS !-->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<?php require_once("js/graficos/quantidade-coluna.php"); ?>
	<?php require_once("js/graficos/temporada-coluna.php"); ?>
	<?php require_once("js/graficos/episodio-coluna.php"); ?>
	<?php require_once("js/graficos/serie-quantidade-pizza.php"); ?>
	<?php require_once("js/graficos/temporada-pizza.php"); ?>
	<?php require_once("js/graficos/episodio-pizza.php"); ?>
	<!-- FIM GOOGLE CHARTS !-->
<?php require_once("include/body-bootstrap.php"); ?>
	<div class="container">
		<h1>Estatísticas - Séries Assistidas</h1>
		<div class="panel panel-primary">
			<div class="panel-heading">Filtros de pesquisa</div>
			<div class="panel-body">
				<form action="" method="GET">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="dataInicio">Data Inicial</label>
								<input type="text" name="dataInicio" id="dataInicio" class="form-control" maxlength="10">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="dataFim">Data Final</label>
								<input type="text" name="dataFim" id="dataFim" class="form-control" maxlength="10">
							</div>
						</div>
						<div class="col-md-4" style="margin-top:1.7em">
							<button type="submit" class="btn btn-primary">Gerar Gráficos</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<?php if(count($generos) > 0): ?>
		<div class="panel panel-primary">
			<div class="panel-heading">Séries por Gênero</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-10">
						<table class="table table-striped table-bordered">
							<tr>
								<th>Gênero</th>
								<th>Quantidade</th>
								<th>Temporadas</th>
								<th>Episódios</th>
							</tr>
							<?php foreach($generos as $genero): ?>
							<tr>
								<td><?=$genero['genero_nome']?></td>
								<td><?=$genero['total_genero']?></td>
								<td><?=$genero['temporada_genero']?></td>
								<td><?=$genero['total_episodios']?></td>
							</tr>
							<?php endforeach; ?>
						</table> 
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div id="grafico-barra-quantidade"></div>
					</div>
					<div class="col-md-4">
						<div id="grafico-pizza-quantidade"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div id="grafico-barra-temporada"></div>
					</div>
					<div class="col-md-4">
						<div id="grafico-pizza-temporada"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div id="grafico-barra-episodio"></div>
					</div>
					<div class="col-md-4">
						<div id="grafico-pizza-episodio"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">Outras Estatísticas</div>
			<div class="panel-body">
				<p>
					<div class="row">
						<div class="col-md-6">
							<strong>Série com a maior nota: </strong>
							<a href="consulta-serie.php?id=<?=$maiorNota[0]->getId()?>">
								<?=$maiorNota[0]->getNome()?>
							</a>, nota: <?=$maiorNota[0]->getAvaliacaoIMDB()?>
						</div>
						<div class="col-md-6">
							<strong>Série com a menor nota: </strong>
							<a href="consulta-serie.php?id=<?=$menorNota[0]->getId()?>">
								<?=$menorNota[0]->getNome()?>
							</a>, nota: <?=$menorNota[0]->getAvaliacaoIMDB()?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<strong>Série mais recente:</strong>
							<a href="consulta-serie.php?id=<?=$maisRecente[0]->getId()?>">
								<?=$maisRecente[0]->getNome()?>
							</a>, estreou em <?=$maisRecente[0]->getAnoEstreia()?>
						</div>
						<div class="col-md-6">
							<strong>Série mais antiga:</strong>
							<a href="consulta-serie.php?id=<?=$maisAntiga[0]->getId()?>">
								<?=$maisAntiga[0]->getNome()?>
							</a>, estreou em <?=$maisAntiga[0]->getAnoEstreia()?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<strong>Série com mais temporadas:</strong>
							<a href="consulta-serie.php?id=<?=$maisTemporadas[0]->getId()?>">
								<?=$maisTemporadas[0]->getNome()?>
							</a>, com <?=$maisTemporadas[0]->getTemporadas()?> temporadas
						</div>
						<div class="col-md-6">
							<strong>Série com menos temporadas:</strong>
							<a href="consulta-serie.php?id=<?=$menosTemporadas[0]->getId()?>">
								<?=$menosTemporadas[0]->getNome()?>
							</a>, com <?=$menosTemporadas[0]->getTemporadas()?> temporadas
						</div>
					</div>
				</p>
			</div>
		</div>
		<?php endif; ?>
	</div>
<?php require_once("include/rodape-bootstrap.php"); ?>
