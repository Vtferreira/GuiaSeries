<?php
/*
 * Template que mostra dados referentes a uma série, permitindo adicionar temporadas/episódios assistidos
 */
function transformaStatus($status){
    $novoStatus = "";
    switch($status){
        case 10: $novoStatus = "Já Acompanho"; break;
        case 20: $novoStatus = "Quero Acompanhar"; break;
    }
    return $novoStatus;
}
$tituloAba = "GuiaSeries | Serie";
require_once("include/cabecalho.php");
require_once("classes/Obra.php");
require_once("classes/Genero.php");
require_once("classes/Serie.php");
require_once("banco/SerieDAO.php");
$usuarioObj = new Usuario();
$usuarioObj->protegePagina();
$serie_id = filter_input(INPUT_GET, 'id');
$usuario_id = $_SESSION["idUsuario"];
$serieDAO = new SerieDAO($conexao);
$serie = $serieDAO->consultar($serie_id);
$temporadas = $serieDAO->listaTemporadas($serie_id);
$totalEpisodios = $serieDAO->consultaTotalEpisodios($serie_id);
/*Configuração dos botões*/
$textoBtnAcompanho = "Já Acompanho";
$textoBtnVouAcompanhar = "Quero Acompanhar";
$iconeBtnAcompanho = "fa fa-thumbs-o-up fa-lg";
$iconeBtnVouAcompanhar = "fa fa-user-plus fa-lg";
$valueBtnAcompanho = 10;
$valueBtnVouAcompanhar = 20;
$flagAcompanho = $serieDAO->verificaUsuarioSerie($usuario_id, $serie_id, 10);
$flagVouAcompanhar = $serieDAO->verificaUsuarioSerie($usuario_id, $serie_id, 20);
if($flagAcompanho != NULL){
    $textoBtnAcompanho = "Ainda Não Acompanho";
    $iconeBtnAcompanho = "fa fa-times fa-lg";
    $valueBtnAcompanho = -1;
}else if($flagVouAcompanhar != NULL){
    $textoBtnVouAcompanhar = "Não quero Mais Acompanhar";
    $iconeBtnVouAcompanhar = "fa fa-minus-square fa-lg";
    $valueBtnVouAcompanhar = -1;
}
?>
<link rel="stylesheet" type="text/css" href="js/jqueryUI/css/custom-theme/jquery-ui-1.10.4.custom.min.css">
<link rel="stylesheet" type="text/css" href="css/filmes.css">
<script type="text/javascript" src="js/jquery-1.12.1.min.js"></script>
<script type="text/javascript" src="js/serie-busca.js"></script>
<script type="text/javascript" src="js/jqueryUI/js/jquery-ui-1.10.4.custom.min.js"></script>

<style type="text/css">
    .tabela{
        width: 96.5%;
    }
    .tabela tr > th:first-child{
        width: 5%;
    }
    .tabela tr > th:nth-child(2){
        width: 30%;
    }
    .tabela tr > th:nth-child(3){
        width: 5%;
    }
    .tabela tr > th:nth-child(4){
        width: 5%;
    }
    .avaliacaoIMBD{
        border: none;
        background: #1874CD;
    }
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$("#recomendar").on("click",function(){
			$("#recomendacao-dialog").dialog({
				resizable: false,
				modal: true,
				width: 400,
				buttons: {
					"Enviar":function(){
						document.getElementById("form-recomendacao").submit();
					},
					"Cancelar":function(){
						$(this).dialog("close");
					}
				}
			});
		});
	});
</script>
<script src="https://use.fontawesome.com/b17cc3a995.js"></script>
<div class="container filme-consulta">
    <?php if(isset($_GET["adicionou-serie-usuario"]) && $_GET["adicionou-serie-usuario"] == 1): ?>
        <p class="alerta mensagem-sucesso">
            A série foi adicionada como <strong><?php echo transformaStatus($_GET["status"]);?></strong>!
        </p>
    <?php endif; ?>
    <?php if(isset($_GET["adicionou-serie-usuario"]) && $_GET["adicionou-serie-usuario"] == 5):?>
        <p class="alerta mensagem-sucesso">
            A série foi removida da sua lista!
        </p>
    <?php endif; ?>
    <?php if(isset($_GET['recomendacao']) && $_GET['recomendacao'] == 1): ?>
    	<p class="alerta mensagem-sucesso">Série recomendada com sucesso!</p>
    <?php endif; ?>
    <section class="filmeInformacoes">
        <figure>
            <img src="imagens-serie/<?= $serie->getArquivo(); ?>">
        </figure>
            <span class="titulo-filme">
                <a href="consulta-serie.php?id=<?= $serie->getId() ?>">
                    <?php echo $serie->getNome(); ?> (<?php echo $serie->getAnoEstreia(); ?>)
                </a>
            </span>
        <br>
        <?php if(isset($_SESSION['idUsuario'])): ?>
        <form action="php/adiciona-usuario-serie.php" method="POST">
            <input type="hidden" name="serie_id" value="<?=$serie->getId()?>">
            <button type="submit" class="button button-info" 
                    style="padding-left: 0.5em;margin-top: 0.3em;margin-bottom: 0.3em" 
                    name="assisti" value="<?=$valueBtnAcompanho?>">
                <i class="<?=$iconeBtnAcompanho?>"><?="&nbsp".$textoBtnAcompanho?></i>
            </button>
            <button type="submit" class="button button-alter" style="padding-left: 0.5em"
                    name="assisti" value="<?=$valueBtnVouAcompanhar?>">
                <i class="<?=$iconeBtnVouAcompanhar?>"><?="&nbsp".$textoBtnVouAcompanhar?></i>
            </button>
        </form>
        <form action="php/recomenda-serie.php">
        	<button type="button" class="button button-warning" id="recomendar">
        		<i class="fa fa-commenting fa-lg" aria-hidden="true">&nbspRecomendar Série</i>
        	</button>
        </form>
        <?php endif; ?>
        <p>
            <strong>Gênero:</strong>
            <a href="lista-series.php?genero=<?= $serie->getGenero()->getId() ?>">
                <?php echo $serie->getGenero()->getNome(); ?>
            </a>

            <br>
            <strong>Classificação: </strong><?= $serie->mostraClassificacao() ?><br>
            <!-- <span class="avaliacaoIMBD">Avaliação:<br><?php echo $serie->getAvaliacaoIMDB(); ?></span> -->
            <span class="avaliacaoIMBD">
                <strong><?=$totalEpisodios['total_episodios']?></strong> episódios<br>
                <strong><?=$totalEpisodios['total_temporadas']?></strong> temporadas
            </span> 
            <strong>Duração dos Episódios:</strong>
            <span class="duracao-filme">
                <?= $serie->getDuracao() ?> minutos
            </span><br>
            <strong>Total de Temporadas: </strong><?= $serie->getTemporadas() ?> <br>
            <strong>Avaliação IMBD:</strong><span class="avaliacao"><?= $serie->getAvaliacaoIMDB() ?></span><br>
            <strong>Sinopse:</strong>
            <?php echo $serie->getSinopse(); ?>
        </p>
    </section>
    <section class="episodios">
        <div class="form-box" style="margin-left: 0;">
            <label for="temporada">Temporadas</label>
            <select name="temporada" id="temporada" class="field" style="width:25%">
                <?php
                foreach ($temporadas as $temporada):
                    $tempExplode = explode("_", $temporada['nome']);
                    $nomeTemporada = $tempExplode[1];
                    ?>
                    <option value="<?= $temporada['temporada_id'] ?>"><?= $nomeTemporada ?></option>
                <?php endforeach; ?>
            </select>
        </div>
            <table class="tabela" id="tabela-episodios">
                <thead>
                    <tr>
                        <th>Episódio</th>
                        <th>Nome</th>
                        <th>Lançamento</th>
                        <th>Avaliação IMDB</th>
                        <th>Assistido</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        <!-- </div> -->
    </section>
</div>
<!-- Dialog para recomendação de série !-->
<div id="recomendacao-dialog" title="Recomendar Série" style="display: none;">
	<div class="form-box" style="margin-left: 1em">
		<form action="php/recomendar-serie.php" method="POST" id="form-recomendacao">
			<input type="hidden" name="usuario_nome" value="<?=$usuarioObj->usuarioLogado()?>">
			<input type="hidden" name="serie_id" value="<?=$serie->getId()?>">
			<input type="hidden" name="total_episodios" value="<?=$totalEpisodios['total_episodios']?>">
			<label for="email">E-mail</label>
			<input type="text" name="email" id="email" class="field field-large" autofocus>
		</form>
	</div>
</div>