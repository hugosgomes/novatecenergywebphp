

//VARIÁVEL PARA DETERMINAR TEMPO DE EVENTOS JQUERY 
var tempoEvento = 500; 

//EXIBE CHECKBOX 
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
function exibirEocultarFormaPg(){
        $('.o_aprovado_reprovado').change(function(){

            var o_status = $(this).val();

        if(o_status == 'o_aprovado'){
            $('#o_forma-pgt').fadeIn(tempoEvento);
        }
        if(o_status == 'o_reprovado'){
            $('#o_forma-pgt').fadeOut(tempoEvento);
        }
    })

}


//ADICIONA NOVA LINHA NA TABELA COM NOME DA PEÇA QUANTIDADE VALOR UNITÁRIO E TOTAL
function adicionaLinhaTabela_peca(){
    $('.j_add_pecas').click(function(){

        //SELECIONA VALORES 
        var desc = $('#o_peca option:selected').text();
        var qTd = $('#o_qtd-pecas').val();
        var valorUnit = $('#o_peca option:selected').attr('id');

        //ADICIONA MASCARA VALOR UNITARIO
        var valorUnitMask = numeroParaMoeda(valorUnit, 2, ',', '.');

        var valorTotalLinha = qTd * valorUnit;
        var valorTotalLinhaMask = numeroParaMoeda(valorTotalLinha, 2, ',', '.');

        //ADICIONA LINHA NA TABELA
        var adicionaLinha = '<tr>'+
                                '<td style="text-align: center;">'+
                                   desc+ 
                                '</td>'+
                                '<td style="text-align: center;">'+
                                   qTd +
                                '</td >'+
                                '<td id="j_valor" style="text-align: center;">'+
                                   valorUnitMask+ 
                                '</td>'+
                                '<td id="j_valor" class="valorUnit" style="text-align: center;">'+
                                   valorTotalLinha+

                                '</td>'+
                                '<td style="text-align: center;"><span class="j_add_pecas icon-cross btn btn_red"></span>'+
                                '</td>'+
                            '</tr>';

            $('#o_tabela-pecasEservicos').prepend(adicionaLinha);

            //console.log(valorTotalLinhaMask);
           calculaTotalTable();
    })
}

//EXIBE SELECT DE ACORDO COM O TIPO DE CLIENTE(COM PLANO/SEM PLANO)
function tipoDeCliente(){
    $('.o_tipoCliente').change(function(){
       valor =  $(this).val();
       if(valor == 'o_tipoClienteCp'){

            //EXIBE SELECT PARA CLIENTE COM PLANO
            $('#o_cliente_com_plano').fadeIn(tempoEvento - 200);
            $('#o_cliente_sem_plano').fadeOut(tempoEvento - 200);

            //SELECIONA VALORES EM PESQUISAR SERVIÇOS PARA CLIENTES COM PLANO

       }
       if(valor == 'o_tipoClienteSp'){

            //EXIBE SELECT PARA CLIENTE SEM PLANO
            $('#o_cliente_com_plano').fadeOut(tempoEvento - 200);
            $('#o_cliente_sem_plano').fadeIn(tempoEvento - 200);

            //SELECIONA VALORES EM PESQUISAR SERVIÇOS PARA CLIENTES COM PLANO
       }
    })
}

//ADICIONA LINHA NA TABELA ORÇAMENTO REFERENTE A SERVICO
function adicionaLinhaTabela_s(){

        //SELECIONA O VALOR DO REDIOS QUE O CHECKED = CHECKED
        radiosChecked = $('.o_tipoCliente:checked').val();
        console.log(radiosChecked);


        if(radiosChecked == 'o_tipoClienteCp'){

            //EXIBE SELECT PARA CLIENTE COM PLANO
            var desc = $('#o_servicos_c_com_p option:selected').text();
            var qTd = $('#o_qtd_servicos').val();
            var valorUnit = $('#o_servicos_c_com_p option:selected').attr('id');

       }
       if(radiosChecked == 'o_tipoClienteSp'){

            //EXIBE SELECT PARA CLIENTE SEM PLANO
            var desc = $('#o_servicos_s_com_p option:selected').text();
            var qTd = $('#o_qtd_servicos').val();
            var valorUnit = $('#o_servicos_s_com_p option:selected').attr('id');

       }

        //ADICIONA MASCARA VALOR UNITARIO
        var valorUnitMask = numeroParaMoeda(valorUnit, 2, ',', '.');

        var valorTotalLinha = qTd * valorUnit;
        var valorTotalLinhaMask = numeroParaMoeda(valorTotalLinha, 2, ',', '.');

        //ADICIONA LINHA NA TABELA
        var adicionaLinha = '<tr>'+
                                '<td style="text-align: center;">'+
                                   desc+ 
                                '</td>'+
                                '<td style="text-align: center;">'+
                                   qTd +
                                '</td >'+
                                '<td id="j_valor" style="text-align: center;">'+
                                   valorUnitMask+ 
                                '</td>'+
                                '<td id="j_valor" class="valorUnit" style="text-align: center;">'+
                                   valorTotalLinha+

                                '</td>'+
                                '<td style="text-align: center;"><span class="j_add_pecas icon-cross btn btn_red"></span>'+
                                '</td>'+
                            '</tr>';

            $('#o_tabela-pecasEservicos').prepend(adicionaLinha);
            console.log(valorTotalLinhaMask);
           calculaTotalTable();
    //})
}

//SOMA DO TOTAL DE TODAS AS LINHAS DA TABELA
function calculaTotalTable(){
    valorTotal = 0;
    $('.valorUnit').each(function(){
        valorTotal += parseFloat($(this).text());
        console.log(valorTotal);
        valorTotalSMask = moedaParaNumero(valorTotal);
        valorTotalMask = numeroParaMoeda(valorTotalSMask, 2, ',', '.')
    });
    if(valorTotal == 0){
         $('.valor-total').text(0);
    }else{
        $('.valor-total').text(valorTotalMask);
    }
}

//REMOVE LINHA ESPECÍFICA DA TABELA AO CLICAR NO BUTTON REMOVER
function removeLinhaTabela(){
    $(document).on('click','#o_tabela-pecasEservicos .icon-cross',function(){
        $(this).parent().parent().remove();
        calculaTotalTable();
    })
}

//DETERMINA VALOR MÍNIMO
function valorMinimoInput(){
    var valorDigitado = $('#o_parcelas-seleciona').val();
    if(valorDigitado < 13){
        $('#o_parcelas-seleciona').val(13);
    }
}

$('#o_parcelas-seleciona').blur(function(){
     valorMinimoInput();
})

/*
* n = numero a converter
* c = numero de casas decimais
* d = separador decimal
* t = separador milhar
*/

//MASCARA PARA CONVERTAR NÚMERO NO FORMATO MOEDA
function numeroParaMoeda(n, c, d, t)
{
    c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

//MASCARA PARA CONVERTER DE MOEDA PARA NÚMERO
function moedaParaNumero(valor)
{
    return isNaN(valor) == false ? parseFloat(valor) :   Number(valor.replace("R$","").replace(".","").replace(",","."));
}

//DISPONIBILIZAR FUNÇÃO DEPOIS QUE O DOCUMENTO FOR CARREGADO
$(document).ready(function() {
    adicionaLinhaTabela_peca();

    $('.j_add_servicos').click(function(){
        adicionaLinhaTabela_s();
    })
    
    exibeCheckbox();
    removeLinhaTabela();
    tipoDeCliente();
    exibirEocultarFormaPg();
});




//consultaDescricao();

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
