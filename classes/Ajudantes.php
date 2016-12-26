<?php
/**
 * Classe com métodos que auxiliam o funcionamento do software.
 * Exemplos: formatação de data
**/
class Ajudantes {
    private $dataF;
    /*getters e setters*/
    public function getDataF(){
        return $this->dataF;
    }
    public function dateToAmerican($dataBrasil){
        $dataF = explode("/",$dataBrasil);
        $dataF = $dataF[2]."-".$dataF[1]."-".$dataF[0];
        $this->dataF = $dataF;
    }
    public function convertDateToAmerican($dataBrasil){
        $dataF = explode("/",$dataBrasil);
        $dataF = $dataF[2]."-".$dataF[1]."-".$dataF[0];
        return $dataF;
    }
    public function capturaCharSexo($strSexo){
       $strSexo = strtolower($strSexo);
       if($strSexo == "masculino"){
           return "m";
       }else{
           return "f";
       }
    }
}
