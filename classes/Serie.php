<?php
/*
 * Classe que representa uma Série
 */
require_once("Temporada.php");
class Serie extends Obra {
    private $anoEstreia;
    private $temporadas;
    private $temporadasObj;
    private $diasRestantes;
    /*Magic Methods*/
    public function __construct($serie="",$ano="",$temporadas="",$classificacao=""){
        $this->setNome($serie);
        $this->setAnoEstreia($ano);
        $this->setTemporadas($temporadas);
        $this->setClassificacao($classificacao);
        $this->setGenero(new Genero());
        $this->setTemporadasObj(new Temporada());
    }
    /*Getters e Setters*/
    function getAnoEstreia() {
        return $this->anoEstreia;
    }

    function getTemporadas() {
        return $this->temporadas;
    }

    function setAnoEstreia($anoEstreia) {
        $this->anoEstreia = $anoEstreia;
    }

    function setTemporadas($temporadas) {
        $this->temporadas = $temporadas;
    }
    public function getTemporadasObj() {
        return $this->temporadasObj;
    }

    public function setTemporadasObj($temporadasObj) {
        $this->temporadasObj = $temporadasObj;
    }

    public function getDiasRestantes(){
        return $this->diasRestantes;
    }

    public function setDiasRestantes($dias){
        $this->diasRestantes = $dias;
    }

}
