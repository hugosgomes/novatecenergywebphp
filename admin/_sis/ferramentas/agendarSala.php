<?php
if (!$DashboardLogin || !$_SESSION['userLogin'] || ($Permissao['GNS'] == 0)):
    die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
    $Read = new Read;
endif;
$ID = 0;

?>


<header class="dashboard_header">
    <div class="dashboard_header_title">
        <p class="dashboard_header_breadcrumbs">
        &raquo;</span>
        <a title="Novatec Energy" href="dashboard.php?wc=home">Home</a>
        <span class="crumb">/</span>
        <a title="Novatec Energy" href="#">Ferramentas</a>
        <span class="crumb">/</span>
        Agendamento de Sala
    </p>
</div>
</header>
<div class="dashboard_content custom_app">
  <div class="box box100">
    <div class="box box100">
        <button class="btn btn_green" style="outline: none;"><span class="icon-plus"></span>Adicionar Reunião</button>
    </div>
    <div class="box_content">

    </div>
</div>
</div>

<script src="_js/ferramentas.js"></script>
