
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

  if (empty($Check)):
    $Check = new Check;
  endif;

  if (empty($Doc)):
    $Doc = new Doc;
  endif;

    //SELECIONA AÇÃO
  switch ($Case):

    case 'selectfuncionarios':

    $jSON['teste'] = NULL;
    $dir = "//192.168.0.101/xampp/htdocs/novatec/uploads/Achiles/";
    $files = count(array_slice(scandir($dir), 2));

    $jSON['teste'] = AjaxErro("{$files}"." funcionários cadastrados até o momento.");


    $Read->FullRead("SELECT [Funcionários].ID AS id,[NOME COMPLETO] AS nome FROM Funcionários WHERE [DATA DE DEMISSÃO] IS NULL ORDER BY [NOME COMPLETO]"," ");
    $variavelSelect = $Read->getResult();

      $jSON['nome'] = NULL;//ANTES DO FOREACH VOCÊ DEVE DECLARAR COMO NULL
      $FUNC = NULL;//ANTES DO FOREACH VOCÊ DEVE DECLARAR COMO NULL
      $jSON['nomeD'] = NULL;


      if ($variavelSelect) {
        foreach ($Read->getResult() as $FUNC) {
          $jSON['nome'] .= "<option value='{$FUNC['id']}'>{$FUNC['nome']}</option>";
        }
      }

      $Read->FulLRead("SELECT [Funcionários].ID AS id,[NOME COMPLETO] AS nome FROM Funcionários WHERE [DATA DE DEMISSÃO] IS NOT NULL ORDER BY [NOME COMPLETO]"," ");
      $variavelSelect2 = $Read->getResult();

      if ($variavelSelect2) {
        foreach ($variavelSelect2 as $FUNC) {
          $jSON['nomeD'] .= "<option value='{$FUNC['id']}'>{$FUNC['nome']}</option>";
        }
      }


      $SL = $PostData['pegarIdFUNC'];

      $Read->FullRead("SELECT [30_TipoDocumentacao].ID AS IDOC, [30_TipoDocumentacao].NOME AS NOMEDOC, [30_TipoDocumentacao].CATEGORIA AS categoria FROM [30_TipoCargosB]
        INNER JOIN [30_TipoDocumentacao] ON [30_TipoDocumentacao].Id = [30_TipoCargosB].IdTipoDoc
        WHERE IdCargosB = (SELECT [30_CargosB].ID FROM [30_CargosB]
        INNER JOIN [30_Cargos] ON [30_Cargos].TITULOB = [30_CargosB].ID
        INNER JOIN [Funcionários] ON [Funcionários].[TITULO (FUNÇÃO)] = [30_Cargos].[ID]
        WHERE [Funcionários].ID = :IDFUNC AND [30_TipoDocumentacao].ID != 32)", "IDFUNC={$PostData['pegarIdFUNC']}");
      $idfuncionario = $Read->getResult();

      $value = null;
      $jSON['tipo'] = null;
      $jSON['tipo1'] = null;
      $jSON['tipo2'] = null;
      $jSON['tipo3'] = null;
      $mudarvariavel = "";
      $value1 = null;
      $diretorionull = null;
      $visualizardoc = null;
      $valor = null;
      $outrosdoc = null;
      $REQUEST_URI = substr($_SERVER['REQUEST_URI'], 0, 15);

      if ($idfuncionario) {
        foreach ($idfuncionario as $value) {
          extract($value);


          $Read->FullRead("SELECT IdFuncionario AS id ,DataValidade AS data, Tipo, Status AS stat, TipoData AS typedate FROM [30_Documentacao] WHERE IdTipoDocumento = :IDDOC AND IdFuncionario = :IDFUNCI", "IDDOC={$value['IDOC']}&IDFUNCI={$PostData['pegarIdFUNC']}");
          $idtipo = $Read->getResult();

          if ($idtipo) {
            foreach ($idtipo as $value1) {
              extract($value1);
            }

            if ($idtipo == NULL) {
              $variavelData = $mudarvariavel;
              $stat = $mudarvariavel;
              $variavelSwitch = $mudarvariavel;
            } else{
              $iddata = $value1['data'];
              $stat = $value1['stat'];
              $variavelSwitch = $value1['Tipo'];
            }

            if ($stat == 2) {
              $stat = '<a class="icon-checkmark">';
            }elseif($stat == 1){
              $stat = '<a class="icon-cross">';
            }

            $variavelData = str_replace("-", "/", $iddata);
            $variavelDataM = str_replace("-", "", $iddata);
            $dataBr = date('d/m/Y', strtotime($variavelData));
            $dataBr1 = date('d-m-Y', strtotime($iddata));
            $dia_atual = str_replace("-", "", date("Y-m-d"));
            $dia_atual_br = date("d-m-Y");
            $pegarDiretorio = substr(realpath(dirname(__FILE__)), 3, 18);
            $teste = str_replace("\\", "/", $pegarDiretorio);
            $dataTeste = pathinfo($iddata);
            $basename = pathinfo($pegarDiretorio);
            $caminhoPadrao = "//".$_SERVER['HTTP_HOST'].$REQUEST_URI."uploads/Achiles/{$value1['id']}/"; //CAMINHO PARA REALIZAR O DONWLOAD DO ARQUIVO
            $caminhoDiretorio = "//".$_SERVER['SERVER_NAME']."/xampp/htdocs".$REQUEST_URI."uploads/Achiles/{$value1['id']}/"; //CAMINHO PARA VERIFICAR SE O ARQUIVO EXISTE DENTRO DA PASTA NO SISTEMA
                    //SE A VALIDADE PASSAR DA DATA DO DIA ATUAL MOSTRA A COR VERMELHA

            if ($variavelDataM > $dia_atual AND $value1['typedate'] == 1) {
              $variavelData = '<b><font color="green">'.$dataBr;
            } elseif ($variavelDataM <= $dia_atual AND $value1['typedate'] == 1) {
              $variavelData = '<b><font color="red">'.$dataBr; 
            } elseif ($value1['typedate'] == 0) {
              $variavelData = $dataBr;
            }

            $data = new DateTime($dia_atual);
                  $data1 = new DateTime($dataBr1); //DATA DOS DOCUMENTOS
                  $data2 = new DateTime($dia_atual); //DATA ATUAL
                  $data->add(new DateInterval('P31D')); //DATA ATUAL MAIS UM MÊS

                  if ($data1 > $data2 AND $data1 <= $data AND $value1['typedate'] == 1) {
                    $variavelData = '<b><font color="orange">'.$dataBr;
                  }

                  $docType = $Doc->exibir($variavelSwitch);

                  $versao1 = $caminhoDiretorio.$docType[1]."/";

                  /* VERIFICA SE O DIRETORIO TEM ARQUIVO*/
                  $path = $versao1;
                  $diretorio = dir($path);
                  while ($arquivo = $diretorio -> read()) {
                    $dirArquivo = $path.$arquivo;
                  }
                  $diretorio -> close();
                  /* ACABA AQUI */

                  $getPath = pathinfo($dirArquivo);
                  $getExt = $getPath['extension'];
                }//IF LÁ DO IDTIPO PERTO DO FOREACH

                //CONDIÇÃO PARA APARECER NA TELA, SE O VALOR DO NOME DO DOCUMENTO VIER NULO DO BANCO DE DADOS, NÃO IRÁ APARECER NADA.
                if ($idtipo == NULL) {
                  $diretorionull = $mudarvariavel;
                  $variavelData = $mudarvariavel;
                  $stat = $mudarvariavel;
                  $visualizardoc = $mudarvariavel;
                }else{
                  $dirFinal = $caminhoPadrao.$docType[1]."/".$docType[0].".".$getExt;
                  $diretorionull = "<a href='{$dirFinal}' download><span class='btn btn_darkblue'>Download</span></a>";
                  $visualizardoc = "<a style='color: black; text-decoration: none;' class='icon-eye' target='_blank' href='{$dirFinal}' rel='shadowbox'></a>";
                }

                $variavelDataExtract = pathinfo($variavelData);

                if ($variavelDataExtract['basename'] == "1969") {
                  $variavelData = "Não validado."; 
                }

                $jSON['tipo'] .= "<tr><td>$NOMEDOC</td><td><center>$variavelData</center></td><td><center>$stat</center></td><td><center>$diretorionull</center></td><td><center>$visualizardoc</center></td></tr>";
              }
            }
            $Read->FullRead("SELECT IdFuncionario AS idd ,Tipo as TYPEDOCS, DataValidade AS data, IdTipoDocumento FROM [30_Documentacao] WHERE Status = 3 AND IdFuncionario = :IDFUNQ", "IDFUNQ={$PostData['pegarIdFUNC']}");
            $outrosdocumentos = $Read->getResult();
            $REQUEST_URI = substr($_SERVER['REQUEST_URI'], 0, 15);

            if ($outrosdocumentos) {
              foreach ($outrosdocumentos as $doc) {
                extract($doc);
                $TYPEDOCS = $doc['TYPEDOCS'];
                $DATE = $doc['data'];
                $datareplace = str_replace("-", "/", $DATE);
                $datareal = date('d/m/Y', strtotime($datareplace));
                $caminhoPadrao = "//".$_SERVER['HTTP_HOST'].$REQUEST_URI."uploads/Achiles/{$doc['idd']}/"; //CAMINHO PARA REALIZAR O DONWLOAD DO ARQUIVO
                $caminhoDiretorio = "//".$_SERVER['SERVER_NAME']."/xampp/htdocs".$REQUEST_URI."uploads/Achiles/{$doc['idd']}/"; //CAMINHO PARA VERIFICAR SE O ARQUIVO EXISTE DENTRO DA PASTA NO SISTEMA

                $versao1 = $caminhoDiretorio."32/";
                /* VERIFICA SE O DIRETORIO TEM ARQUIVO*/
                $path = $versao1;
                $diretorio = dir($path);
                while ($arquivo = $diretorio -> read()) {
                  $dirArquivo = $path.$arquivo;
                }
                $diretorio -> close();
                /* ACABA AQUI */

                $getPath = pathinfo($dirArquivo);
                $getExt = $getPath['extension'];

                $outraspastas = $caminhoPadrao."32/".$TYPEDOCS.".".$getExt;
                $dirOutros = "<a href='{$outraspastas}' download><span class='btn btn_darkblue'>Download</span></a>";
                $docview = "<a style='color: black; text-decoration: none;' class='icon-eye' target='_blank' href='{$outraspastas}' rel='shadowbox'></a>";

                $jSON['tipo1'] = "<tr><td style='padding: 11px;border: 1px solid #ffffff;background: #fefefe;'></td></tr>";
                $jSON['tipo2'] =  "<tr><th>Documentos</th><th>Data Doc.</th><th style='width: 15%;'>Download</th><th style='width: 5%;'>Vis.</th></tr>";
                $jSON['tipo3'] .= "<tr><td><center>$TYPEDOCS</center></td><td><center>$datareal</center></td><td><center>$dirOutros</center></td><td><center>$docview</center></td></tr>";
              }
            }
            break;

            case 'enviar_documentos':

            $variavel = null;
            $get = null;
            $status = 1;
            $fileSize = null;

            if (isset($PostData['idfuncionario'])) {
              $variavel = $PostData['idfuncionario'];
            }elseif (isset($PostData['idfuncionarioD'])) {
              $variavel = $PostData['idfuncionarioD'];
            }

            //$Read->FullRead("SELECT [NOME COMPLETO] AS nome FROM Funcionários WHERE ID = :IDFUNC","IDFUNC={$variavel}");

             // FOTOS DEFEITOS                
            if (empty($Upload)):
              $Upload = new Upload('../../uploads/');
            endif;

            if(isset($_FILES['documentosRH'])):

              $d_title = "DocumentoRh";
              $d_arquivos = array($_FILES['documentosRH']['size']);
              $d_GalleryId = $variavel;
              $d_Image = (!empty($_FILES['documentosRH']) ? $_FILES['documentosRH'] : NULL);
              $d_Size = (!empty($_FILES['documentosRH']['size']) ? array_sum($d_arquivos) : NULL);
              $d_GalleryName = Check::Name($d_title);

              if (!empty($d_Image)):
                $d_File = $d_Image;
                $d_gbFile = array();
                $d_gbCount = count($d_File['type']);
                $d_gbKeys = array_keys($d_File);
                $d_gbLoop = 0;
                $contador = 0;

                for ($gb = 0; $gb < $d_gbCount; $gb++):
                  foreach ($d_gbKeys as $Keys):
                    $d_gbFiles[$gb][$Keys] = $d_File[$Keys][$gb];
                  endforeach;
                endfor;

                foreach ($d_gbFiles as $d_UploadFile):
                  $value = null;
                         $d = ($_FILES['documentosRH']['name'][$d_gbLoop]); // Nome do ARQUIVO sendo enviado
                         $datavalidade = ($PostData['validade'. $d_gbLoop]);
                         $p = ($PostData['tipoArquivo'. $d_gbLoop]); // Tipo do ARQUIVO no SELECT (EPIs, Outros)...
                         $fileSize = $_FILES['documentosRH']['size'][$d_gbLoop]; // PEGA O TAMANHO DO ARQUIVO SENDO ENVIADO
                         $y = pathinfo($d);
                         $d_gbLoop ++;

                         //SE VALOR DO $TIPODATA FOR 1 O ARQUIVO RECEBE DATA DE VENCIMENTO
                         //SE VALOR DO $TIPODATA FOR 0 O ARQUIVO RECEBE DATA DE EMISSÃO

                         switch ($p):
                          case 1:
                          $pasta = "Cert. Inf. Riscos - Distribuicao Gas";
                          $nomeArquivo = "certificado-empresarial-de-informacao-de-riscos-laborais-distribuicao-de-gas";
                          $nomeAchilles = "Certificado Empresarial de Informação de Riscos Laborais - Distribuição de Gás";
                          $IdTipoDocumento = 1;
                          $TipoData = 0;
                          $status = 1; 
                          break;

                          case 2:
                          $pasta = "Cert. Inf. Riscos - Recursos e Servicos";
                          $nomeArquivo = "cert-inf-riscos-recursos-e-servicos";
                          $nomeAchilles = "Certificado Empresarial de Informação de Riscos Laborais - Recursos e Serviços";
                          $IdTipoDocumento = 2;
                          $TipoData = 0;
                          $status = 1;
                          break;

                          case 3:
                          $pasta = "Ent. EPIs";
                          $nomeArquivo = "entrega-de-epis";
                          $nomeAchilles = "Entrega de EPIs";
                          $IdTipoDocumento = 3;
                          $TipoData = 0;
                          $status = 1;
                          break;

                          case 4:
                          $pasta = "Cert. Emp. Formaçao";
                          $nomeArquivo = "certificado-empresarial-de-formacao";
                          $nomeAchilles = "Certificado Empresarial de Formação";
                          $IdTipoDocumento = 4;
                          $TipoData = 0;
                          $status = 1;
                          break;

                          case 5:
                          $pasta = "Cart. Nacion. Habilitacao";
                          $nomeArquivo = "carteira-nacional-de-habilitacao";
                          $nomeAchilles = "Carteira Nacional de Habilitação";
                          $IdTipoDocumento = 5;
                          $TipoData = 1;
                          $status = 1;
                          break;

                          case 6:
                          $pasta = "Cart. ASSINADA";
                          $nomeArquivo = "carteira-de-trabalho-assinada-inclusive-pagina-que-consta-o-cargo-funcao";
                          $nomeAchilles = "Carteira de Trabalho ASSINADA, Inclusive página que consta o cargo/função";
                          $IdTipoDocumento = 6;
                          $TipoData = 0;
                          $status = 1;
                          break;

                          case 7:
                          $pasta = "Termo Rescisao Contrato (TRCT)";
                          $nomeArquivo = "termo-de-rescisao-do-contrato-de-trabalho-trct";
                          $nomeAchilles = "Termo de Rescisão do Contrato de Trabalho (TRCT)";
                          $IdTipoDocumento = 7;
                          $TipoData = 0;
                          $status = 1;
                          break;

                          case 8:
                          $pasta = "Guia Recolhimento Federal";
                          $nomeArquivo = "guia-de-recolhimento-da-receita-federal";
                          $nomeAchilles = "Guia de Recolhimento da Receita Federal";
                          $IdTipoDocumento = 8;
                          $TipoData = 0;
                          $status = 1;
                          break;

                          case 9:
                          $pasta = "Folha de Ponto. Empregado";
                          $nomeArquivo = "folha-de-ponto-assinada-pelo-empregado";
                          $nomeAchilles = "Folha de Ponto assinada pelo empregado";
                          $IdTipoDocumento = 9;
                          $TipoData = 1; 
                          $status = 1;
                          break;

                          case 10:
                          $pasta = "Aviso de Ferias";
                          $nomeArquivo = "aviso-de-ferias-assinado-e-comprovante-de-pagamento-do-terco-constitucional";
                          $nomeAchilles = "Aviso de Férias assinado e comprovante de pagamento do terço constitucional";
                          $IdTipoDocumento = 10;
                          $TipoData = 1;
                          $status = 1;
                          break;

                          case 11:
                          $pasta = "Contrato de Trabalho";
                          $nomeArquivo = "contrato-de-trabalho";
                          $nomeAchilles = "Contrato de Trabalho";
                          $IdTipoDocumento = 11;
                          $TipoData = 0;
                          $status = 1;
                          break;

                          case 12:
                          $pasta = "Ates. Ocupacional - ASO";
                          $nomeArquivo = "atestado-de-saude-ocupacional-aso-admissional-periodico-e-demissional";
                          $nomeAchilles = "Atestado de Saúde Ocupacional - ASO (admissional, periódico e demissional)";
                          $IdTipoDocumento = 12;
                          $TipoData = 1;
                          $status = 1;
                          break;

                          case 13:
                          $pasta = "Regi. Responsavel Tecnico Empresa";
                          $nomeArquivo = "registro-tecnico-do-responsavel-tecnico-da-empresa-pessoa-fisica";
                          $nomeAchilles = "Registro Técnico do Responsável Técnico da empresa - Pessoa Física";
                          $IdTipoDocumento = 13;
                          $TipoData = 1;
                          $status = 1;
                          break;

                          case 14:
                          $pasta = "Outros";
                          $nomeArquivo = "certificacao-de-jo";
                          $nomeAchilles = "Certificacão de JO";
                          $IdTipoDocumento = 14;
                          $TipoData = 1;
                          $status = 1;
                          break;

                          case 15:
                          $pasta = "Outros";
                          $nomeArquivo = "certificacao-de-desenhista-de-campo";
                          $nomeAchilles = "Certificação de Desenhista de campo";
                          $IdTipoDocumento = 15;
                          $TipoData = 1;
                          $status = 1;
                          break;

                          case 16:
                          $pasta = "Outros";
                          $nomeArquivo = "certificacao-qualificacao-de-soldadores-de-aco";
                          $nomeAchilles = "Certificacão/Qualificacão de Soldadores de Aço";
                          $IdTipoDocumento = 16;
                          $TipoData = 1;
                          $status = 1;
                          break;

                          case 17:
                          $pasta = "Outros";
                          $nomeArquivo = "certificacao-de-inspetores-de-solda-de-aco";
                          $nomeAchilles = "Certificacão de Inspetores de Solda de Aço";
                          $IdTipoDocumento = 17;
                          $TipoData = 1;
                          $status = 1;
                          break;

                          case 18:
                          $pasta = "Outros";
                          $nomeArquivo = "certificacao-de-soldadores-de-pe";
                          $nomeAchilles = "Certificacão de Soldadores de PE";
                          $IdTipoDocumento = 18;
                          $TipoData = 1;
                          $status = 1;
                          break;

                          case 19:
                          $pasta = "Outros";
                          $nomeArquivo = "certificacao-de-inspetores-de-alta";
                          $nomeAchilles = "Certificacão de Inspetores de Alta";
                          $IdTipoDocumento = 19;
                          $TipoData = 1;
                          $status = 1;
                          break;

                          case 20:
                          $pasta = "Outros";
                          $nomeArquivo = "navegador-de-mnd";
                          $nomeAchilles = "Navegador de MND";
                          $IdTipoDocumento = 20;
                          $TipoData = 1;
                          $status = 1;
                          break;

                          case 21:
                          $pasta = "Outros";
                          $nomeArquivo = "operador-mnd";
                          $nomeAchilles = "Operador MND";
                          $IdTipoDocumento = 21;
                          $TipoData = 1;
                          $status = 1;
                          break;

                          case 22:
                          $pasta = "Outros";
                          $nomeArquivo = "titulo-de-certificado-de-operador-de-medidor";
                          $nomeAchilles = "Título de Certificado de Operador de Medidor";
                          $IdTipoDocumento = 22;
                          $TipoData = 1;
                          $status = 1;
                          break;

                          case 23:
                          $pasta = "Outros";
                          $nomeArquivo = "titulo-de-certificado-de-inspetor-de-vistoria-e-alta";
                          $nomeAchilles = "Título de Certificado de Inspetor de Vistoria e Alta";
                          $IdTipoDocumento = 23;
                          $TipoData = 1;
                          $status = 1;
                          break;

                          case 24:
                          $pasta = "Outros";
                          $nomeArquivo = "titulo-de-certificado-de-instalador-predial-de-tubulacoes-de-gas";
                          $nomeAchilles = "Título de Certificado de Instalador Predial de Tubulacoes de gás";
                          $IdTipoDocumento = 24;
                          $TipoData = 1;
                          $status = 1;
                          break;

                          case 25:
                          $pasta = "Outros";
                          $nomeArquivo = "trabalhos-em-altura";
                          $nomeAchilles = "Trabalhos em Altura";
                          $IdTipoDocumento = 25;
                          $TipoData = 1;
                          $status = 1;
                          break;

                          case 26:
                          $pasta = "Outros";
                          $nomeArquivo = "registro-de-capacitacao-especifica-para-vigia-e-trabalhadores-de-entrada-em-espaco-confinado";
                          $nomeAchilles = "Registro de capacitação específica para vigia e trabalhadores de entrada em espaço confinado";
                          $IdTipoDocumento = 26;
                          $TipoData = 1;
                          $status = 1;
                          break;

                          case 27:
                          $pasta = "Outros";
                          $nomeArquivo = "registro-de-capacitacao-especifica-para-supervisores-de-entrada-em-espacos-confinados";
                          $nomeAchilles = "Registro de capacitação específica para Supervisores de Entrada em espaços confinados";
                          $IdTipoDocumento = 27;
                          $TipoData = 1;
                          $status = 1;
                          break;

                          case 28:
                          $pasta = "Outros";
                          $nomeArquivo = "seguridade-na-manipulacao-de-produtos-quimicos";
                          $nomeAchilles = "Seguridade na Manipulação de Produtos Químicos";
                          $IdTipoDocumento = 28;
                          $TipoData = 1;
                          $status = 1;
                          break;

                          case 29:
                          $pasta = "Outros";
                          $nomeArquivo = "motorista-de-transporte-de-produtos-perigosos";
                          $nomeAchilles = "Motorista de Transporte de Produtos Perigosos";
                          $IdTipoDocumento = 29;
                          $TipoData = 1;
                          $status = 1;
                          break;

                          case 30:
                          $pasta = "Outros";
                          $nomeArquivo = "registro-de-treinamento-dos-colaboradores-em-prevencao-contra-incendios";
                          $nomeAchilles = "Registro de treinamento dos colaboradores em Prevenção contra incêndios";
                          $IdTipoDocumento = 30;
                          $TipoData = 1;
                          $status = 1;
                          break;

                          case 31:
                          $pasta = "Outros";
                          $nomeArquivo = "oficina-de-lideranca-de-seguranca-e-saude";
                          $nomeAchilles = "Oficina de Liderança de Segurança e Saúde";
                          $IdTipoDocumento = 31;
                          $TipoData = 1;
                          $status = 1;
                          break;

                          case 32:
                          $get = ($PostData['nomepasta'. $contador]);
                          $pasta = "Documentos fora do Achilles";
                          $nomeArquivo = $Check->Name($get);
                          $nomeAchilles = $Check->Name($get);
                          $IdTipoDocumento = 32;
                          $TipoData = 3;
                          $status = 3;
                          $contador++;
                          break;
                        endswitch;

                        $Read->FullRead("SELECT [30_TipoDocumentacao].ID AS IDOC FROM [30_TipoCargosB]
                          INNER JOIN [30_TipoDocumentacao] ON [30_TipoDocumentacao].Id = [30_TipoCargosB].IdTipoDoc
                          WHERE IdCargosB = (SELECT [30_CargosB].ID FROM [30_CargosB]
                          INNER JOIN [30_Cargos] ON [30_Cargos].TITULOB = [30_CargosB].ID
                          INNER JOIN [Funcionários] ON [Funcionários].[TITULO (FUNÇÃO)] = [30_Cargos].[ID]
                          WHERE [Funcionários].ID = :IDFUNC AND [30_TipoDocumentacao].ID = :DOCUMENT)", "IDFUNC={$variavel}&DOCUMENT={$p}");
                        $arquivosfunc = $Read->getResult();

                        $caminhoAchilles = "/Achiles/{$variavel}/{$p}/{$nomeArquivo}";

                        if ($y['extension'] <> "pdf" OR $y['extension'] <> "jpg" OR $y['extension'] <> "jpeg" OR $y['extension'] <> "png") {
                         $jSON['trigger'] = AjaxErro('Extensão de arquivo inválida. Formatos aceitos: .pdf, .jpg, .jpeg ou .png');
                       }

                       if ($datavalidade <> "" AND $fileSize<4000001) {
                         $Upload->UploadRH($d_UploadFile, $nomeArquivo, "Achiles/{$variavel}/{$p}");
                       }

                       if ($Upload->getResult()){
                        $d_gbCreate = array('IdFuncionario' => $variavel, 'Tipo' => $nomeAchilles, 'Caminho' => "$caminhoAchilles", 'Status' => "$status", 'IdUsuario' => $_SESSION['userLogin']['ID'], 'DataValidade' => $datavalidade, 'IdTipoDocumento' => $IdTipoDocumento, 'TipoData' => $TipoData);

                        $Read->FullRead("SELECT IdFuncionario, Tipo, Caminho, IdTipoDocumento FROM [30_Documentacao] WHERE IdFuncionario = :IDFUNC1 AND Tipo = :VTIPO AND Caminho = :VCAMINHO AND IdTipoDocumento = :IDDOC AND Status = 1", "IDFUNC1={$variavel}&VTIPO={$nomeAchilles}&VCAMINHO={$caminhoAchilles}&IDDOC={$IdTipoDocumento}");
                        $resultadoRH = $Read->getResult();

                        if (empty($resultadoRH)) {
                          if ($datavalidade <> "" AND $arquivosfunc <> NULL AND $fileSize<4000001) {
                            $d_gbCreate["DataValidade"] = $datavalidade;
                            $Create->ExeCreate('[30_Documentacao]', $d_gbCreate);
                            $jSON['trigger'] = AjaxErro('Arquivos anexados com sucesso!');
                          }else{
                            $jSON['trigger'] = AjaxErro('Tipo de documento inserido não requisitado OU tamanho de arquivo excedido. Por favor, reveja o TIPO DE DOCUMENTO.');
                          }
                        }
                        else{
                          if ($datavalidade <> "") {
                            $dataValRh = $datavalidade;
                            $dataValRH = ['DataValidade' => $dataValRh];
                            $Update->ExeUpdate("[30_Documentacao]",$dataValRH, "WHERE IdTipoDocumento = :idtipodoc AND IdFuncionario = :idfunc", "idtipodoc={$IdTipoDocumento}&idfunc={$variavel}");
                            $jSON['trigger'] = AjaxErro('Arquivos atualizados com sucesso!');
                          }
                        }
                      }

                    endforeach;
                  endif;
                endif;
                break;

                case 'selecionarFuncionarioAtivo':

                $SL = $PostData['funcionarioid'];

                $Read->FullRead("SELECT [30_TipoDocumentacao].ID AS IDOC, [30_TipoDocumentacao].NOME AS NOMEDOC, [30_TipoDocumentacao].CATEGORIA AS categoria FROM [30_TipoCargosB]
                  INNER JOIN [30_TipoDocumentacao] ON [30_TipoDocumentacao].Id = [30_TipoCargosB].IdTipoDoc
                  WHERE IdCargosB = (SELECT [30_CargosB].ID FROM [30_CargosB]
                  INNER JOIN [30_Cargos] ON [30_Cargos].TITULOB = [30_CargosB].ID
                  INNER JOIN [Funcionários] ON [Funcionários].[TITULO (FUNÇÃO)] = [30_Cargos].[ID]
                  WHERE [Funcionários].ID = :IDFUNC AND [30_TipoDocumentacao].ID != 32)", "IDFUNC={$PostData['funcionarioid']}");
                $idfuncionario = $Read->getResult();

                $value = null;
                $jSON['tipo'] = null;
                $jSON['tipo1'] = null;
                $jSON['tipo2'] = null;
                $jSON['tipo3'] = null;
                $mudarvariavel = "";
                $value1 = null;
                $diretorionull = null;
                $visualizardoc = null;
                $valor = null;
                $nomeT = null;
                $outrosdoc = null;
                $REQUEST_URI = substr($_SERVER['REQUEST_URI'], 0, 15);
                //$variavelData = null;

                if ($idfuncionario) {
                  foreach ($idfuncionario as $value) {
                    extract($value);


                    $Read->FullRead("SELECT IdFuncionario AS id ,DataValidade AS data, Tipo, Status AS stat, TipoData AS typedate FROM [30_Documentacao] WHERE IdTipoDocumento = :IDDOC AND IdFuncionario = :IDFUNCI", "IDDOC={$value['IDOC']}&IDFUNCI={$PostData['funcionarioid']}");
                    $idtipo = $Read->getResult();

                    if ($idtipo) {
                      foreach ($idtipo as $value1) {
                        extract($value1);
                      }

                      if ($idtipo == NULL) {
                        $variavelData = $mudarvariavel;
                        $stat = $mudarvariavel;
                        $variavelSwitch = $mudarvariavel;
                      } else{
                        $iddata = $value1['data'];
                        $stat = $value1['stat'];
                        $variavelSwitch = $value1['Tipo'];
                      }

                      if ($stat == 2) {
                        $stat = '<a class="icon-checkmark">';
                      }elseif($stat == 1){
                        $stat = '<a class="icon-cross">';
                      }

                      $variavelData = str_replace("-", "/", $iddata);
                      $variavelDataM = str_replace("-", "", $iddata);
                      $dataBr = date('d/m/Y', strtotime($variavelData));
                      $dataBr1 = date('d-m-Y', strtotime($iddata));
                      $dia_atual = str_replace("-", "", date("Y-m-d"));
                      $dia_atual_br = date("d-m-Y");
                      $pegarDiretorio = substr(realpath(dirname(__FILE__)), 3, 18);
                      $teste = str_replace("\\", "/", $pegarDiretorio);
                      $dataTeste = pathinfo($iddata);
                      $basename = pathinfo($pegarDiretorio);
                      $caminhoPadrao = "//".$_SERVER['HTTP_HOST'].$REQUEST_URI."uploads/Achiles/{$value1['id']}/"; //CAMINHO PARA REALIZAR O DONWLOAD DO ARQUIVO
                      $caminhoDiretorio = "//".$_SERVER['SERVER_NAME']."/xampp/htdocs".$REQUEST_URI."uploads/Achiles/{$value1['id']}/"; //CAMINHO PARA VERIFICAR SE O ARQUIVO EXISTE DENTRO DA PASTA NO SISTEMA

                    //SE A VALIDADE PASSAR DA DATA DO DIA ATUAL MOSTRA A COR VERMELHA

                      if ($variavelDataM > $dia_atual AND $value1['typedate'] == 1) {
                        $variavelData = '<b><font color="green">'.$dataBr;
                      } elseif ($variavelDataM <= $dia_atual AND $value1['typedate'] == 1) {
                        $variavelData = '<b><font color="red">'.$dataBr; 
                      } elseif ($value1['typedate'] == 0) {
                        $variavelData = $dataBr;
                      }

                  $data = new DateTime($dia_atual);
                  $data1 = new DateTime($dataBr1); //DATA DOS DOCUMENTOS
                  $data2 = new DateTime($dia_atual); //DATA ATUAL
                  $data->add(new DateInterval('P31D')); //DATA ATUAL MAIS UM MÊS

                  if ($data1 > $data2 AND $data1 <= $data AND $value1['typedate'] == 1) {
                    $variavelData = '<b><font color="orange">'.$dataBr;
                  }

                  $docType = $Doc->exibir($variavelSwitch);

                  $versao1 = $caminhoDiretorio.$docType[1]."/";

                  /* VERIFICA SE O DIRETORIO TEM ARQUIVO*/
                  $path = $versao1;
                  $diretorio = dir($path);
                  while ($arquivo = $diretorio -> read()) {
                    $dirArquivo = $path.$arquivo;
                  }
                  $diretorio -> close();
                  /* ACABA AQUI */

                  $getPath = pathinfo($dirArquivo);
                  $getExt = $getPath['extension'];

                }//IF LÁ DO IDTIPO PERTO DO FOREACH

                //CONDIÇÃO PARA APARECER NA TELA, SE O VALOR DO NOME DO DOCUMENTO VIER NULO DO BANCO DE DADOS, NÃO IRÁ APARECER NADA.

                if ($idtipo == NULL) {
                  $diretorionull = $mudarvariavel;
                  $variavelData = $mudarvariavel;
                  $stat = $mudarvariavel;
                  $visualizardoc = $mudarvariavel;
                }else{
                  $dirFinal = $caminhoPadrao.$docType[1]."/".$docType[0].".".$getExt;
                  $diretorionull = "<a href='{$dirFinal}' download><span class='btn btn_darkblue'>Download</span></a>";
                  if ($getExt == "pdf") {
                    $visualizardoc = "<a style='color: black; text-decoration: none;' class='icon-eye' target='_blank' href='{$dirFinal}'></a>";
                  }else{
                    $visualizardoc = "<a style='color: black; text-decoration: none;' class='icon-eye' target='_blank' href='{$dirFinal}' rel='shadowbox'></a>";
                  }
                }

                $variavelDataExtract = pathinfo($variavelData);

                if ($variavelDataExtract['basename'] == "1969") {
                  $variavelData = "Não validado."; 
                }

                $jSON['tipo'] .= "<tr><td>$NOMEDOC</td><td><center>$variavelData</center></td><td><center>$stat</center></td><td><center>$diretorionull</center></td><td><center>$visualizardoc</center></td></tr>";
              }
            }
            $Read->FullRead("SELECT IdFuncionario AS idd , Id as DOCID, Tipo as TYPEDOCS, DataValidade AS data, IdTipoDocumento FROM [30_Documentacao] WHERE Status = 3 AND IdFuncionario = :IDFUNQ", "IDFUNQ={$PostData['funcionarioid']}");
            $outrosdocumentos = $Read->getResult();
            $REQUEST_URI = substr($_SERVER['REQUEST_URI'], 0, 15);

            if ($outrosdocumentos) {
              foreach ($outrosdocumentos as $doc) {
                extract($doc);
                $TYPEDOCS = $doc['TYPEDOCS'];
                $DATE = $doc['data'];
                $DATEDOC = $doc['DOCID'];
                $datareplace = str_replace("-", "/", $DATE);
                $datareal = date('d/m/Y', strtotime($datareplace));
                $caminhoPadrao = "//".$_SERVER['HTTP_HOST'].$REQUEST_URI."uploads/Achiles/{$doc['idd']}/"; //CAMINHO PARA REALIZAR O DONWLOAD DO ARQUIVO COM 83
                $caminhoDiretorio = "//".$_SERVER['SERVER_NAME']."/xampp/htdocs".$REQUEST_URI."uploads/Achiles/{$doc['idd']}/"; //CAMINHO PARA VERIFICAR SE O ARQUIVO EXISTE DENTRO DA PASTA NO SISTEMA

                $versao1 = $caminhoDiretorio."32/";
                /* VERIFICA SE O DIRETORIO TEM ARQUIVO*/
                $path = $versao1;
                $diretorio = dir($path);
                while ($arquivo = $diretorio -> read()) {
                  $dirArquivo = $path.$arquivo;
                }
                $diretorio -> close();
                /* ACABA AQUI */

                $getPath = pathinfo($dirArquivo);
                $getExt = $getPath['extension'];

                $outraspastas = $caminhoPadrao."32/".$TYPEDOCS.".".$getExt;
                $dirOutros = "<a href='{$outraspastas}' download><span class='btn btn_darkblue'>Download</span></a>";
                $docview = "<a style='color: black; text-decoration: none;' class='icon-eye' target='_blank' href='{$outraspastas}' rel='shadowbox'></a>";

                $jSON['tipo1'] = "<tr><td style='padding: 11px;border: 1px solid #ffffff;background: #fefefe;'></td></tr>";
                $jSON['tipo2'] =  "<tr><th>Documentos</th><th>Data Doc.</th><th style='width: 15%;'>Download</th><th style='width: 5%;'>Vis.</th><th style='width: 5%;'>Excluir</th></tr>";
                $jSON['tipo3'] .= "<tr id='{$DATEDOC}' class='trdoc'><td><center>$TYPEDOCS</center></td><td><center>$datareal</center></td><td><center>$dirOutros</center></td><td><center>$docview</center></td><td><center><span id='delete' class='btn btn_red icon-cross' style='width: 85%;'></span></center></td></tr>";
              }
            }
            break;



            case 'delete':
            $deleteclick = $PostData['getclick'];

            $Read->FullRead("SELECT Id AS tableid ,IdFuncionario AS idd , Id as DOCID, Tipo as TYPEDOCS, DataValidade AS data, IdTipoDocumento FROM [30_Documentacao] WHERE Status = 3 AND IdFuncionario = :IDFUNQ AND Id = :TABLEID", "IDFUNQ={$PostData['func']}&TABLEID={$PostData['getclick']}");
            $outrosdocumentos = $Read->getResult();
            $REQUEST_URI = substr($_SERVER['REQUEST_URI'], 0, 15);

            foreach ($outrosdocumentos as $doc) {
              extract($doc);
              $TYPEDOCS = $doc['TYPEDOCS'];
                  $caminhoPadrao = "//".$_SERVER['HTTP_HOST'].$REQUEST_URI."uploads/Achiles/{$doc['idd']}/"; //CAMINHO PARA REALIZAR O DONWLOAD DO ARQUIVO COM 83
                  $caminhoDiretorio = "//".$_SERVER['SERVER_NAME']."/xampp/htdocs".$REQUEST_URI."uploads/Achiles/{$doc['idd']}/"; //CAMINHO PARA VERIFICAR SE O ARQUIVO EXISTE DENTRO DA PASTA NO SISTEMA

                  $versao1 = $caminhoDiretorio."32/";
                  /* VERIFICA SE O DIRETORIO TEM ARQUIVO*/
                  $path = $versao1;
                  $diretorio = dir($path);
                  while ($arquivo = $diretorio -> read()) {
                    $dirArquivo = $path.$arquivo;
                  }
                  $diretorio -> close();
                  /* ACABA AQUI */

                  $getPath = pathinfo($dirArquivo);
                  $getExt = $getPath['extension'];

                  $outraspastas = $caminhoDiretorio."32/".$TYPEDOCS.".".$getExt;

                  if ($deleteclick){
                    $Delete->ExeDelete("[30_Documentacao]", "WHERE Id = :idoutrosdoc", "idoutrosdoc={$deleteclick}");
                    unlink($outraspastas);
                  }
                }

                break;


                //SELECT DOS FUNCIONÁRIOS DEMITIDOS//
                //*************************************************************SPACE************************************************************************//
                //*************************************************************SPACE************************************************************************//
                //*************************************************************SPACE************************************************************************//
                //*************************************************************SPACE************************************************************************//
                //*************************************************************SPACE************************************************************************//


                case 'selecionarFuncionarioDemitido':
                $SLD = $PostData['funcionarioDid'];

                $Read->FullRead("SELECT [30_TipoDocumentacao].ID AS IDOC, [30_TipoDocumentacao].NOME AS NOMEDOC, [30_TipoDocumentacao].CATEGORIA AS categoria FROM [30_TipoCargosB]
                  INNER JOIN [30_TipoDocumentacao] ON [30_TipoDocumentacao].Id = [30_TipoCargosB].IdTipoDoc
                  WHERE IdCargosB = (SELECT [30_CargosB].ID FROM [30_CargosB]
                  INNER JOIN [30_Cargos] ON [30_Cargos].TITULOB = [30_CargosB].ID
                  INNER JOIN [Funcionários] ON [Funcionários].[TITULO (FUNÇÃO)] = [30_Cargos].[ID]
                  WHERE [Funcionários].ID = :IDFUNC AND [30_TipoDocumentacao].ID != 32)", "IDFUNC={$PostData['funcionarioDid']}");
                $idfuncionario = $Read->getResult();

                $value = null;
                $jSON['tipo'] = null;
                $jSON['tipo1'] = null;
                $jSON['tipo2'] = null;
                $jSON['tipo3'] = null;
                $mudarvariavel = "";
                $value1 = null;
                $diretorionull = null;
                $visualizardoc = null;
                $valor = null;
                $outrosdoc = null;
                $REQUEST_URI = substr($_SERVER['REQUEST_URI'], 0, 15);

                if ($idfuncionario) {
                  foreach ($idfuncionario as $value) {
                    extract($value);


                    $Read->FullRead("SELECT IdFuncionario AS id ,DataValidade AS data, Tipo, Status AS stat, TipoData AS typedate FROM [30_Documentacao] WHERE IdTipoDocumento = :IDDOC AND IdFuncionario = :IDFUNCI", "IDDOC={$value['IDOC']}&IDFUNCI={$PostData['funcionarioDid']}");
                    $idtipo = $Read->getResult();

                    if ($idtipo) {
                      foreach ($idtipo as $value1) {
                        extract($value1);
                      }

                      if ($idtipo == NULL) {
                        $variavelData = $mudarvariavel;
                        $stat = $mudarvariavel;
                        $variavelSwitch = $mudarvariavel;
                      } else{
                        $iddata = $value1['data'];
                        $stat = $value1['stat'];
                        $variavelSwitch = $value1['Tipo'];
                      }

                      if ($stat == 2) {
                        $stat = '<a class="icon-checkmark">';
                      }elseif($stat == 1){
                        $stat = '<a class="icon-cross">';
                      }

                      $variavelData = str_replace("-", "/", $iddata);
                      $variavelDataM = str_replace("-", "", $iddata);
                      $dataBr = date('d/m/Y', strtotime($variavelData));
                      $dataBr1 = date('d-m-Y', strtotime($iddata));
                      $dia_atual = str_replace("-", "", date("Y-m-d"));
                      $dia_atual_br = date("d-m-Y");
                      $pegarDiretorio = substr(realpath(dirname(__FILE__)), 3, 18);
                      $teste = str_replace("\\", "/", $pegarDiretorio);
                      $dataTeste = pathinfo($iddata);
                      $basename = pathinfo($pegarDiretorio);
                      $caminhoPadrao = "//".$_SERVER['HTTP_HOST'].$REQUEST_URI."uploads/Achiles/{$value1['id']}/"; //CAMINHO PARA REALIZAR O DONWLOAD DO ARQUIVO
                      $caminhoDiretorio = "//".$_SERVER['SERVER_NAME']."/xampp/htdocs".$REQUEST_URI."uploads/Achiles/{$value1['id']}/"; //CAMINHO PARA VERIFICAR SE O ARQUIVO EXISTE DENTRO DA PASTA NO SISTEMA

                    //SE A VALIDADE PASSAR DA DATA DO DIA ATUAL MOSTRA A COR VERMELHA

                      if ($variavelDataM > $dia_atual AND $value1['typedate'] == 1) {
                        $variavelData = '<b><font color="green">'.$dataBr;
                      } elseif ($variavelDataM <= $dia_atual AND $value1['typedate'] == 1) {
                        $variavelData = '<b><font color="red">'.$dataBr; 
                      } elseif ($value1['typedate'] == 0) {
                        $variavelData = $dataBr;
                      }

                      $data = new DateTime($dia_atual);
                  $data1 = new DateTime($dataBr1); //DATA DOS DOCUMENTOS
                  $data2 = new DateTime($dia_atual); //DATA ATUAL
                  $data->add(new DateInterval('P31D')); //DATA ATUAL MAIS UM MÊS

                  if ($data1 > $data2 AND $data1 <= $data AND $value1['typedate'] == 1) {
                    $variavelData = '<b><font color="orange">'.$dataBr;
                  }

                  $docType = $Doc->exibir($variavelSwitch); 

                  $versao1 = $caminhoDiretorio.$docType[1]."/";

                  /* VERIFICA SE O DIRETORIO TEM ARQUIVO*/
                  $path = $versao1;
                  $diretorio = dir($path);
                  while ($arquivo = $diretorio -> read()) {
                    $dirArquivo = $path.$arquivo;
                  }
                  $diretorio -> close();
                  /* ACABA AQUI */

                  $getPath = pathinfo($dirArquivo);
                  $getExt = $getPath['extension'];
                }//IF LÁ DO IDTIPO PERTO DO FOREACH

                //CONDIÇÃO PARA APARECER NA TELA, SE O VALOR DO NOME DO DOCUMENTO VIER NULO DO BANCO DE DADOS, NÃO IRÁ APARECER NADA.
                if ($idtipo == NULL) {
                  $diretorionull = $mudarvariavel;
                  $variavelData = $mudarvariavel;
                  $stat = $mudarvariavel;
                  $visualizardoc = $mudarvariavel;
                }else{
                  $dirFinal = $caminhoPadrao.$docType[1]."/".$docType[0].".".$getExt;
                  $diretorionull = "<a href='{$dirFinal}' download><span class='btn btn_darkblue'>Download</span></a>";
                  $visualizardoc = "<a style='color: black; text-decoration: none;' class='icon-eye' target='_blank' href='{$dirFinal}' rel='shadowbox'></a>";
                }

                $variavelDataExtract = pathinfo($variavelData);

                if ($variavelDataExtract['basename'] == "1969") {
                  $variavelData = "Não validado."; 
                }

                $jSON['tipo'] .= "<tr><td>$NOMEDOC</td><td><center>$variavelData</center></td><td><center>$stat</center></td><td><center>$diretorionull</center></td><td><center>$visualizardoc</center></td></tr>";
              }
            }
            $Read->FullRead("SELECT IdFuncionario AS idd ,Tipo as TYPEDOCS, DataValidade AS data, IdTipoDocumento FROM [30_Documentacao] WHERE Status = 3 AND IdFuncionario = :IDFUNQ", "IDFUNQ={$PostData['funcionarioDid']}");
            $outrosdocumentos = $Read->getResult();
            $REQUEST_URI = substr($_SERVER['REQUEST_URI'], 0, 15);

            if ($outrosdocumentos) {
              foreach ($outrosdocumentos as $doc) {
                extract($doc);
                $TYPEDOCS = $doc['TYPEDOCS'];
                $DATE = $doc['data'];
                $datareplace = str_replace("-", "/", $DATE);
                $datareal = date('d/m/Y', strtotime($datareplace));
                $caminhoPadrao = "//".$_SERVER['HTTP_HOST'].$REQUEST_URI."uploads/Achiles/{$doc['idd']}/"; //CAMINHO PARA REALIZAR O DONWLOAD DO ARQUIVO
                $caminhoDiretorio = "//".$_SERVER['SERVER_NAME']."/xampp/htdocs".$REQUEST_URI."uploads/Achiles/{$doc['idd']}/"; //CAMINHO PARA VERIFICAR SE O ARQUIVO EXISTE DENTRO DA PASTA NO SISTEMA

                $versao1 = $caminhoDiretorio."32/";
                /* VERIFICA SE O DIRETORIO TEM ARQUIVO*/
                $path = $versao1;
                $diretorio = dir($path);
                while ($arquivo = $diretorio -> read()) {
                  $dirArquivo = $path.$arquivo;
                }
                $diretorio -> close();
                /* ACABA AQUI */

                $getPath = pathinfo($dirArquivo);
                $getExt = $getPath['extension'];

                $outraspastas = $caminhoPadrao."32/".$TYPEDOCS.".".$getExt;
                $dirOutros = "<a href='{$outraspastas}' download><span class='btn btn_darkblue'>Download</span></a>";
                $docview = "<a style='color: black; text-decoration: none;' class='icon-eye' target='_blank' href='{$outraspastas}' rel='shadowbox'></a>";

                $jSON['tipo1'] = "<tr><td style='padding: 11px;border: 1px solid #ffffff;background: #fefefe;'></td></tr>";
                $jSON['tipo2'] =  "<tr><th>Documentos</th><th>Data Doc.</th><th style='width: 15%;'>Download</th><th style='width: 5%;'>Vis.</th></tr>";
                $jSON['tipo3'] .= "<tr><td><center>$TYPEDOCS</center></td><td><center>$datareal</center></td><td><center>$dirOutros</center></td><td><center>$docview</center></td></tr>";
              }
            }
            break;
            break;
          endswitch;

//RETORNA O CALLBACK
          if ($jSON):
            echo json_encode($jSON);
          else:
            //$jSON['trigger'] = AjaxErro('<b class="icon-warning">OPSS:</b> Desculpe. Mas uma ação do sistema não respondeu corretamente. Ao persistir, contate o desenvolvedor!', E_USER_ERROR);
            echo json_encode($jSON);
          endif;
        else:
    //ACESSO DIRETO
          die('<br><br><br><center><h1>Acesso Restrito!</h1></center>');
        endif;