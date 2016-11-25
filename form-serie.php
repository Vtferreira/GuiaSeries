<?php 
$tituloAba = "GuiaSeries | Serie";
// require_once("include/cabecalho.php"); 
require_once("classes/Usuario.php");
require_once("classes/Genero.php");
require_once("banco/conexao.php");
require_once("banco/GeneroDAO.php");
$usuarioObj = new Usuario();
$usuarioObj->protegePagina();
$generoDAO = new GeneroDAO($conexao);
$lista_generos = $generoDAO->listar();
/*Configuração de formulário*/
$titulo_form = "Cadastro de Séries";
$action = "php/adiciona-serie.php";
$txtBotao = "Salvar";
$modoPesquisa = false;
$metodo = "POST";
if(isset($_GET["opcao"]) && $_GET["opcao"] == "pesquisa"):
    $titulo_form = "Pesquisa de Série";
    $action = "lista-series.php";
    $txtBotao = "Pesquisar";
    $modoPesquisa = true;
    $metodo = "GET";
endif;
/**/
$tituloAba = "GuiaSeries | Série";
require_once("include/head-bootstrap.php");
require_once("include/body-bootstrap.php");
?>
<script type="text/javascript" src="js/series.js"></script>
<div class="container">
	<h1><?=$titulo_form?></h1>
	<form id="form-serie" action="<?=$action?>" method="<?=$metodo?>" enctype="multipart/form-data">
		<input type="hidden" name="premios" id="premios">
                <?php if(!$modoPesquisa): ?>
		<div class="form-group">
			<label for="arquivo">Imagem de Divulgação</label>
			<input type="file" name="arquivo" id="arquivo">
		</div>
                <?php endif; ?>
		<div class="row">
			<div class="col-md-4 col-sm-8">
				<div class="form-group">
					<label for="filme">Título da Série</label>
					<input type="text" name="filme" id="filme" class="form-control" autofocus>
				</div>
			</div>
        	<div class="col-md-4 col-sm-4">
				<div class="form-group">
					<label for="genero">Gênero</label>
					<select name="genero" id="genero" class="form-control">
						<option>Selecione</option>
						<?php foreach($lista_generos as $genero): ?>
							<option value="<?=$genero->getId()?>"><?=$genero->getNome()?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="col-md-2 col-sm-4">
		        <div class="form-group">
            		<label for="ano">Ano de Lançamento</label>
           			<input type="text" name="ano" id="ano" class="form-control">
        		</div>
        	</div>
        </div>
        <?php if(!$modoPesquisa): ?>
        <div class="row">
			<div class="col-md-2 col-sm-2">
		        <div class="form-group">
		        	<label for="total-temporadas">Total de Temporadas</label><br>
		        	<input type="text" name="total-temporadas" id="total-temporadas" class="form-control">
		        </div>
		    </div>
		    <div class="col-md-2 col-sm-4">
		        <div class="form-group">
		            <label for="classificacao">Classificação Indicativa</label><br>
		            <input type="text" id="classificacao" name="classificacao" class="form-control">
		        </div>
		    </div>
		    <div class="col-md-2">
    	        <div class="form-group">
            		<label for="duracao">Duração(em minutos)</label><br>
           	 		<input type="text" id="duracao" name="duracao" class="form-control">
        		</div>
		    </div>
		    <div class="col-md-2">
    	        <div class="form-group">
            		<label for="dataEstreia">Data de Estreia</label><br>
            		<input type="text" id="dataEstreia" name="dataEstreia" class="form-control">
        		</div>
		    </div>
		    <div class="col-md-2">
    	        <div class="form-group">
            		<label for="avaliacao">Avaliação IMDB</label><br>
            		<input type="text" id="avaliacao" name="avaliacao" class="form-control">
        		</div>
		    </div>
		</div>
		<div class="row">
			<div class="col-md-10">
		        <div class="form-group">
		            <label for="sinopse">Sinopse</label><br>
		            <textarea id="sinopse" name="sinopse" class="form-control" rows="4"></textarea>
		        </div>
		    </div>
		</div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary"><?=$txtBotao?></button>
        <button type="reset" class="btn btn-warning">Resetar</button>
        <button type="button" id="btnCancelar" class="btn btn-danger">Cancelar</button>
	</form>
</div>
<?php require_once("include/rodape-bootstrap.php"); ?>