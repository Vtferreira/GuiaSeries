<?php
/*
 * Classe responsável por fazer o gerenciamento de banco de Dados de Diretores
 */
require_once("Armazenavel.php");
class DiretorDAO implements Armazenavel{
    private $conexao;
    /*Magic Methods - Construtor*/
    public function __construct($conexao){
        $this->conexao = $conexao;
    }

    public function alterar($diretor) {
        
    }

    public function consultar($nomeDiretor) {
        $query = "SELECT * FROM diretores WHERE nome='{$nomeDiretor}'";
        $resultado = mysqli_query($this->conexao, $query);
        $array = mysqli_fetch_assoc($resultado);
        $diretorObj = new Diretor($array['nome']);
        $diretorObj->setId($array['id']);
        return $diretorObj;
    }

    public function deletar($id) {
        
    }

    public function inserir($diretor) {
        $nome = mysqli_escape_string($this->conexao, $diretor->getNome());
        $query = "INSERT INTO diretores (nome) VALUES ('{$nome}')";
        $resultado = mysqli_query($this->conexao,$query);
        return $resultado;
    }

    public function listar() {
        $diretores = array();
        $query = "SELECT * FROM diretores ORDER BY nome";
        $resultado = mysqli_query($this->conexao, $query);
        while($array = mysqli_fetch_assoc($resultado)){
            $diretorObj = new Diretor($array['nome']);
            $diretorObj->setId($array['id']);
            array_push($diretores, $diretorObj);
        }
        return $diretores;
    }

    public function listarJSON() {
        $diretores = $this->listar();
        $diretoresJSON = array();
        for($i=0;$i < count($diretores); $i++){
            $diretoresJSON[$i]['id'] = $diretores[$i]->getId();
            $diretoresJSON[$i]['nome'] = $diretores[$i]->getNome();
        }
        $jsonFinal = json_encode($diretoresJSON);
        return $jsonFinal;
    }
}
