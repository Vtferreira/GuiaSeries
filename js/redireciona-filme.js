    var filmes = $(".filme");
    var tamanho = filmes.length;
    if(tamanho == 1){
        var enderecoFilme = $(".titulo-filme").children().attr("href");
        window.location.href = enderecoFilme;
    }