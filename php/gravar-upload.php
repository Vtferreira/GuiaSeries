<?php 
	require_once("../banco/conexao.php");
	require_once("../banco/UsuarioDAO.php");
	$nome = $_POST["nome"];
	$imagem = $_FILES["imagem"];
	$usuarioDAO = new UsuarioDAO($conexao);
	$usuarioDAO->insereUpload($nome,$imagem);
?>
