//EXIBER CHECKBOX  
var tempoEvento = 500; 
function exibeCheckbox(){
    $("#vazamento").change(function() {
        if(this.checked) {
            $('.vazamento-L').fadeIn(tempoEvento);
        }
    });
    $("#ok").change(function() {
        if(this.checked) {
            $('.vazamento-L').fadeOut(tempoEvento);
            $('#status-ocorrencia').fadeOut(tempoEvento);

        }
    });
    $('#maior-5L').change(function(){
        if(this.checked){
            $('#status-ocorrencia').fadeIn(tempoEvento);
        }
    })

    $('#menor-5L').change(function(){
        if(this.checked){
            $('#status-ocorrencia').fadeOut(tempoEvento);
        }
    })
}

//EXIBE E OCULTA IMPUTE FOTOS DEFEITOS
$("#instalacao-ok").change(function() {
    if(this.checked){
        $('#foto-defeito').fadeIn(tempoEvento);
    }
});

$("#instalacao-defeito").change(function() {
    if(this.checked){
        $('#foto-defeito').fadeOut(tempoEvento);
    }
});

//EXIBE E OCULTA IMPUTES ORÇAMENTO
$("#orc-aprovado").change(function() {
    if(this.checked){
        $('#forma-pgt').fadeIn(tempoEvento);
    }
});
$("#orc-reprovado").change(function() {
    if(this.checked){
        $('#forma-pgt').fadeOut(tempoEvento);
    }
});


 //ADICIONA O.S PARA O TÉCNICO
    /*$('html').on('click', '.j_add_pecas', function (e) {
        var PecaId = $("#peca option:selected").val();
        var PecaQtd = $(".j_qtd_pecas").val();
        var Callback = $(this).attr('callback');
        var Callback_action = $(this).attr('callback_action');


        $.post('_ajax/gns/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, PecaId: PecaId, PecaQtd: PecaQtd}, function (data) {

            //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
            if (data.trigger) {
                Trigger(data.trigger);

            }

            //ADICIONA OS DADOS DA O.S PARA APRESENTAR NA TABELA
            if (data.addtable) {
               
            }

        
        }, 'json');

        e.preventDefault();
        e.stopPropagation();
    });*/




function adicionaLinhaTabela(){
    $('.j_add_pecas').click(function(){
        var desc = $('#Peca option:selected').text();
        var qTd = $('#qtd-pecas').val();
        var valorUnit = $('#Peca option:selected').attr('id');

        var adicionaLinha = '<tr>'+
                                '<td style="text-align: center;">'+
                                   desc+ 
                                '</td>'+
                                '<td style="text-align: center;">'+
                                   qTd +
                                '</td >'+
                                '<td style="text-align: center;">'+
                                   valorUnit+ 
                                '</td>'+
                                '<td style="text-align: center;">'+
                                   (qTd * valorUnit)+
                                '</td>'+
                            '</tr>';
        setTimeout(function(){
            $('#tabela-pecas').prepend(adicionaLinha);
        },tempoEvento - 100)
    })
}

adicionaLinhaTabela();




/*
function consultaDescricao(){
    $(document).on('click','.j_consulta-descricao',function(){

        var Callback = $('#callback').attr('callback');
        var Callback_action = $('#callback_action').attr('callback_action');
       
            $.get('_ajax/'+Callback+'.ajax.php', {callback: Callback, callback_action: Callback_action}, function(data){  

           //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
       if(data.Trigger){
        Trigger(data.trigger);
        
        }   

        if(data.teste){
            alert(data.teste);          
        }     

    }, 'json');
    })
  //O PARAMETRO INICIAL É PARA DETERMINAR SE A CHAMADA FOI FEITA NO CARREGAMENTO DA PÁGINA OU NÃO PARA PREENCHER OS SELECTS DA PÁGINA

}
*/
//consultaDescricao();
exibeCheckbox();
