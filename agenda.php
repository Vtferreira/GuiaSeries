<?php 
	/*Lista os filmes e séries presentes na agenda geral do sistema*/
	$tituloAba = "GuiaSeries | Agenda";
	require_once("include/cabecalho.php");
	require_once("php/ajudantes.php");
	require_once("classes/Obra.php");
	require_once("classes/Genero.php");
	require_once("classes/Serie.php");
	require_once("banco/conexao.php");
	require_once("banco/AgendaDAO.php");
	$agendaDAO = new AgendaDAO($conexao);
	$itens = $agendaDAO->listar();
	$listaResumida = $agendaDAO->listaResumidaUsuarioAgenda($_SESSION['idUsuario']);
	$valorHidden = "0";
	if(isset($_GET['listaPorUsuario']) && $_GET['listaPorUsuario'] == 1){
		$itens = $agendaDAO->listaUsuarioAgenda($_SESSION['idUsuario']);
		$valorHidden = "1";
	}
?>
<link rel="stylesheet" type="text/css" href="js/jqueryUI/css/custom-theme/jquery-ui-1.10.4.custom.min.css">
<script type="text/javascript" src="js/jquery-1.12.1.min.js"></script>
<script type="text/javascript" src="js/jqueryUI/js/jquery-ui-1.10.4.custom.min.js"></script>
<script src="https://use.fontawesome.com/b17cc3a995.js"></script>
<script type="text/javascript" src="js/datePickerBR.js"></script>
<script type="text/javascript" src="js/validacao.js"></script>
<script type="text/javascript" src="js/agenda.js"></script>
<div class="container">
	<h1 style="margin-top:0.3em">Novos Filmes e Séries</h1>
	<form action="" method="GET">
		<br>
		<input type="hidden" name="listaPorUsuario" value="<?=$valorHidden?>"></input>
		<label for="tipoPesquisa"><strong>Mostrar Agenda para</strong></label><br>
		<select name="tipoPesquisa" id="tipoPesquisa" class="field field-small">
			<option value="">Qualquer Período</option>
			<option value="7">Próximos 7 dias</option>
			<option value="30">Próximos 30 dias</option>
			<option value="periodo">Período Específico</option>
		</select>
		<div class="filtragem-data">
			<label for="dataInicio"><strong>Data de Início</strong></label>
			<input type="text" name="dataInicio" id="dataInicio" class="field field-tinySmall">
			<label for="dataFim"><strong>Data Final</strong></label>
			<input type="text" name="dataFim" id="dataFim" class="field field-tinySmall">
		</div>
		<button type="submit" id="pesquisa-periodo" class="button button-info">Pesquisar</button>
	</form>
	<?php 
	if(count($itens) == 0){
		echo "<div class='alerta mensagem-falha' style='margin-bottom:1em'>
		Nenhum item na agenda, para este período. Refaça a sua busca</div>";
	}
	?>
	<?php foreach($itens as $item): 
		$classeBotao = "fa fa-thumbs-o-up fa-lg adicao";
		$textoBotao = "Adicionar na minha agenda";
		//se existir o item na lista resumida do usuário
		if(in_array($item->getId(), $listaResumida)){
			$classeBotao = "fa fa-minus-square fa-lg remocao";
			$textoBotao = "Remover da minha agenda";
		}
	?>
	<form action="" method="POST">
	<div class="secao-agenda">
		<figure>
			<img src="imagens-agenda/<?=$item->getArquivo()?>" style="width:150px" alt="<?=$item->getNome()?>">
		</figure>
		<input type="hidden" class="agenda_id" name="agenda_id" value="<?=$item->getId()?>">
		<input type="hidden" id="usuario_id" name="usuario_id" value="<?=$_SESSION['idUsuario']?>">
		<span class="titulo-agenda"><?=$item->getNome()?></span>
		<p>
			<strong>Estreia:</strong><?=$item->mostraEstreiaBrasil()?><br>
			<strong>Gênero:</strong> <?=$item->getGenero()->getNome()?><br>
			<strong>Sinopse:</strong><br>
			<?php echo $item->getSinopse(); ?>
			<br>
			<!-- Verificar lógica para botões depois !-->
			<button type="button" class="button button-info agendaBtn" name="agenda" value=""
				style="margin-top: 0.3em">
                <i class="<?=$classeBotao?>">&nbsp;<?=$textoBotao?></i>
            </button>
            <span class="contagem-estreia">
            	<i class="fa fa-calendar fa-lg">&nbsp;<?=$item->getDiasRestantes()?> dias para a estreia</i>
            </span>
		</p>
	</div>
	</form>
	<?php endforeach; ?>
</div>
<?php require_once("include/rodape.php"); ?>
<script type="text/javascript" src="js/adiciona-agenda.js"></script>
