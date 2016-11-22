function americanDateToBrazilian(data){
	var dataReferencia = data.split("-");
	var dataBrasil = dataReferencia[2]+"/"+dataReferencia[1]+"/"+dataReferencia[0];
	return dataBrasil;
}
function limpaTabela(){
	$("#tabela-episodios tbody tr").remove();
}
function criaTabela(array){
	limpaTabela();
	$.each(array,function(index,value){
		var colunas = "<tr>";
		colunas = colunas + "<td>"+value.episodio_numero+"</td>";
		colunas = colunas + "<td>"+value.episodio_nome+"</td>";
		colunas = colunas + "<td>"+americanDateToBrazilian(value.episodio_data)+"</td>";
		colunas = colunas + "<td>"+value.episodio_avaliacao+"</td>";
		colunas = colunas + "<td>Icone</td>";
		colunas = colunas + "</tr>";
		$("#tabela-episodios tbody").append(colunas);
	});
}
function listaEpisodios(temporada_id){
	$.ajax({
		url: "json/listaEpisodios.php",
		dataType: "json",
		data: {"temporada_id":temporada_id},
		success: function(data){
			criaTabela(data);
		},error:function(){
			console.log("Erro ao carregar episódios");
		}
	});
}
$(document).ready(function(){
	var temporada = $("#temporada option:first-child").val();
	listaEpisodios(temporada);
	$("#temporada").on("change",function(){
		var temporada = $(this).val();
		listaEpisodios(temporada);
	});
})