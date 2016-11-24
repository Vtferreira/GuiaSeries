<style type="text/css">
    #grafico-barra-temporada{
/*        margin-left: -2.3em;
        margin-top: -1em;*/
    }
</style>
<script type="text/javascript">
  google.charts.load('current', {packages: ['corechart', 'bar']});
  google.charts.setOnLoadCallback(drawBasic);
  function drawBasic() {
        var data = google.visualization.arrayToDataTable([
          ['Gênero', 'Quantidade'],
          <?php foreach($generos as $genero): ?>
          ['<?=$genero['genero_nome']?>', <?=$genero['total_episodios']?>],
          <?php endforeach; ?>
        ]);
        var options = {
          title: 'Episódios por Gênero',
          chartArea: {width: '55%'},
          width: 550,
          height: 450,
          hAxis: {
            title: 'Número de Episódios',
            minValue: 0,
          },
          vAxis: {
            title: 'Gênero'
          }
        };
        var chart = new google.visualization.BarChart(document.getElementById('grafico-barra-episodio'));
        chart.draw(data, options);
    }
</script>