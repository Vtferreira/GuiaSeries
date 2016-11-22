<?php
/* 
 * Responsável pelo processamento vindo da adição de um filme. Essa requisição será realizada via AJAX
 */

require_once("../classes/Estudio.php");
require_once("../banco/conexao.php");
require_once("../banco/EstudioDAO.php");
$estudio = filter_input(INPUT_POST, 'estudio');
$estudioObj = new Estudio($estudio);
$estudioDAO = new EstudioDAO($conexao);
$resultado = $estudioDAO->inserir($estudioObj);
echo $resultado;