<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="js/jqueryUI/css/custom-theme/jquery-ui-1.10.4.custom.min.css">
<script type="text/javascript" src="js/jqueryUI/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/busca-filmes-series.js"></script>
<script type="text/javascript" src="js/series.js"></script>
<!-- ÁREA DO MENU !-->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">GuiaSeries</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li class="dropdown">
       		<a class="dropdown-toggle" data-toggle="dropdown" href="#">Minha Lista<span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="lista-filmes.php?listaPorUsuario=1&status=assistido">Filmes</a></li>
	            <li><a href="lista-series.php?listaPorUsuario=1&status=10">Séries</a></li>
              <li><a href="estatistica-filmes.php">Estatísticas Filmes</a></li>
	            <li><a href="estatistica-series.php">Estatísticas Séries</a></li>
	          </ul>
        </li>
       	<li class="dropdown">
       		<a class="dropdown-toggle" data-toggle="dropdown" href="#">Adicionar Novo<span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="form-genero.php">Gênero</a></li>
	            <li><a href="form-filme.php">Filme</a></li>
              <li><a href="form-serie.php">Série</a></li>
              <li><a href="form-temporada.php">Temporada</a></li>
	            <li><a href="form-episodio.php?criterio=s.nome">Episódio</a></li>
	          </ul>
        </li>
      	<li class="dropdown">
       		<a class="dropdown-toggle" data-toggle="dropdown" href="#">Listar<span class="caret"></span></a>
	          <ul class="dropdown-menu">
       				<li><a href="lista-filmes.php">Filmes</a></li>
                  <li><a href="lista-series.php">Séries</a></li>
	          </ul>
        </li>
        	<li class="dropdown">
       		<a class="dropdown-toggle" data-toggle="dropdown" href="#">Pesquisa<span class="caret"></span></a>
	          <ul class="dropdown-menu">
       				<li><a href="form-filme.php?opcao=pesquisa">Filmes</a></li>
                  <li><a href="form-serie.php?opcao=pesquisa">Séries</a></li>
	          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span>
        		<?php 
        			if($usuarioObj->estaLogado()): 
        				echo "<strong>{$usuarioObj->usuarioLogado()}</strong>";
        			endif;
        		?>
        </a></li>
        <li><a href="php/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- FIM DA ÁREA DO MENU !-->