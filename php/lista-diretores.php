<?php
/* 
 * Lista os diretores cadastrados em formato JSON, permitindo requisições AJAX
 */
require_once("../classes/Diretor.php");
require_once("../banco/conexao.php");
require_once("../banco/DiretorDAO.php");
$diretorDAO = new DiretorDAO($conexao);
$arquivoJSON = $diretorDAO->listarJSON();
echo $arquivoJSON;
