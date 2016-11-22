function validaArquivo(arquivo){
	if(arquivo == ""){
		alert("Escolha uma imagem de divulgação");
		return false;
	}
	return true;
}
function limpaTitulo(tipo){
	$("label[for="+tipo+"]").siblings(".form-control").css("border","");
	$("label[for="+tipo+"]").siblings("span").remove();
}
function validaTitulo(texto, tipo){
	limpaTitulo(tipo);
	if(texto == ""){
		$("label[for="+tipo+"]").siblings(".form-control").css("border","0.3em solid red");
		$("label[for="+tipo+"]").parent(".form-group").append("<span>Preencha com o nome da série</span>");
		$("label[for="+tipo+"]").siblings("span").css("color","red");
		return false;
	}else{
		limpaTitulo();
		return true;
	}
}
function validaGenero(texto){
	var tipo = "genero";
	limpaTitulo(tipo);
	if(texto == "Selecione"){
		$("label[for=genero]").siblings(".form-control").css("border","0.3em solid red");
		$("label[for=genero]").parent(".form-group").append("<span>Selecione um gênero</span>");
		$("label[for=genero]").siblings("span").css("color","red");
		return false;
	}else{
		limpaTitulo();
		return true;
	}
}
function setAutoComplete(seletor, array){
	console.log(array);
	$(seletor).autocomplete({
		source: array
	});
}
function listaSeries(){
	$.ajax({
		url: "json/listaSeries.php",
		dataType: "json",
		success: function(data){
			var vetorNomes = new Array();
			$.each(data,function(i,item){
				vetorNomes.push(item['nome']);
			});
			setAutoComplete("#filme",vetorNomes);
		},error:function(){
			console.log("Erro ao processar solicitação");
		}
	});
}
$(document).ready(function(){
	listaSeries();
	// $("#filme").on("keyup",function(){
	// 	listaSeries();
	// });
	$("#genero").on("change", function(){
		var botao = $("button[type=submit]").text();
		botao = botao.toLowerCase();
		if(botao != "pesquisar"){
			var serie = $("#filme").val();
			validaTitulo(serie,"filme");
		}
	});
	$("button[type=submit]").on("click",function(event){
		var botao = $("button[type=submit]").text();
		botao = botao.toLowerCase();
		if(botao != "pesquisar"){
			event.preventDefault();
			var serie = $("#filme").val();
			var genero = $("#genero").val();
			var arquivo = document.getElementById("arquivo").value;
			var validos = new Array();
			var totalValido = 0;
			validos[0] = validaTitulo(serie,"filme");
			validos[1] = validaGenero(genero);
			validos[2] = validaArquivo(arquivo);
			for(var i=0; i < validos.length; i++){
				if(validos[i] == true){
					totalValido++;
				}
			}
			if(totalValido == 3){
				document.getElementById("form-serie").submit();
			}else{
				alert("Todos os campos devem ser preenchidos");
			}
		}
	});
});