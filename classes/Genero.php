<?php
/*
 * Classe que representa um gênero para um filme ou série
 */
class Genero {
    private $id;
    private $nome;
    /*Magic Methods*/
    public function __construct($genero=""){
        $this->nome = $genero;
    }
    public function __toString(){
        $string = "Id: ".$this->id."<br>Nome".$this->nome;
        return $string;
    }
    /*Getters e Setters*/
    public function getId() {
        return $this->id;
    }
    public function getNome() {
        return $this->nome;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function setNome($nome) {
        $this->nome = $nome;
    }
}
