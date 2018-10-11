<?php
if (!$DashboardLogin || !$_SESSION['userLogin'] || ($Permissao['DIRETORIA'] == 0)):
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
            Dashborad
        </p>
    </div>
</header>

<div class="dashboard_content">

    <div class="box box25">
        <div class="panel_header success">
            <span>
                <a href="javascript:void(0)" class="btn btn_green icon-loop icon-notext" id="loopDashboard"></a>
            </span>
            <h2 class="icon-earth">ONLINE AGORA:</h2>
        </div>
        <div class="panel dashboard_onlinenow">
            <?php
            echo "<p class='icon-users wc_useronline'>30</p>";
            ?>
            <a class="icon-target" href="dashboard.php?wc=onlinenow" title="Ver Usuários Online">ACOMPANHAR USUÁRIOS</a>
            <div class="clear"></div>
        </div>
    </div>

    <div class="box box25">
        <div class="panel_header info">
            <h2 class="icon-stats-dots">VISITAS HOJE:</h2>
        </div>
        <div class="panel dashboard_stats">
            <?php
                echo "<p class='wc_viewsusers'><b>10</b><span>Usuários</span></p>";
                echo "<p class='wc_viewsviews'><b>100</b><span>Visitas</span></p>";
                echo "<p class='wc_viewspages'><b>1000</b><span>Páginas</span></p>";
                echo "<h3 class='wc_viewsstats icon-shuffle'><b>50</b> Páginas por Visita</h3>";
            ?>
            <div class="clear"></div>
        </div>
    </div>

    <div class="box box25">
        <div class="panel_header alert">
            <h2 class="icon-stats-dots">VISITAS NO MÊS:</h2>
        </div>
        <div class="panel dashboard_stats">
            <?php
                echo "<p>20<span>Usuários</span></p>";
                echo "<p>30<span>Visitas</span></p>";
                echo "<p>50<span>Páginas</span></p>";
                echo "<h3 class='icon-shuffle'>30 Páginas por Visita</h3>";
            ?>
            <div class="clear"></div>
        </div>
    </div>

    <div class="box box25">
        <div class="panel_header warning">
            <h2 class="icon-stats-dots">VENDAS NO MÊS:</h2>
        </div>
        <div class="panel dashboard_stats">
            <?php

            echo "<p>100<span>Todos</span></p>";
            echo "<p>200<span>Aprovados</span></p>";
            echo "<p>3200<span>Cancelados</span></p>";
            echo "<h3 class='icon-coin-dollar'>R$ " . number_format(100, '2', ',', '.') . " em vendas</h3>";
            ?>
            <div class="clear"></div>
        </div>
    </div>
    
        <div class="box box100">
            <div class="panel_header alert">
                <h2 class="icon-search">ÚLTIMAS PESQUISAS (30 DIAS):</h2>
            </div>
            <div class="panel dashboard_search">
                <a class="dashboard_searchnowlink" href="dashboard.php?wc=searchnow" title="Ver Mais">MAIS PESQUISAS!</a>
                <div class="clear"></div>
            </div>
        </div>
</div>

<script>
    //ICON REFRESH IN DASHBOARD
    $('#loopDashboard').click(function () {
        Dashboard();
    });
</script>