<?php 
    $tituloAba = "Nome da Série | GuiaSeries";
    require_once("include/cabecalho.php");
    require_once("include/arquivosJS.php");
    require_once("include/scriptsJS.php");
?>
<div class="container geralSerie">
    <section class="fichaTecnica">
        <figure>
            <img src="">
        </figure>
        <h2>Once Upon a Time(1994)</h2>
        <p>
            Gênero: Comédia <br>
            Classificação: 12 anos <br>
            Estreia: 2005
        </p>
        <p>
            Duração: 22 minutos<br>
            Elenco: 
            <span class="atores">
            </span>
        </p>
    </section>
    <section class="sinopse">
        <h2>Sobre a série</h2>
        <p>
            Em 2030, o arquiteto Ted Mosby (Josh Radnor) conta a história sobre como conheceu a mãe dos seus filhos. Ele volta no tempo para 2005, relembrando suas aventuras amorosas em Nova York e a busca pela mulher dos seus sonhos. Ao longo do anos, Ted aproveita para falar a jornada dos seus amigos: o advogado Marshall Eriksen (Jason Segel), a professora Lily Aldrin (Alyson Hannigan), a jornalista Robin Scherbatsky (Cobie Smulders) e o mulherengo convicto Barney Stinson (Neil Patrick Harris).
        </p>
        <p>
            Prêmios: 
        </p>
    </section>
    <section class="elenco">
        <h2>Elenco</h2>
        <ul>
        </ul>
    </section>
    <section class="temporadas">
        <h2>Temporadas</h2>
        <form>	
            <label for="cmbTemporadas">Selecione:</label>
            <select id="cmbTemporadas">
                    <!-- Options geradas dinamicamente, via JSON e jQuery !-->
            </select>
        </form>
        <table id="tabelaEpisodios">
            <thead>
                <tr>
                    <th>Episódio</th>
                    <th>Nome do Episódio</th>
                    <th>Data de Lançamento</th>
                    <th>Nota IMBD</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </section>
</div>
<?php require_once("include/rodape.php");?>