
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
$jSON = NULL;
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

    //SELECIONA AÇÃO
  switch ($Case):
    case 'dados_formulario':
    foreach ($PostData as $key => $value) {
      if($PostData[$key] == ''){
        unset($PostData[$key]);
      }
    }
    $aparelhos = [];
    $aparelhos2 = [];

    //SALVANDO O ATENDIMENTO
    $atendimento = array(

      'idOS' => $PostData['IdOS'],
      'idTecnico' => $PostData['IdTecnico'],
      'Status' => 1,
      'NumManometro' => $PostData['t_num_manometro'],
      'PressaoInicial' => $PostData['t_p_inicial'],
      'PressaoFinal' => $PostData['t_p_Final'],
      'TempoTeste' => $PostData['t_tempo_teste'],
      'StatusTeste' => isset($PostData['t_1status']) ? $PostData['t_1status'] : NULL,
      'NumOcorrencia' => isset($PostData['t_num_ocorrencia']) ? $PostData['t_num_ocorrencia'] : NULL,
      'Defeito' => isset($PostData['t_2status']) ? $PostData['t_2status'] : NULL,
      'DataAtendimento' => $Data->format('Ymd H:i:s'),
      'NomeContato' => isset($PostData['NomeContato'])?$PostData['NomeContato'] : NULL,
      'TelefoneContato' => isset($PostData['TelContato']) ? $PostData['TelContato'] : NULL,
      'Obs' => isset($PostData['Obs']) ? $PostData['Obs'] : NULL 
    );

    $idOsExist = $PostData['IdOS'];
    $Read->FullRead("SELECT [IdOS] FROM [BDNVT].[dbo].[60_Atendimentos] WHERE [IdOS] = {$idOsExist};");
    if($Read->getResult() == NULL){
      $Create->ExeCreate("[60_Atendimentos]",$atendimento);
    }else{
      $Update->ExeUpdate("[60_Atendimentos]",$atendimento, "WHERE IdOS = :idos", "idos={$PostData['IdOS']}");
    }
            /////////////////////////////////////////////////////////

    for ($i=1; $i <= 10; $i++) {
      if (isset($PostData['t_CozinhaTipo'.$i])) {

        array_push($aparelhos2,array(
          'IdOs' => $PostData['IdOS'],
          'Tipo' => $PostData['t_CozinhaTipo'.$i],
          'Marca' => $PostData['t_CozinhaMarca'.$i],
          'Modelo' => $PostData['t_CozinhaModelo'.$i],
          'PotNominal' => $PostData['t_CozinhaPot'.$i],
          'Tiragem' => isset($PostData['t_CozinhaTiragem'.$i]) ? $PostData['t_CozinhaTiragem'.$i] : NULL,
          'Combustao' => isset($PostData['t_CozinhaCombustao'.$i]) ? $PostData['t_CozinhaCombustao'.$i] : NULL,
          'Funcionamento' => isset($PostData['t_CozinhaFuncionamento'.$i]) ? $PostData['t_CozinhaFuncionamento'.$i] : NULL,
          'TiragemHigienteCombustao' => isset($PostData['t_Cozinha_h_Tiragem'.$i]) ? $PostData['t_Cozinha_h_Tiragem'.$i] : NULL,
          'Con' => isset($PostData['t_Cozinha_h_Con'.$i]) ? $PostData['t_Cozinha_h_Con'.$i] : NULL,
          'CoAmb' => isset($PostData['t_Cozinha_h_CoAmb'.$i]) ? $PostData['t_Cozinha_h_CoAmb'.$i] : NULL,
          'Tempo' => isset($PostData['t_Cozinha_h_Tempo'.$i]) ? $PostData['t_Cozinha_h_Tempo'.$i] : NULL,
          'Analisador' => isset($PostData['t_Cozinha_h_Analisador'.$i]) ? $PostData['t_Cozinha_h_Analisador'.$i] : NULL,
          'NumeroDeSerie' => isset($PostData['t_Cozinha_h_NumSerie'.$i]) ? $PostData['t_Cozinha_h_NumSerie'.$i] : NULL

        ));
      }


      if (isset($PostData['t_b_SocialTipo'.$i])) {
        array_push($aparelhos2,array(
          'IdOs' => $PostData['IdOS'],
          'Tipo' => $PostData['t_b_SocialTipo'.$i],
          'Marca' => $PostData['t_b_SocialMarca'.$i],
          'Modelo' => $PostData['t_b_SocialModelo'.$i],
          'PotNominal' => $PostData['t_b_SocialPot'.$i],
          'Tiragem' => isset($PostData['t_b_SocialTiragem'.$i]) ? $PostData['t_b_SocialTiragem'.$i] : NULL,
          'Combustao' => isset($PostData['t_b_SocialCombustao'.$i]) ? $PostData['t_b_SocialCombustao'.$i] : NULL,
          'Funcionamento' => isset($PostData['t_b_SocialFuncionamento'.$i]) ? $PostData['t_b_SocialFuncionamento'.$i] : NULL,
          'TiragemHigienteCombustao' => isset($PostData['t_b_Social_h_Tiragem'.$i]) ? $PostData['t_b_Social_h_Tiragem'.$i] : NULL,
          'Con' => isset($PostData['t_b_Social_h_Con'.$i]) ? $PostData['t_b_Social_h_Con'.$i] : NULL,
          'CoAmb' => isset($PostData['t_b_Social_h_CoAmb'.$i]) ? $PostData['t_b_Social_h_CoAmb'.$i] : NULL,
          'Tempo' => isset($PostData['t_b_Social_h_Tempo'.$i]) ? $PostData['t_b_Social_h_Tempo'.$i] : NULL,
          'Analisador' => isset($PostData['t_b_Social_h_Analisador'.$i]) ? $PostData['t_b_Social_h_Analisador'.$i] : NULL,
          'NumeroDeSerie' => isset($PostData['t_b_Social_h_NumSerie'.$i]) ? $PostData['t_b_Social_h_NumSerie'.$i] : NULL
        ));
      }    

      if (isset($PostData['t_b_SuiteTipo'.$i])) {
        array_push($aparelhos2,array(
          'IdOs' => $PostData['IdOS'],
          'Tipo' => $PostData['t_b_SuiteTipo'.$i],
          'Marca' => $PostData['t_b_SuiteMarca'.$i],
          'Modelo' => $PostData['t_b_SuiteModelo'.$i],
          'PotNominal' => $PostData['t_b_SuitePot'.$i],
          'Tiragem' => isset($PostData['t_b_SuiteTiragem'.$i]) ? $PostData['t_b_SuiteTiragem'.$i] : NULL,
          'Combustao' => isset($PostData['t_b_SuiteCombustao'.$i]) ? $PostData['t_b_SuiteCombustao'.$i] : NULL,
          'Funcionamento' => isset($PostData['t_b_SuiteFuncionamento'.$i]) ? $PostData['t_b_SuiteFuncionamento'.$i] : NULL,
          'TiragemHigienteCombustao' => isset($PostData['t_b_Suite_h_Tiragem'.$i]) ? $PostData['t_b_Suite_h_Tiragem'.$i] : NULL,
          'Con' => isset($PostData['t_b_Suite_h_Con'.$i]) ? $PostData['t_b_Suite_h_Con'.$i] : NULL,
          'CoAmb' => isset($PostData['t_b_Suite_h_CoAmb'.$i]) ? $PostData['t_b_Suite_h_CoAmb'.$i] : NULL,
          'Tempo' => isset($PostData['t_b_Suite_h_Tempo'.$i]) ? $PostData['t_b_Suite_h_Tempo'.$i] : NULL,
          'Analisador' => isset($PostData['t_b_Suite_h_Analisador'.$i]) ? $PostData['t_b_Suite_h_Analisador'.$i] : NULL,
          'NumeroDeSerie' => isset($PostData['t_b_Suite_h_NumSerie'.$i]) ? $PostData['t_b_Suite_h_NumSerie'.$i] : NULL
        ));
      }

      if (isset($PostData['t_b_ServicoTipo'.$i])) {
        array_push($aparelhos2,array(
          'IdOs' => $PostData['IdOS'],
          'Tipo' => $PostData['t_b_ServicoTipo'.$i],
          'Marca' => $PostData['t_b_ServicoMarca'.$i],
          'Modelo' => $PostData['t_b_ServicoModelo'.$i],
          'PotNominal' => $PostData['t_b_ServicoPot'.$i],
          'Tiragem' => isset($PostData['t_b_ServicoTiragem'.$i]) ? $PostData['t_b_ServicoTiragem'.$i] : NULL,
          'Combustao' => isset($PostData['t_b_ServicoCombustao'.$i]) ? $PostData['t_b_ServicoCombustao'.$i] : NULL,
          'Funcionamento' => isset($PostData['t_b_ServicoFuncionamento'.$i]) ? $PostData['t_b_ServicoFuncionamento'.$i] : NULL,
          'TiragemHigienteCombustao' => isset($PostData['t_b_Servico_h_Tiragem'.$i]) ? $PostData['t_b_Servico_h_Tiragem'.$i] : NULL,
          'Con' => isset($PostData['t_b_Servico_h_Con'.$i]) ? $PostData['t_b_Servico_h_Con'.$i] : NULL,
          'CoAmb' => isset($PostData['t_b_Servico_h_CoAmb'.$i]) ? $PostData['t_b_Servico_h_CoAmb'.$i] : NULL,
          'Tempo' => isset($PostData['t_b_Servico_h_Tempo'.$i]) ? $PostData['t_b_Servico_h_Tempo'.$i] : NULL,
          'Analisador' => isset($PostData['t_b_Servico_h_Analisador'.$i]) ? $PostData['t_b_Servico_h_Analisador'.$i] : NULL,
          'NumeroDeSerie' => isset($PostData['t_b_Servico_h_NumSerie'.$i]) ? $PostData['t_b_Servico_h_NumSerie'.$i] : NULL
        ));          
      }

      if (isset($PostData['t_a_ServicoTipo'.$i])) {
        array_push($aparelhos2,array(
          'IdOs' => $PostData['IdOS'],
          'Tipo' => $PostData['t_a_ServicoTipo'.$i],
          'Marca' => $PostData['t_a_ServicoMarca'.$i],
          'Modelo' => $PostData['t_a_ServicoModelo'.$i],
          'PotNominal' => $PostData['t_a_ServicoPot'.$i],
          'Tiragem' => isset($PostData['t_a_ServicoTiragem'.$i]) ? $PostData['t_a_ServicoTiragem'.$i] : NULL,
          'Combustao' => isset($PostData['t_a_ServicoCombustao'.$i]) ? $PostData['t_a_ServicoCombustao'.$i] : NULL,
          'Funcionamento' => isset($PostData['t_a_ServicoFuncionamento'.$i]) ? $PostData['t_a_ServicoFuncionamento'.$i] : NULL,
          'TiragemHigienteCombustao' => isset($PostData['t_a_Servico_h_Tiragem'.$i]) ? $PostData['t_a_Servico_h_Tiragem'.$i] : NULL,
          'Con' => isset($PostData['t_a_Servico_h_Con'.$i]) ? $PostData['t_a_Servico_h_Con'.$i] : NULL,
          'CoAmb' => isset($PostData['t_a_Servico_h_CoAmb'.$i]) ? $PostData['t_a_Servico_h_CoAmb'.$i] : NULL,
          'Tempo' => isset($PostData['t_a_Servico_h_Tempo'.$i]) ? $PostData['t_a_Servico_h_Tempo'.$i] : NULL,
          'Analisador' => isset($PostData['t_a_Servico_h_Analisador'.$i]) ? $PostData['t_a_Servico_h_Analisador'.$i] : NULL,
          'NumeroDeSerie' => isset($PostData['t_a_Servico_h_NumSerie'.$i]) ? $PostData['t_a_Servico_h_NumSerie'.$i] : NULL
        ));
      }

      if (isset($PostData['t_OutroTipo'.$i])) {
        array_push($aparelhos2,array(
          'IdOs' => $PostData['IdOS'],
          'Tipo' => $PostData['t_OutroTipo'.$i],
          'Marca' => $PostData['t_OutroMarca'.$i],
          'Modelo' => $PostData['t_OutroModelo'.$i],
          'PotNominal' => $PostData['t_OutroPot'.$i],
          'Tiragem' => isset($PostData['t_OutroTiragem'.$i]) ? $PostData['t_OutroTiragem'.$i] : NULL,
          'Combustao' => isset($PostData['t_OutroCombustao'.$i]) ? $PostData['t_OutroCombustao'.$i] : NULL,
          'Funcionamento' => isset($PostData['t_OutroFuncionamento'.$i]) ? $PostData['t_OutroFuncionamento'.$i] : NULL,
          'TiragemHigienteCombustao' => isset($PostData['t_Outro_h_Tiragem'.$i]) ? $PostData['t_Outro_h_Tiragem'.$i] : NULL,
          'Con' => isset($PostData['t_Outro_h_Con'.$i]) ? $PostData['t_Outro_h_Con'.$i] : NULL,
          'CoAmb' => isset($PostData['t_Outro_h_CoAmb'.$i]) ? $PostData['t_Outro_h_CoAmb'.$i] : NULL,
          'Tempo' => isset($PostData['t_Outro_h_Tempo'.$i]) ? $PostData['t_Outro_h_Tempo'.$i] : NULL,
          'Analisador' => isset($PostData['t_Outro_h_Analisador'.$i]) ? $PostData['t_Outro_h_Analisador'.$i] : NULL,
          'NumeroDeSerie' => isset($PostData['t_Outro_h_NumSerie'.$i]) ? $PostData['t_Outro_h_NumSerie'.$i] : NULL
        ));
      }
    }

    foreach ($aparelhos2 as $key => $value) {
      $Create->ExeCreate("[60_TesteAparelho]",$value);
    }

                  // DEFEITOS
                  // DISTRIBUIÇÃO INTERNA
                  for ($i=1; $i <= 23; $i++) {
                    if (isset($PostData['d-dist-interna-'.$i])) {
                      array_push($aparelhos,array(

                        'IdOs' => $PostData['IdOS'],
                        'ItemInspecao' => $i,
                        'InstalacaoInterna' => $PostData['d-dist-interna-'.$i]
                      ));
                    }
                  }

                  // APARELHO A GÁS
                  for ($i=1; $i <= 29; $i++) {
                   if (isset($PostData['d_ap-gas_'.$i.'-1'])) {
                    array_push($aparelhos,array(                                       
                      'IdOs' => $PostData['IdOS'],
                      'ItemInspecao' => $i + 23,
                      'Aparelho1' => $PostData['d_ap-gas_'.$i.'-1'],
                      'Aparelho2' => $PostData['d_ap-gas_'.$i.'-2'],
                      'Aparelho3' => $PostData['d_ap-gas_'.$i.'-3']
                    ));
                  }
                }

                // LIGAÇÕES DOS APARELHOS A GÁS
                for ($i=1; $i <= 9; $i++) {

                 if (isset($PostData['d_liga-ap_'.$i.'_1'])) {
                  array_push($aparelhos,array(                                       
                    'IdOs' => $PostData['IdOS'],
                    'ItemInspecao' => $i + 52,
                    'Aparelho1' => $PostData['d_liga-ap_'.$i.'_1'],
                    'Aparelho2' => $PostData['d_liga-ap_'.$i.'_2'],
                    'Aparelho3' => $PostData['d_liga-ap_'.$i.'_3']          
                  ));
                    }  // isset
                  }


                // INDIVIDUAL DE EXAUSTÃO NATURAL E FORÇADA
                  for ($i=1; $i <= 14; $i++) {

                   if (isset($PostData['d_ind-exaust_'.$i.'-1'])) {
                    array_push($aparelhos,array(                                       
                      'IdOs' => $PostData['IdOS'],
                      'ItemInspecao' => $i + 61,
                      'Aparelho1' =>  $PostData['d_ind-exaust_'.$i.'-1'],
                      'Aparelho2' => $PostData['d_ind-exaust_'.$i.'-2'],
                      'Aparelho3' => $PostData['d_ind-exaust_'.$i.'-3']          
                    ));
                  }  // isset
                }


                // COLETIVO DE EXAUSTÃO NATURAL E FORÇADA
                for ($i=1; $i <= 7; $i++) {

                 if (isset($PostData['d_cole-exaust_'.$i.'-1'])) {
                  array_push($aparelhos,array(                                        
                    'IdOs' => $PostData['IdOS'],
                    'ItemInspecao' => $i + 75,
                    'Aparelho1' => $PostData['d_cole-exaust_'.$i.'-1'],
                    'Aparelho2' => $PostData['d_cole-exaust_'.$i.'-2'],
                    'Aparelho3' => $PostData['d_cole-exaust_'.$i.'-3']          
                  ));
                  }  // isset
                }

                // CARACTERÍSTICAS HIGIÊNICAS DA COMBUSTÃO
                for ($i=1; $i <= 3; $i++) {
                 if (isset($PostData['d_caract-higi_'.$i.'-1'])) {
                  array_push($aparelhos,array(                                      
                    'IdOs' => $PostData['IdOS'],
                    'ItemInspecao' => $i + 82,
                    'Aparelho1' => $PostData['d_caract-higi_'.$i.'-1'],
                    'Aparelho2' => $PostData['d_caract-higi_'.$i.'-2'],
                    'Aparelho3' => $PostData['d_caract-higi_'.$i.'-3']          
                  ));
                  }  // isset
                }

                // RECOMENDAÇÕES
                for ($i=1; $i <= 6; $i++) {
                 if (isset($PostData['d_reco-'.$i.'_1'])) {
                  array_push($aparelhos,array(                                                                     
                    'IdOs' => $PostData['IdOS'],
                    'ItemInspecao' => $i + 85,
                    'InstalacaoInterna' => $PostData['d_reco-'.$i.'_1'],
                    'Aparelho1' => $PostData['d_reco-'.$i.'_2'],
                    'Aparelho2' => $PostData['d_reco-'.$i.'_3'],
                    'Aparelho3' => $PostData['d_reco-'.$i.'_4']          
                  ));
                  }  // isset
                }

                //var_dump($aparelhos);
                foreach ($aparelhos as $key => $value) {
                  $Create->ExeCreate("[60_Defeitos]",$value);
                }


               // FOTOS DEFEITOS                
                if (empty($Upload)):
                  $Upload = new Upload('../../../uploads/');
                endif;

                if(isset($_FILES['defeitos_fotos_arquivos'])){
                  $d_title = "Defeitos";
                  $d_arquivos = array($_FILES['defeitos_fotos_arquivos']['size']);
                  $d_GalleryId = $PostData['IdOS'];
                  $d_Image = (!empty($_FILES['defeitos_fotos_arquivos']) ? $_FILES['defeitos_fotos_arquivos'] : NULL);
                  $d_Size = (!empty($_FILES['defeitos_fotos_arquivos']['size']) ? array_sum($d_arquivos) : NULL);
                  $d_GalleryName = Check::Name($d_title);

                  if (!empty($d_Image)):
                    $d_File = $d_Image;
                    $d_gbFile = array();
                    $d_gbCount = count($d_File['type']);
                    $d_gbKeys = array_keys($d_File);
                    $d_gbLoop = 0;

                    if ($d_gbCount > 10):
                      $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>QUANTIDADE DE FOTOS SUPERIOR A 10 FOTOS!</b>");
                    else:
                      for ($gb = 0; $gb < $d_gbCount; $gb++):
                        foreach ($d_gbKeys as $Keys):
                          $d_gbFiles[$gb][$Keys] = $d_File[$Keys][$gb];
                        endforeach;
                      endfor;

                     // $jSON['defeitos'] = NULL;
                      foreach ($d_gbFiles as $d_UploadFile):
                        $d_gbLoop ++;
                        $Upload->Image($d_UploadFile, "{$d_title}". time(), IMAGE_W, 'images');

                        if ($Upload->getResult()):
                          $d_gbCreate = array('OS' => $d_GalleryId, 'Arquivo' => $Upload->getResult(), 'Tipo' => 3);
                             
                          $Create->ExeCreate('[60_OS_Fotos]', $d_gbCreate);

                        endif;
                      endforeach;
                    endif;
                  endif;
                }
                
                        // FOTOS MEDIDOR
                $m_title = "Medidor";
                $m_arquivos = array($_FILES['medidor_fotos_arquivos']['size']);
                $m_GalleryId = $PostData['IdOS'];
                $m_Image = (!empty($_FILES['medidor_fotos_arquivos']) ? $_FILES['medidor_fotos_arquivos'] : NULL);
                $m_Size = (!empty($_FILES['medidor_fotos_arquivos']['size']) ? array_sum($m_arquivos) : NULL);
                $m_GalleryName = Check::Name($m_title);

                if (!empty($m_Image)):
                  $m_File = $m_Image;
                  $m_gbFile = array();
                  $m_gbCount = count($m_File['type']);
                  $m_gbKeys = array_keys($m_File);
                  $m_gbLoop = 0;

             
                  if ($m_gbCount > 10):
                    $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>QUANTIDADE DE FOTOS SUPERIOR A 10 FOTOS!</b>");
                  else:
                    for ($gb = 0; $gb < $m_gbCount; $gb++):
                      foreach ($m_gbKeys as $Keys):
                        $m_gbFiles[$gb][$Keys] = $m_File[$Keys][$gb];
                      endforeach;
                    endfor;
                              
                    foreach ($m_gbFiles as $m_UploadFile):
                      $m_gbLoop ++;
                      $Upload->Image($m_UploadFile, "{$m_title}". time(), IMAGE_W, 'images');

                      if ($Upload->getResult()):
                        $m_gbCreate = array('OS' => $m_GalleryId, 'Arquivo' => $Upload->getResult(), 'Tipo' => 1);
                                    
                        $Create->ExeCreate('[60_OS_Fotos]', $m_gbCreate);

                      endif;
                    endforeach;
                  endif;
                endif;
                          // FOTOS SERVIÇO
                $s_title = "Servicos";
                $s_arquivos = array($_FILES['servico_fotos_arquivos']['size']);
                $s_GalleryId = $PostData['IdOS'];
                $s_Image = (!empty($_FILES['servico_fotos_arquivos']) ? $_FILES['servico_fotos_arquivos'] : NULL);
                $s_Size = (!empty($_FILES['servico_fotos_arquivos']['size']) ? array_sum($s_arquivos) : NULL);
                $s_GalleryName = Check::Name($s_title);

                    
                if (!empty($s_Image)):
                  $s_File = $s_Image;
                  $s_gbFile = array();
                  $s_gbCount = count($s_File['type']);
                  $s_gbKeys = array_keys($s_File);
                  $s_gbLoop = 0;

        
                  if ($s_gbCount > 10):
                    $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>QUANTIDADE DE FOTOS SUPERIOR A 10 FOTOS!</b>");
                  else:
                    for ($gb = 0; $gb < $s_gbCount; $gb++):
                      foreach ($s_gbKeys as $Keys):
                        $s_gbFiles[$gb][$Keys] = $s_File[$Keys][$gb];
                      endforeach;
                    endfor;
                         
                    foreach ($s_gbFiles as $s_UploadFile):
                      $s_gbLoop ++;
                      $Upload->Image($s_UploadFile, "{$s_title}". time(), IMAGE_W, 'images');

                      if ($Upload->getResult()):
                        $s_gbCreate = array('OS' => $s_GalleryId, 'Arquivo' => $Upload->getResult(), 'Tipo' => 2);
                                  
                        $Create->ExeCreate('[60_OS_Fotos]', $s_gbCreate);

                      endif;
                    endforeach;
                  endif;
                endif;

        //VERIFICA O STATUS DO ORÇAMENTO
        $statusorcamento = $PostData['o_orcamento_status'];
        $statusOs = $PostData['o_os_status'];

        if($statusorcamento == 2){
          $PostData['TecExe'] = $PostData['IdTecnico'];
        }else{
          $PostData['TecExe'] = NULL;
        }

        //ALTERA O STATUS DA OS NA TABELA 60_OS
        $statusOS = ['Status' => $statusOs];
        $Update->ExeUpdate("[60_OS]",$statusOS, "WHERE OT = :ot", "ot={$PostData['IdOS']}");

        //SALVAR ORÇAMENTO APROVADO
        $orcamento = array(
            'IdOS' => $PostData['IdOS'],
            'TecnicoEnt' => $PostData['IdTecnico'],
            'Status' => $PostData['o_orcamento_status'],
            'Valor' => $PostData['o_valor_total_orcamento'],
            'FormaPagamento' => $PostData['o_forma_de_pagamento'],
            'NumParcelas' => isset($PostData['O_quant_parcelas']) ? $PostData['O_quant_parcelas'] : 1,
            'TecExe'  => $PostData['TecExe'],
            'DataExe' => $statusorcamento == 2? $Data->format('Ymd H:i:s') : NULL
  
        );
        
        //CRIA ORÇAMENTO E SALVA O ID DO ULTIMO ORÇAMENTO CRIADO
        $Create->ExeCreate("[60_Orcamentos]",$orcamento);
        $idOrcamento = $Create->getResult();

        //SALVAR SOMENTE PEÇAS DE ORÇAMENTO APROVADO
        if($idOrcamento > 0){
          $totalLinhasPecas = $PostData['o_p_total_linhas'];
          for ($i=0; $i < $totalLinhasPecas ; $i++) {
              $statusOrcamentoP = isset($PostData['o_aprovado_p'.$i]) ? $PostData['o_aprovado_p'.$i] : NULL; 
              $orcamento_pecas = array(
                  'IDOrcamento' => $idOrcamento,
                  'ID_Pecas' => $PostData['o_id_peca'.$i],
                  'Qtd' => $PostData['o_quant_peca'.$i],
                  'Valor' => $PostData['o_v_unitp'.$i]
              );
              if($statusOrcamentoP == "aprovado"){
                  $Create->ExeCreate("[60_OS_PecasAPP]",$orcamento_pecas);
              }
          }

          //SALVAR SOMENTE SERVIÇOS APROVADOS
          $totalLinhasServicos = $PostData['o_s_total_linhas'];
          for ($i= 0; $i < $totalLinhasServicos; $i++) {
              $statusOrcamentoS = isset($PostData['o_aprovado_s'.$i]) ? $PostData['o_aprovado_s'.$i] : NULL; 
              $orcamento_servico = array(
                  'IDOrcamento' => $idOrcamento,
                  'ID_servico' => $PostData['o_id_servico'.$i],
                  'Qtd' => $PostData['o_quant_servico'.$i],
                  'Valor' => $PostData['o_v_units'.$i]
              );

              if($statusOrcamentoS == "aprovado"){
                  $Create->ExeCreate("[60_OS_ServicosAPP]",$orcamento_servico);
              }
          }

          //SE STATUS DO ORÇAMENTO FOR APROVADO GERA UMA LINHA NA TABELA 60_ClientesSemOT
          if($statusorcamento == 1){
            $idOt = NULL;
            $clientesSemOT = array(
              'IDCLIENTE' => $PostData['IdDoCliente'],
              'IDOT' =>  $idOt,
              'DATAAGENDAMENTO' => $PostData['o_data_agendamento'],
              'USUARIOSISTEMA' => $PostData['USUARIOSISTEMA'],
              'IDORCAMENTO' => $idOrcamento
            );
            $Create->Execreate("[60_ClientesSemOT]",$clientesSemOT);
          }
        }


        //SALVAR ORÇAMENTO,PEÇAS E SERVIÇOS REPROVADOS
        $orcamentor = array(
            'IdOS' => $PostData['IdOS'],
            'TecnicoEnt' => $PostData['IdTecnico'],
            'Status' => $PostData['o_orcamento_status'] = 2,
            'Valor' => $PostData['o_valor_total_orcamento_r'],
            'FormaPagamento' => $PostData['o_forma_de_pagamento'],
            'NumParcelas' => isset($PostData['O_quant_parcelas']) ? $PostData['O_quant_parcelas'] : 1,
        );

        if($PostData['o_valor_total_orcamento_r'] > 0){
              $Create->ExeCreate("[60_Orcamentos]",$orcamentor);


              //SALVA O ID DO ÚLTIMO ORÇAMENTO CRIADO
              $idOrcamentor = $Create->getResult();
              if($idOrcamentor > $idOrcamento){

              //SALVAR SOMENTE AS PEÇAS DE ORÇAMENTO REPROVADO
                for ($i=0; $i < $totalLinhasPecas ; $i++) {
                  $statusOrcamentoP = isset($PostData['o_aprovado_p'.$i]) ? $PostData['o_aprovado_p'.$i] : NULL; 
                    $orcamento_pecas = array(
                        'IDOrcamento' => $idOrcamentor,
                        'ID_Pecas' => $PostData['o_id_peca'.$i],
                        'Qtd' => $PostData['o_quant_peca'.$i],
                        'Valor' => $PostData['o_v_unitp'.$i]
                    );
                    if($statusOrcamentoP != "aprovado"){
                        $Create->ExeCreate("[60_OS_PecasAPP]",$orcamento_pecas);
                    }
                }

                //SALVAR TODOS OS SERVIÇOS DE ORÇAMENTO REPROVADO
                for ($i= 0; $i < $totalLinhasServicos; $i++) { 
                    $statusOrcamentoS = isset($PostData['o_aprovado_s'.$i]) ? $PostData['o_aprovado_s'.$i] : NULL;
                    $orcamento_servico = array(
                        'IDOrcamento' => $idOrcamentor,
                        'ID_servico' => $PostData['o_id_servico'.$i],
                        'Qtd' => $PostData['o_quant_servico'.$i],
                        'Valor' => $PostData['o_v_units'.$i]
                    );
                    if($statusOrcamentoS != "aprovado"){
                      $Create->ExeCreate("[60_OS_ServicosAPP]",$orcamento_servico);
                    }
                }
            }
        }



                
                break;    
              endswitch;

    //RETORNA O CALLBACK
              if ($jSON):
                echo json_encode($jSON);
              else:
                $jSON['trigger'] = AjaxErro(' Oçamento Criado com sucesso!');
                echo json_encode($jSON);
              endif;
            else:
    //ACESSO DIRETO
            endif;
