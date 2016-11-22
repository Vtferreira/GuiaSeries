<?php 
    $tituloAba = "Home | GuiaSeries";
    require_once("include/cabecalho.php"); 
    require_once("include/menu-categorias.php");
    require_once("include/arquivosJS.php");
    require_once("classes/Estudio.php");
    require_once("classes/Diretor.php");
    require_once("classes/Genero.php");
    require_once("classes/Obra.php");
    require_once("classes/Filme.php");
    require_once("classes/Obra.php");
    require_once("classes/Genero.php");
    require_once("classes/Serie.php");
    require_once("banco/conexao.php");
    require_once("banco/FilmeDAO.php");
    require_once("banco/SerieDAO.php");
    $filmeDAO = new FilmeDAO($conexao);
    $arrayFilmes = $filmeDAO->listarPagPrincipal();
    $serieDAO = new SerieDAO($conexao);
    $arraySeries = $serieDAO->listar("index");
?>
<script type="text/javascript" src="js/genero.js"></script>
    <div class="container destaque">
        <img src="imagens/netflix.jpg" alt="Imagem de Destaque">
    </div>
    <div class="container paineis">
        <section class="painel minhas-series">
            <h2>Melhores Séries</h2>
            <ol>
                <?php foreach($arraySeries as $serie): ?>
                <li>
                    <a href="consulta-serie.php?id=<?php echo $serie->getId(); ?>">
                        <figure>
                            <img src="imagens-serie/<?=$serie->getArquivo()?>">
                            <figcaption><?=substr($serie->getNome(),0,15)?></figcaption>
                        </figure>
                    </a>
                </li>
                <?php endforeach; ?>
            </ol>
        </section>
        <section class="painel mais-vistos">
            <h2>Melhores Filmes</h2>
            <ol>
            <!-- <img src="get_image.php?url=https://images.nga.gov/en/web_images/constable.jpg"> !-->
                <?php foreach($arrayFilmes as $filme):?>
                <li>
                    <a href="consulta-filme.php?id=<?php echo $filme->getId(); ?>">
                        <figure>
                            <img src="imagens/<?=$filme->getArquivo();?>" alt="Imagem de Filme">
                            <figcaption><?php echo utf8_encode(substr($filme->getNome(),0,15)); ?></figcaption>
                        </figure>
                    </a>
                </li>
                <?php endforeach;?>
            </ol>
        </section>
    </div>
<?php
    require_once("include/rodape.php");
?>