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
    '<td style="width: 5%;"><center><img src="'+ src +'" style="width: 50%;"/> <br><span style="overflow: hidden;display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">'+f.name.replace(/.\w+$/, "")+'</span></center></td>'+
    '<td><select id="tipos'+n+'" name="tipoArquivo'+n+'">'+
    '<option value="z" disabled> Documentos Básicos </option>'+
    '<option value="y" disabled> <!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<! </option>'+
    '<option value="0">Cert. Inf. Riscos - Distribuição Gás</option>'+
    '<option value="1">Cert. Inf. Riscos - Recursos e Serviços</option>'+
    '<option value="2">Ent. EPIs</option>'+
    '<option value="3">Cert. Emp. Formação</option>'+
    '<option value="4">Cart. Nacion. Habilitação</option>'+
    '<option value="5">Cart. ASSINADA</option>'+
    '<option value="6">Termo Rescisão Contrato (TRCT)</option>'+
    '<option value="7">Guia Recolhimento Federal</option>'+
    '<option value="8">Folha de Ponto. Empregado</option>'+
    '<option value="9">Aviso de Férias</option>'+
    '<option value="10">Contrato de Trabalho</option>'+
    '<option value="11">Ates. Ocupacional - ASO</option>'+
    '<option value="12">Regi. Responsável Técnico Empresa</option>'+
    '<option value="y" disabled> <!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<! </option>'+
    '<option value="x" disabled> Outros Documentos </option>'+
    '<option value="y" disabled> <!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<!<! </option>'+
    '<option value="13">Certificação de JO</option>'+
    '<option value="14">Certificação de Desenhista de Campo</option>'+
    '<option value="15">Certificação/Qualificação de Soldadores de Aço</option>'+
    '<option value="16">Certificação de Inspetores de Solda de Aço</option>'+
    '<option value="17">Certificação de Soldadores de PE</option>'+
    '<option value="18">Certificação de Inspetores de Alta</option>'+
    '<option value="19">Navegador de NMD</option>'+
    '<option value="20">Operador NMD</option>'+
    '<option value="21">Título de Certificado de Operador de Medidor</option>'+
    '<option value="22">Titulo de Certificado de Inspetor de Vistoria e Alta</option>'+
    '<option value="23">Título de Certificado de Instalador Predial de Tubulações de gás</option>'+
    '<option value="24">Trabalhos em Altura</option>'+
    '<option value="25">Reg. de cpc. específica para vigia e trabalhadores de entrada em espaço confinado</option>'+
    '<option value="26">Reg. de cpc. específica para Supervisores de Entrada em espaços confinados</option>'+
    '<option value="27">Seguridade na Manipulação de Produtos Químicos</option>'+
    '<option value="28">Motorista de Transporte de Produtos Perigosos</option>'+
    '<option value="29">Reg. de treinamento dos colaboradores em Prevenção contra incêndios</option>'+
    '<option value="30">Oficina de Liderança de Segurança e Saúde</option>'+
    '<td><input type="date" id="validadeDoc'+n+'" name="validade'+n+'" class="validadeDoc" /> </td>'+
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

  $('.validadeDoc').each(function (index, value){
    var link = $(this).val();

    if (link === "") {
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

        //MENSAGEM DE ARQUIVO
        //Trigger(t.trigger);

        //ADICIONA LINHAS NA TABELA
        $(t.tipo).appendTo("#j_table_ConsultaDoc");


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
      $('#funcionario').show();
      $('#funcionarioD').hide();
      $('#arquivos').val("");
      $('#j_table_EnvioDoc tr').remove();
      $('#j_table_ConsultaDoc tr').remove();
      $('#funcionario select').prop('disabled', false);
      $('#funcionarioD select').prop('disabled', true);
      $('#funcionarioD select').prop('selectedIndex', 0);
    } else{
      $('#funcionario').hide();
      $('#funcionarioD').show();
      $('#arquivos').val("");
      $('#j_table_EnvioDoc tr').remove();
      $('#j_table_ConsultaDoc tr').remove();
      $('#funcionario select').prop('disabled', true);
      $('#funcionarioD select').prop('disabled', false);
      $('#funcionario select').prop('selectedIndex', 0);
    }
  });

 },'json');
});

//*************************************************************** SPACE ************************************************************************ //
//*************************************************************** SPACE ************************************************************************ //
//*************************************************************** SPACE ************************************************************************ //
//*************************************************************** SPACE ************************************************************************ //
//*************************************************************** SPACE ************************************************************************ //
//*************************************************************** SPACE ************************************************************************ //