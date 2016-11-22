<?php
require_once("../classes/Usuario.php");
/* 
 * Destrói a sessão criada anteriormente, deslogando o usuário.
 */
$usuarioObj = new Usuario();
$usuarioObj->logout();
header("Location: ../form-login.php?deslogou=1");
