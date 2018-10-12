var CadastrarContato = (function(){
    "use strict";
    
    var init = function(){
        _load.geral();
    },
    _clickButton = {
        cadastrarContato: function(){
            $("#btnCadastrarContato").click(function(){
                var json = null,
                    camposPreenchidos = "sim";
                
                $("form input, form select").each(function(){
                    if($.trim($(this).val()) === "") {
                        camposPreenchidos = "nao";
                        $(this).addClass("is-invalid");
                    } else {
                        $(this).removeClass("is-invalid");
                    }
                });
                    
                if(camposPreenchidos == "sim"){
                    json = _configuracaoGeral.efetuarPost("index.php/agenda/cadastrarcontato", $("form").serialize());
                    
                    if(json == "sucesso"){
                        alert("Contato cadastrado com sucesso!");
                    } else {
                        alert(json);
                    }
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
    _recursosJquery = {
        pluginMask: function(){
            $("#txtTelefone").mask("(00) 0000-0000");
        }
    },
    _load = {
        geral: function(){
            _load.listarGrupo();
            _recursosJquery.pluginMask();
            _clickButton.cadastrarContato();
        },
        listarGrupo: function(){
            var json = null;

            json = _configuracaoGeral.efetuarPost("index.php/agenda/listargrupos", "");
            $("#slcGrupo").empty();
            
            $(json).each(function(i, dados){
                $("#slcGrupo").append("<option value='" + dados.IDGRUPO + "'>" + dados.NOME + "<option>");
            });
            
            //REMOVENDO OPTIONS EM BRANCO
            $("#slcGrupo option").filter(function(){
                return !this.value || $.trim(this.value).length == 0 || $.trim(this.text).length == 0;
            }).remove();
            
            $("#slcGrupo").prepend("<option value='' selected>Selecione...</option>");
        }
    };
    return {
        init: init
    };
})();