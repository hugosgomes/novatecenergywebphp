
//CONSULTA NO BANCO QUANDO MUDA O TÉCNICO NO SELECT
 $('#Tecnico').change(function(){
    var Tecnico = $(this).val();
    var Callback = $(this).attr('callback');
    var Callback_action = $(this).attr('callback_action');
    var Dia = $(this).attr('rel');
    var S = $(this).attr('semana');

    $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, Tecnico: Tecnico, dia: Dia, semana: S}, function (data) {

        //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
        if(data.Trigger){
            Trigger(data.trigger);
        }
        //ADICIONA OS DADOS DA O.S PARA APRESENTAR NA TABELA NA TELA DE AGENDAMENTOS
        if (data.addtable) {
            $("#dataTable .j_tecnico").remove();
            $("#dataTable2 .j_tecnico2").remove();
           $(data.addtable).appendTo('.dataTable');      
        }

        //ADICIONA OS VALORES CORRESPONDENTES NA LISTA NA TELA DE MONITORAMENTO
        if (data.addlist) {
            $("#dataList").remove();
            $(data.addlist).appendTo('.dataList');
        }            
    }, 'json');
});

    //ADICIONA O.S PARA O TÉCNICO
    $('html').on('click', '.j_add_tecnico', function (e) {
        var Prevent = $(this);
        var OSId = $(this).attr('id');
        var RelTo = $(this).attr('rel');
        var Callback = $(this).attr('callback');
        var Callback_action = $(this).attr('callback_action');
        var Tecnico = $("#Tecnico option:selected").val();

        $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, os_id: OSId, Tecnico: Tecnico}, function (data) {

            //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
            if (data.trigger) {
                Trigger(data.trigger);
                $('.' + RelTo + '[id="' + Prevent.attr('id') + '"] .j_delete_action_confirm:eq(0)').fadeOut('fast', function () {
                    $('.' + RelTo + '[id="' + Prevent.attr('id') + '"] .j_delete_action:eq(0)').fadeIn('fast');
                });
            } else {
                $('.' + RelTo + '[id="' + DelId + '"]').fadeOut('fast');
            }

            //ADICIONA OS DADOS DA O.S PARA APRESENTAR NA TABELA
            if (data.addtable) {
                $('#semOS').fadeOut('fast');
                $(data.addtable).appendTo('.dataTable');
                $('.info-window').fadeOut(400);
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
        var Prevent = $(this);
        var OSId = $(this).attr('id');
        var RelTo = $(this).attr('rel');
        var Callback = $(this).attr('callback');
        var Callback_action = $(this).attr('callback_action');
        var Tecnico = $("#Tecnico option:selected").val();

        $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, os_id: OSId, Tecnico: Tecnico}, function (data) {

            //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
            if (data.trigger) {
                Trigger(data.trigger);
                $('.' + RelTo + '[id="' + Prevent.attr('id') + '"] .j_delete_action_confirm:eq(0)').fadeOut('fast', function () {
                    $('.' + RelTo + '[id="' + Prevent.attr('id') + '"] .j_delete_action:eq(0)').fadeIn('fast');
                });
            } else {
                $('.' + RelTo + '[id="' + DelId + '"]').fadeOut('fast');
            }
            //ADICIONA OS DADOS DA OS PARA APRESENTAR NA TABELA
            if (data.deltable) {
                $('#'+ data.deltable).fadeOut(400);
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
        

        $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, cli_id: CliId, linhaSemOs: LinhaSemOs}, function (data) {

            //ADICIONA OS ENDEREÇOS RELACIONADOS AO ENDEREÇO PESQUISADO
            if (data.addOT) {
                $('.j_ot').remove();
                $(data.addOT).appendTo('.ot');
            }
            //ADICIONA OS DADOS DA OS PARA APRESENTAR NA TABELA
            if (data.deltable) {
                $('#'+ data.deltable).fadeOut(400);
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

        $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, IDOT: OTId, IDCLIENTE:CliId, linhaSemOs: LinhaSemOs }, function (data) {

            //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
            if (data.trigger) {
                Trigger(data.trigger);                
            }

            //ADICIONA OS DADOS DA OS PARA APRESENTAR NA TABELA
            if (data.ot) {
                $('.j_ot, .table *').remove();
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
        var idCliente = $('#j_selectClientes').val();

        $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, idCliente: idCliente}, function (data) {

            //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
            if (data.trigger) {
                Trigger(data.trigger);                
            }

            if (data.historico) {
                //alert('deu bom ');
                $(".j_table").remove();
                $(data.historico).appendTo('.dataTable');             
            }

            if (data.selectClientes) {
                $(data.selectClientes).appendTo('#j_selectClientes');             
            }

        }, 'json');
        
    }


    $('html').on('click', '.pointer', function (e) {
        var Callback = $(this).attr('callback');
        var Callback_action = $(this).attr('callback_action');
        var idCliente = $(this).attr('value');

        $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, idCliente: idCliente}, function (data) {

            //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
            if (data.trigger) {
                Trigger(data.trigger);                
            }

            if (data.historicoOs) {
                $('#j_historicosOs *').remove();
                $(data.historicoOs).appendTo('#j_historicosOs');             
            }


        }, 'json');

    });


    $('#j_selectClientes').change(carregaDados);


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


  function iniciaPagina(){
    var dataAtual = new Date();
    $('#j_ano').append('<option value='+(dataAtual.getFullYear()-1)+'>' + (dataAtual.getFullYear()-1) + '</option>');
    $('#j_ano').append('<option value='+(dataAtual.getFullYear())+' selected="selected">' + dataAtual.getFullYear() + '</option>');
    $('#j_ano').append('<option value='+(dataAtual.getFullYear()+1)+'>' + (dataAtual.getFullYear()+1) + '</option>');
    $('#j_ano').selected = '2018';

    document.getElementById('j_mes').selectedIndex = dataAtual.getMonth();

    $('#j_statusOrcamento').append('<option value="0">APROVADO</option>');
    $('#j_statusOrcamento').append('<option value="1">RECUSADO</option>');
    $('#j_statusOrcamento').append('<option value="2">EXECUTADO</option>');

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