<?php
	require_once("../banco/conexao.php");
	require_once("../banco/SerieDAO.php");
	$serie_nome = filter_input(INPUT_POST, 'filme');
	$serieDAO = new SerieDAO($conexao);
	$serie = $serieDAO->consultaPorNome($serie_nome);
	$serie_json = $serieDAO->geraTemporadasJSON($serie);
	echo $serie_json;
?>