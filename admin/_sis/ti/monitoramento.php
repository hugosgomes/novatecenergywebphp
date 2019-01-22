<?php
if (!$DashboardLogin || !$_SESSION['userLogin'] || ($Permissao['DIRETORIA'] == 0)):
    die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
    $Read = new Read;
endif;

//TOTAL DE OS'S Siebel
$Read->FullRead("SELECT TOP(1) TotalOs AS QUANTIDADE  FROM [60_OS_Diaria] ORDER BY ID DESC", "");

$TotalS = $Read->getResult()[0]["QUANTIDADE"];

//TOTAL DE OS'S TRAZIDAS PELO ROBÔ
$Read->FullRead("SELECT DatePart(Week,GETDATE()) as SEMANA,
              NomeCliente, [60_OS].Id, [60_OS].[OSServico], [60_OS].NomeOs,[60_OS].NumOS, [60_OS].Status, [60_OS].DataAgendamento, [60_OS].ENDERECO,
              [60_OS].Tecnico, [60_OS].turno as TURNO,
              [60_OS].Latitude, [60_OS].Longitude FROM [60_Clientes]
              inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
              inner join [60_OS] on [60_OT].Id = [60_OS].OT
              WHERE [60_OS].DataAgendamento = CONVERT(DATE, GETDATE(), 103)"," ");

$TotalOs = count($Read->getResult());

//TOTAL DE OS'S VINCULADAS
$Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_OS] WHERE convert(varchar(10), DataAgendamento, 102) = convert(varchar(10), getdate(), 102) AND Tecnico <> 0", " ");

$TotalV = $Read->getResult()[0]["QUANTIDADE"];

//TOTAL DE OS'S ATENDIDAS
$Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_OS] WHERE STATUS <> 0 AND convert(varchar(10), DataAgendamento, 102) = convert(varchar(10), getdate(), 102) AND Tecnico <> 0"," ");

$TotalA = $Read->getResult()[0]["QUANTIDADE"];

//PORCENTAGEM
$porcento = $TotalV != 0 || $TotalA  ? ($TotalA * 100) / $TotalV : 0;
$percent = number_format($porcento,2);
$cor = $percent > 50 ? "green" : "red";

?>


<header class="dashboard_header">
    <div class="dashboard_header_title">
        <p class="dashboard_header_breadcrumbs">
            &raquo;</span>
            <a title="Novatec Energy" href="dashboard.php?wc=home">Home</a>
            <span class="crumb">/</span>
            Monitoramento
        </p>
    </div>
</header>

<div class="dashboard_content">

    <div class="box box50">
        <table class="monitoramento" style="font-size: 15px;" callback="Ti" callback-Action="monitoramento">
          <thead>
              <tr>
                  <th colspan="4" style="text-align: center">Monitoramento OS's GNS</th>
              </tr>
              <tr>
                <td><b>Total Siebel</b></td>
                <td style="text-align: center;"><?=$TotalS;?></td>
                <td rowspan="2" colspan="1"></td>
                <td rowspan="2" colspan="1"></td>
              </tr>
              <tr>
                <td><b>Total Robô</b></td>
                <td style="text-align: center;"><?=$TotalOs;?></td>
                
              </tr>
              <tr>
                <td><b>Total Vinculadas</b></td>
                <td style="text-align: center;"><?=$TotalV;?></td>
                <td rowspan="2" colspan="1" style="text-align: center;color:<?=$cor;?>"><?=$percent;?> %</td>
                <td rowspan="2" colspan="1"></td>
              </tr>
              <tr>
                <td><b>Total Atendidas</b></td>
                <td style="text-align: center;"><?=$TotalA;?></td>
                
              </tr>
              <tr>
                  <th style="text-align: center;">Técnicos</th>
                  <th style="text-align: center;">Vinculadas</th>
                  <th style="text-align: center;">Atendidas</th>
                  <th style="text-align: center;">% Atendidas</th>
              </tr>
          </thead>
          <tbody class="lista-tecn">
              <span class="lista-tec1"></span>
          </tbody>
      </table>
    </div>
    <div class="box box50">
      <table class="monitoramento">
        <thead>
          <tr>
            <th>Id orçamento</th>
            <th>data orçamento</th>
            <th>update</th>
          </tr>
        </thead>
        <tbody class="update_clientes">
          <tr>
          </tr>
        </tbody>
      </table>
    </div>

    
</div>

<script src="_js/ti.js"></script>

