//EXIBER CHECKBOX  
var tempoEvento = 500; 
function exibeCheckbox(){
    $("#vazamento").change(function() {
        if(this.checked) {
            $('.t_vazamento-L').fadeIn(tempoEvento);
        }
    });
    $("#ok").change(function() {
        if(this.checked) {
            $('.t_vazamento-L').fadeOut(tempoEvento);
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

     var count = $("#t_aparelho1").attr("contador");
       $("#t_aparelho1").remove();       
       $("<span contador='"+(++count)+"' id='t_aparelho1'>Cozinha ("+count+")</span>").appendTo('.t_aparelho1'); 

        // APARELHO 1
     
       //TIPO
       $("<input type='hidden' value='"+t_cozinhaTipo+"' name='t_cozinhaTipo"+count+"'  placeholder='Tipo:' />").appendTo('.hiddens');
       //MARCA
       $("<input type='hidden' value='"+t_cozinhaMarca+"' name='t_cozinhaMarca"+count+"'   placeholder='Marca:' />").appendTo('.hiddens');
        //MODELO
        $("<input type='hidden' value='"+t_cozinhaModelo+"' name='t_cozinhaModelo"+count+"' placeholder='Modelo:' />").appendTo('.hiddens');
        //POT
        $("<input type='hidden' value='"+t_cozinhaPot+"' name='t_cozinhaPot"+count+"'  placeholder='Potência:' />").appendTo('.hiddens');
        //FUNCIONAMENTO
        $("<input type='hidden' value='"+t_cozinhaFuncionamento+"' name='t_cozinhaFuncionamento"+count+"'   style='width:5%' checked />").appendTo('.hiddens');

        $('#t_cozinhaTipo').val("");
        $('#t_cozinhaMarca').val("");
        $('#t_cozinhaModelo').val("");
        $('#t_cozinhaPot').val("");

}
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
       $("#t_aparelho2").remove();       
       $("<span contador='"+(++count)+"' id='t_aparelho2'>Banheiro Social ("+count+")</span>").appendTo('.t_aparelho2'); 

       // APARELHO 2
     
        //TIPO
        $("<input type='hidden' value='"+t_b_SocialTipo+"' name='t_b_SocialTipo"+count+"' />").appendTo('.hiddens');
        //MARCA
        $("<input type='hidden' value='"+t_b_SocialMarca+"' name='t_b_SocialMarca"+count+"'  />").appendTo('.hiddens');
        //MODELO
        $("<input type='hidden' value='"+t_b_SocialModelo+"' name='t_b_SocialModelo"+count+"'  />").appendTo('.hiddens');
        //POT
        $("<input type='hidden' value='"+t_b_SocialPot+"' name='t_b_SocialPot"+count+"' />").appendTo('.hiddens');

        //TIRAGEM
        $("<input type='hidden' value='"+t_b_SocialTiragem+"' name='t_b_SocialTiragem"+count+"' checked />").appendTo('.hiddens');
         //COMBUSTÃO
        $("<input type='hidden' value='"+t_b_SocialCombustao+"' name='t_b_SocialCombustao"+count+"' checked />").appendTo('.hiddens');
         //FUNCIONAMENTO
        $("<input type='hidden' value='"+t_b_SocialFuncionamento+"' name='t_b_SocialFuncionamento"+count+"' checked />").appendTo('.hiddens');

        
            // HIGIENE COMBUSTÃO

         //TIRAGEM
        $("<input type='hidden' value='"+t_b_Social_h_Tiragem+"' name='t_b_Social_h_Tiragem"+count+"' />").appendTo('.hiddens');
        //CON
        $("<input type='hidden' value='"+t_b_Social_h_Con+"' name='t_b_Social_h_Con"+count+"'  />").appendTo('.hiddens');
        //COAMB
        $("<input type='hidden' value='"+t_b_Social_h_CoAmb+"' name='t_b_Social_h_CoAmb"+count+"'  />").appendTo('.hiddens');
        //TEMPO
        $("<input type='hidden' value='"+t_b_Social_h_Tempo+"' name='t_b_Social_h_Tempo"+count+"' />").appendTo('.hiddens');
        //ANALISADOR
        $("<input type='hidden' value='"+t_b_Social_h_Analisador+"' name='t_b_Social_h_Analisador"+count+"'  />").appendTo('.hiddens');
        //NUMERO DE SERIE
        $("<input type='hidden' value='"+t_b_Social_h_NumSerie+"' name='t_b_Social_h_NumSerie"+count+"' />").appendTo('.hiddens');

         $('#t_b_SocialTipo').val("");
         $('#t_b_SocialMarca').val("");
         $('#t_b_SocialModelo').val("");
         $('#t_b_SocialPot').val("");
 

         // HIGIENE COMBUSTAO
         $('#t_b_Social_h_Tiragem').val("");
         $('#t_b_Social_h_Con').val("");
         $('#t_b_Social_h_CoAmb').val("");
         $('#t_b_Social_h_Tempo').val("");
         $('#t_b_Social_h_Analisador').val("");
         $('#t_b_Social_h_NumSerie').val("");


}

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
       $("#t_aparelho3").remove();       
       $("<span contador='"+(++count)+"' id='t_aparelho3'>Banheiro Suite ("+count+")</span>").appendTo('.t_aparelho3'); 

       // APARELHO 3
     
        //TIPO
        $("<input type='hidden' value='"+t_b_SuiteTipo+"' name='t_b_SuiteTipo"+count+"' />").appendTo('.hiddens');
        //MARCA
        $("<input type='hidden' value='"+t_b_SuiteMarca+"' name='t_b_SuiteMarca"+count+"'  />").appendTo('.hiddens');
        //MODELO
        $("<input type='hidden' value='"+t_b_SuiteModelo+"' name='t_b_SuiteModelo"+count+"'  />").appendTo('.hiddens');
        //POT
        $("<input type='hidden' value='"+t_b_SuitePot+"' name='t_b_SuitePot"+count+"' />").appendTo('.hiddens');

        //TIRAGEM
        $("<input type='hidden' value='"+t_b_SuiteTiragem+"' name='t_b_SuiteTiragem"+count+"' checked />").appendTo('.hiddens');
         //COMBUSTÃO
        $("<input type='hidden' value='"+t_b_SuiteCombustao+"' name='t_b_SuiteCombustao"+count+"' checked />").appendTo('.hiddens');
         //FUNCIONAMENTO
        $("<input type='hidden' value='"+t_b_SuiteFuncionamento+"' name='t_b_SuiteFuncionamento"+count+"' checked />").appendTo('.hiddens');

        
            // HIGIENE COMBUSTÃO

         //TIRAGEM
        $("<input type='hidden' value='"+t_b_Suite_h_Tiragem+"' name='t_b_Suite_h_Tiragem"+count+"' />").appendTo('.hiddens');
        //CON
        $("<input type='hidden' value='"+t_b_Suite_h_Con+"' name='t_b_Suite_h_Con"+count+"'  />").appendTo('.hiddens');
        //COAMB
        $("<input type='hidden' value='"+t_b_Suite_h_CoAmb+"' name='t_b_Suite_h_CoAmb"+count+"'  />").appendTo('.hiddens');
        //TEMPO
        $("<input type='hidden' value='"+t_b_Suite_h_Tempo+"' name='t_b_Suite_h_Tempo"+count+"' />").appendTo('.hiddens');
        //ANALISADOR
        $("<input type='hidden' value='"+t_b_Suite_h_Analisador+"' name='t_b_Suite_h_Analisador"+count+"'  />").appendTo('.hiddens');
        //NUMERO DE SERIE
        $("<input type='hidden' value='"+t_b_Suite_h_NumSerie+"' name='t_b_Suite_h_NumSerie"+count+"' />").appendTo('.hiddens');


         // APARELHO 3
         $('#t_b_SuiteTipo').val("");
         $('#t_b_SuiteMarca').val("");
         $('#t_b_SuiteModelo').val("");
         $('#t_b_SuitePot').val("");

         // HIGIENE COMBUSTAO
         $('#t_b_Suite_h_Tiragem').val("");
         $('#t_b_Suite_h_Con').val("");
         $('#t_b_Suite_h_CoAmb').val("");
         $('#t_b_Suite_h_Tempo').val("");
         $('#t_b_Suite_h_Analisador').val("");
         $('#t_b_Suite_h_NumSerie').val("");


}

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
       $("#t_aparelho4").remove();       
       $("<span contador='"+(++count)+"' id='t_aparelho4'>Banheiro Serviço ("+count+")</span>").appendTo('.t_aparelho4'); 

       // APARELHO 4
     
        //TIPO
        $("<input type='hidden' value='"+t_b_ServicoTipo+"' name='t_b_ServicoTipo"+count+"' />").appendTo('.hiddens');
        //MARCA
        $("<input type='hidden' value='"+t_b_ServicoMarca+"' name='t_b_ServicoMarca"+count+"'  />").appendTo('.hiddens');
        //MODELO
        $("<input type='hidden' value='"+t_b_ServicoModelo+"' name='t_b_ServicoModelo"+count+"'  />").appendTo('.hiddens');
        //POT
        $("<input type='hidden' value='"+t_b_ServicoPot+"' name='t_b_ServicoPot"+count+"' />").appendTo('.hiddens');

        //TIRAGEM
        $("<input type='hidden' value='"+t_b_ServicoTiragem+"' name='t_b_ServicoTiragem"+count+"' checked />").appendTo('.hiddens');
         //COMBUSTÃO
        $("<input type='hidden' value='"+t_b_ServicoCombustao+"' name='t_b_ServicoCombustao"+count+"' checked />").appendTo('.hiddens');
         //FUNCIONAMENTO
        $("<input type='hidden' value='"+t_b_ServicoFuncionamento+"' name='t_b_ServicoFuncionamento"+count+"' checked />").appendTo('.hiddens');

        
            // HIGIENE COMBUSTÃO

         //TIRAGEM
        $("<input type='hidden' value='"+t_b_Servico_h_Tiragem+"' name='t_b_Servico_h_Tiragem"+count+"' />").appendTo('.hiddens');
        //CON
        $("<input type='hidden' value='"+t_b_Servico_h_Con+"' name='t_b_Servico_h_Con"+count+"'  />").appendTo('.hiddens');
        //COAMB
        $("<input type='hidden' value='"+t_b_Servico_h_CoAmb+"' name='t_b_Servico_h_CoAmb"+count+"'  />").appendTo('.hiddens');
        //TEMPO
        $("<input type='hidden' value='"+t_b_Servico_h_Tempo+"' name='t_b_Servico_h_Tempo"+count+"' />").appendTo('.hiddens');
        //ANALISADOR
        $("<input type='hidden' value='"+t_b_Servico_h_Analisador+"' name='t_b_Servico_h_Analisador"+count+"'  />").appendTo('.hiddens');
        //NUMERO DE SERIE
        $("<input type='hidden' value='"+t_b_Servico_h_NumSerie+"' name='t_b_Servico_h_NumSerie"+count+"' />").appendTo('.hiddens');

        // APARELHO 4
        $('#t_b_ServicoTipo').val("");
        $('#t_b_ServicoMarca').val("");
        $('#t_b_ServicoModelo').val("");
        $('#t_b_ServicoPot').val("");

       // HIGIENE COMBUSTAO
       $('#t_b_Servico_h_Tiragem').val("");
       $('#t_b_Servico_h_Con').val("");
       $('#t_b_Servico_h_CoAmb').val("");
       $('#t_b_Servico_h_Tempo').val("");
       $('#t_b_Servico_h_Analisador').val("");
       $('#t_b_Servico_h_NumSerie').val("");


}

  });



  // TESTE DE ESTANQUEIDADE - MODAL ÁREA SERVIÇO

  $('html').on('click', '.t_salvar_area_servico', function (e) {

    // APARELHO 4
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


// APARELHO 4
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
       $("#t_aparelho5").remove();       
       $("<span contador='"+(++count)+"' id='t_aparelho5'>Área Serviço ("+count+")</span>").appendTo('.t_aparelho5'); 

       // APARELHO 4
     
        //TIPO
        $("<input type='hidden' value='"+t_a_ServicoTipo+"' name='t_a_ServicoTipo"+count+"' />").appendTo('.hiddens');
        //MARCA
        $("<input type='hidden' value='"+t_a_ServicoMarca+"' name='t_a_ServicoMarca"+count+"'  />").appendTo('.hiddens');
        //MODELO
        $("<input type='hidden' value='"+t_a_ServicoModelo+"' name='t_a_ServicoModelo"+count+"'  />").appendTo('.hiddens');
        //POT
        $("<input type='hidden' value='"+t_a_ServicoPot+"' name='t_a_ServicoPot"+count+"' />").appendTo('.hiddens');

        //TIRAGEM
        $("<input type='hidden' value='"+t_a_ServicoTiragem+"' name='t_a_ServicoTiragem"+count+"' checked />").appendTo('.hiddens');
         //COMBUSTÃO
        $("<input type='hidden' value='"+t_a_ServicoCombustao+"' name='t_a_ServicoCombustao"+count+"' checked />").appendTo('.hiddens');
         //FUNCIONAMENTO
        $("<input type='hidden' value='"+t_a_ServicoFuncionamento+"' name='t_a_ServicoFuncionamento"+count+"' checked />").appendTo('.hiddens');

        
            // HIGIENE COMBUSTÃO

         //TIRAGEM
        $("<input type='hidden' value='"+t_a_Servico_h_Tiragem+"' name='t_a_Servico_h_Tiragem"+count+"' />").appendTo('.hiddens');
        //CON
        $("<input type='hidden' value='"+t_a_Servico_h_Con+"' name='t_a_Servico_h_Con"+count+"'  />").appendTo('.hiddens');
        //COAMB
        $("<input type='hidden' value='"+t_a_Servico_h_CoAmb+"' name='t_a_Servico_h_CoAmb"+count+"'  />").appendTo('.hiddens');
        //TEMPO
        $("<input type='hidden' value='"+t_a_Servico_h_Tempo+"' name='t_a_Servico_h_Tempo"+count+"' />").appendTo('.hiddens');
        //ANALISADOR
        $("<input type='hidden' value='"+t_a_Servico_h_Analisador+"' name='t_a_Servico_h_Analisador"+count+"'  />").appendTo('.hiddens');
        //NUMERO DE SERIE
        $("<input type='hidden' value='"+t_a_Servico_h_NumSerie+"' name='t_a_Servico_h_NumSerie"+count+"' />").appendTo('.hiddens');

        // APARELHO 4
        $('#t_a_ServicoTipo').val("");
        $('#t_a_ServicoMarca').val("");
        $('#t_a_ServicoModelo').val("");
        $('#t_a_ServicoPot').val("");

       // HIGIENE COMBUSTAO
       $('#t_a_Servico_h_Tiragem').val("");
       $('#t_a_Servico_h_Con').val("");
       $('#t_a_Servico_h_CoAmb').val("");
       $('#t_a_Servico_h_Tempo').val("");
       $('#t_a_Servico_h_Analisador').val("");
       $('#t_a_Servico_h_NumSerie').val("");


}

  });



  // TESTE DE ESTANQUEIDADE - MODAL OUTRO

  $('html').on('click', '.t_salvar_outro', function (e) {

    // APARELHO 4
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


// APARELHO 4
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
       $("#t_aparelho6").remove();       
       $("<span contador='"+(++count)+"' id='t_aparelho6'>Outros ("+count+")</span>").appendTo('.t_aparelho6'); 

       // APARELHO 4
     
        //TIPO
        $("<input type='hidden' value='"+t_OutroTipo+"' name='t_OutroTipo"+count+"' />").appendTo('.hiddens');
        //MARCA
        $("<input type='hidden' value='"+t_OutroMarca+"' name='t_OutroMarca"+count+"'  />").appendTo('.hiddens');
        //MODELO
        $("<input type='hidden' value='"+t_OutroModelo+"' name='t_OutroModelo"+count+"'  />").appendTo('.hiddens');
        //POT
        $("<input type='hidden' value='"+t_OutroPot+"' name='t_OutroPot"+count+"' />").appendTo('.hiddens');

        //TIRAGEM
        $("<input type='hidden' value='"+t_OutroTiragem+"' name='t_OutroTiragem"+count+"' checked />").appendTo('.hiddens');
         //COMBUSTÃO
        $("<input type='hidden' value='"+t_OutroCombustao+"' name='t_OutroCombustao"+count+"' checked />").appendTo('.hiddens');
         //FUNCIONAMENTO
        $("<input type='hidden' value='"+t_OutroFuncionamento+"' name='t_OutroFuncionamento"+count+"' checked />").appendTo('.hiddens');

        
            // HIGIENE COMBUSTÃO

         //TIRAGEM
        $("<input type='hidden' value='"+t_Outro_h_Tiragem+"' name='t_Outro_h_Tiragem"+count+"' />").appendTo('.hiddens');
        //CON
        $("<input type='hidden' value='"+t_Outro_h_Con+"' name='t_Outro_h_Con"+count+"'  />").appendTo('.hiddens');
        //COAMB
        $("<input type='hidden' value='"+t_Outro_h_CoAmb+"' name='t_Outro_h_CoAmb"+count+"'  />").appendTo('.hiddens');
        //TEMPO
        $("<input type='hidden' value='"+t_Outro_h_Tempo+"' name='t_Outro_h_Tempo"+count+"' />").appendTo('.hiddens');
        //ANALISADOR
        $("<input type='hidden' value='"+t_Outro_h_Analisador+"' name='t_Outro_h_Analisador"+count+"'  />").appendTo('.hiddens');
        //NUMERO DE SERIE
        $("<input type='hidden' value='"+t_Outro_h_NumSerie+"' name='t_Outro_h_NumSerie"+count+"' />").appendTo('.hiddens');

        // APARELHO 4
        $('#t_OutroTipo').val("");
        $('#t_OutroMarca').val("");
        $('#t_OutroModelo').val("");
        $('#t_OutroPot').val("");

       // HIGIENE COMBUSTAO
       $('#t_Outro_h_Tiragem').val("");
       $('#t_Outro_h_Con').val("");
       $('#t_Outro_h_CoAmb').val("");
       $('#t_Outro_h_Tempo').val("");
       $('#t_Outro_h_Analisador').val("");
       $('#t_Outro_h_NumSerie').val("");


}

  });



/*
$('html').on('click', '#j_btn_salvar', function (e) {
    var form = $("#j_form");
    var callback = form.find('input[name="callback"]').val();
    var callback_action = form.find('input[name="callback_action"]').val();
 
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
            form.find('input[name="image[]"]').replaceWith($('input[name="image[]"]').clone());
        },
        success: function (data) {
            if (data.trigger) {
                Trigger(data.trigger);
            }

            //DATA CLEAR INPUT
            /*if (data.ID) {
                $('.pointer[idorcamento="'+data.ID+'"]').click(); 
                $('#j_btn_cancelar').click();
                $('#j_form input').val("");
                $('#j_form select').val("t");
            }
        }
    });

});*/