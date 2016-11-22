/* 
 * Scripts referentes a página de gêneros (de filmes ou séries)
 */
function verificaGenero(genero){
    $.ajax({
        dataType: "json",
        url: "json/listaGeneros.php",
        //data: //parametros
        success: function(data){
            var existeIgual = false;
            $.each(data,function(i,item){
               if(genero == item['nome']){
                   $("#genero").addClass("field-error");
                   $(".form-box:first-child").append("<span><br>Gênero já existente na base de dados!</span>");
                   $(".form-box:first-child > span").addClass("field-error-message");
                   existeIgual = true;
               }
            });
            if(!existeIgual){
                $("#generoValido").val(true);
            }else{
                $("#generoValido").val(false);
            }
        },
        error: function(){
            console.log("Requisição falhou. Contate o administrador e tente novamente");
        }
    });
}
$(document).ready(function(){
   $("#voltar").on("click",function(){
      cancelaOperacao();
   });
   $("a[href='lista-generos.php']").on("click",function(event){
       event.preventDefault();
       var textoMsg = $(this).text().trim();
       if(textoMsg == "Mostrar Mais"){
            $(".menu-categorias ul li:nth-child(n+13)").css("display","block");
            $(this).text("Esconder");
        }else{
            $(".menu-categorias ul li:nth-child(n+13)").css("display","none");
            $(".menu-categorias ul li:last-child").css("display","block");
            $(this).text("Mostrar Mais");
        }
   });
   $("#formulario").on("click",function(event){
       event.preventDefault();
       var genero = $("#genero").val();
       verificaGenero(genero);
       var formValido = new Array();
       formValido[0] = validaCampo("genero",genero);
       verificaEnvio(formValido);
   });
});