<?php
/**
 * Classe que representa um Usuário.
 */
session_start();
class Usuario {
    private $id;
    private $nome;
    private $email;
    private $sexo;
    private $dataNasc;
    private $idade;
    private $senha;
    /*magic methods*/
    public function __construct($nome="",$email="",$sexo="m",$dataNasc="",$senha=""){
        $this->nome = $nome;
        $this->email = $email;
        $this->sexo = $sexo;
        $this->dataNasc = $dataNasc;
        $this->senha = $senha;
    }
    public function __toString(){
        $string = "Nome: ".$this->nome."<br>Email: ".$this->email."<br>Sexo: ".$this->sexo."<br>Data Nascimento:".
            $this->dataNasc."<br>Senha: ".$this->senha;
        return $string;
    }
    /*getters e setters*/
    public function getId(){
        return $this->id;
    }
    public function getNome() {
        return $this->nome;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getSexo() {
        return $this->sexo;
    }
    public function getDataNasc() {
        return $this->dataNasc;
    }
    public function getSenha() {
        return $this->senha;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }
    public function setDataNasc($dataNasc) {
        $this->dataNasc = $dataNasc;
    }
    public function setSenha($senha) {
        $this->senha = $senha;
    }
    public function getIdade() {
        return $this->idade;
    }

    public function setIdade($idade) {
        $this->idade = $idade;
    }
    /*métodos*/
    public function dateToBrazilian($dataAmerican){
        $dataExplode = explode("-", $dataAmerican);
        $this->dataNasc = $dataExplode[2]."/".$dataExplode[1]."/".$dataExplode[0];
    }
    public function dateToAmerican($dataBrasil){
        $dataExplode = explode("/",$dataBrasil);
        $this->dataNasc = $dataExplode[2]."-".$dataExplode[1]."-".$dataExplode[0];
    }
    public function charToStringSexo($char){
        $char = strtolower($char);
        if($char == "m"){
            $this->sexo = "Masculino";
        }else{
            $this->sexo = "Feminino";
        }
    }
    public function stringToCharSexo($string){
        $string = strtolower($string);
        if($string == "masculino"){
            $this->sexo = "m";
        }else{
            $this->sexo = "f";
        }
    }
    public function logaUsuario($usuarioLogado){
        $_SESSION["idUsuario"] = $usuarioLogado["id"];
        $_SESSION["login"] = $usuarioLogado["nome"];
    }
    public function estaLogado(){
        return isset($_SESSION["login"]);
    }
    public function usuarioLogado(){
        return $_SESSION["login"];
    }
    public function logout(){
        session_destroy();
    }
    public function protegePagina(){
        if(!$this->estaLogado()){
            header("Location: form-login.php?falhaSeguranca=1");
        }
    }
}
