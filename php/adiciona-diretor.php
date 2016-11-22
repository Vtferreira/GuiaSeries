<?php
/* 
 * Responsável por adicionar um diretor, via requisição AJAX, no form de filmes
 */
require_once("../classes/Diretor.php");
require_once("../banco/conexao.php");
require_once("../banco/DiretorDAO.php");
$diretor = filter_input(INPUT_POST,"diretor");
$diretorObj = new Diretor($diretor);
$diretorDAO = new DiretorDAO($conexao);
echo $diretorDAO->inserir($diretorObj);

