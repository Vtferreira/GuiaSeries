<?php
/* 
 * Página responsável por adicionar uma série X à lista de um usuário Y.
 * Tabela responsável por isso é UsuarioSerie, no qual constitui uma relação muitos-pra-muitos
 */
require_once("../classes/Usuario.php");
require_once("../banco/conexao.php");
require_once("../banco/SerieDAO.php");
/*({$vetor['usuario_id']},{$vetor['serie_id']},{$vetor['status']})*/
$vetor['usuario_id'] = $_SESSION['idUsuario'];
$vetor['serie_id'] = filter_input(INPUT_POST,'serie_id');
$vetor['status'] = filter_input(INPUT_POST,'assisti');
$vetor['data_atual'] = date("Y-m-d");
$serieDAO = new SerieDAO($conexao);
if($vetor['status'] == 10 || $vetor['status'] == 20){
    $inseriu = $serieDAO->insereUsuarioSerie($vetor);
    if($inseriu){
        header("Location: ../consulta-serie.php?id={$vetor["serie_id"]}&adicionou-serie-usuario=1&status={$vetor["status"]}");
    }
}elseif($vetor['status'] == -1){
    $deletou = $serieDAO->deletaUsuarioSerie($vetor['usuario_id'], $vetor['serie_id']);
    if($deletou){
        header("Location: ../consulta-serie.php?id={$vetor["serie_id"]}&adicionou-serie-usuario=5&status={$vetor["status"]}");
    }
}