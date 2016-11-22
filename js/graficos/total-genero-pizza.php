<style type="text/css">
   #grafico_total_genero_pizza{
      margin-top: -5em;
      /*margin-left: -0.3em;*/
      /*padding-top: 0.3em;*/
      /*padding-left: 0.3em;*/
      /*padding-bottom: 0.3em;*/
   }
</style>
<script type="text/javascript">
   google.charts.load('current', {'packages':['corechart']});
   google.charts.setOnLoadCallback(drawChart);
   function drawChart() {
     var data = google.visualization.arrayToDataTable([
       ['Gênero', 'Total'],
       <?php foreach($qtdFilmesArray as $filme_grafico): ?>
         ['<?=$filme_grafico['nome']?>', <?=$filme_grafico['total_genero']?>],
       <?php endforeach; ?>
     ]);

     var options = {
       title: 'Total por Gênero',
       width: 580,
       height: 500
     };

     var chart = new google.visualization.PieChart(document.getElementById('grafico_total_genero_pizza'));

     chart.draw(data, options);
   }
</script>