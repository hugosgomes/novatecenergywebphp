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
      //console.log(f.type);
      //console.log(i);*/

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
      '</select></td>'+
      '</tr>';
      //console.log(arquivosPreview);
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
  var idtipos = $('#tipos').val();
  var callback = form.find('input[name="callback"]').val();
  var callback_action = form.find('input[name="callback_action"]').val();

  if (typeof tinyMCE !== 'undefined') {
    tinyMCE.triggerSave();
  }
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
        //form.find('input[name="medidor_fotos_arquivos[]"]').replaceWith($('input[name="medidor_fotos_arquivos[]"]').clone());
        //form.find('input[name="servico_fotos_arquivos[]"]').replaceWith($('input[name="servico_fotos_arquivos[]"]').clone());
      },
      success: function (data) {
        //SALVA
        $('#j_btn_salvar').val('true');

        //REMOVE AS TABELAS DE DOCUMENTOS
        $('#j_table_EnvioDoc tr').remove();

        //ATUALIZA OS DOCUMENTOS DO FUNCINÁRIO
        $('#funcionario').change();

          Trigger(data.trigger);
        }  
      });

});

$(document).on('change', '#funcionario', function(){
  var funcionarioid = $('#funcionario option:selected').val();
  var callback = 'Rh';
  var callback_action = 'selecionarFuncionario';

      //console.log(funcionarioid);
      $.post('_ajax/' + callback + '.ajax.php', {callback, callback_action, funcionarioid}, function (t) {

        //REMOVE OS ARQUIVOS SELECIONAOS
        $('#arquivos').val("");

        //REMOVE AS LINHAS DA TABELA ARQUIVOS
        $('#j_table_EnvioDoc tr').remove();

        //REMOVE TODAS AS LINHAS DA TABELA
        $('#j_table_ConsultaDoc tr').remove();

        //ADICIONA LINHAS NA TABELA
        $(t.tipo).appendTo("#j_table_ConsultaDoc");



      },'json');


    });


// SPACE //

$('html').on('click', '#j_btn_salvar', function (sd) {
  var form = $("#j_enviarDocumento");
  var idfuncionario = $('#funcionarioD').val();
  var idarquivos = $('#arquivos').val();
  var idtipos = $('#tipos').val();
  var callback = form.find('input[name="callback"]').val();
  var callback_action = form.find('input[name="callback_action"]').val();

  if (typeof tinyMCE !== 'undefined') {
    tinyMCE.triggerSave();
  }
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
        //form.find('input[name="medidor_fotos_arquivos[]"]').replaceWith($('input[name="medidor_fotos_arquivos[]"]').clone());
        //form.find('input[name="servico_fotos_arquivos[]"]').replaceWith($('input[name="servico_fotos_arquivos[]"]').clone());
      },
      success: function (dataD) {
        //SALVA
        $('#j_btn_salvar').val('true');

        //REMOVE AS TABELAS DE DOCUMENTOS
        $('#j_table_EnvioDoc tr').remove();

        //ATUALIZA OS DOCUMENTOS DO FUNCINÁRIO
        $('#funcionarioD').change();

          Trigger(dataD.trigger);
        }  
      });

});

$(document).on('change', '#funcionarioD', function(){
  var funcionarioid = $('#funcionarioD option:selected').val();
  var callback = 'Rh';
  var callback_action = 'selecionarFuncionario';

      //console.log(funcionarioid);
      $.post('_ajax/' + callback + '.ajax.php', {callback, callback_action, funcionarioid}, function (t) {

        //REMOVE OS ARQUIVOS SELECIONAOS
        $('#arquivos').val("");

        //REMOVE AS LINHAS DA TABELA ARQUIVOS
        $('#j_table_EnvioDoc tr').remove();

        //REMOVE TODAS AS LINHAS DA TABELA
        $('#j_table_ConsultaDoc tr').remove();

        //
        //$('#funcionario').change();
        $('#funcionario option:selected').val("");

        //ADICIONA LINHAS NA TABELA
        $(t.tipo).appendTo("#j_table_ConsultaDoc");



      },'json');


    });
