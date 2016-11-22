<?php
/* 
 * Página acessível apenas para o administrador. Lista todos os usuários cadastrados.
 */
$tituloAba = "GuiaSeries | Admin";
require_once("include/cabecalho.php");
require_once("classes/Usuario.php");
require_once("banco/conexao.php");
require_once("banco/UsuarioDAO.php");
?>
<div class="container form">
    <?php
        $usuarioObj = new Usuario();
        $usuarioObj->protegePagina();
        $usuarioDAO = new UsuarioDAO($conexao);
        $arrayUsuarios = $usuarioDAO->listar();
        $usuarioDAO->listarJSON();
    ?>
    <h1>Tabela de Usuários</h1>
    <table id="tabelaUsuarios" class="tabela">
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Idade</th>
            <th></th>
            <th></th>
        </tr>
        <?php
        foreach($arrayUsuarios as $usuario):
        ?>
            <tr>
                <td><?php echo $usuario->getNome(); ?></td>
                <td><?php echo $usuario->getEmail(); ?></td>
                <td><?php echo $usuario->getIdade(). " anos"; ?></td>
                <td>
                    <form action="form-usuario.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $usuario->getId(); ?>">
                        <button type="submit" class="button button-alter">Alterar</button>
                    </form>
                </td>
                <td>
                    <form action="php/deleta-usuario.php" method="POST"> 
                        <input type="hidden" name="id" value="<?php echo $usuario->getId(); ?>">
                        <input type="hidden" name="nome" value="<?php echo $usuario->getNome(); ?>">
                        <button type="submit" class="button button-error">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php
        endforeach;
        ?>
    </table>
</div>
<?php require_once("include/rodape.php"); ?>

