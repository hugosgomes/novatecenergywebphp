<?php
if (!$DashboardLogin || !$_SESSION['userLogin'] || ($Permissao['GNS'] == 0)):
  die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
  $Read = new Read;
endif;

?>
<style type="text/css">
.pecasServicos th{
  padding: 8px;
  font-size: 15px;
}
.linha:nth-child(even) {
    background-color:  #c0c0c02e;
}
.linha td{
  padding:5px;
}
</style>

<header class="dashboard_header">
  <div class="dashboard_header_title">
    <p class="dashboard_header_breadcrumbs">
    &raquo;</span>
    <a title="Novatec Energy" href="dashboard.php?wc=home">Home</a>
    <span class="crumb">/</span>
    Orçamentos
  </p>
</div>
</header>
<div class="dashboard_content custom_app">
<article class="box box100">
  <div style="padding-bottom: 0px; padding-top: 0px;" class="box_content">
    <div class="box box50">
      <div class="label_33">
        <label class="label">Ano
          <select id="j_ano">
            <!--SELECT INICIADO AO ABRIR A PÁGINA POR JQUERY-->
            <option value="t">TODOS OS ANOS</option>
          </select>
        </label>
        <label class="label">Mês
          <select id="j_mes">
            <!--SELECT INICIADO AO ABRIR A PÁGINA POR JQUERY-->
            <option value="t" id="meses">TODOS OS MESES</option>
            <option value="01" id="meses">JANEIRO</option>
            <option value="02" id="meses">FEVEREIRO</option>
            <option value="03" id="meses">MARÇO</option>
            <option value="04" id="meses">ABRIL</option>
            <option value="05" id="meses">MAIO</option>
            <option value="06" id="meses">JUNHO</option>
            <option value="07" id="meses">JULHO</option>
            <option value="08" id="meses">AGOSTO</option>
            <option value="09" id="meses">SETEMBRO</option>
            <option value="10" id="meses">OUTUBRO</option>
            <option value="11" id="meses">NOVEMBRO</option>
            <option value="12" id="meses">DEZEMBRO</option>
          </select>
        </label>
        <label class="label">Status
          <select id="j_statusOrcamento">
            <!--SELECT INICIADO AO ABRIR A PÁGINA POR JQUERY-->
            <option value="t">TODOS OS STATUS</option>
          </select>
        </label>
      </div>
    </div>
    <div class="box box50">
      <div class="label_33">
        <label class="label">Valor Aprovado
          <input id="j_aprovado" class="">
        </label>
        <label class="label">Valor Recusado
          <input id="j_recusado" class="" type="text">
        </label>
        <label class="label">Valor Executado
          <input id="j_executado" class="" type="text">
        </label>
      </div>
    </div>
  </div>
</article>

<article class="box box70">
  <div class="box_content">
   <div class="tabela-responsivel">
    <table id="dataTable"class="cell-border compact stripe table" callback="Orcamentos" callback_action="consulta">
      <thead>
        <tr>
          <th>Nº Cliente</th>
          <th>OS</th>
          <th>Endereço</th>
          <th>Tipo Serviço</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr><td colspan="4"><center>Nenhuma informação</center></td></tr>
      </tbody>
    </table>
  </div>
</div>
</article> 

<article class="box box30">
  <div class="box_content" style="height: 659px;">
    <center><h4>Informações Detalhadas</h4></center>
    <br>
    <ul class="j_detalhes" id="detalhes">
      <li><center><a id="j_btn_editar" class="btn btn_darkblue icon-share" style="display:none">Editar</a></center></li>
      <br>
      <li><span>Data Entrada: </span></li>
      <li><span>Técnico Entrada: </span></li>
      <li><span>Data Execução: </span></li>
      <li><span>Técnico Execução: </span></li>
      <li><span>Status: </span></li>
      <li id='itens'></li>
      <!--<li><span>Valor: </span></li>-->

    </ul>
      <div class="box box100">
        <table id="tabelaPecasServicos" class="table" style="text-align: center;">
          <thead>
           <tr>
            <td colspan="4" style="height: 40px;"><b>Tabela de Peças e Serviços</b></td>
          </tr>
          <tr class="pecasServicos">    
            <th>Peça / Serviço</th>
            <th>Qtd</th>
            <th>Valor</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody id="j_AddPecasServicos" style="font-size: 11px;">

        </tbody>
      </table>
    </div>
    <div class="box box100">
        <table id="tabelaOrcamento" class="table" style="text-align: center;">
          <thead>
          <tr class="orcamentos">    
            <th>Nº Parcelas</th>
            <th>Valor Parcelas</th>
            <th>Total Orçamento</th>
          </tr>
        </thead>
        <tbody id="j_Orcamentos" style="font-size: 11px;">

        </tbody>
      </table>
    </div>
</div>
</article>
</div>

<!--CÓDIGO DO MODAL-->
<div id="j_modal" class="modal" style="height: auto;">
  <h3 style="text-align: center;">EDIÇÃO DE CLIENTES</h3>
  <hr style="height: 4px; background-color: black;">
  
  <br>
  <?php
    $Read->FullRead("SELECT [ID],[EMPRESA],[DATA DE ADMISSÃO] FROM [Funcionários] WHERE [ID] = :id", "id={$_SESSION['userLogin']['ID']}");
    $NOME = $Read->getResult()[0];
  ?>
  <form id="j_form" method="post">
    <input id="j_id" type="hidden" name="ID" value="0" />
    <input id="j_idCliente" type="hidden" name="Idcliente" value="0"/>
    <input id="j_usuario_sis" type="hidden" name="usuario" value="<?php echo $NOME['ID'] ?>"/>
    <input type="hidden" name="callback" value="Orcamentos" />
    <input type="hidden" name="callback_action" value="atualizar" />
    <div class="label_50">

      <label class="label" style="width: 26%;">
        <span>Data Realiz.:</span>
        <p id="j_dataEntrada" type="text" placeholder="" class="jwc_datepicker" name="DataEnt" /></p>
      </label>

      <label class="label" style="width:72%;">
        <span>Técnico Realiz.: </span>
        <select id="j_tecnicoEntrada" class="" name="TecnicoEnt" required disabled="readonly"/>
          <option value = "t">SELECIONE UM TÉCNICO</option>
        </select>
      </label>
      <label class="label" style="width: 26%;">
        <span>Data Agend.:</span>
        <input id="j_dataAgend" type="text" placeholder="" class="jwc_datepicker" name="DataAgendamento" required/>
      </label>

      <label class="label" style="width:72%">
        <span>Status: </span>
        <select id="j_status" class="" name="Status" required style="margin-bottom: 5%;" />
        <option value = "t">SELECIONE UM STATUS</option>
        </select>
      </label>
        
    <label class="label" style="width:100%;">
        <span>OBS: </span>
        <input id="j_obs" class="" name="Obs" required style="margin-bottom: 5%;"/>
    </label>
    <br>

<hr style="height: 4px;background-color: black;width:100%">

<center><a id="j_btn_salvar" class="btn btn_darkblue icon-share" style="width: 104px;">Salvar</a>&ensp;<a id="j_btn_cancelar" class="btn btn_red icon-cancel-circle" >Cancelar</a></center>
</div>
</form>    
</div>

<!--FIM DO CÓDIGO DO MODAL-->


<script src="_js/gns.js"></script>
<script>$(document).ready(iniciaPagina);</script>
<script>
  $('#dataTable').DataTable({
    paging: true,
    compact: true,
    hover: true,
    searching: true,
    info: false
  });
</script>

<style type="text/css">

.blocker{
  z-index: 98;
}

.j_detalhes span{  
  padding-top: 10px;
  font-weight: bold;
}

.btn{
  margin-top: 12;
}

#j_tecnicoEntrada{
  border:none;
  color:#000;
  cursor:default;
  background-image:none;
  
}

#j_dataEntrada{
  margin-top: 5px;
}
</style>