<?php
if (!$DashboardLogin || !$_SESSION['userLogin']):
    die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
    $Read = new Read;
endif;
?>
<header class="dashboard_header">
    <div class="dashboard_header_title">
    </div>
</header>

<div class="dashboard_content bgdashboard" align="center">
    <div class="box box50">
        <img class="dashboar_backgroud " alt="" title=""  style="width: 70%;" src="_img/dashboard.png "/>
    </div>
    <div class="clear"></div>
</div>

<script>
    //ICON REFRESH IN DASHBOARD
    /*$('#loopDashboard').click(function () {
        Dashboard();
    });

    //DASHBOARD REALTIME
    /*setInterval(function () {
        Dashboard();
    }, 10000);*/
    </script>