<?php
if (!$DashboardLogin || !$_SESSION['userLogin'] || ($Permissao['TI'] == 0)):
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
<style type="text/css">
td{
  padding: 10px;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  /* width: 50%;*/
}

td, th {
  border: 1px solid #dddddd;
  padding: 8px;
}

tr:hover {
  background-color: #ddd;
}

tr:nth-child(even) {
  background-color:  #f2f2f2;;
}

</style>
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
        <div class="box box25">
         <input type="hidden" name="callback" value="Rh"/>
         <input type="hidden" name="callback_action" value="enviar_documentos"/>
         <div class="box box75" style="margin-left: 20%;">
          <label class="label">
            <h5>Funcionários Ativos</h5>
            <select id="funcionario" name="idfuncionario">
              <option>Selecione o Funcionário</option>             
              <?php
              $Setor = 2;
              $Read->FullRead("SELECT [Funcionários].ID AS id,[NOME COMPLETO] AS nome FROM Funcionários WHERE [DATA DE DEMISSÃO] IS NULL"," ");
              if ($Read->getResult()):
                foreach ($Read->getResult() as $FUNC):
                  echo "<option value='{$FUNC['id']}'>{$FUNC['nome']}</option>";
                endforeach;
              endif;
              ?>
            </select>
          </label>
        </div>
      </div><!-- box25-->
      
      <!--Funcionários Demitidos-->
      <div class="box box25">
       <input type="hidden" name="callback" value="Rh"/>
       <input type="hidden" name="callback_action" value="enviar_documentos"/>
       <div class="box box75" style="margin-left: 20%;">
        <label class="label">
          <h5>Funcionários Demitidos</h5>
          <select id="funcionarioD" name="idfuncionarioD">
            <option>Selecione o Funcionário</option>             
            <?php
            $Setor = 2;
            $Read->FullRead("SELECT [Funcionários].ID AS id,[NOME COMPLETO] AS nome FROM Funcionários WHERE [DATA DE DEMISSÃO] IS NOT NULL"," ");
            if ($Read->getResult()):
              foreach ($Read->getResult() as $FUNC):
                echo "<option value='{$FUNC['id']}'>{$FUNC['nome']}</option>";
              endforeach;
            endif;
            ?>
          </select>
        </label>
      </div>
    </div>
    <div class="box box50">
      <div class="box box50" style="margin-left: 20%;">
        <label class="label">
          <h5>Arquivo</h5>
          <input type="file" id="arquivos" name="documentosRH[]" class="extensao" multiple/>
              <!--<div id="addBtn">click</div>
              <input type="file" style="display:none" id="hiddenFile" multiple />
              <div id="imgBox"></div>-->
            </label>
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
        <center><h3>Documentos Existentes</h3></center>
      </div>
    </header>
    <div class="box box100">
      <div id="idarquivos" class="tabela-responsivel" style="height: 52.3%;">
        <table class="table table-bordered" >
          <thead>
           <th class="arquivos_existentes">Documentos</th>
           <th id="download" class="imagem">Download</th>
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