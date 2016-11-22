<?php 
    require_once("classes/Genero.php");
    require_once("banco/conexao.php");
    require_once("banco/GeneroDAO.php");
    $generoDAO = new GeneroDAO($conexao);
    $listaGeneros = $generoDAO->listar();
?>
<div class="container destaque">	
    <section class="menu-categorias">
        <h2>Categorias</h2>
        <nav>
            <ul>
                <?php foreach($listaGeneros as $genero): ?>
                <li>
                    <a href="lista-filmes.php?genero_id=<?php echo $genero->getId(); ?>">
                        <?php echo $genero->getNome(); ?>
                    </a>
                </li>
                <?php endforeach; ?>
                <li>
                    <a href="lista-generos.php">
                        Mostrar Mais
                    </a>
                </li>
            </ul>
            
        </nav>
    </section>
</div>