<?php
if (!$DashboardLogin || !$_SESSION['userLogin'] || ($Permissao['CLIENTES_PARTICULARES'] == 0)):
  die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
  $Read = new Read;
endif;
?>
<style type="text/css">
  .panel_header{
     padding: 0px;
  padding-top: 12px;
}
</style>
<link rel="stylesheet" href="_css/clientes_particulares.css"/>
<header class="dashboard_header">
  <div class="dashboard_header_title">
    <p class="dashboard_header_breadcrumbs">
    &raquo;</span>
    <a title="Novatec Energy" href="dashboard.php?wc=home">Home</a>
    <span class="crumb">/</span>
    <a title="Novatec Energy" href="dashboard.php?wc=clientes/particulares">Clientes Particulares</a>
    <span class="crumb">/</span>
    <a title="Novatec Energy" href="dashboard.php?wc=clientes/estatisticas">Estatísticas</a>

  </p>
</div>
</header>