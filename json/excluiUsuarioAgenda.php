<?php
require_once("../banco/conexao.php");
require_once("../php/ajudantes.php");
require_once("../banco/AgendaDAO.php");
$usuario_id = filter_input(INPUT_POST, 'usuario_id');
$agenda_id = filter_input(INPUT_POST, 'agenda_id');
$agendaDAO = new AgendaDAO($conexao);
$excluiu = $agendaDAO->deletaUsuarioAgenda($usuario_id,$agenda_id);
$arquivo_json = $agendaDAO->geraArquivoJSON($excluiu);
echo $arquivo_json;
?>