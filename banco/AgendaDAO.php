<?php
/*
 * Classe responsável por fazer o gerenciamento de banco de Dados referente a Agenda (Geral e de Usuário)
 */
require_once("Armazenavel.php");
require_once("php/ajudantes.php");
class AgendaDAO implements Armazenavel{
    private $conexao;
    /*Magic Methods - Construtor*/
    public function __construct($conexao){
        $this->conexao = $conexao;
    }

    public function alterar($item) {
        
    }

    public function consultar($agenda_id) {

    }

    public function deletar($id) {
        
    }
    public function geraArquivoImg($serie){
        /*Tratamento de imagem gerada*/
        if(isset($_FILES["arquivo"])){
            $extensao = substr($_FILES["arquivo"]["name"], -4);
            $extensao = strtolower($extensao);
            $novo_nome = substr($serie->getNome(), 0,12).$serie->getDataEstreia().$extensao;
            $diretorio = "../imagens-agenda/";
            move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
            return $novo_nome;
        }
    }
    public function inserir($objeto) {
        $arquivo = utf8_encode($this->geraArquivoImg($objeto));
        $genero_id = $objeto->getGenero()->getId();
        $titulo = mysqli_escape_string($this->conexao,$objeto->getNome());
        $sinopse = mysqli_escape_string($this->conexao,$objeto->getSinopse());
        $query = "INSERT INTO agenda(id, genero_id, dataEstreia, titulo, sinopse, arquivo) 
        VALUES (DEFAULT,{$genero_id},'{$objeto->getDataEstreia()}','{$titulo}','{$sinopse}','{$arquivo}')";
        $resultado = mysqli_query($this->conexao,$query);
        return $resultado;
    }

    public function listar() {
        $query = "SELECT a.id, a.genero_id, g.nome AS genero_nome, a.dataEstreia, DATEDIFF(dataEstreia, NOW()) AS dias_restantes ,a.titulo, a.sinopse, a.arquivo
            FROM agenda a INNER JOIN generos g ON a.genero_id = g.id
            WHERE a.dataEstreia >= NOW()";
        if(isset($_GET["tipoPesquisa"]) && $_GET["tipoPesquisa"] == 7){
            $query = $query."AND DATEDIFF(dataEstreia,NOW()) <= 7";
        }
        if(isset($_GET["tipoPesquisa"]) && $_GET["tipoPesquisa"] == 30){
            $query = $query."AND DATEDIFF(dataEstreia,NOW()) <= 30";
        }
        if(isset($_GET["tipoPesquisa"]) && $_GET["tipoPesquisa"] == "periodo"){
            $inicio = filter_input(INPUT_GET, 'dataInicio');
            $fim = filter_input(INPUT_GET, 'dataFim');
            $dataInicio = dateToAmerican($inicio);
            $dataFim = dateToAmerican($fim);
            $query = $query." AND a.dataEstreia >= '{$dataInicio}' AND a.dataEstreia <= '{$dataFim}'";
        }
        $query = $query. " ORDER BY dataEstreia ASC";
        $resultado = mysqli_query($this->conexao,$query);
        $agenda = array();
        $i = 0;
        while($linha = mysqli_fetch_assoc($resultado)){
            $serie = new Serie();
            $serie->setId($linha['id']);
            $serie->getGenero()->setId($linha['genero_id']);
            $serie->getGenero()->setNome($linha['genero_nome']);
            $serie->setDataEstreia($linha['dataEstreia']);
            $serie->setNome($linha['titulo']);
            $serie->setSinopse($linha['sinopse']);
            $serie->setArquivo($linha['arquivo']);
            $serie->setDiasRestantes($linha['dias_restantes']);
            array_push($agenda, $serie);
        }
        return $agenda;
    }

    public function listarJSON() {

    }
}
