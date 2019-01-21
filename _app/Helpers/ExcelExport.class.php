<?php

// Inclui a conexão
//include ('../_app/Config.inc.php');

class excelExport{


	public static function exportar($semana, $Tecnico) {

		$PostData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

		if (empty($Read)):
        	$Read = new Read;
    	endif;

		// Nome do Arquivo do Excel que será gerado
		$arquivo = "Agendamentos.xls";

		// Criamos uma tabela HTML com o formato da planilha para excel
		$tabela = "<table id='dataTable' class='display cell-border compact'>
		<thead><tr><th>Cliente</th><th>OS</th><th>Nome OS</th><th>Endereço</th><th>Data</th><th>Técnico</th>
		<th>Período</th></tr></thead><tbody>";

		//VERIFICA DE O FOI SELECIONADO TODOS OS TÉCNICOS 
	      if($PostData['semana'] == 1):
	        if($PostData['Tecnico'] == 't'):
	            $Read->FullRead("SELECT NomeCliente, [60_OS].Id IDOS, [60_OS].[OSServico],[60_OS].NumOS, [60_OS].NomeOS, [60_OS].Status, [60_OS].DataAgendamento, [60_OS].Endereco, [60_OS].Bairro, [60_OS].Municipio, [60_OS].turno as TURNO,
	              [60_OS].Latitude, [60_OS].Longitude, IIF([Funcionários].[NOME COMPLETO] IS NOT NULL, [Funcionários].[NOME COMPLETO], FuncionariosTerceirizados.NOME) AS Tecnico, [00_NivelAcesso].[ID] AS IdTecnico FROM [60_Clientes]
	              inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
	              inner join [60_OS] on [60_OT].Id = [60_OS].OT
	              INNER JOIN [00_NivelAcesso] ON [60_OS].Tecnico = [00_NivelAcesso].ID
	              LEFT JOIN  Funcionários ON [00_NivelAcesso].IDFUNCIONARIO = Funcionários.ID
	              LEFT JOIN  FuncionariosTerceirizados ON [00_NivelAcesso].IDTERCEIRIZADO = FuncionariosTerceirizados.ID  
	                                  WHERE [60_OS].Tecnico <> 0 AND DatePart(Week,[60_OS].DataAgendamento) = DatePart(Week,GETDATE()) AND year([60_OS].DataAgendamento) = year(GETDATE())",NULL);
	        else:
	            $Read->FullRead("SELECT NomeCliente, [60_OS].Id IDOS, [60_OS].[OSServico],[60_OS].NumOS, [60_OS].NomeOS, [60_OS].Status, [60_OS].DataAgendamento, [60_OS].Endereco, [60_OS].Bairro, [60_OS].Municipio, [60_OS].turno as TURNO,
	              [60_OS].Latitude, [60_OS].Longitude, IIF([Funcionários].[NOME COMPLETO] IS NOT NULL, [Funcionários].[NOME COMPLETO], FuncionariosTerceirizados.NOME) AS Tecnico, [00_NivelAcesso].[ID] AS IdTecnico FROM [60_Clientes]
	              inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
	              inner join [60_OS] on [60_OT].Id = [60_OS].OT
	              INNER JOIN [00_NivelAcesso] ON [60_OS].Tecnico = [00_NivelAcesso].ID
	              LEFT JOIN  Funcionários ON [00_NivelAcesso].IDFUNCIONARIO = Funcionários.ID
	              LEFT JOIN  FuncionariosTerceirizados ON [00_NivelAcesso].IDTERCEIRIZADO = FuncionariosTerceirizados.ID  
	                                  WHERE [60_OS].Tecnico = :tecnico  AND DatePart(Week,[60_OS].DataAgendamento) = DatePart(Week,GETDATE()) AND year([60_OS].DataAgendamento) = year(GETDATE())","tecnico={$PostData['Tecnico']}");
	        endif;
	      else:
	        if($PostData['Tecnico'] == 't'):
	          $Read->FullRead("SELECT NomeCliente, [60_OS].Id IDOS, [60_OS].[OSServico],[60_OS].NumOS, [60_OS].NomeOS, [60_OS].Status, [60_OS].DataAgendamento, [60_OS].Endereco, [60_OS].Bairro, [60_OS].Municipio, [60_OS].turno as TURNO,
	            [60_OS].Latitude, [60_OS].Longitude, IIF([Funcionários].[NOME COMPLETO] IS NOT NULL, [Funcionários].[NOME COMPLETO], FuncionariosTerceirizados.NOME) AS Tecnico, [00_NivelAcesso].[ID] AS IdTecnico FROM [60_Clientes]
	            inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
	            inner join [60_OS] on [60_OT].Id = [60_OS].OT
	            INNER JOIN [00_NivelAcesso] ON [60_OS].Tecnico = [00_NivelAcesso].ID
	            LEFT JOIN  Funcionários ON [00_NivelAcesso].IDFUNCIONARIO = Funcionários.ID
	            LEFT JOIN  FuncionariosTerceirizados ON [00_NivelAcesso].IDTERCEIRIZADO = FuncionariosTerceirizados.ID  
	                                    WHERE [60_OS].[DataAgendamento] = :dia","dia={$PostData['dia']}");
	        else:
	          $Read->FullRead("SELECT NomeCliente, [60_OS].Id IDOS, [60_OS].[OSServico],[60_OS].NumOS, [60_OS].NomeOS, [60_OS].Status, [60_OS].DataAgendamento, [60_OS].Endereco, [60_OS].Bairro, [60_OS].Municipio, [60_OS].turno as TURNO,
	            [60_OS].Latitude, [60_OS].Longitude, IIF([Funcionários].[NOME COMPLETO] IS NOT NULL, [Funcionários].[NOME COMPLETO], FuncionariosTerceirizados.NOME) AS Tecnico, [00_NivelAcesso].[ID] AS IdTecnico FROM [60_Clientes]
	            inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
	            inner join [60_OS] on [60_OT].Id = [60_OS].OT
	            INNER JOIN [00_NivelAcesso] ON [60_OS].Tecnico = [00_NivelAcesso].ID
	            LEFT JOIN  Funcionários ON [00_NivelAcesso].IDFUNCIONARIO = Funcionários.ID
	            LEFT JOIN  FuncionariosTerceirizados ON [00_NivelAcesso].IDTERCEIRIZADO = FuncionariosTerceirizados.ID  
	                                    WHERE [60_OS].Tecnico = :tecnico AND [60_OS].[DataAgendamento] = :dia","tecnico={$PostData['Tecnico']}&dia={$PostData['dia']}");
	          endif;
	      endif;

		//$resultado = $Read->getResult();

		while($dados = sqlsrv_fetch_array($Read->getResult()))
		{
		$tabela .= '<tr>';
		$tabela .= '<td>'.$dados['NomeCliente'].'</td>';
		$tabela .= '<td>'.$dados['NumOS'].'</td>';
		$tabela .= '<td>'.$dados['NomeOS'].'</td>';
		$tabela .= '<td>'.$dados['Endereco'] . $dados['Bairro'] . $dados['Municipio'].'</td>';
		$tabela .= '<td style="text-align: center; vertical-align: middle">'.$dados['Tecnico'].'</td>';
		$tabela .= '<td style="text-align: center; vertical-align: middle">'.$dados['TURNO'].'</td>';
		$tabela .= '</tr>';
		}
		 
		$tabela .='</tbody>';
		$tabela .= '</table>';

		// Força o Download do Arquivo Gerado
		header ('Cache-Control: no-cache, must-revalidate');
		header ('Pragma: no-cache');
		header ('Content-Type: application/x-msexcel');
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"");
		echo $tabela;
	}
}

?>