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
  $ano = $PostData['ano'];
  $mes = $PostData['mes'];
  $semana = $PostData['semana'];

    // AUTO INSTANCE OBJECT READ
  if (empty($Read)):
    $Read = new Read;
  endif;


  //GRÁFICO ESTATÍSTICAS TÉCNICOS ****************************************
  $tecnicos = [];
  $atendimentos = [];
  $aprovados = [];
  $reprovados = [];
  $totalAtendimentos = 0;
  $totalAprovados = 0;
  $totalReprovados = 0;

  //LISTA DE TÉCNICOS DO GRÁFICO
  $Read->FullRead("SELECT CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END AS NOME 
    FROM [00_NivelAcesso] LEFT JOIN Funcionários FUNC ON [00_NivelAcesso].IDFUNCIONARIO = FUNC.ID
    LEFT JOIN FuncionariosTerceirizados TERC ON [00_NivelAcesso].IDTERCEIRIZADO = TERC.ID
    WHERE MOBILE_GNS = 1 AND FUNC.[DATA DE DEMISSÃO] IS NULL
    ORDER BY NOME"," ");

  if ($Read->getResult()):    
    foreach ($Read->getResult() as $FUNC):
      array_push($tecnicos, $FUNC['NOME']);
    endforeach;
  endif;


  //QUANTIDADE DE ATENDIMENTOS POR TÉCNICO
  $criterioMes = $mes <> 't' ? ' AND MONTH([60_OS].DataAgendamento) = '.$mes : ' AND MONTH([60_OS].DataAgendamento) > 0';
  $criterioAno = $ano <> 't' ? ' AND YEAR([60_OS].DataAgendamento) = '.$ano : ' AND YEAR([60_OS].DataAgendamento) > 0';
  $criterioSemana = $semana <> 't' ? ' AND DATEPART(WK, [60_OS].DataAgendamento) - DATEPART(WK, [60_OS].DataAgendamento - DAY([60_OS].DataAgendamento) + 1) + 1 = '.$semana : ' AND DATEPART(WK, [60_OS].DataAgendamento) - DATEPART(WK, [60_OS].DataAgendamento - DAY([60_OS].DataAgendamento) + 1) + 1 > 0 ';

  $Read->FullRead("SELECT CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END AS NOME, SUBQUERY.ATENDIMENTOS
    FROM [00_NivelAcesso] LEFT JOIN Funcionários FUNC ON [00_NivelAcesso].IDFUNCIONARIO = FUNC.ID
    LEFT JOIN FuncionariosTerceirizados TERC ON [00_NivelAcesso].IDTERCEIRIZADO = TERC.ID
  LEFT JOIN
  (
  SELECT CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END AS NOMETEC, COUNT([60_OS].Id) AS ATENDIMENTOS
      FROM [00_NivelAcesso] LEFT JOIN Funcionários FUNC ON [00_NivelAcesso].IDFUNCIONARIO = FUNC.ID
      LEFT JOIN FuncionariosTerceirizados TERC ON [00_NivelAcesso].IDTERCEIRIZADO = TERC.ID
      LEFT JOIN [60_OS] ON [00_NivelAcesso].ID = [60_OS].Tecnico
      LEFT JOIN [60_Orcamentos] ON [60_OS].ID = [60_Orcamentos].IdOS
      WHERE MOBILE_GNS = 1 AND FUNC.[DATA DE DEMISSÃO] IS NULL" . $criterioMes . $criterioAno . $criterioSemana .  
    "GROUP BY [00_NivelAcesso].ID, NOME, FUNC.ID, FUNC.[NOME COMPLETO], TERC.NOME
      ) SUBQUERY
  ON CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END = SUBQUERY.NOMETEC
  WHERE MOBILE_GNS = 1 AND FUNC.[DATA DE DEMISSÃO] IS NULL
  ORDER BY NOME"," ");

  if ($Read->getResult()):    
    foreach ($Read->getResult() as $FUNC):
      array_push($atendimentos, $FUNC['ATENDIMENTOS']);
      $totalAtendimentos = $totalAtendimentos + $FUNC['ATENDIMENTOS'];
    endforeach;
  endif;


  //QUANTIDADE DE ORÇAMENTOS APROVADOS POR TÉCNICO
  $criterioMes = $mes <> 't' ? ' AND MONTH([60_Orcamentos].DataEnt) = '.$mes : ' AND MONTH([60_Orcamentos].DataEnt) > 0';
  $criterioAno = $ano <> 't' ? ' AND YEAR([60_Orcamentos].DataEnt) = '.$ano : ' AND YEAR([60_Orcamentos].DataEnt) > 0';
  $criterioSemana = $semana <> 't' ? ' AND DATEPART(WK, [60_Orcamentos].DataEnt) - DATEPART(WK, [60_Orcamentos].DataEnt - DAY([60_Orcamentos].DataEnt) + 1) + 1 = '.$semana : ' AND DATEPART(WK, [60_Orcamentos].DataEnt) - DATEPART(WK, [60_Orcamentos].DataEnt - DAY([60_Orcamentos].DataEnt) + 1) + 1 > 0 ';

  $Read->FullRead("SELECT CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END AS NOME, SUBQUERY.APROVADOS
    FROM [00_NivelAcesso] LEFT JOIN Funcionários FUNC ON [00_NivelAcesso].IDFUNCIONARIO = FUNC.ID
    LEFT JOIN FuncionariosTerceirizados TERC ON [00_NivelAcesso].IDTERCEIRIZADO = TERC.ID
  LEFT JOIN
  (
  SELECT CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END AS NOMETEC, SUM(IIF([60_Orcamentos].Status <> 3, 1, 0)) AS APROVADOS
    FROM [00_NivelAcesso] LEFT JOIN Funcionários FUNC ON [00_NivelAcesso].IDFUNCIONARIO = FUNC.ID
    LEFT JOIN FuncionariosTerceirizados TERC ON [00_NivelAcesso].IDTERCEIRIZADO = TERC.ID
    LEFT JOIN [60_OS] ON [00_NivelAcesso].ID = [60_OS].Tecnico
    LEFT JOIN [60_Orcamentos] ON [60_OS].ID = [60_Orcamentos].IdOS
    WHERE MOBILE_GNS = 1 AND FUNC.[DATA DE DEMISSÃO] IS NULL" . $criterioMes . $criterioAno . $criterioSemana .  
    "GROUP BY [00_NivelAcesso].ID, NOME, FUNC.ID, FUNC.[NOME COMPLETO], TERC.NOME
    ) SUBQUERY
    ON CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END = SUBQUERY.NOMETEC
    WHERE MOBILE_GNS = 1 AND FUNC.[DATA DE DEMISSÃO] IS NULL
    ORDER BY NOME"," ");

  if ($Read->getResult()):    
    foreach ($Read->getResult() as $FUNC):
      array_push($aprovados, $FUNC['APROVADOS']);
      $totalAprovados = $totalAprovados + $FUNC['APROVADOS'];
    endforeach;
  endif;


  //QUANTIDADE DE ORÇAMENTOS REPROVADOS POR TÉCNICO
  $Read->FullRead("SELECT CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END AS NOME, SUBQUERY.REPROVADOS
    FROM [00_NivelAcesso] LEFT JOIN Funcionários FUNC ON [00_NivelAcesso].IDFUNCIONARIO = FUNC.ID
    LEFT JOIN FuncionariosTerceirizados TERC ON [00_NivelAcesso].IDTERCEIRIZADO = TERC.ID
  LEFT JOIN
  (
  SELECT CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END AS NOMETEC, SUM(IIF([60_Orcamentos].Status = 3, 1, 0)) AS REPROVADOS
      FROM [00_NivelAcesso] LEFT JOIN Funcionários FUNC ON [00_NivelAcesso].IDFUNCIONARIO = FUNC.ID
      LEFT JOIN FuncionariosTerceirizados TERC ON [00_NivelAcesso].IDTERCEIRIZADO = TERC.ID
      LEFT JOIN [60_OS] ON [00_NivelAcesso].ID = [60_OS].Tecnico
      LEFT JOIN [60_Orcamentos] ON [60_OS].ID = [60_Orcamentos].IdOS
      WHERE MOBILE_GNS = 1 AND FUNC.[DATA DE DEMISSÃO] IS NULL" . $criterioMes . $criterioAno . $criterioSemana .  
      "GROUP BY [00_NivelAcesso].ID, NOME, FUNC.ID, FUNC.[NOME COMPLETO], TERC.NOME
      ) SUBQUERY
  ON CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END = SUBQUERY.NOMETEC
  WHERE MOBILE_GNS = 1 AND FUNC.[DATA DE DEMISSÃO] IS NULL
  ORDER BY NOME"," ");

  if ($Read->getResult()):    
    foreach ($Read->getResult() as $FUNC):
      array_push($reprovados, $FUNC['REPROVADOS']);
      $totalReprovados = $totalReprovados + $FUNC['REPROVADOS'];      
    endforeach;
  endif;

  $jSON['Tecnicos'] = $tecnicos;
  $jSON['Atendimentos'] = $atendimentos;
  $jSON['Aprovados'] = $aprovados;
  $jSON['Reprovados'] = $reprovados;
  $jSON['LegendaTecnicos'] = "<td><b>Atendimentos: {$totalAtendimentos}</b></td>
                          <td><b>Aprovados: {$totalAprovados}</b></td>
                          <td><b>Reprovados: {$totalReprovados}</b></td>";

  //FIM DO GRÁFICO ESTATÍSTICAS TÉCNICOS ****************************************


  //GRÁFICO ESTATÍSTICAS ORÇAMENTOS E ORÇAMENTOS APROVADOS***********************
  //ORÇAMENTOS APROVADOS
  $criterioMes = $mes <> 't' ? ' AND MONTH([60_Orcamentos].DataEnt) = '.$mes : ' AND MONTH([60_Orcamentos].DataEnt) > 0';
  $criterioAno = $ano <> 't' ? ' AND YEAR([60_Orcamentos].DataEnt) = '.$ano : ' AND YEAR([60_Orcamentos].DataEnt) > 0';
  $criterioSemana = $semana <> 't' ? ' AND DATEPART(WK, [60_Orcamentos].DataEnt) - DATEPART(WK, [60_Orcamentos].DataEnt - DAY([60_Orcamentos].DataEnt) + 1) + 1 = '.$semana : ' AND DATEPART(WK, [60_Orcamentos].DataEnt) - DATEPART(WK, [60_Orcamentos].DataEnt - DAY([60_Orcamentos].DataEnt) + 1) + 1 > 0 ';

  $Read->FullRead("SELECT COUNT(ID) AS CONTADOR FROM [60_Orcamentos] WHERE Status = 1" . $criterioMes . $criterioAno . $criterioSemana, " ");

  if ($Read->getResult()):    
    foreach ($Read->getResult() as $FUNC):
      $jSON['PizzaOrcamentosAprov'] = $FUNC['CONTADOR'];      
    endforeach;
  endif;

  //ORÇAMENTOS REPROVADOS
  $Read->FullRead("SELECT COUNT(ID) AS CONTADOR FROM [60_Orcamentos] WHERE Status = 3" . $criterioMes . $criterioAno . $criterioSemana, " ");

  if ($Read->getResult()):    
    foreach ($Read->getResult() as $FUNC):
      $jSON['PizzaOrcamentosReprov'] = $FUNC['CONTADOR'];      
    endforeach;
  endif;

  //ORÇAMENTOS EXECUTADOS
  $criterioMes = $mes <> 't' ? ' AND MONTH([60_Orcamentos].DataExe) = '.$mes : ' AND MONTH([60_Orcamentos].DataExe) > 0';
  $criterioAno = $ano <> 't' ? ' AND YEAR([60_Orcamentos].DataExe) = '.$ano : ' AND YEAR([60_Orcamentos].DataExe) > 0';
  $criterioSemana = $semana <> 't' ? ' AND DATEPART(WK, [60_Orcamentos].DataExe) - DATEPART(WK, [60_Orcamentos].DataExe - DAY([60_Orcamentos].DataExe) + 1) + 1 = '.$semana : ' AND DATEPART(WK, [60_Orcamentos].DataExe) - DATEPART(WK, [60_Orcamentos].DataExe - DAY([60_Orcamentos].DataExe) + 1) + 1 > 0 ';

  $Read->FullRead("SELECT COUNT(ID) AS CONTADOR FROM [60_Orcamentos] WHERE Status = 2" . $criterioMes . $criterioAno . $criterioSemana, " ");

  if ($Read->getResult()):    
    foreach ($Read->getResult() as $FUNC):
      $jSON['PizzaOrcamentosExec'] = $FUNC['CONTADOR'];      
    endforeach;
  endif;


  //ORÇAMENTOS RECUPERADOS
  $criterioMes = $mes <> 't' ? ' AND MONTH([60_Orcamentos].DataRecuperacao) = '.$mes : ' AND MONTH([60_Orcamentos].DataRecuperacao) > 0';
  $criterioAno = $ano <> 't' ? ' AND YEAR([60_Orcamentos].DataRecuperacao) = '.$ano : ' AND YEAR([60_Orcamentos].DataRecuperacao) > 0';
  $criterioSemana = $semana <> 't' ? ' AND DATEPART(WK, [60_Orcamentos].DataRecuperacao) - DATEPART(WK, [60_Orcamentos].DataRecuperacao - DAY([60_Orcamentos].DataRecuperacao) + 1) + 1 = '.$semana : ' AND DATEPART(WK, [60_Orcamentos].DataRecuperacao) - DATEPART(WK, [60_Orcamentos].DataRecuperacao - DAY([60_Orcamentos].DataRecuperacao) + 1) + 1 > 0 ';

  $Read->FullRead("SELECT COUNT(ID) AS CONTADOR FROM [60_Orcamentos] WHERE Status = 4" . $criterioMes . $criterioAno . $criterioSemana, " ");

  if ($Read->getResult()):    
    foreach ($Read->getResult() as $FUNC):
      $jSON['PizzaOrcamentosRecup'] = $FUNC['CONTADOR'];
    endforeach;
  endif;

  $total = $jSON['PizzaOrcamentosAprov'] + $jSON['PizzaOrcamentosReprov'] + $jSON['PizzaOrcamentosExec'] + $jSON['PizzaOrcamentosRecup'];

  $jSON['LegendaEstarOrcam'] = "<tr>
                          <td><b>Total: {$total}</b></td>
                          <td><b>Aprovados: {$jSON['PizzaOrcamentosAprov']}</b></td>
                        </tr>
                        <tr>
                          <td><b>Recuperados: {$jSON['PizzaOrcamentosRecup']}</b></td>
                          <td><b>Executados: {$jSON['PizzaOrcamentosExec']}</b></td>
                        </tr>
                        <tr>
                          <td><b>Recusados: {$jSON['PizzaOrcamentosReprov']}</b></td>
                          <td></td>
                        </tr>";

  $total = $jSON['PizzaOrcamentosAprov'] + $jSON['PizzaOrcamentosExec'] + $jSON['PizzaOrcamentosRecup'];

  $jSON['LegendaOrcamAprov'] = "<tr>
                        <td><b>Total: {$total}</b></td>
                        <td><b>Executados: {$jSON['PizzaOrcamentosExec']}</b></td>                        
                      </tr>
                      <tr>
                        <td><b>Agendados: {$jSON['PizzaOrcamentosAprov']}</b></td>
                        <td><b>Recuperados: {$jSON['PizzaOrcamentosRecup']}</b></td>                        
                      </tr>";

  $Read->FullRead("SELECT COUNT(ID) AS CONTADOR FROM [60_Orcamentos] WHERE Status = 4" . $criterioMes . $criterioAno . $criterioSemana, " ");

  if ($Read->getResult()):    
    foreach ($Read->getResult() as $FUNC):
      $jSON['PizzaOrcamentosRecup'] = $FUNC['CONTADOR'];
    endforeach;
  endif;

  //FIM DO GRÁFICO ESTATÍSTICAS ORÇAMENTOS E ORÇAMENTOS APROVADOS ************

  //GRÁFICO ESTATÍSTICAS CLIENTES
  $criterioMes = $mes <> 't' ? ' AND MONTH([60_Atendimentos].DataAtendimento) = '.$mes : ' AND MONTH([60_Atendimentos].DataAtendimento) > 0';
  $criterioAno = $ano <> 't' ? ' AND YEAR([60_Atendimentos].DataAtendimento) = '.$ano : ' AND YEAR([60_Atendimentos].DataAtendimento) > 0';
  $criterioSemana = $semana <> 't' ? ' AND DATEPART(WK, [60_Atendimentos].DataAtendimento) - DATEPART(WK, [60_Atendimentos].DataAtendimento - DAY([60_Atendimentos].DataAtendimento) + 1) + 1 = '.$semana : ' AND DATEPART(WK, [60_Atendimentos].DataAtendimento) - DATEPART(WK, [60_Atendimentos].DataAtendimento - DAY([60_Atendimentos].DataAtendimento) + 1) + 1 > 0 ';

  //ATENDIDOS
  $Read->FullRead("SELECT COUNT(ID) AS CONTADOR FROM [60_Atendimentos] WHERE Status = 1" . $criterioMes . $criterioAno . $criterioSemana, " ");

  if ($Read->getResult()):    
    foreach ($Read->getResult() as $FUNC):
      $jSON['PizzaEstatClientesAtend'] = $FUNC['CONTADOR'];
    endforeach;
  endif;

  //CANCELADOS
  $Read->FullRead("SELECT COUNT(ID) AS CONTADOR FROM [60_Atendimentos] WHERE Status = 2" . $criterioMes . $criterioAno . $criterioSemana, " ");

  if ($Read->getResult()):    
    foreach ($Read->getResult() as $FUNC):
      $jSON['PizzaEstatClientesCanc'] = $FUNC['CONTADOR'];
    endforeach;
  endif;

  //AUSENTES
  $Read->FullRead("SELECT COUNT(ID) AS CONTADOR FROM [60_Atendimentos] WHERE Status = 3" . $criterioMes . $criterioAno . $criterioSemana, " ");

  if ($Read->getResult()):    
    foreach ($Read->getResult() as $FUNC):
      $jSON['PizzaEstatClientesAus'] = $FUNC['CONTADOR'];
    endforeach;
  endif;

  //REAGENDADO NVT
  $Read->FullRead("SELECT COUNT(ID) AS CONTADOR FROM [60_Atendimentos] WHERE Status = 4" . $criterioMes . $criterioAno . $criterioSemana, " ");

  if ($Read->getResult()):    
    foreach ($Read->getResult() as $FUNC):
      $jSON['PizzaEstatClientesReagNVT'] = $FUNC['CONTADOR'];
    endforeach;
  endif;

  //REAGENDADO GNS
  $Read->FullRead("SELECT COUNT(ID) AS CONTADOR FROM [60_Atendimentos] WHERE Status = 5" . $criterioMes . $criterioAno . $criterioSemana, " ");

  if ($Read->getResult()):    
    foreach ($Read->getResult() as $FUNC):
      $jSON['PizzaEstatClientesReagGNS'] = $FUNC['CONTADOR'];
    endforeach;
  endif;


  //SEM ATENDER
  $criterioMes = $mes <> 't' ? ' AND MONTH([60_OS].DataAgendamento) = '.$mes : ' AND MONTH([60_OS].DataAgendamento) > 0';
  $criterioAno = $ano <> 't' ? ' AND YEAR([60_OS].DataAgendamento) = '.$ano : ' AND YEAR([60_OS].DataAgendamento) > 0';
  $criterioSemana = $semana <> 't' ? ' AND DATEPART(WK, [60_OS].DataAgendamento) - DATEPART(WK, [60_OS].DataAgendamento - DAY([60_OS].DataAgendamento) + 1) + 1 = '.$semana : ' AND DATEPART(WK, [60_OS].DataAgendamento) - DATEPART(WK, [60_OS].DataAgendamento - DAY([60_OS].DataAgendamento) + 1) + 1 > 0 ';

  $Read->FullRead("SELECT COUNT([60_OS].ID) AS CONTADOR FROM [60_OS] LEFT JOIN [60_Atendimentos] ON [60_OS].Id = [60_Atendimentos].IdOS WHERE [60_Atendimentos].IdOS IS NULL" . $criterioMes . $criterioAno . $criterioSemana, " ");

  if ($Read->getResult()):    
    foreach ($Read->getResult() as $FUNC):
      $jSON['PizzaEstatClientesSemAtender'] = $FUNC['CONTADOR'];
    endforeach;
  endif;

  $total = $jSON['PizzaEstatClientesAtend'] + $jSON['PizzaEstatClientesCanc'] + $jSON['PizzaEstatClientesAus'] + $jSON['PizzaEstatClientesReagNVT'] + $jSON['PizzaEstatClientesReagGNS'] + $jSON['PizzaEstatClientesSemAtender'];

  $jSON['LegendaEstatClientes'] = "<table id='j_estat_clientes' style='max-width: 450px;margin: auto;'>
                        <tr>
                          <td><b>Total Clientes: {$total}</b></td>
                          <td><b>Atendidos: {$jSON['PizzaEstatClientesAtend']}</b></td>
                        </tr>
                        <tr>
                          <td><b>Cancelados: {$jSON['PizzaEstatClientesCanc']}</b></td>
                          <td><b>Ausentes: {$jSON['PizzaEstatClientesAus']}</b></td>
                        </tr>
                        <tr>
                          <td><b>Reagend. NVT: {$jSON['PizzaEstatClientesReagNVT']}</b></td>
                          <td><b>Reagend. GNS: {$jSON['PizzaEstatClientesReagGNS']}</b></td>
                        </tr>
                        <tr>
                          <td><b>Sem Atender: {$jSON['PizzaEstatClientesSemAtender']}</b></td>
                        </tr>";


  //FIM DO GRÁFICO ESTATÍSTICAS CLIENTES

  //GRÁFICO ESTATÍSTICAS SERVIÇOS
  $eixoY = [];
  $serie = [];
  $Read->FullRead("SELECT NomeOs, COUNT(Id) AS CONTADOR FROM [60_OS] WHERE" . substr($criterioMes,4) . $criterioAno . $criterioSemana . "GROUP BY NomeOs ORDER BY NomeOs", " ");

  if ($Read->getResult()):    
    foreach ($Read->getResult() as $FUNC):
      array_push($eixoY, $FUNC['NomeOs']);
      array_push($serie, $FUNC['CONTADOR']);
    endforeach;
  endif;

  $jSON['GraficoServico'] = $eixoY;
  $jSON['GraficoServicoSerie'] = $serie;

  //FIM DO GRÁFICO ESTATÍSTICAS SERVIÇOS

  //RETORNA O CALLBACK
  if ($jSON):
      echo json_encode($jSON);
  else:
      $jSON['trigger'] = AjaxErro('<b class="icon-warning">OPSS:</b> Desculpe. Mas uma ação do sistema não respondeu corretamente. Ao persistir, contate o desenvolvedor!', E_USER_ERROR);
      echo json_encode($jSON);
  endif;
endif;