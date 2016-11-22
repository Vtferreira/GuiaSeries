<?php
/* 
 * Arquivo com verificações de parâmetros e respectivas mensagens
 */
?>
<?php
    if(isset($_GET["addUsuario"]) && $_GET["addUsuario"] == 1){
        $login = filter_input(INPUT_GET, "login");
?>
        <p class="alerta mensagem-sucesso">
            Cadastrado com sucesso!<br>
            Utilize o login <strong><?php echo $login; ?></strong> para logar!
        </p>
<?php
    }
?>
<?php 
    if(!isset($_GET["addUsuario"]) && !isset($_GET["excluiu"])){
?>
        <div class="form-box">
            <p>Primeiro acesso? Realize o <a href="form-usuario.php">cadastro!</a></p>
        </div>
<?php
}
?>
<?php
    if(isset($_GET["excluiu"]) && $_GET["excluiu"] == 1):
        $usuario = filter_input(INPUT_GET, "nome");
?>
        <p class="alerta mensagem-sucesso">
            Usuário <strong><?php echo $usuario; ?></strong> excluído com sucesso!
        </p>
<?php
    endif;
?>
<?php
    if(isset($_GET["falhaLogin"]) && $_GET["falhaLogin"] == 1){
?> 
        <p class="alerta mensagem-falha">
            Usuário ou senha incorretos!
        </p>
<?php
    }
  if(isset($_GET["deslogou"]) && $_GET["deslogou"] == 1){
      echo "<p class='alerta mensagem-sucesso'>Usuário deslogado com sucesso!</p>";
  }  
  if(isset($_GET["falhaSeguranca"]) && $_GET["falhaSeguranca"] == 1){
      echo "<p class='alerta mensagem-falha'>Você não tem acesso a essa funcionalidade!</p>";
  }




