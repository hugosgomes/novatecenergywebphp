<?php
$AdminLevel = LEVEL_WC_USERS;
if (!$DashboardLogin):
    die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
    $Read = new Read;
endif;

?>

<header class="dashboard_header">
    <div class="dashboard_header_title">
        <h1 class="icon-hammer">Clientes Particulares</h1>
        <p class="dashboard_header_breadcrumbs">
            &raquo;</span>
            <a title="Novatec Energy" href="dashboard.php?wc=home">Home</a>
            <span class="crumb">/</span>
            <a title="Novatec Energy" href="dashboard.php?wc=clientes/particulares">Clientes Particulares</a>
           
        </p>
    </div>
</header>

