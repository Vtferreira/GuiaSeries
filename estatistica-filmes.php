<?php
require_once("classes/Usuario.php");
require_once("classes/Obra.php");
require_once("classes/Genero.php");
require_once("classes/Estudio.php");
require_once("classes/Diretor.php");
require_once("classes/Filme.php");
require_once("banco/conexao.php");
require_once("banco/FilmeDAO.php");
$usuarioObj = new Usuario();
$usuarioObj->protegePagina();
$usuario_id = $_SESSION["idUsuario"];
$filmeDAO = new FilmeDAO($conexao);
$qtdFilmesArray = $filmeDAO->totalFilmePorGenero($usuario_id, "COUNT", "*");
$minutosFilmesArray = $filmeDAO->totalFilmePorGenero($usuario_id, "SUM", "f.duracao");
$filmeMaiorNota = $filmeDAO->consultaEstatistica($usuario_id, "f.avaliacaoIMBD DESC");
$filmeMenorNota = $filmeDAO->consultaEstatistica($usuario_id, "f.avaliacaoIMBD ASC");
$filmeMaisRecente = $filmeDAO->consultaEstatistica($usuario_id, "f.dataEstreia DESC");
$filmeMaisAntigo = $filmeDAO->consultaEstatistica($usuario_id, "f.dataEstreia ASC");
$filmeMaiorDuracao = $filmeDAO->consultaEstatistica($usuario_id, "f.duracao DESC");
$filmeMenorDuracao = $filmeDAO->consultaEstatistica($usuario_id, "f.duracao ASC");
$filmeObj = new Filme();
$filmeObj->setDataEstreia($filmeMaisRecente["dataEstreia"]);
$filmeObj2 = new Filme();
$filmeObj2->setDataEstreia($filmeMaisAntigo["dataEstreia"]);
?>
<title>GuiaSeries | Estatísticas</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<style type="text/css">
    .tabela-genero tr > td:first-child{
        width: 35%;
    }
    .tabela-genero tr > td:nth-child(2), .tabela-genero tr > td:nth-child(3){
        width: 5%;
    }
</style>
<script type="text/javascript" src="js/jquery-1.12.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- INÍCIO GOOGLE CHARTS !-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php require_once("js/graficos/total-genero-coluna.php"); ?>
<?php require_once("js/graficos/total-genero-pizza.php"); ?>
<?php require_once("js/graficos/total-minutos-pizza.php"); ?>
<!-- FIM GOOGLE CHARTS !-->
<div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">GuiaSeries</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Home</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Minha Lista
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="lista-filmes.php?listaPorUsuario=1&status=assistido">Filmes</a></li>
                        <li><a href="lista-series-usuario.php">Séries</a></li>
                        <li><a href="estatistica-filmes.php">Estatísticas</a></li> 
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Adicionar Novo
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="form-genero.php">Gênero</a></li>
                        <li><a href="form-filme.php">Filme</a></li>
                        <li><a href="form-serie.php">Série</a></li> 
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Listar
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="lista-filmes.php">Filmes</a></li>
                        <li><a href="lista-series.php">Séries</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Pesquisa
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="form-filme.php?opcao=pesquisa">Filmes</a></li>
                        <li><a href="lista-series.php">Séries</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <h1>Estatísticas - Filmes Assistidos</h1>
    <div class="panel panel-primary">
        <div class="panel-heading">Filmes por Gênero</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-striped table-bordered tabela-genero">
                        <tr>
                            <th>Gênero</th>
                            <th>Quantidade</th>
                            <th>Minutos</th>
                        </tr>
                        <?php foreach($qtdFilmesArray as $generoQtd): ?>
                            <tr>
                                <td><?php echo $generoQtd['nome']; ?></td>
                                <td><?php echo $generoQtd['total_genero']; ?></td>
                                <td><?php echo $generoQtd['total_minutos'];?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div class="col-md-4">
                    <div id="grafico_total_genero"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div id="grafico_total_genero_pizza"></div>
                </div>
                <div class="col-md-5">
                    <div id="grafico_minutos_pizza"></div>
                </div>
            </div>
        </div>
    </div>        
            <div class="panel panel-primary">
                <div class="panel-heading">Outras Estatísticas</div>
                <div class="panel-body">
                    <strong>Filme com a Maior Nota:</strong>
                    <a href="consulta-filme.php?id=<?php echo $filmeMaiorNota['id']; ?>">
                        <?php echo $filmeMaiorNota['nome']; ?>
                    </a>, Nota: <?php echo $filmeMaiorNota['avaliacaoIMBD'];?>
                    <br>
                    <strong>Filme com a Menor Nota:</strong>
                    <a href="consulta-filme.php?id=<?php echo $filmeMenorNota['id']; ?>">
                        <?php echo $filmeMenorNota['nome']; ?>
                    </a>, Nota: <?php echo $filmeMenorNota['avaliacaoIMBD']; ?>
                    <br>
                    <strong>Filme mais recente:</strong>
                    <a href="consulta-filme.php?id=<?php echo $filmeMaisRecente['id']; ?>">
                        <?php echo $filmeMaisRecente['nome']; ?>
                    </a>, estreou em <?php echo $filmeObj->mostraEstreiaBrasil(); ?>
                    <br>
                    <strong>Filme mais antigo:</strong>
                    <a href="consulta-filme.php?id=<?php echo $filmeMaisAntigo['id']; ?>">
                        <?php echo $filmeMaisAntigo['nome']; ?>
                    </a>, estreou em <?php echo $filmeObj2->mostraEstreiaBrasil() ?>
                    <br>
                    <strong>Filme com maior duração:</strong>
                    <a href="consulta-filme.php?id=<?php echo $filmeMaiorDuracao['id']; ?>">
                        <?php echo $filmeMaiorDuracao['nome']; ?></a>, 
                        com <?php echo $filmeMaiorDuracao['duracao']; ?> minutos
                    <br>
                    <strong>Filme com menor duração:</strong>
                    <a href="consulta-filme.php?id=<?php echo $filmeMenorDuracao['id']; ?>">
                        <?php echo $filmeMenorDuracao['nome']; ?></a>, 
                        com <?php echo $filmeMenorDuracao['duracao']; ?> minutos
                </div>
            </div>

</div>