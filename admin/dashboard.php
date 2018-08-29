<?php
ob_start();
session_start();
require '../_app/Config.inc.php';

if (isset($_SESSION['userLogin'])):
    $Admin = $_SESSION['userLogin'];
$DashboardLogin = true;
$Read = new Read;
$Read->FullRead("SELECT [NOME COMPLETO] FROM [Funcionários] WHERE [ID] = :id", "id={$_SESSION['userLogin']['ID']}");
$NOME = $Read->getResult()[0];
else:
    unset($_SESSION['userLogin']);
header('Location: ./index.php');
exit;
endif;

//SCRIPT DE LOGOFF
$AdminLogOff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);
if ($AdminLogOff):
    $_SESSION['trigger_login'] = Erro("<b>LOGOFF</b> realizado com sucesso!");
unset($_SESSION['userLogin']);
header('Location: ./index.php');
exit;
endif;

$getViewInput = filter_input(INPUT_GET, 'wc', FILTER_DEFAULT);
$getView = ($getViewInput == 'home' ? 'home' . ADMIN_MODE : $getViewInput);

//PARA SUA SEGURANÇA, NÃO REMOVA ESSA VALIDAÇÃO!
if (!file_exists("dashboard.json")):
    echo "<span class='wc_domain_license icon-key icon-notext wc_tooltip radius'></span>";
endif;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novatec Energy - Sistema Interno</title>
    <meta name="description" content="Sistema Interno"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
    <meta name="robots" content="noindex, nofollow"/>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Source+Code+Pro:300,500' rel='stylesheet' type='text/css'>
    <link rel="base" href="<?= BASE; ?>/admin/">
    <link rel="shortcut icon" href="_img/favicon.png" />

    <link rel="stylesheet" href="../_cdn/datepicker/datepicker.min.css"/>
    <link rel="stylesheet" href="_css/reset.css"/>        
    <link rel="stylesheet" href="_css/workcontrol.css"/>
    <link rel="stylesheet" href="_css/workcontrol-860.css" media="screen and (max-width: 860px)"/>
    <link rel="stylesheet" href="_css/workcontrol-480.css" media="screen and (max-width: 480px)"/>
    <link rel="stylesheet" href="../_cdn/bootcss/fonticon.css"/>

    <script src="../_cdn/jquery.js"></script>
    <script src="../_cdn/jquery.form.js"></script>
    <script src="_js/workcontrol.js"></script>

    <script src="_js/tinymce/tinymce.min.js"></script>
    <script src="_js/maskinput.js"></script>
    <script src="_js/workplugins.js"></script>

    <script src="../_cdn/highcharts.js"></script>
    <script src="../_cdn/datepicker/datepicker.min.js"></script>
    <script src="../_cdn/datepicker/datepicker.pt-BR.js"></script>

    <!--Chamada do datatable-->
    <link href='https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
    <link href='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js' rel='javascript' type='text/css'>
    <script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>



</head>
<body class="dashboard_main">
    <div class="workcontrol_upload workcontrol_loadmodal">
        <div class="workcontrol_upload_bar">
            <img class="m_botton" width="50" src="_img/load_w.gif" alt="Processando requisição!" title="Processando requisição!"/>
            <p><span class="workcontrol_upload_progrees">0%</span> - Processando requisição!</p>
        </div>
    </div>

    <div class="dashboard_fix">
        <?php
        if (isset($_SESSION['trigger_controll'])):
            echo "<div class='trigger_modal' style='display: block'>";
        Erro("<span class='icon-warning'>{$_SESSION['trigger_controll']}</span>", E_USER_ERROR);
        echo "</div>";
        unset($_SESSION['trigger_controll']);

        endif;
        ?>

        <nav class="dashboard_nav">
            <div class="dashboard_nav_admin">
                <div class="box box60">
                    <img class="dashboard_nav_admin_thumb" alt="" title="" src="_img/logo.png "/>
                </div>
            </div>

            <ul class="dashboard_nav_menu">
                <li class="dashboard_nav_menu_li <?= $getViewInput == 'home' ? 'dashboard_nav_menu_active' : ''; ?>"><a class="icon-home" title="Dashboard" href="dashboard.php?wc=home">Home</a></li>

                <?php

                    //MODULO GNS
                if ($_SESSION['userLogin']):
                    ?>
                <li class="dashboard_nav_menu_li <?= strstr($getViewInput, 'gns/') ? 'dashboard_nav_menu_active' : ''; ?>"><a class="icon-hammer" title="GNS" href="#">GNS</a>
                    <ul class="dashboard_nav_menu_sub">
                        <li class="dashboard_nav_menu_sub_li <?= $getViewInput == 'gns/agendamentos' ? 'dashboard_nav_menu_active' : ''; ?>"><a title="Destaques ativos" href="dashboard.php?wc=gns/agendamentos">&raquo; Agendamentos</a></li>
                                <li class="dashboard_nav_menu_sub_li <?= $getViewInput == 'gns/monitoramento' ? 'dashboard_nav_menu_active' : ''; ?>"><a title="Destaques ativos" href="dashboard.php?wc=gns/monitoramento">&raquo; Monitoramento</a></li>
                                <!--<li class="dashboard_nav_menu_sub_li <?= $getViewInput == 'gns/home' ? 'dashboard_nav_menu_active' : ''; ?>"><a title="Destaques ativos" href="dashboard.php?wc=gns/home">&raquo; Lista de OS's</a></li>-->
                            </ul>
                        </li>
                        <?php
                        endif;

                    //MENU DE USUÁRIOS
                    /*if (APP_USERS && $_SESSION['userLogin']['user_level'] >= LEVEL_WC_USERS):
                        ?>
                        <li class="dashboard_nav_menu_li <?= strstr($getViewInput, 'users/') ? 'dashboard_nav_menu_active' : ''; ?>"><a class="icon-users" title="Usuários" href="dashboard.php?wc=users/home">Usuários</a>
                            <ul class="dashboard_nav_menu_sub">
                                <li class="dashboard_nav_menu_sub_li <?= $getViewInput == 'users/home' ? 'dashboard_nav_menu_active' : ''; ?>"><a title="Ver Usuários" href="dashboard.php?wc=users/home">&raquo; Ver Usuários</a></li>
                                <li class="dashboard_nav_menu_sub_li <?= strstr($getViewInput, 'users/home&opt=customers') ? 'dashboard_nav_menu_active' : ''; ?>"><a title="Clientes" href="dashboard.php?wc=users/home&opt=customers">&raquo; Clientes</a></li>
                                <li class="dashboard_nav_menu_sub_li <?= strstr($getViewInput, 'users/home&opt=team') ? 'dashboard_nav_menu_active' : ''; ?>"><a title="Equipe" href="dashboard.php?wc=users/home&opt=team">&raquo; Equipe</a></li>
                                <li class="dashboard_nav_menu_sub_li <?= $getViewInput == 'users/create' ? 'dashboard_nav_menu_active' : ''; ?>"><a title="Novo Usuário" href="dashboard.php?wc=users/create">&raquo; Novo Usuário</a></li>
                            </ul>
                        </li>
                        <?php
                        endif;*/

                    //MENU DE RELATÓRIOS
                    /*if ($_SESSION['userLogin'] >= LEVEL_WC_REPORTS):
                        ?>
                        <li class="dashboard_nav_menu_li <?= strstr($getViewInput, 'report') ? 'dashboard_nav_menu_active' : ''; ?>"><a class="icon-pie-chart" title="Relatório" href="dashboard.php?wc=reports/home">Relatórios</a>
                            <ul class="dashboard_nav_menu_sub top">
                                <li class="dashboard_nav_menu_sub_li <?= $getViewInput == 'reports/home' ? 'dashboard_nav_menu_active' : ''; ?>"><a title="Relatório de Acessos" href="dashboard.php?wc=reports/home">&raquo; Acessos</a></li>
                                <?php if (APP_EAD): ?>
                                    <li class="dashboard_nav_menu_sub_li <?= $getViewInput == 'teach/report_students' ? 'dashboard_nav_menu_active' : ''; ?>"><a title="Relatório de Alunos" href="dashboard.php?wc=teach/report_students">&raquo; Alunos</a></li>
                                    <li class="dashboard_nav_menu_sub_li <?= $getViewInput == 'teach/report_support' ? 'dashboard_nav_menu_active' : ''; ?>"><a title="Relatório de Suporte" href="dashboard.php?wc=teach/report_support">&raquo; Suporte</a></li>
                                    <li class="dashboard_nav_menu_sub_li <?= $getViewInput == 'teach/report_sales' ? 'dashboard_nav_menu_active' : ''; ?>"><a title="Relatório de Vendas" href="dashboard.php?wc=teach/report_sales">&raquo; Vendas</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php
                        endif;*/
                        ?>
                    </ul>
                    <div class="dashboard_nav_normalize"></div>        
                </nav>

                <div class="dashboard">
                    <?php

                    if (!file_exists("../license.txt")):
                        echo "<div>";
                    echo Erro("<span class='al_center'><b class='icon-warning'>ATENÇÃO:</b> O license.txt não está presente na raiz do projeto. Utilizar o Work Control® sem esse arquivo caracteriza cópia não licenciada.", E_USER_ERROR);
                    echo "</div>";
                    endif;

                    if (ADMIN_MAINTENANCE):
                        echo "<div>";
                    echo Erro("<span class='al_center'><b class='icon-warning'>IMPORTANTE:</b> O modo de manutenção está ativo. Somente usuários administradores podem ver o site assim!</span>", E_USER_ERROR);
                    echo "</div>";
                    endif;

                //PHP TEST
                    $PHPVersion = phpversion();
                    if ($PHPVersion < '5.6'):
                        echo "<div>";
                    echo Erro('<span class="al_center"><b class="icon-warning">ATENÇÃO:</b> O Work Control® foi projetado com <b>PHP 5.6 ou superior</b>, a versão do seu PHP é ' . $PHPVersion . '!</span>', E_USER_ERROR);
                    echo "</div>";

                    endif;
                    ?>
                    <div class="dashboard_sidebar">
                        <span class="mobile_menu btn btn_darkblue icon-menu icon-notext"></span>
                        <div class="fl_right">
                            <span class="dashboard_sidebar_welcome m_right"><?= "Olá ". strstr($NOME['NOME COMPLETO'], ' ', true). ", hoje ".date('d/m/y'); ?></span>
                            <a class="icon-exit btn btn_darkblue" title="Desconectar do <?= ADMIN_NAME; ?>!" href="dashboard.php?wc=home&logoff=true">Sair</a>
                        </div>
                    </div>

                    <?php
                //QUERY STRING
                    if (!empty($getView)):
                        $includepatch = __DIR__ . '/_sis/' . strip_tags(trim($getView)) . '.php';
                    else:
                        $includepatch = __DIR__ . '/_sis/' . 'dashboard.php';
                    endif;

                    if (file_exists(__DIR__ . "/_siswc/" . strip_tags(trim($getView)) . '.php')):
                        require_once __DIR__ . "/_siswc/" . strip_tags(trim($getView)) . '.php';
                    elseif (file_exists($includepatch)):
                        require_once($includepatch);
                    else:
                        $_SESSION['trigger_controll'] = "<b>OPPSSS:</b> <span class='fontred'>_sis/{$getView}.php</span> ainda está em contrução!";
                    header('Location: dashboard.php?wc=home');
                    exit;
                    endif;
                    ?>
                </div>
            </div>
        </body>
        </html>
        <?php
        ob_end_flush();