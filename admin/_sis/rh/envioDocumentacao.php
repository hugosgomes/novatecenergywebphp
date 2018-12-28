<?php
if (!$DashboardLogin || !$_SESSION['userLogin'] || ($Permissao['RH'] == 0)):
  die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
  $Read = new Read;
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Create)):
  $Create = new Create;
endif;
?>
<link rel="stylesheet" type="text/css" href="_css/rh.css">
<?php
$IdFUNC = filter_input(INPUT_GET, 'ID', FILTER_DEFAULT);
?>
<header class="dashboard_header">
  <div class="dashboard_header_title">
    <p class="dashboard_header_breadcrumbs">
      &raquo; Home
      <span class="crumb">/</span>
      <a title="<?= ADMIN_NAME; ?>" href="dashboard.php?wc=users/home">Documentação</a>
    </p>
  </div>
</header>
<div class="dashboard_content custom_app" >
  <!--BOTÕES SUPERIORES-->
  <article class="box box100 no-print">   
   <form class="j_enviarDocumento tab_create" id="j_enviarDocumento" method="post" enctype="multipart/form-data">
     <!--Funcionários Ativos-->
     <div class="box box100">
      <div class="box_content"  style="border-top: 5px solid #1a4a7b;background-image: linear-gradient(#adadad1c, #ffffff);">
        <div class="box box50">
         <input type="hidden" name="callback" value="Rh"/>
         <input type="hidden" name="callback_action" value="enviar_documentos"/>
         <div class="label box box25">
          <div class="legend" style="display: block;margin-bottom: 12px;text-transform: uppercase"><b>Funcionários</b></div>
          <span><input class="funcionarios" id="1" type="radio" name="1" value="1" style="width:15%" checked>Ativos</span>
          <span><input class="funcionarios" id="2" type="radio" name="1" value="2" style="width:15%">Demitidos</span>
          <?php 
          echo "<input type='hidden' name='IdFUNC' value='{$IdFUNC}' class='IdFUNC'>";
           ?>
        </div>
        <div class="box box50">
          <div></div>
          <div id="funcionario" style="width: 100%;" class="box box50">
            <select name="idfuncionario" class="funcionario">
              <option selected disabled>Selecione o Funcionário</option>
            </select>
          </div>
          <div id="funcionarioD" style="display: none; width: 100%;" class="box box50">
            <select name="idfuncionarioD" class="funcionarioD">
              <option selected disabled>Selecione o Funcionário</option>
            </select>
          </div>
        </div>
      </div><!-- box25-->
      <div class="box box50">
        <div class="box box50" style="margin-left: 20%;">
          <h5>Arquivo</h5>
          <label class=" icon-folder-open btn btn_darkblue" for="arquivos">
            Escolha os Documentos...
          </label>
          <input type="file" style="opacity: 0; z-index: -1;" id="arquivos" name="documentosRH[]" class="extensao" multiple/>
        </div>
      </div>
    </div>
  </div>
  <div class="box box50">
   <div class="box_content"  style="border-top: 5px solid #1a4a7b;background-image: linear-gradient(#adadad1c, #ffffff);">
    <header>
      <div class="box box100">
        <img class="form_load none fl_left" style="margin-left: 10px; margin-top: 2px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.gif"/>
        <!--<button name="public" value="1"  id="j_btn_salvar" class="btn btn_green fl_left icon-file-text2" style="margin-left: 5px;">Enviar</button>-->
        <div class="clear"></div>
        <div id="idarquivos1">
          <center><h3>Arquivos Selecionados</h3></center>
        </div>
      </div>
    </header> 
    <div class="box box100">
      <div id="idarquivos" class="tabela-responsivel" style="height: 45%;">
        <table class="table table-bordered" >
          <thead>
            <th>Arquivo</th>
            <th>Tipo de Arquivo</th>
            <th>Data Documento</th>
          </thead>
          <tbody id="j_table_EnvioDoc">
          </tbody>
        </table>
      </div>
      <div class="box box100">
        <div class="box box33"></div>
        <div class="box box33" style="padding-left: 10%;"><span name="public" value="1"  id="j_btn_salvar" class="btn btn_darkblue fl_left icon-file-text2" style=" font-size: 15px;">Enviar</span></div>
        <div class="box box33"></div>
      </div>      
    </div>
  </div><!-- box content -->
</div><!-- box50 -->
<div class="box box50">
 <div class="box_content"  style="border-top: 5px solid #1a4a7b;background-image: linear-gradient(#adadad1c, #ffffff);">
  <header>
    <div class="box box100">
      <img class="form_load none fl_left" style="margin-right: 10px; margin-top: 2px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.gif"/>
      <!--<button name="public" value="1"  id="j_btn_salvar" class="btn btn_green fl_left icon-file-text2" style="margin-left: 5px;">Enviar</button>-->
      <div class="clear"></div>
      <center><h3>Documentos dos Funcionários</h3></center>
    </div>
  </header>
  <div class="box box100">
    <div id="idarquivos" class="tabela-responsivel" style="height: 52.3%;">
      <table class="table table-bordered" >
        <thead>
         <th class="arquivos_existentes" style="width: 55%;"><center>Documentos</center></th>
         <th>Data Doc.</th>
         <th>Achilles</th>
         <th>Download</th>
       </thead>
       <tbody id="j_table_ConsultaDoc">
       </tbody>
     </table>
   </div>    
 </div>
</div>
</div>
</form>
</article>
<script src="_js/rh.js"></script>