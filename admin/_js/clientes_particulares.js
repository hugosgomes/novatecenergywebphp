// MODAL
$("a[rel=modal]").click( function(ev){
  ev.preventDefault();

  var id = $(this).attr("href");

  var alturaTela = $(document).height();
  var larguraTela = $(window).width();

      //colocando o fundo preto
      $('#mascara').css({'width':larguraTela,'height':alturaTela});
      $('#mascara').fadeIn(100); 
      $('#mascara').fadeTo("fast",0.3);

      var left = ($(window).width() /2) - ( $(id).width() / 2 );
      var top = ($(window).height() / 2) - ( $(id).height() / 2 );

      $(id).css({'top':top,'left':left});
      $(id).show();   
    });

$("#mascara").click( function(){
  $(this).hide();
  $(".window").hide();
});

$('.fechar').click(function(ev){
  ev.preventDefault();
  $("#mascara").hide();
  $(".window").hide();
});

// CALENDARIO
$( function() {
  $( "#datepicker" ).datepicker();
});


$(document).ready(function(){
  mostraDados('Home','consulta');
  iniciaCombos('Home');
});


$('.j_select_endereco').change(function(){
          mostraDados($(this).attr('callback'),$(this).attr('callback_action'));
});

$('.j_select_cliente').change(function(){
          mostraDados($(this).attr('callback'),$(this).attr('callback_action'));
});


function mostraDados(Callback, Callback_action){
  var Endereco = $('#endereco').val();
  var Cliente = $('#cliente').val();


  $.post('_ajax/clientes_particulares/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, endereco: Endereco, cliente: Cliente}, function (data) {  
      //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
        if(data.Trigger){
            Trigger(data.trigger);
        }

        if(data.addcoluna1){
            $('.clientes_sem_contato').remove();
            $(data.addcoluna1).appendTo('.j_coluna_1');
        }                 
  }, 'json');
}

function iniciaCombos(Callback, Callback_action = 'iniciar'){
    $.post('_ajax/clientes_particulares/' + Callback + '.ajax.php', {callback: Callback, callback_action: Callback_action, endereco: Endereco, cliente: Cliente}, function (data) {
    }, 'json');
}