<?php
$tituloAba = "GuiaSeries | Series";
require_once("include/cabecalho.php");
require_once("classes/Obra.php");
require_once("classes/Genero.php");
require_once("classes/Serie.php");
require_once("banco/SerieDAO.php");
/*Função que verifica se a lista é geral ou por usuário, e retorna o array da busca realizada*/
function criaListaUsuario($serieDAO){
    if(isset($_GET["listaPorUsuario"]) && $_GET["listaPorUsuario"] == 1) {
        $usuario_id = $_SESSION['idUsuario'];
        $status = filter_input(INPUT_GET, 'status');
        $lista_series = $serieDAO->listaUsuarioSerie($usuario_id, $status);
    }else{
        $lista_series = $serieDAO->listar();
    }
    return $lista_series;
}
function contaListaUsuario($serieDAO,$status){
    $usuario_id = $_SESSION['idUsuario'];
    $total = $serieDAO->contaUsuarioSerie($usuario_id,$status);
    return $total;
}

$usuarioObj = new Usuario();
$usuarioObj->protegePagina();
$usuarioId = $_SESSION['idUsuario'];
$serieDAO = new SerieDAO($conexao);
$lista_series = criaListaUsuario($serieDAO);
$totalAcompanho = contaListaUsuario($serieDAO,"10");
$totalVouAcompanhar = contaListaUsuario($serieDAO,"20");
/*
if (count($lista_series) == 1) {
    header("Location: consulta-serie.php?id=" . $lista_series[0]->getId());
} */
if (count($lista_series) == 0) {
    echo
    "<div class='alerta mensagem-sucesso container'>
        Nenhum resultado encontrado. Refaça a pesquisa, se necessário
    </div>";
}
?>
<link rel="stylesheet" type="text/css" href="css/filmes.css">
<style type="text/css">
    @media (min-width: 1000px){
        .status-filtro{
            width: 17%;
        }
    }
</style>
<script type="text/javascript" src="js/jquery-1.12.1.min.js"></script>
<script type="text/javascript">
    window.onload = function(){
        document.getElementById("criterio").onchange = function(){
      		var endereco = window.location.href;
          	endereco = endereco.split(".php");
          	if(endereco[1].indexOf("?") != -1 ){
            	document.getElementById("form-series").action = "lista-series.php" + endereco[1];
          	}     
            document.getElementById("form-series").submit();
        };
    };
</script>
<div class="container lista-filmes">
    <?php if (count($lista_series) > 0): ?>
        <?php if(isset($_GET["listaPorUsuario"])?$tituloPagina = "Minhas Séries":$tituloPagina = "Listagem de Séries");?>
        <h1><?php echo $tituloPagina; ?></h1>
        <form id="form-series" action="lista-series.php" method="POST">
            <div class="form-box">
            <?php if(isset($_GET["listaPorUsuario"])):?>
                <p class="status-filtro">
                 Já Acompanho: <br>
                 <a href="lista-series.php?listaPorUsuario=1&status=10">
                     <?php echo sprintf("%02d", $totalAcompanho['total_serie']); ?>
                 </a>
                </p>
                <p class="status-filtro">
                Vou Acompanhar: 
                <a href="lista-series.php?listaPorUsuario=1&status=20">
                    <?php echo sprintf("%02d", $totalVouAcompanhar['total_serie']); ?>
                </a>
                </p><br>
            <?php endif; ?>
                <label for="criterio">Ordenar por:</label>
                <select id="criterio" name="criterio" class="field field-small">
                    <?php $escolhido = filter_input(INPUT_POST, 'criterio'); ?>
                    <option>Selecione</option>
                    <option value="s.avaliacao DESC" 
                    <?php if ($escolhido == "s.avaliacao DESC" ? $selecionado = "selected" : $selecionado = "")  ?>
                            <?php echo $selecionado; ?>>
                        Mais Populares
                    </option>
                    <option value="s.nome"
                    <?php if ($escolhido == "s.nome" ? $selecionado = "selected" : $selecionado = "")  ?>
                            <?php echo $selecionado; ?>>
                        Ordem Alfabética</option>
                    <option value="s.anoEstreia DESC"
                    <?php if ($escolhido == "s.anoEstreia DESC" ? $selecionado = "selected" : $selecionado = "")  ?>
                            <?php echo $selecionado; ?>>
                        Data de Estreia</option>
                    <option value="genero_nome"                    
                    <?php if ($escolhido == "genero_nome" ? $selecionado = "selected" : $selecionado = "")  ?>
                            <?php echo $selecionado; ?>>
                        Gênero</option>
                    <option value="s.totalTemporadas DESC"
                    <?php if ($escolhido == "s.totalTemporadas DESC" ? $selecionado = "selected" : $selecionado = "")  ?>
                            <?php echo $selecionado; ?>>
                        Total de Temporadas</option>
                    <option value="s.duracao DESC"
                    <?php if ($escolhido == "s.duracao DESC" ? $selecionado = "selected" : $selecionado = "")  ?>
                            <?php echo $selecionado; ?>>
                        Duração em Minutos</option>
                </select>
            </div>
        </form>
        <?php foreach ($lista_series as $serie): ?>
            <section class="filme">
                <figure>
                    <img src="imagens-serie/<?= $serie->getArquivo(); ?>">
                </figure>
                <p>
                    <span class="titulo-filme">
                        <a href="consulta-serie.php?id=<?= $serie->getId() ?>">
                            <?php echo $serie->getNome(); ?>
                        </a>
                    </span>
                    <br>
                    <strong>Gênero:</strong>
                    <a href="lista-series.php?genero=<?= $serie->getGenero()->getId() ?>">
                        <?php echo $serie->getGenero()->getNome(); ?>
                    </a>
                    <br>
                    <strong>Classificação: </strong><?= $serie->mostraClassificacao() ?><br>
                    <strong>Duração dos Episódios:</strong>
                    <span class="duracao-filme">
                        <?= $serie->getDuracao() ?> minutos
                    </span><br>
                    <strong>Total de Temporadas: </strong><?= $serie->getTemporadas() ?> <br>
                    <strong>Avaliação IMBD:</strong><span class="avaliacao"><?= $serie->getAvaliacaoIMDB() ?></span><br>
                    <strong>Sinopse:</strong>
                    <?php echo substr($serie->getSinopse(), 0, 186); ?>
                </p>
            </section>
        <?php endforeach; ?>
    </div>
    <?php require_once("include/rodape.php"); ?>
<?php endif; ?>
<script type="text/javascript" src="js/redireciona-filme.js"></script>