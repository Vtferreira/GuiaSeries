<?php
/*
 * Representa o acesso a dados referente a um filme
 */
require_once("Armazenavel.php");
class FilmeDAO implements Armazenavel{
    private $conexao;
    /*Magic Methods - Construtor*/
    public function __construct($conexao){
        $this->conexao = $conexao;
    }
    public function alterar($filme) {
        
    }

    public function consultar($id) {
        $sql = "SELECT f.*,d.nome AS diretor_nome,e.nome As estudio_nome,g.nome AS genero_nome\n"
        . "FROM filmes f, diretores d, estudios e, generos g \n"
        . "WHERE f.diretor_id=d.id AND f.estudio_id=e.id AND f.genero_id=g.id\n"
        . "AND f.id={$id} LIMIT 1";
        $resultado = mysqli_query($this->conexao,$sql);
        $array = mysqli_fetch_assoc($resultado);
        $filmeObj = new Filme($array['nome'], $array['sinopse'], $array['avaliacaoIMBD'], $array['premios'], 
                $array['imagem']);
        $filmeObj->getDiretor()->setId($array['diretor_id']);
        $filmeObj->getDiretor()->setNome($array['diretor_nome']);
        $filmeObj->getEstudio()->setId($array['estudio_id']);
        $filmeObj->getEstudio()->setNome($array['estudio_nome']);
        $filmeObj->getGenero()->setId($array['genero_id']);
        $filmeObj->getGenero()->setNome($array['genero_nome']);
        $filmeObj->setClassificacao($array['classificacao']);
        $filmeObj->setDuracao($array['duracao']);
        $filmeObj->setDataEstreia($array['dataEstreia']);
        $filmeObj->setArquivo($array['arquivo']);
        return $filmeObj;
    }

    public function deletar($id) {
        
    }
    public function geraArquivoImg($filme){
        /*Tratamento de imagem gerada*/
        if(isset($_FILES["arquivo"])){
            $extensao = substr($_FILES["arquivo"]["name"], -4);
            $extensao = strtolower($extensao);
            $novo_nome = substr($filme->getNome(), 0,12).$filme->getDataEstreia().$extensao;
            $diretorio = "../imagens/";
            move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
            return $novo_nome;
        }
    }
    public function inserir($filme) {
        $diretor_id = $filme->getDiretor()->getId();
        $estudio_id = $filme->getEstudio()->getId();
        $genero_id = $filme->getGenero()->getId();
        $nome = mysqli_escape_string($this->conexao, $filme->getNome());
        //$nome = utf8_encode($nome);
        $classificacao = $filme->getClassificacao();
        $duracao = $filme->getDuracao();
        $sinopse = mysqli_escape_string($this->conexao,$filme->getSinopse());
        $avaliacaoIMBD = $filme->getAvaliacaoIMDB();
        $dataEstreia = $filme->getDataEstreia();
        $imagem = mysqli_escape_string($this->conexao,$filme->getEnderecoImagem());
        $premios = mysqli_escape_string($this->conexao,$filme->getPremios());
        $arquivo = utf8_encode($this->geraArquivoImg($filme));
        $query = "INSERT INTO 
        filmes (`diretor_id`, `estudio_id`, `genero_id`, `nome`, arquivo ,`classificacao`, `duracao`, "
                . "`sinopse`, `avaliacaoIMBD`, `dataEstreia`, `imagem`, `premios`) "
                . "VALUES ({$diretor_id},{$estudio_id},{$genero_id},'{$nome}','{$arquivo}','{$classificacao}'"
                . ",{$duracao},'{$sinopse}',{$avaliacaoIMBD},'{$dataEstreia}','{$imagem}','{$premios}')";
        $resultado = mysqli_query($this->conexao,$query);
        if(!resultado){
            return mysqli_error($this->conexao);
        }
        return $resultado;
    }

    public function listar(){
       $filmes = array();
       $sql = "SELECT f.*, d.nome AS 'diretor_nome', e.nome AS 'estudio_nome', g.nome AS 'genero_nome' \n"
    . "FROM filmes f, diretores d, estudios e, generos g \n"
    . "WHERE f.diretor_id=d.id AND f.estudio_id=e.id AND f.genero_id=g.id\n"
    . "ORDER BY avaliacaoIMBD DESC";
       $resultado = mysqli_query($this->conexao, $sql);
       while($array = mysqli_fetch_assoc($resultado)){
           $filmeObj = new Filme($array['nome'], $array['sinopse'], $array['avaliacaoIMBD'], 
                   $array['premios'], $array['imagem']);
           $filmeObj->setClassificacao($array['classificacao']);
           $filmeObj->setDuracao($array['duracao']);
           $filmeObj->setDataEstreia($array['dataEstreia']);
           $filmeObj->getDiretor()->setNome($array['diretor_nome']);
           $filmeObj->getEstudio()->setNome($array['estudio_nome']);
           $filmeObj->getGenero()->setNome($array['genero_nome']);
           array_push($filmes, $filmeObj);
       }
       return $filmes;
    }
    public function listarOrderBy($criterio,$filmeObj){
        $nomeFilmeObj = $filmeObj->getNome();
        $idFilmeObj = $filmeObj->getGenero()->getId();
        $anoFilmeObj = $filmeObj->getDataEstreia();
        $estudio_id = $filmeObj->getEstudio()->getId();
        $diretor = $filmeObj->getDiretor()->getNome();
        $avaliacaoFilmeObj = $filmeObj->getAvaliacaoIMDB();
        $filmes = array();
        $sql = "SELECT f.*, d.nome AS 'diretor_nome', e.nome AS 'estudio_nome', g.nome AS 'genero_nome' \n"
    . "FROM filmes f, diretores d, estudios e, generos g \n"
    . "WHERE f.diretor_id=d.id AND f.estudio_id=e.id AND f.genero_id=g.id\n";
        /*verifica se propriedades do objeto não estão vazias. Se não estiverem, concatena na query*/
        //SELECT * FROM filmes WHERE nome LIKE '%Batman%'
       if($nomeFilmeObj != ""){
           $sql = $sql . "AND f.nome LIKE '%{$nomeFilmeObj}%'\n";
       }
       if($idFilmeObj != ""){
           $sql = $sql . "AND genero_id={$idFilmeObj}\n";
       }
       if($anoFilmeObj != ""){
           $sql = $sql . "AND YEAR(dataEstreia)='{$anoFilmeObj}'\n";
       }
       if($estudio_id != ""){
           $sql = $sql . "AND estudio_id={$estudio_id}\n";
       }
       if($diretor != ""){
           $sql = $sql . "AND d.nome='{$diretor}'\n";
       }
       if($avaliacaoFilmeObj != ""){
           $sql = $sql . "AND f.avaliacaoIMBD >= {$avaliacaoFilmeObj}\n";
       }
       $sql = $sql . "ORDER BY {$criterio}\n";
       $resultado = mysqli_query($this->conexao, $sql);
       while($array = mysqli_fetch_assoc($resultado)){
           $filmeObj = new Filme($array['nome'], $array['sinopse'], $array['avaliacaoIMBD'], 
                $array['premios'], $array['imagem']);
           $filmeObj->setId($array['id']);
           $filmeObj->setClassificacao($array['classificacao']);
           $filmeObj->setDuracao($array['duracao']);
           $filmeObj->setDataEstreia($array['dataEstreia']);
           $filmeObj->setArquivo($array['arquivo']);
           $filmeObj->getDiretor()->setId($array['diretor_id']);
           $filmeObj->getDiretor()->setNome($array['diretor_nome']);
           $filmeObj->getEstudio()->setId($array['estudio_id']);
           $filmeObj->getEstudio()->setNome($array['estudio_nome']);
           $filmeObj->getGenero()->setId($array['genero_id']);
           $filmeObj->getGenero()->setNome($array['genero_nome']);
           array_push($filmes, $filmeObj);
       }
       return $filmes;
    }
    public function listarPagPrincipal(){
        $filmes = array();
        $query = "SELECT * FROM filmes WHERE YEAR(dataEstreia)='2016' ORDER BY avaliacaoIMBD DESC LIMIT 6";
        $resultado = mysqli_query($this->conexao,$query);
        while($array = mysqli_fetch_assoc($resultado)){
            $filmeObj = new Filme($array['nome'], $array['sinopse'], $array['avaliacaoIMBD'], 
                    $array['premios'], $array['imagem']);
            $filmeObj->setArquivo($array['arquivo']);
            array_push($filmes, $filmeObj);
            $filmeObj->setId($array['id']);
        }
        return $filmes;
    }
    public function listarJSON() {
        $array = $this->listar();
        $filmes = array();
        for($i=0;$i<count($array);$i++){
            $filmes[$i]["titulo"] = $array[$i]->getNome();
            $filmes[$i]["diretor"] = $array[$i]->getDiretor()->getNome();
        }
        $arquivoJSON = json_encode($filmes, JSON_UNESCAPED_UNICODE);
        return $arquivoJSON;
    }
    public function insereUsuarioFilme($vetor){
        /*VerificaFilmeUsuario()
            Se existir (diferente de nulo), chama função para excluir e inserir de novo      
         * Para "Não Assisti Ainda" APENAS excluir   
         */
        $sqlVerifica = "SELECT * FROM `usuariofilme` WHERE usuario_id = {$vetor["usuario_id"]} "
        . "AND filme_id = {$vetor["filme_id"]}";
        $resultadoVerifica = mysqli_query($this->conexao, $sqlVerifica);
        $verificaFilme = mysqli_fetch_assoc($resultadoVerifica);
        if($verificaFilme != NULL){
            $excluiu = $this->deletaFilmeUsuario($vetor["usuario_id"],$vetor["filme_id"]);
            echo $excluiu;
        }
        $query = "INSERT INTO usuariofilme(usuario_id, filme_id, status_filme) "
                . "VALUES ({$vetor["usuario_id"]},{$vetor["filme_id"]},'{$vetor["status_filme"]}')";
        $resultado = mysqli_query($this->conexao,$query);
        return $resultado;
    }
    public function listaUsuarioFilme($usuarioId,$criterio,$status){
        $filmes = array();
        $status = ucfirst($status);
        if($status != "Vou Assistir"){
            $status = "Assistido";
        }
        $query = "SELECT u.nome AS usuario_nome, f.*, e.nome AS estudio_nome ,"
        . "g.nome AS genero_nome, d.nome AS diretor_nome \n"
        . "FROM `usuariofilme` principal\n"
        . "JOIN usuarios u, filmes f, generos g, estudios e, diretores d\n"
        . "WHERE usuario_id = {$usuarioId} AND principal.usuario_id = u.id AND principal.filme_id = f.id \n"
        . "AND f.genero_id = g.id AND f.estudio_id = e.id AND f.diretor_id = d.id\n"
        . "AND principal.status_filme='{$status}'\n"
        . "ORDER BY {$criterio}";
        $resultado = mysqli_query($this->conexao,$query);
        while($array = mysqli_fetch_assoc($resultado)){
            $filmeObj = new Filme($array['nome'], $array['sinopse'], $array['avaliacaoIMBD'], 
                    $array['premios'], $array['imagem']);
            $filmeObj->setId($array['id']);
            $filmeObj->setClassificacao($array['classificacao']);
            $filmeObj->setDuracao($array['duracao']);
            $filmeObj->setDataEstreia($array['dataEstreia']);
            $filmeObj->setArquivo($array['arquivo']);
            $filmeObj->getDiretor()->setId($array['diretor_id']);
            $filmeObj->getDiretor()->setNome($array['diretor_nome']);
            $filmeObj->getEstudio()->setId($array['estudio_id']);
            $filmeObj->getEstudio()->setNome($array['estudio_nome']);
            $filmeObj->getGenero()->setId($array['genero_id']);
            $filmeObj->getGenero()->setNome($array['genero_nome']);
            array_push($filmes,$filmeObj);
        }
        return $filmes;
    }
    public function contaFilmes($usuario_id,$status){
        $query = "SELECT COUNT(*) AS total_filme FROM usuariofilme WHERE usuario_id={$usuario_id} "
        . "AND status_filme='{$status}'";
        $resultado = mysqli_query($this->conexao,$query);
        $contagem = mysqli_fetch_assoc($resultado);
        return $contagem;
    }
    /*Verifica se o filme está na lista do usuário*/
    public function verificaFilmeUsuario($usuario_id,$filme_id,$status){
        $query = "SELECT * FROM `usuariofilme` WHERE usuario_id = {$usuario_id} "
        . "AND filme_id = {$filme_id} AND status_filme = '{$status}'";
        $resultado = mysqli_query($this->conexao, $query);
        $array = mysqli_fetch_assoc($resultado);
        return $array; 
    }
    /*Realiza a exclusão de um relacionamento UsuarioFilme, excluindo o filme da lista do usuário*/
    public function deletaFilmeUsuario($usuario_id,$filme_id){
        $query = "DELETE FROM usuariofilme WHERE usuario_id = {$usuario_id} AND filme_id = {$filme_id}";
        $resultado = mysqli_query($this->conexao, $query);
        return $resultado;
    }
    public function deletaFilmePorStatus($vetor){
        if($vetor["status_filme"] == "naoAssisti"){
            $status_filme = "Assistido";
        }else{
            $status_filme = "Vou Assistir";
        }
        $query = "DELETE FROM usuariofilme WHERE usuario_id = {$vetor["usuario_id"]} "
        . "AND filme_id = {$vetor["filme_id"]} "
        . "AND status_filme = '{$status_filme}'";
        $resultado = mysqli_query($this->conexao, $query);
        return $resultado;
    }
    /*Realiza a consulta de totais por gênero. Exemplo: quantidade de filmes por gênero; total de minutos
        por gênero */
    public function totalFilmePorGenero($usuario_id){
        $generos = array();
        $ordenaPor = "total_genero DESC";
        $query = "SELECT g.id, g.nome, COUNT(*) AS total_genero, SUM(f.duracao) AS total_minutos \n"
            . "FROM usuariofilme principal, filmes f, generos g\n"
            . "WHERE principal.filme_id = f.id AND f.genero_id = g.id AND principal.usuario_id = {$usuario_id}\n"
            . "AND principal.status_filme = 'Assistido'\n"
            . "GROUP BY g.nome ORDER BY {$ordenaPor}";
        $resultado = mysqli_query($this->conexao,$query);
        echo mysqli_error($this->conexao);
        while($array = mysqli_fetch_assoc($resultado)){
            array_push($generos,$array);
        }
        return $generos;
    }
    /*Realiza estatísticas como verificar melhor nota, pior nota, maior duracao, menor duracao, estreia mais
        recente, estreia mais antiga, etc. */
    public function consultaEstatistica($usuario_id,$criterio){
        $query = "SELECT f.* FROM filmes f, usuariofilme principal \n"
        . "WHERE f.id = principal.filme_id \n"
        . "AND principal.status_filme = 'Assistido' \n"
        . "AND principal.usuario_id = {$usuario_id}\n"
        . "ORDER BY {$criterio} LIMIT 1";
        $resultado = mysqli_query($this->conexao,$query);
        $filme = mysqli_fetch_assoc($resultado);
        return $filme;
    }
}
