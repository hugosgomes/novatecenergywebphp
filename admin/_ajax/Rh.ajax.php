
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
$CallBack = 'Rh';
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

    case 'enviar_documentos':
    $ID = $PostData['idfuncionario'];

    //var_dump($ID);
    //var_dump($SL);

    $Read->FullRead("SELECT [NOME COMPLETO] AS nome FROM Funcionários WHERE ID = :IDFUNC","IDFUNC={$ID}");
    $selectNome = $Read->getResult()[0]['nome'];



             // FOTOS DEFEITOS                
    if (empty($Upload)):
      $Upload = new Upload('../../uploads/');
    endif;

    if(isset($_FILES['documentosRH'])){

      $d_title = "DocumentoRh";
      $d_arquivos = array($_FILES['documentosRH']['size']);
      $d_GalleryId = $PostData['idfuncionario'];
      $d_Image = (!empty($_FILES['documentosRH']) ? $_FILES['documentosRH'] : NULL);
      $d_Size = (!empty($_FILES['documentosRH']['size']) ? array_sum($d_arquivos) : NULL);
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
                         $d = ($_FILES['documentosRH']['name'][$d_gbLoop]); // Nome do ARQUIVO sendo enviado
                         $p = ($PostData['tipoArquivo'. $d_gbLoop]); // Tipo do ARQUIVO no SELECT (EPIs, Outros)...
                         $y = pathinfo($d);
                         $d_gbLoop ++;

                         //var_dump($y['extension']);

                         switch ($p) {
                          case 0:
                          $pasta = "Cert. Inf. Riscos - Distribuicao Gas";
                          $nomeArquivo = "certificado-empresarial-de-informacao-de-riscos-laborais-distribuicao-de-gas";
                          $nomeAchilles = "Certificado Empresarial de Informação de Riscos Laborais - Distribuição de Gás";
                          break;

                          case 1:
                          $pasta = "Cert. Inf. Riscos - Recursos e Servicos";
                          $nomeArquivo = "cert-inf-riscos-recursos-e-servicos";
                          $nomeAchilles = "Certificado Empresarial de Informação de Riscos Laborais - Recursos e Serviços";
                          break;

                          case 2:
                          $pasta = "Ent. EPIs";
                          $nomeArquivo = "entrega-de-epis";
                          $nomeAchilles = "Entrega de EPIs";
                          break;

                          case 3:
                          $pasta = "Cert. Emp. Formaçao";
                          $nomeArquivo = "certificado-empresarial-de-formacao";
                          $nomeAchilles = "Certificado Empresarial de Formação";
                          break;

                          case 4:
                          $pasta = "Cart. Nacion. Habilitacao";
                          $nomeArquivo = "carteira-nacional-de-habilitacao";
                          $nomeAchilles = "Carteira Nacional de Habilitação";
                          break;

                          case 5:
                          $pasta = "Cart. ASSINADA";
                          $nomeArquivo = "carteira-de-trabalho-assinada-inclusive-pagina-que-consta-o-cargo-funcao";
                          $nomeAchilles = "Carteira de Trabalho ASSINADA, Inclusive página que consta o cargo/função";
                          break;

                          case 6:
                          $pasta = "Termo Rescisao Contrato (TRCT)";
                          $nomeArquivo = "termo-de-rescisao-do-contrato-de-trabalho-trct";
                          $nomeAchilles = "Termo de Rescisão do Contrato de Trabalho (TRCT)";
                          break;

                          case 7:
                          $pasta = "Guia Recolhimento Federal";
                          $nomeArquivo = "guia-de-recolhimento-da-receita-federal";
                          $nomeAchilles = "Guia de Recolhimento da Receita Federal";
                          break;

                          case 8:
                          $pasta = "Folha de Ponto. Empregado";
                          $nomeArquivo = "folha-de-ponto-assinada-pelo-empregado";
                          $nomeAchilles = "Folha de Ponto assinada pelo empregado"; 
                          break;

                          case 9:
                          $pasta = "Aviso de Ferias";
                          $nomeArquivo = "aviso-de-ferias-assinado-e-comprovante-de-pagamento-do-terco-constitucional";
                          $nomeAchilles = "Aviso de Férias assinado e comprovante de pagamento do terço constitucional";
                          break;

                          case 10:
                          $pasta = "Contrato de Trabalho";
                          $nomeArquivo = "contrato-de-trabalho";
                          $nomeAchilles = "Contrato de Trabalho";
                          break;

                          case 11:
                          $pasta = "Ates. Ocupacional - ASO";
                          $nomeArquivo = "atestado-de-saude-ocupacional-aso-admissional-periodico-e-demissional";
                          $nomeAchilles = "Atestado de Saúde Ocupacional - ASO (admissional, periódico e demissional)";
                          break;

                          case 12:
                          $pasta = "Regi. Responsavel Tecnico Empresa";
                          $nomeArquivo = "registro-tecnico-do-responsavel-tecnico-da-empresa-pessoa-fisica";
                          $nomeAchilles = "Registro Técnico do Responsável Técnico da empresa - Pessoa Física";
                          break;

                          case 13:
                          $pasta = "Outros";
                          $nomeArquivo = "certificacao-de-jo";
                          $nomeAchilles = "Certificacão de JO";
                          break;

                          case 14:
                          $pasta = "Outros";
                          $nomeArquivo = "certificacao-de-desenhista-de-campo";
                          $nomeAchilles = "Certificacão de Desenhista de campo";
                          break;

                          case 15:
                          $pasta = "Outros";
                          $nomeArquivo = "certificacao-qualificacao-de-soldadores-de-aco";
                          $nomeAchilles = "Certificacão/Qualificacão de Soldadores de Aço";
                          break;

                          case 16:
                          $pasta = "Outros";
                          $nomeArquivo = "certificacao-de-inspetores-de-solda-de-aco";
                          $nomeAchilles = "Certificacão de Inspetores de Solda de Aço";
                          break;

                          case 17:
                          $pasta = "Outros";
                          $nomeArquivo = "certificacao-de-soldadores-de-pe";
                          $nomeAchilles = "Certificacão de Soldadores de PE";
                          break;

                          case 18:
                          $pasta = "Outros";
                          $nomeArquivo = "certificacao-de-inspetores-de-alta";
                          $nomeAchilles = "Certificacão de Inspetores de Alta";
                          break;

                          case 19:
                          $pasta = "Outros";
                          $nomeArquivo = "navegador-de-mnd";
                          $nomeAchilles = "Navegador de MND";
                          break;

                          case 20:
                          $pasta = "Outros";
                          $nomeArquivo = "operador-mnd";
                          $nomeAchilles = "Operador MND";
                          break;

                          case 21:
                          $pasta = "Outros";
                          $nomeArquivo = "titulo-de-certificado-de-operador-de-medidor";
                          $nomeAchilles = "Título de Certificado de Operador de Medidor";
                          break;

                          case 22:
                          $pasta = "Outros";
                          $nomeArquivo = "titulo-de-certificado-de-inspetor-de-vistoria-e-alta";
                          $nomeAchilles = "Título de Certificado de Inspetor de Vistoria e Alta";
                          break;

                          case 23:
                          $pasta = "Outros";
                          $nomeArquivo = "titulo-de-certificado-de-instalador-predial-de-tubulacoes-de-gas";
                          $nomeAchilles = "Título de Certificado de Instalador Predial de Tubulacoes de gás";
                          break;

                          case 24:
                          $pasta = "Outros";
                          $nomeArquivo = "trabalhos-em-altura";
                          $nomeAchilles = "Trabalhos em Altura";
                          break;

                          case 25:
                          $pasta = "Outros";
                          $nomeArquivo = "registro-de-capacitacao-especifica-para-vigia-e-trabalhadores-de-entrada-em-espaco-confinado";
                          $nomeAchilles = "Registro de capacitação específica para vigia e trabalhadores de entrada em espaço confinado";
                          break;

                          case 26:
                          $pasta = "Outros";
                          $nomeArquivo = "registro-de-capacitacao-especifica-para-supervisores-de-entrada-em-espacos-confinados";
                          $nomeAchilles = "Registro de capacitação específica para Supervisores de Entrada em espaços confinados";
                          break;

                          case 27:
                          $pasta = "Outros";
                          $nomeArquivo = "seguridade-na-manipulacao-de-produtos-quimicos";
                          $nomeAchilles = "Seguridade na Manipulação de Produtos Químicos";
                          break;

                          case 28:
                          $pasta = "Outros";
                          $nomeArquivo = "motorista-de-transporte-de-produtos-perigosos";
                          $nomeAchilles = "Motorista de Transporte de Produtos Perigosos";
                          break;

                          case 29:
                          $pasta = "Outros";
                          $nomeArquivo = "registro-de-treinamento-dos-colaboradores-em-prevencao-contra-incendios";
                          $nomeAchilles = "Registro de treinamento dos colaboradores em Prevenção contra incêndios";
                          break;

                          case 30:
                          $pasta = "Outros";
                          $nomeArquivo = "oficina-de-lideranca-de-seguranca-e-saude";
                          $nomeAchilles = "Oficina de Liderança de Segurança e Saúde";
                          break;

                        }


                        $Upload->UploadRH($d_UploadFile, $nomeArquivo, "Achiles/{$ID}/{$p}");

                        $caminhoAchilles = "/Achiles/{$ID}/{$p}/{$nomeArquivo}";

                        if ($Upload->getResult()){
                          $d_gbCreate = array('IdFuncionario' => $PostData['idfuncionario'], 'Tipo' => $nomeAchilles, 'Caminho' => "$caminhoAchilles", 'Status' => 0, 'IdUsuario' => $_SESSION['userLogin']['ID']);

                          $Read->FullRead("SELECT IdFuncionario, Tipo, Caminho FROM [30_Documentacao] WHERE IdFuncionario = :IDFUNC1 AND Tipo = :VTIPO AND Caminho = :VCAMINHO AND Status = 0", "IDFUNC1={$PostData['idfuncionario']}&VTIPO={$nomeAchilles}&VCAMINHO={$caminhoAchilles}");

                          if (empty($Read->getResult())) {
                            $Create->ExeCreate('[30_Documentacao]', $d_gbCreate);
                            $jSON['trigger'] = AjaxErro('Arquivos anexados com sucesso!');
                          } else{
                            $jSON['trigger'] = AjaxErro('Arquivos atualizados com sucesso!');
                          }
                        }
                      endforeach;
                    endif;
                  endif;
                }
                break;

                
                case 'selecionarFuncionario':
                $SL = $PostData['funcionarioid'];

                $Read->FullRead("SELECT IdFuncionario AS id, Tipo, Caminho AS caminho FROM [30_Documentacao] WHERE IdFuncionario = :IDFUNC", "IDFUNC={$PostData['funcionarioid']}");
                $idfuncionario = $Read->getResult();

                $value = null;
                $jSON['tipo'] = null;

                if ($idfuncionario) {
                  foreach ($idfuncionario as $value) {
                    extract($value);
                    $value['caminho'];
                    $variavelSwitch = $value['Tipo'];
                    $caminhoPadrao = "//192.168.0.101:83/Pedro/novatec/uploads/Achiles/{$value['id']}/";
                    $caminhoDiretorio = "//192.168.0.101/xampp/htdocs/Pedro/novatec/uploads/Achiles/{$value['id']}/";
                    //var_dump($value['id']);

                    switch ($variavelSwitch) {

                      case "Certificado Empresarial de Informação de Riscos Laborais - Distribuição de Gás":
                      $nomeT = "certificado-empresarial-de-informacao-de-riscos-laborais-distribuicao-de-gas";
                      $valor = 0;
                      break;

                      case "Certificado Empresarial de Informação de Riscos Laborais - Recursos e Serviços":
                      $nomeT = "cert-inf-riscos-recursos-e-servicos";
                      $valor = 1;
                      break;

                      case "Entrega de EPIs":
                      $valor = 2;
                      $nomeT = "entrega-de-epis";
                      break;

                      case "Certificado Empresarial de Formação":
                      $valor = 3;
                      $nomeT = "certificado-empresarial-de-formacao";
                      break;

                      case "Carteira Nacional de Habilitação":
                      $valor = 4;
                      $nomeT = "carteira-nacional-de-habilitacao";
                      break;

                      case "Carteira de Trabalho ASSINADA, Inclusive página que consta o cargo/função":
                      $valor = 5;
                      $nomeT = "carteira-de-trabalho-assinada-inclusive-pagina-que-consta-o-cargo-funcao";
                      break;

                      case "Termo de Rescisão do Contrato de Trabalho (TRCT)":
                      $valor = 6;
                      $nomeT = "termo-de-rescisao-do-contrato-de-trabalho-trct";
                      break;

                      case "Guia de Recolhimento da Receita Federal":
                      $valor = 7;
                      $nomeT = "guia-de-recolhimento-da-receita-federal";
                      break;

                      case "Folha de Ponto assinada pelo empregado":
                      $valor = 8;
                      $nomeT = "folha-de-ponto-assinada-pelo-empregado";
                      break;

                      case "Aviso de Férias assinado e comprovante de pagamento do terço constitucional":
                      $valor = 9;
                      $nomeT = "aviso-de-ferias-assinado-e-comprovante-de-pagamento-do-terco-constitucional";
                      break;

                      case "Contrato de Trabalho":
                      $valor = 10;
                      $nomeT = "contrato-de-trabalho";
                      break;

                      case "Atestado de Saúde Ocupacional - ASO (admissional, periódico e demissional)":
                      $valor = 11;
                      $nomeT = "atestado-de-saude-ocupacional-aso-admissional-periodico-e-demissional";
                      break;

                      case "Registro Técnico do Responsável Técnico da empresa - Pessoa Física":
                      $nomeT = "registro-tecnico-do-responsavel-tecnico-da-empresa-pessoa-fisica";
                      $valor = 12;
                      break;

                      case "Certificação de JO":
                      $valor = 13;
                      $nomeT = "certificacao-de-jo";
                      break;

                      case "Certificação de Desenhista de campo":
                      $valor = 14;
                      $nomeT = "certificacao-de-desenhista-de-campo";
                      break;

                      case "Certificação/Qualificação de Soldadores de Aço":
                      $valor = 15;
                      $nomeT = "certificacao-qualificacao-de-soldadores-de-aco";
                      break;

                      case "Certificação de Inspetores de Solda de Aço":
                      $valor = 16;
                      $nomeT = "certificacao-de-inspetores-de-solda-de-aco";
                      break;

                      case "Certificação de Soldadores de PE":
                      $valor = 17;
                      $nomeT = "certificacao-de-soldadores-de-pe";
                      break;

                      case "Certificação de Inspetores de Alta":
                      $valor = 18;
                      $nomeT = "certificacao-de-inspetores-de-alta";
                      break;

                      case "Navegador de MND":
                      $valor = 19;
                      $nomeT = "navegador-de-mnd";
                      break;

                      case "Operador MND":
                      $valor = 20;
                      $nomeT = "operador-mnd";
                      break;

                      case "Título de Certificado de Operador de Medidor":
                      $valor = 21;
                      $nomeT = "titulo-de-certificado-de-operador-de-medidor";
                      break;

                      case "Titulo de Certificado de Inspetor de Vistoria e Alta":
                      $valor = 22;
                      $nomeT = "titulo-de-certificado-de-inspetor-de-vistoria-e-alta";
                      break;

                      case "Título de Certificado de Instalador Predial de Tubulações de gás":
                      $valor = 23;
                      $nomeT = "titulo-de-certificado-de-instalador-predial-de-tubulacoes-de-gas";
                      break;

                      case "Trabalhos em Altura":
                      $valor = 24;
                      $nomeT = "trabalhos-em-altura";
                      break;

                      case "Registro de capacitação específica para vigia e trabalhadores de entrada em espaço confinado":
                      $valor = 25;
                      $nomeT = "registro-de-capacitacao-especifica-para-vigia-e-trabalhadores-de-entrada-em-espaco-confinado";
                      break;

                      case "Registro de capacitação específica para Supervisores de Entrada em espaços confinados":
                      $valor = 26;
                      $nomeT = "registro-de-capacitacao-especifica-para-supervisores-de-entrada-em-espacos-confinados";
                      break;

                      case "Seguridade na Manipulação de Produtos Químicos":
                      $valor = 27;
                      $nomeT = "seguridade-na-manipulacao-de-produtos-quimicos";
                      break;

                      case "Motorista de Transporte de Produtos Perigosos":
                      $valor = 28;
                      $nomeT = "motorista-de-transporte-de-produtos-perigosos";
                      break;

                      case "Registro de treinamento dos colaboradores em Prevenção contra incêndios":
                      $valor = 29;
                      $nomeT = "registro-de-treinamento-dos-colaboradores-em-prevencao-contra-incendios";
                      break;

                      case "Oficina de Liderança de Segurança e Saúde":
                      $valor = 30;
                      $nomeT = "oficina-de-lideranca-de-seguranca-e-saude";
                      break;

                    }

                    $versao1 = $caminhoDiretorio.$valor."/";


                    /* VERIFICA SE O DIRETORIO TEM ARQUIVO*/
                    $path = $versao1;
                    $diretorio = dir($path);
                    while ($arquivo = $diretorio -> read()) {
                      $dirArquivo = $path.$arquivo;
                    }
                    $diretorio -> close();
                    /* ACABA AQUI */

                    $caralho = pathinfo($dirArquivo);
                    $agoraVai = $caralho['extension'];


                    $capiroto = $caminhoPadrao.$valor."/".$nomeT.".".$agoraVai;

                     $jSON['tipo'] .= "<tr> <td> $Tipo </td> <td> <center><a href='$capiroto' download><span class='btn btn_darkblue' style='padding: 8px;'> Download </span> </a> </center> </td> </tr>";
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
              die('<br><br><br><center><h1>Acesso Restrito!</h1></center>');
            endif;
