<?php
/* 
 * Lista os nomes de séries cadastradas em formato JSON.
 * Exemplo de uso: autocomplete com nomes das séries
 */
require_once("../banco/conexao.php");
require_once("../banco/SerieDAO.php");
$serieDAO = new SerieDAO($conexao);
$serieDAO->listarJSON();
