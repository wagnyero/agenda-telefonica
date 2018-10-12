var Dashboard = (function(){
    "use strict";
    
    var init = function(){
        _load.geral();
    },
    _clickButton = {
        menuNovoContato: function(){
            $("#menuNovoContato").click(function(){
                var html = _configuracaoGeral.efetuarPost("index.php/agenda/formcadastrar");
                
                $("#content-wrapper").html(html);
            });
        },
        menuNovoGrupo: function(){
            $("#menuNovoGrupo").click(function(){
                var html = _configuracaoGeral.efetuarPost("index.php/agenda/formcadastrargrupo");
                
                $("#content-wrapper").html(html);
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
            _load.chart();
            _load.dataTable();
            _load.totalContatos();
            _load.totalGrupo();
            _clickButton.menuNovoContato();
            _clickButton.menuNovoGrupo();
        },
        chart: function(){
            var arrayLabel = [],
                arrayDados = [],
                json = _configuracaoGeral.efetuarPost("index.php/agenda/listartotalcontatosporgrupo");
        
            $(json).each(function(i, dados){
                arrayLabel[i] = dados["NOME"];
                arrayDados[i] = dados["TOTAL"];
            });
            
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            new Chart($("#myAreaChart"), {
              type: 'line',
              data: {
                labels: arrayLabel,
                datasets: [{
                  label: "Quantidade",
                  lineTension: 0.3,
                  backgroundColor: "rgba(2,117,216,0.2)",
                  borderColor: "rgba(2,117,216,1)",
                  pointRadius: 5,
                  pointBackgroundColor: "rgba(2,117,216,1)",
                  pointBorderColor: "rgba(255,255,255,0.8)",
                  pointHoverRadius: 5,
                  pointHoverBackgroundColor: "rgba(2,117,216,1)",
                  pointHitRadius: 50,
                  pointBorderWidth: 2,
                  data: arrayDados
                }]
              },
              options: {
                scales: {
                  xAxes: [{
                    time: {
                      unit: 'date'
                    },
                    gridLines: {
                      display: false
                    },
                    ticks: {
                      maxTicksLimit: 7
                    }
                  }],
                  yAxes: [{
                    ticks: {
                      min: 0,
                      max: arrayDados.length + 10,
                      maxTicksLimit: 5
                    },
                    gridLines: {
                      color: "rgba(0, 0, 0, .125)"
                    }
                  }]
                },
                legend: {
                  display: false
                }
              }
            });

        },
        dataTable: function(){
            $("#dataTable").DataTable({
                scrollX: true,
                destroy: true,
                searching: false,
                processing: true,
                serverSide: true,
                dom: 'Bfrtip',
                ajax: {
                    url: "index.php/agenda/listarcontatosagenda",
                    type: "POST"
                },
                language: {
                    "info":           "Exibindo _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty":      "Exibindo 0 a 0 de 0 registros",
                    "lengthMenu":     "Exibir _MENU_ registros",
                    "oPaginate": {
                        "sNext":        "Próximo",
                        "sPrevious":    "Anterior",
                        "sFirst":       "Primeiro",
                        "sLast":        "Último"
                    }
                }
            });
        },
        totalContatos: function(){
            var json = _configuracaoGeral.efetuarPost("index.php/agenda/listartotalcontatos");

            $("#divTotalContatos").html("Total de " + json["TOTAL"] + " Contatos!");
        },
        totalGrupo: function(){
            var json = _configuracaoGeral.efetuarPost("index.php/agenda/listartotalgrupo");

            $("#divTotalGrupo").html("Total de " + json["TOTAL"] + " Grupos!");
        }
    };
    return {
        init: init
    };
})();