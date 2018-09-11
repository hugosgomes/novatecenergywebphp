
$(document).ready(function(){
 mesAtual();
  mostraDados('Home','consulta',0);
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
  var ordemAnalise = $('#j_ordemEmAnalise').attr('ordemAnalise');
  var ordemExecutando = $('#j_ordemExecutando').attr('ordemExecutando');


  $.post('_ajax/clientes_particulares/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, endereco: Endereco, cliente: Cliente, mes:Mes, 
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

        if (data.addExecutando) {            
            $('.js_h2_executando').remove();
            $(data.addExecutando).appendTo('#js_executando');
        }

  }, 'json');
}


function abreModal(element){
  var Callback = element.getAttribute('callback');
  var Callback_action = element.getAttribute('callback_action');
  var id = element.getAttribute('id');
  $.post('_ajax/clientes_particulares/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, idOrcamento: id}, function (data) {  

  if(data.addClienteModal){
    $('.dados_clientes').remove();
    $(data.addClienteModal).appendTo('#j_dados_clientes');
  }      
        
  if(data.addTecnicos){
    $('#j_select_tecnicos option').remove();
    $(data.addTecnicos).appendTo('#j_select_tecnicos');
  } 

  if(data.addHistorico){
    $('#j_historico li').remove();
    $(data.addHistorico).appendTo('#j_historico');
  }else{
    $('#j_historico li').remove();
  }

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

            mostraDados('Home','consulta',0);

            if(data.addHistorico){
              $('#j_historico li').remove();
              $(data.addHistorico).appendTo('#j_historico');
            }else{
              $('#j_historico li').remove();
            }             
        }
    });
    return false;
});

<<<<<<< Updated upstream
function mesAtual(){
  var data = new Date();
  var mes = data.getMonth();
  document.getElementById('mes').selectedIndex = mes;
=======
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
>>>>>>> Stashed changes
}