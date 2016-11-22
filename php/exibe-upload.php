<?php
require_once("../banco/conexao.php");
require_once("../banco/UsuarioDAO.php");
$query = "SELECT * FROM usuario_teste";
$result= mysqli_query($conexao,$query);
while($row=mysqli_fetch_object($result)) {
    echo "<img src='getImagem.php?PicNum=$row->id' \">"; 
    echo $row->nome;
    echo "<br>";
} 
?>