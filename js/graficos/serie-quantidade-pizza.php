<style type="text/css">
    #grafico-pizza-quantidade{
        margin-left: 12em;
    } 
</style>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
		['Gênero', 'Quantidade'],
        <?php foreach($generos as $genero): ?>
      	['<?=$genero['genero_nome']?>', <?=$genero['total_genero']?>],
        <?php endforeach; ?>
    ]);
    var options = {
      title: 'Séries por Gênero',
      width: 550,
      height: 450
    };
    var chart = new google.visualization.PieChart(document.getElementById('grafico-pizza-quantidade'));
    chart.draw(data, options);
	}
</script>