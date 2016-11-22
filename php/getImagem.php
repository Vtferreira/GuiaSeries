<?php
	require_once("../banco/conexao.php");
	require_once("../banco/UsuarioDAO.php");
	$PicNum = $_GET["PicNum"];
	// $usuarioDAO = new UsuarioDAO($conexao);
	// $usuarioDAO->consultaUpload($PicNum);
	$result=mysql_query("SELECT * FROM usuario_teste WHERE id=$PicNum") or die("Impossível executar a query "); 
	$row=mysql_fetch_object($result); 
	Header( "Content-type: image/jpg"); 
	echo $row->PES_IMG; 
	/*<?php
	$host = "localhost";
	$username = "root";
	$password = "";
	$db = "test";
	$PicNum = $_GET["PicNum"];

	mysql_connect($host,$username,$password) or die("Impossível conectar ao banco."); 
	@mysql_select_db($db) or die("Impossível conectar ao banco."); 
	$result=mysql_query("SELECT * FROM PESSOA WHERE PES_ID=$PicNum") or die("Impossível executar a query "); 
	$row=mysql_fetch_object($result); 
	Header( "Content-type: image/gif"); 
	echo $row->PES_IMG; 
?>*/
?>