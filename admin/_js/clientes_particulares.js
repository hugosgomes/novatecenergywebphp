
$(document).ready(function(){
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
            //exibeModal();
        }else{
          $('.j_coluna_3 .clientes_sem_contato').remove();
        }

        if(data.addcoluna4){
            $('.j_coluna_4 .clientes_sem_contato').remove();
            $(data.addcoluna4).appendTo('.j_coluna_4');
            //exibeModal();
        }else{
          $('.j_coluna_4 .clientes_sem_contato').remove();
        }

        if(data.addcoluna5){
            $('.j_coluna_5 .clientes_sem_contato').remove();
            $(data.addcoluna5).appendTo('.j_coluna_5');
            //exibeModal();
        }else{
          $('.j_coluna_5 .clientes_sem_contato').remove();
        }

        if(data.addcoluna6){
            $('.j_coluna_6 .clientes_sem_contato').remove();
            $(data.addcoluna6).appendTo('.j_coluna_6');
            //exibeModal();
        }else{
          $('.j_coluna_6 .clientes_sem_contato').remove();
        }

        if(data.addcoluna7){
            $('.j_coluna_7 .clientes_sem_contato').remove();
            $(data.addcoluna7).appendTo('.j_coluna_7');
            //exibeModal();
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

function salvarChamado(){
    //alert('Teste');
}


function teste(){
  Callback = 'Home';
    Callback_action = 'consulta_modal';
    id = 88;
  $.post('_ajax/clientes_particulares/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, idcliente: id}, function (data) {        
        
        if(data.addTecnicos){
          
          $('#j_select_tecnicos option').remove();
          $(data.addTecnicos).appendTo('#j_select_tecnicos');
        }

    }, 'json');
}