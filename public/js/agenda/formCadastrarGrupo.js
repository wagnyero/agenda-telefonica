var CadastrarGrupo = (function(){
    "use strict";
    
    var init = function(){
        _load.geral();
    },
    _clickButton = {
        cadastrarGrupo: function(){
            $("#btnCadastrarGrupo").click(function(){
                var json = null,
                    nomeGrupo = $("#txtNomeGrupo").val();
                    
                if(nomeGrupo.trim() !== ""){
                    json = _configuracaoGeral.efetuarPost("index.php/agenda/cadastrargrupo", $("form").serialize());
                    $("#txtNomeGrupo").removeClass("is-valid");
                    
                    if(json == "sucesso"){
                        alert("Grupo cadastrado com sucesso!");
                    } else {
                        alert(json);
                    }
                } else {
                    $("#txtNomeGrupo").addClass("is-invalid");
                }
            });
        }
    },
    _configuracaoGeral = {
        datepickerr: function(id){
            $(id).datepicker({
                changeMonth: true,
                changeYear: true,
                numberOfMonths: 1,
                dateFormat: 'dd/mm/yy',
                showAnim: 'drop'
            });
        },
        efetuarPost: function(url, parametros){
            var retornoDados;
            
            $.ajax({
                url: url,
                data: parametros,
                beforeSend: function(){
                },
                type: "POST",
                async: false,
                success: function(data){
                    retornoDados = data;
                    return false;
                }
            });
            
            return retornoDados;
        }
    },
    _load = {
        geral: function(){
            _clickButton.cadastrarGrupo();
        }
    };
    return {
        init: init
    };
})();