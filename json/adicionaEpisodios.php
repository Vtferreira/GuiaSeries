<?php
/* 
 * Realiza a inserção de episódios nas séries e temporadas correspondentes
 */
require_once("../banco/SerieDAO.php");
$serieDAO = new SerieDAO($conexao);
$array['temporada_id'] = filter_input(INPUT_POST, 'temporada_id');
$array['numero_ep'] = filter_input(INPUT_POST, 'numero_ep');
$array['nome'] = filter_input(INPUT_POST, 'nome');
$array['lancamento'] = filter_input(INPUT_POST, 'lancamento');
$array['avaliacao'] = filter_input(INPUT_POST, 'avaliacao');
$resultado = $serieDAO->insereEpisodios($array);
echo $resultado;