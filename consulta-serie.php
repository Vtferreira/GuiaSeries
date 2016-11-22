<?php
/*
 * Template que mostra dados referentes a uma série, permitindo adicionar temporadas/episódios assistidos
 */
$tituloAba = "GuiaSeries | Serie";
require_once("include/cabecalho.php");
require_once("classes/Obra.php");
require_once("classes/Genero.php");
require_once("classes/Serie.php");
require_once("banco/SerieDAO.php");
$serie_id = filter_input(INPUT_GET,'id');
$serieDAO = new SerieDAO($conexao);
$serie = $serieDAO->consultar($serie_id);
$temporadas = $serieDAO->listaTemporadas($serie_id);
?>
<link rel="stylesheet" type="text/css" href="css/filmes.css">
<script type="text/javascript" src="js/jquery-1.12.1.min.js"></script>
<script type="text/javascript" src="js/serie-busca.js"></script>
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
</style>
<script src="https://use.fontawesome.com/b17cc3a995.js"></script>
<div class="container filme-consulta">
    <section class="filmeInformacoes">
    	<figure>
            <img src="imagens-serie/<?=$serie->getArquivo();?>">
    	</figure>
            <p>
            	<span class="titulo-filme">
                	<a href="consulta-serie.php?id=<?=$serie->getId()?>">
                        <?php echo $serie->getNome(); ?>
                	</a>
                </span>
                <br>
            	<strong>Gênero:</strong>
                <a href="lista-series.php?genero=<?=$serie->getGenero()->getId()?>">
                    <?php echo $serie->getGenero()->getNome(); ?>
                </a>
               
                <br>
                <strong>Classificação: </strong><?=$serie->mostraClassificacao()?><br>
                 <span class="avaliacaoIMBD">Avaliação:<br><?php echo $serie->getAvaliacaoIMDB(); ?></span>
                <strong>Duração dos Episódios:</strong>
                <span class="duracao-filme">
                    <?=$serie->getDuracao()?> minutos
                </span><br>
                <strong>Total de Temporadas: </strong><?=$serie->getTemporadas()?> <br>
                <strong>Avaliação IMBD:</strong><span class="avaliacao"><?=$serie->getAvaliacaoIMDB()?></span><br>
                <strong>Sinopse:</strong>
                <?php echo $serie->getSinopse(); ?>
            </p>
    </section>
    <section class="episodios">
        <div class="form-box" style="margin-left: 0">
            <label for="temporada">Temporadas</label>
            <select name="temporada" id="temporada" class="field" style="width:25%">
                <?php                 
                foreach($temporadas as $temporada):
                    $tempExplode = explode("_",$temporada['nome']);
                    $nomeTemporada = $tempExplode[1];
                ?>
                    <option value="<?=$temporada['temporada_id']?>"><?=$nomeTemporada?></option>
                <?php endforeach; ?>
            </select>
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
        </div>
    </section>
</div>