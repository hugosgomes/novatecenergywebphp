
$(document).ready(function(){
  mostraDados('Home','consulta',0);
  iniciaPagina();
});


$('.j_select_endereco').change(function(){
      mostraDados($(this).attr('callback'),$(this).attr('callback_action'),1);
});

$('.j_select_cliente').change(function(){
      mostraDados($(this).attr('callback'),$(this).attr('callback_action'),1);
});

//CONSULTA DEFAULT ENDEREÇO
  $(document).on('input',"#visivel-end",function(){

    let input = $(this).val();
    if(input.length == 0){
      let end = $('#endereco').val();
      let cli = $('#cliente').val();
        
          $("#endereco").val("t");
          $("#cliente").val("t");
          $("#visivel").val("");
          mostraDados($("#endereco").attr('callback'),$("#endereco").attr('callback_action'),1);
        }
    
  });

  //CONSULTA DEFAULT CLIENTE
  $(document).on('input',"#visivel",function(){

    let input = $(this).val();
    if(input.length == 0){
      let end = $('#endereco').val();
      let cli = $('#cliente').val();
    
          $("#endereco").val("t");
          $("#cliente").val("t");
          $("#visivel-end").val("");
          mostraDados($("#cliente").attr('callback'),$("#cliente").attr('callback_action'),1);
        }
    
  });

$('#mes,#j_ano').change(function(){
      mostraDados($(this).attr('callback'),$(this).attr('callback_action'),1);
});

function ordenarOrcamentoAnalise(){
    mostraDados('Home','consulta',1,"analise");
}

function ordenarOrcamentoExecutando(){
    mostraDados('Home','consulta',1,"executando");
}


function mostraDados(Callback, Callback_action, inicial, ordem = null){
  //O PARAMETRO INICIAL É PARA DETERMINAR SE A CHAMADA FOI FEITA NO CARREGAMENTO DA PÁGINA OU NÃO PARA PREENCHER OS SELECTS DA PÁGINA
  var Endereco = $('#endereco').val();
  var Cliente = $('#cliente').val();
  var Mes = $('#mes').val();
  var ano = $('#j_ano').val();
  var ordemAnalise = $('#j_ordemEmAnalise').attr('ordemAnalise');
  var ordemExecutando = $('#j_ordemExecutando').attr('ordemExecutando');


  $.post('_ajax/clientes_particulares/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, endereco: Endereco, cliente: Cliente, mes:Mes, ano:ano,
    inicial: inicial, ordemAnalise: ordemAnalise, ordemExecutando: ordemExecutando, ordem: ordem}, function (data) {  

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

        //INPUT ENDEREÇOS AUTOCOMPLETE
        if (data.addComboEndereco) {
          arrayEnd = [];
          
          var end = data.addComboEndereco.split('*');
          for (var i = 0; i < end.length; i++) {
           arrayEnd.push(end[i]);
          }
          searchNome(arrayEnd,'#visivel-end','#endereco');
        } 

        //INPUT CLIENTES AUTOCOMPLETE
        if (data.addComboCliente) {
          arrayNome = [];
          
          var cliente = data.addComboCliente.split('*');
          for (var i = 0; i < cliente.length; i++) {
           arrayNome.push(cliente[i]);
          }
          searchNome(arrayNome,'#visivel','#cliente');
        }

        if (data.addEmAnalise) {
            $('.js_h2_emAnalise').remove();
            $(data.addEmAnalise).appendTo('#js_emAnalise');
        }

        if (data.addExecutando) {            
            $('.js_h2_executando').remove();
            $(data.addExecutando).appendTo('#js_executando');
        }

        if (data.addExecutado) {  
            $('.js_h2_executado').remove();
            $(data.addExecutado).appendTo('#js_executado');
        }

        if (data.addCancelado) {            
            $('.js_h2_cancelado').remove();
            $(data.addCancelado).appendTo('#js_cancelado');
        }

        if (data.addRecusado) {            
            $('.js_h2_recusado').remove();
            $(data.addRecusado).appendTo('#js_recusado');
        }

  }, 'json');
}


function abreModal(element){
  var Callback = element.getAttribute('callback');
  var Callback_action = element.getAttribute('callback_action');
  var id = element.getAttribute('id');
  var status = element.getAttribute('status');

  //HABILITA O SELECT DE STATUS DE ORÇAMANTO
  $('#j_statusOrcamento').prop('disabled',false);

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

  $('.j_obs').val("");
  $('#wc_pdt_stoc').show();
  $('#salvar_edicao').hide();

  //TRAVANDO CAMPOS DE ACORDO COM O STATUS QUE CARREGAR NA TELA.
  travaCampos($('#j_statusOrcamento').val());

  }, 'json');
}


$('#wc_pdt_stoc').on('click', function (e) {

    if(verificaCampos($('#j_statusOrcamento').val()) == false){
      return;
    }
        
    var form = $(".j_form");
    var callback = form.find('input[name="callback"]').val();
    var callback_action = form.find('input[name="callback_action"]').val();
    var IDCHAMADO = form.find('input[name="IDCHAMADO"]').val();
    var id = $('.cl_dados').attr('id');

    if (typeof tinyMCE !== 'undefined') {
        tinyMCE.triggerSave();
    }

    form.ajaxSubmit({            
        url: '_ajax/clientes_particulares/' + callback + '.ajax.php',
        data: {idOrcamento:id, ID: IDCHAMADO},
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

            mostraDados('Home','consulta',0);

            if(data.addHistorico){
              $('#j_historico div').remove();
              $(data.addHistorico).appendTo('#j_historico');
            }else{
              $('#j_historico div').remove();
            }

            $('#j_statusOrcamento').attr('disabled', false);
            
            //FECHAR MODAL APÓS GERAR NOVO CHAMADO
            $('.close-modal').trigger("click");
        }
    });
    return false;
});


$('html').on('click','#salvar_edicao',function(){
    var Callback = 'Home';
    var Callback_action = 'salva-edicao';
    var idOrcamento = $('.cl_dados').attr('id');
    var IdChamado = $('#j_edit_chamado').attr('rel');
    var obs = $('.j_obs').val();
    var dataAgendamento = $('.j_form input[name="DATAAGENDAMENTO"]').val();
    var tecnico = $('#j_select_tecnicos option:selected').val();
    var valor = $('.j_form input[name="VALOR"]').val();
    var formaPagamento = $('#forma-pagamento option:selected').val();
    var qntParcelas = $('.j_form input[name="QNTPARCELAS"]').val();

    $.post('_ajax/clientes_particulares/' + Callback + '.ajax.php', {QNTPARCELAS:qntParcelas,FORMAPAGAMENTO:formaPagamento,VALOR:valor,TECNICO:tecnico,DATAAGENDAMENTO:dataAgendamento,OBS:obs,callback: Callback, callback_action: Callback_action, ID: IdChamado,idOrcamento:idOrcamento},function(data){
        //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
        if (data.trigger) {
            Trigger(data.trigger);
            //ATUALIZA A EXIBIÇÃO NA PÁGINA
            mostraDados('Home','consulta',0);
        }
        if(data.salva_edicao){
          var obs = $('.j_obs').val(" ");
          var dataAgendamento = $('#j_form input[name="DATAAGENDAMENTO"]').val(" ");
          var tecnico = $('#j_select_tecnicos option:selected').val("");
          var valor = $('#j_form input[name="VALOR"]').val(" ");
          var formaPagamento = $('#forma-pagamento option:selected').val(" ");
          var qntParcelas = $('#j_form input[name="QNTPARCELAS"]').val(" ");
          $('#wc_pdt_stoc').show();
          $('#salvar_edicao').hide();
          $('.close-modal').trigger("click");
          $('#j_statusOrcamento').prop('disabled',false);
        }
    },'json');
})

$('html').on('click', '#j_edit_chamado', function (e) {
  var ID = $(this).attr('rel');
  var Callback = $(this).attr('callback');
  var Callback_action = $(this).attr('callback_action');

  $('#wc_pdt_stoc').hide();
  $('#salvar_edicao').show();

  $.post('_ajax/clientes_particulares/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, ID: ID}, function (data) {

            //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
            if (data.trigger) {
                Trigger(data.trigger);
            }

            //ADICIONA OS DADOS DA O.S PARA APRESENTAR NA TABELA
            if (data.editaChamado) {
                //PERMITIR APENAS 2 DIGITOS APÓS A VIRGULA
                var valor = Number(data.editaChamado['VALOR']);

                $('.j_status').val(data.editaChamado['TIPO_SERVICO']);
                $('.j_data').val(data.editaChamado['DATAAGENDADA']);
                $('.j_tecnico').val(data.editaChamado['TECNICO']);
                $('.j_valor').val(numeroParaMoeda(valor, 2, ',', '.'));
                $('.j_forma').val(data.editaChamado['FORMAPAGAMENTO']);
                $('.j_qnt').val(data.editaChamado['NUM_PARCELAS']);
                $('.j_obs').val(data.editaChamado['OBS']);
                travaCampos(data.editaChamado['TIPO_SERVICO']);
                $('#j_statusOrcamento').attr('disabled', true);
            }
            if(data.addIdChamado){
               $(data.addIdChamado).prependTo('.j_form');
            }
        }, 'json');

        e.preventDefault();
        e.stopPropagation();
});

/*
* n = numero a converter
* c = numero de casas decimais
* d = separador decimal
* t = separador milhar
*/

//CONVERTAR NÚMERO NO FORMATO MOEDA
function numeroParaMoeda(n, c, d, t)
{
  c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
  return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
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
      $('#j_select_tecnicos').attr('disabled', false);
      $('.j_data').attr('disabled', false);
      $('.j_valor').attr('disabled', false);
      $('.j_forma').attr('disabled', false);
      $('.j_qnt').attr('disabled', false);
    break;

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

function verificaCampos(status){
  switch(status){
    case '1':
    case '3':
    case '4':
    case '5':

      if($('.j_data').val() == ''){
        alert("O Campo Data é Obrigatório!");
        return false;
      }

      if(!$('#j_select_tecnicos').val()){
        alert("O Campo Técnico é Obrigatório!");
        return false;
      }
      
    break;

    case '2':

      if($('.j_valor').val() == ''){
        alert("O Campo Valor é Obrigatório!");
        return false;
      }

      if(!$('.j_forma').val()){
        alert("O Campo Forma de Pagamento é Obrigatório!");
        return false;
      }

      if($('.j_qnt').val() == '' && $('.j_forma').val() == 0){
        alert("O Campo Quantidade de Parcelas é Obrigatório!");
        return false;
      }
      break;
  }
}

function iniciaPagina(){
  var dataAtual = new Date();
    $('#j_ano').append('<option value='+(dataAtual.getFullYear()-1)+'>' + (dataAtual.getFullYear()-1) + '</option>');
    $('#j_ano').append('<option value='+(dataAtual.getFullYear())+' selected="selected">' + dataAtual.getFullYear() + '</option>');
    $('#j_ano').append('<option value='+(dataAtual.getFullYear()+1)+'>' + (dataAtual.getFullYear()+1) + '</option>');
    $('#j_ano').selected = dataAtual.getFullYear();
}


// AUTOCOMPLETE JQUERY UI

function searchNome(arrNome,InpV,InpI) {

  //CALLBACK PERSONALIZADO PARA CORRESPONDER APENAS AO INÍCIO DOS TERMOS
  $(InpV).autocomplete({
    
    autoFocus:true,
    source: function(request, response) {
          var matcher = new RegExp( "[^\D]" + $.ui.autocomplete.escapeRegex(request.term), "i" );
          response($.grep(arrNome, function(item){
              return matcher.test(item);
          }) );
        }
  });

  //SELECIONA POR TERMO ESPECÍFICO
  $(document).on('change',InpV,function(){

    let nome = $(this).val();

    //DIVIDE A STRING EM DUAS PARTES E USA A SEGUNDA
    arrayN = nome.split(' ');

    //COLOCA O SEGUNDO VALOR NO ATRIBUTO DO INPUT
    $(InpI).val(arrayN[0]);

    //CHAMA O EVENTO DE CHANGE NO INPUT
    $(InpI).change();
    
  })

  
} 



