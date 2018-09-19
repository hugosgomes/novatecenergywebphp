    //CONSULTA NO BANCO SE O CLIENTE JÁ EXISTE
  $(function(){
    $('.j_consulta_cliente').change(function(){
        var Valor = $(this).val();
        var Callback = $(this).attr('callback');
        var Callback_action = $(this).attr('callback_action');
        var Rel = $(this).attr('rel');


        $.post('_ajax/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, Valor: Valor, Rel: Rel}, function (data) {

                //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
                if(data.Trigger){
                    Trigger(data.trigger);
                }
                if (data.cliente) {
                    $('.wc_cpf').val(data.cliente['CPF']);
                    $('.wc_cnj').val(data.cliente['CNPJ']);
                    $('.wc_nome').val(data.cliente['NOME']);
                    $('.wc_telefone').val(data.cliente['TELEFONE']);
                    $('.wc_endereco').val(data.cliente['ENDERECO']);
                    $('.wc_email').val(data.cliente['EMAIL']);
                    $('.wc_tipo').val(data.cliente['TIPO']);
                } 
                if (data.dadosCliente) {
                    $('.dados').remove();
                    $(data.dadosCliente).appendTo('.j_dados_cliente');
                }
                if (data.enderecoCLiente) {
                    $('.enderecos').remove();
                    $(data.enderecoCLiente).appendTo('.j_endereco_cliente');

                }else{
                     $('.enderecos').remove();
                }            
            }, 'json');

    });
});