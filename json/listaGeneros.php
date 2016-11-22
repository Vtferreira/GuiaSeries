<?php
/* 
 * Lista todos os Gêneros cadastrados em formato JSON
 */
require_once '../banco/conexao.php';
require_once '../classes/Genero.php';
require_once '../banco/GeneroDAO.php';
$generoDAO = new GeneroDAO($conexao);
echo $generoDAO->listarJSON();

