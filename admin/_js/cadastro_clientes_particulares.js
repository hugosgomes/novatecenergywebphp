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
                    $('.wc_cnpj').val(data.cliente['CNPJ']);
                    $('.wc_nome').val(data.cliente['NOME']);
                    $('.wc_telefone').val(data.cliente['TELEFONE']);
                    $('.wc_endereco').val(data.cliente['ENDERECO']);
                    $('.wc_email').val(data.cliente['EMAIL']);
                    $('.wc_tipo').val(data.cliente['TIPO']);

                     // MUDAR BOTÃO AO ESCOLHER CLIENTE
                     $(".abrir_chamado").show();
                     $(".cad_cadastro").hide();
                } 
                if (data.dadosCliente) {
                    $('.dados').remove();
                    $(data.dadosCliente).appendTo('.j_dados_cliente');
                }else{
                   $('.dados').remove();
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

    $('html').on('click', '.j_edit_cliente', function (e) {
        var ID = $(this).attr('id');
        var Callback = $(this).attr('callback');
        var Callback_action = $(this).attr('callback_action');

        $.post('_ajax/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, ID: ID}, function (data) {

            //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
             if (data.trigger) {
            Trigger(data.trigger);
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

    function abreModal(element){
      var Callback = element.getAttribute('callback');
      var Callback_action = element.getAttribute('callback_action');
      var ID = element.getAttribute('id');

      $.post('_ajax/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, ID: ID}, function (data) {  


        if (data.trigger) {
            Trigger(data.trigger);
        }  
        
        if(data.editaDados){
            $('.wc_id').val(data.editaDados['ID']);
            $('.wc_cpf').val(data.editaDados['CPF']);
            $('.wc_cnpj').val(data.editaDados['CNPJ']);
            $('.wc_nome').val(data.editaDados['NOME']);
            $('.wc_telefone').val(data.editaDados['TELEFONE']);
            $('.wc_email').val(data.editaDados['EMAIL']);
            $('.wc_tipo').val(data.editaDados['TIPO']);
        }

        if (data.redirect) {
            $('.workcontrol_upload p').html("Atualizando dados, aguarde!");
            $('.workcontrol_upload').fadeIn().css('display', 'flex');
            window.setTimeout(function () {
                window.location.href = data.redirect;
                if (window.location.hash) {
                    window.location.reload();
                }
            }, 1500);
        }

    }, 'json');
  }
  $('html, body').on('click', '.j_usar_endereco', function (e) {
    var ID = $(this).attr('id');
    var Callback = $(this).attr('callback');
    var Callback_action = $(this).attr('callback_action');

    $.post('_ajax/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, ID: ID}, function (data) {

        //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
        if (data.trigger) {
            Trigger(data.trigger);
       
        }
        if(data.useEndereco){

            $('.wc_cep').val(data.useEndereco['CEP']);
            $('.wc_logradouro').val(data.useEndereco['LOGRADOURO']);
            $('.wc_numero').val(data.useEndereco['NUMERO']);
            $('.wc_complemento').val(data.useEndereco['COMPLEMENTO']);
            $('.wc_bairro').val(data.useEndereco['BAIRRO']);
            $('.wc_localidade').val(data.useEndereco['CIDADE']);
            $('.wc_uf').val(data.useEndereco['UF']);
        }

    }, 'json');

});





 /*$('html, body').on('click', '.j_buscar_cliente', function (e) {
    var  availableTags = [];

   //var Cliente = $(this).val();
   var Callback = $(this).attr('callback');
   var Callback_action = $(this).attr('callback_action');

   $.post('_ajax/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action}, function (data) {

        //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
        if (data.trigger) {
            Trigger(data.trigger);

        }
        if(data.buscarCliente){

         for (var i = 0; i < data.buscarCliente.length; i++) {
            
               availableTags[i] = data.buscarCliente[i]['ID'] + " - " + data.buscarCliente[i]['NOME'];

               $( "#tags" ).autocomplete({
                  source: availableTags,
                  select: function (e, i) {
                // $(campo txt).attr('input','valor a adicionar');
                    var valor =  $(this).val();
                    var id = valor.split(' ')[0];

                    console.log(id)

                }
            });
         }
               //console.log(data.buscarCliente[0]['NOME']);
        }

    }, 'json');

  });*/