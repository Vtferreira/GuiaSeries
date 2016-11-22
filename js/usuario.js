function validaNome(nome){
    $(".erroNome").remove();
    if(nome.length == 0){
        $("#nome").addClass("field-error");
        $(".form-box:first-child").append("<span class='field-error-message erroNome'><br>Nome inválido</span>");
        return false;
    }else{
        $("#nome").removeClass("field-error");
        $(".erroNome").remove();
        return true;
    }
}
function validaEmail(email){
    $(".erroEmail").remove();
    var temArroba = email.indexOf("@");
    var temPonto = email.indexOf(".com");
    if((email.length <= 10) || (temArroba == -1) || (temPonto == -1)){
            $("#email").addClass("field-error");
            $(".form-box:nth-child(2)").append("<span class='field-error-message erroEmail'><br>E-mail inválido</span>");
            return false;
    }
    else{
            $("#email").removeClass("field-error");
            $(".erroEmail").remove();
            return true;
    }
}
function validaSexo(sexo){
    $(".erroSexo").remove();
    sexo = sexo.toLowerCase();
    if(sexo == "selecione"){
        //CÓDIGO AQUI - MESMO QUE NOME E E-MAIL
        $("#cmbSexo").addClass("field-error");
        $(".form-box:nth-child(3)").append("<span class='field-error-message erroSexo'><br>Selecione alguma opção</span>");
        return false;
    }else{
        $("#cmbSexo").removeClass("field-error");
        $(".erroSexo").remove();
        return true;
    }
}
function validaData(data){
    $(".erroData").remove();
    if(data != ""){
        data = data.split("/");
        if(data[0].length < 2 || data[1].length < 2 || data[2].length < 4){
            $("#dataNasc").addClass("field-error");
            $(".form-box:nth-child(4)").append("<span class='field-error-message erroData'><br>Data Inválida</span>");
            return false;
        }else{
            $("#dataNasc").removeClass("field-error");
            $(".erroData").remove();
            return true;
        }
    }else{
        $("#dataNasc").addClass("field-error");
        $(".form-box:nth-child(4)").append("<span class='field-error-message erroData'><br>Data Inválida</span>");
        return false;
    }
}
function validaSenha(senha){
    $(".erroSenha").remove();
    if(senha.length <= 4){
        $("#senha").addClass("field-error");
        $(".form-box:nth-child(5)").append("<span class='field-error-message erroSenha'><br>A senha deve ter,no mínimo, 5 caracteres</span>");
        return false;
    }else{
        $("#senha").removeClass("field-error");
        $(".erroSenha").remove();
        return true;
    }
}
function comparaSenha(senhaA,senhaB){
    $(".erroSenha").remove();
    if(senhaA != senhaB || senhaB == ""){
        $("#confirmaSenha").addClass("field-error");
        $(".form-box:nth-child(6)").append("<span class='field-error-message erroSenha'><br>A senha deve ser igual a digitada anteriormente</span>");
        return false;
    }else{
        $("#confirmaSenha").removeClass("field-error");
        $(".erroSenha").remove();
        return true;
    }
}
function verificaUsuarios(nome){
    /*http://localhost/Projetos/GuiaSeries/json/listaUsuarios.php*/
    //$(".erroNome").remove();
    var repetido = false;
    $.ajax({
        dataType: "json",
        url: "json/listaUsuarios.php",
        //data: //parametros
        success: function(data){
            $.each(data,function(i){
               if(nome == data[i]["nome"]){
                   $("#nome").addClass("field-warning");
                   $(".form-box:first-child").append("<span class='field-warning-message erroNome'><br>Nome já existente na base de dados</span>");
                   repetido = true;
               }
            });
            if(!repetido){
                $("#nome").removeClass("field-warning");
                $(".erroNome").remove();
                $("#nomeValido").val(true);
            }else{
                $("#nomeValido").val(false);
            }
        },
        error: function(){
            alert("Requisição falhou. Contate o administrador e tente novamente");
        }
    });

}
function verificaUsuariosEmail(email){
    /*http://localhost/Projetos/GuiaSeries/json/listaUsuarios.php*/
    //$(".erroEmail").remove();
    $.ajax({
        dataType: "json",
        url: "json/listaUsuarios.php",
        //data: //parametros
        success: function(data){
            var repetido = false;
            $.each(data,function(i){
               if(email == data[i]["email"]){
                   $("#email").addClass("field-warning");
                   $(".form-box:nth-child(2)").append(
                           "<span class='field-warning-message erroEmail'>\n\
                            <br>E-mail já existente na base de dados</span>");
                   repetido = true;
               }
            });
            if(!repetido){
                $("#email").removeClass("field-warning");
                $(".erroEmail").remove();
                $("#emailValido").val(true);
            }else{
                $("#emailValido").val(false);
            }
        },
        error: function(){
            alert("Requisição falhou. Contate o administrador e tente novamente");
        }
    });
}
$(document).ready(function(){
    /*$("#dataNasc").datepicker($.datepicker.regional["pt-BR"]);
    $("#dataNasc").datepicker({
        changeMonth: true,
        changeYear: true
    });*/
    $("#btnCancelar").click(function(){
        cancelaOperacao();
    });
    $("#nome").change(function(){
        var nome = $("#nome").val();
        verificaUsuarios(nome);
    });
    $("#email").change(function(){
        var email = $("#email").val();
        verificaUsuariosEmail(email);
    });
    $("#nome, #email,#cmbSexo,#dataNasc,#senha,#confirmaSenha").change(function(){
        var nome = $("#nome").val();
        var email = $("#email").val();
        var sexo = $("#cmbSexo option:selected").val();
        var data = $("#dataNasc").val();
        var senha = $("#senha").val();
        var senhaConf = $("#confirmaSenha").val();
        validaNome(nome);
        validaEmail(email);
        validaSexo(sexo);
        validaData(data);
        validaSenha(senha);
        comparaSenha(senha,senhaConf);
    });
    $("#formUsuario").bind("submit",function(event){
        event.preventDefault();
        var camposValidos = 0;
        var nome = $("#nome").val();
        var email = $("#email").val();
        var sexo = $("#cmbSexo option:selected").val();
        var data = $("#dataNasc").val();
        var senha = $("#senha").val();
        var senha2 = $("#confirmaSenha").val();
        var vetorValida = new Array();
        vetorValida[0] = validaNome(nome);
        vetorValida[1] = validaEmail(email);
        vetorValida[2] = validaSexo(sexo);
        vetorValida[3] = validaData(data);
        vetorValida[4] = validaSenha(senha);
        vetorValida[5] = comparaSenha(senha,senha2);
        vetorValida[6] = $("#nomeValido").val();
        vetorValida[7] = $("#emailValido").val();
        $.each(vetorValida,function(i){
            if(vetorValida[i].toString() == "true")
                camposValidos++;
        });
        console.log(vetorValida);
        if(camposValidos == 8){
            document.getElementById("formUsuario").submit();
        }
    });
});
