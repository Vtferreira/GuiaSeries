<?php
/*
 * Classe que representa um Estudio, no qual produziu filmes
 */
class Estudio {
   private $id;
   private $nome;
   /*magic methods*/
   public function __construct($nome=""){
       $this->nome = $nome;
   }
   /*getters e setters*/
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
