function verificaValor(valor){
	$(".filtragem-data").css("display","none");
	if(valor == "periodo"){
		$(".filtragem-data").css("display","inline");
	}
}
$(document).ready(function(){
	criaDatePicker("dataInicio");
	criaDatePicker("dataFim");
	var valor = "";
	verificaValor(valor);
	$("#tipoPesquisa").change(function(){
		var valor = $(this).val();
		verificaValor(valor);
	});
});