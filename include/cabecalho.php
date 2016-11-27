<!DOCTYPE html>
<?php require_once("classes/Usuario.php"); ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title><?php echo $tituloAba; ?></title>
        <link rel="stylesheet" type="text/css" href="css/reset.css">
        <link rel="stylesheet" type="text/css" href="css/estilo.css">
        <!-- <link rel="stylesheet" type="text/css" href="css/serie.css"> -->
        <link rel="stylesheet" type="text/css" href="css/formulario.css">
        <link rel="stylesheet" type="text/css" href="css/tabelas.css">
        <link rel="stylesheet" type="text/css" href="css/mobile.css">
        <link rel="stylesheet" type="text/css" href="css/form-mobile.css">
        <link rel="stylesheet" type="text/css" href="css/custom-theme/jquery-ui-1.9.2.custom.css">
    </head>
    <body>
        <header class="container">
            <h1><img src="imagens/logoBlue.png" alt="Guia de Séries"></h1>
            <nav class="navbar-principal">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <?php if(isset($_SESSION['idUsuario'])): ?>
                    <li class="dropdown">
                        <a href="#" class="dropBtn">Agenda</a>
                        <div class="dropdown-content">
                            <a href="agenda.php">Geral</a><br>
                            <a href="agenda.php">Minha Agenda</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropBtn">Minha Lista</a>
                        <div class="dropdown-content">
                            <a href="lista-filmes.php?listaPorUsuario=1&status=assistido">Filmes</a><br>    
                            <a href="lista-series.php?listaPorUsuario=1&status=10">Séries</a><br>
                            <a href="estatistica-filmes.php">Estatísticas Filmes</a><br>
                            <a href="estatistica-series.php">Estatísticas Séries</a>
                        </div>
                    </li>
                    <?php endif; ?>
                    <li class="dropdown">
                        <a href="#" class="dropBtn">Adicionar Novo</a>
                        <div class="dropdown-content">
                            <a href="form-agenda.php">Agenda(Geral)</a><br>
                            <a href="form-genero.php">Gênero</a><br>    
                            <a href="form-filme.php">Filme</a><br>
                            <a href="form-serie.php">Série</a><br>
                            <a href="form-temporada.php?criterio=s.nome">Temporada</a><br>
                            <a href="form-episodio.php?criterio=s.nome">Episódio</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropBtn">Listar</a>
                        <div class="dropdown-content">   
                            <a href="lista-filmes.php">Filmes</a><br>
                            <a href="lista-series.php">Séries</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropBtn">Pesquisa</a>
                        <div class="dropdown-content">   
                            <a href="form-filme.php?opcao=pesquisa">Filmes</a><br>
                            <a href="form-serie.php?opcao=pesquisa">Séries</a>
                        </div>
                    </li>
                    <li class="right"><a href="">Contato</a></li>
                    <?php if (isset($_SESSION["idUsuario"]) && $_SESSION["idUsuario"] == 1): ?>
                        <li class="dropdown">
                            <a href="#" class="dropBtn">Admin</a>
                            <div class="dropdown-content">
                                <a href="admin-lista-usuarios.php">Usuários Cadastrados</a>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <p class="cadastro">
                <?php
                $usuarioObj = new Usuario();
                if ($usuarioObj->estaLogado()) {
                    ?>   
                    <a href="form-usuario.php?alteracao=1" class="usuarioLogado">Logado(a) 
                        como: <?php echo $usuarioObj->usuarioLogado(); ?></a>|<a href="php/logout.php" class="usuarioLogado">Logout</a>
                        <?php
                    } else {
                        ?>
                    <a href="form-usuario.php">Cadastro</a>|<a href="form-login.php">Entrar</a>
                    <?php
                }
                ?>
            </p>
        </header>