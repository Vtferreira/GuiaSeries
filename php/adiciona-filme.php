<?php
/* 
 * Página responsável por adicionar um filme no banco de dados
 */
header('Content-Type: text/html; charset=UTF-8');
require_once("../classes/Usuario.php");
require_once("../classes/Genero.php");
require_once("../classes/Estudio.php");
require_once("../classes/Diretor.php");
require_once("../classes/Obra.php");
require_once("../classes/Filme.php");
require_once("../banco/conexao.php");
require_once("../banco/DiretorDAO.php");
require_once("../banco/EstudioDAO.php");
require_once("../banco/FilmeDAO.php");
$usuario = new Usuario();
$usuario->protegePagina();
/*variáveis capturas via POST*/
$imagem = filter_input(INPUT_POST,'imagem');
$filme = filter_input(INPUT_POST,'filme');
$classificacao = filter_input(INPUT_POST,'classificacao');
$duracao = filter_input(INPUT_POST,'duracao');
$sinopse = filter_input(INPUT_POST,'sinopse');
$avaliacaoIMBD = filter_input(INPUT_POST,'avaliacao');
$premios = filter_input(INPUT_POST,'premios');
$dataEstreia = filter_input(INPUT_POST,'dataEstreia');
$diretor_id = filter_input(INPUT_POST,'diretor');
$estudio_id = filter_input(INPUT_POST,'estudio');
$genero_id = filter_input(INPUT_POST,'genero');
/*preenchendo a instância, com métodos de transformação inclusos*/
$filmeObj = new Filme($filme, $sinopse, $avaliacaoIMBD, $premios, $imagem);
$filmeObj->setDataEstreia($dataEstreia);
$filmeObj->transformaEstreia();
$filmeObj->setClassificacao($classificacao);
$filmeObj->transformaClassificacao();
$filmeObj->setDuracao($duracao);
$filmeObj->transformaDuracao();
/*preenchendo a instância, com métodos de relacionamento*/
if(!is_numeric($estudio_id)){
    $estudioDAO = new EstudioDAO($conexao);
    $estudioObj = $estudioDAO->consultar($estudio_id);
    $estudio_id = $estudioObj->getId();
}
$filmeObj->getEstudio()->setId($estudio_id);
$filmeObj->getDiretor()->setNome($diretor_id);
$filmeObj->getGenero()->setId($genero_id);
$diretorDAO = new DiretorDAO($conexao);
$filmeDAO = new FilmeDAO($conexao);
$nomeDiretor = $filmeObj->getDiretor()->getNome();
$diretorObj = $diretorDAO->consultar($nomeDiretor);
$idDiretor = $diretorObj->getId();
$filmeObj->getDiretor()->setId($idDiretor);
$filmeDAO = new FilmeDAO($conexao);
$resultadoIns = $filmeDAO->inserir($filmeObj);
if(!$resultadoIns){
	$erro = mysqli_error($conexao);
	//$erro = substr($erro, 0,15);
	if($erro == "Duplicate entry"){
		$erro = "Filme já existente na base de dados";
	}
    header("Location: ../form-filme.php?adicionou=0&erro={$erro}");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>GuiaSeries | Filme Adicionado</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<script src="https://use.fontawesome.com/b17cc3a995.js"></script>
	<style type="text/css">
		.jumbotron{
			padding: 5px;
			margin-bottom: 10px;
		}
		.jumbotron h1{
			font-size: 40px;
		}
	</style>
	<script type="text/javascript">
		window.onload = function(){
			document.getElementById("paginaInicial").onclick = function(){
				window.location.href = "../index.php";
			}
			document.getElementById("voltar").onclick = function(){
				window.location.href = "../form-filme.php";
			}
		}
	</script>
</head>
<body>
	<div class="container">
		<div class="jumbotron">
			<h1>Filme Adicionado com Sucesso!</h1>
			<p>
				<strong><?php echo $filmeObj->getNome(); ?></strong> adicionado à base de dados! <br>
				Agora você pode adicionar este filme a sua lista!
			</p>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<div class="panel panel-primary">
					<div class="panel-heading">Pôster de divulgação</div>
					<div class="panel-body">
						<img src="<?php echo $filmeObj->getEnderecoImagem(); ?>">
					</div>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="panel panel-primary">
					<div class="panel-heading">Informações Gerais</div>
					<div class="panel-body">
						<p>
							<strong>Nome:</strong> 
							<?php echo $filmeObj->getNome(); ?><br>
							<strong>Classificação Indicativa:</strong> 
							<?php echo $filmeObj->mostraClassificacao(); ?><br>
							<strong>Duração:</strong>
							<?php echo $filmeObj->getDuracao(); ?> minutos<br>
							<strong>Estreia:</strong> 
							<?php echo $filmeObj->mostraEstreiaBrasil(); ?><br>
							<strong>Avaliação IMDB:</strong> 
							<?php echo $filmeObj->getAvaliacaoIMDB(); ?><br>
							<strong>Sinopse:</strong> 
							<?php echo $filmeObj->getSinopse(); ?><br>
						</p>
					</div>
				</div>
				<button type="button" id="paginaInicial" class="btn btn-primary">
					<i class="fa fa-home fa-lg" aria-hidden="true"> Página Inicial</i>
				</button>
				<button type="button" id="voltar" class="btn btn-success">
					<i class="fa fa-plus-circle fa-lg" aria-hidden="true"> Adicionar Filme</i>
				</button>
			</div>
		</div>
	</div>
</body>
</html>