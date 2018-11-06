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
$CallBack = 'Estatisticas';
$PostData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$Data = new DateTime();
//VALIDA AÇÃO
if ($PostData && $PostData['callback'] == $CallBack):
    //PREPARA OS DADOS
  unset($PostData['callback']);

  $jSON['Tecnicos'] = null;

    // AUTO INSTANCE OBJECT READ
  if (empty($Read)):
    $Read = new Read;
  endif;


  //ESTATÍSTICAS TÉCNICOS ///////////////////////////////////////
  $Read->FullRead("SELECT [00_NivelAcesso].ID, CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END AS NOME, COUNT([60_OS].Id) AS ATENDIMENTOS,
  SUM(IIF([60_Orcamentos].Status <> 3, 1, 0)) AS APROVADOS, SUM(IIF([60_Orcamentos].Status = 3, 1, 0)) AS REPROVADOS
    FROM [00_NivelAcesso] LEFT JOIN Funcionários FUNC ON [00_NivelAcesso].IDFUNCIONARIO = FUNC.ID
    LEFT JOIN FuncionariosTerceirizados TERC ON [00_NivelAcesso].IDTERCEIRIZADO = TERC.ID
  LEFT JOIN [60_OS] ON [00_NivelAcesso].ID = [60_OS].Tecnico
  LEFT JOIN [60_Orcamentos] ON [60_OS].ID = [60_Orcamentos].IdOS
  WHERE MOBILE_GNS = 1 AND FUNC.[DATA DE DEMISSÃO] IS NULL
  GROUP BY [00_NivelAcesso].ID, NOME, FUNC.ID, FUNC.[NOME COMPLETO], TERC.NOME
  ORDER BY NOME"," ");

  if ($Read->getResult()):
    $tecnicos = [];
    $atendimentos = [];
    $aprovados = [];
    $reprovados = [];
    foreach ($Read->getResult() as $FUNC):
      array_push($tecnicos, $FUNC['NOME']);
      array_push($atendimentos, $FUNC['ATENDIMENTOS']);
      array_push($aprovados, $FUNC['APROVADOS']);
      array_push($reprovados, $FUNC['REPROVADOS']);
    endforeach;
  endif;

  $jSON['Tecnicos'] = $tecnicos;
  $jSON['Atendimentos'] = $atendimentos;
  $jSON['Aprovados'] = $aprovados;
  $jSON['Reprovados'] = $reprovados;


  //RETORNA O CALLBACK
  if ($jSON):
      echo json_encode($jSON);
  else:
      $jSON['trigger'] = AjaxErro('<b class="icon-warning">OPSS:</b> Desculpe. Mas uma ação do sistema não respondeu corretamente. Ao persistir, contate o desenvolvedor!', E_USER_ERROR);
      echo json_encode($jSON);
  endif;

endif;



    