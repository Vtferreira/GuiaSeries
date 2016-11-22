/*==Funções de validação==*/
function verificaEnvio(array){
	var tamanho = array.length;
	var valido = 0;
	for(var i = 0; i < array.length; i++){
		if(array[i] == true){
			valido++;
		}
	}
	if(valido == tamanho){
		document.getElementById("formulario").submit();
	}
}
function limpaValidacao(tipo){
	$("#"+tipo).parent().find("span").remove();
	$("#"+tipo).css("border","1px solid #ccc");
}
function validaCampo(tipo,campo){
	limpaValidacao(tipo);
	campo = campo.toLowerCase();
	var valido = true;
	if(campo == "selecione" || campo == ""){
		$("#"+tipo).css("border","0.3em solid red");
		$("#"+tipo).parent().append($("<span></span>").css("color","rgb(255, 0, 0)").text("Campo Obrigatório"));
		valido = false;
	}
	return valido;
}
/*==Fim das funções de validação==*/