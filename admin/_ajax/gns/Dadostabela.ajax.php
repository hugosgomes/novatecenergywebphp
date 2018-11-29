
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
      'Status' => $PostData['o_os_status'],
      'NumManometro' => $PostData['t_num_manometro'],
      'PressaoInicial' => $PostData['t_p_inicial'],
      'PressaoFinal' => $PostData['t_p_Final'],
      'TempoTeste' => $PostData['t_tempo_teste'],
      'StatusTeste' => isset($PostData['t_1status']) ? $PostData['t_1status'] : NULL,
      'NumOcorrencia' => isset($PostData['t_num_ocorrencia']) ? $PostData['t_num_ocorrencia'] : NULL,
      'Defeito' => isset($PostData['t_2status']) ? $PostData['t_2status'] : NULL,
      'DataAtendimento' => isset($PostData['dataInicio']) ? $PostData['dataInicio'] : NULL,
      'DataSaida' => isset($PostData['dataSaida']) ? $PostData['dataSaida'] : NULL,
      'Gas' => isset($PostData['t_inf_gas']) ? $PostData['t_inf_gas'] : NULL,
      'Ramificacao' => isset($PostData['t_inf_ramif']) ? $PostData['t_inf_ramif'] : NULL,
      'Diametro' => isset($PostData['t_inf_diametro']) ? $PostData['t_inf_diametro'] : NULL,
      'Material' => isset($PostData['t_inf_material']) ? $PostData['t_inf_material'] : NULL,
      'Pressao' => isset($PostData['t_inf_pressao']) ? $PostData['t_inf_pressao'] : NULL,
      'NomeContato' => isset($PostData['NomeContato'])?$PostData['NomeContato'] : NULL,
      'Latitude' => isset($PostData['Latitude']) ? $PostData['Latitude'] : NULL,
      'Longitude' => isset($PostData['Longitude']) ? $PostData['Longitude'] : NULL,
      'TelefoneContato' => isset($PostData['TelContato']) ? $PostData['TelContato'] : NULL,
      'CpfContato' => isset($PostData['CPFContato']) ? $PostData['CPFContato'] : NULL,
      'Obs' => isset($PostData['Obs']) ? $PostData['Obs'] : NULL 
    );

    // ATUALIZA STATUS DA OS EM 60_OS
    $OS = ['Status' => $PostData['o_os_status']];
    $Update->ExeUpdate("[60_OS]",$OS, "WHERE Id = :idos", "idos={$PostData['IdOS']}");

    // CRIA NOVA LINHA NA TABELA 60_ATENDIMENTOS
    $Create->ExeCreate("[60_Atendimentos]",$atendimento);

            /////////////////////////////////////////////////////////

    for ($i=1; $i <= 10; $i++) {
      if (isset($PostData['t_CozinhaTipoC'.$i])) {

        array_push($aparelhos2,array(
          'IdOs' => $PostData['IdOS'],
          'Tipo' => $PostData['t_CozinhaTipoC'.$i],
          'Marca' => $PostData['t_CozinhaMarcaC'.$i],
          'Modelo' => $PostData['t_CozinhaModeloC'.$i],
          'PotNominal' => $PostData['t_CozinhaPotC'.$i],
          'Tiragem' => isset($PostData['t_CozinhaTiragemC'.$i]) ? $PostData['t_CozinhaTiragemC'.$i] : NULL,
          'Combustao' => isset($PostData['t_CozinhaCombustaoC'.$i]) ? $PostData['t_CozinhaCombustaoC'.$i] : NULL,
          'Funcionamento' => isset($PostData['t_CozinhaFuncionamentoC'.$i]) ? $PostData['t_CozinhaFuncionamentoC'.$i] : NULL,
          'TiragemHigienteCombustao' => isset($PostData['t_Cozinha_h_TiragemC'.$i]) ? $PostData['t_Cozinha_h_TiragemC'.$i] : NULL,
          'Con' => isset($PostData['t_Cozinha_h_ConC'.$i]) ? $PostData['t_Cozinha_h_ConC'.$i] : NULL,
          'CoAmb' => isset($PostData['t_Cozinha_h_CoAmbC'.$i]) ? $PostData['t_Cozinha_h_CoAmbC'.$i] : NULL,
          'Tempo' => isset($PostData['t_Cozinha_h_TempoC'.$i]) ? $PostData['t_Cozinha_h_TempoC'.$i] : NULL,
          'Analisador' => isset($PostData['t_Cozinha_h_AnalisadorC'.$i]) ? $PostData['t_Cozinha_h_AnalisadorC'.$i] : NULL,
          'NumeroDeSerie' => isset($PostData['t_Cozinha_h_NumSerieC'.$i]) ? $PostData['t_Cozinha_h_NumSerieC'.$i] : NULL,
          'Aparelho' => $PostData['t_CozinhaAparelhoC'.$i],
          'Local' => "Cozinha"

        ));
      }


      if (isset($PostData['t_b_SocialTipoBSocial'.$i])) {
        array_push($aparelhos2,array(
          'IdOs' => $PostData['IdOS'],
          'Tipo' => $PostData['t_b_SocialTipoBSocial'.$i],
          'Marca' => $PostData['t_b_SocialMarcaBSocial'.$i],
          'Modelo' => $PostData['t_b_SocialModeloBSocial'.$i],
          'PotNominal' => $PostData['t_b_SocialPotBSocial'.$i],
          'Tiragem' => isset($PostData['t_b_SocialTiragemBSocial'.$i]) ? $PostData['t_b_SocialTiragemBSocial'.$i] : NULL,
          'Combustao' => isset($PostData['t_b_SocialCombustaoBSocial'.$i]) ? $PostData['t_b_SocialCombustaoBSocial'.$i] : NULL,
          'Funcionamento' => isset($PostData['t_b_SocialFuncionamentoBSocial'.$i]) ? $PostData['t_b_SocialFuncionamentoBSocial'.$i] : NULL,
          'TiragemHigienteCombustao' => isset($PostData['t_b_Social_h_TiragemBSocial'.$i]) ? $PostData['t_b_Social_h_TiragemBSocial'.$i] : NULL,
          'Con' => isset($PostData['t_b_Social_h_ConBSocial'.$i]) ? $PostData['t_b_Social_h_ConBSocial'.$i] : NULL,
          'CoAmb' => isset($PostData['t_b_Social_h_CoAmbBSocial'.$i]) ? $PostData['t_b_Social_h_CoAmbBSocial'.$i] : NULL,
          'Tempo' => isset($PostData['t_b_Social_h_TempoBSocial'.$i]) ? $PostData['t_b_Social_h_TempoBSocial'.$i] : NULL,
          'Analisador' => isset($PostData['t_b_Social_h_AnalisadorBSocial'.$i]) ? $PostData['t_b_Social_h_AnalisadorBSocial'.$i] : NULL,
          'NumeroDeSerie' => isset($PostData['t_b_Social_h_NumSerieBSocial'.$i]) ? $PostData['t_b_Social_h_NumSerieBSocial'.$i] : NULL,
          'Aparelho' => $PostData['t_b_SocialAparelhoBSocial'.$i],
          'Local' => "Banheiro Social"
        ));
      }    

      if (isset($PostData['t_b_SuiteTipoBSuite'.$i])) {
        array_push($aparelhos2,array(
          'IdOs' => $PostData['IdOS'],
          'Tipo' => $PostData['t_b_SuiteTipoBSuite'.$i],
          'Marca' => $PostData['t_b_SuiteMarcaBSuite'.$i],
          'Modelo' => $PostData['t_b_SuiteModeloBSuite'.$i],
          'PotNominal' => $PostData['t_b_SuitePotBSuite'.$i],
          'Tiragem' => isset($PostData['t_b_SuiteTiragemBSuite'.$i]) ? $PostData['t_b_SuiteTiragemBSuite'.$i] : NULL,
          'Combustao' => isset($PostData['t_b_SuiteCombustaoBSuite'.$i]) ? $PostData['t_b_SuiteCombustaoBSuite'.$i] : NULL,
          'Funcionamento' => isset($PostData['t_b_SuiteFuncionamentoBSuite'.$i]) ? $PostData['t_b_SuiteFuncionamentoBSuite'.$i] : NULL,
          'TiragemHigienteCombustao' => isset($PostData['t_b_Suite_h_TiragemBSuite'.$i]) ? $PostData['t_b_Suite_h_TiragemBSuite'.$i] : NULL,
          'Con' => isset($PostData['t_b_Suite_h_Con'.$i]) ? $PostData['t_b_Suite_h_ConBSuite'.$i] : NULL,
          'CoAmb' => isset($PostData['t_b_Suite_h_CoAmbBSuite'.$i]) ? $PostData['t_b_Suite_h_CoAmbBSuite'.$i] : NULL,
          'Tempo' => isset($PostData['t_b_Suite_h_TempoBSuite'.$i]) ? $PostData['t_b_Suite_h_TempoBSuite'.$i] : NULL,
          'Analisador' => isset($PostData['t_b_Suite_h_AnalisadorBSuite'.$i]) ? $PostData['t_b_Suite_h_AnalisadorBSuite'.$i] : NULL,
          'NumeroDeSerie' => isset($PostData['t_b_Suite_h_NumSerieBSuite'.$i]) ? $PostData['t_b_Suite_h_NumSerieBSuite'.$i] : NULL,
          'Aparelho' => $PostData['t_b_SuiteAparelhoBSuite'.$i],
          'Local' => "Banheiro Suite"
        ));
      }

      if (isset($PostData['t_b_ServicoTipoBServico'.$i])) {
        array_push($aparelhos2,array(
          'IdOs' => $PostData['IdOS'],
          'Tipo' => $PostData['t_b_ServicoTipoBServico'.$i],
          'Marca' => $PostData['t_b_ServicoMarcaBServico'.$i],
          'Modelo' => $PostData['t_b_ServicoModeloBServico'.$i],
          'PotNominal' => $PostData['t_b_ServicoPotBServico'.$i],
          'Tiragem' => isset($PostData['t_b_ServicoTiragemBServico'.$i]) ? $PostData['t_b_ServicoTiragemBServico'.$i] : NULL,
          'Combustao' => isset($PostData['t_b_ServicoCombustaoBServico'.$i]) ? $PostData['t_b_ServicoCombustaoBServico'.$i] : NULL,
          'Funcionamento' => isset($PostData['t_b_ServicoFuncionamentoBServico'.$i]) ? $PostData['t_b_ServicoFuncionamentoBServico'.$i] : NULL,
          'TiragemHigienteCombustao' => isset($PostData['t_b_Servico_h_TiragemBServico'.$i]) ? $PostData['t_b_Servico_h_TiragemBServico'.$i] : NULL,
          'Con' => isset($PostData['t_b_Servico_h_ConBServico'.$i]) ? $PostData['t_b_Servico_h_ConBServico'.$i] : NULL,
          'CoAmb' => isset($PostData['t_b_Servico_h_CoAmbBServico'.$i]) ? $PostData['t_b_Servico_h_CoAmbBServico'.$i] : NULL,
          'Tempo' => isset($PostData['t_b_Servico_h_TempoBServico'.$i]) ? $PostData['t_b_Servico_h_TempoBServico'.$i] : NULL,
          'Analisador' => isset($PostData['t_b_Servico_h_AnalisadorBServico'.$i]) ? $PostData['t_b_Servico_h_AnalisadorBServico'.$i] : NULL,
          'NumeroDeSerie' => isset($PostData['t_b_Servico_h_NumSerieBServico'.$i]) ? $PostData['t_b_Servico_h_NumSerieBServico'.$i] : NULL,
          'Aparelho' => $PostData['t_b_ServicoAparelhoBServico'.$i],
          'Local' => "Banheiro Serviço"
        ));          
      }

      if (isset($PostData['t_a_ServicoTipoAServico'.$i])) {
        array_push($aparelhos2,array(
          'IdOs' => $PostData['IdOS'],
          'Tipo' => $PostData['t_a_ServicoTipoAServico'.$i],
          'Marca' => $PostData['t_a_ServicoMarcaAServico'.$i],
          'Modelo' => $PostData['t_a_ServicoModeloAServico'.$i],
          'PotNominal' => $PostData['t_a_ServicoPotAServico'.$i],
          'Tiragem' => isset($PostData['t_a_ServicoTiragemAServico'.$i]) ? $PostData['t_a_ServicoTiragemAServico'.$i] : NULL,
          'Combustao' => isset($PostData['t_a_ServicoCombustaoAServico'.$i]) ? $PostData['t_a_ServicoCombustaoAServico'.$i] : NULL,
          'Funcionamento' => isset($PostData['t_a_ServicoFuncionamentoAServico'.$i]) ? $PostData['t_a_ServicoFuncionamentoAServico'.$i] : NULL,
          'TiragemHigienteCombustao' => isset($PostData['t_a_Servico_h_TiragemAServico'.$i]) ? $PostData['t_a_Servico_h_TiragemAServico'.$i] : NULL,
          'Con' => isset($PostData['t_a_Servico_h_ConAServico'.$i]) ? $PostData['t_a_Servico_h_ConAServico'.$i] : NULL,
          'CoAmb' => isset($PostData['t_a_Servico_h_CoAmbAServico'.$i]) ? $PostData['t_a_Servico_h_CoAmbAServico'.$i] : NULL,
          'Tempo' => isset($PostData['t_a_Servico_h_TempoAServico'.$i]) ? $PostData['t_a_Servico_h_TempoAServico'.$i] : NULL,
          'Analisador' => isset($PostData['t_a_Servico_h_AnalisadorAServico'.$i]) ? $PostData['t_a_Servico_h_AnalisadorAServico'.$i] : NULL,
          'NumeroDeSerie' => isset($PostData['t_a_Servico_h_NumSerieAServico'.$i]) ? $PostData['t_a_Servico_h_NumSerieAServico'.$i] : NULL,
          'Aparelho' => $PostData['t_a_ServicoAparelhoAServico'.$i],
          'Local' => "Áarea Serviço"
        ));
      }

      if (isset($PostData['t_OutroTipoO'.$i])) {
        array_push($aparelhos2,array(
          'IdOs' => $PostData['IdOS'],
          'Tipo' => $PostData['t_OutroTipoO'.$i],
          'Marca' => $PostData['t_OutroMarcaO'.$i],
          'Modelo' => $PostData['t_OutroModeloO'.$i],
          'PotNominal' => $PostData['t_OutroPotO'.$i],
          'Tiragem' => isset($PostData['t_OutroTiragemO'.$i]) ? $PostData['t_OutroTiragemO'.$i] : NULL,
          'Combustao' => isset($PostData['t_OutroCombustaoO'.$i]) ? $PostData['t_OutroCombustaoO'.$i] : NULL,
          'Funcionamento' => isset($PostData['t_OutroFuncionamentoO'.$i]) ? $PostData['t_OutroFuncionamentoO'.$i] : NULL,
          'TiragemHigienteCombustao' => isset($PostData['t_Outro_h_TiragemO'.$i]) ? $PostData['t_Outro_h_TiragemO'.$i] : NULL,
          'Con' => isset($PostData['t_Outro_h_ConO'.$i]) ? $PostData['t_Outro_h_ConO'.$i] : NULL,
          'CoAmb' => isset($PostData['t_Outro_h_CoAmbO'.$i]) ? $PostData['t_Outro_h_CoAmbO'.$i] : NULL,
          'Tempo' => isset($PostData['t_Outro_h_TempoO'.$i]) ? $PostData['t_Outro_h_TempoO'.$i] : NULL,
          'Analisador' => isset($PostData['t_Outro_h_AnalisadorO'.$i]) ? $PostData['t_Outro_h_AnalisadorO'.$i] : NULL,
          'NumeroDeSerie' => isset($PostData['t_Outro_h_NumSerieO'.$i]) ? $PostData['t_Outro_h_NumSerieO'.$i] : NULL,
          'Aparelho' => $PostData['t_OutroAparelhoO'.$i],
          'Local' => "Outro"
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
                        'InstalacaoInterna' => $PostData['d-dist-interna-'.$i] == "NULL" ? NULL : $PostData['d-dist-interna-'.$i]
                      ));
                    }
                  }

                  // APARELHO A GÁS
                  for ($i=1; $i <= 29; $i++) {
                   if (isset($PostData['d_ap-gas_'.$i.'-1'])) {
                    array_push($aparelhos,array(                                       
                      'IdOs' => $PostData['IdOS'],
                      'ItemInspecao' => $i + 23,
                      'Aparelho1' => $PostData['d_ap-gas_'.$i.'-1'] == "NULL" ? NULL : $PostData['d_ap-gas_'.$i.'-1'],
                      'Aparelho2' => $PostData['d_ap-gas_'.$i.'-2'] == "NULL" ? NULL : $PostData['d_ap-gas_'.$i.'-2'],
                      'Aparelho3' => $PostData['d_ap-gas_'.$i.'-3'] == "NULL" ? NULL : $PostData['d_ap-gas_'.$i.'-3']
                    ));
                  }
                }

                // LIGAÇÕES DOS APARELHOS A GÁS
                for ($i=1; $i <= 9; $i++) {

                 if (isset($PostData['d_liga-ap_'.$i.'_1'])) {
                  array_push($aparelhos,array(                                       
                    'IdOs' => $PostData['IdOS'],
                    'ItemInspecao' => $i + 52,
                    'Aparelho1' => $PostData['d_liga-ap_'.$i.'_1'] == "NULL" ? NULL : $PostData['d_liga-ap_'.$i.'_1'],
                    'Aparelho2' => $PostData['d_liga-ap_'.$i.'_2'] == "NULL" ? NULL : $PostData['d_liga-ap_'.$i.'_2'],
                    'Aparelho3' => $PostData['d_liga-ap_'.$i.'_3'] == "NULL" ? NULL : $PostData['d_liga-ap_'.$i.'_3']         
                  ));
                    }  // isset
                  }


                // INDIVIDUAL DE EXAUSTÃO NATURAL E FORÇADA
                  for ($i=1; $i <= 14; $i++) {

                   if (isset($PostData['d_ind-exaust_'.$i.'-1'])) {
                    array_push($aparelhos,array(                                       
                      'IdOs' => $PostData['IdOS'],
                      'ItemInspecao' => $i + 61,
                      'Aparelho1' =>  $PostData['d_ind-exaust_'.$i.'-1'] == "NULL" ? NULL : $PostData['d_ind-exaust_'.$i.'-1'],
                      'Aparelho2' => $PostData['d_ind-exaust_'.$i.'-2'] == "NULL" ? NULL : $PostData['d_ind-exaust_'.$i.'-2'],
                      'Aparelho3' => $PostData['d_ind-exaust_'.$i.'-3'] == "NULL" ? NULL : $PostData['d_ind-exaust_'.$i.'-3']         
                    ));
                  }  // isset
                }


                // COLETIVO DE EXAUSTÃO NATURAL E FORÇADA
                for ($i=1; $i <= 7; $i++) {

                 if (isset($PostData['d_cole-exaust_'.$i.'-1'])) {
                  array_push($aparelhos,array(                                        
                    'IdOs' => $PostData['IdOS'],
                    'ItemInspecao' => $i + 75,
                    'Aparelho1' => $PostData['d_cole-exaust_'.$i.'-1'] == "NULL" ? NULL : $PostData['d_cole-exaust_'.$i.'-1'],
                    'Aparelho2' => $PostData['d_cole-exaust_'.$i.'-2'] == "NULL" ? NULL : $PostData['d_cole-exaust_'.$i.'-2'],
                    'Aparelho3' => $PostData['d_cole-exaust_'.$i.'-3'] == "NULL" ? NULL : $PostData['d_cole-exaust_'.$i.'-3']         
                  ));
                  }  // isset
                }

                // CARACTERÍSTICAS HIGIÊNICAS DA COMBUSTÃO
                for ($i=1; $i <= 3; $i++) {
                 if (isset($PostData['d_caract-higi_'.$i.'-1'])) {
                  array_push($aparelhos,array(                                      
                    'IdOs' => $PostData['IdOS'],
                    'ItemInspecao' => $i + 82,
                    'Aparelho1' => $PostData['d_caract-higi_'.$i.'-1'] == "NULL" ? NULL : $PostData['d_caract-higi_'.$i.'-1'],
                    'Aparelho2' => $PostData['d_caract-higi_'.$i.'-2'] == "NULL" ? NULL : $PostData['d_caract-higi_'.$i.'-2'],
                    'Aparelho3' => $PostData['d_caract-higi_'.$i.'-3'] == "NULL" ? NULL : $PostData['d_caract-higi_'.$i.'-3']         
                  ));
                  }  // isset
                }

                // RECOMENDAÇÕES
                for ($i=1; $i <= 6; $i++) {
                 if (isset($PostData['d_reco-'.$i.'_1'])) {
                  array_push($aparelhos,array(                                                                     
                    'IdOs' => $PostData['IdOS'],
                    'ItemInspecao' => $i + 85,
                    'InstalacaoInterna' => $PostData['d_reco-'.$i.'_1'] == "NULL" ? NULL : $PostData['d_reco-'.$i.'_1'],
                    'Aparelho1' => $PostData['d_reco-'.$i.'_2'] == "NULL" ? NULL : $PostData['d_reco-'.$i.'_2'],
                    'Aparelho2' => $PostData['d_reco-'.$i.'_3'] == "NULL" ? NULL : $PostData['d_reco-'.$i.'_3'],
                    'Aparelho3' => $PostData['d_reco-'.$i.'_4'] == "NULL" ? NULL : $PostData['d_reco-'.$i.'_4']         
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

                // FOTOS ASSINATURA DO CLIENTE
                $ass_cliente_title = "Cliente";
                $ass_cliente_arquivos = array($_FILES['asscliente_fotos_arquivos']['size']);
                $ass_cliente_GalleryId = $PostData['IdOS'];
                $ass_cliente_Image = (!empty($_FILES['asscliente_fotos_arquivos']) ? $_FILES['asscliente_fotos_arquivos'] : NULL);
                $ass_cliente_Size = (!empty($_FILES['asscliente_fotos_arquivos']['size']) ? array_sum($ass_cliente_arquivos) : NULL);
                $ass_cliente_GalleryName = Check::Name($ass_cliente_title);

                    
                if (!empty($ass_cliente_Image)):
                  $ass_cliente_File = $ass_cliente_Image;
                  $ass_cliente_gbFile = array();
                  $ass_cliente_gbCount = count($ass_cliente_File['type']);
                  $ass_cliente_gbKeys = array_keys($ass_cliente_File);
                  $ass_cliente_gbLoop = 0;

        
                  if ($ass_cliente_gbCount > 1):
                    $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>QUANTIDADE DE FOTOS SUPERIOR A 10 FOTOS!</b>");
                  else:
                    for ($gb = 0; $gb < $ass_cliente_gbCount; $gb++):
                      foreach ($ass_cliente_gbKeys as $Keys):
                        $ass_cliente_gbFiles[$gb][$Keys] = $ass_cliente_File[$Keys][$gb];
                      endforeach;
                    endfor;
                         
                    foreach ($ass_cliente_gbFiles as $ass_cliente_UploadFile):
                      $ass_cliente_gbLoop ++;
                      $Upload->Image($ass_cliente_UploadFile, "{$PostData['IdOS']}{$ass_cliente_title}". time(), IMAGE_W, 'images');

                      if ($Upload->getResult()):
                        $ass_cliente_gbCreate = array('OS' => $ass_cliente_GalleryId, 'Arquivo' => $Upload->getResult(), 'Tipo' => 4);
                                  
                        $Create->ExeCreate('[60_OS_Fotos]', $ass_cliente_gbCreate);

                      endif;
                    endforeach;
                  endif;
                endif;

                // FOTOS ASSINATURA DO TÉCNICO
                $ass_tecnico_title = "Tecnico";
                $ass_tecnico_arquivos = array($_FILES['asstecnico_fotos_arquivos']['size']);
                $ass_tecnico_GalleryId = $PostData['IdOS'];
                $ass_tecnico_Image = (!empty($_FILES['asstecnico_fotos_arquivos']) ? $_FILES['asstecnico_fotos_arquivos'] : NULL);
                $ass_tecnico_Size = (!empty($_FILES['asstecnico_fotos_arquivos']['size']) ? array_sum($ass_tecnico_arquivos) : NULL);
                $ass_tecnico_GalleryName = Check::Name($ass_tecnico_title);

                    
                if (!empty($ass_tecnico_Image)):
                  $ass_tecnico_File = $ass_tecnico_Image;
                  $ass_tecnico_gbFile = array();
                  $ass_tecnico_gbCount = count($ass_tecnico_File['type']);
                  $ass_tecnico_gbKeys = array_keys($ass_tecnico_File);
                  $ass_tecnico_gbLoop = 0;

        
                  if ($ass_tecnico_gbCount > 1):
                    $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>QUANTIDADE DE FOTOS SUPERIOR A 10 FOTOS!</b>");
                  else:
                    for ($gb = 0; $gb < $ass_tecnico_gbCount; $gb++):
                      foreach ($ass_tecnico_gbKeys as $Keys):
                        $ass_tecnico_gbFiles[$gb][$Keys] = $ass_tecnico_File[$Keys][$gb];
                      endforeach;
                    endfor;
                         
                    foreach ($ass_tecnico_gbFiles as $ass_tecnico_UploadFile):
                      $ass_tecnico_gbLoop ++;
                      $Upload->Image($ass_tecnico_UploadFile, "{$PostData['IdOS']}{$ass_tecnico_title}".time(), IMAGE_W, 'images');

                      if ($Upload->getResult()):
                        $ass_tecnico_gbCreate = array('OS' => $ass_tecnico_GalleryId, 'Arquivo' => $Upload->getResult(), 'Tipo' => 6);
                                  
                        $Create->ExeCreate('[60_OS_Fotos]', $ass_tecnico_gbCreate);

                      endif;
                    endforeach;
                  endif;
                endif;

                // FOTOS DO LOCAL
                if(!empty($PostData['local_fotos_arquivos'])):
                  $ass_local_title = "Local";
                  $ass_local_arquivos = array($_FILES['local_fotos_arquivos']['size']);
                  $ass_local_GalleryId = $PostData['IdOS'];
                  $ass_local_Image = (!empty($_FILES['local_fotos_arquivos']) ? $_FILES['local_fotos_arquivos'] : NULL);
                  $ass_local_Size = (!empty($_FILES['local_fotos_arquivos']['size']) ? array_sum($ass_local_arquivos) : NULL);
                  $ass_local_GalleryName = Check::Name($ass_local_title);

                      
                  if (!empty($ass_local_Image)):
                    $ass_local_File = $ass_local_Image;
                    $ass_local_gbFile = array();
                    $ass_local_gbCount = count($ass_local_File['type']);
                    $ass_local_gbKeys = array_keys($ass_local_File);
                    $ass_local_gbLoop = 0;

          
                    if ($ass_local_gbCount > 4):
                      $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>QUANTIDADE DE FOTOS SUPERIOR A 10 FOTOS!</b>");
                    else:
                      for ($gb = 0; $gb < $ass_local_gbCount; $gb++):
                        foreach ($ass_local_gbKeys as $Keys):
                          $ass_local_gbFiles[$gb][$Keys] = $ass_local_File[$Keys][$gb];
                        endforeach;
                      endfor;
                           
                      foreach ($ass_local_gbFiles as $ass_local_UploadFile):
                        $ass_local_gbLoop ++;
                        $Upload->Image($ass_local_UploadFile, "{$PostData['IdOS']}{$ass_local_title}". time(), IMAGE_W, 'images');

                        if ($Upload->getResult()):
                          $ass_local_gbCreate = array('OS' => $ass_local_GalleryId, 'Arquivo' => $Upload->getResult(), 'Tipo' => 5);
                           
                          if($PostData['o_os_status'] == 3){        
                            $Create->ExeCreate('[60_OS_Fotos]', $ass_local_gbCreate);
                          }
                        endif;
                    endforeach;
                  endif;
                  endif;
                endif;


        //VERIFICA O STATUS DO ORÇAMENTO
        $statusorcamento = $PostData['o_orcamento_status'];
        if($statusorcamento == 2){
          $PostData['TecExe'] = $PostData['IdTecnico'];

          //ALTERA O STATUS DA OS NA TABELA 60_OS
          $statusOs = $PostData['o_os_status'];
          $statusOS = ['Status' => $statusOs];
          $Update->ExeUpdate("[60_OS]",$statusOS, "WHERE OT = :ot", "ot={$PostData['IdOS']}");
        }else{
          $PostData['TecExe'] = NULL;
        }

        //SALVAR ORÇAMENTO APROVADO
        $orcamento = array(
            'IdOS' => $PostData['IdOS'],
            'TecnicoEnt' => $PostData['IdTecnico'],
            'Status' => isset($PostData['o_orcamento_status']) ? $PostData['o_orcamento_status'] : NULL,
            'Valor' => isset($PostData['o_valor_total_orcamento']) ? $PostData['o_valor_total_orcamento'] : NULL,
            'FormaPagamento' => isset($PostData['o_forma_de_pagamento']) ? $PostData['o_forma_de_pagamento'] : NULL,
            'NumParcelas' => isset($PostData['O_quant_parcelas']) ? $PostData['O_quant_parcelas'] : 1,
            'TecExe'  => isset($PostData['TecExe']) ? $PostData['TecExe'] : NULL,
            'DataExe' => $statusorcamento == 2? $Data->format('Ymd H:i:s') : NULL,
            'DataAgendamento' => isset($PostData['o_data_agendamento']) ? $PostData['o_data_agendamento'] : NULL,
            'Obs' => isset($PostData['Obs']) ? $PostData['Obs'] : NULL
  
        );
        
        //CRIA ORÇAMENTO E SALVA O ID DO ULTIMO ORÇAMENTO CRIADO
        if($PostData['o_valor_total_orcamento'] > 0){
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
            $termoR1 = array();
            if($statusorcamento == 1){
              $idOt = NULL;
              $clientesSemOT = array(
                'IDCLIENTE' => $PostData['IdDoCliente'],
                'IDOS' =>  $idOt,
                'DATAAGENDAMENTO' => $PostData['o_data_agendamento'],
                'USUARIOSISTEMA' => $PostData['USUARIOSISTEMA'],
                'IDORCAMENTO' => $idOrcamento
              );
              $Create->Execreate("[60_ClientesSemOT]",$clientesSemOT);
            }
          }
        }

//
        //SALVAR ORÇAMENTO,PEÇAS E SERVIÇOS REPROVADOS
        $statusOrReprovado = 3;
        $orcamentor = array(
            'IdOS' => $PostData['IdOS'],
            'TecnicoEnt' => $PostData['IdTecnico'],
            'Status' => $statusOrReprovado,
            'Valor' => isset($PostData['o_valor_total_orcamento_r']) ? $PostData['o_valor_total_orcamento_r'] : NULL,
            'FormaPagamento' => $PostData['o_forma_de_pagamento'] = NULL,
            'NumParcelas' => $PostData['O_quant_parcelas'] = NULL,
            'Obs' => isset($PostData['Obs']) ? $PostData['Obs'] : NULL
        );

        if(isset($PostData['o_valor_total_orcamento_r']) && $PostData['o_valor_total_orcamento_r'] > 0){
              $Create->ExeCreate("[60_Orcamentos]",$orcamentor);


              //SALVA O ID DO ÚLTIMO ORÇAMENTO CRIADO
              $idOrcamentor = $Create->getResult();
              if($idOrcamentor){
              $totalLinhasPecas = $PostData['o_p_total_linhas'];
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
                $totalLinhasServicos = $PostData['o_s_total_linhas'];
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

        $termo1 = [];

        for($i = 1; $i <= 6; $i++){
          if(isset($PostData['o_vp_superior'.$i])){
            array_push($termo1,$PostData['o_vp_superior'.$i]);
          }
        }

        $termoResp1 = array(
        'IDOs' => $PostData['IdOS'],
        'Situacao' => isset($PostData['o_vp_superior0']) ? $PostData['o_vp_superior0'] : NULL,
        'Local1' => isset($termo1[0]) ? $termo1[0] : NULL,
        'Local2' => isset($termo1[1]) ? $termo1[1] : NULL,
        'Local3' => isset($termo1[2]) ? $termo1[2] : NULL
        );

        if(isset($PostData['o_vp_superior0']) != NULL){
          $Create->ExeCreate("[60_TermosResponsabilidade]",$termoResp1);
        }

        $termo2 = [];

        for($i = 1; $i <= 6; $i++){
          if(isset($PostData['o_vp_inferior'.$i])){
            array_push($termo2,$PostData['o_vp_inferior'.$i]);
          }
        }

        $termoResp2 = array(
        'IDOs' => $PostData['IdOS'],
        'Situacao' => isset($PostData['o_vp_inferior0']) ? $PostData['o_vp_inferior0'] : NULL,
        'Local1' => isset($termo2[0]) ? $termo2[0] : NULL,
        'Local2' => isset($termo2[1]) ? $termo2[1] : NULL,
        'Local3' => isset($termo2[2]) ? $termo2[2] : NULL
        );

        if(isset($PostData['o_vp_inferior0']) != NULL){
          $Create->ExeCreate("[60_TermosResponsabilidade]",$termoResp2);
        }


        $termo3 = [];

        for($i = 1; $i <= 6; $i++){
          if(isset($PostData['o_vp_superior'.$i])){
            array_push($termo3,$PostData['o_vp_superior'.$i]);
          }
        }

        $termoResp3 = array(
        'IDOs' => $PostData['IdOS'],
        'Situacao' => isset($PostData['o_ra_adequado0']) ? $PostData['o_ra_adequado0'] : NULL,
        'Local1' => isset($termo3[0]) ? $termo3[0] : NULL,
        'Local2' => isset($termo3[1]) ? $termo3[1] : NULL,
        'Local3' => isset($termo3[2]) ? $termo3[2] : NULL
        );

        if(isset($PostData['o_ra_adequado0']) != NULL){
          $Create->ExeCreate("[60_TermosResponsabilidade]",$termoResp3);
        }

        $termo4 = [];

        for($i = 1; $i <= 6; $i++){
          if(isset($PostData['o_vp_superior'.$i])){
            array_push($termo4,$PostData['o_vp_superior'.$i]);
          }
        }

        $termoResp4 = array(
        'IDOs' => $PostData['IdOS'],
        'Situacao' => isset($PostData['o_c_adequada0']) ? $PostData['o_c_adequada0'] : NULL,
        'Local1' => isset($termo4[0]) ? $termo4[0] : NULL,
        'Local2' => isset($termo4[1]) ? $termo4[1] : NULL,
        'Local3' => isset($termo4[2]) ? $termo4[2] : NULL
        );

        if(isset($PostData['o_c_adequada0']) != NULL){
          $Create->ExeCreate("[60_TermosResponsabilidade]",$termoResp4);
        }

        $termo5 = [];

        for($i = 1; $i <= 6; $i++){
          if(isset($PostData['o_vp_superior'.$i])){
            array_push($termo5,$PostData['o_vp_superior'.$i]);
          }
        }

        $termoResp5 = array(
        'IDOs' => $PostData['IdOS'],
        'Situacao' => isset($PostData['o_tf_adequada0']) ? $PostData['o_tf_adequada0'] : NULL,
        'Local1' => isset($termo5[0]) ? $termo5[0] : NULL,
        'Local2' => isset($termo5[1]) ? $termo5[1] : NULL,
        'Local3' => isset($termo5[2]) ? $termo5[2] : NULL
        );

        if(isset($PostData['o_tf_adequada0']) != NULL){
          $Create->ExeCreate("[60_TermosResponsabilidade]",$termoResp5);
        }

        $termo6 = [];

        for($i = 1; $i <= 6; $i++){
          if(isset($PostData['o_vp_superior'.$i])){
            array_push($termo6,$PostData['o_vp_superior'.$i]);
          }
        }

        $termoResp6 = array(
        'IDOs' => $PostData['IdOS'],
        'Situacao' => isset($PostData['o_t_chamine0']) ? $PostData['o_t_chamine0'] : NULL,
        'Local1' => isset($termo6[0]) ? $termo6[0] : NULL,
        'Local2' => isset($termo6[1]) ? $termo6[1] : NULL,
        'Local3' => isset($termo6[2]) ? $termo6[2] : NULL
        );

        if(isset($PostData['o_t_chamine0']) != NULL){
          $Create->ExeCreate("[60_TermosResponsabilidade]",$termoResp6);
        }

        $termo7 = [];

        for($i = 1; $i <= 6; $i++){
          if(isset($PostData['o_vp_superior'.$i])){
            array_push($termo7,$PostData['o_vp_superior'.$i]);
          }
        }

        $termoResp7 = array(
        'IDOs' => $PostData['IdOS'],
        'Situacao' => isset($PostData['o_a_aberta0']) ? $PostData['o_a_aberta0'] : NULL,
        'Local1' => isset($termo7[0]) ? $termo7[0] : NULL,
        'Local2' => isset($termo7[1]) ? $termo7[1] : NULL,
        'Local3' => isset($termo7[2]) ? $termo7[2] : NULL,
        );

        if(isset($PostData['o_a_aberta0']) != NULL){
          $Create->ExeCreate("[60_TermosResponsabilidade]",$termoResp7);
        }

        $termo8 = [];

        for($i = 1; $i <= 6; $i++){
          if(isset($PostData['o_vp_superior'.$i])){
            array_push($termo8,$PostData['o_vp_superior'.$i]);
          }
        }

         $termoResp8 = array(
        'IDOs' => $PostData['IdOS'],
        'Situacao' => isset($PostData['o_outros0']) ? $PostData['o_outros0'] : NULL,
        'Local1' => isset($termo8[0]) ? $termo8[0] : NULL,
        'Local2' => isset($termo8[1]) ? $termo8[1] : NULL,
        'Local3' => isset($termo8[2]) ? $termo8[2] : NULL
        );

        if(isset($PostData['o_outros0']) != NULL){
          $Create->ExeCreate("[60_TermosResponsabilidade]",$termoResp8);
        }

                break;    
              endswitch;

    //RETORNA O CALLBACK
              if ($jSON):
                echo json_encode($jSON);
              else:
                $jSON['trigger'] = AjaxErro('Atendimento efetuado com sucesso!');
                echo json_encode($jSON);
              endif;
            else:
    //ACESSO DIRETO
            endif;
