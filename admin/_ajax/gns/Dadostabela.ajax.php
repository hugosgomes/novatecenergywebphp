
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

           // $aparelhos = [];

            //SALVANDO O ATENDIMENTO
          /*  $atendimento = array(
                'idOS' => $PostData['IdOS'],
                'idTecnico' => $PostData['IdTecnico'],
                'Status' => 1,
                'NumManometro' => $PostData['t_num_manometro'],
                'PressaoInicial' => $PostData['t_p_inicial'],
                'PressaoFinal' => $PostData['t_p_Final'],
                'TempoTeste' => $PostData['t_tempo_teste'],
                'StatusTeste' => $PostData['t_1status'],
                'NumOcorrencia' => $PostData['t_num_ocorrencia'],
                'Defeito' => $PostData['t_2status']
            );

            $Create->ExeCreate("[60_Atendimentos]",$atendimento);
            /////////////////////////////////////////////////////////

            for ($i=1; $i <= 10; $i++) {
                if (isset($PostData['t_cozinhaTipo'.$i])) {
                    array_push($aparelhos,array(
                        'IdOs' => $PostData['IdOS'],
                        'Tipo' => $PostData['t_cozinhaTipo'.$i],
                        'Marca' => $PostData['t_cozinhaMarca'.$i],
                        'Modelo' => $PostData['t_cozinhaModelo'.$i],
                        'PotNominal' => $PostData['t_cozinhaPot'.$i],
                        'Funcionamento' => $PostData['t_cozinhaFuncionamento'.$i]
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
            }*/


                    // FOTOS DEFEITOS
/*
                      if (empty($Upload)):
                        $Upload = new Upload('../../../uploads/');
                      endif;

                      $d_title = "Defeitos";
                      $d_arquivos = array($_FILES['defeitos_fotos_arquivos']['size']);
                      $d_GalleryId = $PostData['IdOS'];
                      $d_Image = (!empty($_FILES['defeitos_fotos_arquivos']) ? $_FILES['defeitos_fotos_arquivos'] : null);
                      $d_Size = (!empty($_FILES['defeitos_fotos_arquivos']['size']) ? array_sum($d_arquivos) : null);
                      $d_GalleryName = Check::Name($d_title);

                      

                     // unset($PostData['IdOS'], $PostData['defeitos_fotos_arquivos']);


                      if (!empty($d_Image)):
                          $d_File = $d_Image;
                          $d_gbFile = array();
                          $d_gbCount = count($d_File['type']);
                          $d_gbKeys = array_keys($d_File);
                          $d_gbLoop = 0;
               
                            //var_dump($Image, $gbFile, $arquivoTipo, $gbCount, $gbKeys,  $gbLoop);
                     
                           
                        if ($d_gbCount > 10):
                              $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>QUANTIDADE DE FOTOS SUPERIOR A 10 FOTOS!</b>");
                        else:

                              for ($gb = 0; $gb < $d_gbCount; $gb++):
                                  foreach ($d_gbKeys as $Keys):
                                      $d_gbFiles[$gb][$Keys] = $d_File[$Keys][$gb];

                                  endforeach;
                              endfor;
                              //var_dump($gbCount);
                              $jSON['defeitos'] = null;
                              foreach ($d_gbFiles as $d_UploadFile):
                                  $d_gbLoop ++;
                                  $Upload->Image($d_UploadFile, "{$d_title}". time(), IMAGE_W, 'images');
                                  
                                  if ($Upload->getResult()):

                                      $d_gbCreate = array('OS' => $d_GalleryId, 'Arquivo' => $Upload->getResult(), 'Tipo' => 3);
                                     //var_dump($UploadFile);

                                      $Create->ExeCreate('[60_OS_Fotos]', $d_gbCreate);
                                    
                                      $jSON['defeitos'] .= "<img rel='Gallery' id='{$d_GalleryId}' alt='Imagem em {$d_title}' title='Imagem em {$d_title}' src='../uploads/{$Upload->getResult()}' style='width: 10%;'/>";
                                     
                                  endif;
                              endforeach;
                          endif;
                        endif;


                        // FOTOS MEDIDOR

                      $m_title = "Medidor";
                      $m_arquivos = array($_FILES['medidor_fotos_arquivos']['size']);
                      $m_GalleryId = $PostData['IdOS'];
                      $m_Image = (!empty($_FILES['medidor_fotos_arquivos']) ? $_FILES['medidor_fotos_arquivos'] : null);
                      $m_Size = (!empty($_FILES['medidor_fotos_arquivos']['size']) ? array_sum($m_arquivos) : null);
                      $m_GalleryName = Check::Name($m_title);

                      

                                      $Create->ExeCreate('[60_OS_Fotos]', $s_gbCreate);
                                    
                                      $jSON['servico'] .= "<img rel='Gallery' id='{$s_GalleryId}' alt='Imagem em {$s_title}' title='Imagem em {$s_title}' src='../uploads/{$Upload->getResult()}' style='width: 10%;'/>";
                                     
                                  endif;
                              endforeach;
                          endif;
                        endif;*/

    $totalLinhasPecas = $PostData['o_p_total_linhas'];

        for ($i=0; $i < $totalLinhasPecas ; $i++) { 
            $orcamento_pecas = array(
                'Num_OS' => $PostData['IdOS'],
                'ID_Pecas' => $PostData['o_id_peca'.$i],
                'Qtd' => $PostData['o_quant_peca'.$i]
            );

            $Create->ExeCreate("[60_OS_PecasAPP]",$orcamento_pecas);
            
            var_dump($orcamento_pecas);
        }

        $totalLinhasServicos = $PostData['o_s_total_linhas'];

        for ($i= 0; $i < $totalLinhasServicos; $i++) { 
            $orcamento_servico = array(
                'Num_OS' => $PostData['IdOS'],
                'ID_servico' => $PostData['o_id_servico'.$i],
                'Qtd' => $PostData['o_quant_servico'.$i]
            );

            $Create->ExeCreate("[60_OS_ServicosAPP]",$orcamento_servico);
        }

       $orcamento = array(
        'IdOS' => $PostData['IdOS'],
        'TecnicoEnt' => $PostData['IdTecnico'],
        //'DataExe' => $PostData[''],
        'TecExe' => $PostData['IdOS'],
        'Status' => $PostData['o_orcamento_status'],
        'Valor' => $PostData['o_valor_total_orcamento'],
        'FormaPagamento' => $PostData['o_forma_de_pagamento'],
        'NumParcelas' => $PostData['O_quant_parcelas']
        );

        $Create->ExeCreate("[60_Orcamentos]",$orcamento);


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