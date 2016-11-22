<?php
/*
 * Classe de persistência a dados para um Estudio de filmes
 */
require_once("Armazenavel.php");
class EstudioDAO implements Armazenavel{
    private $conexao;
    /*magic methods - construtor*/
    public function __construct($conexao){
        $this->conexao = $conexao;
    }
    public function alterar($estudio) {
        
    }
    public function consultar($estudio) {
        $query = "SELECT * FROM estudios WHERE nome='{$estudio}'";
        $resultado = mysqli_query($this->conexao,$query);
        $array = mysqli_fetch_assoc($resultado);
        $estudioObj = new Estudio($array['nome']);
        $estudioObj->setId($array['id']);
        return $estudioObj;
    }
    public function consultarNomeJSON($nome){
        $query = "SELECT * FROM estudios where nome='{$nome}'";
        $resultado = mysqli_query($this->conexao, $query);
        $array = mysqli_fetch_assoc($resultado);
        $arrayJSON = array();
        $arrayJSON[0]["id"] = $array["id"];
        $arrayJSON[0]["nome"] = $array["nome"];
        $estudioJSON = json_encode($arrayJSON);
        return $estudioJSON;
    }
    public function deletar($id) {
        
    }
    public function inserir($estudio) {
        $nomeEstudio = mysqli_escape_string($this->conexao,$estudio->getNome());
        $query = "INSERT INTO estudios(nome) VALUES ('{$nomeEstudio}')";
        $resultado = mysqli_query($this->conexao, $query);
        return $resultado;
    }
    public function listar() {
        $listaEstudios = array();
        $query = "SELECT * FROM estudios ORDER BY nome";
        $resultado = mysqli_query($this->conexao,$query);
        while($array = mysqli_fetch_assoc($resultado)){
            $estudioObj = new Estudio($array['nome']);
            $estudioObj->setId($array['id']);
            array_push($listaEstudios, $estudioObj);
        }
        return $listaEstudios;
    }
    public function listarJSON() {
        $listaEstudios = array();
        $query = "SELECT * FROM estudios ORDER BY nome";
        $resultado = mysqli_query($this->conexao,$query);
        while($array = mysqli_fetch_assoc($resultado)){
            $estudioObj = new Estudio($array['nome']);
            $estudioObj->setId($array['id']);
            array_push($listaEstudios, $estudioObj);
        }
        $tamArray = count($listaEstudios);
        $arrayJSON = array();
        for($i=0;$i<$tamArray;$i++){
            $arrayJSON[$i]["id"] = $listaEstudios[$i]->getId();
            $arrayJSON[$i]["nome"] = $listaEstudios[$i]->getNome();
        }
        $estudioJSON = json_encode($arrayJSON);
        return $estudioJSON;
    }
}
