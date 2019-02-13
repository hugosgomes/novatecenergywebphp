
//CONSULTA NO BANCO QUANDO MUDA O TÉCNICO NO SELECT
$('#Tecnico').change(function(){
    var Tecnico = $(this).val();
    var Callback = $(this).attr('callback');
    var Callback_action = $(this).attr('callback_action');
    var Dia = $(this).attr('rel');
    var S = $(this).attr('semana');

    $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, Tecnico: Tecnico, dia: Dia, semana: S}, function (data) {
        $('.spinner').hide();
        if(data.locations){
            initMap(data.locations);
        }
        
        //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
        if(data.Trigger){
            Trigger(data.trigger);
        }
        //ADICIONA OS DADOS DA O.S PARA APRESENTAR NA TABELA NA TELA DE AGENDAMENTOS
        if (data.addtable) {
            $("#dataTable .j_tecnico").remove();
            $("#dataTable2 .j_tecnico").remove();
            $(data.addtable).appendTo('.dataTable');
        }

        //ADICIONA OS VALORES CORRESPONDENTES NA LISTA NA TELA DE MONITORAMENTO
        if (data.addlist) {
            $("#dataList").remove();            
            $(data.addlist).appendTo('.dataList');
        }

        if (data.addOrcamentolist) {
            $("#orcamento-list").remove();            
            $(data.addOrcamentolist).appendTo('.orcamento-list');
        }

        if (data.addMedialist) {
            $("#media-list").remove();            
            $(data.addMedialist).appendTo('.media-list');
        }else{
            $("#media-list").remove();
        }
        if (data.addlistOciosidade) {
            $(".ociosidade-list tr").remove();            
            $(data.addlistOciosidade).appendTo('.ociosidade-list');
        }else{
            $(".ociosidade-list").remove();
        }

        if (data.qtdOs) {
            $(".qtdOs").html("Quantidade de OS:<b> "+data.qtdOs+" </b>"); 
        }
        if (data.osTec){
            $("#num_os").html(data.osTec + " Vinculadas");
        }
                  
    }, 'json');
});



    //ADICIONA O.S PARA O TÉCNICO
    $('html').on('click', '.j_add_tecnico', function (e) {
        var Incrementador = $(this).attr('num');
        var Prevent = $(this);
        var OSId = $(this).attr('id');
        var RelTo = $(this).attr('rel');
        var Callback = $(this).attr('callback');
        var Callback_action = $(this).attr('callback_action');
        var Tecnico = $("#Tecnico option:selected").val();
               

        $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, os_id: OSId, Tecnico: Tecnico}, function (data) {

            //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
            if (data.triggerErro) {
              Trigger(data.triggerErro);
          }

          if(data.trigger){
            $('.' + RelTo + '[id="' + Prevent.attr('id') + '"] .j_delete_action_confirm:eq(0)').fadeOut('fast', function () {
                $('.' + RelTo + '[id="' + Prevent.attr('id') + '"] .j_delete_action:eq(0)').fadeIn('fast');
            });
        } else {
            $('.' + RelTo + '[id="' + DelId + '"]').fadeOut('fast');
        }

            //ADICIONA OS DADOS DA O.S PARA APRESENTAR NA TABELA
            if (data.addtable) {
                $('#dataTable2 #semOS').fadeOut('fast');
                $('#dataTable #semOS').fadeOut('fast');
                $(data.addtable).appendTo('.dataTable');

                markers[OSId].setMap(null);

                var Tecnico = $("#Tecnico option:selected").text();
                $('.j_tecnico td:nth-child(6)').text(Tecnico.split(' ')[0]);

                var QtdOs = parseInt($('.qtd_OS').text());
                $('.qtd_OS').text(QtdOs - 1);
                

            }


            //DINAMIC CONTENT
            if (data.divcontent) {
                $(data.divcontent[0]).html(data.divcontent[1]);
            }
        }, 'json');

        e.preventDefault();
        e.stopPropagation();
    });

    //DELETA O.S DO TÉCNICO
    $('html').on('click', '.j_del_tecnico', function (e) {
        var Incrementador = $(this).attr('num');
        var Prevent = $(this);
        var OSId = $(this).attr('id');
        var RelTo = $(this).attr('rel');
        var Callback = $(this).attr('callback');
        var Callback_action = $(this).attr('callback_action');
        var Tecnico = $("#Tecnico option:selected").val();

        $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, os_id: OSId, Tecnico: Tecnico}, function (data) {

            //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
            if (data.trigger) {
              $('.' + RelTo + '[id="' + Prevent.attr('id') + '"] .j_delete_action_confirm:eq(0)').fadeOut('fast', function () {

                $('.' + RelTo + '[id="' + Prevent.attr('id') + '"] .j_delete_action:eq(0)').fadeIn('fast');
            });
          } else {

            $('.' + RelTo + '[id="' + DelId + '"]').fadeOut('fast');
        }
            //ADICIONA OS DADOS DA OS PARA APRESENTAR NA TABELA
            if (data.deltable) {
               $('#Tecnico').change();
          
             var image1 = './_img/marcador.png';

             var infowindow = new google.maps.InfoWindow();
             if(data.latitude){
                var latitude = data.latitude;
                if(data.longitude){
                 var longitude = data.longitude;
                 marker = new google.maps.Marker({
                    position: new google.maps.LatLng(latitude, longitude),
                    icon: image1,
                    map: map
                });
             }
         }
         markers[OSId] = marker;
         google.maps.event.addListener(marker, 'click', (function(marker) {
            return function() {
                if(data.infowindow){
                  infowindow.setContent(data.infowindow);
              }
              infowindow.open(map, marker);
          }
      })(marker));

            var QtdOs = parseInt($('.qtd_OS').text());
            $('.qtd_OS').text(QtdOs + 1);
            
           
           }

            //DINAMIC CONTENT
            if (data.divcontent) {
                $(data.divcontent[0]).html(data.divcontent[1]);
            }
        }, 'json');

        e.preventDefault();
        e.stopPropagation();
    });

    //PESQUISA OT PARA VINCULO
    $('html').on('click', '.j_pesquisa_ot', function (e) {
        var Prevent = $(this);
        var CliId = $(this).attr('rel');
        var LinhaSemOs = $(this).attr('linha_sem_os');
        var Callback = $(this).attr('callback');
        var Callback_action = $(this).attr('callback_action');
        
        $('.tabela_atribuirOtOs').fadeIn();
        document.getElementById('boxCliente').style.width = "60%";
        $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, cli_id: CliId, linhaSemOs: LinhaSemOs}, function (data) {

            //ADICIONA OS ENDEREÇOS RELACIONADOS AO ENDEREÇO PESQUISADO
            if (data.addOT) {
               
                $('.j_ot').remove();
                $(data.addOT).appendTo('.ot');
            }
             if (data.errorAddOT) {
                 $('.j_ot').remove();
                $(data.errorAddOT).appendTo('.ot');
            }
            //ADICIONA OS DADOS DA OS PARA APRESENTAR NA TABELA
            if (data.deltable) {
               $('#dataTable2 #'+ data.deltable).fadeOut(400);
               $('#dataTable #'+ data.deltable).fadeOut(400);
           }
       }, 'json');

        e.preventDefault();
        e.stopPropagation();
    });

    //PESQUISA VINCULA OT AO CLIENTE
    $('html').on('click', '.j_insere_ot', function (e) {
        var Prevent = $(this);
        var CliId = $(this).attr('rel');
        var LinhaSemOs = $(this).attr('linha_sem_os');
        var OTId = $(this).attr('id');
        var Callback = $(this).attr('callback');
        var Callback_action = $(this).attr('callback_action');

        $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, IDOS: OTId, IDCLIENTE:CliId, linhaSemOs: LinhaSemOs }, function (data) {

            //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
            if (data.trigger) {
                Trigger(data.trigger);                
            }

            //ADICIONA OS DADOS DA OS PARA APRESENTAR NA TABELA
            if (data.ot) {
                $('.tabela_atribuirOtOs').fadeOut();
               $(this).closest('tr').remove();
                $('#'+ data.ot).fadeOut(400);
                carregarTabela();
            }
        }, 'json');

        e.preventDefault();
        e.stopPropagation();
    });


 //
 $('html').on('click', '#clientesOT', function (e) {
    var Callback = $(this).attr('callback');
    var Callback_action = $(this).attr('callback_action');
    var Cliente = $("#cliente").val();
    var Data = $("#data").val();

    $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, DATAAGENDAMENTO: Data, IDCLIENTE:Cliente}, function (data) {

            //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
            if (data.trigger) {
                Trigger(data.trigger);                
            }

            //ADICIONA OS DADOS DA OS PARA APRESENTAR NA TABELA
            if (data.ot) {
                $('.j_ot').remove();
                $('#'+ data.ot).fadeOut(400);
            }
            if (data.redirect) {
                window.location.href = data.redirect;
            }
        }, 'json');

    e.preventDefault();
    e.stopPropagation();
});


    //CARREGA OS DADOS DA TELA DE HISTÓRICO DE CLIENTES E SUAS OS's
    function carregaDados(){
        var Callback = $('#dataTable').attr('callback');
        var Callback_action = $('#dataTable').attr('callback_action');
        var nomeCliente = $('#j_selectClientes').val();
        var dataCliente = $('#j_selectData').val();
        var numCliente = $('#j_selectNum').val();
        var enderecoCliente = $('#j_selectEndereco').val();
        var bairroCliente = $('#j_selectBairro').val();
        var municipioCliente = $('#j_selectMunicipio').val();
        var cepCliente = $('#j_selectCep').val();
        var cpfCliente = $('#j_selectCpf').val();
        var statusAtend = $('#j_selectStatus').val();

        $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, nomeCliente, dataCliente, numCliente, enderecoCliente, bairroCliente, municipioCliente, cepCliente, cpfCliente, statusAtend}, function (data) {

            $('.spinner').hide();
            //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
            if (data.trigger) {
                Trigger(data.trigger);                
            }

            if (data.historico) {
                $(".j_table").remove();
                $(data.historico).appendTo('.dataTable');             
            }else{
                $(".j_table").remove();
            }

        }, 'json');
        
    }

    $('html').on('click', '#sendDoc', function (e) {
        let form = $("#form_sendDoc");
        let Callback = $('#sendDoc').attr('callback');
        let Callback_action = $('#sendDoc').attr('callback_action');
        let idCliente = $('#sendDoc').attr('rel');
        

        form.ajaxSubmit({            
          url: '_ajax/gns/' + Callback + '.ajax.php',
          data: {callback_action: Callback_action, callback: Callback, idcliente: idCliente},
          dataType: 'json',
          beforeSubmit: function () {
            $('.workcontrol_pdt_size').fadeIn('fast');
          },
          uploadProgress: function (evento, posicao, total, completo) {
            var porcento = completo + '%';
            $('.workcontrol_upload_progrees').text(porcento);
      
            if (completo <= '80') {
              $('.workcontrol_upload').fadeIn().css('display', 'flex');
            }
            if (completo >= '99') {
              $('.workcontrol_upload').fadeOut('slow', function () {
                $('.workcontrol_upload_progrees').text('0%');
              });
            }
              //PREVENT TO RESUBMIT IMAGES GALLERY
              form.find('input[name="arquivos_cliente[]"]').replaceWith($('input[name="arquivos_cliente[]"]').clone());
            },
            success: function (data) {
              if (data.trigger) {
                Trigger(data.trigger);
              }
            }  
          });
      });

    //EVENTO DE CLIQUE NA TABELA DA TELA DE ORÇAMENTOS
    $(document).on('click', '.pointer', function (e) {

        let Callback = $(this).attr('callback');
        let Callback_action = $(this).attr('callback_action');
        let idCliente = $(this).attr('value');
        let idOrcamento = $(this).attr('idOrcamento');
        let IdCliente = $(this).attr('Idcliente');

        $('#j_idCliente').val(IdCliente);
        $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action,idCliente: idCliente,IdCliente, idOrcamento}, function (data) {

            //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
            if (data.trigger) {
                Trigger(data.trigger);                
            }

            //RETORNOS CORRESPONDENTES A TELA DE HISTÓRICO DE CLIENTES
            if (data.historicoOs) {
                $('#j_historicosOs *').remove();
                $(data.historicoOs).appendTo('#j_historicosOs');             
            }
            
            //RETORNOS CORRESPONDENTES A TELA DE HISTÓRICO DE CLIENTES - DADOS DO CLIENTE
            if (data.dadosCli) {
                $('#j_dadosCli *').remove();
                $(data.dadosCli).appendTo('#j_dadosCli');             
            }

            //RETORNOS CORRESPONDENTES A TELA DE HISTÓRICO DE CLIENTES - DADOS DO CLIENTE
            if (data.docsCli) {
                $('#j_docsCli *').remove();
                $(data.docsCli).appendTo('#j_docsCli');             
            }

            //RETORNOS CORRESPONDENTES A TELA DE HISTÓRICO DE CLIENTES - NÚMERO DA OT
            if (data.numot) {
                $('#j_numot *').remove();
                $(data.numot).appendTo('#j_numot');             
            }

            //RETORNOS CORRESPONDENTES A TELA DE DETALHES DE ORÇAMENTOS
            if (data.addDetalhes) {
                $('.j_detalhes *').remove();
                $(data.addDetalhes).appendTo('.j_detalhes');             
            }

            if(data.Servico){
                if(data.Peca){
                  var teste = parseInt(data.Peca) + parseInt(data.Servico); 
                  $('.itens').remove();
                  $("<span class='itens'><b>Valor:</b>(R$) " + teste + "</span>").appendTo('#itens');
               }
            }

            if(data.addServicos){
                if(data.addPecas){
                    $("#j_AddPecasServicos *").remove();
                    $(data.addPecas).appendTo('#j_AddPecasServicos');   
                    $(data.addServicos).appendTo('#j_AddPecasServicos');     
                }     
            }

            if(data.addOrcamentos){
                $("#j_Orcamentos *").remove();
                $(data.addOrcamentos).appendTo('#j_Orcamentos');       
            }
            

        }, 'json');

    });


    $('#j_selectClientes, #j_selectNum, #j_selectData, #j_selectEndereco, #j_selectBairro, #j_selectMunicipio, #j_selectCep, #j_selectCpf, #j_selectStatus').change(carregaDados);
    $("#j_selectData").datepicker({
      onSelect: function(dateText) {
        $('.spinner').show();
        carregaDados();
      }
    });


    function os_SemEnd(){

      var Callback = $("#dataTable").attr('callback');
      var Callback_action = $("#dataTable").attr('callback_action');

      $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action}, function (data) {
                //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
                if(data.Trigger){
                    Trigger(data.trigger);
                }
                //ADICIONA OS DADOS DA O.S PARA APRESENTAR NA TABELA NA TELA DE AGENDAMENTOS
                if (data.OS_sem_end) {

                    $(".j_table_S_END").remove();
                    $(data.OS_sem_end).appendTo('#j_table_S_END');
                }
            }, 'json');
  }

  $('html').on('click', '.j_inserir_coord', function (e) {

      var Callback = $(this).attr('callback');
      var Callback_action = $(this).attr('callback_action');
      var Id = $(this).attr('id');
      var lat = $("#lat"+Id).val();
      var lng = $("#lng"+Id).val();

      $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, Id: Id, Latitude: lat, Longitude:lng}, function (data) {

                //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
                if(data.Trigger){
                   Trigger(data.Trigger);
               }

               if (data.exclui_linha) {
                $('.j_table_S_END[id="' + data.exclui_linha + '"]').remove();   
            } 

        }, 'json');


  });

  //FUNÇÃO PARA CARREGAR OS DADOS DA TABGELA DA TELA DE CLIENTES SEM OT
  function carregarTabela(){
    var Callback = 'ClientesOT';
    var Callback_action = 'carregarTabela';

    $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action}, function (data) {

        //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
        if(data.Trigger){
            Trigger(data.trigger);
        }
        //ADICIONA OS DADOS DA O.S PARA APRESENTAR NA TABELA NA TELA DE AGENDAMENTOS

        if (data.addTabela){
            $('#j_cliente_semOT *').remove();
            $(data.addTabela).appendTo('#j_cliente_semOT');
        }

    }, 'json');

}


  //INCIALIZAÇÃO DA PÁGINA DE ORÇAMENTOS
  function iniciaPagina(){
    var dataAtual = new Date();
    $('#j_ano').append('<option value='+(dataAtual.getFullYear()-1)+'>' + (dataAtual.getFullYear()-1) + '</option>');
    $('#j_ano').append('<option value='+(dataAtual.getFullYear())+' selected="selected">' + dataAtual.getFullYear() + '</option>');
    $('#j_ano').append('<option value='+(dataAtual.getFullYear()+1)+'>' + (dataAtual.getFullYear()+1) + '</option>');
    $('#j_ano').selected = '2018';

    document.getElementById('j_mes').selectedIndex = dataAtual.getMonth()+1;

    $('#j_statusOrcamento').append('<option value="1">APROVADO</option>');
    $('#j_statusOrcamento').append('<option value="2">EXECUTADO</option>');
    $('#j_statusOrcamento').append('<option value="3" selected>RECUSADO</option>');
    $('#j_statusOrcamento').append('<option value="4">RECUPERADO</option>');

    carregaTabelaOrcamento();

}

// HABILITAR OU DESABILITAR FILTRO STATUS CONTATO
function contato(){

    let status = $('#j_statusOrcamento option:selected').val();
    if(status != 3){
        $('#j_statusContatos option[value="t"]').prop('selected',true);
        $('#j_statusContatos').prop('disabled',true);
    }else{
        $('#j_statusContatos').prop('disabled',false);
    }
}

// SELCIONAR TODOS OS ITENS DO ORÇAMENTO
function selecionaTodos(){

    let recuperaTodos = $('input[name="recupera-todos"').prop('checked');
    if(recuperaTodos == true){
        $('.linhas td:nth-child(5) input').each(function(){
            $(this).prop('checked',true);
        })
    }else{
        $('.linhas td:nth-child(5) input').each(function(){
            $(this).prop('checked',false);
        })
    }
}


$(document).on('click','#tabs-2 h3',function(){

    let total = 0;
    let TotalLinhas = 1;
    let linhasPecas = 1;
    let linhasServc = 1;
    let Servicos = [];
    let Pecas = [];

    $('.linhas').each(function(){

        let checkbox = $(this).find('td:nth-child(5) input').prop('checked');
        if(checkbox == true){

            // SELECIONA O VALOR DE TODOS OS INPUTS CHECKED E SOMA
            let valor = $(this).find('td:nth-child(4)').text();
            valor = valor.toString().replace('.','');
            valor = valor.toString().replace(',','.');
            total += Number(valor);

            // CALCULA TOTAL DE LINHAS SELECIONADAS E INCREMENTA NAME DAS LINHAS
            TotalLinhas++;
            let linhaIten = $(this).attr('class');
            
            if(linhaIten == "j_Pecas linhas"){

                $(this).attr('name','peca'+linhasPecas);
                let Qtd = $(this).find('td:nth-child(2)').text();
                let Valor = $(this).find('td:nth-child(3)').text();
                let Id = $(this).attr('id');
                Pecas.push([Qtd,Valor,Id]);
                console.log(Pecas);
                linhasPecas++;
            }else{

                $(this).attr('name','servico'+linhasServc++);
                let Qtd = $(this).find('td:nth-child(2)').text();
                let Valor = $(this).find('td:nth-child(3)').text();
                let Id = $(this).attr('id');
                Servicos.push([Qtd,Valor,Id]);
                console.log(Servicos);
                linhasServc++;
            }
        }else{

            let linhaIten = $(this).attr('class');
            if(linhaIten == "j_Pecas linhas"){

                $(this).attr('name','peca');

            }else{

                $(this).attr('name','servico');
            }
        }
    })
})

// EXECUTA FUNÇÃO SELECIONA TODOS OS ITENS
$(document).on('click','input[name="recupera-todos"]',function(){
    selecionaTodos();
})

// EXECURA FUNÇÃO CONTATO
$('#j_statusOrcamento').on('change',function(){
    contato();
})


$('#j_ano, #j_mes, #j_statusOrcamento, #j_statusContatos').change(carregaTabelaOrcamento);

// CARREGAR TABELA DE ORÇAMENTOS
function carregaTabelaOrcamento(){
    var Callback = $('#dataTable').attr('callback');
    var Callback_action = $('#dataTable').attr('callback_action');
    var Ano = $('#j_ano').val();
    var Mes = $('#j_mes').val();
    var Status = $('#j_statusOrcamento').val();
    var StatusContato = $('#j_statusContatos option:selected').val();

    $.post(`_ajax/gns/${Callback}.ajax.php`, {callback: Callback, callback_action: Callback_action, ano: Ano, mes: Mes, Status, StatusContato}, function (data) {

        // EXIBIR A MENSAGEM DE RETORNO DO AJAX
        if(data.Trigger){
            Trigger(data.trigger);
        }

        //ADICIONA OS DADOS NA TABELA DA TELA DE ORÇAMENTOS
        if (data.addTabela){
            $('#dataTable tbody *').remove();
            $(data.addTabela).appendTo('#dataTable tbody');
        }

        if (data.addAprovado){
            $('#j_aprovado').val(data.addAprovado);
        }

        if (data.addReprovado){
            $('#j_recusado').val(data.addReprovado);
        }

        if (data.addExecutado){
            $('#j_executado').val(data.addExecutado);
        }

        $('#j_aprovado, #j_recusado, #j_executado').attr('disabled', true);

    }, 'json');
}

// EDITAR ORÇAMENTOS RECUSADOS
$('html').on('click', '#j_btn_editar', function (e) {

    let Callback = $(this).attr('callback');
    let Callback_action = $(this).attr('callback_action');
    let idOrcamento = $(this).attr('idOrcamento');
    let Idos = $(this).attr('idos');

    $.post(`_ajax/gns/${Callback}.ajax.php`, {callback: Callback, callback_action: Callback_action, idOrcamento, Idos}, function (data) {

        //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
        if(data.Trigger){
            Trigger(data.trigger);
        }

        if(data.addContatos){
            $(".orcamentoGNS tbody tr").remove();
            $(data.addContatos).appendTo(".orcamentoGNS tbody");
        }

        if(data.addTelCliente){
            $(".telefones label").remove();
            $(data.addTelCliente).appendTo(".telefones");
        }

        if(data.addIdOS){
            $(".orcamentoGNS").attr("idos",data.addIdOS);
        }

        if(data.addIdOrca){
            $(".orcamentoGNS").attr("idor",data.addIdOrca);
        }

        if(data.addTecnicos){
            $("#j_tecnicoEntrada *").remove();
            $("#j_tecnicoExecucao *").remove();
            $(data.addTecnicos).appendTo("#j_tecnicoEntrada");
            $(data.addTecnicos).appendTo("#j_tecnicoExecucao");
        }   

        if(data.addStatus){
            $("#j_status *").remove();
            $(data.addStatus).appendTo("#j_status");
        }

        if(data.addSerRecusa != null || data.addPecasRecusa != null){

                $(".recuperar-orcamento tbody tr").remove();
                $(data.addSelecionaItens).appendTo(".recuperar-orcamento tbody");
                $(data.addSerRecusa).appendTo(".recuperar-orcamento tbody");
                $(data.addPecasRecusa).appendTo(".recuperar-orcamento tbody");
        }

        if(data.formaPagt){
            $('#j_pg option:not("option:first-child")').remove();
            $(data.formaPagt).appendTo('#j_pg');
        }

        if(data.addId){

            $("#j_id").val(data.addId);
            $("#j_dataEntrada").text(dataAtualFormatada(data[0]['DataEnt']));
            $('#j_tecnicoEntrada').val(data[0]['TecnicoEnt']);
            $("#j_dataAgend").val(dataAtualFormatada(data[0]['DataAgendamento']));
            $("#j_dataExec").val(dataAtualFormatada(data[0]['DataExe']));
            $('#j_status').val(data[0]['Status']);
            $('#j_obs').val(data[0]['Obs']);
            $('#j_valor').val(numeroParaMoeda(data[0]['Valor'],2,',','.'));


            select = $('#j_status').find('option:selected').val();
            $('#j_status option[value="1"],#j_status option[value="2"]').remove();
            $('#j_status option[value="3"]').prop('disabled',true);
            $('#j_status option[value="4"]').prop('selected',true);

            // LIMPAR CAMPOS
            $(".obs_contato").val("");
            $(".status_contato option[value='t']").prop('selected',true);

        }
    }, 'json');

});

// RECUPERAR ORÇAMENTO
$('html').on('click', '#j_btn_salvar', function (e) {

    // VARIÁVEIS DE INCREMENTO
    let total = 0;
    let TotalLinhas = 1;
    let linhasPecas = 0;
    let linhasServc = 0;

    let Servico = {
        Qtd : [],
        Valor : [],
        Id : [],
        IdServico : []
    };

    let Peca = {
        Qtd : [],
        Valor : [],
        Id : [],
        IdPeca : []
    };

    $('.linhas').each(function(){

        let checkbox = $(this).find('td:nth-child(5) input').prop('checked');
        if(checkbox == true){

            // SELECIONA O VALOR DE TODOS OS INPUTS CHECKED E SOMA
            var valor = $(this).find('td:nth-child(4)').text();
            valor = valor.toString().replace('.','');
            valor = valor.toString().replace(',','.');
            total += Number(valor);

            // CALCULA TOTAL DE LINHAS SELECIONADAS E INCREMENTA NAME DAS LINHAS
            TotalLinhas++;
            let linhaIten = $(this).attr('class');
            
            // SELECIONA CAMPOS DE PEÇAS NA TABELA
            if(linhaIten == "j_Pecas linhas"){

                let Qtd = $(this).find('td:nth-child(2)').text();
                let Valor = $(this).find('td:nth-child(3)').text();
                let Id = $(this).attr('id');
                let IdPeca = $(this).attr('idpeca');

                Peca.Qtd.push(Qtd);
                Peca.Valor.push(Valor);
                Peca.Id.push(Id);
                Peca.IdPeca.push(IdPeca);
                
                linhasPecas++;

            // SELECIONA CAMPOS DE SERVIÇOS NA TABELA
            }else{

                let Qtd = $(this).find('td:nth-child(2)').text();
                let Valor = $(this).find('td:nth-child(3)').text();
                let Id = $(this).attr('id');
                let IdServico = $(this).attr('idserv');
                
                Servico.Qtd.push(Qtd);
                Servico.Valor.push(Valor);
                Servico.Id.push(Id);
                Servico.IdServico.push(IdServico);
                
                linhasServc++;
            }   
        }
    })

    let DataRealiza = $('#j_dataEntrada').text();
    let TecnicoEntrada = $('#j_tecnicoEntrada option:selected').val();
    let DataAgend = $("#j_dataAgend").val();
    let FormaPagamento = $('#j_pg option:selected').val();
    let NumParcelas = $('#j_num-parcelas').val();
    let Obs = $('#j_obs').val();
    let IdOs = $('.seleciona-todos').attr('idos');
    let IdOrcamento = $('.seleciona-todos').attr('idorc');
    let callback = "Orcamentos";
    let callback_action = "atualizar";

   $.post(`_ajax/gns/${callback}.ajax.php`,{callback,callback_action,DataRealiza,TecnicoEntrada,DataAgend,FormaPagamento,NumParcelas,Obs,IdOs,IdOrcamento,total,Servico,Peca,linhasPecas,linhasServc},function(data){

        if(data.trigger){
            Trigger(data.trigger);
        }
   },'json');

});

// SALVAR CONTATO DE ORÇAMENTO RECUSADO
$(document).on('click','#j_btn_salvar_contato',function(){

    let callback = "Orcamentos";
    let callback_action = "salvar_contato";
    let status = $(".status_contato option:selected").val();
    let Obs = $(".obs_contato").val();
    let IdOs = $(".orcamentoGNS").attr("idos");
    let IdOrc = $(".orcamentoGNS").attr("idor");
    
    $.post(`_ajax/gns/${callback}.ajax.php`,{callback,callback_action,status,Obs,IdOs,IdOrc},function(data){

        if (data.trigger) {
            Trigger(data.trigger);
            $('#j_btn_editar').trigger('click');
        }


    }, 'json');
})


// FECHAR MODAL AO CLICAR EM CANCELAR
$('html').on('click', '#j_btn_cancelar', function (e) {
    $('#j_modal, .blocker').hide();
});


$('html').on('click', '#j_importar', function (e) {
    var form = $("#j_form_osManual");
    var callback = form.find('input[name="callback"]').val();
    var callback_action = form.find('input[name="callback_action"]').val();

    if (typeof tinyMCE !== 'undefined') {
        tinyMCE.triggerSave();
    }

    form.ajaxSubmit({
        url: '_ajax/gns/' + callback + '.ajax.php',
        dataType: 'json',
        beforeSubmit: function () {
            $('.workcontrol_pdt_size').fadeIn('fast');
            $('input[name="os_manual"]').val("");

        },
        uploadProgress: function (evento, posicao, total, completo) {
            var porcento = completo + '%';
            $('.workcontrol_upload_progrees').text(porcento);

            if (completo <= '80') {
                $('.workcontrol_upload').fadeIn().css('display', 'flex');
            }
            if (completo >= '99') {
                $('.workcontrol_upload').fadeOut('slow', function () {
                    $('.workcontrol_upload_progrees').text('0%');
                });
            }
            //PREVENT TO RESUBMIT IMAGES GALLERY
            form.find('input[name="os_manual"]').replaceWith($('input[name="os_manual"]').clone());
        },
        success: function (data) {
            if (data.trigger) {
                Trigger(data.trigger);
            }          
 
        }
    });
});

function numeroParaMoeda(n, c, d, t)
{
    c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}


$( function() {
    $( "#tabs" ).tabs();
} );