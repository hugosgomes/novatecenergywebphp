<?php
if (!$DashboardLogin || !$_SESSION['userLogin'] || ($Permissao['DIRETORIA'] == 0)):
    die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você não esta logado<br>ou não tem permissão para acessar essa página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
    $Read = new Read;
endif;

$Search = filter_input_array(INPUT_POST);

//GET DATES
$StartDate = (!empty($_SESSION['wc_report_date'][0]) ? $_SESSION['wc_report_date'][0] : date("Y-01-01"));//RECEBE DATA INICIAL
$EndDate = (!empty($_SESSION['wc_report_date'][1]) ? $_SESSION['wc_report_date'][1] : date("Y-12-31"));//RECEBE DATA FINAL

//DEFAULT REPORT
$DateStart = new DateTime($StartDate);
$DateEnd = new DateTime(date("Y-m-d", strtotime($EndDate . "+1day")));
$DateInt = new DateInterval("P22D");
$DateInterval = new DatePeriod($DateStart, $DateInt, $DateEnd);

?>

<style>
  table {
    font-family: arial, sans-serif;
    font-size: 14px;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    text-align: left;
    padding: 2px;
}

</style>

<header class="dashboard_header">
    
    <div class="dashboard_header_title">
        <p class="dashboard_header_breadcrumbs">
            &raquo;</span>
            <a title="Novatec Energy" href="dashboard.php?wc=home">Home</a>
            <span class="crumb">/</span>
            Estatisticas
        </p>
    </div>
</header>

<div class="dashboard_content">
    <article class="box box100">
        <div class="panel">
          <div class="listar-tecnicos">
            <input type="hidden" name="Callback" value="ReportTecnicos">
            <input type="hidden" name="Callback_action" value="listar-tecnicos">
          </div>
          <!-- Gráfico de técnicos -->
            <div class="wc_ead_chart_control" id="relatorio_tecnicos">
                <input type="hidden" name="callback" value="ReportTecnicos">
                <input type="hidden" name="callback_action" value="relatorio_padrao_tecnicos">
                <select id="j_ano_t" style="width: 110px;">
                  <!--SELECT INICIADO AO ABRIR A PÁGINA POR JQUERY-->
                  <option value="t">TODOS OS ANOS</option>
                </select>
                <select id="j_mes_t" style="width: 140px;" name="mes_t">     
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
                <select id="j_semana_s" style="width: 150px;">
                  <option value="t">TODAS AS SEMANAS</option>
                  <option value="t">1º SEMANA</option>
                  <option value="t">2º SEMANA</option>
                  <option value="t">3º SEMANA</option>
                  <option value="t">4º SEMANA</option>
                </select>
            </div>
            <div id="jwc_chart_container_tecnicos"></div>
            <?php
            $totalAtendimentos = 4;//$totalAtendimento;//atendimentos
            $viewViews = 200;
            $viewsPages = 200;
            ?>
                <div class="box box100 ">
                    <div class="box_content">
                      <table style="max-width: 450px;margin: auto;">
                        <tr>
                          <td><b>Atendimentos: 100</b></td>
                          <td><b>Aprovados: 81</b></td>
                          <td><b>Reprovados: 34</b></td>
                        </tr>
                      </table>
                    </div>
                </div>
            <div style="height:50px"></div>

            <!-- Gráfico de orçamentos -->
            <div class="box box33">
              <div class="wc_ead_chart_control">
            </div>
              <div id="jwc_chart_container_orcamentos"></div>
                <div class="box box100">
                    <div class="box_content">
                      <table style="max-width: 320px;margin: auto;">
                        <tr>
                          <td><b>Total: 100</b></td>
                          <td><b>Aprovados: 40</b></td>
                        </tr>
                        <tr>
                          <td><b>Recuperados: 10</b></td>
                          <td><b>Executados: 30</b></td>
                        </tr>
                        <tr>
                          <td><b>Recusados: 20</b></td>
                          <td></td>
                        </tr>
                      </table>
                    </div>
                </div>
            </div>

            <!-- Gráfico de orçamentos aprovados -->
            <div class="box box33">
              <div class="wc_ead_chart_control">
            </div>
              <div id="jwc_chart_container_orcamentos_aprovados"></div>
              <div class="box box100">
                  <div class="box_content">
                    <table style="max-width: 300px;margin: auto;">
                      <tr>
                        <td><b>Executados: 40</b></td>
                        <td><b>Agendados: 20</b></td>
                      </tr>
                      <tr>
                        <td><b>Recusados: 10</b></td>
                        <td></td>
                      </tr>
                    </table>
                  </div>
              </div>
            </div>

            <!-- Gráfico de clientes -->
            <div class="box box33">
            <div class="wc_ead_chart_control">
                
            </div>
              <div id="jwc_chart_container_clientes"></div>
                <div class="box box100">
                    <div class="box_content">
                      <table style="max-width: 450px;margin: auto;">
                        <tr>
                          <td><b>Total Clientes: 100</b></td>
                          <td><b>Atendidos: 30</b></td>
                        </tr>
                        <tr>
                          <td><b>Cancelados: 10</b></td>
                          <td><b>Ausentes: 20</b></td>
                        </tr>
                        <tr>
                          <td><b>Reagend. NVT: 20</b></td>
                          <td><b>Reagend. GNS: 10</b></td>
                        </tr>
                        <tr>
                          <td><b>Sem Atender: 10</b></td>
                        </tr>
                      </table>
                      
                    </div>
                </div>
            </div>

            <!-- Gráfico de serviços -->
            <div class="box box100">
              <div class="wc_ead_chart_control">
                
            </div>
              <div id="jwc_chart_container_servicos"></div>
               <div class="box box100">
                  <div class="box_content">
                    <table style="max-width: 500px;margin: auto;">
                      <tr>
                        <td><b>Total Serviços: 35</b></td>
                        <td><b>Serviços Realizados: 30</b></td>
                        <td><b>Serviços Faturados: 20</b></td>
                      </tr>
                    </table>
                  </div>
              </div>
            </div>

            <!-- Gráfico de serviços -->
            <div class="box box100">
              <div class="wc_ead_chart_control">
                
            </div>
              <div id="jwc_chart_container_servicos_s"></div>
            </div>
            <footer class="wc_ead_reports">
            </footer>
        </div>
    </article>
</div>

<?php
//TRÁS TODOS OS TÉCNICOS 
/*$TecnicoNome = array();
$TecnicoID = array();
$TecnicoTotal = array();
$Read->FullRead("SELECT [00_NivelAcesso].ID, CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END AS NOME
                FROM [00_NivelAcesso] LEFT JOIN Funcionários FUNC ON [00_NivelAcesso].IDFUNCIONARIO = FUNC.ID
                LEFT JOIN FuncionariosTerceirizados TERC ON [00_NivelAcesso].IDTERCEIRIZADO = TERC.ID
                WHERE MOBILE_GNS = 1 AND FUNC.[DATA DE DEMISSÃO] IS NULL ORDER BY NOME"," ");
                if ($Read->getResult()):
                  foreach ($Read->getResult() as $FUNC):
                   $TecnicoNome [] = $FUNC['NOME'];
                   $TecnicoID [] =  $FUNC['ID'];
                   $TecnicoQTD = count($TecnicoNome);
                  endforeach;
                endif;

//TRANSFORMA O ARRAY DE TÉCNICOS EM STRING
$NomeTecnico = implode("','",$TecnicoNome);

$getDayChart = array();
$getSupportChart = array();
$getResponseChart = array();
$Id = 0;
$f = 1;
foreach ($DateInterval as $setDayChart):
    $MesAtualI = date('Y-m-01');
   // $dataInicioMais1 = date('Y-m-d',strtotime($datainicio.'+'.$i++.' month'));
    $MesAtualF = date('Y-m-31');
   // $dataFimMais1 = date('Y-m-d',strtotime($dataFim.'+'.$f++.' month'));
    
    //GET DAYS
    $getDayChart[] = "'" . $setDayChart->format('m/Y') . "'";

    //GET DAY FOR READ
    $ReadDay = $setDayChart->format('Y-m');
    $Read->FullRead("SELECT count(Id) AS TOTAL from [BDNVT].[dbo].[60_Atendimentos] WHERE CONVERT(DATE, [DataAtendimento]) BETWEEN '{$MesAtualI}' AND '{$MesAtualF}' AND [idTecnico] = {$TecnicoID[$Id++]}");
     if($Read->getResult()){
        foreach ($Read->getResult() as $atendimentos) {
            extract($atendimentos);
            $totalAtendimento = $TOTAL;
        }
     }else{
        $totalAtendimento = 0;
     }
    //GET STATS
    $getAccessUsers[] = (200 ? 20 : 0);//TOTAL DE ORÇAMENTOS APROVADOS
    $getAtendimentos[] = ($totalAtendimento ? $totalAtendimento : 0);//TOTAL DE ATENDIMENTOS 
    $getAccessPages[] = (200 ? 60 : 0);//TOTAL DE ORÇAMENTOS REPROVADOS
endforeach;

$DaysChart = implode(", ", $getDayChart);
$AccessUsers = implode(", ", $getAccessUsers);
$AtendTec = implode(", ", $getAtendimentos);
$AccessPages = implode(", ", $getAccessPages);

unset($_SESSION['wc_report_date']);*/

?>

<script src="_js/relatorios_estatisticas_p.js"></script>
<script src="_js/report_gns.js"></script>
<script>
  $(document).ready(iniciaPagina('#j_ano_t','j_mes_t'));
  $(document).ready(iniciaPagina('#j_ano_o','j_mes_o'));
  $(document).ready(iniciaPagina('#j_ano_c','j_mes_c'));
  $(document).ready(iniciaPagina('#j_ano_s','j_mes_s'));

  //REQUISIÇÃO AJAX DEFAULT PARA TÉCNICOS
  $(document).ready(function(){
    //campoMes = $('#j_mes_t option:selected').val();
    callback = $('#relatorio_tecnicos').find('input[name="callback"]').val();
    callback_action = $('#relatorio_tecnicos').find('input[name="callback_action"]').val();

    $.ajax({
      url: '_ajax/gns/' + callback + '.ajax.php',
      type : 'post',
      data:{callback:callback,callback_action:callback_action,/*mes_t:campoMes*/}
    })

  })
</script>