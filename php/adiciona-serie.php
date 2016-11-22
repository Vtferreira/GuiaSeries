<?php
/* 
 * Página responsável por adicionar uma série ao banco de dados
 */
header('Content-Type: text/html; charset=UTF-8');
require_once("../classes/Obra.php");
require_once("../classes/Genero.php");
require_once("../classes/Serie.php");
require_once("../banco/SerieDAO.php");
function depuraVariavel($vetor){
    echo "<pre>";
        var_dump($vetor);
    echo "</pre>";
}
/*Leitura de campos via POST*/
$serie = filter_input(INPUT_POST, 'filme');
$genero = filter_input(INPUT_POST, 'genero');
$ano = filter_input(INPUT_POST, 'ano');
$temporadas = filter_input(INPUT_POST,'total-temporadas');
$temporadas = substr($temporadas, 0,2);
$classificacao = filter_input(INPUT_POST,'classificacao');
$duracao = filter_input(INPUT_POST, 'duracao');
$duracao = substr($duracao, 0,2);
$avaliacao = filter_input(INPUT_POST, 'avaliacao');
$sinopse = filter_input(INPUT_POST,'sinopse');
$premios = filter_input(INPUT_POST,'premios');
/*Popula campos do objeto*/
$serieObj = new Serie($serie, $ano, $temporadas, $classificacao);
$serieObj->transformaClassificacao();
$serieObj->getGenero()->setId($genero);
$serieObj->setDuracao($duracao);
$serieObj->setAvaliacaoIMDB($avaliacao);
$serieObj->setSinopse($sinopse);
$serieObj->setPremios($premios);
//campos de relacionamento
//$serieObj->getTemporadasObj()->setNome($serie."_"."Temporada 1");
/*Chamada de método para inserção*/
$serieDAO = new SerieDAO($conexao);
$resultado = $serieDAO->inserir($serieObj);
if(!$resultado){
    mysqli_error($conexao);
    die();
}
$serie_id = mysqli_insert_id($conexao);
$serie_nome = $serieObj->getNome();
$total_temporadas = $serieObj->getTemporadas();
$serieDAO->insereTemporada($serie_id,$serie_nome,$total_temporadas);
/**/
?>
<!DOCTYPE html>
<html>
<head>
	<title>GuiaSeries | Série Adicionada</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<style type="text/css">
		.jumbotron{
			padding: 5px;
			margin-bottom: 10px;
		}
		.jumbotron h1{
			font-size: 40px;
		}
		img{
			width: 320px;
		}
	</style>
	<script src="https://use.fontawesome.com/b17cc3a995.js"></script>
	<script type="text/javascript" src="../js/jquery-1.12.1.min.js"></script>
	<script type="text/javascript">
		window.onload = function(){
			document.getElementById("paginaInicial").onclick = function(){
				window.location.href = "../index.php";
			}
			document.getElementById("voltar").onclick = function(){
				window.location.href = "../form-serie.php";
			}
		}
	</script>
	<!-- Script que adiciona episódios ao banco de dados !-->
	<script type="text/javascript">
		function adicionaEpisodios(array,temporada_id){
			$.each(array,function(index,value){
				$.ajax({
					url:"../json/adicionaEpisodios.php",
					method: "POST",
					data: {"temporada_id":temporada_id, "numero_ep":value.Episode, "nome":value.Title, 
						"lancamento": value.Released, "avaliacao": value.imdbRating},
					success: function(data){
						console.log("Episódios inseridos com sucesso");
					},error:function(){
						console.log("Erro ao adicionar episódio");
					}
				});
			});
		}
		function listaEpisodios(serie,temporada,temporada_id){
			var temporada = temporada.charAt(temporada.length - 1);
			console.log("TEMPORADA " + temporada);
			$.ajax({
				url: "http://www.omdbapi.com/?",
				data: {"t":serie, "plot":"short", "r":"json", "season": temporada},
				success: function(data){
					adicionaEpisodios(data["Episodes"],temporada_id);
				},error:function(){
					console.log("Erro ao buscar episódios");
				}
			});
		}
		function listaTemporadas(array){
			var serie = $(".jumbotron p > strong").text();
			array = JSON.parse(array);
			$.each(array,function(index,value){
				// console.log(value['temporada_id'] + "--" + value['nome']);
				listaEpisodios(serie,value['nome'],value['temporada_id']);
			});
			/*
			$.each(array,function(indice,valor){
				console.log(valor);
			});*/
		}
		function requisitaTemporadas(serie_id){
			console.log(serie_id);
			$.ajax({
				url: "../json/listaTemporadas.php",
				method: "POST",
				data: {"serie_id": serie_id},
				success: function(data){
					listaTemporadas(data);
				},
				error: function(){
					console.log("Ocorreu alguma falha na listagem de temporadas");
				}
			});
		}
		$(document).ready(function(){
			var serie_id = $("#serie_id").val();
			requisitaTemporadas(serie_id);
		});
	</script>
</head>
<body>
	<div class="container">
		<input type="hidden" id="serie_id" value="<?php echo $serie_id; ?>">
		<div class="jumbotron">
			<h1>Série Adicionada com Sucesso!</h1>
			<p>
				<strong><?php echo $serieObj->getNome(); ?></strong> adicionada à base de dados! <br>
				Agora você pode adicionar esta série a sua lista!
			</p>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading">Pôster de Divulgação</div>
					<div class="panel-body">
						<?php $arquivo = substr($serieObj->getNome(), 0,12).$ano.".jpg"; ?>
						<img src="../imagens-serie/<?=$arquivo?>">
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">Informações Gerais</div>
					<div class="panel-body">
						<p>
							<strong>Título:</strong>
							<?php echo $serie; ?>(<?php echo $ano; ?>)<br>
							<strong>Total de Temporadas: </strong>
							<?php echo $temporadas; ?> temporadas<br>
							<strong>Classificação Indicativa: </strong>
							<?php echo $classificacao; ?><br>
							<strong>Duração(em minutos): </strong>
							<?php echo $duracao; ?> minutos<br>
							<strong>Sinopse: </strong>
							<?php echo $sinopse; ?>
						</p>
					</div>
				</div>
				<button type="button" id="paginaInicial" class="btn btn-primary">
					<i class="fa fa-home fa-lg" aria-hidden="true"> Página Inicial</i>
				</button>
				<button type="button" id="voltar" class="btn btn-success">
					<i class="fa fa-plus-circle fa-lg" aria-hidden="true"> Adicionar Série</i>
				</button>
			</div>
		</div>
	</div>
</body>
</html>