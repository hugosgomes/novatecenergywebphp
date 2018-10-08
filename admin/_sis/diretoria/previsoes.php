<?php
if (!$DashboardLogin || !$_SESSION['userLogin'] || ($Permissao['DIRETORIA'] == 0)):
    die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;
?>



<header class="dashboard_header">
    <div class="dashboard_header_title">
        <p class="dashboard_header_breadcrumbs">
            &raquo;</span>
            <a title="Novatec Energy" href="dashboard.php?wc=home">Home</a>
            <span class="crumb">/</span>
            Previsões
        </p>
    </div>
</header>
<div class="dashboard_content custom_app">
	<div class="box box100">
<div id="dataPage" callback="Previsoes" callback_action="consulta"></div>

<select id="j_ano" style="width: 200px;">
  <!--SELECT INICIADO AO ABRIR A PÁGINA POR JQUERY-->
  <option value="t">TODOS OS ANOS</option>
</select>


<!--SELECT INICIADO AO ABRIR A PÁGINA POR JQUERY-->
<select id="j_mes" style="width: 200px;">     
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

<br>

<article class="box box33">
	<div class="box_content" style="border-top: 5px solid #1a4a7b; border-bottom: 5px solid #1a4a7b;">
		<table class="cell-border compact stripe table" style="height: 135;">
			<thead>
				<tr><th colspan="4"><center><h2>Sem Certificar</h2></center></th></tr>
				<tr>
					<th style="width: 200px;"><center>Rede</center></th>
					<th style="width: 200px;"><center>Adesão</center></th>
				</tr>
			</thead>
			<tbody  id = "dataTable_sem_certificar">

			</tbody>
		</table>
		<center>
		<img class="spinner" style="margin-left: 10px; margin-top: 2px; block-size: 10%;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load_spinner.gif"/></center>
	</div>
</article>

<article class="box box33">
	<div class="box_content" style="border-top: 5px solid #1a4a7b; border-bottom: 5px solid #1a4a7b;">
		<table class="cell-border compact stripe table" callback="Orcamentos" callback_action="consulta">
			<thead>
				<tr><th colspan="4"><center><h2>Faturamento (Valores do Mês)</h2></center></th></tr>
				<tr>
					<th><center></center></th>
					<th><center>Rede</center></th>
					<th><center>Adesão</center></th>
				</tr>
			</thead>
			<tbody  id = "j_faturamento">
				
			</tbody>
		</table>
		<center>
		<img class="spinner" style="margin-left: 10px; margin-top: 2px; block-size: 10%;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load_spinner.gif"/></center>
	</div>
</article>	


<article class="box box33">
	<div class="box_content" style="border-top: 5px solid #1a4a7b; border-bottom: 5px solid #1a4a7b;">
		<table class="cell-border compact stripe table"  style="height: 135;">
			<thead>
				<tr><th colspan="4"><center><h2>Em Aberto (Todos os Meses)</h2></center></th></tr>
				<tr>
					<th><center>Rede</center></th>
					<th><center>Adesão</center></th>
				</tr>
			</thead>
			<tbody id = "j_previsao">
				
			</tbody>
		</table>
		<center>
		<img class="spinner" style="margin-left: 10px; margin-top: 2px; block-size: 10%;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load_spinner.gif"/></center>
	</div>
</article>	
</div>
</div>

<script src="_js/diretoria.js"></script>
<script>$(document).ready(iniciaPagina);</script>