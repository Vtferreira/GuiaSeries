function criaDatePicker(seletor){
	$.datepicker.setDefaults($.datepicker.regional['pt-BR']);
	$("#lancamento").datepicker({
		dateFormat: "dd/mm/yy"
	});
}
function preencheNumeroEpisodio(episodio){
	episodioInt = parseInt(episodio);
	episodioInt++;
	$("#numero-episodio").val(episodioInt);
}
function consultaUltimoEpisodio(temporada){
	$.ajax({
		url: "json/consultaUltimoEpisodio.php",
		method: "POST",
		dataType: "json",
		data: {"temporada_id":temporada},
		success: function(data){
			preencheNumeroEpisodio(data.ultimo_episodio);	
		},error: function(){
			console.log("Erro ao consultar último episódio");
		}
	});
}
function geraTemporadaNome(nome){
	var novoNome = "";
	var nomeSplit = nome.split("_");
	novoNome = nomeSplit[1];
	return novoNome;
}
function adicionaTemporadas(array){
	$("#temporada option").remove();
	$.each(array,function(indice,valor){
		var temporada_nome = geraTemporadaNome(valor.nome);
		$("#temporada").append($("<option></option>").attr("value",valor.temporada_id).text(temporada_nome));
	});
}
function buscaTemporadas(serie_id){
	$.ajax({
		url: "json/listaTemporadas.php",
		method: "POST",
		dataType: "json",
		data: {"serie_id":serie_id},
		success: function(data){
			adicionaTemporadas(data);
		},error: function(){
			console.log("Erro ao buscar temporadas");
		}
	});
}
$(document).ready(function(){
	criaDatePicker();
	$("#serie").on("change",function(){
		var serie_id = $(this).val();
		buscaTemporadas(serie_id);
	});
	$("#temporada").on("change",function(){
		var temporada_id = $(this).val();
		consultaUltimoEpisodio(temporada_id);
	});
	$("button[type=submit]").on("click",function(event){
		event.preventDefault();
		var serie = $("#serie").val();
		var temporada = $("#temporada").val();
		var episodio = $("#numero-episodio").val();
		var titulo = $("#nome-episodio").val();
		var data = $("#lancamento").val();
		var validacao = [];
		validacao[0] = validaCampo("serie",serie);
		validacao[1] = validaCampo("temporada",temporada);
		validacao[2] = validaCampo("numero-episodio",episodio);
		validacao[3] = validaCampo("nome-episodio",titulo);
		validacao[4] = validaCampo("lancamento",data);
		verificaEnvio(validacao);
	});
});