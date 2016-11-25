<?php 
	$tituloAba = "GuiaSeries | Agenda";
	require_once("include/cabecalho.php");
	require_once("classes/Obra.php");
	require_once("classes/Genero.php");
	require_once("classes/Serie.php");
	require_once("banco/conexao.php");
	require_once("banco/AgendaDAO.php");
	$agendaDAO = new AgendaDAO($conexao);
	$itens = $agendaDAO->listar();
?>
<script src="https://use.fontawesome.com/b17cc3a995.js"></script>
<div class="container">
	<h1 style="margin-top:0.3em">Novos Filmes e Séries</h1>
	<?php foreach($itens as $item): ?>
	<div class="secao-agenda">
		<figure>
			<img src="imagens-agenda/<?=$item->getArquivo()?>" style="width:150px" alt="<?=$item->getNome()?>">
		</figure>
		<span class="titulo-agenda"><?=$item->getNome()?></span>
		<p>
			<strong>Estreia:</strong><?=$item->mostraEstreiaBrasil()?><br>
			<strong>Gênero:</strong> <?=$item->getGenero()->getNome()?><br>
			<strong>Sinopse:</strong><br>
			<?php echo $item->getSinopse(); ?>
			<br>
			<button type="button" class="button button-info" name="agenda" value=""
				style="margin-top: 0.3em">
                <i class="fa fa-thumbs-o-up fa-lg">&nbsp;Adicionar em Minha Agenda</i>
            </button>
            <span class="contagem-estreia">
            	<i class="fa fa-calendar fa-lg">&nbsp;<?=$item->getDiasRestantes()?> dias para a estreia</i>
            </span>
		</p>
	</div>
	<?php endforeach; ?>
</div>
<?php require_once("include/rodape.php"); ?>