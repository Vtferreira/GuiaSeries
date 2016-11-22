<?php
/* 
 * Arquivo responsável pela conexão ao banco de dados
 */
$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'guiaseriesfilmes';
$conexao = mysqli_connect($servidor,$usuario,$senha,$banco);
mysqli_set_charset($conexao,"utf8");
