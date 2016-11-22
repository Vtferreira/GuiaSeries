<?php
function dateToAmerican($dataBrasil){
	$dataF = explode("/",$dataBrasil);
    $dataF = $dataF[2]."-".$dataF[1]."-".$dataF[0];
    return $dataF;
}
require_once("../classes/Usuario.php");
require_once("../classes/Obra.php");
require_once("../classes/Genero.php");
require_once("../classes/Serie.php");
require_once("../banco/conexao.php");
require_once("../banco/SerieDAO.php");
$usuarioObj = new Usuario();
$usuarioObj->protegePagina();
$dataAtual = date("d/m/Y");
$serieDAO = new SerieDAO($conexao);
$lista_series = $serieDAO->listar();
$episodio = array();
$lancamentoBR = filter_input(INPUT_POST, 'lancamento-episodio');
$episodio['nome'] = filter_input(INPUT_POST, 'nome-episodio');
$episodio['temporada_id'] = filter_input(INPUT_POST, 'temporada');
$episodio['numero_ep'] = filter_input(INPUT_POST, 'numero-episodio');
$episodio['lancamento'] = dateToAmerican($lancamentoBR);
$episodio['avaliacao'] = 8.2;
$resultadoInsercao = $serieDAO->insereEpisodios($episodio);
if($resultadoInsercao){
	header("Location: ../form-episodio.php?criterio=s.nome&adicionou=1000");
}
?>