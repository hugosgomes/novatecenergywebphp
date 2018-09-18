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