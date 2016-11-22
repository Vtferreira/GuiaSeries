<?php
/* 
 * Lista todos os Usuários em formato JSON
 */
require_once '../banco/conexao.php';
require_once '../classes/Usuario.php';
require_once '../classes/Ajudantes.php';
require_once '../banco/UsuarioDAO.php';
$usuarioDAO = new UsuarioDAO($conexao);
echo $usuarioDAO->listarJSON();

