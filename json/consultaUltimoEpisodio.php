<?php
	require_once("../banco/conexao.php");
	require_once("../banco/SerieDAO.php");
	$temporada_id = filter_input(INPUT_POST,'temporada_id');
	$serieDAO = new SerieDAO($conexao);
	$ultimoEpisodio = $serieDAO->consultaUltimoEpisodio($temporada_id);
	$arquivo_json = $serieDAO->geraTemporadasJSON($ultimoEpisodio);
	echo $arquivo_json;
?>