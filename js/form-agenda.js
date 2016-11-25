$(document).ready(function(){
	criaDatePicker("estreia");
	$("button[type=submit]").on("click",function(event){
		event.preventDefault();
		var titulo = $("#titulo").val();
		var genero = $("#genero").val();
		var estreia = $("#estreia").val();
		var arquivo = $("#arquivo").val();
		var validacao = [];
		comparaDataAgenda(estreia);
		validacao[0] = validaCampo("titulo",titulo);
		validacao[1] = validaCampo("genero",genero);
		validacao[2] = validaCampo("estreia",estreia);
		validacao[3] = validaArquivo(arquivo);
		validacao[4] = comparaDataAgenda(estreia);
		if(validacao[4] == false){
			$("#estreia").css("border","0.3em solid red");
			$("#estreia").parent().append($("<span></span>").css("color","rgb(255, 0, 0)")
				.text("Selecione uma data posterior"));
		}
		verificaEnvio(validacao);
	});
});