
//CONSULTA NO BANCO QUANDO MUDA O TÉCNICO NO SELECT
$('#Tecnico').change(function(){
    var Tecnico = $(this).val();
    var Callback = $(this).attr('callback');
    var Callback_action = $(this).attr('callback_action');
    var Dia = $(this).attr('rel');
    var S = $(this).attr('semana');

    $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, Tecnico: Tecnico, dia: Dia, semana: S}, function (data) {

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
               // $('#'+ data.deltable).fadeOut(400);
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
               // $('.j_ot, .table *').remove();
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
                //window.location.reload();
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

        $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, nomeCliente, dataCliente, numCliente, enderecoCliente, bairroCliente, municipioCliente, cepCliente, cpfCliente}, function (data) {

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


    //EVENTO DE CLIQUE NA TABELA DA TELA DE ORÇAMENTOS
    $(document).on('click', '.pointer', function (e) {

        var Callback = $(this).attr('callback');
        var Callback_action = $(this).attr('callback_action');
        var idCliente = $(this).attr('value');
        var idOrcamento = $(this).attr('idOrcamento');
        var IdCliente = $(this).attr('Idcliente');

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


    $('#j_selectClientes, #j_selectNum, #j_selectData, #j_selectEndereco, #j_selectBairro, #j_selectMunicipio, #j_selectCep, #j_selectCpf').change(carregaDados);
    $("#j_selectData").datepicker({
      onSelect: function(dateText) {
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

$('#j_ano, #j_mes, #j_statusOrcamento').change(carregaTabelaOrcamento);

function carregaTabelaOrcamento(){
    var Callback = $('#dataTable').attr('callback');
    var Callback_action = $('#dataTable').attr('callback_action');
    var Ano = $('#j_ano').val();
    var Mes = $('#j_mes').val();
    var Status = $('#j_statusOrcamento').val();

    $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, ano: Ano, mes: Mes, Status}, function (data) {

        //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
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


$('html').on('click', '#j_btn_editar', function (e) {
    var Callback = $(this).attr('callback');
    var Callback_action = $(this).attr('callback_action');
    var idOrcamento = $(this).attr('idOrcamento');

    $.post(`_ajax/gns/${Callback}.ajax.php`, {callback: Callback, callback_action: Callback_action, idOrcamento}, function (data) {

        //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
        if(data.Trigger){
            Trigger(data.trigger);
        }

        if(data.addContatos){
            $(".orcamentoGNS tbody tr").remove();
            $(data.addContatos).appendTo(".orcamentoGNS tbody");
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

        }
    }, 'json');

});


$('html').on('click', '#j_btn_salvar', function (e) {
    var form = $("#j_form");
    var callback = form.find('input[name="callback"]').val();
    var callback_action = form.find('input[name="callback_action"]').val();
    var id = form.find('input[name="ID"]').val();

    if (typeof tinyMCE !== 'undefined') {
        tinyMCE.triggerSave();
    }

    form.ajaxSubmit({
        url: '_ajax/gns/' + callback + '.ajax.php',
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
            form.find('input[name="image[]"]').replaceWith($('input[name="image[]"]').clone());
        },
        success: function (data) {
            if (data.trigger) {
                Trigger(data.trigger);
            }

            //DATA CLEAR INPUT
            if (data.ID) {
                $('.pointer[idorcamento="'+data.ID+'"]').click(); 
                $('#j_btn_cancelar').click();
                $('#j_form input[type!="hidden"]').val("");
                $('#j_form select').val("t");
            }
        }
    });

});

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

/*------------------EXPORT PARA EXCEL------------------*/
//PESQUISA VINCULA OT AO CLIENTE
    $('html').on('click', '#exportar', function (e) {
        var Callback = $(this).attr('callback');
        var Callback_action = $(this).attr('callback_action');        
        var Tecnico = $("#Tecnico option:selected").val();
        var Dia = $(this).attr('rel');
        var S = $(this).attr('semana');

        $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, Tecnico: Tecnico, dia: Dia, semana: S}, function (data) {

            //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
            if (data.excel) {
                window.open("http://192.168.0.101:83/rodrigo/novatec/download/ExportarGNS.xlsx");                
            }
        }, 'json');

        e.preventDefault();
        e.stopPropagation();
    });

function numeroParaMoeda(n, c, d, t)
{
    c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}


$( function() {
    $( "#tabs" ).tabs();
} );