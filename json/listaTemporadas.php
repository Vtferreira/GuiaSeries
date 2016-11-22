<?php
/* 
 * Lista temporadas e retorna em formato JSON, de acordo com o id da série enviada
 */
require_once("../banco/SerieDAO.php");
$serie_id = filter_input(INPUT_POST,'serie_id');
$serieDAO = new SerieDAO($conexao);
$temporadas = $serieDAO->listaTemporadas($serie_id);
$arquivo_json = $serieDAO->geraTemporadasJSON($temporadas);
echo $arquivo_json;