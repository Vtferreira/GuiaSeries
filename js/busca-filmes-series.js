/* 
 * Arquivo que faz requisição AJAX para a OMDBAPI buscando séries e filmes
 */
/*Função que transforma a classificação americana para formato brasileiro*/
function formataClassificacao(classificacao){
    var idade="Livre";
    if(classificacao.indexOf("-") != -1){
        idade = classificacao.split("-");
        if(idade[1] != "PG"){
            idade = idade[1] + " anos";
        }else{
            idade = "Livre";
        }
        
    }
    return idade;
}
/*Função que retorna apenas um diretor. Ou seja, caso existam 2 ou mais diretores, irá retornar apenas o primeiro*/
function formataDiretor(diretor){
    var apenasUm=diretor;
    if(diretor.indexOf(",") != -1){
        apenasUm = diretor.split(",");
        apenasUm = apenasUm[0];
    }
    return apenasUm;
}
/*Substitui o 'min' por 'minutos', de modo a ficar mais agradável e entendível ao usuário*/
function formataDuracao(texto){
    texto = texto.replace("min","minutos");
    return texto;
}
/*Captura a data completa e retorna apenas o ano*/
function formataAno(data){
    data = data.split(" ");
    ano = data[2];
    return ano;
}
/*Função que preenche os campos do formulário*/
function preencheForm(campos){
    var tipo = campos["tipo"];
    var classificacao = formataClassificacao(campos["classificacao"]);
    var duracao = formataDuracao(campos["duracao"]);
    var ano = formataAno(campos["estreia"]);
    $("#filme").val(campos["titulo"]);
    $("#classificacao").val(classificacao);
    $("#duracao").val(duracao);
    $("#avaliacao").val(campos["avaliacao"]);
    $("#imagem").val(campos["poster"]);
    $("#sinopse").val(campos["sinopse"]);
    $("#premios").val(campos["premios"]);
    $("#ano").val(ano);
    $("#dataEstreia").val(campos["estreia"]);
    $(".form-obra img").remove();
    $(".form-obra h1").prepend("<img/><br>");
    $(".form-obra img").attr("src", campos["poster"]).addClass("poster");
    if(tipo == "movie"){
        var diretor = formataDiretor(campos["diretor"]);
        $("#diretor").val(diretor); 
    }else{
        $("#total-temporadas").val(campos["temporadas"] + " temporadas");
    }
}
$(document).ready(function(){
    $("#ano").on("blur",function(){
        var titulo = $("#filme").val();
        var ano = $("#ano").val();
        $.ajax({
            url: "http://www.omdbapi.com/",
            data: {"t":titulo,"y":ano,"plot":"full","r":"json"},
            success: function(data){
                var campos = new Array();
                campos["titulo"] = data["Title"];
                campos["diretor"] = data["Director"];
                campos["classificacao"] = data["Rated"];
                campos["duracao"] = data["Runtime"];
                campos["estreia"] = data["Released"];
                campos["avaliacao"] = data["imdbRating"];
                campos["poster"] = data["Poster"];
                campos["sinopse"] = data["Plot"];
                campos["premios"] = data["Awards"];
                campos["tipo"] = data["Type"];
                if(data["Type"] == "series"){
                    campos["temporadas"] = data["totalSeasons"];
                }
                console.log(campos["premios"]);
                preencheForm(campos);
            },
            error: function(){
                console.log("Requisição falhou. Contate o administrador");
            }
        });
    });
});

