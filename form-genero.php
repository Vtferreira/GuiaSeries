<?php
/* 
 * Formulário para cadastrar um novo gênero, seja ele de um filme ou série.
 */
?>
<?php    
    $tituloAba = "GuiaSeries | Gênero";
    require_once("include/cabecalho.php"); 
    require_once("include/arquivosJS.php");
    require_once("classes/Usuario.php");
?>
<script type="text/javascript" src="js/validacao.js"></script>
<script type="text/javascript" src="js/genero.js"></script>
<div class="container form"> 
    <?php 
        $usuarioObj = new Usuario();
        $usuarioObj->protegePagina();
    ?>
    <h1>Cadastro de Gênero</h1>
    <input type="hidden" id="generoValido">
    <?php
        if(isset($_GET["inseriu"]) && $_GET["inseriu"] == 1){
            echo "<p class='alerta mensagem-sucesso'>Gênero adicionado com sucesso!</p>";
        }
        if(isset($_GET["inseriu"]) && $_GET["inseriu"] == 0){
            echo "<p class='alerta mensagem-falha'>Ocorreu alguma falha. Tente novamente<br>"
            . "{$_GET["erro"]}</p>";
        }
    ?>
    <form id="formulario" action="php/adiciona-genero.php" method="POST">
        <div class="form-box">
            <label for="genero">Gênero</label><br>
            <input type="text" name="genero" id="genero" class="field field-large" autofocus>
        </div>
        <div class="form-box">
            <button type="submit" class="button button-info field-tinySmall">Cadastrar</button>
            <button type="button" id="voltar" class="button button-error field-tinySmall">Voltar</button>
        </div>
    </form>
</div>
<?php require_once("include/rodape.php"); ?>

