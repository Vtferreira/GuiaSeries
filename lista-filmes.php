<?php
$tituloAba = "GuiaSeries | Filmes";
require_once("include/cabecalho.php");
require_once("include/arquivosJS.php");
require_once("classes/Genero.php");
require_once("classes/Estudio.php");
require_once("classes/Diretor.php");
require_once("classes/Obra.php");
require_once("classes/Filme.php");
require_once("banco/conexao.php");
require_once("banco/FilmeDAO.php");
$criterio = "avaliacaoIMBD DESC";
$filmeDAO = new FilmeDAO($conexao);
$filmePesquisa = new Filme();
if(isset($_POST['criterio'])){
    $criterio = filter_input(INPUT_POST, 'criterio');
}
/*Listagem de filmes de acordo com pesquisas*/
if(isset($_GET['genero_id'])){
    $genero_id = filter_input(INPUT_GET,'genero_id');
    $filmePesquisa->getGenero()->setId($genero_id);
}
if(isset($_GET["genero"]) && $_GET["genero"] != "Selecione"){
    $genero_id = filter_input(INPUT_GET, 'genero');
    $filmePesquisa->getGenero()->setId($genero_id);
}
if(isset($_GET["filme"])){
    $titulo = filter_input(INPUT_GET, 'filme');
    $filmePesquisa->setNome($titulo);
}
if(isset($_GET["ano"])){
    $ano = filter_input(INPUT_GET,'ano');
    $filmePesquisa->setDataEstreia($ano);
}
if(isset($_GET["estudio"]) && $_GET["estudio"] != "Selecione"){
    $estudio_id = filter_input(INPUT_GET, 'estudio');
    $filmePesquisa->getEstudio()->setId($estudio_id);
}
if(isset($_GET["diretor"])){
    $diretor = filter_input(INPUT_GET, 'diretor');
    $filmePesquisa->getDiretor()->setNome($diretor);
}
if(isset($_GET["avaliacao"])){
    $avaliacao = filter_input(INPUT_GET, 'avaliacao');
    $filmePesquisa->setAvaliacaoIMDB($avaliacao);
}
/*Verifica se é a lista geral ou a lista definida pelo Usuário*/
if(isset($_GET["listaPorUsuario"])){
    $usuarioId = $_SESSION["idUsuario"];
    $status = filter_input(INPUT_GET, 'status');
    $arrayFilmes = $filmeDAO->listaUsuarioFilme($usuarioId,$criterio,$status);
    $titulo = "Meus Filmes";
    /*Utilização de funções agregadas do SQL*/
    $totalAssistido = $filmeDAO->contaFilmes($usuarioId, "Assistido");
    $totalQueroAssistir = $filmeDAO->contaFilmes($usuarioId, "Vou Assistir");
}else{
    $arrayFilmes = $filmeDAO->listarOrderBy($criterio,$filmePesquisa);
    $titulo = "Listagem de Filmes";
}
/*Verifica se retornou apenas 0 ou 1 resultado*/
if(count($arrayFilmes) == 1){
    header("Location: consulta-filme.php?id=".$arrayFilmes[0]->getId());
}else if(count($arrayFilmes) == 0){
    echo 
    "<div class='alerta mensagem-sucesso container'>
        Nenhum resultado encontrado. Refaça a pesquisa, se necessário
    </div>";
}
?>
<link rel="stylesheet" type="text/css" href="css/filmes.css">
<script type="text/javascript">
    $(document).ready(function(){
       $("#criterio").on("change",function(){
          var endereco = window.location.href;
          endereco = endereco.split(".php");
          if(endereco[1].indexOf("?") != -1 ){
              document.getElementById("form-filmes").action = "lista-filmes.php" + endereco[1];
          }     
          document.getElementById("form-filmes").submit(); 
       });
    });
</script>
<?php if(count($arrayFilmes) > 0): ?>
<div class="container lista-filmes">
    <h1><?php echo $titulo; ?></h1>
    <form action="lista-filmes.php" method="POST" id="form-filmes">
        <div class="form-box">
            <?php if(isset($_GET["listaPorUsuario"])):?>
            <p class="status-filtro">
                 Já Assisti: <br>
                 <a href="lista-filmes.php?listaPorUsuario=<?php echo $usuarioId; ?>&status=assistido">
                     <?php echo sprintf("%02d", $totalAssistido["total_filme"]); ?>
                 </a>
            </p>
            <p class="status-filtro">
                Quero Assistir: 
                <a href="lista-filmes.php?listaPorUsuario=<?php echo $usuarioId; ?>&status=Vou Assistir">
                    <?php echo sprintf("%02d", $totalQueroAssistir["total_filme"]); ?>
                </a>
            </p>
            <?php endif; ?>
            <p class="estatistica">
                Média de Notas:<br> <span class="mediaNotas">00</span>
            </p>
            <p class="estatistica estatistica-tempo">
                Tempo Total:<br> <span class="total-tempo">00</span>
            </p><br><br>
            <label for="criterio">Ordenar por:</label>
            <select id="criterio" name="criterio" class="field field-small">
                <option>Selecione</option>
                <option value="avaliacaoIMBD DESC">Mais Populares</option>
                <option value="nome">Ordem Alfabética</option>
                <option value="dataEstreia DESC">Data de Estreia</option>
                <option value="genero_nome">Gênero</option>
                <option value="estudio_nome">Estúdio</option>
            </select>
            <p class="media-notas">
                
            </p>
        </div>
    </form>
    <?php 
    foreach ($arrayFilmes as $filme): ?>
    <section class="filme">
        <figure>
            <img src="imagens/<?php echo $filme->getArquivo(); ?>">
        </figure>
        <p>
            <span class="titulo-filme">
                <a href="consulta-filme.php?id=<?php echo $filme->getId(); ?>">
                    <?php echo substr($filme->getNome(),0,29); ?>
                </a>
            </span><br>
            <strong>Estúdio: </strong>
            <a href="lista-filmes.php?estudio=<?php echo $filme->getEstudio()->getId(); ?>">
                <?php echo $filme->getEstudio()->getNome(); ?>
            </a>
            <br>
            <strong>Duração:</strong>
            <span class="duracao-filme">
                <?php echo $filme->getDuracao(); ?> minutos<br>
            </span>
            <strong>Gênero:</strong>
            <a href="lista-filmes.php?genero=<?php echo $filme->getGenero()->getId(); ?>">
                <?php echo $filme->getGenero()->getNome(); ?>
            </a>
            <br>
            <strong>Classificação:</strong><?php echo $filme->mostraClassificacao(); ?><br>
            <strong>Estreia:</strong><?php echo $filme->mostraEstreiaBrasil(); ?><br>
            <strong>Direção:</strong>
            <a href="lista-filmes.php?diretor=<?php echo $filme->getDiretor()->getNome();?>">
                <?php echo $filme->getDiretor()->getNome();?><br>
            </a>
            <strong>Avaliação IMBD:</strong><span class="avaliacao"><?php echo $filme->getAvaliacaoIMDB(); ?></span><br>
            <strong>Sinopse:</strong>
            <?php echo substr($filme->getSinopse(), 0, 150)?>
        </p>
    </section>
    <?php endforeach;?>
</div>
<?php endif; ?>
<!-- Exercícios do Livro de JavaScript. Pode apagar depois :) !-->
<script type="text/javascript">
    /*
    window.onload = function(){
        var filmes = document.getElementsByClassName("filme");
        var total=0;
        var media=0;
        for(var i=0; i< filmes.length; i++){
            var avaliacao = parseFloat(filmes[i].getElementsByClassName("avaliacao")[0].innerHTML);
            total = total + avaliacao;
        }
        media = total/filmes.length;
        console.log("Média de nota dos filmes: " + media.toFixed(2));
    }*/
    function calculaMedia(){
        var filmes = $(".filme");
        var total=0;
        var media=0;
        $.each(filmes,function(i,filme){
            var $filme = $(filme);
            var avaliacao = parseFloat($filme.find(".avaliacao").text());
            total = total + avaliacao;
        });
        media = total/filmes.length;
        $(".mediaNotas").text(media.toFixed(2));
    }
    function transformaMinutosHoras(minutos){
        var horas = minutos/60;
        horas = horas.toFixed(2);
        horas = horas.split(".");
        return horas;
    }
    function calculaTotalMinutos(){
        var filmes = $(".filme");
        var total=0;
        $.each(filmes,function(item,filme){
            var $filme = $(filme);
            var duracao = parseFloat($filme.find(".duracao-filme").text().trim());
            total = total + duracao;
        });
        var horas = transformaMinutosHoras(total);
        return horas;
    }
    $(document).ready(function(){
        var endereco = window.location.href;
        $(".media-notas").hide();
        if(endereco.indexOf("?") !== -1){
            calculaMedia();
            var horas = calculaTotalMinutos();
            $(".total-tempo").text(horas[0] + " horas e " + horas[1] + " minutos");
            $(".media-notas").show();
        }
    });
</script>