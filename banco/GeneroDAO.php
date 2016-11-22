<?php
/*
 * Classe responsável pelo acesso a dados (DAO) relacionado a um gênero
 */
require_once("Armazenavel.php");
class GeneroDAO implements Armazenavel{
    private $conexao;
    /*Magic Methods*/
    public function __construct($conexao){
        $this->conexao = $conexao;
    }
    public function alterar($genero) {
        
    }
    public function consultar($id) {
        
    }
    public function deletar($id) {
        
    }
    public function inserir($genero) {
        $nomeGenero = mysqli_escape_string($this->conexao, $genero->getNome());
        $query = "INSERT INTO generos(nome) VALUES ('{$nomeGenero}')";
        echo $query;
        $resultado = mysqli_query($this->conexao, $query);
        return $resultado;
    }
    public function listar() {
        $generos = array();
        $query = "SELECT * FROM generos ORDER BY nome";
        $resultado = mysqli_query($this->conexao,$query);
        while($array = mysqli_fetch_assoc($resultado)){
            $generoObj = new Genero($array['nome']);
            $generoObj->setId($array['id']);
            array_push($generos, $generoObj);
        }
        return $generos;
    }
    public function listarLimit(){
        $generos = array();
        $query = "SELECT * FROM generos ORDER BY nome LIMIT 12";
        $resultado = mysqli_query($this->conexao,$query);
        while($array = mysqli_fetch_assoc($resultado)){
            $generoObj = new Genero($array['nome']);
            $generoObj->setId($array['id']);
            array_push($generos, $generoObj);
        }
        return $generos;
    }
    public function listarJSON() {
        $array = $this->listar();
        $tamArray = count($array);
        $arrayJSON = array();
        for($i=0;$i<$tamArray;$i++){
            $arrayJSON[$i]["id"] = $array[$i]->getId();
            $arrayJSON[$i]["nome"] = $array[$i]->getNome();
        }
        $generoJSON = json_encode($arrayJSON);
        return $generoJSON;
    }
}
