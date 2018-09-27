function iniciaPagina(){
    var dataAtual = new Date();
    $('#j_ano').append('<option value='+(dataAtual.getFullYear()-1)+'>' + (dataAtual.getFullYear()-1) + '</option>');
    $('#j_ano').append('<option value='+(dataAtual.getFullYear())+' selected="selected">' + dataAtual.getFullYear() + '</option>');
    $('#j_ano').append('<option value='+(dataAtual.getFullYear()+1)+'>' + (dataAtual.getFullYear()+1) + '</option>');

    document.getElementById('j_mes').selectedIndex = dataAtual.getMonth()+1;

    carregaPagina();
}

function carregaPagina(){
    var callback = $('#dataPage').attr('callback');
    var callback_action = $('#dataPage').attr('callback_action');
    var ano = $('#j_ano').val();
    var mes = $('#j_mes').val();

    $('#dataTable_sem_certificar *').remove();
    $('#j_faturamento *').remove();
    $('#j_previsao *').remove();
    $('.spinner').show();

    $.post('_ajax/diretoria/' + callback + '.ajax.php', {callback, callback_action, ano, mes}, function (data) {

        //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
        if(data.Trigger){
            Trigger(data.trigger);
        }

        $('.spinner').hide();

        if(data.dataTable_sem_certificar){
            $(data.dataTable_sem_certificar).appendTo('#dataTable_sem_certificar');
        }

        if(data.j_faturamento){
            $(data.j_faturamento).appendTo('#j_faturamento');
        }

        if(data.j_previsao){
            $(data.j_previsao).appendTo('#j_previsao');
        }

    }, 'json');
}

$('#j_ano').change(carregaPagina);

$('#j_mes').change(carregaPagina);