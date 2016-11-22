<?php
/* 
 * Responsável pelo processamento vindo de form-genero.php, adicionando um gênero ao banco de dados
 */
require_once("../classes/Usuario.php");
require_once("../classes/Genero.php");
require_once("../banco/conexao.php");
require_once("../banco/GeneroDAO.php");
$usuarioObj = new Usuario();
$usuarioObj->protegePagina();
$genero = filter_input(INPUT_POST, 'genero');
$generoObj = new Genero($genero);
$generoDAO = new GeneroDAO($conexao);
$resultado = $generoDAO->inserir($generoObj);
if($resultado){
    header("Location: ../form-genero.php?inseriu=1");
}else{
    $msgErro = mysqli_error($conexao);
    header("Location: ../form-genero.php?inseriu=0&erro={$msgErro}");
}