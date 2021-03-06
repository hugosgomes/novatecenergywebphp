<?php

session_start();
require '../../../_app/Config.inc.php';

if (empty($_SESSION['userLogin'])):
  $jSON['trigger'] = AjaxErro('<b class="icon-warning">OPSS:</b> Você não tem permissão para essa ação ou não está logado como administrador!', E_USER_ERROR);
  echo json_encode($jSON);
  die;
endif;

usleep(50000);

//DEFINE O CALLBACK E RECUPERA O POST
$jSON = null;
$CallBack = 'Dadostabela';
$PostData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$Data = new DateTime();
//VALIDA AÇÃO
if ($PostData && $PostData['callback_action'] && $PostData['callback'] == $CallBack):
    //PREPARA OS DADOS
  $Case = $PostData['callback_action'];
  unset($PostData['callback'], $PostData['callback_action']);

    // AUTO INSTANCE OBJECT READ
  if (empty($Read)):
    $Read = new Read;
  endif;

    // AUTO INSTANCE OBJECT CREATE
  if (empty($Create)):
    $Create = new Create;
  endif;

    // AUTO INSTANCE OBJECT UPDATE
  if (empty($Update)):
    $Update = new Update;
  endif;

    // AUTO INSTANCE OBJECT DELETE
  if (empty($Delete)):
    $Delete = new Delete;
  endif;

  $StartDate = (!empty($_SESSION['wc_report_date'][0]) ? $_SESSION['wc_report_date'][0] : date("Y-01-01"));//recebe data inicial
  $EndDate = (!empty($_SESSION['wc_report_date'][1]) ? $_SESSION['wc_report_date'][1] : date("Y-12-31"));//recebe data final

//DEFAULT REPORT
  $DateStart = new DateTime($StartDate);
  $DateEnd = new DateTime(date("Y-m-d", strtotime($EndDate . "+1day")));
  $DateInt = new DateInterval("P31D");
  $DateInterval = new DatePeriod($DateStart, $DateInt, $DateEnd);
    //SELECIONA AÇÃO
  switch ($Case):
    case 'relatorio_padrao_tecnicos':
    foreach ($PostData as $key => $value) {
      if($PostData[$key] == ''){
        unset($PostData[$key]);
      }
    }
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

    break;
    case 'relatorio_padrao_orcamentos';
    break;
  endswitch;
endif;



