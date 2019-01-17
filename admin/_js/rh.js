var percorrer = 0;
$(document).on('change', '#arquivos', function(event){
  var files = this.files; 
  var i = 0;
  len = files.length;
  
  (function readFile(n) {
    var reader = new FileReader();
    var f = files[n];
    var imgs = document.querySelectorAll(".obj");
    var src = null
    reader.onload = function(e) {
      //console.log(f.type);
      if (f.type == 'application/pdf') { src = 'http://192.168.0.101:83/Pedro/novatec/admin/_img/pdficon.png'
    } else {
      src = e.target.result;
    }

    var arquivosPreview =  '<tr class="j_table_EnvioDoc" id="'+ n +'" nome="'+f.name+'">'+
    '<td style="width: 5%;"><center><img src="'+ src +'" style="width: 30%; height=20%;"/> <br><span style="overflow: hidden;display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">'+f.name.replace(/.\w+$/, "")+'</span></center></td>'+
    '<td><select id="tipos'+n+'" name="tipoArquivo'+n+'" class="selectdocs">'+
    '<option selected disabled>Selecione o Documento</option>'+
    '<option value="z" disabled> Documentos Básicos </option>'+
    '<option value="y" disabled> <!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<! </option>'+
    '<option value="1">Cert. Inf. Riscos - Distribuição Gás</option>'+
    '<option value="2">Cert. Inf. Riscos - Recursos e Serviços</option>'+
    '<option value="3">Ent. EPIs</option>'+
    '<option value="4">Cert. Emp. Formação</option>'+
    '<option value="5">Cart. Nacion. Habilitação</option>'+
    '<option value="6">Cart. ASSINADA</option>'+
    '<option value="7">Termo Rescisão Contrato (TRCT)</option>'+
    '<option value="8">Guia Recolhimento Federal</option>'+
    '<option value="9">Folha de Ponto. Empregado</option>'+
    '<option value="10">Aviso de Férias</option>'+
    '<option value="11">Contrato de Trabalho</option>'+
    '<option value="12">Ates. Ocupacional - ASO</option>'+
    '<option value="13">Regi. Responsável Técnico Empresa</option>'+
    '<option value="y" disabled> <!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<! </option>'+
    '<option value="x" disabled> Documentos Específicos </option>'+
    '<option value="y" disabled> <!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<! </option>'+
    '<option value="14">Certificação de JO</option>'+
    '<option value="15">Certificação de Desenhista de Campo</option>'+
    '<option value="16">Certificação/Qualificação de Soldadores de Aço</option>'+
    '<option value="17">Certificação de Inspetores de Solda de Aço</option>'+
    '<option value="18">Certificação de Soldadores de PE</option>'+
    '<option value="19">Certificação de Inspetores de Alta</option>'+
    '<option value="20">Navegador de NMD</option>'+
    '<option value="21">Operador NMD</option>'+
    '<option value="22">Título de Certificado de Operador de Medidor</option>'+
    '<option value="23">Titulo de Certificado de Inspetor de Vistoria e Alta</option>'+
    '<option value="24">Título de Certificado de Instalador Predial de Tubulações de gás</option>'+
    '<option value="25">Trabalhos em Altura</option>'+
    '<option value="26">Reg. de cpc. específica para vigia e trabalhadores de entrada em espaço confinado</option>'+
    '<option value="27">Reg. de cpc. específica para Supervisores de Entrada em espaços confinados</option>'+
    '<option value="28">Seguridade na Manipulação de Produtos Químicos</option>'+
    '<option value="29">Motorista de Transporte de Produtos Perigosos</option>'+
    '<option value="30">Reg. de treinamento dos colaboradores em Prevenção contra incêndios</option>'+
    '<option value="31">Oficina de Liderança de Segurança e Saúde</option>'+
    '<option value="y" disabled> <!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<! </option>'+
    '<option value="z" disabled> Outros Documentos </option>'+
    '<option value="y" disabled> <!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<! </option>'+
    '<option value="32"> Outros </option>'+
    '<td><input type="date" id="validadeDoc'+n+'" name="validade'+n+'" class="validadeDoc" /></td>'+
    '<td><span id="mensagebox'+n+'" value="'+n+'" class="mensagebox"></span></td>'+
    '</select></td>'+
    '</tr>';
    $(arquivosPreview).appendTo("#j_table_EnvioDoc");
        // if `n` is less than `len` , 
        // call `readFile` with incremented `n` as parameter
        if (n < len -1) readFile(++n);
      };
        reader.readAsDataURL(f); // `f` : current `File` object
    }(i)); // `i` : `n` within immediately invoked function expression
});

$('html').on('click', '#j_btn_salvar', function (e) {
  var form = $("#j_enviarDocumento");
  var idfuncionario = $('#funcionario').val();
  var idarquivos = $('#arquivos').val();
  var datavalidade = $('.validadeDoc').val();
  var idtipos = $('#tipos').val();
  var callback = form.find('input[name="callback"]').val();
  var callback_action = form.find('input[name="callback_action"]').val();

  if (typeof tinyMCE !== 'undefined') {
    tinyMCE.triggerSave();
  }

  $('.nomepasta').each(function(index, value){
    var get = $(this).val();
  });

  $('.validadeDoc').each(function (index, value){
    var link = $(this).val();

    if (link === "") {
      //alert("Não foi possivel realizar a operação. Por favor, verifique se os campos de DATA DOCUMENTO estão preenchidos corretamente.");
      Trigger("<span style='padding: 20px 20px; position: relative; width: 100%; color: white; font-size: 1em; font-weight: 500; background-color: #e81f1f; top: 85;'> <b>Data de documento inserida está vazia! </span>");
    }
  });

  form.ajaxSubmit({            
    url: '_ajax/' + callback + '.ajax.php',
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
        form.find('input[name="documentosRH[]"]').replaceWith($('input[name="documentosRH[]"]').clone());
      },
      success: function (data) {

        //SALVA
        $('#j_btn_salvar').val('true');

        //REMOVE AS TABELAS DE DOCUMENTOS
        $('#j_table_EnvioDoc tr').remove();

        //ATUALIZA OS DOCUMENTOS DO FUNCINÁRIO
        $('#funcionario').change();

        //ATUALIZA OS DOCUMENTOS DO FUNCIONARIOD
        $('#funcionarioD').change();

        //console.log(datavalidade);

        Trigger(data.trigger);
        percorrer = 0;
      }  
    });

});

$(document).on('change', '#funcionario', function(){
  var funcionarioid = $('#funcionario option:selected').val();
  var callback = 'Rh';
  var callback_action = 'selecionarFuncionarioAtivo';
      //console.log(funcionarioid);
      $.post('_ajax/' + callback + '.ajax.php', {callback, callback_action, funcionarioid}, function (t) {

        //REMOVE OS ARQUIVOS SELECIONAOS
        $('#arquivos').val("");

        //REMOVE AS LINHAS DA TABELA ARQUIVOS
        $('#j_table_EnvioDoc tr').remove();

        //REMOVE TODAS AS LINHAS DA TABELA
        $('#j_table_ConsultaDoc tr').remove();
        $('#j_table_outrosdocs tr').remove();
        $('#j_table_ConsultaDocOutros tr').remove();
        $('#spanid tr').remove();

        //MENSAGEM DE ARQUIVO
        //Trigger(t.trigger);

        //ADICIONA LINHAS NA TABELA
        $(t.tipo).appendTo("#j_table_ConsultaDoc");
        $(t.tipo1).appendTo("#spanid");
        $(t.tipo2).appendTo("#j_thead_outrosdocs");
        $(t.tipo3).appendTo("#j_table_ConsultaDocOutros");

      },'json');


    });


//*************************************************************** SPACE ************************************************************************ //
//*************************************************************** SPACE ************************************************************************ //
$(document).on('change', '#funcionarioD', function(){
  var funcionarioDid = $('#funcionarioD option:selected').val();
  var callback = 'Rh';
  var callback_action = 'selecionarFuncionarioDemitido';

      //console.log(funcionarioid);
      $.post('_ajax/' + callback + '.ajax.php', {callback, callback_action, funcionarioDid}, function (t) {

        //REMOVE OS ARQUIVOS SELECIONAOS
        $('#arquivos').val("");

        //REMOVE AS LINHAS DA TABELA ARQUIVOS
        $('#j_table_EnvioDoc tr').remove();

        //REMOVE TODAS AS LINHAS DA TABELA
        $('#j_table_ConsultaDoc tr').remove();

        //MENSAGEM DE ARQUIVO
        //Trigger(t.trigger);

        //ADICIONA LINHAS NA TABELA
        $(t.tipo).appendTo("#j_table_ConsultaDoc");


      },'json');


    });
//*************************************************************** SPACE ************************************************************************ //
//*************************************************************** SPACE ************************************************************************ //

$(document).ready(function(){
  var callback = 'Rh';
  var callback_action = 'selectfuncionarios';
  var pegarIdFUNC = $('.IdFUNC').val();

  $.post('_ajax/' + callback + '.ajax.php', {callback, callback_action, pegarIdFUNC}, function (e) {

    $('#1').prop('checked', true);
    $(e.nome).appendTo(".funcionario"); 
    $(e.nomeD).appendTo(".funcionarioD");

    if (pegarIdFUNC) {
     $('#funcionario select').val(pegarIdFUNC);
     $(e.tipo).appendTo("#j_table_ConsultaDoc");
   }


   $('.funcionarios').change(function(){
    var pegarValor = $(this).val();

    if (pegarValor == 1) {
      $(e.nome).appendTo(".funcionario"); 
      $('#funcionario').show();
      $('#funcionarioD').hide();
      $('#arquivos').val("");
      $('#j_table_EnvioDoc tr').remove();
      $('#j_table_ConsultaDoc tr').remove();
      $('#j_table_outrosdocs tr').remove();
      $('#j_table_ConsultaDocOutros tr').remove();
      $('#spanid tr').remove();
      $('#funcionario select').prop('disabled', false);
      $('#funcionarioD select').prop('disabled', true);
      $('#funcionarioD select').prop('selectedIndex', 0);
    } else{
      $('#funcionario').hide();
      $('#funcionarioD').show();
      $('#arquivos').val("");
      $('#j_table_EnvioDoc tr').remove();
      $('#j_table_ConsultaDoc tr').remove();
      $('#j_table_outrosdocs tr').remove();
      $('#j_table_ConsultaDocOutros tr').remove();
      $('#spanid tr').remove();
      $('#funcionario select').prop('disabled', true);
      $('#funcionarioD select').prop('disabled', false);
      $('#funcionario select').prop('selectedIndex', 0);
    }
  });

 },'json');
});


$(document).on('change', '.selectdocs', function(){
  var getval = $(this).val();
  
  switch(getval){
    case '1':
    case '2':
    case '3':
    case '4':
    case '6':
    case '7':
    case '8':
    case '11':
    $('.mensagebox td').remove();
    $(this).parent().parent().find('.mensagebox').html("<center><font color='red'><b>Data de emissão</font></center>");
    break;

    case '5':
    case '9':
    case '10':
    case '12':
    case '13':
    case '14':
    case '15':
    case '16':
    case '17':
    case '18':
    case '19':
    case '20':
    case '21':
    case '22':
    case '23':
    case '24':
    case '25':
    case '26':
    case '27':
    case '28':
    case '29':
    case '30':
    case '31':
    $('.mensagebox td').remove();
    $(this).parent().parent().find('.mensagebox').html("<center><font color='red'><b>Data de validade</font></center>");
    break;

    case '32':
    $(this).parent().parent().find('.mensagebox').html("<input type='text' id='teste' class='nomepasta' name='nomepasta"+(percorrer++)+"'></input>");
    break;
  }
});


$(document).on('click', '#delete', function(){
  var getclick = $(this).parent().parent().parent().attr('id');
  var func = $('#funcionario option:selected').val();
  var callback = 'Rh';
  var callback_action = 'delete';
  $('#arquivos').val("");
  $('#j_table_EnvioDoc tr').remove();
  $(this).parent().parent().parent().remove();


  $.post('_ajax/' + callback + '.ajax.php', {callback, callback_action, getclick, func}, function (click) {
  });
});