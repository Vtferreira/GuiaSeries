<?php
/*
 * Realiza as operações CRUD referentes a uma série
 */
require_once("conexao.php");
require_once("Armazenavel.php");
class SerieDAO implements Armazenavel {
    private $conexao;
    /*Magic Methods*/
    public function __construct($conexao){
        $this->conexao = $conexao;
    }
    public function alterar($objeto) {
        
    }

    public function consultar($serie_id) {
        $query = "SELECT g.nome AS genero_nome, s.* 
            FROM series s INNER JOIN generos g 
            ON s.genero_id = g.id
            WHERE s.id = {$serie_id}";
        $resultado = mysqli_query($this->conexao, $query);
        $linha = mysqli_fetch_assoc($resultado);
        $serieObj = new Serie($linha['nome'], $linha['anoEstreia'], $linha['totalTemporadas'], 
                    $linha['classificacao']);
        $serieObj->setId($linha['id']);
        $serieObj->getGenero()->setId($linha['genero_id']);
        $serieObj->getGenero()->setNome($linha['genero_nome']);
        $serieObj->setArquivo($linha['arquivo']);
        $serieObj->setDuracao($linha['duracao']);
        $serieObj->setAvaliacaoIMDB($linha['avaliacao']);
        $serieObj->setSinopse($linha['sinopse']);
        return $serieObj;
    }
    public function consultaPorNome($serie_nome){
        $query = "SELECT id FROM `series` WHERE nome = '{$serie_nome}'";
        $resultado = mysqli_query($this->conexao, $query);
        $linha = mysqli_fetch_assoc($resultado);
        return $linha;
    }
    public function deletar($id) {
        
    }
    public function insereTemporada($serie_id,$serie_nome,$total_temporadas){
        for($i = 1; $i <= $total_temporadas; $i++){
            $query = "INSERT INTO `temporadas`"
                    . "(`id`, `serie_id`, `nome`) "
                    . "VALUES (DEFAULT,{$serie_id},'{$serie_nome}_Temporada {$i}')";
            $resultado = mysqli_query($this->conexao, $query);
        }
    }
    public function insereTemporadaUnica($serie_id,$serie_nome,$temporada_numero){
        $query = "INSERT INTO `temporadas`"
                    . "(`id`, `serie_id`, `nome`) "
                    . "VALUES (DEFAULT,{$serie_id},'{$serie_nome}_Temporada {$temporada_numero}')";
        $resultado = mysqli_query($this->conexao, $query);
        return $resultado;
    }
    public function listaTemporadas($serie_id){
        $query = "SELECT * FROM `temporadas` WHERE serie_id = {$serie_id}";
        $resultado = mysqli_query($this->conexao,$query);
        $temporadas = array();
        $i = 0;
        while($linha = mysqli_fetch_assoc($resultado)){
            $temporadas[$i]['temporada_id'] = $linha['id'];
            $temporadas[$i]['serie_id'] = $linha['serie_id'];
            $temporadas[$i]['nome'] = $linha['nome'];
            $i++;
        }
        return $temporadas;
    }
    public function geraTemporadasJSON($array){
        $arquivo_json = json_encode($array);
        return $arquivo_json;
    }
    public function insereEpisodios($array){
        $nome = mysqli_escape_string($this->conexao, $array['nome']);
        $query = "INSERT INTO `episodios`(`id`, `temporada_id`, `numero_ep`, `nome`, `lancamento`, `avaliacao`) "
                . "VALUES (DEFAULT,{$array['temporada_id']},{$array['numero_ep']},'{$nome}'"
                . ",'{$array['lancamento']}',{$array['avaliacao']})";
        $resultado = mysqli_query($this->conexao,$query);
        return $resultado;
    }
    public function listaEpisodios($temporada_id){
        $query = "SELECT * FROM `episodios` WHERE temporada_id = {$temporada_id} ORDER BY numero_ep";
        $resultado = mysqli_query($this->conexao,$query);
        $episodios = array();
        $i = 0;
        while($linha = mysqli_fetch_assoc($resultado)){
            $episodios[$i]['episodio_id'] = $linha['id'];
            $episodios[$i]['episodio_numero'] = $linha['numero_ep'];
            $episodios[$i]['episodio_nome'] = $linha['nome'];
            $episodios[$i]['episodio_data'] = $linha['lancamento'];
            $episodios[$i]['episodio_avaliacao'] = $linha['avaliacao'];
            $i++;
        }
        return $episodios;
    }
    public function consultaUltimoEpisodio($temporada_id){
        $query = "SELECT MAX(numero_ep) AS ultimo_episodio FROM episodios WHERE temporada_id = {$temporada_id}";
        $resultado = mysqli_query($this->conexao,$query);
        $ultimo_episodio = mysqli_fetch_assoc($resultado);
        return $ultimo_episodio;
    }
    public function geraArquivoImg($serie){
        /*Tratamento de imagem gerada*/
        if(isset($_FILES["arquivo"])){
            $extensao = substr($_FILES["arquivo"]["name"], -4);
            $extensao = strtolower($extensao);
            $novo_nome = substr($serie->getNome(), 0,12).$serie->getAnoEstreia().$extensao;
            $diretorio = "../imagens-serie/";
            move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
            return $novo_nome;
        }
    }
    public function inserir($serie) {
        $arquivo = utf8_encode($this->geraArquivoImg($serie));
        $nome = mysqli_escape_string($this->conexao, $serie->getNome());
        $sinopse = mysqli_escape_string($this->conexao,$serie->getSinopse());
        $query = 
        "INSERT INTO series(id, genero_id, nome, arquivo, classificacao, duracao, anoEstreia, "
                . "avaliacao, totalTemporadas, sinopse) "
                . "VALUES (DEFAULT,{$serie->getGenero()->getId()},'{$nome}'"
                . ",'{$arquivo}','{$serie->getClassificacao()}','{$serie->getDuracao()}',"
                . "'{$serie->getAnoEstreia()}',{$serie->getAvaliacaoIMDB()},{$serie->getTemporadas()},"
                . "'{$sinopse}')";
        $resultado = mysqli_query($this->conexao, $query);
        return $resultado;
    }

    public function listar($principal = "") {
        $query = "SELECT g.nome AS genero_nome, s.* 
            FROM series s INNER JOIN generos g
            ON s.genero_id = g.id WHERE g.nome <> ''";
        /*Filtragem de campos para a pesquisa*/
        $ordenacao = "s.avaliacao DESC";
        if(isset($_POST['criterio'])){
            $ordenacao = filter_input(INPUT_POST, 'criterio');
        }
        if(isset($_GET['criterio'])){
            $ordenacao = filter_input(INPUT_GET, 'criterio');    
        }
        if(isset($_GET['filme']) && $_GET['filme'] != ""){
            $serie = filter_input(INPUT_GET,'filme');
            $query = $query." AND s.nome LIKE '%{$serie}%'";
        }
        if(isset($_GET['genero']) && $_GET['genero'] != "Selecione"){
            $genero = filter_input(INPUT_GET,'genero');
            $query = $query. " AND s.genero_id = {$genero}";
        }
        if(isset($_GET['ano']) && $_GET['ano'] != ""){
            $ano = filter_input(INPUT_GET, 'ano');
            $query = $query." AND s.anoEstreia = {$ano}";
        }
        $query = $query." ORDER BY {$ordenacao}";
        //echo $query;
        if($principal != ""){
            $query = $query." LIMIT 6";
        }
        $resultado = mysqli_query($this->conexao, $query);
        $series = array();
        while($linha = mysqli_fetch_assoc($resultado)){
            $serieObj = new Serie($linha['nome'], $linha['anoEstreia'], $linha['totalTemporadas'], 
                    $linha['classificacao']);
            $serieObj->setId($linha['id']);
            $serieObj->getGenero()->setId($linha['genero_id']);
            $serieObj->getGenero()->setNome($linha['genero_nome']);
            $serieObj->setArquivo($linha['arquivo']);
            $serieObj->setDuracao($linha['duracao']);
            $serieObj->setAvaliacaoIMDB($linha['avaliacao']);
            $serieObj->setSinopse($linha['sinopse']);
            array_push($series, $serieObj);
        }
        return $series;
    }

    public function listarJSON() {
        $query = "SELECT nome FROM series ORDER BY nome";
        $resultado = mysqli_query($this->conexao,$query);
        $series = array();
        $i = 0;
        while($linha = mysqli_fetch_assoc($resultado)){
            $series[$i]['nome'] = $linha['nome'];
            $i++;
        }
        $arquivoJSON = json_encode($series);
        echo $arquivoJSON;
    }

}
