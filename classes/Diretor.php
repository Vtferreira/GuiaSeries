<?php
/*
 * Representa um diretor associado a um filme
 */
class Diretor {
    private $id;
    private $nome;
    /*Magic Methods*/
    public function __construct($nome=""){
        $this->nome = $nome;
    }
    public function __toString(){
        $string = $this->id." - ".$this->nome;
        return $string;
    }
    /*Getters e Setters*/
    public function getId(){
        return $this->id;
    }
    public function getNome(){
        return $this->nome;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }
}
