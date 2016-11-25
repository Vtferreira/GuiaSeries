<?php
	require_once("ajudantes.php");
	require_once("../classes/Genero.php");
	require_once("../classes/Obra.php");
	require_once("../classes/Serie.php");
	require_once("../banco/conexao.php");
	require_once("../banco/AgendaDAO.php");
	$estreia = filter_input(INPUT_POST, 'estreia');
	$serie = new Serie();
	$serie->setArquivo($_FILES["arquivo"]["name"]);
	$serie->setNome(filter_input(INPUT_POST, 'titulo'));
	$serie->getGenero()->setId(filter_input(INPUT_POST, 'genero'));
	$serie->setDataEstreia(dateToAmerican($estreia));
	$serie->setSinopse(filter_input(INPUT_POST, 'sinopse'));
	$agendaDAO = new AgendaDAO($conexao);
	$inseriu = $agendaDAO->inserir($serie);
	if($inseriu){
		header("Location:../form-agenda.php?inseriu=1");
	}else{
		header("Location:../form-agenda.php?inseriu=0");
	}
?>