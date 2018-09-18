//CONSULTA NO BANCO QUANDO MUDA O TÉCNICO NO SELECT
$(function(){
    $('#Usuario').change(function(){
        var ID = $(this).val();
        var Callback = $(this).attr('callback');
        var Callback_action = $(this).attr('callback_action');

        $.post('_ajax/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, ID: ID}, function (data) {

                //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
                if(data.trigger){
                    Trigger(data.trigger);
                } 
                //ADICIONA OS DADOS DA O.S PARA APRESENTAR NA TABELA NA TELA DE AGENDAMENTOS
                if (data.dadosUsuario) {
                    $("#dadosUsuario").remove();
                    $(data.dadosUsuario).appendTo('.dadosUsuario');
                }
                //ADICIONA OS VALORES CORRESPONDENTES NA LISTA NA TELA DE MONITORAMENTO
                if (data.permissoesUsuario) {
                    $("#permissoesUsuario").remove();
                    $(data.permissoesUsuario).appendTo('.permissoesUsuario');
                }
            }, 'json');
    });
});

//DELETA O.S DO TÉCNICO
$('html, body').on('click', '.j_resetar_senha', function (e) {
    var ID = $(this).attr('id');
    var Callback = $(this).attr('callback');
    var Callback_action = $(this).attr('callback_action');

    $.post('_ajax/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, ID: ID}, function (data) {

        //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
        if (data.trigger) {
            Trigger(data.trigger);
            $('.' + RelTo + '[id="' + Prevent.attr('id') + '"] .j_delete_action_confirm:eq(0)').fadeOut('fast', function () {
                $('.' + RelTo + '[id="' + Prevent.attr('id') + '"] .j_delete_action:eq(0)').fadeIn('fast');
            });
        } else {
            $('.' + RelTo + '[id="' + DelId + '"]').fadeOut('fast');
        }
        //ADICIONA OS DADOS DA OS PARA APRESENTAR NA TABELA
        if (data.deltable) {
            $('#'+ data.deltable).fadeOut(400);
        }

        //DINAMIC CONTENT
        if (data.divcontent) {
            $(data.divcontent[0]).html(data.divcontent[1]);
        }
    }, 'json');

    e.preventDefault();
    e.stopPropagation();
});
