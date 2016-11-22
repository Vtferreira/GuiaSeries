<?php
/*
 * Representa uma Obra. No caso da aplicação, uma Obra é um Filme ou Série.
 */
abstract class Obra {
   private $id;
   private $nome;
   private $classificacao;
   private $duracao;
   private $dataEstreia;
   private $sinopse;
   private $avaliacaoIMDB;
   private $premios;
   private $enderecoImagem;
   private $arquivo;
   private $genero; /*Atributos de relacionamento*/
   /*métodos*/
   public function transformaClassificacao(){
       if($this->classificacao == "Livre"){
           $this->classificacao = "LV";
       }else{
           $this->classificacao = substr($this->classificacao, 0, 2);
       }
   }
   public function transformaDuracao(){
       $this->duracao = substr($this->duracao, 0, 3);
   }
   public function transformaEstreia(){
       return $this->dataEstreia;
   }
   public function mostraClassificacao(){
      if($this->classificacao == "LV"){
          $classificacao = "Livre";
      }else{
          $classificacao = $this->classificacao." anos";
      }
      return $classificacao;
   }
   function mostraEstreiaBrasil(){
     $arrayEstreia = explode("-",$this->dataEstreia);
     $stringEstreia = $arrayEstreia[2]."/".$arrayEstreia[1]."/".$arrayEstreia[0];
     return $stringEstreia;
   }
   /*getters e setters*/
   public function getId() {
       return $this->id;
   }

   public function getNome() {
       return $this->nome;
   }

   public function getClassificacao() {
       return $this->classificacao;
   }

   public function getDuracao() {
       return $this->duracao;
   }

   public function getDataEstreia() {
       return $this->dataEstreia;
   }

   public function getSinopse() {
       return $this->sinopse;
   }

   public function getAvaliacaoIMDB() {
       return $this->avaliacaoIMDB;
   }

   public function getPremios() {
       return $this->premios;
   }

   public function getEnderecoImagem() {
       return $this->enderecoImagem;
   }

   public function getGenero() {
       return $this->genero;
   }
   public function getArquivo(){
      return $this->arquivo;
   }
   public function setId($id) {
       $this->id = $id;
   }

   public function setNome($nome) {
       $this->nome = $nome;
   }

   public function setClassificacao($classificacao) {
       $this->classificacao = $classificacao;
   }

   public function setDuracao($duracao) {
       $this->duracao = $duracao;
   }

   public function setDataEstreia($dataEstreia) {
       $this->dataEstreia = $dataEstreia;
   }

   public function setSinopse($sinopse) {
       $this->sinopse = $sinopse;
   }

   public function setAvaliacaoIMDB($avaliacaoIMDB) {
       $this->avaliacaoIMDB = $avaliacaoIMDB;
   }

   public function setPremios($premios) {
       $this->premios = $premios;
   }

   public function setEnderecoImagem($enderecoImagem) {
       $this->enderecoImagem = $enderecoImagem;
   }
   
   public function setArquivo($arquivo){
      $this->arquivo = $arquivo;
   }

   public function setGenero($genero) {
       $this->genero = $genero;
   }

}
