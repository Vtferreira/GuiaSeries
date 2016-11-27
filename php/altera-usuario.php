<?php
/* 
 * Página responsável por alterar (UPDATE) dados de um usuário no banco de dados.
 */
require_once("../classes/Usuario.php");
require_once("../banco/conexao.php");
require_once("../banco/UsuarioDAO.php");
$id = filter_input(INPUT_POST, 'id');
$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email');
$sexo = filter_input(INPUT_POST, 'sexo');
$dataNasc = filter_input(INPUT_POST, 'dataNasc');
$senha = filter_input(INPUT_POST, 'senha');
$usuarioObj = new Usuario($nome, $email, $sexo, $dataNasc, $senha);
$usuarioObj->setId($id);
$usuarioDAO = new UsuarioDAO($conexao);
$resultado = $usuarioDAO->alterar($usuarioObj);
if($resultado){
    header("Location: ../form-usuario.php?alterou=1&alteracao=1");
}else{
    header("Location: ../form-usuario.php?alterou=0");
}

