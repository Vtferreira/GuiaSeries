<?php 
    $tituloAba = "GuiaSeries | Cadastre-se";
    require_once("include/cabecalho.php"); 
    require_once("include/arquivosJS.php");
    require_once("classes/Usuario.php");
    require_once("banco/conexao.php");
    require_once("banco/UsuarioDAO.php");
?>
<link rel="stylesheet" type="text/css" href="js/jqueryUI/css/custom-theme/jquery-ui-1.10.4.custom.min.css">
<script type="text/javascript" src="js/jquery-1.12.1.min.js"></script>
<script type="text/javascript" src="js/jqueryUI/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="js/datePickerBR.js"></script>
<script type="text/javascript" src="js/validacao.js"></script>
<script type="text/javascript" src="js/usuario.js"></script>
<div class="container form">
    <?php
        $tituloForm = "Cadastre-se";
        $action = "php/adiciona-usuario.php";
        $nome = "";
        $email = "";
        $sexo = "";
        $dataNasc = "";
        if(array_key_exists('id', $_POST) || isset($_GET['alteracao'])){
            $id = $_SESSION['idUsuario'];
            $usuarioDAO = new UsuarioDAO($conexao);
            $usuarioBusca = $usuarioDAO->consultar($id);
            $tituloForm = "Alterar Cadastro";
            $action = "php/altera-usuario.php";
            $nome = $usuarioBusca->getNome();
            $email = $usuarioBusca->getEmail();
            $sexo = $usuarioBusca->getSexo();
            $dataNasc = $usuarioBusca->getDataNasc();
        }
    ?>
    <h1><?php echo $tituloForm; ?></h1>
    <?php
    	/*verifica se a alteração foi realizada com sucesso */
        if(isset($_GET["alterou"]) && $_GET["alterou"] == 1){
            echo "<p class='alerta mensagem-sucesso'>Usuário alterado com sucesso!</p>";
        }
    ?>
    <input type="hidden" id="nomeValido" value="true">
    <input type="hidden" id="emailValido" value="true">
    <form action="<?php echo $action; ?>" id="formulario" method="POST">
        <input type="hidden" name="id" value="<?php if(isset($_SESSION['idUsuario'])){$_SESSION['idUsuario']; }?>">
        <div class="form-box">
            <label for="nome">Nome</label><br>
            <input type="text" name="nome" id="nome" class="field field-large" 
                   value="<?php echo $nome; ?>" autofocus>
        </div>
        <div class="form-box">
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" class="field field-large"
                   value="<?php echo $email; ?>" placeholder="email@exemplo.com">
        </div>
        <div class="form-box form-side">
            <label for="sexo">Sexo</label><br>
            <select name="sexo" id="cmbSexo" class="field field-large">
                <?php 
                    $vetSexo = array("Selecione","masculino","feminino");
                    foreach($vetSexo as $sexoEach):
                        $opcEscolhida = strtolower($sexo) == $sexoEach;
                        $selecao = $opcEscolhida?"selected = 'selected'":"";
                ?>
                        <option value="<?php echo strtolower($sexoEach) ?>" <?php echo $selecao; ?>>
                            <?php echo ucfirst($sexoEach); ?>
                        </option>
                <?php 
                    endforeach;
                ?>
            </select>
        </div>
        <div class="form-box">
            <label for="dataNasc">Data de Nascimento</label><br>
            <input type="text" name="dataNasc" id="dataNasc" class="field field-small"
                   value="<?php echo $dataNasc; ?>" maxlength="10">
        </div>
        <div class="form-box form-side">
            <label for="senha">Senha</label><br>
            <input type="password" name="senha" id="senha" class="field" style="width:60%">
        </div>
        <div class="form-box">
            <label for="confirmaSenha">Confirme a Senha</label><br>
            <input type="password" name="confirmaSenha" id="confirmaSenha" class="field field-small">
        </div>
        <div class="form-box">
            <button type="submit" id="enviar" class="button button-info">Enviar</button>
            <button type="reset" class="button button-warning">Resetar</button>
            <button type="button" id="btnCancelar" class="button button-error">Cancelar</button>
        </div>

    </form>
</div>
<?php require_once("include/rodape.php"); ?>