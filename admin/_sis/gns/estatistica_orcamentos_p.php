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

<header class="dashboard_header">
    
    <div class="dashboard_header_title">
        <p class="dashboard_header_breadcrumbs">
            &raquo;</span>
            <a title="Novatec Energy" href="dashboard.php?wc=home">Home</a>
            <span class="crumb">/</span>
            Estatisticas Orçamentos
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
            <div class="wc_ead_chart_control">
                <input type="hidden" name="Callback" value="ReportTecnicos">
                <input type="hidden" name="Callback_action" value="dadosData">
                <select id="j_ano_t" style="width: 110px;">
                  <!--SELECT INICIADO AO ABRIR A PÁGINA POR JQUERY-->
                  <option value="t">TODOS OS ANOS</option>
                </select>
                <select id="j_mes_t" style="width: 140px;">     
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
            </div>
            <div id="jwc_chart_container_tecnicos"></div>
            <?php
            $totalAtendimentos = 4;//$totalAtendimento;//atendimentos
            $viewViews = 200;
            $viewsPages = 200;
            ?>
            <div class="wc_ead_reports_boxes">
                <div class="box box33 wc_ead_reports_total">
                    <div class="box_content">
                        <p class="icon-home">100</p>
                        <span>Atendimentos</span>
                    </div>
                </div>
                <div class="box box33 wc_ead_reports_total">
                    <div class="box_content">
                        <p class="icon-checkmark">81</p>
                        <span>Aprovados</span>
                    </div>
                </div>
                <div class="box box33 wc_ead_reports_total">
                    <div class="box_content">
                        <p class="icon-cancel-circle">34</p>
                        <span>Reprovados</span>
                    </div>
                </div>
            </div>
            <div style="height:50px"></div>

            <!-- Gráfico de orçamentos -->
            <div class="box box50">
              <div class="wc_ead_chart_control">
                <select id="j_ano_o" style="width: 110px;">
                  <!--SELECT INICIADO AO ABRIR A PÁGINA POR JQUERY-->
                  <option value="t">TODOS OS ANOS</option>
                </select>
                <select id="j_mes_o" style="width: 140px;">     
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
            </div>
              <div id="jwc_chart_container_orcamentos"></div>
              <div class="wc_ead_reports_boxes">
                  <div class="box box50 wc_ead_reports_total">
                      <div class="box_content">
                          <p class="icon-checkmark">40</p>
                          <span>Aprovados</span>
                      </div>
                  </div>
                  <div class="box box50 wc_ead_reports_total">
                      <div class="box_content">
                          <p class="icon-undo2">10</p>
                          <span>Recuperados</span>
                      </div>
                  </div>
                  <div class="box box50 wc_ead_reports_total">
                      <div class="box_content">
                          <p class=" icon-checkmark">30</p>
                          <span>Executados</span>
                      </div>
                  </div>
                  <div class="box box50 wc_ead_reports_total">
                      <div class="box_content">
                          <p class="icon-cancel-circle">20</p>
                          <span>Recusados</span>
                      </div>
                  </div>
              </div>
            </div>

            <!-- Gráfico de clientes -->
            <div class="box box50">
              <div class="wc_ead_chart_control">
                <select id="j_ano_c" style="width: 110px;">
                  <!--SELECT INICIADO AO ABRIR A PÁGINA POR JQUERY-->
                  <option value="t">TODOS OS ANOS</option>
                </select>
                <select id="j_mes_c" style="width: 140px;">     
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
            </div>
              <div id="jwc_chart_container_clientes"></div>
              <div class="wc_ead_reports_boxes">
                  <div class="box box33 wc_ead_reports_total">
                      <div class="box_content">
                          <p class="icon-checkmark">30</p>
                          <span>Atendidos</span>
                      </div>
                  </div>
                  <div class="box box33 wc_ead_reports_total">
                      <div class="box_content">
                          <p class="icon-cancel-circle">10</p>
                          <span>Cancelados</span>
                      </div>
                  </div>
                  <div class="box box33 wc_ead_reports_total">
                      <div class="box_content">
                          <p class="icon-undo2">20</p>
                          <span>Ausentes</span>
                      </div>
                  </div>
                  <div class="box box33 wc_ead_reports_total">
                      <div class="box_content">
                          <p class="icon-calendar">20</p>
                          <span>Reagendamento NVT</span>
                      </div>
                  </div>
                  <div class="box box33 wc_ead_reports_total">
                      <div class="box_content">
                          <p class="icon-calendar">10</p>
                          <span>Reagendamento GNS</span>
                      </div>
                  </div>
                  <div class="box box33 wc_ead_reports_total">
                      <div class="box_content">
                          <p class="icon-checkmark">10</p>
                          <span>Sem Atender</span>
                      </div>
                  </div>
              </div>
            </div>

            <!-- Gráfico de serviços -->
            <div class="box box100">
              <div class="wc_ead_chart_control">
                <select id="j_ano_s" style="width: 110px;">
                  <!--SELECT INICIADO AO ABRIR A PÁGINA POR JQUERY-->
                  <option value="t">TODOS OS ANOS</option>
                </select>
                <select id="j_mes_s" style="width: 140px;">     
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
            </div>
              <div id="jwc_chart_container_servicos"></div>
              <div class="wc_ead_reports_boxes">
                  <div class="box box50 wc_ead_reports_total">
                      <div class="box_content">
                          <p class="icon-checkmark">303</p>
                          <span>Serviços Realizados</span>
                      </div>
                  </div>
                  <div class="box box50 wc_ead_reports_total">
                      <div class="box_content">
                          <p class="icon-credit-card">255</p>
                          <span>Serviços Faturados</span>
                      </div>
                  </div>
              </div>
            </div>
            <footer class="wc_ead_reports">
            </footer>
        </div>
    </article>
</div>

<?php
//TRÁS TODOS OS TÉCNICOS 
$TecnicoNome = array();
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

unset($_SESSION['wc_report_date']);

?>

<script src="_js/relatorios_estatisticas_p.js"></script>
<script src="_js/report_gns.js"></script>
<script>
  $(document).ready(iniciaPagina('#j_ano_t','j_mes_t'));
  $(document).ready(iniciaPagina('#j_ano_o','j_mes_o'));
  $(document).ready(iniciaPagina('#j_ano_c','j_mes_c'));
  $(document).ready(iniciaPagina('#j_ano_s','j_mes_s'));
</script>