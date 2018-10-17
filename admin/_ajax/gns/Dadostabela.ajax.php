
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

    //SELECIONA AÇÃO
  switch ($Case):
    case 'dados_formulario':
    foreach ($PostData as $key => $value) {
      if($PostData[$key] == ''){
        unset($PostData[$key]);
      }
    }
    $aparelhos = [];

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
      'NomeContato' => $PostData['NomeContato'],
      'TelefoneContato' => $PostData['TelContato'],
      'Obs' => $PostData['Obs']
    );

    $Create->ExeCreate("[60_Atendimentos]",$atendimento);
            /////////////////////////////////////////////////////////

    for ($i=1; $i <= 10; $i++) {
      if (isset($PostData['t_CozinhaTipo'.$i])) {
        array_push($aparelhos,array(
          'IdOs' => $PostData['IdOS'],
          'Tipo' => $PostData['t_CozinhaTipo'.$i],
          'Marca' => $PostData['t_CozinhaMarca'.$i],
          'Modelo' => $PostData['t_CozinhaModelo'.$i],
          'PotNominal' => $PostData['t_CozinhaPot'.$i],
          'Tiragem' => $PostData['t_CozinhaTiragem'.$i],
          'Combustao' => $PostData['t_CozinhaCombustao'.$i],
          'Funcionamento' => $PostData['t_CozinhaFuncionamento'.$i],
          'TiragemHigienteCombustao' => $PostData['t_Cozinha_h_Tiragem'.$i],
          'Con' => $PostData['t_Cozinha_h_Con'.$i],
          'CoAmb' => $PostData['t_Cozinha_h_CoAmb'.$i],
          'Tempo' => $PostData['t_Cozinha_h_Tempo'.$i],
          'Analisador' => $PostData['t_Cozinha_h_Analisador'.$i],
          'NumeroDeSerie' => $PostData['t_Cozinha_h_NumSerie'.$i]

        ));
      }


      if (isset($PostData['t_b_SocialTipo'.$i])) {
        array_push($aparelhos,array(
          'IdOs' => $PostData['IdOS'],
          'Tipo' => $PostData['t_b_SocialTipo'.$i],
          'Marca' => $PostData['t_b_SocialMarca'.$i],
          'Modelo' => $PostData['t_b_SocialModelo'.$i],
          'PotNominal' => $PostData['t_b_SocialPot'.$i],
          'Tiragem' => $PostData['t_b_SocialTiragem'.$i],
          'Combustao' => $PostData['t_b_SocialCombustao'.$i],
          'Funcionamento' => $PostData['t_b_SocialFuncionamento'.$i],
          'TiragemHigienteCombustao' => $PostData['t_b_SocialTiragem'.$i],
          'Con' => $PostData['t_b_Social_h_Con'.$i],
          'CoAmb' => $PostData['t_b_Social_h_CoAmb'.$i],
          'Tempo' => $PostData['t_b_Social_h_Tempo'.$i],
          'Analisador' => $PostData['t_b_Social_h_Analisador'.$i],
          'NumeroDeSerie' => $PostData['t_b_Social_h_NumSerie'.$i]
        ));
      }    

      if (isset($PostData['t_b_SuiteTipo'.$i])) {
        array_push($aparelhos,array(
          'IdOs' => $PostData['IdOS'],
          'Tipo' => $PostData['t_b_SuiteTipo'.$i],
          'Marca' => $PostData['t_b_SuiteMarca'.$i],
          'Modelo' => $PostData['t_b_SuiteModelo'.$i],
          'PotNominal' => $PostData['t_b_SuitePot'.$i],
          'Tiragem' => $PostData['t_b_SuiteTiragem'.$i],
          'Combustao' => $PostData['t_b_SuiteCombustao'.$i],
          'Funcionamento' => $PostData['t_b_SuiteFuncionamento'.$i],
          'TiragemHigienteCombustao' => $PostData['t_b_SuiteTiragem'.$i],
          'Con' => $PostData['t_b_Suite_h_Con'.$i],
          'CoAmb' => $PostData['t_b_Suite_h_CoAmb'.$i],
          'Tempo' => $PostData['t_b_Suite_h_Tempo'.$i],
          'Analisador' => $PostData['t_b_Suite_h_Analisador'.$i],
          'NumeroDeSerie' => $PostData['t_b_Suite_h_NumSerie'.$i]
        ));
      }

      if (isset($PostData['t_b_ServicoTipo'.$i])) {
        array_push($aparelhos,array(
          'IdOs' => $PostData['IdOS'],
          'Tipo' => $PostData['t_b_ServicoTipo'.$i],
          'Marca' => $PostData['t_b_ServicoMarca'.$i],
          'Modelo' => $PostData['t_b_ServicoModelo'.$i],
          'PotNominal' => $PostData['t_b_ServicoPot'.$i],
          'Tiragem' => $PostData['t_b_ServicoTiragem'.$i],
          'Combustao' => $PostData['t_b_ServicoCombustao'.$i],
          'Funcionamento' => $PostData['t_b_ServicoFuncionamento'.$i],
          'TiragemHigienteCombustao' => $PostData['t_b_ServicoTiragem'.$i],
          'Con' => $PostData['t_b_Servico_h_Con'.$i],
          'CoAmb' => $PostData['t_b_Servico_h_CoAmb'.$i],
          'Tempo' => $PostData['t_b_Servico_h_Tempo'.$i],
          'Analisador' => $PostData['t_b_Servico_h_Analisador'.$i],
          'NumeroDeSerie' => $PostData['t_b_Servico_h_NumSerie'.$i]
        ));          
      }

      if (isset($PostData['t_a_ServicoTipo'.$i])) {
        array_push($aparelhos,array(
          'IdOs' => $PostData['IdOS'],
          'Tipo' => $PostData['t_a_ServicoTipo'.$i],
          'Marca' => $PostData['t_a_ServicoMarca'.$i],
          'Modelo' => $PostData['t_a_ServicoModelo'.$i],
          'PotNominal' => $PostData['t_a_ServicoPot'.$i],
          'Tiragem' => $PostData['t_a_ServicoTiragem'.$i],
          'Combustao' => $PostData['t_a_ServicoCombustao'.$i],
          'Funcionamento' => $PostData['t_a_ServicoFuncionamento'.$i],
          'TiragemHigienteCombustao' => $PostData['t_a_ServicoTiragem'.$i],
          'Con' => $PostData['t_a_Servico_h_Con'.$i],
          'CoAmb' => $PostData['t_a_Servico_h_CoAmb'.$i],
          'Tempo' => $PostData['t_a_Servico_h_Tempo'.$i],
          'Analisador' => $PostData['t_a_Servico_h_Analisador'.$i],
          'NumeroDeSerie' => $PostData['t_a_Servico_h_NumSerie'.$i]
        ));
      }

      if (isset($PostData['t_OutroTipo'.$i])) {
        array_push($aparelhos,array(
          'IdOs' => $PostData['IdOS'],
          'Tipo' => $PostData['t_OutroTipo'.$i],
          'Marca' => $PostData['t_OutroMarca'.$i],
          'Modelo' => $PostData['t_OutroModelo'.$i],
          'PotNominal' => $PostData['t_OutroPot'.$i],
          'Tiragem' => $PostData['t_OutroTiragem'.$i],
          'Combustao' => $PostData['t_OutroCombustao'.$i],
          'Funcionamento' => $PostData['t_OutroFuncionamento'.$i],
          'TiragemHigienteCombustao' => $PostData['t_Outro_h_Tiragem'.$i],
          'Con' => $PostData['t_Outro_h_Con'.$i],
          'CoAmb' => $PostData['t_Outro_h_CoAmb'.$i],
          'Tempo' => $PostData['t_Outro_h_Tempo'.$i],
          'Analisador' => $PostData['t_Outro_h_Analisador'.$i],
          'NumeroDeSerie' => $PostData['t_Outro_h_NumSerie'.$i]
        ));
      }
    }

    foreach ($aparelhos as $key => $value) {
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
                  $d_Image = (!empty($_FILES['defeitos_fotos_arquivos']) ? $_FILES['defeitos_fotos_arquivos'] : null);
                  $d_Size = (!empty($_FILES['defeitos_fotos_arquivos']['size']) ? array_sum($d_arquivos) : null);
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

                      $jSON['defeitos'] = null;
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
                $m_Image = (!empty($_FILES['medidor_fotos_arquivos']) ? $_FILES['medidor_fotos_arquivos'] : null);
                $m_Size = (!empty($_FILES['medidor_fotos_arquivos']['size']) ? array_sum($m_arquivos) : null);
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
                $s_Image = (!empty($_FILES['servico_fotos_arquivos']) ? $_FILES['servico_fotos_arquivos'] : null);
                $s_Size = (!empty($_FILES['servico_fotos_arquivos']['size']) ? array_sum($s_arquivos) : null);
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

 //SALVAR SOMENTE PEÇAS DE ORÇAMENTO APROVADO
        $totalLinhasPecas = $PostData['o_p_total_linhas'];
        for ($i=0; $i < $totalLinhasPecas ; $i++) {
            $statusOrcamentoP = $PostData['o_aprovado_p'.$i]; 
            $orcamento_pecas = array(
                'IDOrcamento' => $PostData['IdOS'],
                'ID_Pecas' => $PostData['o_id_peca'.$i],
                'Qtd' => $PostData['o_quant_peca'.$i]
            );
            if($statusOrcamentoP == "aprovado"){
                $Create->ExeCreate("[60_OS_PecasAPP]",$orcamento_pecas);
            }
        }

        //SALVAR SOMENTE SERVIÇOS APROVADOS
        $totalLinhasServicos = $PostData['o_s_total_linhas'];
        for ($i= 0; $i < $totalLinhasServicos; $i++) {
            $statusOrcamentoS = $PostData['o_aprovado_s'.$i]; 
            $orcamento_servico = array(
                'IDOrcamento' => $PostData['IdOS'],
                'ID_servico' => $PostData['o_id_servico'.$i],
                'Qtd' => $PostData['o_quant_servico'.$i]
            );

            if($statusOrcamentoS == "aprovado"){
                $Create->ExeCreate("[60_OS_ServicosAPP]",$orcamento_servico);
            }
        }


        //SALVAR ORÇAMENTO APROVADO
        $statusorcamento = $PostData['o_orcamento_status'];
        if($statusorcamento == 1){
              $PostData['TecExe'] = $PostData['IdTecnico'];
            }
        $orcamento = array(
            'IdOS' => $PostData['IdOS'],
            'TecnicoEnt' => $PostData['IdTecnico'],
            'Status' => $PostData['o_orcamento_status'],
            'Valor' => $PostData['o_valor_total_orcamento'],
            'FormaPagamento' => $PostData['o_forma_de_pagamento'],
            'NumParcelas' => $PostData['O_quant_parcelas'],
            'TecExe'  => $PostData['TecExe'],
            'DataExe' => $statusorcamento == 1? $Data->format('Ymd H:i:s'): NULL
  
        );

        $Create->ExeCreate("[60_Orcamentos]",$orcamento);

        //SALVAR ORÇAMENTO PEÇAS E SERVIÇOS REPROVADOS
        $orcamentor = array(
            'IdOS' => $PostData['IdOS'],
            'TecnicoEnt' => $PostData['IdTecnico'],
            'Status' => $PostData['o_orcamento_status'] = 2,
            'Valor' => $PostData['o_valor_total_orcamento_r'],
            'FormaPagamento' => $PostData['o_forma_de_pagamento'],
            'NumParcelas' => $PostData['O_quant_parcelas'],
            'TecExe' => $PostData['TecExe'] = $PostData['IdTecnico'],
            'DataExe' => $statusorcamento == 1? $Data->format('Ymd H:i:s'): NULL
        );

        if($PostData['o_valor_total_orcamento_r'] != $PostData['o_valor_total_orcamento']){
            $Create->ExeCreate("[60_Orcamentos]",$orcamentor);

            //SALVAR TODAS AS PEÇAS DE ORÇAMENTO REPROVADO
            for ($i=0; $i < $totalLinhasPecas ; $i++) { 
                $orcamento_pecas = array(
                    'IDOrcamento' => $PostData['IdOS'],
                    'ID_Pecas' => $PostData['o_id_peca'.$i],
                    'Qtd' => $PostData['o_quant_peca'.$i]
                );
                    $Create->ExeCreate("[60_OS_PecasAPP]",$orcamento_pecas);
            }

            //SALVAR TODOS OS SERVIÇOS DE ORÇAMENTO REPROVADO
            for ($i= 0; $i < $totalLinhasServicos; $i++) { 
                $orcamento_servico = array(
                    'IDOrcamento' => $PostData['IdOS'],
                    'ID_servico' => $PostData['o_id_servico'.$i],
                    'Qtd' => $PostData['o_quant_servico'.$i]
                );

                $Create->ExeCreate("[60_OS_ServicosAPP]",$orcamento_servico);
            }
        }


                
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
            endif;
