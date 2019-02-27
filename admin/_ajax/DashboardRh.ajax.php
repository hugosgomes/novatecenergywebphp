<?php

session_start();
require '../../_app/Config.inc.php';

if (empty($_SESSION['userLogin'])):
  $jSON['trigger'] = AjaxErro('<b class="icon-warning">OPSS:</b> Você não tem permissão para essa ação ou não está logado como administrador!', E_USER_ERROR);
  echo json_encode($jSON);
  die;
endif;

usleep(50000);

//DEFINE O CALLBACK E RECUPERA O POST
$jSON = NULL;
$CallBack = 'DashboardRh';
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

 //SELECIONA AÇÃO
  switch ($Case):

    case 'selectfuncionarios':
    $jSON['nomeLog'] = NULL;


    $Read->FullRead("SELECT COUNT(DISTINCT IdFuncionario) AS nome FROM [30_Documentacao]
      INNER JOIN [Funcionários] ON [Funcionários].ID = [30_Documentacao].IdFuncionario
      WHERE DataValidade <= CONVERT(DATE,GETDATE()) AND [DATA DE DEMISSÃO] IS NULL AND [30_Documentacao].Status != 3 AND [30_Documentacao].TipoData = 1", " ");
    $variavelSelect = $Read->getResult();

      $jSON['nome'] = NULL;//ANTES DO FOREACH VOCÊ DEVE DECLARAR COMO NULL
      $FUNC = NULL;//ANTES DO FOREACH VOCÊ DEVE DECLARAR COMO NULL

      if ($variavelSelect) {
        foreach ($Read->getResult() as $FUNC) {

          $jSON['nome'] .= "<a href='#ex1' rel='modal:open' id='1' class='icon-users wc_useronline'>{$FUNC['nome']}</a>";

        }
      }

      $Read->FullRead("SELECT COUNT(DISTINCT IdFuncionario) AS nome FROM [30_Documentacao]
        INNER JOIN [Funcionários] ON [Funcionários].ID = [30_Documentacao].IdFuncionario
        WHERE DataValidade > CONVERT(DATE,GETDATE()) AND DataValidade <= CONVERT(DATE, DateAdd(month, +1,GETDATE())) AND [DATA DE DEMISSÃO] IS NULL AND [30_Documentacao].Status != 3 AND [30_Documentacao].TipoData = 1", " ");
      $variavelSelect = $Read->getResult();

      $jSON['nome1'] = NULL;//ANTES DO FOREACH VOCÊ DEVE DECLARAR COMO NULL
      $FUNC = NULL;//ANTES DO FOREACH VOCÊ DEVE DECLARAR COMO NULL

      if ($variavelSelect) {
        foreach ($Read->getResult() as $FUNC) {

          $jSON['nome1'] .= "<a href='#ex2' rel='modal:open' id='2' class='icon-users wc_useronline'>{$FUNC['nome']}</a>";

        }
      }

      $Read->FullRead("SELECT COUNT(DISTINCT [NOME COMPLETO]) AS nome FROM Funcionários
        INNER JOIN [30_Documentacao] ON [30_Documentacao].IdFuncionario <> [Funcionários].ID
        LEFT JOIN [30_TipoDocumentacao] ON [30_TipoDocumentacao].ID = [30_Documentacao].IdTipoDocumento
        WHERE [DATA DE DEMISSÃO] IS NULL AND [30_TipoDocumentacao].ID != 32", " ");
      $variavelSelect = $Read->getResult();

      $jSON['nome2'] = NULL;//ANTES DO FOREACH VOCÊ DEVE DECLARAR COMO NULL
      $FUNC = NULL;//ANTES DO FOREACH VOCÊ DEVE DECLARAR COMO NULL

      if ($variavelSelect) {
        foreach ($Read->getResult() as $FUNC) {

          $jSON['nome2'] .= "<a href='#ex3' rel='modal:open' id='3' class='icon-users wc_useronline'>{$FUNC['nome']}</a>";

        }
      }


      $date = date('d/m/Y');
      $jSON['nomeLog'] = "<a href='#log' rel='modal:open' id='4' class='icon-file-excel wc_useronline'>{$date}</a>";

      break;


      //*************************************************************SPACE************************************************************************//
      //*************************************************************SPACE************************************************************************//
      //*************************************************************SPACE************************************************************************//
      //*************************************************************SPACE************************************************************************//
      //*************************************************************SPACE************************************************************************//
      //*************************************************************SPACE************************************************************************//
      //*************************************************************SPACE************************************************************************//
      //*************************************************************SPACE************************************************************************//
      //*************************************************************SPACE************************************************************************//
      //*************************************************************SPACE************************************************************************//


      case 'clicarfuncionarios':

      $jSON['nomeF'] = NULL;//ANTES DO FOREACH VOCÊ DEVE DECLARAR COMO NULL
      $FUNC = NULL;//ANTES DO FOREACH VOCÊ DEVE DECLARAR COMO NULL

      $Read->FullRead("SELECT DISTINCT F.ID AS id ,F.[NOME COMPLETO] AS nome FROM Funcionários AS F 
        INNER JOIN [30_Documentacao] AS D ON F.[ID] = D.[IdFuncionario] 
        WHERE D.DataValidade <= CONVERT(DATE,GETDATE()) AND [DATA DE DEMISSÃO] IS NULL AND TipoData = 1
        ORDER BY F.[NOME COMPLETO]", " ");
      if ($Read->getResult()):
        foreach ($Read->getResult() as $FUNC):
          $jSON['nomeF'] .= "<center><option class='listafunc' value='{$FUNC['id']}'>{$FUNC['nome']}</option></center>";
        endforeach;
      endif; 

//*************************************************************SPACE************************************************************************//
//*************************************************************SPACE************************************************************************//

      $jSON['nomeF1'] = NULL;//ANTES DO FOREACH VOCÊ DEVE DECLARAR COMO NULL
      $FUNC = NULL;//ANTES DO FOREACH VOCÊ DEVE DECLARAR COMO NULL

      $Read->FullRead("SELECT DISTINCT F.ID AS id ,F.[NOME COMPLETO] AS nome FROM Funcionários AS F 
        INNER JOIN [30_Documentacao] AS D ON F.[ID] = D.[IdFuncionario] 
        WHERE DataValidade > CONVERT(DATE,GETDATE()) AND DataValidade <= CONVERT(DATE, DateAdd(month, +1,GETDATE())) AND [DATA DE DEMISSÃO] IS NULL AND TipoData = 1
        ORDER BY F.[NOME COMPLETO]", " ");
      if ($Read->getResult()):
        foreach ($Read->getResult() as $FUNC):
          $jSON['nomeF1'] .= "<center><option class='listafunc' value='{$FUNC['id']}'>{$FUNC['nome']}</option></center>";
        endforeach;
      endif; 

//*************************************************************SPACE************************************************************************//
//*************************************************************SPACE************************************************************************//

      $jSON['nomeF2'] = NULL;//ANTES DO FOREACH VOCÊ DEVE DECLARAR COMO NULL
      $FUNC = NULL;//ANTES DO FOREACH VOCÊ DEVE DECLARAR COMO NULL

      $Read->FullRead("SELECT DISTINCT [Funcionários].ID AS id ,[NOME COMPLETO] AS nome FROM Funcionários
        INNER JOIN [30_Documentacao] ON [30_Documentacao].IdFuncionario <> [Funcionários].ID
        LEFT JOIN [30_TipoDocumentacao] ON [30_TipoDocumentacao].ID = [30_Documentacao].IdTipoDocumento
        WHERE [DATA DE DEMISSÃO] IS NULL AND [30_TipoDocumentacao].ID <> 32
        ORDER BY [NOME COMPLETO]", " ");
      if ($Read->getResult()):
        foreach ($Read->getResult() as $FUNC):
          $jSON['nomeF2'] .= "<center><option class='listafunc' value='{$FUNC['id']}'>{$FUNC['nome']}</option></center>";
        endforeach;
      endif;



      $jSON['nomeLog'] = NULL;
      $query = NULL;

      $Read->FullRead("SELECT Funcionários.[NOME COMPLETO], [30_Documentacao].Tipo, [30_DocumentacaoLog].Erro, [30_DocumentacaoLog].Data, [30_DocumentacaoLog].Status 
        FROM [30_DocumentacaoLog]
        INNER JOIN Funcionários ON Funcionários.ID = [30_DocumentacaoLog].IdFuncionario
        INNER JOIN [30_Documentacao] ON [30_Documentacao].Id = [30_DocumentacaoLog].IdDocumentacao
        ORDER BY [30_DocumentacaoLog].Data", " ");
      if ($Read->getResult()):
        foreach ($Read->getResult() as $query):
          extract($query);
          $nome = $query['NOME COMPLETO'];
          $doc = $query['Tipo'];
          $error = $query['Erro'];
          $date = $query['Data'];
          $status = $query['Status'];
          $dataBr = date('d/m/Y', strtotime($date));

          if ($status == 1):
            $status = "<img style='width: 30px;' src='_img/circulo-vermelho.png'>";
          endif;
          if ($status == 2):
            $status = "<img style='width: 30px;' src='_img/circulo-verde.png'>";
          endif;

          $jSON['nomeLog'] .= "<tr><td><center><b>{$nome}</b></center></td><td><center>{$doc}</center></td><td><b><center style='color: red;'>{$error}</center></b></td><td><center>{$dataBr}</center></td><td><center>{$status}</center></td></tr>";


        endforeach;
      endif;


      break;

    endswitch;

//RETORNA O CALLBACK
    if ($jSON):
      echo json_encode($jSON);
    else:
      $jSON['trigger'] = AjaxErro('<b class="icon-warning">OPSS:</b> Desculpe. Mas uma ação do sistema não respondeu corretamente. Ao persistir, contate o desenvolvedor!', E_USER_ERROR);
      echo json_encode($jSON);
    endif;
  else:
    //ACESSO DIRETO
    die('<br><br><br><center><h1>Acesso Restrito!</h1></center>');
  endif;