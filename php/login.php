<?php
/* 
 * Página responsável por efetuar o login do usuário.
 */
require_once("../classes/Usuario.php");
require_once("../banco/conexao.php");
require_once("../banco/UsuarioDAO.php");
//session_start();
$login = filter_input(INPUT_POST, 'login');
$senha = filter_input(INPUT_POST, 'senha');
$objUsuario = new Usuario();
$objUsuario->setNome($login);
$objUsuario->setSenha($senha);
$usuarioDAO = new UsuarioDAO($conexao);
$usuarioLogado = $usuarioDAO->consultaLogin($objUsuario);
if($usuarioLogado == null){
    header("Location: ../form-login.php?falhaLogin=1");
}else{
    $objUsuario->logaUsuario($usuarioLogado);
    header("Location: ../index.php");
}
