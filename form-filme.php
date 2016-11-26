<?php
/* 
 * Formulário para o cadastro de um filme. Atentar-se as listagens de diretores, estúdios e gêneros 
 */
$tituloAba = "GuiaSeries | Filme";
require_once("include/cabecalho.php");
require_once("include/arquivosJS.php");
require_once("classes/Usuario.php");
require_once("classes/Genero.php");
require_once("classes/Estudio.php");
require_once("classes/Diretor.php");
require_once("banco/conexao.php");
require_once("banco/GeneroDAO.php");
require_once("banco/EstudioDAO.php");
require_once("banco/DiretorDAO.php");
$usuarioObj = new Usuario();
$usuarioObj->protegePagina();
$generoDAO = new GeneroDAO($conexao);
$listaGeneros = $generoDAO->listar();
$estudioDAO = new EstudioDAO($conexao);
$listaEstudios = $estudioDAO->listar();
/*Verifica se o usuário abriu o form para adicionar um filme ou para pesquisa*/
$tituloForm = "Cadastro de Filmes";
$inputNaoEncontrei = "button";
$buttonSubmit = "Enviar";
$action = "php/adiciona-filme.php";
$method = "POST";
// $imbd = "readonly";
$labelIMBD = "Avaliação IMBD";
$modoPesquisa = false;
if(isset($_GET["opcao"])&& $_GET["opcao"] == "pesquisa"){
    $opcForm = filter_input(INPUT_GET, 'opcao');
    $tituloForm = "Pesquisa de Filmes";
    $inputNaoEncontrei = "hidden";
    $buttonSubmit = "Pesquisar";
    $action = "lista-filmes.php";
    $method = "GET";
    $imbd = "";
    $labelIMBD = "Avaliação(maior ou igual à)";
    $modoPesquisa = true;
}
?>
<link rel="stylesheet" type="text/css" href="js/jqueryUI/css/custom-theme/jquery-ui-1.10.4.custom.min.css">
<script type="text/javascript" src="js/jqueryUI/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="js/busca-filmes-series.js"></script>
<script type="text/javascript" src="js/filmes.js"></script>
<div class="container form form-obra">
    <h1><?php echo $tituloForm; ?></h1>
    <?php if(isset($_GET["adicionou"]) && $_GET["adicionou"] == 0): ?>
        <p class='alerta mensagem-falha'>
            Ocorreu algum erro de execução! <br>
            <strong><?php echo $_GET["erro"]; ?></strong>
        </p>
    <?php endif; ?>
    <form id="frmFilme" action="<?php echo $action; ?>" method="<?php echo $method; ?>" enctype="multipart/form-data">
        <input type="hidden" name="imagem" id="imagem">
        <input type="hidden" name="premios" id="premios">
        <input type="hidden" id="existeDiretor">
        <?php if(!$modoPesquisa): ?>
        <div class="form-box">
            <label for="arquivo">Imagem de divulgação</label><br>
            <input type="file" name="arquivo">
        </div>
        <?php endif; ?>
        <div class="form-box">
            <label for="filme">Nome do Filme</label><br>
            <input type="text" name="filme" id="filme" class="field field-large" autofocus>
        </div>
        <div class="form-box form-side">
            <label for="genero">Gênero</label><br>
            <select name="genero" id="genero" class="field field-large">
                <option>Selecione</option>
                <?php foreach($listaGeneros as $genero): ?>
                    <option value="<?php echo $genero->getId(); ?>"><?php echo $genero->getNome(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-box">
            <label for="ano">Ano de Lançamento</label><br>
            <input type="text" name="ano" id="ano" class="field field-tinySmall">
        </div>
        <div class="form-box">
            <label for="estudio">Estúdio/Produtora</label><br>
            <select name="estudio" id="estudio" class="field" style="width:68.5%">
                <option>Selecione</option>
                <?php foreach($listaEstudios as $estudio): ?>
                    <option value="<?php echo $estudio->getId(); ?>"><?php echo $estudio->getNome(); ?></option>
                <?php endforeach; ?>
                <option>Outro</option>
            </select>
            <input type="<?php echo $inputNaoEncontrei;?>" id="naoEncontrei" class="button button-alter"
                   value="Não Encontrei">
        </div>
        <div class="form-box novoEstudio">
            <label for="novoEstudio">Cadastrar novo Estúdio</label><br>
            <input type="text" id="novoEstudio" name="novoEstudio" class="field field-large">
        </div>
        <div class="form-box form-side">
            <label for="diretor">Diretor</label><br>
            <input type="text" id="diretor" name="diretor" class="field field-large" style="width:87%">
        </div>
        <div class="form-box">
            <label for="classificacao">Classificação Indicativa</label><br>
            <input type="text" id="classificacao" name="classificacao" class="field field-tinySmall" style="width:18%">
        </div>
        <div class="form-box form-side">
            <label for="duracao">Duração(em minutos)</label><br>
            <input type="text" id="duracao" name="duracao" class="field field-small" style="width:87%">
        </div>
        <div class="form-box">
            <label for="dataEstreia">Data de Estreia</label><br>
            <input type="text" id="dataEstreia" name="dataEstreia" class="field field-tinySmall" style="width:18%">
        </div>
        <div class="form-box">
            <label for="avaliacao"><?php echo $labelIMBD; ?></label><br>
            <input type="text" id="avaliacao" name="avaliacao" class="field field-tinySmall">
        </div>
        <div class="form-box">
            <label for="sinopse">Sinopse</label><br>
            <textarea id="sinopse" name="sinopse" class="field field-large" rows="4"></textarea>
        </div>
        <div class="form-box">
            <button type="submit" class="button button-info"><?php echo $buttonSubmit; ?></button>
            <button type="reset" class="button button-warning">Resetar</button>
            <button type="button" id="btnCancelar" class="button button-error">Cancelar</button>
        </div>
    </form>
</div>

