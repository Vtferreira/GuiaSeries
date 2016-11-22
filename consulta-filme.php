<?php
/*
 * Template que mostra dados referentes a um filme, permitindo a inclusão deste na lista do usuário
 */
$tituloAba = "GuiaSeries | Consulta Filme";
require_once("include/cabecalho.php");
require_once("classes/Usuario.php");
require_once("classes/Genero.php");
require_once("classes/Estudio.php");
require_once("classes/Diretor.php");
require_once("classes/Obra.php");
require_once("classes/Filme.php");
require_once("banco/conexao.php");
require_once("banco/FilmeDAO.php");
$usuarioObj = new Usuario();
$usuarioObj->protegePagina();
$filme_id = filter_input(INPUT_GET, 'id');
$usuario_id = $_SESSION["idUsuario"];
$textoBtnAssisti = "Já Assisti";
$textoBtnVouAssistir = "Quero Assistir";
$iconeBtnAssisti = "fa fa-thumbs-o-up fa-lg";
$iconeBtnVouAssistir = "fa fa-user-plus fa-lg";
$valueBtnAssisti = "Assistido";
$valueBtnVouAssistir = "Vou Assistir";
$filmeDAO = new FilmeDAO($conexao);
$filmeBusca = $filmeDAO->consultar($filme_id);
$flagAssistido = $filmeDAO->verificaFilmeUsuario($usuario_id, $filme_id, "Assistido");
$flagVouAssistir = $filmeDAO->verificaFilmeUsuario($usuario_id, $filme_id, "Vou Assistir");
if($flagAssistido != NULL){
    $textoBtnAssisti = "Ainda Não Assisti";
    $iconeBtnAssisti = "fa fa-times fa-lg";
    $valueBtnAssisti = "naoAssisti";
}else if($flagVouAssistir != NULL){
    $textoBtnVouAssistir = "Não quero Mais Assistir";
    $iconeBtnVouAssistir = "fa fa-minus-square fa-lg";
    $valueBtnVouAssistir = "naoQueroAssistir";
}
?>
<link rel="stylesheet" type="text/css" href="css/filmes.css">
<script src="https://use.fontawesome.com/b17cc3a995.js"></script>
<div class="container filme-consulta">
    <?php if(isset($_GET["adicionou-filme-usuario"]) && $_GET["adicionou-filme-usuario"] == 1): ?>
        <p class="alerta mensagem-sucesso">
            O filme foi adicionado como <strong><?php echo $_GET["status"];?></strong>!
        </p>
    <?php endif; ?>
    <?php if(isset($_GET["adicionou-filme-usuario"]) && $_GET["adicionou-filme-usuario"] == 5):?>
        <p class="alerta mensagem-sucesso">
            O filme foi removido da sua lista!
        </p>
    <?php endif; ?>
    <section class="filmeInformacoes">
    <!-- <img src="get_image.php?url=https://images.nga.gov/en/web_images/constable.jpg"> -->
        <figure>
            <img src="imagens/<?=$filmeBusca->getArquivo();?>" alt="Pôster do filme">
        </figure>
        <h1>
            <span class="titulo-filme">
                <?php echo $filmeBusca->getNome(); ?> (<?php echo $filmeBusca->mostraAnoEstreia(); ?>)
            </span>
        </h1>
        <?php if (isset($_SESSION["idUsuario"])): ?>
        <form action="php/adiciona-usuario-filme.php" method="POST">
            <input type="hidden" name="filme_id" value="<?php echo $_GET['id']; ?>">
            <button type="submit" class="button button-info" style="padding-left: 0.5em"
                    name="assisti" value="<?php echo $valueBtnAssisti; ?>">
                <i class="<?php echo $iconeBtnAssisti; ?>"> <?php echo $textoBtnAssisti; ?></i>
            </button>
            <button type="submit" class="button button-alter" style="padding-left: 0.5em"
                    name="assisti" value="<?php echo $valueBtnVouAssistir; ?>">
                <i class="<?php echo $iconeBtnVouAssistir; ?>"> <?php echo $textoBtnVouAssistir; ?></i>
            </button>
        </form>
        <?php endif; ?>
        <p style="margin-top:0.5em">
            <strong>Estúdio:</strong>
            <a href="lista-filmes.php?estudio=<?php echo $filmeBusca->getEstudio()->getId(); ?>">
                <?php echo $filmeBusca->getEstudio()->getNome(); ?>
            </a>    
            <br>
            <span class="avaliacaoIMBD">Avaliação:<br><?php echo $filmeBusca->getAvaliacaoIMDB(); ?></span>
            <strong>Duração:</strong><?php echo $filmeBusca->getDuracao(); ?> minutos<br>
            <strong>Gênero:</strong>
            <a href="lista-filmes.php?genero_id=<?php echo $filmeBusca->getGenero()->getId(); ?>">
                <?php echo $filmeBusca->getGenero()->getNome(); ?>
            </a>   
            <br>
            <strong>Classificação:</strong><?php echo $filmeBusca->mostraClassificacao(); ?><br>
            <strong>Estreia:</strong><?php echo $filmeBusca->mostraEstreiaBrasil(); ?><br>
            <strong>Direção:</strong>
            <a href="lista-filmes.php?diretor=<?php echo $filmeBusca->getDiretor()->getNome(); ?>">
                <?php echo $filmeBusca->getDiretor()->getNome(); ?><br>
            </a>
            <span class="sinopse">
                <strong>Sinopse:</strong><br>
                <?php echo $filmeBusca->getSinopse(); ?> - 
                <em>Prêmios: <?php echo $filmeBusca->getPremios(); ?></em>
            </span>  
        </p>
    </section>
</div>
