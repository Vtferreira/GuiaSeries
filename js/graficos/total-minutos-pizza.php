<style type="text/css">
   #grafico_minutos_pizza{
      /*margin-top: -2em;*/
      margin-top: -5em;
      /*margin-left: 1em;*/
   }
</style>
<script type="text/javascript">
   google.charts.load('current', {'packages':['corechart']});
   google.charts.setOnLoadCallback(drawChart);
   function drawChart() {
     var data = google.visualization.arrayToDataTable([
       ['Gênero', 'Total'],
       <?php foreach($qtdFilmesArray as $filme_grafico): ?>
         ['<?=$filme_grafico['nome']?>', <?=$filme_grafico['total_minutos']?>],
       <?php endforeach; ?>
     ]);

     var options = {
       title: 'Minutos por Gênero',
       width: 580,
       height: 500
     };

     var chart = new google.visualization.PieChart(document.getElementById('grafico_minutos_pizza'));
     chart.draw(data, options);
   }
</script>