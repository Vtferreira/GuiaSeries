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
<!DOCTYPE html>
<html>
<head>
    <title>GuiaSeries | Estatísticas</title>
    <script type="text/javascript" src="js/jquery-1.12.1.min.js"></script>
    <?php require_once("include/cabecalho-bootstrap.php");?>
    <!-- INÍCIO GOOGLE CHARTS !-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <?php require_once("js/graficos/total-genero-coluna.php"); ?>
    <?php require_once("js/graficos/total-genero-pizza.php"); ?>
    <?php require_once("js/graficos/total-minutos-pizza.php"); ?>
    <!-- FIM GOOGLE CHARTS !-->
    <style type="text/css">
        .tabela-genero tr > td:first-child{
            width: 35%;
        }
        .tabela-genero tr > td:nth-child(2), .tabela-genero tr > td:nth-child(3){
            width: 5%;
        }
    </style>
</head>
<body>
    <div class="container">
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
</body>
</html>