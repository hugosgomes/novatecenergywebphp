
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
                'StatusTeste' => $PostData['t_1status'],
                'NumOcorrencia' => $PostData['t_num_ocorrencia'],
                'Defeito' => $PostData['t_2status']
            );

            $Create->ExeCreate("[60_Atendimentos]",$atendimento);
            /////////////////////////////////////////////////////////

            for ($i=1; $i <= 3; $i++) {
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

                // DISTRIBUIÇÃO INTERNA
            for ($i=1; $i <= 23; $i++) {
                if (isset($PostData['d_distr_interna_'.$i])) {
                    array_push($aparelhos,array(

                        'IdOs' => $PostData['IdOS'],
                        'ItemInspecao' => $PostData['d-dist-interna-'.$i],
                        'InstalacaoInterna' => $PostData['d_distr_interna_'.$i]


                    ));
                }
            }

                // APARELHO A GÁS
            for ($i=1; $i <= 29; $i++) {
               $count = 1;
               if($count > 3){$count = 1;} else {}

               if (isset($PostData['d_ap-gas_'.$i])) {
                array_push($aparelhos,array(                                                                     
                    'IdOs' => $PostData['IdOS'],
                    'ItemInspecao' => $PostData['d_ap-gas_'.$i],
                    'Aparelho1' => $PostData['d_ap-gas_'.$i.'-'.$count],
                    'Aparelho2' => $PostData['d_ap-gas_'.$i.'-'.$count],
                    'Aparelho3' => $PostData['d_ap-gas_'.$i.'-'.$count]          
                ));
                    }  // isset
                    $count++;
                }

                // LIGAÇÕES DOS APARELHOS A GÁS
                for ($i=1; $i <= 29; $i++) {
                 $count = 1;
                 if($count > 3){ $count = 1; } else {}

                 if (isset($PostData['d_ap-gas_'.$i])) {
                    array_push($aparelhos,array(                                                                     
                        'IdOs' => $PostData['IdOS'],
                        'ItemInspecao' => $PostData['d_liga-ap_'.$i],
                        'Aparelho1' => $PostData['d_liga-ap_'.$i.'_'.$count],
                        'Aparelho2' => $PostData['d_liga-ap_'.$i.'_'.$count],
                        'Aparelho3' => $PostData['d_liga-ap_'.$i.'_'.$count]          
                    ));
                    }  // isset
                    $count++;
                }

                  foreach ($aparelhos as $key => $value) {
                $Create->ExeCreate("[60_Defeitos]",$value);
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
    die('<br><br><br><center><h1>Acesso Restrito!</h1></center>');
endif;