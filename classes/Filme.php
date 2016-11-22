<?php

/*
 * Classe que representa um Filme. Herda atributos e métodos de Obra; sobrescreve o método transforma estreia.
 */
class Filme extends Obra {
    private $estudio;
    private $diretor;
    /*magic methods*/
    public function __construct($nome='',$sinopse='',$avaliacaoIMBD=0,$premios='',$imagem=''){
        $this->setNome($nome);
        $this->setSinopse($sinopse);
        $this->setAvaliacaoIMDB($avaliacaoIMBD);
        $this->setPremios($premios);
        $this->setEnderecoImagem($imagem);
        $this->setGenero(new Genero());
        $this->setEstudio(new Estudio());
        $this->setDiretor(new Diretor());
    }
    /*métodos*/
    public function transformaEstreia() {
        /*27 Nov 2013 -> transformar para 2013-11-27*/
        $estreiaExplode = explode(" ",$this->getDataEstreia());
        $dia = $estreiaExplode[0];
        $mes = $estreiaExplode[1];
        $ano = $estreiaExplode[2];
        $arrayMeses = array();
        $arrayMeses[1] = "Jan";
        $arrayMeses[2] = "Feb";
        $arrayMeses[3] = "Mar";
        $arrayMeses[4] = "Apr";
        $arrayMeses[5] = "May";
        $arrayMeses[6] = "Jun";
        $arrayMeses[7] = "Jul";
        $arrayMeses[8] = "Aug";
        $arrayMeses[9] = "Sep";
        $arrayMeses[10] = "Oct";
        $arrayMeses[11] = "Nov";
        $arrayMeses[12] = "Dec";
        for($i=1;$i <= 12; $i++){
            if($mes == $arrayMeses[$i]){
                $mes = $i;
            }
        }
        if(strlen($mes) == 1){
            $mes = "0".$mes;
        }
        $dataAmerican = $ano."-".$mes."-".$dia;
        $this->setDataEstreia($dataAmerican);
    }
    public function mostraAnoEstreia(){
        $estreiaExplode = explode("-", $this->getDataEstreia());
        $ano = $estreiaExplode[0];
        return $ano;
    }
    /*getters e setters*/
    public function getEstudio() {
        return $this->estudio;
    }

    public function getDiretor() {
        return $this->diretor;
    }

    public function setEstudio($estudio) {
        $this->estudio = $estudio;
    }

    public function setDiretor($diretor) {
        $this->diretor = $diretor;
    }


}
