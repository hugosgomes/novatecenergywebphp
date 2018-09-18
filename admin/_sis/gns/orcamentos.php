<?php
if (!$DashboardLogin || !$_SESSION['userLogin'] || ($Permissao['GNS'] == 0)):
    die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
    $Read = new Read;
endif;

?>



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


<article class="box box100">
  <div class="box_content">
    <div class="box box50" style="padding-left: 13%;">
    <label >Ano</label>
    <select id="j_ano" style="font-family: Arial;font-size: 11px; width: 100px;">
    <!--SELECT INICIADO AO ABRIR A PÁGINA POR JQUERY-->
        <option value="t">Todos</option>
    </select>
    <label>Mês</label>
    <select id="j_mes" style="font-family: Arial;font-size: 11px; width: 110px;">
        <!--SELECT INICIADO AO ABRIR A PÁGINA POR JQUERY-->
        <option value="t" id="meses">Todos</option>
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
    <label style="font-family: Arial;font-size: 11px;">Todos</label>
    <select id="j_statusOrcamento" style="font-family: Arial;font-size: 11px; width: 110px;">
    <!--SELECT INICIADO AO ABRIR A PÁGINA POR JQUERY-->
        <option value="t">Todos</option>
    </select>
</div>
<div class="box box50">
    <label>Valor Aprovado</label>
    <input id="j_aprovado" class="" type="text" style="font-family: Arial;font-size: 11px; width: 100px;">
    <label>Valor Recusado</label>
    <input id="j_recusado" class="" type="text" style="font-family: Arial;font-size: 11px; width: 100px;">
    <label>Valor Executado</label>
    <input id="j_executado" class="" type="text" style="font-family: Arial;font-size: 11px; width: 100px;">
  </div>
</div>
</article>

<article class="box box70">
  <div class="box_content">
    <table id="dataTable"class="cell-border compact stripe table" callback="Orcamentos" callback_action="consulta">
        <thead>
          <tr>
            <th>Nº Cliente</th>
            <th>OS</th>
            <th>Endereço</th>
            <th>Tipo Serviço</th>
          </tr>
        </thead>
        <tbody>
          <tr><td colspan="4"><center>Nenhuma informação</center></td></tr>            
        </tbody>
  </table>
  </div>
</article> 

<article class="box box30">
  <div class="box_content">
    <center><h4>Informações Detalhadas</h4></center>
    <span>Data Entrada:</span><br>
    <span>Técnico Entrada:</span><br>
    <span>Data Execução:</span><br>
    <span>Técnico Execução:</span><br>
    <span>Status:</span><br>
  </div>
</article>  


<style type="text/css">
select, input{
    margin-right: 15px;
}
label, span{
  font-family: Arial;
  font-size: 11px;
}
</style>

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