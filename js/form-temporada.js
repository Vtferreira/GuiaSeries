function adicionaEpisodios(array,temporada_id){
	console.log(array);
	$.each(array,function(index,value){
		$.ajax({
			url:"json/adicionaEpisodios.php",
			method: "POST",
			data: {"temporada_id":temporada_id, "numero_ep":value.Episode, "nome":value.Title, 
				"lancamento": value.Released, "avaliacao": value.imdbRating},
			success: function(data){
				console.log("Episódios inseridos com sucesso");
				$(".alert-success").css("display","block");
			},error:function(){
				console.log("Erro ao adicionar episódio");
			}
		});
	});
}
function buscaEpisodios(serie,temporada,temporada_id){
	console.log("Série: " + serie);
	console.log("Temporada: " + temporada);
	console.log("Temporada id: " + temporada_id);
	$.ajax({
		url: "http://www.omdbapi.com/?",
		data: {"t":serie,"plot":"short","r":"json","season":temporada},
		success: function(data){
			adicionaEpisodios(data.Episodes,temporada_id);
		},error: function(){
			console.log("Erro ao buscar episódios");
		}
	});
}
function adicionaTemporada(serie_id,serie_nome,temporada){
	$.ajax({
		url: "json/adicionaTemporada.php",
		method: "POST",
		dataType: "json",
		data: {"serie_id":serie_id,"serie_nome":serie_nome,"temporada":temporada},
		success: function(data){
			alert("Temporada inserida com sucesso");
			// console.log(data);
			buscaEpisodios(serie_nome,temporada,data);
		},error:function(){
			console.log("Erro ao inserir temporada");
		}	
	});
}
$(document).ready(function(){
	/**/
	$("#adicionar").on("click",function(){
		var serie_nome = $("#filme").val();
		var temporada = $("#temporada").val();
		var validacao = [];
		validacao[0] = validaCampo("filme",serie_nome);
		validacao[1] = validaCampo("temporada",temporada);
		if(serie_nome != "" && temporada != ""){
			var serie_id = $("#filme").val();
			var serie_nome = $("#filme :selected").text();
			var temporada = $("#temporada").val();
			adicionaTemporada(serie_id,serie_nome,temporada);
		}
	});
});