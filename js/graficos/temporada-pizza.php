<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
		['Gênero', 'Temporadas'],
		<?php foreach($generos as $genero): ?>
      	['<?=$genero['genero_nome']?>', <?=$genero['temporada_genero']?>],
      	<?php endforeach; ?>
    ]);
    var options = {
      title: 'Temporadas por Gênero',
      width: 600,
      height: 450
    };
    var chart = new google.visualization.PieChart(document.getElementById('grafico-pizza-temporada'));
    chart.draw(data, options);
	}
</script>