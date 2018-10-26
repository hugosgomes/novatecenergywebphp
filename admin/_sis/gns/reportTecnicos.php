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
            <a title="Novatec Energy" href="dashboard.php?wc=gns">GNS</a>
            <span class="crumb">/</span>
            Statisticas Técnicos
        </p>
    </div>
</header>

<div class="dashboard_content">
    <article class="box box100">
        <div class="panel">
            <div class="wc_ead_chart_control">
                <select id="j_ano" style="width: 200px;">
                  <!--SELECT INICIADO AO ABRIR A PÁGINA POR JQUERY-->
                  <option value="t">TODOS OS ANOS</option>
                </select>
                <select id="j_mes" style="width: 200px;">     
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
            <div id="jwc_chart_container"></div>
            
            <?php
            $totalAtendimentos = 4;//$totalAtendimento;//atendimentos
            $viewViews = 100;
            $viewsPages = 100;
            ?>
            <div class="wc_ead_reports_boxes">
                <div class="box box33 wc_ead_reports_total">
                    <div class="box_content">
                        <p class="icon-users"><?= str_pad($totalAtendimentos, 3, 0, 0); ?></p>
                        <span>Atendimentos</span>
                    </div>
                </div><div class="box box33 wc_ead_reports_total">
                    <div class="box_content">
                        <p class="icon-stats-dots">300</p>
                        <span>Orçamentos Aprovados</span>
                    </div>
                </div><div class="box box33 wc_ead_reports_total">
                    <div class="box_content">
                        <p class="icon-pie-chart">200</p>
                        <span>Orçamentos Reprovados</span>
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
    $getAccessUsers[] = (200 ? 30 : 0);//TOTAL DE ORÇAMENTOS APROVADOS
    $getAtendimentos[] = ($totalAtendimento ? $totalAtendimento : 0);//TOTAL DE ATENDIMENTOS 
    $getAccessPages[] = (200 ? 60 : 0);//TOTAL DE ORÇAMENTOS REPROVADOS
endforeach;

$DaysChart = implode(", ", $getDayChart);
$AccessUsers = implode(", ", $getAccessUsers);
$AtendTec = implode(", ", $getAtendimentos);
$AccessPages = implode(", ", $getAccessPages);

unset($_SESSION['wc_report_date']);

?>

<script>
    $(function() {

        //CHART CONFIG
        var wc_chart = Highcharts.chart('jwc_chart_container', {
            chart: {
                type:'column',//DETERMINA O FORMATO DO GRÁFICO
                spacingBottom: 0,
                spacingTop: 5,
                spacingLeft: 0,
                spacingRight: 20
            },
            title: {
                text: null
            },
            subtitle: {
                text: null
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'Estatísticas Técnicos'
                }
            },
            tooltip: {
                useHTML: true,
                shadow: false,
                headerFormat: '<p class="al_center">{point.key}</p><p class="al_center" style="font-size: 2em">{point.y}</p>',
                pointFormat: '<p class="al_center">{series.name}</p><p class="al_center"></p>',
                backgroundColor: '#000',
                borderWidth: 0,
                padding: 20,
                style: {
                    padding: 20,
                    color: '#fff'
                }
            },
            xAxis: {
                categories: ['<?=$NomeTecnico;?>'],//NOME DO TÉCNICO ABAIXO DO GRÁFICO  
                minTickInterval: 1 //SPAÇO ENTRE AS DATAS EXIBIDAS ABAIXO DO GRÁFICO
            },
            series: [
                {
                    name: 'Atendimentos',
                    data: [<?=$AtendTec?>],//EXIBE QTD DE ATENDIMENTOS REALIZADOS PELO TÉCNICO
                    color: '#FF9326',
                    lineColor: '#B25900'
                },
                {
                    name: 'Aprovados',
                    data: [10,40],//EXIBE QTD DE ORÇAMNTOS APROVADOS
                    color: '#0E96E5',
                    lineColor: '#006699'
                },
                {
                    name: 'Reprovados',
                    data: [10,40],//EXIBE QTD DE ORÇAMENTOS REPROVADOS
                    color: '#00B494',
                    lineColor: '#008068'
                }
            ]
        });
    });
</script>
<script src="_js/report_gns.js"></script>
<script>$(document).ready(iniciaPagina);</script>