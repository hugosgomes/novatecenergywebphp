
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
            /*$atendimento = array(
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
            }*/

                // DEFEITOS
                // DISTRIBUIÇÃO INTERNA
            for ($i=1; $i <= 23; $i++) {
                if (isset($PostData['d-dist-interna-'.$i.'-item'])) {
                    array_push($aparelhos,array(

                        'IdOs' => $PostData['IdOS'],
                        'ItemInspecao' => $PostData['d-dist-interna-'.$i.'-item'],
                        'InstalacaoInterna' => $PostData['d-dist-interna-'.$i]
                    ));
                }
            }

                // APARELHO A GÁS
            for ($i=1; $i <= 29; $i++) {

               if (isset($PostData['d_ap-gas_'.$i.'-item'])) {
                  array_push($aparelhos,array(                                       
                      'IdOs' => $PostData['IdOS'],
                      'ItemInspecao' => $PostData['d_ap-gas_'.$i.'-item'],
                      'Aparelho1' => isset($PostData['d_ap-gas_'.$i.'-1']) ? $PostData['d_ap-gas_'.$i.'-3'] : NULL,
                      'Aparelho2' => isset($PostData['d_ap-gas_'.$i.'-2']) ? $PostData['d_ap-gas_'.$i.'-3'] : NULL,
                      'Aparelho3' => isset($PostData['d_ap-gas_'.$i.'-3']) ? $PostData['d_ap-gas_'.$i.'-3'] : NULL
                  ));
                  }  // isset
              }

                // LIGAÇÕES DOS APARELHOS A GÁS
                for ($i=1; $i <= 9; $i++) {

                 if (isset($PostData['d_liga-ap_'.$i.'-item'])) {
                    array_push($aparelhos,array(                                       
                        'IdOs' => $PostData['IdOS'],
                        'ItemInspecao' => $PostData['d_liga-ap_'.$i.'-item'],
                        'Aparelho1' => isset($PostData['d_liga-ap_'.$i.'_1']) ? $PostData['d_liga-ap_'.$i.'_1'] : NULL,
                        'Aparelho2' => $PostData['d_liga-ap_'.$i.'_2'],
                        'Aparelho3' => $PostData['d_liga-ap_'.$i.'_3']          
                    ));
                    }  // isset
                }


                // INDIVIDUAL DE EXAUSTÃO NATURAL E FORÇADA
                for ($i=1; $i <= 14; $i++) {
        
                 if (isset($PostData['d_ind-exaust_'.$i.'-item'])) {
                    array_push($aparelhos,array(                                       
                        'IdOs' => $PostData['IdOS'],
                        'ItemInspecao' => $PostData['d_ind-exaust_'.$i.'-item'],
                        'Aparelho1' =>  isset($PostData['d_ind-exaust_'.$i.'-1']) ? $PostData['d_ind-exaust_'.$i.'-1'] : NULL,
                        'Aparelho2' => isset($PostData['d_ind-exaust_'.$i.'-2']) ? $PostData['d_ind-exaust_'.$i.'-2'] : NULL,
                        'Aparelho3' => isset($PostData['d_ind-exaust_'.$i.'-3']) ? $PostData['d_ind-exaust_'.$i.'-3'] : NULL          
                    ));
                  }  // isset
                }


                // COLETIVO DE EXAUSTÃO NATURAL E FORÇADA
                for ($i=1; $i <= 7; $i++) {
        
                 if (isset($PostData['d_cole-exaust_'.$i.'-item'])) {
                    array_push($aparelhos,array(                                        
                        'IdOs' => $PostData['IdOS'],
                        'ItemInspecao' => $PostData['d_cole-exaust_'.$i.'-item'],
                        'Aparelho2' => $PostData['d_cole-exaust_'.$i.'-2'],
                        'Aparelho3' => $PostData['d_cole-exaust_'.$i.'-3']          
                    ));
                  }  // isset
                }

                // CARACTERÍSTICAS HIGIÊNICAS DA COMBUSTÃO
                for ($i=1; $i <= 3; $i++) {
                 if (isset($PostData['d_caract-higi_'.$i.'-item'])) {
                    array_push($aparelhos,array(                                      
                        'IdOs' => $PostData['IdOS'],
                        'ItemInspecao' => $PostData['d_caract-higi_'.$i.'-item'],
                        'Aparelho1' => isset($PostData['d_caract-higi_'.$i.'-1']) ? $PostData['d_caract-higi_'.$i.'-1'] : NULL,
                        'Aparelho2' => isset($PostData['d_caract-higi_'.$i.'-2']) ? $PostData['d_caract-higi_'.$i.'-2'] : NULL,
                        'Aparelho3' => isset($PostData['d_caract-higi_'.$i.'-3']) ? $PostData['d_caract-higi_'.$i.'-3'] : NULL          
                    ));
                  }  // isset
                }

                // RECOMENDAÇÕES
                for ($i=1; $i <= 6; $i++) {
                   if (isset($PostData['d_reco-'.$i.'-item'])) {
                    array_push($aparelhos,array(                                                                     
                        'IdOs' => $PostData['IdOS'],
                        'ItemInspecao' => $PostData['d_reco-'.$i.'-item'],
                        'InstalacaoInterna' => $PostData['d_reco-'.$i.'_1'],
                        'Aparelho2' => $PostData['d_reco-'.$i.'_3'],
                        'Aparelho3' => $PostData['d_reco-'.$i.'_4']          
                    ));
                  }  // isset
                }

              foreach ($aparelhos as $key => $value) {
                $Create->ExeCreate("[60_Defeitos]",$value);
              }

              var_dump($aparelhos);


//var_dump($PostData, $_FILES, $_POST);
            //ENVIO DE ARQUIVO
                      /*if (empty($Upload)):
                          $Upload = new Upload('../../uploads/');
                      endif;

                      $title = "teste";
                      $GalleryId = $PostData['IdOS'];
                      $Image = (!empty($_FILES['fotos_arquivos']) ? $_FILES['fotos_arquivos'] : null);
                      $Size = (!empty($_FILES['fotos_arquivos']['size']) ? array_sum($_FILES['fotos_arquivos']['size']) : null);
                      $GalleryName = Check::Name($title);

                      unset($PostData['IdOS'], $PostData['fotos_arquivos']);

                      if (!empty($Image)):
                          $File = $Image;
                          $gbFile = array();
                          $gbCount = count($File['type']);
                          $gbKeys = array_keys($File);
                          $gbLoop = 0;

                          if ($gbCount > 10):
                              $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>QUANTIDADE DE FOTOS SUPERIOR A 25 FOTOS!</b>");
                          else:
                              for ($gb = 0; $gb < $gbCount; $gb++):
                                  foreach ($gbKeys as $Keys):
                                      $gbFiles[$gb][$Keys] = $File[$Keys][$gb];
                                  endforeach;
                              endfor;

                              $jSON['gallery'] = null;
                              foreach ($gbFiles as $UploadFile):
                                  $gbLoop ++;
                                  $Upload->Image($UploadFile, "{$GalleryName}-{$GalleryId}-{$gbLoop}-" . time(), IMAGE_W, 'gallery');

                                  if ($Upload->getResult()):
                                      $gbCreate = ['IdOS' => $GalleryId, "fotos_arquivos" => $Upload->getResult()];
                                     // $Create->ExeCreate(DB_GALLERY_IMAGES, $gbCreate);
                                      $jSON['gallery'] .= "<img rel='Gallery' id='{$Create->getResult()}' alt='Imagem em {$title}' title='Imagem em {$title}' src='../uploads/{$Upload->getResult()}'/>";
                                  endif;
                              endforeach;
                          endif;
                      endif;

                      $Update->ExeUpdate(DB_GALLERY, $PostData, "WHERE gallery_id = :id", "id={$GalleryId}");
                      $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>ATUALIZADO COM SUCESSO:</b> A Galeria {$title} foi atualizado com sucesso no sistema!");
                      $jSON['view'] = BASE . "/imovel/{$title}";


                      if (empty($Upload)):
                        $Upload = new Upload('../../../uploads/');
                      endif;

                      $title = "teste";
                      $arquivos = array($_FILES['fotos_arquivos']['size']);
                      $GalleryId = $PostData['IdOS'];
                      $Image = (!empty($_FILES['fotos_arquivos']) ? $_FILES['fotos_arquivos'] : null);
                      $Size = (!empty($_FILES['fotos_arquivos']['size']) ? array_sum($arquivos) : null);
                      $GalleryName = Check::Name($title);

                      

                      unset($PostData['IdOS'], $PostData['fotos_arquivos']);


                      if (!empty($Image)):
                          $File = $Image;
                          $gbFile = array();
                         // $arquivoTipo = array($File['type']);
                          $gbCount = count($File['type']);
                          $gbKeys = array_keys($File);
                          $gbLoop = 0;
               
                            //var_dump($Image, $gbFile, $arquivoTipo, $gbCount, $gbKeys,  $gbLoop);
                     
                           
                        if ($gbCount > 10):
                              $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>QUANTIDADE DE FOTOS SUPERIOR A 10 FOTOS!</b>");
                        else:

                              for ($gb = 0; $gb < $gbCount; $gb++):
                                  foreach ($gbKeys as $Keys):
                                      $gbFiles[$gb][$Keys] = $File[$Keys][$gb];

                                  endforeach;
                              endfor;
                              //var_dump($gbCount);
                              $jSON['gallery'] = null;
                              foreach ($gbFiles as $UploadFile):
                                  $gbLoop ++;
                                  $Upload->Image($UploadFile, "{$title}" . time(), IMAGE_W, 'images');
                                  
                                  if ($Upload->getResult()):

                                      $gbCreate = ['OS' => $GalleryId, 'Arquivo' => $Upload->getResult()];
                                   
                                   // var_dump($gbCreate['IdOS'], $gbCreate['fotos_arquivos']);
                                     $Create->ExeCreate(['60_OS_Fotos'], $gbCreate);
                                      // var_dump($gbCreate['IdOS']);
                                      //$jSON['gallery'] .= "<img rel='Gallery' id='{$GalleryId}' alt='Imagem em {$title}' title='Imagem em {$title}' src='../uploads/{$Upload->getResult()}'/>";
                                     // $jSON['gallery'] = "teste";
                                  endif;
                              endforeach;
                          endif;
                        endif;
                       

                    if (isset($_FILES['fotos_arquivos']) && !empty($_FILES['fotos_arquivos']['name'])) {

                        $file_name = $_FILES['fotos_arquivos']['name'];
                        $file_type = $_FILES['fotos_arquivos']['type'];
                        $file_size = $_FILES['fotos_arquivos']['size'];
                        $file_tmp_name = $_FILES['fotos_arquivos']['tmp_name'];
                        $error = $_FILES['fotos_arquivos']['error'];      

                        //echo $file_name;
                        //echo $titulo;

                                /*
                                switch($file_type){
                                    case 'image/png':  $arq ='.png';break;
                                    case 'image/jpeg': $arq ='.jpg';break;
                                    case 'image/gif':  $arq ='.gif';break;
                                    case 'image/bmp':  $arq ='.bmp';break;
                                    case 'image/PNG':  $arq ='.PNG';break;
                                    case 'image/JPEG': $arq ='.JPEG';break;
                                    case 'image/GIF':  $arq ='.GIF';break;
                                    case 'image/BMP':  $arq ='.BMP';break;

                                }
                                */
/*
                                $destino = '../../../uploads/images';

                           move_uploaded_file($file_tmp_name,$destino.$file_name);


                        }*///end if isset file

            $jSON['trigger']='Teste';

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