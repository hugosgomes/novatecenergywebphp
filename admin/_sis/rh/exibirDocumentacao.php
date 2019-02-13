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

<header class="dashboard_header">
	<div class="dashboard_header_title">
		<p class="dashboard_header_breadcrumbs">
			&raquo; Home
			<span class="crumb">/</span>
			<a title="<?= ADMIN_NAME; ?>" href="dashboard.php?wc=users/home">Dashboard</a>
		</p>
	</div>
</header>

<div class="dashboard_content">

	<div class="box box33">
		<div class="panel_header warning">
			<h2 class="icon-cross">FUNCIONÁRIOS COM DOCUMENTOS VENCIDOS:</h2>
		</div>

		<div id="painel" class="panel dashboard_onlinenow">
			<div id="painel1">
			</div>
			<!--<center><a class="icon-link link btn" href="#ex1" rel="modal:open" id="1" title="Editar Funcionários" style="width: 16%;">EDITAR</a> </center>-->
			<div class="clear"></div>
		</div>
	</div>

	<div class="box box33">
		<div class="panel_header alert">
			<h2 class="icon-warning">FUNCIONÁRIOS COM DOCUMENTOS A EXPIRAR:</h2>
		</div>
		<div class="panel dashboard_onlinenow">
			<div id="painel2">

			</div>
			<!--<center><a class="icon-link link btn" href="#ex2" rel="modal:open" id="2" title="Editar Funcionários" style="width: 16%;">EDITAR</a> </center>-->
			<div class="clear"></div>
		</div>
	</div>

	<div class="box box33">
		<div class="panel_header" style="background: #1a4a7b; border-top: 5px solid #1a4a7b; border-bottom: 4px solid #a7a299; color: #FFF; padding: 15px;">
			<h3 class="icon-question" style="font-size: 13; color: white;">FUNCIONÁRIOS COM DOCUMENTOS PENDENTES:</h3>
		</div>
		<div class="panel dashboard_onlinenow">
			<div id="painel3">

			</div>
			<!--<center><a class="icon-link link btn" href="#ex3" rel="modal:open" id="3" title="Editar Funcionários" style="width: 20%;">VISUALIZAR</a> </center>-->
			<div class="clear"></div>
		</div>
	</div>
</div>
<div class="box box100">
	<div class="box box33"></div>
	<center>
		<div class="box box33">  
			<form method="get" class="valores">
				<p class="pegarvalor"><input type="text" name="pegarvalor" style="display: none;" /></p>
			</form>
		</div>
	</center>
	<div class="box box33"></div>
	
</div>
<div class="box box100">
	<div class="box box33"></div>
	<div class="box box33">
		<div class="panel_header" style="background: #1a4a7b; border-top: 5px solid #1a4a7b; border-bottom: 4px solid #ad00f5; color: #FFF; padding: 15px;">
			<center><h3 class="icon-info" style="font-size: 13; color: white;">LOG's</h3></center>
		</div>
		<div class="panel dashboard_onlinenow">
			<div id="painel_log">
			</div>
			<!--<center><a class="icon-link link btn" href="#ex3" rel="modal:open" id="3" title="Editar Funcionários" style="width: 20%;">VISUALIZAR</a> </center>-->
			<div class="clear"></div>
		</div>
	</div>
	<div class="box box33"></div>
</div>


<!--------------------------------------------------------------------- MODAL ---------------------------------------------------------------->
<!--------------------------------------------------------------------- MODAL ---------------------------------------------------------------->
<!--------------------------------------------------------------------- MODAL ---------------------------------------------------------------->
<!--------------------------------------------------------------------- MODAL ---------------------------------------------------------------->



<div id="ex1" class="modal" style="height: auto; max-width: 50%;">
	<div class="panel_header" style=" border-bottom: 1px solid #04182e;
	border-width: 2px; padding-top: 0px;">
	<h2 class="icon-user" style="text-align: center;font-size: 15px;"><b>FUNCIONÁRIOS COM DOCUMENTOS VENCIDOS</b></h2>
</div>
<div class="box box100" style="padding: 0px;">
	<div id="j_documentos_vencidos">
		<div class="documentos_vencidos">
			<hr>
		</div>
	</div>
</div><!-- BOX 100 -->
</div>


<div id="ex2" class="modal" style="height: auto; max-width: 50%;">
	<div class="panel_header" style=" border-bottom: 1px solid #04182e;
	border-width: 2px; padding-top: 0px;">
	<h2 class="icon-user" style="text-align: center;font-size: 15px;"><b>FUNCIONÁRIOS COM DOCUMENTOS A EXPIRAR</b></h2>
</div>
<div class="box box100" style="padding: 0px;">
	<div id="j_documentos_exp">
		<div class="documentos_exp">
			<hr>
		</div>
	</div>
</div><!-- BOX 100 -->
</div>



<div id="ex3" class="modal" style="height: auto; max-width: 50%;">
	<div class="panel_header" style=" border-bottom: 1px solid #04182e;
	border-width: 2px; padding-top: 0px;">
	<h2 class="icon-user" style="text-align: center;font-size: 15px;"><b>FUNCIONÁRIOS COM DOCUMENTOS PENDENTES</b></h2>
</div>
<div class="box box100" style="padding: 0px;">
	<div id="j_documentos_pendentes">
		<div class="documentos_pendentes">
			<hr>
		</div>
	</div>
</div><!-- BOX 100 -->
</div>



<div id="log" class="modal" style="height: auto; max-width: 50%;">
	<div class="panel_header" style=" border-bottom: 1px solid #04182e;
	border-width: 2px; padding-top: 0px;">
	<h2 class="icon-bubbles2" style="text-align: center;font-size: 15px;"><b>LOG's de ERRO (Robô)</b></h2>
</div>
<div class="box box100" style="padding: 0px;">
	<div id="j_documentos_log">
		<div class="documentos_log">
			<hr>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Funcionário</th>
						<th>Documento</th>
						<th>Erro</th>
						<th>Data</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody id="j_table_DocumentosLog">
				</tbody>
			</table>
		</div>
	</div>
</div><!-- BOX 100 -->
</div>
<script src="_js/dashboardRh.js"></script>