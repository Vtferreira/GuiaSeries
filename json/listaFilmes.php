<?php
/* 
 * Retorna uma lista de filmes em formato JSON
 */
require_once("../classes/Genero.php");
require_once("../classes/Diretor.php");
require_once("../classes/Estudio.php");
require_once("../classes/Obra.php");
require_once("../classes/Filme.php");
require_once("../banco/conexao.php");
require_once("../banco/FilmeDAO.php");
$filmeDAO = new FilmeDAO($conexao);
echo $filmeDAO->listarJSON();
