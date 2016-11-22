<?php
/**
 * Classe de persistência (DAO) para um objeto Usuario
**/
/*
require_once("../classes/Usuario.php");
require_once("../classes/Ajudantes.php");*/
require_once("Armazenavel.php");
class UsuarioDAO implements Armazenavel{
    private $conexao;
    /*magic methods*/
    public function __construct($conexao) {
        $this->conexao = $conexao;
    }
    /*métodos*/
    public function alterar($usuario) {
        $id = $usuario->getId();
        $nome = mysqli_escape_string($this->conexao,$usuario->getNome());
        $email = mysqli_escape_string($this->conexao,$usuario->getEmail());
        $usuario->stringToCharSexo($usuario->getSexo());
        $sexo = $usuario->getSexo();
        $usuario->dateToAmerican($usuario->getDataNasc());
        $dataNasc = $usuario->getDataNasc();
        $senha = md5($usuario->getSenha());
        $query = "UPDATE usuarios SET nome='{$nome}',email='{$email}',sexo='{$sexo}',dataNasc='{$dataNasc}'"
        . ",senha='{$senha}' WHERE id={$id}";
        $resultado = mysqli_query($this->conexao, $query);
        return $resultado;
    }
    public function consultar($id) {
        $query = "SELECT * FROM usuarios WHERE id={$id}";
        $resultado = mysqli_query($this->conexao,$query);
        $usuario = mysqli_fetch_assoc($resultado);
        $usuarioObj = new Usuario($usuario['nome'], $usuario['email'], $usuario['sexo'], 
                $usuario['dataNasc'], $usuario['senha']);
        $usuarioObj->setId($usuario['id']);
        $usuarioObj->dateToBrazilian($usuario['dataNasc']);
        $usuarioObj->charToStringSexo($usuario['sexo']);
        return $usuarioObj;
    }
    public function deletar($id) {
        $query = "DELETE FROM usuarios WHERE id={$id}";
        $resultado = mysqli_query($this->conexao,$query);
        return $resultado;
    }
    public function inserir($usuario) {
        $ajudantesObj = new Ajudantes();
        $nome = mysqli_escape_string($this->conexao,$usuario->getNome());
        $email = mysqli_escape_string($this->conexao,$usuario->getEmail());
        $sexo = $ajudantesObj->capturaCharSexo($usuario->getSexo());
        $dataNasc = $usuario->getDataNasc();
        $ajudantesObj->dateToAmerican($dataNasc);
        $dataFormat = $ajudantesObj->getDataF();
        $senha = md5($usuario->getSenha());
        $query = "INSERT INTO usuarios (nome,email,sexo,dataNasc,senha) VALUES"
                . "('{$nome}','{$email}','{$sexo}','{$dataFormat}','{$senha}')";
        $resultado = mysqli_query($this->conexao, $query);
        return $resultado;
    }
    public function listar() {
        $listaUsuarios = array();
        $query = "SELECT *, ROUND(DATEDIFF(curdate(),dataNasc)/365,0) AS idade FROM usuarios ORDER BY nome";
        $resultado = mysqli_query($this->conexao, $query);
        while($array = mysqli_fetch_assoc($resultado)){
            $usuarioObj = new Usuario($array['nome'], $array['email'], $array['sexo'], 
                    $array['dataNasc'], $array['senha']);
            $usuarioObj->setId($array['id']);
            $usuarioObj->setIdade($array['idade']);
            array_push($listaUsuarios, $usuarioObj);
        }
        return $listaUsuarios;
    }
    public function listarJSON(){
        $array = $this->listar();
        $arrayJSON = array();
        $tamArray = count($array);
        for($i=0;$i<$tamArray;$i++){
            $arrayJSON[$i]["id"] = $array[$i]->getId();
            $arrayJSON[$i]["nome"] = $array[$i]->getNome();
            $arrayJSON[$i]["email"] = $array[$i]->getEmail();
            $arrayJSON[$i]["idade"] = $array[$i]->getIdade();
        }
        $usuarioJSON = json_encode($arrayJSON,JSON_UNESCAPED_UNICODE);
        return $usuarioJSON;
    }
    public function consultaLogin($usuario){
        $login = mysqli_escape_string($this->conexao, $usuario->getNome());
        $senha = $usuario->getSenha();
        $query = "SELECT * FROM usuarios WHERE nome='{$login}' AND senha=MD5('{$senha}')";
        $resultado = mysqli_query($this->conexao, $query);
        $array = mysqli_fetch_assoc($resultado);
        return $array;
    }
    /*Método de teste para envio de fotos*/
    public function insereUpload($nome,$imagem){
        if($imagem != NULL) { 
            $nomeFinal = time().'.jpg';
            if (move_uploaded_file($imagem['tmp_name'], $nomeFinal)) {
                $tamanhoImg = filesize($nomeFinal); 
                $mysqlImg = addslashes(fread(fopen($nomeFinal, "r"), $tamanhoImg)); 
                $query = "INSERT INTO usuario_teste (nome, imagem) VALUES ('{$nome}','$mysqlImg')";
                $resultado = mysqli_query($this->conexao,$query);
                unlink($nomeFinal);
                if($resultado){
                    header("Location: ../form-upload.php");
                }
            }
        } 
        else { 
            echo"Você não realizou o upload de forma satisfatória."; 
        } 
    }
    /*Método de teste para listagem de usuários com fotos*/
    public function listaUpload(){
        $query = "SELECT * FROM usuario_teste";
        $result= mysqli_query($this->conexao,$query);
        while($row=mysqli_fetch_object($result)) {
            echo "<img src='../php/getImagem.php?PicNum=$row->id' \">"; 
            echo $row->nome;
            echo "<br>";
        } 
    }
    public function consultaUpload($PicNum){
        echo $PicNum;
        $query = "SELECT * FROM usuario_teste WHERE id={$PicNum}";
        echo $query;
        $resultado = mysqli_query($this->conexao,$query);
        $row=mysql_fetch_object($result); 
        Header( "Content-type: image/jpg"); 
        echo $row->imagem; 
    }
}