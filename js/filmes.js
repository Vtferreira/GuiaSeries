/* 
 * Arquivo referente a lógica de front-end para filmes
 */
var existeDiretor = false;
function adicionaDiretor(diretor){
    console.log("O diretor " + diretor + " ainda não existe");
    $.ajax({
       dataType: "json",
       url: "php/adiciona-diretor.php",
       method: "POST",
       data: {"diretor":diretor},
       success: function(data){
           console.log("Diretor adicionado com sucesso");
       }
    });
}
function verificaDiretores(diretor){
    existeDiretor = false;
    $.ajax({
        dataType: "json",
        url: "php/lista-diretores.php",
        //data,
        success: function(data){
            $.each(data,function(i,item){
               console.log(item['nome']);
               if(diretor == item['nome']){
                   existeDiretor = true;
               }
            });
            console.log(existeDiretor);
            if(!existeDiretor){
                adicionaDiretor(diretor);
            }
        },
        error: function(){
            alert("Erro na procura de diretores. Contate o desenvolvedor");
        }
    });

}
function adicionaEstudio(estudio){
    $(".form-box:nth-child(5) > span").remove();
    $.ajax({
        dataType: "json",
        url: "php/adiciona-estudio.php",
        data: {"estudio":estudio},
        method: "POST",
        success: function(data){
            $("#estudio").addClass("field-success");
            $(".form-box:nth-child(5)").append("<span><br>Estúdio adicionado com sucesso</span>");
            $(".form-box:nth-child(5) > span").addClass("field-success-message");
            $("#estudio").append("<option>"+estudio+"</option>");
            $("#estudio").val(estudio);
        },
        error: function(){
            console.log("Requisição falhou. Contate o administrador e tente novamente");
        }
    });
    $(".novoEstudio").css("display","none");
    $("#naoEncontrei").text("Não Encontrei");
}
function validaCampos(camposForm){
    $("#filme").removeClass("field-error");
    $("#genero").removeClass("field-error");
    $("#estudio").removeClass("field-error");
    $(".form-box:nth-child(2) > span").remove();
    $(".form-box:nth-child(3) > span").remove();
    $(".form-box:nth-child(5) > span").remove();
    var formValido = new Array();
    for(var i=0;i<camposForm.length;i++){
        formValido[i] = true;
    }
    if(camposForm[0] == ""){
        $("#filme").addClass("field-error");
        $(".form-box:nth-child(2)").append("<span><br>O nome do filme deve ser preenchido</span>");
        $(".form-box:nth-child(2) > span").addClass("field-error-message");
        formValido[0] = false;
    }
    if(camposForm[1] == "Selecione"){
        $("#genero").addClass("field-error");
        $(".form-box:nth-child(3)").append("<span><br>Selecione um gênero válido</span>");
        $(".form-box:nth-child(3) > span").addClass("field-error-message");
        formValido[1] = false;
    }
    if(camposForm[2] == "Selecione"){
        $("#estudio").addClass("field-error");
        $(".form-box:nth-child(5)").append("<span><br>Selecione um estúdio válido</span>");
        $(".form-box:nth-child(5) > span").addClass("field-error-message");
        formValido[2] = false;
    }
    return formValido;
}
function setAutoComplete(seletor,vetor){
    console.log(vetor);
    /*
    console.log(vetor[0]["titulo"]);
    console.log(vetor[1]["titulo"]);
    console.log(vetor[2]["titulo"]);*/
    //console.log(vetor);
    $(seletor).autocomplete({source: vetor});
}
function listaFilmes(){
    $.ajax({
       url: "json/listaFilmes.php",
       dataType: "json",
       success: function(data){
           var vetorNomes = new Array();
           $.each(data,function(i,item){
               vetorNomes.push(item['titulo']);
           });
           setAutoComplete("#filme",vetorNomes);
       },
       error: function(){
           alert("Ocorreu algum erro na pesquisa. Contate o administrador");
       }
    });
}
$(document).ready(function(){
    listaFilmes();
    //setAutoComplete();
    var tituloForm = $(".form h1").text();
    if(tituloForm == "Pesquisa de Filmes"){
        $("#classificacao").closest(".form-box").addClass("escondeCampo");
        $("#duracao").closest(".form-box").addClass("escondeCampo");
        $("#dataEstreia").closest(".form-box").addClass("escondeCampo");
        $("#sinopse").closest(".form-box").addClass("escondeCampo");
        //$("#avaliacao").closest(".form-box").addClass("escondeCampo");
    }
   $("#naoEncontrei").on("click",function(event){
       $(".novoEstudio").css("display","block");
       $("#estudio").val("Outro");
       var txtButton = $("#naoEncontrei").val();
       var txtEstudio = $("#novoEstudio").val();
       if(txtButton == "Adicionar"){
           adicionaEstudio(txtEstudio);
       }
   });
   $("#estudio").on("change",function(){
      var txtCombo = $("#estudio option:selected").text().trim();
      var diretor = $("#diretor").val();
      if(txtCombo != "Selecione" || txtCombo != "Outro"){
          $(".novoEstudio").css("display","none");
          $("#naoEncontrei").text("Não Encontrei");
      }
      verificaDiretores(diretor);
   });
   $("#novoEstudio").on("keyup",function(){
      var texto = $(this).val();
      if(texto != ""){
          $("#naoEncontrei").val("Adicionar");
      }else{
          $("#naoEncontrei").val("Não Encontrei");
      } 
   });
   $("button[type=submit]").on("click",function(event){
      event.preventDefault();
      var tituloForm = $(".form h1").text();
      var campoForm = new Array();
      var validaForm = new Array();
      var qtdValidos=0;
      if(tituloForm != "Pesquisa de Filmes"){
        campoForm[0] = $("#filme").val();
        campoForm[1] = $("#genero").val();
        campoForm[2] = $("#estudio").val();
        validaForm = validaCampos(campoForm);
        console.log(validaForm);
        for(var j=0; j < validaForm.length;j++){
            if(validaForm[j]){
                qtdValidos++;
            }
        }
        if(qtdValidos == 3){
            document.getElementById("frmFilme").submit();
        }
      }else{
          document.getElementById("frmFilme").submit();
      }
   });
});

