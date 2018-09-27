//EXIBER CHECKBOX   
function exibeCheckbox(){
    $("#vazamento").change(function() {
        if(this.checked) {
            $('.vazamento-L').fadeIn(100);
        }
    });
    $("#ok").change(function() {
        if(this.checked) {
            $('.vazamento-L').fadeOut(100);
            $('#status-ocorrencia').fadeOut(100);

        }
    });
    $('#maior-5L').change(function(){
        if(this.checked){
            $('#status-ocorrencia').fadeIn(1000);
        }
    })
}


$("#instalacao-ok").change(function() {
    if(this.checked){
        $('#foto-defeito').fadeIn();
    }
});



function exibeTabelaPecas(idTabela){
    $('#add-pecas').click(function(){
        $('#pecas').fadeIn(1000);
        
    })
}




function geraLinhaTabela(){
      var idTr =1;
      var idSelect = 1;
      var idOpt = 1;
      $('#add-pecas').click(function(){
        var tr =  '<tr id="tr'+(idTr++)+'">'+
                    '<td><select id="select'+(idSelect++)+'" class="j_consulta-descricao" callback="Dadostabela" callback_action="consulta"><option id="opt'+(idOpt++)+'" value="t" class="j_option_pecas">Selecione descrição</option></td>'+
                    '<td><input value="" type="number" name="qtd" placeholder="Quantidade:" /></td>'+
                    '<td><input value="" type="text" name="valor-unit" placeholder="Valor unitário:" /></td>'+
                    '<td id="total-linha"><input value="" type="text" name="valor-total" placeholder="Valor unitário:" /></td>'+
                  '</tr>';
                $('tbody').append(tr);
      })

}



 //ADICIONA O.S PARA O TÉCNICO
    $('html').on('click', '.j_add_pecas', function (e) {
        var PecaId = $("#peca option:selected").val();
        var PecaQtd = $(".j_qtd_pecas").val();
        var Callback = $(this).attr('callback');
        var Callback_action = $(this).attr('callback_action');


        $.post('_ajax/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, PecaId: PecaId, PecaQtd: PecaQtd}, function (data) {

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
    });









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

geraLinhaTabela();
exibeCheckbox();
exibeTabelaPecas();