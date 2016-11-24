<style type="text/css">
    #grafico-pizza-episodio{
        margin-left: 12em;
    }
</style>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
		['Gênero', 'Temporadas'],
		<?php foreach($generos as $genero): ?>
      	['<?=$genero['genero_nome']?>', <?=$genero['total_episodios']?>],
      	<?php endforeach; ?>
    ]);
    var options = {
      title: 'Episódios por Gênero',
      width: 550,
      height: 450
    };
    var chart = new google.visualization.PieChart(document.getElementById('grafico-pizza-episodio'));
    chart.draw(data, options);
	}
</script>