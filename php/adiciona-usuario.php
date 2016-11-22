<?php
/* 
 * Página PHP que adiciona, na tabela Usuario, um usuario com os dados informados em
    form-usuario.php. Por tratar-se de adição/atualização, é usado o metódo POST
 */
require_once("../banco/conexao.php");
require_once("../classes/Usuario.php");
require_once("../classes/Ajudantes.php");
require_once("../banco/UsuarioDAO.php");
$nome = filter_input(INPUT_POST,"nome");
$email = filter_input(INPUT_POST,"email");
$sexo = filter_input(INPUT_POST,"sexo");
$dataNasc = filter_input(INPUT_POST, "dataNasc");
$senha = filter_input(INPUT_POST, "senha");
$usuarioObj = new Usuario($nome, $email, $sexo, $dataNasc, $senha);
$usuarioDAO = new UsuarioDAO($conexao);
$resultado = $usuarioDAO->inserir($usuarioObj);
if($resultado){
    header("Location: ../form-login.php?addUsuario=1&login=".$nome);
}else{
    $msgErro = mysqli_error($conexao);
    header("Location: ../form-login.php?addUsuario=0&erro=".$msgErro);
    /*
    $msgErro = mysqli_error($conexao);
    echo "Não rolou :(";
    echo "<br>".$msgErro;*/
}