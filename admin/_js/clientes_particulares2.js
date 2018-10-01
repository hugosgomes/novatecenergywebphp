
$(document).ready(function(){
  mesAtual();
  mostraDados('Home2','consulta',0);
});


$('.j_select_endereco').change(function(){
          mostraDados($(this).attr('callback'),$(this).attr('callback_action'),1);
});

$('.j_select_cliente').change(function(){
          mostraDados($(this).attr('callback'),$(this).attr('callback_action'),1);
});

$('#mes').change(function(){
          mostraDados($(this).attr('callback'),$(this).attr('callback_action'),1);
});

function ordenarOrcamentoAnalise(){
    mostraDados('Home2','consulta',1,"analise");
}

function ordenarOrcamentoAgendado(){
    mostraDados('Home2','consulta',1,"agendado");
}

function ordenarOrcamentoExecutando(){
    mostraDados('Home2','consulta',1,"executando");
}


function mostraDados(Callback, Callback_action, inicial, ordem = null){
  //O PARAMETRO INICIAL É PARA DETERMINAR SE A CHAMADA FOI FEITA NO CARREGAMENTO DA PÁGINA OU NÃO PARA PREENCHER OS SELECTS DA PÁGINA
  var Endereco = $('#endereco').val();
  var Cliente = $('#cliente').val();
  var Mes = $('#mes').val();
  var ordemAnalise = $('#j_ordemEmAnalise').attr('ordemAnalise');
  var ordemExecutando = $('#j_ordemExecutando').attr('ordemExecutando');
  var ordemAgendado = $('#j_ordemAgendado').attr('ordemAgendado');


  $.post('_ajax/clientes_particulares/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, endereco: Endereco, cliente: Cliente, mes:Mes, 
    inicial: inicial, ordemAnalise: ordemAnalise, ordemExecutando: ordemExecutando, ordem: ordem, ordemAgendado: ordemAgendado}, function (data) {  

       //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
        if(data.Trigger){
            Trigger(data.trigger);            
        }   

        if(data.teste){
            console.log(data.teste);            
        }     

        if(data.addcoluna1){
            $('.j_coluna_1 .clientes_sem_contato').remove();
            $(data.addcoluna1).appendTo('.j_coluna_1');
        }else{
          $('.j_coluna_1 .clientes_sem_contato').remove();
        }

        if(data.addcoluna2){
            $('.j_coluna_2 .clientes_sem_contato').remove();
            $(data.addcoluna2).appendTo('.j_coluna_2');
        }else{
          $('.j_coluna_2 .clientes_sem_contato').remove();
        }

        if(data.addcoluna3){
            $('.j_coluna_3 .clientes_sem_contato').remove();
            $(data.addcoluna3).appendTo('.j_coluna_3');
        }else{
          $('.j_coluna_3 .clientes_sem_contato').remove();
        }

        if(data.addcoluna4){
            $('.j_coluna_4 .clientes_sem_contato').remove();
            $(data.addcoluna4).appendTo('.j_coluna_4');
        }else{
          $('.j_coluna_4 .clientes_sem_contato').remove();
        }

        if(data.addcoluna5){
            $('.j_coluna_5 .clientes_sem_contato').remove();
            $(data.addcoluna5).appendTo('.j_coluna_5');
        }else{
          $('.j_coluna_5 .clientes_sem_contato').remove();
        }

        if(data.addcoluna6){
            $('.j_coluna_6 .clientes_sem_contato').remove();
            $(data.addcoluna6).appendTo('.j_coluna_6');
        }else{
          $('.j_coluna_6 .clientes_sem_contato').remove();
        }

        if(data.addcoluna7){
            $('.j_coluna_7 .clientes_sem_contato').remove();
            $(data.addcoluna7).appendTo('.j_coluna_7');
        }else{
          $('.j_coluna_7 .clientes_sem_contato').remove();
        }
        
        if (data.addComboEndereco) {            
            $('.j_option_endereco').remove();
            $(data.addComboEndereco).appendTo('.j_select_endereco');
        }  

        if (data.addComboCliente) {
            $('.j_option_cliente').remove();
            $(data.addComboCliente).appendTo('.j_select_cliente');
        }

        if (data.addEmAnalise) {
            $('.js_h2_emAnalise').remove();
            $(data.addEmAnalise).appendTo('#js_emAnalise');
        }

        if (data.addServicoAgendado) {            
            $('.js_h2_agendado').remove();
            $(data.addServicoAgendado).appendTo('#js_agendado');
        }

        if (data.addExecutando) {            
            $('.js_h2_executando').remove();
            $(data.addExecutando).appendTo('#js_executando');
        }

        if (data.addExecutado) {            
            $('.js_h2_executado').remove();
            $(data.addExecutado).appendTo('#js_executado');
        }

        if (data.addCanceladoRecusado) {            
            $('.js_h2_canceladoRecusado').remove();
            $(data.addCanceladoRecusado).appendTo('#js_canceladoRecusado');
        }

  }, 'json');
}


function abreModal(element){
  var Callback = element.getAttribute('callback');
  var Callback_action = element.getAttribute('callback_action');
  var id = element.getAttribute('id');
  var status = element.getAttribute('status');

  $.post('_ajax/clientes_particulares/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, idOrcamento: id, status: status}, function (data) {  

  if(data.addClienteModal){
    $('.dados_clientes').remove();
    $(data.addClienteModal).appendTo('#j_dados_clientes');
  }      
        
  if(data.addTecnicos){
    $('#j_select_tecnicos option').remove();
    $(data.addTecnicos).appendTo('#j_select_tecnicos');
  } 

  if(data.addHistorico){
    $('#j_historico div').remove();
    $(data.addHistorico).appendTo('#j_historico');
  }else{
    $('#j_historico div').remove();
  }

  if(data.statusOrcamento){
    $('#j_statusOrcamento option').remove();
    $(data.statusOrcamento).appendTo('#j_statusOrcamento');
  }

  //TRAVANDO CAMPOS DE ACORDO COM O STATUS QUE CARREGAR NA TELA.
  travaCampos($('#j_statusOrcamento').val());

  }, 'json');
}


$('html').on('click', '#wc_pdt_stoc', function () {
        
    var form = $("#j_form");
    var callback = form.find('input[name="callback"]').val();
    var callback_action = form.find('input[name="callback_action"]').val();
    var id = $('.cl_dados').attr('id');

    if (typeof tinyMCE !== 'undefined') {
        tinyMCE.triggerSave();
    }

    form.ajaxSubmit({            
        url: '_ajax/clientes_particulares/' + callback + '.ajax.php',
        data: {idOrcamento:id},
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
            if (data.inpuval) {
                if (data.inpuval === 'null') {
                    $('.wc_value').val("");
                } else {
                    $('.wc_value').val(data.inpuval);
                }
            }

            mostraDados('Home2','consulta',0);

            if(data.addHistorico){
              $('#j_historico div').remove();
              $(data.addHistorico).appendTo('#j_historico');
            }else{
              $('#j_historico div').remove();
            }             
        }
    });
    return false;
});

$('html').on('click', '#j_edit_chamado', function (e) {
  var ID = $(this).attr('rel');
  var Callback = $(this).attr('callback');
  var Callback_action = $(this).attr('callback_action');

  $.post('_ajax/clientes_particulares/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, ID: ID}, function (data) {

            //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
            if (data.trigger) {
                Trigger(data.trigger);
            }

            //ADICIONA OS DADOS DA O.S PARA APRESENTAR NA TABELA
            if (data.editaChamado) {
                $('.j_statusOrcamento').val(1);
                $('.j_tecnico').val(data.editaChamado['TECNICO']);
                $('.j_valor').val(data.editaChamado['VALOR']);
                $('.j_forma').val(data.editaChamado['FORMAPAGAMENTO']);
                $('.j_qnt').val(data.editaChamado['NUM_PARCELAS']);
                $('.j_obs').val(data.editaChamado['OBS']);
            }
            if(data.addIdChamado){
               $(data.addIdChamado).prependTo('#j_form');
            }
        }, 'json');

        e.preventDefault();
        e.stopPropagation();
});

function mesAtual(){
  var data = new Date();
  var mes = data.getMonth();
  document.getElementById('mes').selectedIndex = mes;
}


$('#j_statusOrcamento').change(function(){
          travaCampos($(this).val());
});

function travaCampos(valor){
  switch(valor){
    case '0':
    case '6':
    case '7':
      $('#j_select_tecnicos').attr('disabled', true);
      $('.j_data').attr('disabled', true);
      $('.j_valor').attr('disabled', true);
      $('.j_forma').attr('disabled', true);
      $('.j_qnt').attr('disabled', true);
      $('#j_select_tecnicos').val('');
      $('.j_data').val('');
      $('.j_valor').val('');
      $('.j_forma').val('');
      $('.j_qnt').val('');
      break;

    case '1':
    case '3':
    case '4':
    case '5':
      $('#j_select_tecnicos').attr('disabled', false);
      $('.j_data').attr('disabled', false);
      $('.j_valor').attr('disabled', true);
      $('.j_forma').attr('disabled', true);
      $('.j_qnt').attr('disabled', true);
      $('.j_valor').val('');
      $('.j_forma').val('');
      $('.j_qnt').val('');
      break;

    case '2':
      $('#j_select_tecnicos').attr('disabled', true);
      $('.j_data').attr('disabled', true);
      $('.j_valor').attr('disabled', false);
      $('.j_forma').attr('disabled', false);
      $('.j_qnt').attr('disabled', false);
      $('#j_select_tecnicos').val('');
      $('.j_data').val('');
      break;
  }
}



//MUDANÇA DE MÊS
  function filtro_mes(el) {

    var display = document.getElementById(el).style.display;

    if(display == "none")
      document.getElementById(el).style.display = 'inline-block';
  else
      document.getElementById(el).style.display = 'none';

  $( ".target" ).change(function() {

      document.getElementById(el).style.display = 'none';
  });

}
