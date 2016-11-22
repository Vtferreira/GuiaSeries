<?php
require_once("../banco/conexao.php");
require_once("../banco/SerieDAO.php");
$serie_id = filter_input(INPUT_POST, 'serie_id');
$serie_nome = filter_input(INPUT_POST, 'serie_nome');
$temporada = filter_input(INPUT_POST, 'temporada');
$serieDAO = new SerieDAO($conexao);
$inseriu = $serieDAO->insereTemporadaUnica($serie_id,$serie_nome,$temporada);
echo mysqli_insert_id($conexao);