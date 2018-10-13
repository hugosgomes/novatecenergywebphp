
var totalLinhasP = 1;
var totalLinhasS = 1;
//VARIÁVEL PARA DETERMINAR TEMPO DE EVENTOS JQUERY 
var tempoEvento = 500; 

//EXIBE CHECKBOX 
function exibeCheckbox(){
  $("#vazamento").change(function() {
    if(this.checked) {
      $('.t_vazamento-L').fadeIn(tempoEvento);
    }
  });
  $("#ok").change(function() {
    if(this.checked) {
      $('.t_vazamento-L').hide();
      $('#status-ocorrencia').hide();
      $("input[name='t_2status']").prop('checked', false);
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

//EXIBE E OCULTA IMPUT FOTOS DEFEITOS
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

$('.o_forma_de_pagamento_select').change(function(){

  var o_forma_de_pagamento = $(this).val();

  if(o_forma_de_pagamento == 0){
    $('#o_quant_parcelas').fadeIn(tempoEvento);
  }
  if(o_forma_de_pagamento != 0){
    $('#o_quant_parcelas').fadeOut(tempoEvento);
    $("input[name='O_quant_parcelas']").prop('checked', false);
  }
});


//ADICIONA NOVA LINHA NA TABELA COM NOME DA PEÇA QUANTIDADE VALOR UNITÁRIO E TOTAL
function adicionaLinhaTabela_peca(){
    var iPeca = 0;
    var iQtd = 0;
    var iApr = 0;
    
    $('.j_add_pecas').click(function(){

        //SELECIONA VALORES 
        var desc = $('#o_peca option:selected').text();
        var qTd = $('#o_qtd-pecas').val();
        var valorUnit = $('#o_peca option:selected').val();
        var idTr = $('#o_peca option:selected').prop('id');
        var selectValorOption = $('#o_peca option:selected').val();
        var selectAtributoOption = $('#o_peca option:selected').prop('disabled');

        //IMPEDE O USUÁRIO DE ADICIONAR LINHAS NA TABELA ANTES DE SELECIONAR PEÇA 
        if(selectValorOption == 't' || selectAtributoOption == true){
            $('#o_peca').focus();
        }

        //IMPEDE O USUÁRIO DE ADICIONAR VÁRIAS VEZES A MESMA PEÇA
        if(selectValorOption != 't' && selectAtributoOption == false){

        //DESABILITAR O OPTION QUE JÁ TEVE SEU VALOR ADICIONADO NA TABELA
        $('#o_peca #'+idTr).attr('disabled','disabled');

        var geraInputHidden = '<input class="o_id_peca" id="p'+idTr+'" type="hidden" value="'+idTr+'" name="o_id_peca'+(iPeca++)+'">';

        //ADICIONA MASCARA VALOR UNITARIO DA  PEÇA
        var valorUnitMask = numeroParaMoeda(valorUnit, 2, ',', '.');

        var valorTotalLinha = qTd * valorUnit;
        var valorTotalLinhaMask = numeroParaMoeda(valorTotalLinha, 2, ',', '.');

        //ADICIONA LINHA NA TABELA
        var adicionaLinha = '<tr id="'+idTr+'" class="adicionaLinhaPecas">'+
                                '<td style="width:60%"><input type="text" id="'+idTr+'" name="o_descricao_peca" value="'+desc+'" readonly>'+
                                   //desc+ 
                                '</td>'+
                                '<td class="o_quant_peca" style="width:10%"><input type="number" id="'+idTr+'" name="o_quant_peca'+(iQtd++)+'" value="'+qTd+'" readonly>'+
                                   //qTd +
                                '</td >'+
                                '<td id="j_valor" style="width:10%"><input id="'+idTr+'" type="text" name="" value="'+valorUnitMask+'"  readonly>'+
                                   //valorUnitMask+ 
                                '</td>'+
                                '<td id="j_valor" class="valorUnit" style="width:10%"><input id="'+idTr+'" type="text" name="o_valor_final_peca" value="'+valorTotalLinha+'"  readonly>'+
                                   //valorTotalLinha+
                                '<td class="o_aprovado_p" style="width:10%;text-align:center;"><input class="o_ckeck_status_o" type="checkbox" name="o_aprovado_p'+(iApr++)+'" value="aprovado" style="width:40%" checked>'+
                                '</td>'+
                                '</td>'+
                                '<td style="text-align: center;width:10%"><span id="o_remove_linha_P" class="j_add_pecas icon-cross btn btn_red" style="margin:0;"></span>'+
                                '</td>'+
                            '</tr>';

            $('#o_tabela-pecasEservicos').prepend(adicionaLinha);
            $('.o_p_hidden').append(geraInputHidden);
            $('.o_p_total_linhas input').val(totalLinhasP++);
            $('#o_qtd-pecas').val(1);

           //CALCULA E EXIBE O VALOR DO ORÇAMENTO 
           calculaTotalTable();
           percorreLinhasP();
        }

        
    })
}

//ADICIONA LINHA NA TABELA ORÇAMENTO 
function adicionaLinhaTabela_s(){
    var iServico = 0;
    var iQtd = 0;
    var iApr = 0;

      $('.j_add_servicos').click(function(){
        //SELECIONA O VALOR DO RADIOS QUE O CHECKED FOR TRUE
        radiosChecked = $('.o_tipoCliente:checked').val();

        if(radiosChecked == 'o_tipoClienteCp'){

            //EXIBE SELECT PARA CLIENTE COM PLANO
            var desc = $('#o_servicos_c_com_p option:selected').text();
            var qTd = $('#o_qtd_servicos').val();
            var valorUnit = $('#o_servicos_c_com_p option:selected').val();
            var idTr = $('#o_servicos_c_com_p option:selected').attr('id');

            var idServico = '<input class="o_id_servico" id="s'+idTr+'" type="hidden" value="'+idTr+'" name="o_id_servico'+(iServico++)+'">';
            var selectValorOption = $('#o_servicos_c_com_p option:selected').val();
            var selectAtributoOption = $('#o_servicos_c_com_p option:selected').prop('disabled');
       }

       if(radiosChecked == 'o_tipoClienteSp'){

            //EXIBE SELECT PARA CLIENTE SEM PLANO
            var desc = $('#o_servicos_s_com_p option:selected').text();
            var qTd = $('#o_qtd_servicos').val();
            var valorUnit = $('#o_servicos_s_com_p option:selected').attr('id');
            var valorUnit = $('#o_servicos_s_com_p option:selected').val();
            var idTr = $('#o_servicos_s_com_p option:selected').attr('id');


            var idServico = '<input id="s'+idTr+'" type="hidden" value="'+idTr+'" name="o_id_servico'+(iServico++)+'">';
            var selectValorOption = $('#o_servicos_s_com_p option:selected').val();
            var selectAtributoOption = $('#o_servicos_s_com_p option:selected').prop('disabled');

       }

       //DESABILITA O OPTION QUE JÁ TEVE SEU VALOR ADICIONADO NA TABELA
        $('#o_servicos_c_com_p #'+idTr).attr('disabled','disabled');
        $('#o_servicos_s_com_p #'+idTr).attr('disabled','disabled');

        //IMPEDE O USUÁRIO DE ADICIONAR LINHAS NA TABELA ANTES DE SELECIONAR SERVICOS
        if(selectValorOption == 't' || selectAtributoOption == true){
            $('#o_servicos_c_com_p').focus();
            $('#o_servicos_s_com_p').focus();
        }

        //IMPEDE O USUÁRIO DE ADICIONAR VÁRIAS VEZES O MESMO SERVIÇO
        if(selectValorOption != 't' && selectAtributoOption == false){

        //ADICIONA MASCARA VALOR UNITARIO
        var valorUnitMask = numeroParaMoeda(valorUnit, 2, ',', '.');

        var valorTotalLinha = qTd * valorUnit;
        var valorTotalLinhaMask = numeroParaMoeda(valorTotalLinha, 2, ',', '.');

        //ADICIONA LINHA NA TABELA
        var adicionaLinha = '<tr id="'+idTr+'" class="adicionaLinhaServicos">'+
                                '<td style="width:60%"><input type="text" name="" value="'+desc+'" readonly>'+
                                   //desc+ 
                                '</td>'+
                                '<td class="o_quant_servico" style="width:10%"><input type="text" name="o_quant_servico'+(iQtd++)+'" value="'+qTd+'" readonly>'+
                                   //qTd +
                                '</td >'+
                                '<td id="j_valor" style="width:10%"><input type="text" name="" value="'+valorUnitMask+'" readonly>'+
                                   //valorUnitMask+ 
                                '</td>'+
                                '<td id="j_valor" class="valorUnit" style="width:10%"><input type="text" name="" value="'+valorTotalLinha+'" readonly>'+
                                   //valorTotalLinha+

                                '</td>'+
                                '<td class="o_aprovado_s" style="width:10%;text-align:center;"><input class="o_ckeck_status_o" type="checkbox" name="o_aprovado_s'+(iApr++)+'" value="aprovado" style="width:40%" checked>'+
                                '</td>'+
                                '</td>'+
                                '<td style="text-align:center;width:10%"><span id="o_remove_linha_S" class="j_add_pecas icon-cross btn btn_red"></span>'+
                                '</td>'+
                            '</tr>';

            $('#o_tabela-pecasEservicos').prepend(adicionaLinha);
            $('.o_s_hidden').append(idServico);
            $('.o_s_total_linhas input').val(totalLinhasS++);
            $('#o_qtd_servicos').val(1);
            calculaTotalTable();
            percorreLinhasS();
}
      })
        
}

//EXIBE SELECT DE ACORDO COM O TIPO DE CLIENTE(COM PLANO/SEM PLANO)
function tipoDeCliente(){
    $('.o_tipoCliente').change(function(){
       valor =  $(this).val();
       if(valor == 'o_tipoClienteCp'){

            //EXIBE SELECT PARA CLIENTE COM PLANO
            $('#o_cliente_com_plano').show();
            $('#o_cliente_sem_plano').hide();

       }
       if(valor == 'o_tipoClienteSp'){

            //EXIBE SELECT PARA CLIENTE SEM PLANO
            $('#o_cliente_com_plano').hide();
            $('#o_cliente_sem_plano').show();

       }
    })
}

//SOMA DO TOTAL DE TODAS AS LINHAS DA TABELA
function calculaTotalTable(){
    valorTotal = 0;
    valorTotalR = 0;
    //PERCORRE TODOS OS INPUTS VALOR TOTAL
    $('.valorUnit input').each(function(){
        valorTotal += parseFloat($(this).val());

        valorTotalSMask = moedaParaNumero(valorTotal);
        valorTotalMask = numeroParaMoeda(valorTotalSMask, 2, ',', '.')
    });

    if(valorTotal == 0){
         $('.valor-total').text(0);
         $('#valor-total').val(0);
         $('#valor-total-reprovado').val(0);
    }else{
        $('.valor-total').text(valorTotalMask);
        $('#valor-total').val(valorTotal);

        $('.o_ckeck_status_o').each(function(){
          camposCheck = $(this).prop('checked');
          if(camposCheck == true){
            $('#valor-total-reprovado').val(valorTotal.toFixed(2));
          }else{
            valorTotalR += parseFloat($(this).parent().parent().find('.valorUnit input').val());
            $('#valor-total-reprovado').val(valorTotal.toFixed(2) - valorTotalR.toFixed(2));
          }
        })
    }
}

//GERAR ORÇAMENTO REPROVADO
function geraOrcamentoReprovado(){
    $(document).on('change','.o_ckeck_status_o',function(){

        var valorTotalRep = Number($('#valor-total-reprovado').val());
        var statusCheck =  $(this).prop('checked');
        var valCheck = Number($(this).parent().parent().find('.valorUnit input').val());

        //REMOVE VALOR SE CONDIÇÃO FOR TRUE OU ADICIONA SE CONDIÇÃO FOR FALSE
        if(statusCheck == true){
            valorTotalRemove = valorTotalRep + valCheck;
            $('#valor-total-reprovado').val(valorTotalRemove.toFixed(2));
        }else{
            valorTotalAdd = valorTotalRep - valCheck;
            $('#valor-total-reprovado').val(valorTotalAdd.toFixed(2));
        }
    })

}

//REMOVE LINHA ESPECÍFICA DA TABELA AO CLICAR NO BUTTON REMOVER
function removeLinhaTabela(id){
  
    $(document).on('click','#o_tabela-pecasEservicos #'+id,function(){
      var idDoButton = $(this).attr('id');
      

      if(idDoButton == 'o_remove_linha_P'){

        //DECRESCE A QUANTIDADE DE LINHAS NO INPUT HIDDEN
        var valorInput = $('.o_p_total_linhas input').val();
        $('.o_p_total_linhas input').val(valorInput -1);

        //HABILITA O OPTION COM id == idLinha NO SELECT PESQUISAR PEÇAS
        var idLinha = $(this).parent().parent().attr('id');
        $('#o_peca #'+idLinha).attr('disabled',false);
        $('.o_p_hidden #p'+idLinha).remove();
         totalLinhasP--;
      }

      if(idDoButton == 'o_remove_linha_S'){
        var valorInput = $('.o_s_total_linhas input').val();
        $('.o_s_total_linhas input').val(valorInput -1);

        //HABILITA O OPTION COM id == idLinha NO SELECT PESQUISAR SERVIÇO
        var idLinha = $(this).parent().parent().attr('id');
        $('#o_servicos_c_com_p #'+idLinha).attr('disabled',false);
        
        //HABILITA O OPTION COM id == idLinha NO SELECT PESQUISAR SERVIÇO
        var idLinha = $(this).parent().parent().attr('id');
        $('#o_servicos_s_com_p #'+idLinha).attr('disabled',false);
        $('.o_s_hidden #s'+idLinha).remove();
         totalLinhasS--;
      }

      $(this).parent().parent().remove();

      calculaTotalTable();

      //LINHA PEÇAS
      percorreLinhasP();
      //LINHA SERVIÇOS
      percorreLinhasS();
     
    })
}

function percorreLinhasP(){
  iQtd = 0;
  iPec = 0;
  iApr = 0;

  $('.o_quant_peca input').each(function(){
    $(this).attr('name','o_quant_peca'+(iQtd++));
  })
  $('.o_id_peca').each(function(){
    $(this).attr('name','o_id_peca'+(iPec++));
  })
  $('.o_aprovado_p .o_ckeck_status_o').each(function(){
    $(this).attr('name','o_aprovado_p'+(iApr++));
  })
}

function percorreLinhasS(){
  iQtd = 0;
  iPec = 0;
  iApr = 0;

  $('.o_quant_servico input').each(function(){
        $(this).attr('name','o_quant_servico'+(iQtd++));
  })
  $('.o_id_servico').each(function(){
    $(this).attr('name','o_id_servico'+(iPec++));
  })
  $('.o_aprovado_s .o_ckeck_status_o').each(function(){
    $(this).attr('name','o_aprovado_s'+(iApr++));
  })
}


//DETERMINA VALOR MÍNIMO QUE DEVE SER DIGITADO NO INPUT
function valorMinimoInput(id,valorMin){
  var valorDigitado = $(id).val();
  if(valorDigitado < valorMin){
    $(id).val(valorMin);
  }
}


//SETAR VALOR MÍNIMO PARA INPUTS
$('#o_parcelas-seleciona').blur(function(){
 valorMinimoInput('#o_parcelas-seleciona',13);
})

$('#o_qtd-pecas').blur(function(){
 valorMinimoInput('#o_qtd-pecas',1);
})

$('#o_qtd_servicos').blur(function(){
 valorMinimoInput('#o_qtd_servicos',1);
})



$('.o_parcelas').change(function(){
    valorParcelas = $(this).val();
  if(valorParcelas > 12){
    $('#o_parcelas-seleciona').fadeIn(tempoEvento);
    $('#o_parcelas-seleciona').val('13');
  }

  if(valorParcelas < 13){
    $('#o_parcelas-seleciona').fadeOut(tempoEvento);
  }
})

$('#o_parcelas-seleciona').blur(function(){
  var valor = $(this).val();
  $('#o_parcelas_maior_12').val(valor);
})

//ALERTA AO USUÁRIO A SALVAR DADOS ANTES DE SAIR DA PÁGINA
window.addEventListener("beforeunload",function(event){
    event.returnValue = "";
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
    adicionaLinhaTabela_s();
    exibeCheckbox();
    removeLinhaTabela('o_remove_linha_P');
    removeLinhaTabela('o_remove_linha_S');
    tipoDeCliente();
    geraOrcamentoReprovado();
});


exibeCheckbox();

//DISTRIBUIÇÃO INTERNA
$('#btn_distribuicao_interna').click(function(){
  $("input[name*='dist-interna'").remove();
  var obj = $('#dist-interna select');    
  createHidden(obj);
  obj = $('#d-dist-interna-tbody span');
  createHiddenSpan(obj);
  if (!$(".linha-distribuicao-interna").length) {
    $("#lista-defeitos").append("<tr class='linha-distribuicao-interna'><td>Distribuição Interna</td><td style='text-align: center;'><span namehidden='dist-interna' class='btn-remove-linha icon-cross btn btn_red'></span></td></tr>");
  }    
});

$('#btn_aparelho_gas').click(function(){
  $("input[name*='ap-gas'").remove();
  var obj = $('#Ap-gas select');
  createHidden(obj);
  obj = $('#d_ap-gas-tbody span');
  createHiddenSpan(obj);
  if (!$(".linha-ap-gas").length) {
    $("#lista-defeitos").append("<tr class='linha-ap-gas'><td>Aparelhos a Gás</td><td style='text-align: center;'><span namehidden='ap-gas' class='btn-remove-linha icon-cross btn btn_red'></span></td></tr>");
  }
});

$('#btn_liga-ap').click(function(){
  $("input[name*='liga-ap'").remove();
  var obj = $('#liga-ap select');
  createHidden(obj);
  obj = $('#d_liga-ap-tbody span');
  createHiddenSpan(obj);
  if (!$(".linha-liga-ap").length) {
    $("#lista-defeitos").append("<tr class='linha-liga-ap'><td>Ligações dos Aparelhos a Gás </td><td style='text-align: center;'><span namehidden='liga-ap' class='btn-remove-linha icon-cross btn btn_red'></span></td></tr>");
  }
});

$('#btn_ind-exaust').click(function(){
  $("input[name*='ind-exaust'").remove();
  var obj = $('#ind-exaust select');
  createHidden(obj);
  obj = $('#d_ind-exaust_tbody span');
  createHiddenSpan(obj);
  if (!$(".linha-ind-exaust").length) {
    $("#lista-defeitos").append("<tr class='linha-ind-exaust'><td>Individual de Exautão Natural e Forçada</td><td style='text-align: center;'><span namehidden='ind-exaust' class='btn-remove-linha icon-cross btn btn_red'></span></td></tr>");
  }
});

$('#btn_cole-exaust').click(function(){
  $("input[name*='cole-exaust'").remove();
  var obj = $('#cole-exaust select');
  createHidden(obj);
  obj = $('#d_cole-exaust_tbody span');
  createHiddenSpan(obj);
  if (!$(".linha-cole-exaust").length) {
    $("#lista-defeitos").append("<tr class='linha-cole-exaust'><td>Coletivo de Exautão Natural e Forçada</td><td style='text-align: center;'><span namehidden='cole-exaust' class='btn-remove-linha icon-cross btn btn_red'></span></td></tr>");
  }
});

$('#btn_caract-hig').click(function(){
  $("input[name*='caract-h'").remove();
  var obj = $('#caract-h select');
  createHidden(obj);
  obj = $('#d_caract-higi_tbody span');
  createHiddenSpan(obj);
  if (!$(".linha-caract-h").length) {
    $("#lista-defeitos").append("<tr class='linha-caract-h'><td>Características Higiênicas da Combustão </td><td style='text-align: center;'><span namehidden='caract-h' class='btn-remove-linha icon-cross btn btn_red'></span></td></tr>");
  }
});

$('#btn_reco').click(function(){
  $("input[name*='reco'").remove();
  var obj = $('#reco select');
  createHidden(obj);
  obj = $('#d_reco-tbody span');
  createHiddenSpan(obj);
  if (!$(".linha-reco").length) {
    $("#lista-defeitos").append("<tr class='linha-reco'><td>Recomendações</td><td style='text-align: center;'><span namehidden='reco' class='btn-remove-linha icon-cross btn btn_red'></span></td></tr>");
  }
});

$(document).on('click','.btn-remove-linha',function(){
  var namehidden = $(this).attr("namehidden");
  $(this).closest("tr").remove();
  $("input[name*='"+namehidden+"'").remove();
});


function createHidden(obj){
  $.each( obj, function( key, value ) {
    var valor = $(value).val();
    var id = $(value).attr('id');
    $("<input type='hidden' value='"+valor+"' name='"+id+"'/>").appendTo('.d_hiddens');
  });    
}

function createHiddenSpan(obj){
  $.each( obj, function( key, value ) {
    var valor = $(value).text();
    var id = $(value).attr('id');
    $("<input type='hidden' value='"+valor+"' name='"+id+"'/>").appendTo('.d_hiddens');
  });
}


/*function funcaoParaExecutar(count) {
  if(count = 1){
    $('tbody, .t_aparelho_1 tr #1').fadeOut()
  } else if(count = 2){
    $('tbody, .t_aparelho_1 tr #2').fadeOut()
  } else {
    $('tbody, .t_aparelho_1 tr #3').fadeOut()
  }

}*/
// TESTE DE ESTANQUEIDADE - MODAL COZINHA

$('html').on('click', '.t_salvar_cozinha', function (e) {

    // APARELHO 1
    var t_cozinhaTipo = $('#t_cozinhaTipo').val();
    var t_cozinhaMarca = $('#t_cozinhaMarca').val();
    var t_cozinhaModelo = $('#t_cozinhaModelo').val();
    var t_cozinhaPot = $('#t_cozinhaPot').val();
    var t_cozinhaFuncionamento = $('input:radio[name=t_cozinhaFuncionamento]:checked').val();

          // APARELHO 1
          if(!t_cozinhaTipo){
            alert('Todos os campos devem ser preenchidos');
          } else if (!t_cozinhaMarca){
            alert('Todos os campos devem ser preenchidos');
          } else if(!t_cozinhaModelo){
            alert('Todos os campos devem ser preenchidos');
          } else if(!t_cozinhaPot){
            alert('Todos os campos devem ser preenchidos');
          } else{

         // CRIAÇÃO DO CONTADOR
         var count = $("#t_aparelho1").attr("contador");
         var quantidade = $("#t_aparelho1").attr("quantidade");

         $("#t_aparelho1").remove();       
         $("<span contador='"+(++count)+"' quantidade='"+(++quantidade)+"' id='t_aparelho1'>Cozinha ("+count+")</span>").appendTo('.t_aparelho1');
        // APARELHO 1 = hiddens

        //TIPO
        $("<input type='hidden' value='"+t_cozinhaTipo+"' name='t_cozinhaTipo"+quantidade+"' id='t_cozinhaTipo"+quantidade+"' placeholder='Tipo:' />").appendTo('.t_hiddens');      
        //MARCA
        $("<input type='hidden' value='"+t_cozinhaMarca+"' name='t_cozinhaMarca"+quantidade+"'  id='t_cozinhaMarca"+quantidade+"'  placeholder='Marca:' />").appendTo('.t_hiddens');
        //MODELO
        $("<input type='hidden' value='"+t_cozinhaModelo+"' name='t_cozinhaModelo"+quantidade+"' id='t_cozinhaModelo"+quantidade+"' placeholder='Modelo:' />").appendTo('.t_hiddens');
        //POTcount
        $("<input type='hidden' value='"+t_cozinhaPot+"' name='t_cozinhaPot"+quantidade+"' id='t_cozinhaPot"+quantidade+"' placeholder='Potência:' />").appendTo('.t_hiddens');
        //FUNCIONAMENTO
        $("<input type='hidden' value='"+t_cozinhaFuncionamento+"' name='t_cozinhaFuncionamento"+quantidade+"'  id='t_cozinhaFuncionamento"+quantidade+"' style='width:5%' checked />").appendTo('.t_hiddens');

        $("<tr id='"+quantidade+"'><td style='text-align: center;'>"+t_cozinhaTipo+"</td><td style='text-align: center;'>"+t_cozinhaMarca+"</td><td style='text-align: center;'>"+t_cozinhaModelo+"</td><td style='text-align: center;'>"+t_cozinhaPot+"</td><td style='text-align: center;'>"+t_cozinhaFuncionamento+"</td><td style='text-align: center;'><button class='btn btn_red t_excluir_aparelho1' id='"+quantidade+"' style='text-align: center;'><i class='icon-cross'></i>Excluir</button></td></tr>").appendTo('#t_aparelho_1');

        $('#t_cozinhaTipo').val("");
        $('#t_cozinhaMarca').val("");
        $('#t_cozinhaModelo').val("");
        $('#t_cozinhaPot').val("");
        $("input[name='t_cozinhaFuncionamento']").prop('checked', false);
        //$('input:radio[name=t_cozinhaFuncionamento]:').val();  
      }
    });

$('#t_aparelho_1').on('click', '.t_excluir_aparelho1', function () {
  var count = $("#t_aparelho1").attr("contador");
  var quantidade = $("#t_aparelho1").attr("quantidade");
  $("#t_aparelho1").remove();           
  $("#t_cozinhaTipo"+this.id).remove(); 
  $("#t_cozinhaMarca"+this.id).remove();
  $("#t_cozinhaModelo"+this.id).remove();
  $("#t_cozinhaPot"+this.id).remove();
  $("#t_cozinhaFuncionamento"+this.id).remove();
  $("<span contador='"+(--count)+"' quantidade='"+(quantidade)+"' id='t_aparelho1'>Cozinha ("+count+")</span>").appendTo('.t_aparelho1'); 
  $(this).closest('tr').fadeOut();
});


  // TESTE DE ESTANQUEIDADE - MODAL BANHEIRO SOCIAL

  $('html').on('click', '.t_salvar_banheiro_social', function (e) {

    // APARELHO 2
    var t_b_SocialTipo = $('#t_b_SocialTipo').val();
    var t_b_SocialMarca = $('#t_b_SocialMarca').val();
    var t_b_SocialModelo = $('#t_b_SocialModelo').val();
    var t_b_SocialPot = $('#t_b_SocialPot').val();
    var t_b_SocialTiragem = $('input:radio[name=t_b_SocialTiragem]:checked').val();
    var t_b_SocialCombustao = $('input:radio[name=t_b_SocialCombustao]:checked').val();
    var t_b_SocialFuncionamento = $('input:radio[name=t_b_SocialFuncionamento]:checked').val();

     // HIGIENE COMBUSTAO
     var t_b_Social_h_Tiragem = $('#t_b_Social_h_Tiragem').val();
     var t_b_Social_h_Con = $('#t_b_Social_h_Con').val();
     var t_b_Social_h_CoAmb = $('#t_b_Social_h_CoAmb').val();
     var t_b_Social_h_Tempo = $('#t_b_Social_h_Tempo').val();
     var t_b_Social_h_Analisador = $('#t_b_Social_h_Analisador').val();
     var t_b_Social_h_NumSerie = $('#t_b_Social_h_NumSerie').val();


      // APARELHO 2
      if(!t_b_SocialTipo){
        alert('Todos os campos devem ser preenchidos');
      } else if (!t_b_SocialMarca){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_b_SocialModelo){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_b_SocialPot){
        alert('Todos os campos devem ser preenchidos');
      } 
      // HIGIENE
      else if(!t_b_Social_h_Tiragem){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_b_Social_h_Con){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_b_Social_h_CoAmb){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_b_Social_h_Tempo){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_b_Social_h_Analisador){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_b_Social_h_NumSerie){
        alert('Todos os campos devem ser preenchidos');
      } 
      else{

       var count = $("#t_aparelho2").attr("contador");
       var quantidade = $("#t_aparelho2").attr("quantidade");

       $("#t_aparelho2").remove();       
       $("<span contador='"+(++count)+"' quantidade='"+(++quantidade)+"' id='t_aparelho2'>Banheiro Social ("+count+")</span>").appendTo('.t_aparelho2'); 

       // APARELHO 2

        //TIPO
        $("<input type='hidden' value='"+t_b_SocialTipo+"' name='t_b_SocialTipo"+quantidade+"' id='t_b_SocialTipo"+quantidade+"' />").appendTo('.t_hiddens');
        //MARCA
        $("<input type='hidden' value='"+t_b_SocialMarca+"' name='t_b_SocialMarca"+quantidade+"' id='t_b_SocialMarca"+quantidade+"'  />").appendTo('.t_hiddens');
        //MODELO
        $("<input type='hidden' value='"+t_b_SocialModelo+"' name='t_b_SocialModelo"+quantidade+"' id='t_b_SocialModelo"+quantidade+"'  />").appendTo('.t_hiddens');
        //POT
        $("<input type='hidden' value='"+t_b_SocialPot+"' name='t_b_SocialPot"+quantidade+"' id='t_b_SocialPot"+quantidade+"' />").appendTo('.t_hiddens');
        //TIRAGEM
        $("<input type='hidden' value='"+t_b_SocialTiragem+"' name='t_b_SocialTiragem"+quantidade+"' id='t_b_SocialTiragem"+quantidade+"' checked />").appendTo('.t_hiddens');
         //COMBUSTÃO
         $("<input type='hidden' value='"+t_b_SocialCombustao+"' name='t_b_SocialCombustao"+quantidade+"' id='t_b_SocialCombustao"+quantidade+"' checked />").appendTo('.t_hiddens');
         //FUNCIONAMENTO
         $("<input type='hidden' value='"+t_b_SocialFuncionamento+"' name='t_b_SocialFuncionamento"+quantidade+"' id='t_b_SocialFuncionamento"+quantidade+"' checked />").appendTo('.t_hiddens');


            // HIGIENE COMBUSTÃO

         //TIRAGEM
         $("<input type='hidden' value='"+t_b_Social_h_Tiragem+"' name='t_b_Social_h_Tiragem"+quantidade+"' id='t_b_Social_h_Tiragem"+quantidade+"' />").appendTo('.t_hiddens');
        //CON
        $("<input type='hidden' value='"+t_b_Social_h_Con+"' name='t_b_Social_h_Con"+quantidade+"' id='t_b_Social_h_Con"+quantidade+"'  />").appendTo('.t_hiddens');
        //COAMB
        $("<input type='hidden' value='"+t_b_Social_h_CoAmb+"' name='t_b_Social_h_CoAmb"+quantidade+"' id='t_b_Social_h_CoAmb"+quantidade+"'  />").appendTo('.t_hiddens');
        //TEMPO
        $("<input type='hidden' value='"+t_b_Social_h_Tempo+"' name='t_b_Social_h_Tempo"+quantidade+"' id='t_b_Social_h_Tempo"+quantidade+"' />").appendTo('.t_hiddens');
        //ANALISADOR
        $("<input type='hidden' value='"+t_b_Social_h_Analisador+"' name='t_b_Social_h_Analisador"+quantidade+"' id='t_b_Social_h_Analisador"+quantidade+"'  />").appendTo('.t_hiddens');
        //NUMERO DE SERIE
        $("<input type='hidden' value='"+t_b_Social_h_NumSerie+"' name='t_b_Social_h_NumSerie"+quantidade+"' id='t_b_Social_h_NumSerie"+quantidade+"' />").appendTo('.t_hiddens');

        $("<tr id='"+quantidade+"'><td style='text-align: center;'>"+t_b_SocialTipo+"</td><td style='text-align: center;'>"+t_b_SocialMarca+"</td><td style='text-align: center;'>"+t_b_SocialModelo+"</td><td style='text-align: center;'>"+t_b_SocialPot+"</td><td style='text-align: center;'>"+t_b_SocialTiragem+"</td><td style='text-align: center;'>"+t_b_SocialCombustao+"</td><td style='text-align: center;'>"+t_b_SocialFuncionamento+"</td><td style='text-align: center;'>"+t_b_Social_h_Tiragem+"</td><td style='text-align: center;'>"+t_b_Social_h_Con+"</td><td style='text-align: center;'>"+t_b_Social_h_CoAmb+"</td><td style='text-align: center;'>"+t_b_Social_h_Tempo+"</td><td style='text-align: center;'>"+t_b_Social_h_Analisador+"</td><td style='text-align: center;'>"+t_b_Social_h_NumSerie+"</td><td style='text-align: center;'><button class='btn btn_red t_excluir_aparelho2' id='"+quantidade+"' style='text-align: center;'><i class='icon-cross'></i>Excluir</button></td></tr>").appendTo('#t_aparelho_2');


        $('#t_b_SocialTipo').val("");
        $('#t_b_SocialMarca').val("");
        $('#t_b_SocialModelo').val("");
        $('#t_b_SocialPot').val("");
        $("input[name='t_b_SocialTiragem']").prop('checked', false);
        $("input[name='t_b_SocialCombustao']").prop('checked', false);
        $("input[name='t_b_SocialFuncionamento']").prop('checked', false);


         // HIGIENE COMBUSTAO
         $('#t_b_Social_h_Tiragem').val("");
         $('#t_b_Social_h_Con').val("");
         $('#t_b_Social_h_CoAmb').val("");
         $('#t_b_Social_h_Tempo').val("");
         $('#t_b_Social_h_Analisador').val("");
         $('#t_b_Social_h_NumSerie').val("");


       }

     });

$('#t_aparelho_2').on('click', '.t_excluir_aparelho2', function () {
  var count = $("#t_aparelho2").attr("contador");
  var quantidade = $("#t_aparelho2").attr("quantidade");
  $("#t_aparelho2").remove();  

  $("#t_b_SocialTipo"+this.id).remove(); 
  $("#t_b_SocialMarca"+this.id).remove();
  $("#t_b_SocialModelo"+this.id).remove();
  $("#t_b_SocialPot"+this.id).remove();
  $("#t_b_SocialTiragem"+this.id).remove();
  $("#t_b_SocialCombustao"+this.id).remove();
  $("#t_b_SocialFuncionamento"+this.id).remove();
              // HIGIENE COMBUSTAO
              $("#t_b_Social_h_Tiragem"+this.id).remove();
              $("#t_b_Social_h_Con"+this.id).remove();
              $("#t_b_Social_h_CoAmb"+this.id).remove();
              $("#t_b_Social_h_Tempo"+this.id).remove();
              $("#t_b_Social_h_Analisador"+this.id).remove();
              $("#t_b_Social_h_NumSerie"+this.id).remove();

              $("<span contador='"+(--count)+"' quantidade='"+(++quantidade)+"' id='t_aparelho2'>Banheiro Social ("+count+")</span>").appendTo('.t_aparelho2'); 
              $(this).closest('tr').fadeOut();
            });


  // TESTE DE ESTANQUEIDADE - MODAL BANHEIRO SUÍTE

  $('html').on('click', '.t_salvar_banheiro_suite', function (e) {

    // APARELHO 3
    var t_b_SuiteTipo = $('#t_b_SuiteTipo').val();
    var t_b_SuiteMarca = $('#t_b_SuiteMarca').val();
    var t_b_SuiteModelo = $('#t_b_SuiteModelo').val();
    var t_b_SuitePot = $('#t_b_SuitePot').val();
    var t_b_SuiteTiragem = $('input:radio[name=t_b_SuiteTiragem]:checked').val();
    var t_b_SuiteCombustao = $('input:radio[name=t_b_SuiteCombustao]:checked').val();
    var t_b_SuiteFuncionamento = $('input:radio[name=t_b_SuiteFuncionamento]:checked').val();

     // HIGIENE COMBUSTAO
     var t_b_Suite_h_Tiragem = $('#t_b_Suite_h_Tiragem').val();
     var t_b_Suite_h_Con = $('#t_b_Suite_h_Con').val();
     var t_b_Suite_h_CoAmb = $('#t_b_Suite_h_CoAmb').val();
     var t_b_Suite_h_Tempo = $('#t_b_Suite_h_Tempo').val();
     var t_b_Suite_h_Analisador = $('#t_b_Suite_h_Analisador').val();
     var t_b_Suite_h_NumSerie = $('#t_b_Suite_h_NumSerie').val();


      // APARELHO 3
      if(!t_b_SuiteTipo){
        alert('Todos os campos devem ser preenchidos');
      } else if (!t_b_SuiteMarca){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_b_SuiteModelo){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_b_SuitePot){
        alert('Todos os campos devem ser preenchidos');
      } 
      // HIGIENE
      else if(!t_b_Suite_h_Tiragem){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_b_Suite_h_Con){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_b_Suite_h_CoAmb){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_b_Suite_h_Tempo){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_b_Suite_h_Analisador){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_b_Suite_h_NumSerie){
        alert('Todos os campos devem ser preenchidos');
      } 
      else{

       var count = $("#t_aparelho3").attr("contador");
       var quantidade = $("#t_aparelho3").attr("quantidade");

       $("#t_aparelho3").remove();       
       $("<span contador='"+(++count)+"' quantidade='"+(++quantidade)+"' id='t_aparelho3'>Banheiro Suite ("+count+")</span>").appendTo('.t_aparelho3'); 

       // APARELHO 3

        //TIPO
        $("<input type='hidden' value='"+t_b_SuiteTipo+"' name='t_b_SuiteTipo"+count+"' id='t_b_SuiteTipo"+quantidade+"' />").appendTo('.t_hiddens');
        //MARCA
        $("<input type='hidden' value='"+t_b_SuiteMarca+"' name='t_b_SuiteMarca"+count+"'  id='t_b_SuiteMarca"+quantidade+"' />").appendTo('.t_hiddens');
        //MODELO
        $("<input type='hidden' value='"+t_b_SuiteModelo+"' name='t_b_SuiteModelo"+count+"' id='t_b_SuiteModelo"+quantidade+"'  />").appendTo('.t_hiddens');
        //POT
        $("<input type='hidden' value='"+t_b_SuitePot+"' name='t_b_SuitePot"+count+"' id='t_b_SuitePot"+quantidade+"' />").appendTo('.t_hiddens');

        //TIRAGEM
        $("<input type='hidden' value='"+t_b_SuiteTiragem+"' name='t_b_SuiteTiragem"+count+"' id='t_b_SuiteTiragem"+quantidade+"' checked />").appendTo('.t_hiddens');
         //COMBUSTÃO
         $("<input type='hidden' value='"+t_b_SuiteCombustao+"' name='t_b_SuiteCombustao"+count+"' id='t_b_SuiteCombustao"+quantidade+"' checked />").appendTo('.t_hiddens');
         //FUNCIONAMENTO
         $("<input type='hidden' value='"+t_b_SuiteFuncionamento+"' name='t_b_SuiteFuncionamento"+count+"' id='t_b_SuiteFuncionamento"+quantidade+"' checked />").appendTo('.t_hiddens');


            // HIGIENE COMBUSTÃO

         //TIRAGEM
         $("<input type='hidden' value='"+t_b_Suite_h_Tiragem+"' name='t_b_Suite_h_Tiragem"+count+"' id='t_b_Suite_h_Tiragem"+quantidade+"' />").appendTo('.t_hiddens');
        //CON
        $("<input type='hidden' value='"+t_b_Suite_h_Con+"' name='t_b_Suite_h_Con"+count+"'  id='t_b_Suite_h_Con"+quantidade+"' />").appendTo('.t_hiddens');
        //COAMB
        $("<input type='hidden' value='"+t_b_Suite_h_CoAmb+"' name='t_b_Suite_h_CoAmb"+count+"' id='t_b_Suite_h_CoAmb"+quantidade+"' />").appendTo('.t_hiddens');
        //TEMPO
        $("<input type='hidden' value='"+t_b_Suite_h_Tempo+"' name='t_b_Suite_h_Tempo"+count+"' id='t_b_Suite_h_Tempo"+quantidade+"' />").appendTo('.t_hiddens');
        //ANALISADOR
        $("<input type='hidden' value='"+t_b_Suite_h_Analisador+"' name='t_b_Suite_h_Analisador"+count+"' id='t_b_Suite_h_Analisador"+quantidade+"' />").appendTo('.t_hiddens');
        //NUMERO DE SERIE
        $("<input type='hidden' value='"+t_b_Suite_h_NumSerie+"' name='t_b_Suite_h_NumSerie"+count+"' id='t_b_Suite_h_NumSerie"+quantidade+"' />").appendTo('.t_hiddens');

        $("<tr id='"+quantidade+"'><td style='text-align: center;'>"+t_b_SuiteTipo+"</td><td style='text-align: center;'>"+t_b_SuiteMarca+"</td><td style='text-align: center;'>"+t_b_SuiteModelo+"</td><td style='text-align: center;'>"+t_b_SuitePot+"</td><td style='text-align: center;'>"+t_b_SuiteTiragem+"</td><td style='text-align: center;'>"+t_b_SuiteCombustao+"</td><td style='text-align: center;'>"+t_b_SuiteFuncionamento+"</td><td style='text-align: center;'>"+t_b_Suite_h_Tiragem+"</td><td style='text-align: center;'>"+t_b_Suite_h_Con+"</td><td style='text-align: center;'>"+t_b_Suite_h_CoAmb+"</td><td style='text-align: center;'>"+t_b_Suite_h_Tempo+"</td><td style='text-align: center;'>"+t_b_Suite_h_Analisador+"</td><td style='text-align: center;'>"+t_b_Suite_h_NumSerie+"</td><td style='text-align: center;'><button class='btn btn_red t_excluir_aparelho3' id='"+quantidade+"' style='text-align: center;'><i class='icon-cross'></i>Excluir</button></td></tr>").appendTo('#t_aparelho_3');



         // APARELHO 3
         $('#t_b_SuiteTipo').val("");
         $('#t_b_SuiteMarca').val("");
         $('#t_b_SuiteModelo').val("");
         $('#t_b_SuitePot').val("");
         $("input[name='t_b_SuiteTiragem']").prop('checked', false);
         $("input[name='t_b_SuiteCombustao']").prop('checked', false);
         $("input[name='t_b_SuiteFuncionamento']").prop('checked', false);


         // HIGIENE COMBUSTAO
         $('#t_b_Suite_h_Tiragem').val("");
         $('#t_b_Suite_h_Con').val("");
         $('#t_b_Suite_h_CoAmb').val("");
         $('#t_b_Suite_h_Tempo').val("");
         $('#t_b_Suite_h_Analisador').val("");
         $('#t_b_Suite_h_NumSerie').val("");


       }

     });


$('#t_aparelho_3').on('click', '.t_excluir_aparelho3', function () {
  var count = $("#t_aparelho3").attr("contador");
  var quantidade = $("#t_aparelho3").attr("quantidade");

  $("#t_aparelho3").remove();  
  $("#t_b_SuiteTipo"+this.id).remove(); 
  $("#t_b_SuiteMarca"+this.id).remove();
  $("#t_b_SuiteModelo"+this.id).remove();
  $("#t_b_SuitePot"+this.id).remove();
  $("#t_b_SuiteTiragem"+this.id).remove();
  $("#t_b_SuiteCombustao"+this.id).remove();
  $("#t_b_SuiteFuncionamento"+this.id).remove();
              // HIGIENE COMBUSTAO
              $("#t_b_Suite_h_Tiragem"+this.id).remove();
              $("#t_b_Suite_h_Con"+this.id).remove();
              $("#t_b_Suite_h_CoAmb"+this.id).remove();
              $("#t_b_Suite_h_Tempo"+this.id).remove();
              $("#t_b_Suite_h_Analisador"+this.id).remove();
              $("#t_b_Suite_h_NumSerie"+this.id).remove();

              $("<span contador='"+(--count)+"' quantidade='"+(++quantidade)+"' id='t_aparelho3'>Banheiro Suite ("+count+")</span>").appendTo('.t_aparelho3'); 
              $(this).closest('tr').fadeOut();
            });


       // TESTE DE ESTANQUEIDADE - MODAL BANHEIRO SERVIÇO

       $('html').on('click', '.t_salvar_banheiro_servico', function (e) {

    // APARELHO 4
    var t_b_ServicoTipo = $('#t_b_ServicoTipo').val();
    var t_b_ServicoMarca = $('#t_b_ServicoMarca').val();
    var t_b_ServicoModelo = $('#t_b_ServicoModelo').val();
    var t_b_ServicoPot = $('#t_b_ServicoPot').val();
    var t_b_ServicoTiragem = $('input:radio[name=t_b_ServicoTiragem]:checked').val();
    var t_b_ServicoCombustao = $('input:radio[name=t_b_ServicoCombustao]:checked').val();
    var t_b_ServicoFuncionamento = $('input:radio[name=t_b_ServicoFuncionamento]:checked').val();

     // HIGIENE COMBUSTAO
     var t_b_Servico_h_Tiragem = $('#t_b_Servico_h_Tiragem').val();
     var t_b_Servico_h_Con = $('#t_b_Servico_h_Con').val();
     var t_b_Servico_h_CoAmb = $('#t_b_Servico_h_CoAmb').val();
     var t_b_Servico_h_Tempo = $('#t_b_Servico_h_Tempo').val();
     var t_b_Servico_h_Analisador = $('#t_b_Servico_h_Analisador').val();
     var t_b_Servico_h_NumSerie = $('#t_b_Servico_h_NumSerie').val();


      // APARELHO 4
      if(!t_b_ServicoTipo){
        alert('Todos os campos devem ser preenchidos');
      } else if (!t_b_ServicoMarca){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_b_ServicoModelo){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_b_ServicoPot){
        alert('Todos os campos devem ser preenchidos');
      } 
      // HIGIENE
      else if(!t_b_Servico_h_Tiragem){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_b_Servico_h_Con){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_b_Servico_h_CoAmb){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_b_Servico_h_Tempo){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_b_Servico_h_Analisador){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_b_Servico_h_NumSerie){
        alert('Todos os campos devem ser preenchidos');
      } 
      else{

       var count = $("#t_aparelho4").attr("contador");
       var quantidade = $("#t_aparelho4").attr("quantidade");

       $("#t_aparelho4").remove();       
       $("<span contador='"+(++count)+"' quantidade='"+(++quantidade)+"' id='t_aparelho4'>Banheiro Servico ("+count+")</span>").appendTo('.t_aparelho4'); 

       // APARELHO 4

        //TIPO
        $("<input type='hidden' value='"+t_b_ServicoTipo+"' name='t_b_ServicoTipo"+count+"' id='t_b_ServicoTipo"+quantidade+"' />").appendTo('.t_hiddens');
        //MARCA
        $("<input type='hidden' value='"+t_b_ServicoMarca+"' name='t_b_ServicoMarca"+count+"'  id='t_b_ServicoMarca"+quantidade+"' />").appendTo('.t_hiddens');
        //MODELO
        $("<input type='hidden' value='"+t_b_ServicoModelo+"' name='t_b_ServicoModelo"+count+"' id='t_b_ServicoModelo"+quantidade+"'  />").appendTo('.t_hiddens');
        //POT
        $("<input type='hidden' value='"+t_b_ServicoPot+"' name='t_b_ServicoPot"+count+"' id='t_b_ServicoPot"+quantidade+"' />").appendTo('.t_hiddens');

        //TIRAGEM
        $("<input type='hidden' value='"+t_b_ServicoTiragem+"' name='t_b_ServicoTiragem"+count+"' id='t_b_ServicoTiragem"+quantidade+"' checked />").appendTo('.t_hiddens');
         //COMBUSTÃO
         $("<input type='hidden' value='"+t_b_ServicoCombustao+"' name='t_b_ServicoCombustao"+count+"' id='t_b_ServicoCombustao"+quantidade+"' checked />").appendTo('.t_hiddens');
         //FUNCIONAMENTO
         $("<input type='hidden' value='"+t_b_ServicoFuncionamento+"' name='t_b_ServicoFuncionamento"+count+"' id='t_b_ServicoFuncionamento"+quantidade+"' checked />").appendTo('.t_hiddens');


            // HIGIENE COMBUSTÃO

         //TIRAGEM
         $("<input type='hidden' value='"+t_b_Servico_h_Tiragem+"' name='t_b_Servico_h_Tiragem"+count+"' id='t_b_Servico_h_Tiragem"+quantidade+"' />").appendTo('.t_hiddens');
        //CON
        $("<input type='hidden' value='"+t_b_Servico_h_Con+"' name='t_b_Servico_h_Con"+count+"'  id='t_b_Servico_h_Con"+quantidade+"' />").appendTo('.t_hiddens');
        //COAMB
        $("<input type='hidden' value='"+t_b_Servico_h_CoAmb+"' name='t_b_Servico_h_CoAmb"+count+"' id='t_b_Servico_h_CoAmb"+quantidade+"' />").appendTo('.t_hiddens');
        //TEMPO
        $("<input type='hidden' value='"+t_b_Servico_h_Tempo+"' name='t_b_Servico_h_Tempo"+count+"' id='t_b_Servico_h_Tempo"+quantidade+"' />").appendTo('.t_hiddens');
        //ANALISADOR
        $("<input type='hidden' value='"+t_b_Servico_h_Analisador+"' name='t_b_Servico_h_Analisador"+count+"' id='t_b_Servico_h_Analisador"+quantidade+"' />").appendTo('.t_hiddens');
        //NUMERO DE SERIE
        $("<input type='hidden' value='"+t_b_Servico_h_NumSerie+"' name='t_b_Servico_h_NumSerie"+count+"' id='t_b_Servico_h_NumSerie"+quantidade+"' />").appendTo('.t_hiddens');

        $("<tr id='"+quantidade+"'><td style='text-align: center;'>"+t_b_ServicoTipo+"</td><td style='text-align: center;'>"+t_b_ServicoMarca+"</td><td style='text-align: center;'>"+t_b_ServicoModelo+"</td><td style='text-align: center;'>"+t_b_ServicoPot+"</td><td style='text-align: center;'>"+t_b_ServicoTiragem+"</td><td style='text-align: center;'>"+t_b_ServicoCombustao+"</td><td style='text-align: center;'>"+t_b_ServicoFuncionamento+"</td><td style='text-align: center;'>"+t_b_Servico_h_Tiragem+"</td><td style='text-align: center;'>"+t_b_Servico_h_Con+"</td><td style='text-align: center;'>"+t_b_Servico_h_CoAmb+"</td><td style='text-align: center;'>"+t_b_Servico_h_Tempo+"</td><td style='text-align: center;'>"+t_b_Servico_h_Analisador+"</td><td style='text-align: center;'>"+t_b_Servico_h_NumSerie+"</td><td style='text-align: center;'><button class='btn btn_red t_excluir_aparelho4' id='"+quantidade+"' style='text-align: center;'><i class='icon-cross'></i>Excluir</button></td></tr>").appendTo('#t_aparelho_4');

         // APARELHO 4
         $('#t_b_ServicoTipo').val("");
         $('#t_b_ServicoMarca').val("");
         $('#t_b_ServicoModelo').val("");
         $('#t_b_ServicoPot').val("");
         $("input[name='t_b_ServicoTiragem']").prop('checked', false);
         $("input[name='t_b_ServicoCombustao']").prop('checked', false);
         $("input[name='t_b_ServicoFuncionamento']").prop('checked', false);

         // HIGIENE COMBUSTAO
         $('#t_b_Servico_h_Tiragem').val("");
         $('#t_b_Servico_h_Con').val("");
         $('#t_b_Servico_h_CoAmb').val("");
         $('#t_b_Servico_h_Tempo').val("");
         $('#t_b_Servico_h_Analisador').val("");
         $('#t_b_Servico_h_NumSerie').val("");

       }

     });


$('#t_aparelho_4').on('click', '.t_excluir_aparelho4', function () {
  var count = $("#t_aparelho4").attr("contador");
  var quantidade = $("#t_aparelho4").attr("quantidade");
  
  $("#t_aparelho4").remove();  
  $("#t_b_ServicoTipo"+this.id).remove(); 
  $("#t_b_ServicoMarca"+this.id).remove();
  $("#t_b_ServicoModelo"+this.id).remove();
  $("#t_b_ServicoPot"+this.id).remove();
  $("#t_b_ServicoTiragem"+this.id).remove();
  $("#t_b_ServicoCombustao"+this.id).remove();
  $("#t_b_ServicoFuncionamento"+this.id).remove();
        // HIGIENE COMBUSTAO
        $("#t_b_Servico_h_Tiragem"+this.id).remove();
        $("#t_b_Servico_h_Con"+this.id).remove();
        $("#t_b_Servico_h_CoAmb"+this.id).remove();
        $("#t_b_Servico_h_Tempo"+this.id).remove();
        $("#t_b_Servico_h_Analisador"+this.id).remove();
        $("#t_b_Servico_h_NumSerie"+this.id).remove();

        $("<span contador='"+(--count)+"' quantidade='"+(++quantidade)+"' id='t_aparelho4'>Banheiro Servico ("+count+")</span>").appendTo('.t_aparelho4'); 
        $(this).closest('tr').fadeOut();
      });



  // TESTE DE ESTANQUEIDADE - MODAL ÁREA SERVIÇO

  $('html').on('click', '.t_salvar_area_servico', function (e) {

    // APARELHO 5
    var t_a_ServicoTipo = $('#t_a_ServicoTipo').val();
    var t_a_ServicoMarca = $('#t_a_ServicoMarca').val();
    var t_a_ServicoModelo = $('#t_a_ServicoModelo').val();
    var t_a_ServicoPot = $('#t_a_ServicoPot').val();
    var t_a_ServicoTiragem = $('input:radio[name=t_a_ServicoTiragem]:checked').val();
    var t_a_ServicoCombustao = $('input:radio[name=t_a_ServicoCombustao]:checked').val();
    var t_a_ServicoFuncionamento = $('input:radio[name=t_a_ServicoFuncionamento]:checked').val();

     // HIGIENE COMBUSTAO
     var t_a_Servico_h_Tiragem = $('#t_a_Servico_h_Tiragem').val();
     var t_a_Servico_h_Con = $('#t_a_Servico_h_Con').val();
     var t_a_Servico_h_CoAmb = $('#t_a_Servico_h_CoAmb').val();
     var t_a_Servico_h_Tempo = $('#t_a_Servico_h_Tempo').val();
     var t_a_Servico_h_Analisador = $('#t_a_Servico_h_Analisador').val();
     var t_a_Servico_h_NumSerie = $('#t_a_Servico_h_NumSerie').val();


      // APARELHO 5
      if(!t_a_ServicoTipo){
        alert('Todos os campos devem ser preenchidos');
      } else if (!t_a_ServicoMarca){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_a_ServicoModelo){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_a_ServicoPot){
        alert('Todos os campos devem ser preenchidos');
      } 
      // HIGIENE
      else if(!t_a_Servico_h_Tiragem){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_a_Servico_h_Con){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_a_Servico_h_CoAmb){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_a_Servico_h_Tempo){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_a_Servico_h_Analisador){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_a_Servico_h_NumSerie){
        alert('Todos os campos devem ser preenchidos');
      } 
      else{

       var count = $("#t_aparelho5").attr("contador");
       var quantidade = $("#t_aparelho5").attr("quantidade");

       $("#t_aparelho5").remove();       
       $("<span contador='"+(++count)+"' quantidade='"+(++quantidade)+"' id='t_aparelho5'>Área Serviço ("+count+")</span>").appendTo('.t_aparelho5'); 

       // APARELHO 5

        //TIPO
        $("<input type='hidden' value='"+t_a_ServicoTipo+"' name='t_a_ServicoTipo"+count+"' id='t_a_ServicoTipo"+quantidade+"' />").appendTo('.t_hiddens');
        //MARCA
        $("<input type='hidden' value='"+t_a_ServicoMarca+"' name='t_a_ServicoMarca"+count+"'  id='t_a_ServicoMarca"+quantidade+"' />").appendTo('.t_hiddens');
        //MODELO
        $("<input type='hidden' value='"+t_a_ServicoModelo+"' name='t_a_ServicoModelo"+count+"' id='t_a_ServicoModelo"+quantidade+"'  />").appendTo('.t_hiddens');
        //POT
        $("<input type='hidden' value='"+t_a_ServicoPot+"' name='t_a_ServicoPot"+count+"' id='t_a_ServicoPot"+quantidade+"' />").appendTo('.t_hiddens');

        //TIRAGEM
        $("<input type='hidden' value='"+t_a_ServicoTiragem+"' name='t_a_ServicoTiragem"+count+"' id='t_a_ServicoTiragem"+quantidade+"' checked />").appendTo('.t_hiddens');
         //COMBUSTÃO
         $("<input type='hidden' value='"+t_a_ServicoCombustao+"' name='t_a_ServicoCombustao"+count+"' id='t_a_ServicoCombustao"+quantidade+"' checked />").appendTo('.t_hiddens');
         //FUNCIONAMENTO
         $("<input type='hidden' value='"+t_a_ServicoFuncionamento+"' name='t_a_ServicoFuncionamento"+count+"' id='t_a_ServicoFuncionamento"+quantidade+"' checked />").appendTo('.t_hiddens');


            // HIGIENE COMBUSTÃO

         //TIRAGEM
         $("<input type='hidden' value='"+t_a_Servico_h_Tiragem+"' name='t_a_Servico_h_Tiragem"+count+"' id='t_a_Servico_h_Tiragem"+quantidade+"' />").appendTo('.t_hiddens');
        //CON
        $("<input type='hidden' value='"+t_a_Servico_h_Con+"' name='t_a_Servico_h_Con"+count+"'  id='t_a_Servico_h_Con"+quantidade+"' />").appendTo('.t_hiddens');
        //COAMB
        $("<input type='hidden' value='"+t_a_Servico_h_CoAmb+"' name='t_a_Servico_h_CoAmb"+count+"' id='t_a_Servico_h_CoAmb"+quantidade+"' />").appendTo('.t_hiddens');
        //TEMPO
        $("<input type='hidden' value='"+t_a_Servico_h_Tempo+"' name='t_a_Servico_h_Tempo"+count+"' id='t_a_Servico_h_Tempo"+quantidade+"' />").appendTo('.t_hiddens');
        //ANALISADOR
        $("<input type='hidden' value='"+t_a_Servico_h_Analisador+"' name='t_a_Servico_h_Analisador"+count+"' id='t_a_Servico_h_Analisador"+quantidade+"' />").appendTo('.t_hiddens');
        //NUMERO DE SERIE
        $("<input type='hidden' value='"+t_a_Servico_h_NumSerie+"' name='t_a_Servico_h_NumSerie"+count+"' id='t_a_Servico_h_NumSerie"+quantidade+"' />").appendTo('.t_hiddens');

        $("<tr id='"+quantidade+"'><td style='text-align: center;'>"+t_a_ServicoTipo+"</td><td style='text-align: center;'>"+t_a_ServicoMarca+"</td><td style='text-align: center;'>"+t_a_ServicoModelo+"</td><td style='text-align: center;'>"+t_a_ServicoPot+"</td><td style='text-align: center;'>"+t_a_ServicoTiragem+"</td><td style='text-align: center;'>"+t_a_ServicoCombustao+"</td><td style='text-align: center;'>"+t_a_ServicoFuncionamento+"</td><td style='text-align: center;'>"+t_a_Servico_h_Tiragem+"</td><td style='text-align: center;'>"+t_a_Servico_h_Con+"</td><td style='text-align: center;'>"+t_a_Servico_h_CoAmb+"</td><td style='text-align: center;'>"+t_a_Servico_h_Tempo+"</td><td style='text-align: center;'>"+t_a_Servico_h_Analisador+"</td><td style='text-align: center;'>"+t_a_Servico_h_NumSerie+"</td><td style='text-align: center;'><button class='btn btn_red t_excluir_aparelho5' id='"+quantidade+"' style='text-align: center;'><i class='icon-cross'></i>Excluir</button></td></tr>").appendTo('#t_aparelho_5');

         // APARELHO 5
         $('#t_a_ServicoTipo').val("");
         $('#t_a_ServicoMarca').val("");
         $('#t_a_ServicoModelo').val("");
         $('#t_a_ServicoPot').val("");
         $("input[name='t_a_ServicoTiragem']").prop('checked', false);
         $("input[name='t_a_ServicoCombustao']").prop('checked', false);
         $("input[name='t_a_ServicoFuncionamento']").prop('checked', false);

         // HIGIENE COMBUSTAO
         $('#t_a_Servico_h_Tiragem').val("");
         $('#t_a_Servico_h_Con').val("");
         $('#t_a_Servico_h_CoAmb').val("");
         $('#t_a_Servico_h_Tempo').val("");
         $('#t_a_Servico_h_Analisador').val("");
         $('#t_a_Servico_h_NumSerie').val("");

       }

     });


$('#t_aparelho_5').on('click', '.t_excluir_aparelho5', function () {
  var count = $("#t_aparelho5").attr("contador");
  var quantidade = $("#t_aparelho5").attr("quantidade");
  
  $("#t_aparelho5").remove();  
  $("#t_a_ServicoTipo"+this.id).remove(); 
  $("#t_a_ServicoMarca"+this.id).remove();
  $("#t_a_ServicoModelo"+this.id).remove();
  $("#t_a_ServicoPot"+this.id).remove();
  $("#t_a_ServicoTiragem"+this.id).remove();
  $("#t_a_ServicoCombustao"+this.id).remove();
  $("#t_a_ServicoFuncionamento"+this.id).remove();
        // HIGIENE COMBUSTAO
        $("#t_a_Servico_h_Tiragem"+this.id).remove();
        $("#t_a_Servico_h_Con"+this.id).remove();
        $("#t_a_Servico_h_CoAmb"+this.id).remove();
        $("#t_a_Servico_h_Tempo"+this.id).remove();
        $("#t_a_Servico_h_Analisador"+this.id).remove();
        $("#t_a_Servico_h_NumSerie"+this.id).remove();

        $("<span contador='"+(--count)+"' quantidade='"+(++quantidade)+"' id='t_aparelho5'>Área Serviço ("+count+")</span>").appendTo('.t_aparelho5'); 
        $(this).closest('tr').fadeOut();
      });



  // TESTE DE ESTANQUEIDADE - MODAL OUTRO

  $('html').on('click', '.t_salvar_outro', function (e) {

    // APARELHO 6
    var t_OutroTipo = $('#t_OutroTipo').val();
    var t_OutroMarca = $('#t_OutroMarca').val();
    var t_OutroModelo = $('#t_OutroModelo').val();
    var t_OutroPot = $('#t_OutroPot').val();
    var t_OutroTiragem = $('input:radio[name=t_OutroTiragem]:checked').val();
    var t_OutroCombustao = $('input:radio[name=t_OutroCombustao]:checked').val();
    var t_OutroFuncionamento = $('input:radio[name=t_OutroFuncionamento]:checked').val();

     // HIGIENE COMBUSTAO
     var t_Outro_h_Tiragem = $('#t_Outro_h_Tiragem').val();
     var t_Outro_h_Con = $('#t_Outro_h_Con').val();
     var t_Outro_h_CoAmb = $('#t_Outro_h_CoAmb').val();
     var t_Outro_h_Tempo = $('#t_Outro_h_Tempo').val();
     var t_Outro_h_Analisador = $('#t_Outro_h_Analisador').val();
     var t_Outro_h_NumSerie = $('#t_Outro_h_NumSerie').val();


      // APARELHO 6
      if(!t_OutroTipo){
        alert('Todos os campos devem ser preenchidos');
      } else if (!t_OutroMarca){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_OutroModelo){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_OutroPot){
        alert('Todos os campos devem ser preenchidos');
      } 
      // HIGIENE
      else if(!t_Outro_h_Tiragem){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_Outro_h_Con){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_Outro_h_CoAmb){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_Outro_h_Tempo){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_Outro_h_Analisador){
        alert('Todos os campos devem ser preenchidos');
      } else if(!t_Outro_h_NumSerie){
        alert('Todos os campos devem ser preenchidos');
      } 
      else{

       var count = $("#t_aparelho6").attr("contador");
       var quantidade = $("#t_aparelho6").attr("quantidade");

       $("#t_aparelho6").remove();       
       $("<span contador='"+(++count)+"' quantidade='"+(++quantidade)+"' id='t_aparelho6'>Outros ("+count+")</span>").appendTo('.t_aparelho6'); 

       // APARELHO 4

        //TIPO
        $("<input type='hidden' value='"+t_OutroTipo+"' name='t_OutroTipo"+count+"' id='t_OutroTipo"+quantidade+"' />").appendTo('.t_hiddens');
        //MARCA
        $("<input type='hidden' value='"+t_OutroMarca+"' name='t_OutroMarca"+count+"'  id='t_OutroMarca"+quantidade+"' />").appendTo('.t_hiddens');
        //MODELO
        $("<input type='hidden' value='"+t_OutroModelo+"' name='t_OutroModelo"+count+"' id='t_OutroModelo"+quantidade+"'  />").appendTo('.t_hiddens');
        //POT
        $("<input type='hidden' value='"+t_OutroPot+"' name='t_OutroPot"+count+"' id='t_OutroPot"+quantidade+"' />").appendTo('.t_hiddens');

        //TIRAGEM
        $("<input type='hidden' value='"+t_OutroTiragem+"' name='t_OutroTiragem"+count+"' id='t_OutroTiragem"+quantidade+"' checked />").appendTo('.t_hiddens');
         //COMBUSTÃO
         $("<input type='hidden' value='"+t_OutroCombustao+"' name='t_OutroCombustao"+count+"' id='t_OutroCombustao"+quantidade+"' checked />").appendTo('.t_hiddens');
         //FUNCIONAMENTO
         $("<input type='hidden' value='"+t_OutroFuncionamento+"' name='t_OutroFuncionamento"+count+"' id='t_OutroFuncionamento"+quantidade+"' checked />").appendTo('.t_hiddens');


            // HIGIENE COMBUSTÃO

         //TIRAGEM
         $("<input type='hidden' value='"+t_Outro_h_Tiragem+"' name='t_Outro_h_Tiragem"+count+"' id='t_Outro_h_Tiragem"+quantidade+"' />").appendTo('.t_hiddens');
        //CON
        $("<input type='hidden' value='"+t_Outro_h_Con+"' name='t_Outro_h_Con"+count+"'  id='t_Outro_h_Con"+quantidade+"' />").appendTo('.t_hiddens');
        //COAMB
        $("<input type='hidden' value='"+t_Outro_h_CoAmb+"' name='t_Outro_h_CoAmb"+count+"' id='t_Outro_h_CoAmb"+quantidade+"' />").appendTo('.t_hiddens');
        //TEMPO
        $("<input type='hidden' value='"+t_Outro_h_Tempo+"' name='t_Outro_h_Tempo"+count+"' id='t_Outro_h_Tempo"+quantidade+"' />").appendTo('.t_hiddens');
        //ANALISADOR
        $("<input type='hidden' value='"+t_Outro_h_Analisador+"' name='t_Outro_h_Analisador"+count+"' id='t_Outro_h_Analisador"+quantidade+"' />").appendTo('.t_hiddens');
        //NUMERO DE SERIE
        $("<input type='hidden' value='"+t_Outro_h_NumSerie+"' name='t_Outro_h_NumSerie"+count+"' id='t_Outro_h_NumSerie"+quantidade+"' />").appendTo('.t_hiddens');

        $("<tr id='"+quantidade+"'><td style='text-align: center;'>"+t_OutroTipo+"</td><td style='text-align: center;'>"+t_OutroMarca+"</td><td style='text-align: center;'>"+t_OutroModelo+"</td><td style='text-align: center;'>"+t_OutroPot+"</td><td style='text-align: center;'>"+t_OutroTiragem+"</td><td style='text-align: center;'>"+t_OutroCombustao+"</td><td style='text-align: center;'>"+t_OutroFuncionamento+"</td><td style='text-align: center;'>"+t_Outro_h_Tiragem+"</td><td style='text-align: center;'>"+t_Outro_h_Con+"</td><td style='text-align: center;'>"+t_Outro_h_CoAmb+"</td><td style='text-align: center;'>"+t_Outro_h_Tempo+"</td><td style='text-align: center;'>"+t_Outro_h_Analisador+"</td><td style='text-align: center;'>"+t_Outro_h_NumSerie+"</td><td style='text-align: center;'><button class='btn btn_red t_excluir_aparelho6' id='"+quantidade+"' style='text-align: center;'><i class='icon-cross'></i>Excluir</button></td></tr>").appendTo('#t_aparelho_6');

         // APARELHO 6
         $('#t_OutroTipo').val("");
         $('#t_OutroMarca').val("");
         $('#t_OutroModelo').val("");
         $('#t_OutroPot').val("");
         $("input[name='t_OutroTiragem']").prop('checked', false);
         $("input[name='t_OutroCombustao']").prop('checked', false);
         $("input[name='t_OutroFuncionamento']").prop('checked', false);

         // HIGIENE COMBUSTAO
         $('#t_Outro_h_Tiragem').val("");
         $('#t_Outro_h_Con').val("");
         $('#t_Outro_h_CoAmb').val("");
         $('#t_Outro_h_Tempo').val("");
         $('#t_Outro_h_Analisador').val("");
         $('#t_Outro_h_NumSerie').val("");
       }
     });



$('#t_aparelho_6').on('click', '.t_excluir_aparelho6', function () {
  var count = $("#t_aparelho6").attr("contador");
  var quantidade = $("#t_aparelho6").attr("quantidade");
  
  $("#t_aparelho6").remove();  
  $("#t_OutroTipo"+this.id).remove(); 
  $("#t_OutroMarca"+this.id).remove();
  $("#t_OutroModelo"+this.id).remove();
  $("#t_OutroPot"+this.id).remove();
  $("#t_OutroTiragem"+this.id).remove();
  $("#t_OutroCombustao"+this.id).remove();
  $("#t_OutroFuncionamento"+this.id).remove();
        // HIGIENE COMBUSTAO
        $("#t_Outro_h_Tiragem"+this.id).remove();
        $("#t_Outro_h_Con"+this.id).remove();
        $("#t_Outro_h_CoAmb"+this.id).remove();
        $("#t_Outro_h_Tempo"+this.id).remove();
        $("#t_Outro_h_Analisador"+this.id).remove();
        $("#t_Outro_h_NumSerie"+this.id).remove();

        $("<span contador='"+(--count)+"' quantidade='"+(++quantidade)+"' id='t_aparelho6'>Outros ("+count+")</span>").appendTo('.t_aparelho6'); 
        $(this).closest('tr').fadeOut();
      });




$('html').on('click', '#j_btn_salvar', function (e) {
  var form = $("#j_form");
  var callback = form.find('input[name="callback"]').val();
  var callback_action = form.find('input[name="callback_action"]').val();

  if ($("select[name='t_num_manometro']").val() == 't' || $("input[name='t_p_inicial']").val() == '' || $("input[name='t_p_Final']").val() == '' || $("input[name='t_tempo_teste']").val() == '') {
    alert("Preencha todos os campos no teste de estanqueidade");   
    e.stop();
  }

  var $fileUpload = $("input[name='medidor_fotos_arquivos[]']");
  if (parseInt($fileUpload.get(0).files.length) > 3){   
    alert("Limite de 3 fotos para Dados do Medidor");   
    e.stop();
  }else if (parseInt($fileUpload.get(0).files.length) == 0){   
    alert("Obrigatório o envio de pelo menos 1 fotos para Dados do Medidor");   
    e.stop();
  }

  $fileUpload = $("input[name='servico_fotos_arquivos[]']");
  if (parseInt($fileUpload.get(0).files.length) > 10){   
    alert("Limite de 10 fotos para Situação do Serviço");   
    e.stop();
  }else if (parseInt($fileUpload.get(0).files.length) == 0){   
    alert("Obrigatório o envio de pelo menos 1 fotos para Situação do Serviço");   
    e.stop();
  }

  $fileUpload = $("input[name='defeitos_fotos_arquivos[]']");
  if (parseInt($fileUpload.get(0).files.length) > 10){   
    alert("Limite de 10 fotos para Instalação com Defeito");   
    e.stop();
  }

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
        //form.find('input[name="defeitos_fotos_arquivos[]"]').replaceWith($('input[name="defeitos_fotos_arquivos[]"]').clone());
        //form.find('input[name="medidor_fotos_arquivos[]"]').replaceWith($('input[name="medidor_fotos_arquivos[]"]').clone());
        //form.find('input[name="servico_fotos_arquivos[]"]').replaceWith($('input[name="servico_fotos_arquivos[]"]').clone());
      },
      success: function (data) {
        if (data.trigger) {
          Trigger(data.trigger);
        }
        //location.reload();
      }  
    });
});