<style type="text/css">
  #grafico_total_genero{
      margin-top: -1.1em;
      margin-left: -4em;
  }
</style>
<script type="text/javascript">
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawMultSeries);
function drawMultSeries() {
    var data = google.visualization.arrayToDataTable([
         ['Element', 'Qtd', { role: '#003366' }],
         <?php foreach($qtdFilmesArray as $filme_grafico):?>
             ['<?=$filme_grafico['nome']?>', <?=$filme_grafico['total_genero']?>, '#003366'],            
             /*
             ['Silver', 10.49, 'silver'],            // English color name
             ['Gold', 19.30, 'gold'],
             ['Platinum', 21.45, 'color: #e5e4e2' ], // CSS-style declaration*/
        <?php endforeach; ?>
      ]);

      var options = {
        title: 'Total de Filmes/Gênero',
        chartArea: {width: '70%'},
        width: 600,
        height: 500,
        hAxis: {
          title: 'Total de Filmes',
          minValue: 0
        },
        vAxis: {
          title: 'Gênero'
        }
      };

      var chart = new google.visualization.BarChart(document.getElementById('grafico_total_genero'));
      chart.draw(data, options);
}
</script>
