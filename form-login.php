<?php 
    $tituloAba = "GuiaSeries | Login";
    require_once("include/cabecalho.php"); 
?>
<div class="container form"> 
    <h1>Login</h1>
    <?php
        require_once("verifica-mensagens.php");
    ?>
    <form action="php/login.php" method="POST">
        <div class="form-box">
            <label for="login">Login</label><br>
            <input type="text" name="login" id="login" class="field field-large" autofocus>
        </div>
        <div class="form-box">
            <label for="senha">Senha</label><br>
            <input type="password" name="senha" id="senha" class="field field-large">
        </div>
        <div class="form-box">
            <button type="submit" class="button button-info field-tinySmall">Entrar</button>
            <button type="button" class="button button-alter">Esqueci a Senha</button>
            <button type="button" id="voltar" class="button button-error field-tinySmall">Voltar</button>
        </div>
    </form>
</div>
<?php require_once("include/rodape.php"); ?>