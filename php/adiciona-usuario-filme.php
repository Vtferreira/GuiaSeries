<?php
/* 
 * Página responsável por adicionar um filme X à lista de um usuário Y.
 * Tabela responsável por isso é UsuarioFilme, no qual constitui uma relação muitos-pra-muitos
 */
require_once("../classes/Usuario.php");
require_once("../classes/Obra.php");
require_once("../classes/Filme.php");
require_once("../banco/conexao.php");
require_once("../banco/UsuarioDAO.php");
require_once("../banco/FilmeDAO.php");
$vetorIns = array();
$vetorIns["usuario_id"] = $_SESSION["idUsuario"];
$vetorIns["filme_id"] = filter_input(INPUT_POST,"filme_id");
$vetorIns["status_filme"] = filter_input(INPUT_POST, 'assisti');
$vetorIns["data"] = date("Y-m-d");
$filmeDAO = new FilmeDAO($conexao);
if($vetorIns["status_filme"] == "Assistido" || $vetorIns["status_filme"] == "Vou Assistir"){
    $resultado = $filmeDAO->insereUsuarioFilme($vetorIns);
    if($resultado){
        header("Location: ../consulta-filme.php?id={$vetorIns["filme_id"]}&adicionou-filme-usuario=1&status={$vetorIns["status_filme"]}");
    }else{
        header("Location: ../consulta-filme.php?adicionou-filme-usuario=0");
    }
}else{
    $resultado = $filmeDAO->deletaFilmePorStatus($vetorIns);
    if($resultado){
        header("Location: ../consulta-filme.php?id={$vetorIns["filme_id"]}&adicionou-filme-usuario=5&status={$vetorIns["status_filme"]}");
    }
}