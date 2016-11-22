<?php
/* 
 * Responsável por excluir um usuário. Apenas o administrador e o próprio usuário 
   devem realizar essa exclusão.
 * Recebe um ID via POST
 */
require_once("../banco/conexao.php");
require_once("../banco/UsuarioDAO.php");
$id = filter_input(INPUT_POST, "id");
$nome = filter_input(INPUT_POST, "nome");
$usuarioDAO = new UsuarioDAO($conexao);
$excluiu = $usuarioDAO->deletar($id);
if($excluiu):
    header("Location: ../form-login.php?excluiu=1&nome={$nome}");
else:
   $msg = mysqli_error($conexao);
    echo $msg;
endif;

