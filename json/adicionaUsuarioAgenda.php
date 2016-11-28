<?php
/*Realiza uma inserção na tabela usuarioagenda, com o objetivo de adicionar uma série/filme na agenda pessoal do usuário
(agenda é multiusuario para o sistema)*/
require_once("../banco/conexao.php");
require_once("../php/ajudantes.php");
require_once("../banco/AgendaDAO.php");
$usuario_id = filter_input(INPUT_POST, 'usuario_id');
$agenda_id = filter_input(INPUT_POST, 'agenda_id');
$agendaDAO = new AgendaDAO($conexao);
$inseriu = $agendaDAO->insereUsuarioAgenda($usuario_id,$agenda_id);
$arquivo_json = $agendaDAO->geraArquivoJSON($inseriu);
echo $arquivo_json;