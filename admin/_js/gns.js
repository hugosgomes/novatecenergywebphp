
$(document).ready( function () {

    var Callback = 'Agendamentos';
    var Callback_action = 'consultar_Os';
    var  formattedAddress = null;

    $.post('_ajax/gns/'+ Callback +'.ajax.php', {callback: Callback, callback_action: Callback_action}, function (data) {

            //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
            if (data.trigger) {
                Trigger(data.trigger);                
            }


            if (data.OS_Send) {

                var enderecos = data.OS_Send;
                var i = 0;
                while(i < enderecos.length){
                   axios.get('https://maps.googleapis.com/maps/api/geocode/json',{

                    params:{
                        address: enderecos[i],
                        key:'AIzaSyCvvTXNMC_SZgxgGcyNFxoZszqsGQ0FOg0'
                    }

                })
                   .then(function(response){

                     formattedAddress = response.data.results[0].formatted_address;
                    var lat = response.data.results[0].geometry.location.lat;
                    var lng = response.data.results[0].geometry.location.lng;

                    console.log(formattedAddress);

               })

                   i++;
               }

    
           } 




     }, 'json'); // POST


    $('#dataTable').DataTable({
      paging: false,
      compact: true,
      hover: false,
      searching: false,
      info: false
  });


});



//CONSULTA NO BANCO QUANDO MUDA O TÉCNICO NO SELECT
$(function(){
    $('#Tecnico').change(function(){
        var Tecnico = $(this).val();
        var Callback = $(this).attr('callback');
        var Callback_action = $(this).attr('callback_action');


        $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, Tecnico: Tecnico}, function (data) {

                //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
                if(data.Trigger){
                    Trigger(data.trigger);
                }
                //ADICIONA OS DADOS DA O.S PARA APRESENTAR NA TABELA NA TELA DE AGENDAMENTOS
                if (data.addtable) {
                    $("#dataTable .j_tecnico").remove();
                    $(data.addtable).appendTo('.dataTable');
                }

                //ADICIONA OS VALORES CORRESPONDENTES NA LISTA NA TELA DE MONITORAMENTO
                if (data.addlist) {
                    $("#dataList").remove();
                    $(data.addlist).appendTo('.dataList');
                } 

                //ADICIONA OS VALORES CORRESPONDENTES NA LISTA NA TELA DE MONITORAMENTO
                if (data.addOrcamentolist) {
                    $("#orcamento-list").remove();
                    $(data.addOrcamentolist).appendTo('.orcamento-list');
                } 

            }, 'json');

    });
});



    //ADICIONA O.S PARA O TÉCNICO
    $('html, body').on('click', '.j_add_tecnico', function (e) {
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
                $(data.addtable).prependTo('.dataTable');
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
    $('html, body').on('click', '.j_del_tecnico', function (e) {
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
    $('html, body').on('click', '.j_pesquisa_ot', function (e) {
        var Prevent = $(this);
        var CliId = $(this).attr('rel');
        var Callback = $(this).attr('callback');
        var Callback_action = $(this).attr('callback_action');

        $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, cli_id: CliId}, function (data) {

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
    $('html, body').on('click', '.j_insere_ot', function (e) {
        var Prevent = $(this);
        var CliId = $(this).attr('rel');
        var OTId = $(this).attr('id');
        var Callback = $(this).attr('callback');
        var Callback_action = $(this).attr('callback_action');

        $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, IDOT: OTId, IDCLIENTE:CliId}, function (data) {

            //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
            if (data.trigger) {
                Trigger(data.trigger);                
            }

            //ADICIONA OS DADOS DA OS PARA APRESENTAR NA TABELA
            if (data.ot) {
                $('.j_ot').remove();
                $('#'+ data.ot).fadeOut(400);
            }
        }, 'json');

        e.preventDefault();
        e.stopPropagation();
    });


 //
 $('html, body').on('click', '#clientesOT', function (e) {
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
        }, 'json');

    e.preventDefault();
    e.stopPropagation();
});





