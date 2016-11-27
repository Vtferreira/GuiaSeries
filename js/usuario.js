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
                   $("#nome").parent().append($("<span></span>").addClass("field-warning-message").text("Nome já existente na base de dados"));
                   //$(".form-box:first-child").append("<span class='field-warning-message erroNome'><br>Nome já existente na base de dados</span>");
                   repetido = true;
               }
            });
            if(!repetido){
                $("#nome").removeClass("field-warning");
                $("#nome").siblings("span").remove();
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
    $.ajax({
        dataType: "json",
        url: "json/listaUsuarios.php",
        success: function(data){
            var repetido = false;
            $.each(data,function(i){
               if(email == data[i]["email"]){
                   $("#email").addClass("field-warning");
                   $("#email").parent().append($("<span></span>").addClass("field-warning-message").text("Email já existente na base de dados"));
                   repetido = true;
               }
            });
            if(!repetido){
                $("#email").removeClass("field-warning");
                $("#email").siblings("span").remove();
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
    criaDatePicker("dataNasc");
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
    $("#enviar").on("click",function(event){
        event.preventDefault();
        var nome = $("#nome").val();
        var email = $("#email").val();
        var sexo = $("#cmbSexo").val();
        var dataNasc = $("#dataNasc").val();
        var senha = $("#senha").val();
        var confirmaSenha = $("#confirmaSenha").val();
        var nomeValido = $("#nomeValido").val();
        nomeValido = Boolean(nomeValido);
        var emailValido = $("#emailValido").val();
        emailValido = Boolean(emailValido);
        var validacao = [];
        validacao[0] = validaCampo("nome",nome);
        validacao[1] = validaCampo("email",email);
        validacao[2] = validaCampo("sexo",sexo);
        validacao[3] = validaCampo("dataNasc",dataNasc);
        validacao[4] = validaSenha(senha);
        validacao[5] = validaCampo("confirmaSenha",confirmaSenha);
        validacao[6] = validaEmail(email);
        validacao[7] = comparaSenha(senha,confirmaSenha);
        validacao[8] = nomeValido;
        validacao[9] = emailValido;
        console.log(validacao[8]);
        console.log(validacao[9]);
        if(validacao[4] != true){
            configuraMensagem("senha","A senha deve ter, no mínimo, 4 caracteres");
        }
        if(validacao[6] != true){
            configuraMensagem("email","E-mail inválido");
        }
        if(validacao[7] != true){
            configuraMensagem("confirmaSenha","As senhas devem corresponder");
        }
        verificaEnvio(validacao);
    });
});
