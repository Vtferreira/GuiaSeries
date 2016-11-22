<?php
/* 
 * Lista os episódios relacionados à uma série e temporada, em formato JSON.
 * Exemplo de uso: listar episódios de acordo com temporada selecionada, sem recarregar página
 */
require_once("../banco/conexao.php");
require_once("../banco/SerieDAO.php");
$temporada_id = filter_input(INPUT_GET,'temporada_id');
$serieDAO = new SerieDAO($conexao);
$episodios = $serieDAO->listaEpisodios($temporada_id);
$arquivo_json = $serieDAO->geraTemporadasJSON($episodios);
echo $arquivo_json;