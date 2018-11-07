<?php
if (!$DashboardLogin || !$_SESSION['userLogin'] || ($Permissao['TI'] == 0)):
	die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;
?>
<header class="dashboard_header">
	<div class="dashboard_header_title">
		<p class="dashboard_header_breadcrumbs">
			&raquo; <?= ADMIN_NAME; ?>
			<span class="crumb">/</span>
			<a title="<?= ADMIN_NAME; ?>" href="dashboard.php?wc=gns/historico">Histórico de Clientes</a>
			<span class="crumb">/</span>
			Orçamento
		</p>
	</div>
</header>

<!-- CODIGO ADD LINHAS -->
<div class="dashboard_content custom_app">
	<div class="box box100">
		<div class="box_content">
			<span class="btn btn_darkblue" onclick="Importar(this)">Importação de Lote</span>&ensp;
			<span class="btn btn_darkblue" onclick="Importar(this)">Importação de Visitas</span>&ensp;
			<span class="btn btn_darkblue" onclick="Importar(this)">Importação de Lotes Fechados</span>
		</div>
	</div>
</div>
<script type="text/javascript">
<<<<<<< HEAD
    
function Importar(obj){
	var text = $(obj).text();
    $.post('_sis/ti/proceduresrobo.php', {text}, function (data) {

    //FAZ EXIBIR A MENSAGEM DE RETORNO DO AJAX
    if(data.Trigger){
    	Trigger(data.trigger);
    }

    }, 'json');
	}

</script>