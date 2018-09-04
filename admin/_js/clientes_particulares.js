// MODAL
//$(document).ready(function(){

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
//});
// CALENDARIO
  $( function() {
    $( "#datepicker" ).datepicker();
  });


/*$(document).ready(function(){
  mostraDados();
});

function mostraDados(){
  $('.clientes_sem_contato').remove();
  $("<span  style='color: #bdbdbd;'>lalala</span>").appendTo('.j_coluna_1');
}*/

$(function(){
        $('.select_endereco').change(function(){
          alert('Teste');
        });
});