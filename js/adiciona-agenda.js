var alterou = true;
/*Realiza requisição AJAX para adicionar um filme/série na agenda do usuário correspondente.*/
function adicionaUsuarioAgenda(usuario,agenda){
	$.ajax({
		url: "json/adicionaUsuarioAgenda.php",
		dataType: "json",
		method: "POST",
		data: {"usuario_id":usuario, "agenda_id": agenda},
		success: function(data){
			console.log("Adicionou na agenda com sucesso");
			alterou = true;
		},error: function(){
			console.log("Erro ao adicionar filme/série na agenda. Contate o desenvolvedor");
			alterou = false;
		}
	});
}
function removeUsuarioAgenda(usuario,agenda){
	$.ajax({
		url: "json/excluiUsuarioAgenda.php",
		dataType: "json",
		method: "POST",
		data: {"usuario_id":usuario,"agenda_id":agenda},
		success: function(data){
			console.log("Removeu da agenda com sucesso");
		},error: function(){
			console.log("Erro ao remover filme/série na agenda. Contate o desenvolvedor");
		}
	});
}
$(document).ready(function(){
	$("#pesquisa-periodo").on("click",function(event){
		/*
		event.preventDefault();
		var endereco = window.location.href;
		alert(endereco);*/
	});
	$(".agendaBtn").on("click",function(){
		var usuario_id = $("#usuario_id").val();
		var agenda_id = $(this).parent().siblings(".agenda_id").val();
		var existeClasse = $(this).children().hasClass("adicao");
		if(alterou == true && existeClasse == true){
			adicionaUsuarioAgenda(usuario_id,agenda_id);
			$(this).children().text(" Remover da minha agenda");
			$(this).children().removeClass("fa fa-thumbs-o-up fa-lg");
			$(this).children().removeClass("adicao");
			$(this).children().addClass("fa fa-minus-square fa-lg remocao");
		}else{
			removeUsuarioAgenda(usuario_id,agenda_id);
			$(this).children().text(" Adicionar na minha agenda");
			$(this).children().removeClass("fa fa-minus-square fa-lg");
			$(this).children().removeClass("remocao");
			$(this).children().addClass("fa fa-thumbs-o-up fa-lg adicao");
		}
	})
});